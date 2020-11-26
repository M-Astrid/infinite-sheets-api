<?php

namespace App\EventListener;

use App\Controller\ExceptionLoggerTrait;
use App\Exception\CustomApiExceptionInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ExceptionListener
{
    use ExceptionLoggerTrait;

    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();

        if ($exception instanceof CustomApiExceptionInterface) {
            $content = [
                'status' => $exception->getStatusCode(),
                'title'  => $exception->getTitle(),
                'detail' => $exception->getDetail(),
                'errors' => $exception->getErrors(),
            ];
        } else {
            $content = [
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'title'  => 'Unexpected error.',
                'detail' => 'An error occurred while handling request.',
            ];
        }

        $response = new JsonResponse($content);

        if ($exception instanceof HttpExceptionInterface) {
            $response->setStatusCode($exception->getStatusCode());
            $response->headers->replace($exception->getHeaders());
        } else {
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $event->setResponse($response);

        $this->logException($event->getThrowable(), $event->getRequest()->getUser());
    }
}