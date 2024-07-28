<?php

namespace App\Service;

use App\Entity\Order;
use App\Entity\OrderItem;
use App\Event\OrderCreatedEvent;
use App\Exception\ProductNotFoundException;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

class OrderService
{
    public function __construct(
        private readonly OrderRepository $orderRepository,
        private readonly ProductRepository $productRepository,
        private readonly EntityManagerInterface $entityManager,
        private readonly DenormalizerInterface $denormalizer,
        private readonly EventDispatcherInterface $eventDispatcher,
    ) {}

    public function getOrderById(int $id): ?Order
    {
        return $this->orderRepository->find($id);
    }

    /**
     * @param array $data
     * @return Order|null
     * @throws ExceptionInterface
     */
    public function createOrder(array $data): ?Order
    {
        $order = $this->denormalizer->denormalize($data, Order::class);
        $order->setCreatedAt(new \DateTime());

        // todo denormalize items to embed collection
        foreach ($data['items'] as $itemData) {
            $product = $this->productRepository->find($itemData['productId']);
            if (!$product) {
                throw new ProductNotFoundException(sprintf('Product with ID %d not found', $itemData['productId']));
            }

            $orderItem = $this->denormalizer->denormalize($itemData, OrderItem::class);
            $orderItem->setProduct($product)
                ->setOrder($order);

            $order->addItem($orderItem);
        }

        $this->entityManager->persist($order);
        $this->entityManager->flush();

        $this->eventDispatcher->dispatch(new OrderCreatedEvent($order));

        return $order;
    }
}
