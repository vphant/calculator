<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();

        if ($exception instanceof \DivisionByZeroError) {
            $response = new JsonResponse(
                ['message' => 'Division by zero'],
                Response::HTTP_BAD_REQUEST
            );

            $event->setResponse($response);
        }
    }
}
