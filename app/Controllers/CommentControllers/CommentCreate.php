<?php
namespace Ambax\ArticleWebsite\Controllers\CommentControllers;
use Ambax\ArticleWebsite\Exceptions\IncorrectInputException;
use Ambax\ArticleWebsite\Models\Comment;
use Ambax\ArticleWebsite\RedirectResponse;
use Ambax\ArticleWebsite\Services\RepositoryServices\CommentRepositoryServices;
use Carbon\Carbon;
use Exception;
use Psr\Log\LoggerInterface;
use Ramsey\Uuid\Uuid;
use Respect\Validation\Validator as v;

class CommentCreate
{
    public function __construct(LoggerInterface $logger, CommentRepositoryServices $repository)
    {
        $this->logger = $logger;
        $this->repository = $repository;
    }
    public function create(): RedirectResponse
    {
        $validate = v::key('articleId', v::notEmpty()->uuid(4))
            ->key('author', v::alnum()->notEmpty()->length(1,20))
            ->key('email', v::email()->notEmpty()->length(1, 255))
            ->key('content', v::notEmpty());
        if( ! $validate->validate($_POST))
        {
            throw new IncorrectInputException("Please check the input fields!");
        }
        $this->logger->info(__METHOD__ . ' create start');
        $comment = new Comment(
            Uuid::uuid4()->toString(),
            $_POST['articleId'],
            $_POST['author'],
            $_POST['email'],
            $_POST['content'],
            Carbon::now()->toDateTimeString()
        );
        try {
            $this->repository->create($comment);
        } catch (Exception $e) {
            $this->logger->error($e);
            return new RedirectResponse('/notify', 'Uups, failed to add comment!', '/show/' . $_POST['articleId']);
        }
        return new RedirectResponse('/notify', 'Comment added successfully', '/show/' . $_POST['articleId']);
    }
}