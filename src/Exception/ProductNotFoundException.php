<?php

namespace App\Exception;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductNotFoundException extends NotFoundHttpException
{
    public function __construct($message = 'Product not found', \Exception $previous = null, int $code = 0)
    {
        parent::__construct($message, $previous, $code);
    }
}
