<?php

namespace App\Controller;

use App\Exception\ProductNotFoundException;
use App\Service\OrderService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Exception;

class OrderController extends Controller
{
    public function __construct(
        private readonly OrderService $orderService
    ) {}

    #[Route('/order/{id}', name: 'get_order', methods: ['GET'])]
    public function getOrder(int $id): JsonResponse
    {
        $order = $this->orderService->getOrderById($id);

        if (!$order) {
            return new JsonResponse(['error' => 'Order not found'], 404);
        }

        return new JsonResponse($order);
    }

    #[Route('/order', name: 'create_order', methods: ['POST'])]
    public function createOrder(Request $request): JsonResponse
    {
        // todo add validation
        $data = json_decode($request->getContent(), true);

        try {
            $order = $this->orderService->createOrder($data);

            return new JsonResponse($order, JsonResponse::HTTP_CREATED);
        } catch (ProductNotFoundException $e) {
            return new JsonResponse(['error' => $e->getMessage()], JsonResponse::HTTP_NOT_FOUND);
        } catch (ExceptionInterface|Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], JsonResponse::HTTP_BAD_REQUEST);
        }
    }
}
