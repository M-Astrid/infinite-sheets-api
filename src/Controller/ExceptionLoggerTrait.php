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

    protected function logException(\Throwable $exception): void
    {
        $this->logger->error($exception->getMessage(), $exception->getTrace());
    }
}
