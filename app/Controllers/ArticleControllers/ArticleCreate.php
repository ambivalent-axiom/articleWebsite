<?php
namespace Ambax\ArticleWebsite\Controllers\ArticleControllers;
use Ambax\ArticleWebsite\Exceptions\IncorrectInputException;
use Ambax\ArticleWebsite\Models\Article;
use Ambax\ArticleWebsite\RedirectResponse;
use Ambax\ArticleWebsite\Response;
use Ambax\ArticleWebsite\Services\RepositoryServices\ArticleRepositoryServices;
use Carbon\Carbon;
use Psr\Log\LoggerInterface;
use Ramsey\Uuid\Uuid;
use Respect\Validation\Validator as v;

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
        $validate = v::key('category', v::numericVal()->notEmpty()->length(1,1))
            ->key('title', v::alnum()->notEmpty()->length(1,32))
            ->key('content', v::alnum()->notEmpty())
            ->key('author', v::alnum()->notEmpty()->length(1,20));

        if( ! $validate->validate($_POST))
        {
            throw new IncorrectInputException("Please check the input fields!");
        }
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