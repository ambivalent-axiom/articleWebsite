<?php
namespace Ambax\ArticleWebsite\Services;
use Ambax\ArticleWebsite\Services\RepositoryServices\ArticleRepositoryService;
use Ambax\ArticleWebsite\Services\RepositoryServices\CommentRepositoryService;
use Ambax\ArticleWebsite\Services\RepositoryServices\LikeRepositoryService;
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
        $count = count($likeRepository->fetchAll($origin, $id));
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
    }
}