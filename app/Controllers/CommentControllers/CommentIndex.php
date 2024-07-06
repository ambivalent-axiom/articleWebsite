<?php
namespace Ambax\ArticleWebsite\Controllers\CommentControllers;
use Ambax\ArticleWebsite\Response;
use Ambax\ArticleWebsite\Services\RepositoryServices\CommentRepositoryServices;
use Psr\Log\LoggerInterface;

class CommentIndex
{
    public function __construct(LoggerInterface $logger, CommentRepositoryServices $repository)
    {
        $this->logger = $logger;
        $this->repository = $repository;
    }
    public function index(): Response
    {
        $this->logger->info(__METHOD__ . ' index started');
        return new Response(
            ['comments' => $this->repository->fetchAll()],
            'index'
        );
    }
}