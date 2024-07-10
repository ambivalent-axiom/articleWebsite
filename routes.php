<?php
namespace Ambax\ArticleWebsite;
return [
    ['GET', '/', [Controllers\ArticleControllers\ArticleIndex::class, 'index']],
    ['GET', '/create', [Controllers\ArticleControllers\ArticleCreate::class, 'index']],
    ['GET', '/show/{id}', [Controllers\ArticleControllers\ArticleShow::class, 'show']],
    ['GET', '/delete/{id}', [Controllers\ArticleControllers\ArticleDelete::class, 'delete']],
    ['GET', '/update/{id}', [Controllers\ArticleControllers\ArticleUpdate::class, 'index']],
    ['GET', '/comment/delete/{id}', [Controllers\CommentControllers\CommentDelete::class, 'delete']],
    ['GET', '/{origin}/like/{id}', [Controllers\LikeControllers\LikeAdd::class, 'like']],
    ['POST', '/update', [Controllers\ArticleControllers\ArticleUpdate::class, 'update']],
    ['POST', '/create', [Controllers\ArticleControllers\ArticleCreate::class, 'create']],
    ['POST', '/show/{id}', [Controllers\CommentControllers\CommentCreate::class, 'create']],
];