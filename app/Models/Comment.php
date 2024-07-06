<?php
namespace Ambax\ArticleWebsite\Models;
class Comment implements Model
{
    private string $id;
    private string $postId;
    private string $email;
    private string $content;
    private string $author;
    private string $created_at;
    private string $status;
    private int $likes;

    public function __construct(
        string $id,
        string $postId,
        string $email,
        string $content,
        string $author,
        string $created_at,
        string $status='approved',
        int $likes=0
    )
    {
        $this->id = $id;
        $this->postId = $postId;
        $this->email = $email;
        $this->content = $content;
        $this->author = $author;
        $this->created_at = $created_at;
        $this->status = $status;
        $this->likes = $likes;
    }
    public function __invoke()
    {
        return [
            'article_id' => $this->id,
            'post_id' => $this->postId,
            'email' => $this->email,
            'article_content' => $this->content,
            'article_author' => $this->author,
            'article_created_at' => $this->created_at,
            'article_status' => $this->status,
            'article_likes' => $this->likes,
        ];
    }
    public function getId(): string
    {
        return $this->id;
    }
    public function getPostId(): string
    {
        return $this->postId;
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
}