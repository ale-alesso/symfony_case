<?php

namespace App\Repository;

use App\Entity\OrderItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OrderItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderItem[]    findAll()
 * @method OrderItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderItem::class);
    }

    /**
     * Find order items by order ID.
     *
     * @param int $orderId
     * @return OrderItem[]
     */
    public function findByOrderId(int $orderId): array
    {
        return $this->createQueryBuilder('oi')
            ->andWhere('oi.order = :orderId')
            ->setParameter('orderId', $orderId)
            ->orderBy('oi.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Find order items by product ID.
     *
     * @param int $productId
     * @return OrderItem[]
     */
    public function findByProductId(int $productId): array
    {
        return $this->createQueryBuilder('oi')
            ->andWhere('oi.product = :productId')
            ->setParameter('productId', $productId)
            ->orderBy('oi.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Find order items by order ID and product ID.
     *
     * @param int $orderId
     * @param int $productId
     * @return OrderItem[]
     */
    public function findByOrderIdAndProductId(int $orderId, int $productId): array
    {
        return $this->createQueryBuilder('oi')
            ->andWhere('oi.order = :orderId')
            ->andWhere('oi.product = :productId')
            ->setParameter('orderId', $orderId)
            ->setParameter('productId', $productId)
            ->orderBy('oi.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
