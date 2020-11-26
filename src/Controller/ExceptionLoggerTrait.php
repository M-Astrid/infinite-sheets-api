<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;

trait ExceptionLoggerTrait
{
    private LoggerInterface $logger;

    /** @required */
    public function setLogger(LoggerInterface $logger): void
    {
        $this->logger = $logger;
    }

    protected function logException(\Throwable $exception, string $user): void
    {
        $message = sprintf('[User]: %s, [Exception]: %s', $user, $exception->getMessage());
        $this->logger->error($message, $exception->getTrace());
    }
}
