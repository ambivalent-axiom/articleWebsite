<?php
namespace Ambax\ArticleWebsite\Controllers\ArticleControllers;
use Ambax\ArticleWebsite\RedirectResponse;
use Ambax\ArticleWebsite\Services\RepositoryServices\ArticleRepositoryService;
use Psr\Log\LoggerInterface;


class ArticleDelete
{
    public function __construct(LoggerInterface $logger, ArticleRepositoryService $repository)
    {
        $this->logger = $logger;
        $this->repository = $repository;
    }
    public function delete(string $id): RedirectResponse
    {
        $this->logger->info(__METHOD__ . ' article ' . $id . ' deleted');
        $this->repository->delete($id);
        return new RedirectResponse('/notify', 'Article deleted successfully', '/');
    }
}
