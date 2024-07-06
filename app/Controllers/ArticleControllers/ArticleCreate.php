<?php
namespace Ambax\ArticleWebsite\Controllers\ArticleControllers;
use Ambax\ArticleWebsite\Models\Article;
use Ambax\ArticleWebsite\RedirectResponse;
use Ambax\ArticleWebsite\Response;
use Ambax\ArticleWebsite\Services\RepositoryServices\ArticleRepositoryServices;
use Carbon\Carbon;
use Psr\Log\LoggerInterface;
use Ramsey\Uuid\Uuid;

class ArticleCreate
{
    public function __construct(LoggerInterface $logger, ArticleRepositoryServices $repository)
    {
        $this->logger = $logger;
        $this->repository = $repository;
    }
    public function index(): Response
    {
        $this->logger->info(__METHOD__ . ' index start');
        return new Response(
            [],
            'create'
        );
    }
    public function create(): RedirectResponse
    {
        $this->logger->info(__METHOD__ . ' create start');
        $article = new Article(
            Uuid::uuid4()->toString(),
            $_POST['category'],
            $_POST['title'],
            $_POST['content'],
            $_POST['author'],
            Carbon::now()->toDateTimeString()
        );
        $this->repository->create($article);
        return new RedirectResponse('/notify', 'Article created successfully', '/');
    }
}