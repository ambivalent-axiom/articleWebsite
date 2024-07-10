<?php
namespace Ambax\ArticleWebsite\Controllers\ArticleControllers;
use Ambax\ArticleWebsite\Exceptions\ShowToUserException;
use Ambax\ArticleWebsite\Response;
use Ambax\ArticleWebsite\Services\RepositoryServices\ArticleRepositoryServices;
use Exception;
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
        try {
            $response = new Response(
                ['articles' => $this->repository->fetchAll()],
                'index'
            );
        } catch (Exception $e) {
            $this->logger->error(__METHOD__ . " " . $e);
            throw new ShowToUserException("Unable to retrieve articles!");
        }
        return $response;
    }
}