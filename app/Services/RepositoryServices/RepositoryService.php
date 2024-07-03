<?php
namespace Ambax\articleWebsite\Services\RepositoryServices;
use Model;

interface RepositoryService
{
    public function fetchAll();
    public function fetchOne(string $id);
    public function create(Model $data);
    public function update(array $data);
    public function delete(string $id);

}