<?php
namespace Ambax\ArticleWebsite\Services\RepositoryServices;
use Ambax\ArticleWebsite\Models\Article;
use Ambax\ArticleWebsite\Models\Model;
use Ambax\ArticleWebsite\Repositories\Database;
use PDOException;
use Psr\Log\LoggerInterface;

class ArticleRepositoryService implements RepositoryService
{
    public function __construct(LoggerInterface $logger, Database $db)
    {
        $this->db = $db->set();
        $this->logger = $logger;
    }
    public function fetchOne(string $id)
    {
        // TODO: Implement fetchOne() method.
    }
    public function fetchAll(): array
    {
        $articles = [];
        foreach ($this->db->select('articles', '*') as $article) {
            $articles[] = new Article(
                $article['article_id'],
                $article['article_category'],
                $article['article_title'],
                $article['article_content'],
                $article['article_author'],
                $article['article_created_at']
            );
        }
        return $articles;
    }
    public function delete(string $id): bool
    {
        try {
            $this->db->delete('articles', ['article_id' => $id]);
            $this->logger->info(__METHOD__ . " article " . $id . " deleted");
            return true;
        } catch (PDOException $e) {
            $this->logger->info(__METHOD__ . $e->getMessage());
            return false;
        }

    }
    public function create(Model $article): bool
    {
        try {
            $this->db->insert('articles', $article());
            $this->logger->info(__METHOD__ . " article created");
            return true;
        } catch (PDOException $e) {
            $this->logger->info(__METHOD__ . $e->getMessage());
            return false;
        }
    }
    public function update(Model $article): bool
    {
        // TODO: Implement update() method.
    }
}