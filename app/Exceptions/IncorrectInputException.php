<?php
namespace Ambax\ArticleWebsite\Exceptions;
use Exception;

class IncorrectInputException extends Exception
{
    public function errorMessage()
    {
        return $this->message;
    }
}
