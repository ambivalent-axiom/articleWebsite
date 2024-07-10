<?php
namespace Ambax\ArticleWebsite\Controllers\ArticleControllers;
use Ambax\ArticleWebsite\RedirectResponse;
use Ambax\ArticleWebsite\Services\RepositoryServices\ArticleRepositoryServices;
use Psr\Log\LoggerInterface;


class ArticleLike
{
    //TODO implement model like system
    public function __construct(LoggerInterface $logger, ArticleRepositoryServices $repository)
    {
        $this->logger = $logger;
        $this->repository = $repository;
    }
    public function like(string $id): RedirectResponse
    {
        $article = $this->repository->fetchOne($id);
        $article->like();
        $this->logger->info(__METHOD__ . ' article ' . $id . ' liked');
        $this->repository->update($article);
        return new RedirectResponse('/redirect', '', '/show/' . $id);
    }
}