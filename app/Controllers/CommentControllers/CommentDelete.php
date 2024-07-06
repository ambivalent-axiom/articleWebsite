<?php
namespace Ambax\ArticleWebsite\Controllers\CommentControllers;
use Ambax\ArticleWebsite\RedirectResponse;
use Ambax\ArticleWebsite\Services\RepositoryServices\CommentRepositoryServices;
use Psr\Log\LoggerInterface;


class CommentDelete
{
    public function __construct(LoggerInterface $logger, CommentRepositoryServices $repository)
    {
        $this->logger = $logger;
        $this->repository = $repository;
    }
    public function delete(string $id): RedirectResponse
    {
        $articleId = $_GET['article'];
        $this->logger->info(__METHOD__ . ' comment ' . $id . ' deleted');
        $this->repository->delete($id);
        return new RedirectResponse('/notify', 'Comment deleted successfully', '/show/' . $articleId);
    }
}