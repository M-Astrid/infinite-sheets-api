<?php

namespace App\Exception;

use Symfony\Component\HttpFoundation\Response;

class CustomApiException extends \Exception implements CustomApiExceptionInterface
{
    protected int    $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
    protected array  $headers    = ['Content-Type' => 'application/problem+json'];

    protected string         $title  = '';
    protected array          $errors = [];

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDetail(): string
    {
        return $this->message;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}