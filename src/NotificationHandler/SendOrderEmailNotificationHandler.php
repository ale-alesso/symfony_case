<?php

namespace App\NotificationHandler;

use App\Notifier\SendOrderEmailNotification;
use App\Service\EmailService;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class SendOrderEmailNotificationHandler
{
    public function __construct(private readonly EmailService $emailService)
    {}

    public function __invoke(SendOrderEmailNotification $message): void
    {
        $order = $message->getOrder();
        $this->emailService->sendOrderConfirmationEmail($order);
    }
}
