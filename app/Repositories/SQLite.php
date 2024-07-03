<?php
namespace Ambax\articleWebsite\Repositories;
use Medoo\Medoo;

class SQLite implements Database
{
    public const DB_DIR = "storage/";
    public function set()
    {
        return new Medoo(
            [
                'type' => 'sqlite',
                'database' => '/storage/db.sqlite'
            ]
        );
    }
}