<?php
class Article implements Model
{
    private string $id;
    private int $category;
    private string $title;
    private string $content;
    private string $author;
    private string $date;
    private string $created_at;

    public function __construct(
        string $id,
        string $category,
        string $title,
        string $content,
        string $author,
        string $date,
        string $created_at)
    {
        $this->id = $id;
        $this->category = $category;
        $this->title = $title;
        $this->content = $content;
        $this->author = $author;
        $this->date = $date;
        $this->created_at = $created_at;
    }
    public function __invoke()
    {
        return [
            'article_id' => $this->id,
            'article_category' => $this->category,
            'article_title' => $this->title,
            'article_content' => $this->content,
            'article_author' => $this->author,
            'article_date' => $this->date
        ];
    }
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }
}