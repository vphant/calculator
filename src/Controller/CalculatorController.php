<?php

namespace App\Controller;

use App\Dto\CalculateRequestPayload;
use App\Exception\InvalidFormatException;
use App\Service\CalculatorService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class CalculatorController extends AbstractController
{
    public function __construct(
        private ValidatorInterface $validator,
        private CalculatorService $calculatorService
    ) {
    }

    /**
     * @Route("/calculate", methods={"POST"})
     * @ParamConverter(name="requestPayload", converter="json_converter")
     */
    public function calculate(CalculateRequestPayload $requestPayload): JsonResponse
    {
        $errors = $this->validator->validate($requestPayload);

        if ($errors->count() > 0) {
            throw new InvalidFormatException();
        }

        $result = $this->calculatorService->calculateResult($requestPayload->getInputValue());

        return new JsonResponse(['result' => $result]);
    }
}
