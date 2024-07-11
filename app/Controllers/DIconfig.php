<?php
namespace Ambax\ArticleWebsite;
use Ambax\ArticleWebsite\Repositories\Database;
use Ambax\ArticleWebsite\Repositories\SQLite;
use Ambax\ArticleWebsite\Services\LikeService;
use Ambax\ArticleWebsite\Services\RepositoryServices\ArticleRepositoryService;
use Ambax\ArticleWebsite\Services\RepositoryServices\ArticleRepositoryServices;
use Ambax\ArticleWebsite\Services\RepositoryServices\CommentRepositoryService;
use Ambax\ArticleWebsite\Services\RepositoryServices\CommentRepositoryServices;
use Ambax\ArticleWebsite\Services\RepositoryServices\LikeRepositoryService;
use Ambax\ArticleWebsite\Services\RepositoryServices\LikeRepositoryServices;
use DI\ContainerBuilder;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;
use function DI\create;
use function DI\get;

return function()
{
    $containerBuilder = new ContainerBuilder();
    $containerBuilder->addDefinitions([
        LoggerInterface::class => function(): LoggerInterface 
        {
            $logger = new Logger('articleWebsite');
            $formatter = new LineFormatter(
                null,
                null,
                false,
                true
            );
            $streamHandler  = new StreamHandler('storage/Logs/articleWebsite.log', Logger::DEBUG);
            $streamHandler->setFormatter($formatter);
            $logger->pushHandler($streamHandler);
            return $logger;
        },
        Database::class => create(SQLite::class),
        LikeService::class => create(LikeService::class),
        ArticleRepositoryService::class =>
            create(ArticleRepositoryServices::class)->constructor(
                get(LoggerInterface::class),
                get(Database::class)
        ),
        CommentRepositoryService::class => create(
            CommentRepositoryServices::class)->constructor(
                get(LoggerInterface::class),
                get(Database::class)
        ),
        LikeRepositoryService::class => create(
            LikeRepositoryServices::class)->constructor(
                get(LoggerInterface::class),
                get(Database::class)
        )
    ]);
    return $containerBuilder->build();
};