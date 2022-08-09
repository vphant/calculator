<?php

namespace App\Controller;

use App\Dto\CalculateRequestPayload;
use App\Service\CalculatorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class CalculatorController extends AbstractController
{
    public function __construct(
        private SerializerInterface $serializer,
        private ValidatorInterface $validator,
        private CalculatorService $calculatorService
    ) {
    }

    /**
     * @Route("/calculate", methods={"POST"})
     */
    public function calculate(Request $request): JsonResponse
    {
        /** @var CalculateRequestPayload $requestPayload */
        $requestPayload = $this->serializer->deserialize(
            $request->getContent(),
            CalculateRequestPayload::class,
            'json',
        );

        $errors = $this->validator->validate($requestPayload);

        if ($errors->count() > 0) {
            return new JsonResponse(
                ['message' => 'Invalid format'],
                Response::HTTP_BAD_REQUEST
            );
        }

        $result = $this->calculatorService->calculateResult($requestPayload->getInputValue());

        return new JsonResponse(['result' => $result]);
    }
}
