<?php
namespace Ambax\ArticleWebsite;
return [
    ['GET', '/', [Controllers\ArticleIndex::class, 'index']],
    ['GET', '/create', [Controllers\ArticleCreate::class, 'index']],
    ['GET', '/show/{id}', [Controllers\ArticleShow::class, 'show']],
    ['GET', '/delete/{id}', [Controllers\ArticleDelete::class, 'delete']],
    ['GET', '/update/{id}', [Controllers\ArticleUpdate::class, 'index']],
    ['POST', '/update', [Controllers\ArticleUpdate::class, 'update']],
    ['POST', '/create', [Controllers\ArticleCreate::class, 'create']],
];