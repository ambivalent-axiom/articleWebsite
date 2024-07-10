<?php
namespace Ambax\ArticleWebsite\Controllers\CommentControllers;
use Ambax\ArticleWebsite\RedirectResponse;
use Ambax\ArticleWebsite\Services\RepositoryServices\CommentRepositoryServices;
use Exception;
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
        //TODO implement model likes
        $articleId = $_GET['article'];
        try {
            $comment = $this->repository->fetchOne($id);
        } catch (Exception $e) {
            $this->logger->error($e);
            throw new Exception("Operation failed!");
        }
        $comment->like();
        $this->logger->info(__METHOD__ . ' comment ' . $id . ' deleted');
        $this->repository->update($comment);
        return new RedirectResponse('/redirect', '', '/show/' . $articleId);
    }
}