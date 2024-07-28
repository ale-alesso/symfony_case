<?php

namespace App\Controller;

use App\Repository\OrderItemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class OrderItemController extends AbstractController
{
    public function __construct(private readonly OrderItemRepository $orderItemRepository)
    {}

    #[Route('/order/{orderId}/items', name: 'order_items', methods: ['GET'])]
    public function getOrderItems(int $orderId): JsonResponse
    {
        $orderItems = $this->orderItemRepository->findByOrderId($orderId);

        return new JsonResponse($orderItems);
    }

    #[Route('/product/{productId}/order-items', name: 'product_order_items', methods: ['GET'])]
    public function getProductOrderItems(int $productId): JsonResponse
    {
        $orderItems = $this->orderItemRepository->findByProductId($productId);

        return new JsonResponse($orderItems);
    }

    #[Route('/order/{orderId}/product/{productId}/items', name: 'order_product_items', methods: ['GET'])]
    public function getOrderItemsByProduct(int $orderId, int $productId): JsonResponse
    {
        $orderItems = $this->orderItemRepository->findByOrderIdAndProductId($orderId, $productId);

        return new JsonResponse($orderItems);
    }
}
