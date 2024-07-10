<?php
namespace Ambax\ArticleWebsite\Controllers\CommentControllers;
use Ambax\ArticleWebsite\Exceptions\ShowToUserException;
use Ambax\ArticleWebsite\Response;
use Ambax\ArticleWebsite\Services\RepositoryServices\CommentRepositoryServices;
use Exception;
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
        try {
            $response = new Response(
                ['comments' => $this->repository->fetchAll()],
                'index'
            );
        } catch (Exception $e) {
            $this->logger->error(__METHOD__ . " " . $e);
            throw new ShowToUserException("Uups! Error fetching comments.");
        }
        return $response;
    }
}