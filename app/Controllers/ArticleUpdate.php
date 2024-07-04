<?php
namespace Ambax\ArticleWebsite\Controllers;
use Ambax\ArticleWebsite\Models\Article;
use Ambax\ArticleWebsite\Response;
use Ambax\ArticleWebsite\Services\RepositoryServices\ArticleRepositoryService;
use Ambax\ArticleWebsite\RedirectResponse;
use Psr\Log\LoggerInterface;


class ArticleUpdate
{
    public function __construct(LoggerInterface $logger, ArticleRepositoryService $repository)
    {
        $this->logger = $logger;
        $this->repository = $repository;
    }

    public function index(string $id): Response
    {
        $this->logger->info(__METHOD__ . ' index start');
        return new Response(
            ['article' => $this->repository->fetchOne($id)],
            'update'
        );
    }

    public function update(): RedirectResponse
    {
        $article = new Article(
            $_POST['id'],
            $_POST['category'],
            $_POST['title'],
            $_POST['content'],
            $_POST['author'],
            $_POST['timestamp']
        );
        $this->logger->info(__METHOD__ . ' article ' . $article->getId() . ' update start');
        $this->repository->update($article);
        return new RedirectResponse('/notify', 'Article updated successfully', '/');
    }
}
