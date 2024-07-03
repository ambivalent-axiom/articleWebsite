<?php
namespace Ambax\articleWebsite\Services\RepositoryServices;
use Ambax\articleWebsite\Repositories\Database;
use Article;
use Model;

class ArticleRepositoryService implements RepositoryService
{
    public function __construct(Database $db)
    {
        $this->db = $db;
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
                $article['article_date'],
                $article['article_created_at'],
            );
        }
        return $articles;
    }
    public function delete(string $id)
    {
        // TODO: Implement delete() method.
    }
    public function create(Model $article): void
    {
        $this->db->insert('articles', $article());
    }
    public function update(array $data)
    {
        // TODO: Implement update() method.
    }
}