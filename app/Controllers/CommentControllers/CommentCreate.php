<?php
namespace Ambax\ArticleWebsite\Controllers\CommentControllers;
use Ambax\ArticleWebsite\Models\Comment;
use Ambax\ArticleWebsite\RedirectResponse;
use Ambax\ArticleWebsite\Services\RepositoryServices\CommentRepositoryServices;
use Carbon\Carbon;
use Psr\Log\LoggerInterface;
use Ramsey\Uuid\Uuid;

class CommentCreate
{
    public function __construct(LoggerInterface $logger, CommentRepositoryServices $repository)
    {
        $this->logger = $logger;
        $this->repository = $repository;
    }
    public function create(): RedirectResponse
    {
        $this->logger->info(__METHOD__ . ' create start');
        $comment = new Comment(
            Uuid::uuid4()->toString(),
            $_POST['articleId'],
            $_POST['author'],
            $_POST['email'],
            $_POST['content'],
            Carbon::now()->toDateTimeString()
        );
        $this->repository->create($comment);
        return new RedirectResponse('/notify', 'Comment added successfully', '/show/' . $_POST['articleId']);
    }
}