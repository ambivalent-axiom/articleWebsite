<?php
namespace Ambax\ArticleWebsite\Controllers;
use Ambax\ArticleWebsite\Response;
use Ambax\ArticleWebsite\Services\RepositoryServices\ArticleRepositoryService;
use Psr\Log\LoggerInterface;

class ArticleIndex
{
    public function __construct(LoggerInterface $logger, ArticleRepositoryService $repository)
    {
        $this->logger = $logger;
        $this->repository = $repository;
    }
    public function index(): Response
    {
        return new Response(
            ['articles' => $this->repository->fetchAll()],
            'index'
        );
    }
}