<?php
namespace Ambax\ArticleWebsite;
class RedirectResponse
{
    private string $url;
    private string $message;
    public function __construct(string $url, string $message, string $redirectTo)
    {
        $this->url = $url;
        $this->message = $message;
        $this->direction = $redirectTo;
    }
    public function getAddress(): string
    {
        return $this->url;
    }
    public function getMessage(): array
    {
        return ['message' => $this->message, 'loc' => $this->direction];
    }
}
