<?php
namespace Ambax\ArticleWebsite\Services;
use Ambax\ArticleWebsite\Services\RepositoryServices\ArticleRepositoryService;
use Ambax\ArticleWebsite\Services\RepositoryServices\CommentRepositoryService;
use Ambax\ArticleWebsite\Services\RepositoryServices\LikeRepositoryService;
use Exception;

class LikeService
{
    public function updateLikes
    (
        string $origin,
        string $id,
        LikeRepositoryService $likeRepository,
        ArticleRepositoryService $articleRepository,
        CommentRepositoryService $commentRepository
    ): void
    {
        try {
            $count = count($likeRepository->fetchAll($origin, $id));
        } catch (Exception $e) {
            throw new Exception($e);
        }
        try {
            switch ($origin) {
                case 'article':
                    $article = $articleRepository->fetchOne($id);
                    $article->setLikes($count);
                    $articleRepository->update($article);
                    break;
                case 'comment':
                    $comment = $commentRepository->fetchOne($id);
                    $comment->setLikes($count);
                    $commentRepository->update($comment);
                    break;
            }
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }
}