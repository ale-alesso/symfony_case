<?php

namespace App\Service;

use App\Repository\OrderItemRepository;

class OrderItemService
{
    private $orderItemRepository;

    public function __construct(OrderItemRepository $orderItemRepository)
    {
        $this->orderItemRepository = $orderItemRepository;
    }

    public function getItemsByOrder(int $orderId)
    {
        return $this->orderItemRepository->findByOrderId($orderId);
    }

    public function getItemsByProduct(int $productId)
    {
        return $this->orderItemRepository->findByProductId($productId);
    }

    public function getItemsByOrderAndProduct(int $orderId, int $productId)
    {
        return $this->orderItemRepository->findByOrderIdAndProductId($orderId, $productId);
    }
}
