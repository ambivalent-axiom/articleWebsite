<?php
namespace Ambax\ArticleWebsite\Exceptions;
use Exception;

class ShowToUserException extends Exception
{
    public function errorMessage()
    {
        return $this->message;
    }
}