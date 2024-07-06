<?php
namespace Ambax\ArticleWebsite\Services\RepositoryServices;
use Ambax\ArticleWebsite\Models\Comment;
use Ambax\ArticleWebsite\Models\Model;
use Ambax\ArticleWebsite\Repositories\Database;
use PDOException;
use Psr\Log\LoggerInterface;

class CommentRepositoryService implements RepositoryService
{
    public function __construct(LoggerInterface $logger, Database $db)
    {
        $this->db = $db->set();
        $this->logger = $logger;
    }
    public function fetchOne(string $articleId): array
    {
        $this->logger->info(__METHOD__ . 'Fetching comment by article ID: ' . $articleId);
        $content = $this->db->select('comments', '*', ['comment_id' => $articleId]);
        $articleComments = [];
        foreach ($content as $comment) {
            $articleComments[] = new Comment(
                $comment['comment_id'],
                $comment['comment_article_id'],
                $comment['comment_author'],
                $comment['comment_email'],
                $comment['comment_content'],
                $comment['comment_timestamp'],
                $comment['comment_status'],
                $comment['comment_likes'],
            );
        }
        return $articleComments;
    }
    public function fetchAll(): array
    {
        $this->logger->info(__METHOD__ . 'Fetching comments...');
        $comments = [];
        foreach ($this->db->select('comments', '*', [
            'ORDER' => ['comment_timestamp' => 'DESC']]) as $comment) {
            $comments[] = new Comment(
                $comment['comment_id'],
                $comment['comment_article_id'],
                $comment['comment_author'],
                $comment['comment_email'],
                $comment['comment_content'],
                $comment['comment_timestamp'],
                $comment['comment_status'],
                $comment['comment_likes'],
            );
        }
        return $comments;
    }
    public function delete(string $id): bool
    {
        try {
            $this->db->delete('comments', ['comment_id' => $id]);
            $this->logger->info(__METHOD__ . " comment " . $id . " deleted");
            return true;
        } catch (PDOException $e) {
            $this->logger->info(__METHOD__ . $e->getMessage());
            return false;
        }

    }
    public function create(Model $comment): bool
    {
        try {
            $this->db->insert('articles', $comment());
            $this->logger->info(__METHOD__ . " comment created");
            return true;
        } catch (PDOException $e) {
            $this->logger->info(__METHOD__ . $e->getMessage());
            return false;
        }
    }
    public function update(Model $comment): bool
    {
        try {
            $this->db->update('comments', $comment(), ['comment_id' => $comment->getId()]);
            $this->logger->info(__METHOD__ . " comment updated");
            return true;
        } catch (PDOException $e) {
            $this->logger->info(__METHOD__ . $e->getMessage());
            return false;
        }
    }
}