<?php

namespace App\Notifier;

use App\Entity\Order;

class SendOrderEmailNotification
{
    public function __construct(private readonly Order $order)
    {}

    public function getOrder(): Order
    {
        return $this->order;
    }
}
