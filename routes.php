<?php
namespace Ambax\ArticleWebsite;
return [
    ['GET', '/', [Controllers\ArticleIndex::class, 'index']],
    ['GET', '/create', [Controllers\ArticleCreate::class, 'index']],
    ['GET', '/delete/{id}', [Controllers\ArticleDelete::class, 'delete']],
    ['POST', '/create', [Controllers\ArticleCreate::class, 'create']],
];