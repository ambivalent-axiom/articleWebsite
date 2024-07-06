<?php
namespace Ambax\ArticleWebsite\Controllers\CommentControllers;
use Ambax\ArticleWebsite\RedirectResponse;
use Ambax\ArticleWebsite\Services\RepositoryServices\ArticleRepositoryService;
use Ambax\ArticleWebsite\Services\RepositoryServices\CommentRepositoryService;
use Psr\Log\LoggerInterface;


class CommentDelete
{
    public function __construct(LoggerInterface $logger, CommentRepositoryService $repository)
    {
        $this->logger = $logger;
        $this->repository = $repository;
    }
    public function delete(string $id): RedirectResponse
    {
        $this->logger->info(__METHOD__ . ' comment ' . $id . ' deleted');
        $this->repository->delete($id);
        return new RedirectResponse('/notify', 'Comment deleted successfully', '/');
    }
}