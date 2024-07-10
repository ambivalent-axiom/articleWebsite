<?php
namespace Ambax\ArticleWebsite\Services\RepositoryServices;
use Ambax\ArticleWebsite\Models\Model;

interface LikeRepositoryService
{
    public function fetchAll(string $origin, string $originId);
    public function fetchOne(string $id);
    public function create(Model $data);
    public function delete(string $id);
}