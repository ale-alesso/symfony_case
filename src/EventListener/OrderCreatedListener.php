<?php

namespace App\EventListener;

use App\Event\OrderCreatedEvent;
use App\Notifier\SendOrderEmailNotification;
use Symfony\Component\Messenger\MessageBusInterface;

class OrderCreatedListener
{
    public function __construct(
        private readonly MessageBusInterface $messageBus
    ) {}

    public function onOrderCreated(OrderCreatedEvent $event): void
    {
        $order = $event->getOrder();
        $this->messageBus->dispatch(new SendOrderEmailNotification($order));
    }
}
