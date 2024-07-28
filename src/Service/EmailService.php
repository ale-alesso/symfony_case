<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class EmailService
{
    public function __construct(
        private readonly MailerInterface $mailer,
        private readonly string$mailFrom
    ) {}

    public function sendOrderConfirmationEmail($order): void
    {
        $email = (new Email())
            ->from($this->mailFrom)
            ->to($order->getUser()->getEmail())
            ->subject('Order Confirmation')
            ->text('Your order has been created');

        $this->mailer->send($email);
    }
}
