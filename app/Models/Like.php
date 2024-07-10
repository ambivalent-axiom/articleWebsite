<?php
namespace Ambax\ArticleWebsite\Models;
class Like implements Model
{
    private string $id;
    private string $originId;
    private string $origin;
    private string $timestamp;

    public function __construct(
        string $id,
        string $originId,
        string $origin,
        string $timestamp
    )
    {
        $this->id = $id;
        $this->originId = $originId;
        $this->origin = $origin;
        $this->timestamp = $timestamp;
    }
    public function __invoke()
    {
        return [
            'id' => $this->id,
            'originId' => $this->originId,
            'origin' => $this->origin,
            'timestamp' => $this->timestamp,
        ];
    }
    public function getId()
    {
        return $this->id;
    }
    public function getOriginId()
    {
        return $this->originId;
    }
    public function getOrigin()
    {
        return $this->origin;
    }
    public function getTimestamp()
    {
        return $this->timestamp;
    }
}