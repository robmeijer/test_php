<?php

namespace Babylon\App;

/**
 * Checkout object responsible for scanning of
 * items and calculation of total price of basket
 */
interface CheckoutInterface
{
    /**
     * Create new checkout instance based on promotional rules
     *
     * @param object $promotionalRules
     */
    public function __construct($promotionalRules);

    /**
     * Scan new item
     *
     * @param object $item
     */
    public function scan($item);

    /**
     * Calculate total price of the basket including promotions
     *
     * @return float
     */
    public function total();
}
