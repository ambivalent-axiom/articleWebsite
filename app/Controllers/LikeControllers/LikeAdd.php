<?php
namespace Ambax\ArticleWebsite\Controllers\LikeControllers;
use Ambax\ArticleWebsite\Exceptions\ShowToUserException;
use Ambax\ArticleWebsite\Models\Like;
use Ambax\ArticleWebsite\RedirectResponse;
use Ambax\ArticleWebsite\Services\LikeService;
use Ambax\ArticleWebsite\Services\RepositoryServices\ArticleRepositoryService;
use Ambax\ArticleWebsite\Services\RepositoryServices\CommentRepositoryService;
use Ambax\ArticleWebsite\Services\RepositoryServices\LikeRepositoryService;
use Carbon\Carbon;
use Exception;
use Psr\Log\LoggerInterface;
use Ramsey\Uuid\Uuid;

class LikeAdd
{
    public function __construct(
        LoggerInterface $logger,
        LikeRepositoryService $likeRepositoryService,
        ArticleRepositoryService $articleRepositoryService,
        CommentRepositoryService $commentRepositoryService,
        LikeService $likeService
    )
    {
        $this->logger = $logger;
        $this->repository = $likeRepositoryService;
        $this->articleRepositoryService = $articleRepositoryService;
        $this->commentRepositoryService = $commentRepositoryService;
        $this->likeService = $likeService;
    }
    public function like(string $origin, string $id): RedirectResponse
    {
        $this->logger->info(__METHOD__ . 'like add start');
        $like = new Like(
            Uuid::uuid4()->toString(),
            $id,
            $origin,
            Carbon::now()->toDateTimeString()
        );
        try {
            $this->repository->create($like);
            $this->likeService->updateLikes(
                $origin,
                $id,
                $this->repository,
                $this->articleRepositoryService,
                $this->commentRepositoryService
            );
            return new RedirectResponse('/redirect', '', $_SERVER['HTTP_REFERER'] . '#' . $id);
        } catch (Exception $e) {
            $this->logger->error($e);
            throw new ShowToUserException('Failed to add like');
        }
    }
}