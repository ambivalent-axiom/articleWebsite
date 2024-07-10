<?php
namespace Ambax\ArticleWebsite\Models;
class Article implements Model
{
    private string $id;
    private int $category;
    private string $title;
    private string $content;
    private string $author;
    private string $created_at;
    private string $likes;

    public function __construct(
        string $id,
        int $category,
        string $title,
        string $content,
        string $author,
        string $created_at,
        int $likes=0
    )
    {
        $this->id = $id;
        $this->category = $category;
        $this->title = $title;
        $this->content = $content;
        $this->author = $author;
        $this->created_at = $created_at;
        $this->likes = $likes;
    }
    public function __invoke()
    {
        return [
            'article_id' => $this->id,
            'article_category' => $this->category,
            'article_title' => $this->title,
            'article_content' => $this->content,
            'article_author' => $this->author,
            'article_created_at' => $this->created_at,
            'article_likes' => $this->likes,
        ];
    }
    public function getId(): string
    {
        return $this->id;
    }
    public function getCategory(): int
    {
        return $this->category;
    }
    public function getTitle(): string
    {
        return $this->title;
    }
    public function getContent(): string
    {
        return $this->content;
    }
    public function getAuthor(): string
    {
        return $this->author;
    }
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }
    public function getLikes(): int
    {
        return $this->likes;
    }
    public function setLikes(int $likes)
    {
        $this->likes = $likes;
    }
    public function like()
    {
        $this->likes++;
    }
}