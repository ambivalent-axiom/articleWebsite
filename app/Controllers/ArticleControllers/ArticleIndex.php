<?php
namespace Ambax\ArticleWebsite\Controllers\ArticleControllers;
use Ambax\ArticleWebsite\Response;
use Ambax\ArticleWebsite\Services\RepositoryServices\ArticleRepositoryServices;
use Psr\Log\LoggerInterface;

class ArticleIndex
{
    public function __construct(LoggerInterface $logger, ArticleRepositoryServices $repository)
    {
        $this->logger = $logger;
        $this->repository = $repository;
    }
    public function index(): Response
    {
        $this->logger->info(__METHOD__ . ' index started');
        return new Response(
            ['articles' => $this->repository->fetchAll()],
            'index'
        );
    }
}