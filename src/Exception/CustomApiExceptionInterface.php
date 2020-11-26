<?php

namespace App\Exception;

use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

interface CustomApiExceptionInterface extends HttpExceptionInterface
{
    public function getTitle(): string;

    public function getDetail(): string;

    public function getErrors(): array;
}