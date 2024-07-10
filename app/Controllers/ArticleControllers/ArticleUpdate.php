<?php
namespace Ambax\ArticleWebsite\Controllers\ArticleControllers;
use Ambax\ArticleWebsite\Exceptions\IncorrectInputException;
use Ambax\ArticleWebsite\Exceptions\ShowToUserException;
use Ambax\ArticleWebsite\Models\Article;
use Ambax\ArticleWebsite\RedirectResponse;
use Ambax\ArticleWebsite\Response;
use Ambax\ArticleWebsite\Services\RepositoryServices\ArticleRepositoryService;
use Exception;
use Psr\Log\LoggerInterface;
use Respect\Validation\Validator as v;
class ArticleUpdate
{
    public function __construct(LoggerInterface $logger, ArticleRepositoryService $repository)
    {
        $this->logger = $logger;
        $this->repository = $repository;
    }
    public function index(string $id): Response
    {
        $this->logger->info(__METHOD__ . ' index start');
        return new Response(
            ['article' => $this->repository->fetchOne($id)],
            'update'
        );
    }
    public function update(): RedirectResponse
    {
        $validate = v::key('id', v::notEmpty()->uuid(4))
            ->key('category', v::numericVal()->notEmpty()->length(1,1))
            ->key('title', v::alnum()->notEmpty()->length(1,32))
            ->key('author', v::alnum()->notEmpty()->length(1,20))
            ->key('timestamp', v::dateTime()->notEmpty()->length(1,30));
        if( ! $validate->validate($_POST))
        {
            throw new IncorrectInputException("Please check the input fields!");
        }
        $article = new Article(
            $_POST['id'],
            $_POST['category'],
            $_POST['title'],
            $_POST['content'],
            $_POST['author'],
            $_POST['timestamp']
        );
        $this->logger->info(__METHOD__ . ' article ' . $article->getId() . ' update start');
        try {
            $this->repository->update($article);
        } catch (Exception $e) {
            $this->logger->info(__METHOD__ . ' article ' . $article->getId() . ' update error: ' . $e);
            throw new ShowToUserException("Failed to update article!");
        }
        return new RedirectResponse('/notify', 'Article updated successfully', '/');
    }
}
