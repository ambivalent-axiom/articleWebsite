<?php
namespace Ambax\ArticleWebsite\Services\RepositoryServices;
use Ambax\ArticleWebsite\Models\Model;

interface ArticleRepositoryService
{
    public function fetchAll();
    public function fetchOne(string $id);
    public function create(Model $data);
    public function update(Model $data);
    public function delete(string $id);
}