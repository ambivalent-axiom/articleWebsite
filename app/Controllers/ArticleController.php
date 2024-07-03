<?php
namespace Ambax\articleWebsite\Controllers;
use Ambax\articleWebsite\Response;
use Ambax\articleWebsite\Services\RepositoryServices\RepositoryService;
use Psr\Log\LoggerInterface;

class ArticleController
{
    public function __construct(
        LoggerInterface $logger,
        RepositoryService $articleRepositoryService
    )
    {
        $this->logger = $logger;
        $this->articleRepositoryService = $articleRepositoryService;
    }
    public function index()
    {
        return new Response(
            ['articles' => $this->articleRepositoryService->fetchAll()],
            'index'
        );
    }
}