<?php

declare(strict_types=1);

namespace App\Framework\UI;

use App\Framework\Domain\Exception\BaseException;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ApiExceptionListener
{
    const DEFAULT_STATUS = 500;
    private ContainerBagInterface $containerBag;

    /**
     * ApiExceptionListener constructor.
     * @param ContainerBagInterface $containerBag
     */
    public function __construct(ContainerBagInterface $containerBag)
    {
        $this->containerBag = $containerBag;
    }

    /**
     * @param ExceptionEvent $event
     */
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        if ($exception instanceof BaseException) {
            $response = new JsonResponse($this->response($exception));
            $response->setStatusCode($exception->getCode());
            $event->setResponse($response);
        } elseif (!$this->containerBag->get('kernel.debug')) {
            $response = new JsonResponse([
                'error' => ['message' => 'Server Error'],
            ]);
            $response->setStatusCode(self::DEFAULT_STATUS);
            $event->setResponse($response);
        }
    }

    private function response(BaseException $exception): array
    {
        return [
            'error' => $exception->getMessage(),
        ];
    }

}
