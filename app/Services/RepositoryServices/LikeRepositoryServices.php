<?php
namespace Ambax\ArticleWebsite\Services\RepositoryServices;
use Ambax\ArticleWebsite\Models\Comment;
use Ambax\ArticleWebsite\Models\Like;
use Ambax\ArticleWebsite\Models\Model;
use Ambax\ArticleWebsite\Repositories\Database;
use Exception;
use PDOException;
use Psr\Log\LoggerInterface;

class LikeRepositoryServices implements LikeRepositoryService
{
    public function __construct(LoggerInterface $logger, Database $db)
    {
        $this->db = $db->set();
        $this->logger = $logger;
    }
    public function fetchOne(string $id): Like
    {
        $this->logger->info(__METHOD__ . 'Fetching like ID: ' . $id);
        $content = $this->db->select('likes', '*', ['like_id' => $id]);
        foreach ($content as $like) {
            $like = new Like(
                $like['like_id'],
                $like['like_origin_id'],
                $like['like_origin'],
                $like['like_timestamp']
            );
        }
        return $like;
    }
    public function fetchAll(string $origin, string $originId): array
    {
        $this->logger->info(__METHOD__ . 'Fetching likes by ' . $origin . ' ID: ' . $originId);
        $content = $this->db->select('likes', '*', ['origin' => $origin, 'origin_id' => $originId]);
        $likes = [];
        foreach ($content as $like) {
            $likes[] = new Like(
                $like['like_id'],
                $like['like_origin_id'],
                $like['like_origin'],
                $like['like_timestamp']
            );
        }
        return $likes;
    }
    public function delete(string $id): bool
    {
        try {
            $this->db->delete('likes', ['like_id' => $id]);
            $this->logger->info(__METHOD__ . " like " . $id . " deleted");
            return true;
        } catch (PDOException $e) {
            $this->logger->info(__METHOD__ . $e->getMessage());
            throw new Exception($e->getMessage());
        }

    }
    public function create(Model $like): bool
    {
        try {
            $this->db->insert('likes', $like());
            $this->logger->info(__METHOD__ . " like created");
            return true;
        } catch (PDOException $e) {
            $this->logger->info(__METHOD__ . $e->getMessage());
            throw new Exception($e->getMessage());
        }
    }
}