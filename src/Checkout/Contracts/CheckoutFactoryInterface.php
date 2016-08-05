<?php

namespace App\Checkout\Contracts;

/**
 * Factory which is responsible for the
 * creation of the new checkout object
 */
interface CheckoutFactoryInterface
{
    /**
     * Create new checkout object
     *
     * @return CheckoutInterface
     */
    public static function create();
}
