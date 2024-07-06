<?php
namespace Ambax\ArticleWebsite\Controllers\CommentControllers;
use Ambax\ArticleWebsite\RedirectResponse;
use Ambax\ArticleWebsite\Services\RepositoryServices\CommentRepositoryServices;
use Psr\Log\LoggerInterface;


class CommentLike
{
    public function __construct(LoggerInterface $logger, CommentRepositoryServices $repository)
    {
        $this->logger = $logger;
        $this->repository = $repository;
    }
    public function like(string $id): RedirectResponse
    {
        $articleId = $_GET['article'];
        $comment = $this->repository->fetchOne($id);
        $comment->like();
        $this->logger->info(__METHOD__ . ' comment ' . $id . ' deleted');
        $this->repository->update($comment);
        return new RedirectResponse('/redirect', '', '/show/' . $articleId);
    }
}