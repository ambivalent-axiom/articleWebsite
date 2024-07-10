<?php
namespace Ambax\ArticleWebsite\Controllers\ArticleControllers;
use Ambax\ArticleWebsite\Exceptions\ShowToUserException;
use Ambax\ArticleWebsite\RedirectResponse;
use Ambax\ArticleWebsite\Services\RepositoryServices\ArticleRepositoryServices;
use Exception;
use Psr\Log\LoggerInterface;


class ArticleDelete
{
    public function __construct(LoggerInterface $logger, ArticleRepositoryServices $repository)
    {
        $this->logger = $logger;
        $this->repository = $repository;
    }
    public function delete(string $id): RedirectResponse
    {
        $this->logger->info(__METHOD__ . ' article ' . $id . ' deleted');
        try {
            $this->repository->delete($id);
        } catch (Exception $e) {
            $this->logger->error($e);
            throw new ShowToUserException("Failed to delete article");
        }
        return new RedirectResponse('/notify', 'Article deleted successfully', '/');
    }
}
