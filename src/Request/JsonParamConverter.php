<?php

namespace App\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;

final class JsonParamConverter implements ParamConverterInterface
{
    public function __construct(private SerializerInterface $serializer)
    {
    }

    public function apply(Request $request, ParamConverter $configuration): bool
    {
        $data = $this->serializer->deserialize($request->getContent(), $configuration->getClass(), 'json');
        $request->attributes->set($configuration->getName(), $data);

        return true;
    }

    public function supports(ParamConverter $configuration): bool
    {
        return 'json_converter' === $configuration->getConverter();
    }
}
