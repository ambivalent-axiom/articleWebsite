<?php
namespace Ambax\ArticleWebsite;
return [
    ['GET', '/', [Controllers\ArticleControllers\ArticleIndex::class, 'index']],
    ['GET', '/create', [Controllers\ArticleControllers\ArticleCreate::class, 'index']],
    ['GET', '/show/{id}', [Controllers\ArticleControllers\ArticleShow::class, 'show']],
    ['GET', '/delete/{id}', [Controllers\ArticleControllers\ArticleDelete::class, 'delete']],
    ['GET', '/update/{id}', [Controllers\ArticleControllers\ArticleUpdate::class, 'index']],
    ['POST', '/update', [Controllers\ArticleControllers\ArticleUpdate::class, 'update']],
    ['POST', '/create', [Controllers\ArticleControllers\ArticleCreate::class, 'create']],
];