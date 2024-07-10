<?php
namespace Ambax\ArticleWebsite\Models;
class Comment implements Model
{
    private string $id;
    private string $articleId;
    private string $email;
    private string $content;
    private string $author;
    private string $created_at;
    private string $status;
    private int $likes;

    public function __construct(
        string $id,
        string $articleId,
        string $author,
        string $email,
        string $content,
        string $created_at,
        string $status='approved',
        int $likes=0
    )
    {
        $this->id = $id;
        $this->articleId = $articleId;
        $this->author = $author;
        $this->email = $email;
        $this->content = $content;
        $this->created_at = $created_at;
        $this->status = $status;
        $this->likes = $likes;
    }
    public function __invoke()
    {
        return [
            'comment_id' => $this->id,
            'comment_article_id' => $this->articleId,
            'comment_author' => $this->author,
            'comment_email' => $this->email,
            'comment_content' => $this->content,
            'comment_timestamp' => $this->created_at,
            'comment_status' => $this->status,
            'comment_likes' => $this->likes,
        ];
    }
    public function getId(): string
    {
        return $this->id;
    }
    public function getArticleId(): string
    {
        return $this->articleId;
    }
    public function getEmail(): string
    {
        return $this->email;
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
    public function getStatus(): string
    {
        return $this->status;
    }
    public function getLikes(): int
    {
        return $this->likes;
    }
    public function setLikes(int $likes): void
    {
        $this->likes = $likes;
    }
    public function like(): void
    {
        $this->likes ++;
    }
}