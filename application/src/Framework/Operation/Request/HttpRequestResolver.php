<?php

declare(strict_types=1);

namespace App\Framework\Operation\Request;

use Generator;
use ReflectionClass;
use ReflectionException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Validator\Exception\ValidatorException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class HttpRequestResolver implements ValueResolverInterface
{
    public function __construct(
        private readonly DenormalizerInterface  $denormalizer,
        private readonly ValidatorInterface $validator
    )
    {
    }

    /**
     * @throws ReflectionException
     */
    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        $reflection = new ReflectionClass($argument->getType());

        return $reflection->implementsInterface(RequestInterface::class);
    }

    /**
     * @inheritDoc
     */
    public function resolve(Request $request, ArgumentMetadata $argument): Generator
    {
        $class = $argument->getType();

        if (
            in_array($request->getMethod(), ["POST", "PUT"])
            && 0 === strpos($request->headers->get('Content-Type'), 'application/json')
        ) {
            $data = json_decode($request->getContent(), true);
            $request->request->replace(is_array($data) ? $data : []);
        }

        $requestClass = $this->denormalizer->denormalize($request->toArray(), $class);

        $errors = $this->validator->validate($requestClass);
        if (count($errors) > 0) {
            $error = $errors[0];
            throw new ValidatorException($error->getMessage());
        }

        yield $requestClass;
    }
}
