<?php
namespace Ambax\ArticleWebsite\Controllers\ArticleControllers;
use Ambax\ArticleWebsite\Response;
use Ambax\ArticleWebsite\Services\RepositoryServices\ArticleRepositoryService;
use Psr\Log\LoggerInterface;


class ArticleShow
{
    public function __construct(LoggerInterface $logger, ArticleRepositoryService $repository)
    {
        $this->logger = $logger;
        $this->repository = $repository;
    }

    public function show(string $id): Response
    {
        $this->logger->info(__METHOD__ . ' show one article start');
        return new Response(
            ['article' => $this->repository->fetchOne($id)],
            'show'
        );
    }
}
