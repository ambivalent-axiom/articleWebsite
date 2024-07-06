<?php
namespace Ambax\ArticleWebsite\Controllers\ArticleControllers;
use Ambax\ArticleWebsite\Response;
use Ambax\ArticleWebsite\Services\RepositoryServices\ArticleRepositoryService;
use Ambax\ArticleWebsite\Services\RepositoryServices\CommentRepositoryService;
use Psr\Log\LoggerInterface;


class ArticleShow
{
    public function __construct(
        LoggerInterface $logger,
        ArticleRepositoryService $articleRepositoryService,
        CommentRepositoryService $commentRepositoryService
    )
    {
        $this->logger = $logger;
        $this->articleRepositoryService = $articleRepositoryService;
        $this->commentRepositoryService = $commentRepositoryService;
    }

    public function show(string $id): Response
    {
        $this->logger->info(__METHOD__ . ' show one article start');
        return new Response([
                'article' => $this->articleRepositoryService->fetchOne($id),
                'comments' => $this->commentRepositoryService->fetchOne($id),
            ],
            'show'
        );
    }
}