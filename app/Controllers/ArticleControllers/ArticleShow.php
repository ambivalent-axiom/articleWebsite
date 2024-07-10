<?php
namespace Ambax\ArticleWebsite\Controllers\ArticleControllers;
use Ambax\ArticleWebsite\Exceptions\ShowToUserException;
use Ambax\ArticleWebsite\Response;
use Ambax\ArticleWebsite\Services\RepositoryServices\ArticleRepositoryService;
use Ambax\ArticleWebsite\Services\RepositoryServices\CommentRepositoryService;
use Exception;
use Psr\Log\LoggerInterface;
class ArticleShow
{
    public function __construct(
        LoggerInterface           $logger,
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
        try {
            $article = $this->articleRepositoryService->fetchOne($id);
        } catch (Exception $e) {
            $this->logger->error(__METHOD__ . ' ' . $e);
            throw new ShowToUserException("Article not found");
        }
        try {
            $comments = $this->commentRepositoryService->fetchAllByArticle($id);
        } catch (Exception $e) {
            $this->logger->error(__METHOD__ . ' ' . $e);
            throw new ShowToUserException("Failed to retrieve comments");
        }
        return new Response([
                'article' => $article,
                'comments' => $comments,
            ],
            'show'
        );
    }
}
