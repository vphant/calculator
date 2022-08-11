<?php

namespace App\EventListener;

use App\Exception\InvalidFormatException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();

        if ($exception instanceof \DivisionByZeroError) {
            $event->setResponse($this->createErrorJsonResponse('Division by zero'));
        }

        if ($exception instanceof InvalidFormatException) {
            $event->setResponse($this->createErrorJsonResponse('Invalid format'));
        }
    }

    private function createErrorJsonResponse(string $message): JsonResponse
    {
        return new JsonResponse(
            ['message' => $message],
            Response::HTTP_BAD_REQUEST
        );
    }
}
