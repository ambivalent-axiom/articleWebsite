<?php
namespace Ambax\ArticleWebsite\Controllers;
use Ambax\ArticleWebsite\Response;
use Ambax\ArticleWebsite\Services\RepositoryServices\ArticleRepositoryService;
use Psr\Log\LoggerInterface;

class ArticleController
{
    public function __construct(LoggerInterface $logger, ArticleRepositoryService $repository)
    {
        $this->logger = $logger;
        $this->repository = $repository;
    }
    public function index(): Response
    {
        $this->logger->info(__METHOD__ . ' index start');
        return new Response(
            ['articles' => $this->repository->fetchAll()],
            'index'
        );
    }
}