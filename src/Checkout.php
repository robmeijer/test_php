<?php

namespace App;

use App\Checkout\Basket;
use App\Checkout\Contracts\CheckoutInterface;
use App\Promotion\PromotionalRules;

class Checkout implements CheckoutInterface
{
    /**
     * Items scanned during checkout
     *
     * @var array
     */
    protected $items = [];

    /**
     * Promotional rules applied at checkout
     *
     * @var PromotionalRules
     */
    protected $promotionalRules;

    /**
     * Create new checkout instance based on promotional rules
     *
     * @param PromotionalRules $promotionalRules
     */
    public function __construct($promotionalRules)
    {
        $this->promotionalRules = $promotionalRules;
    }

    /**
     * Scan new item
     *
     * @param Item $item
     */
    public function scan($item)
    {
        $this->items[] = $item;
    }

    /**
     * Calculate total price of the basket including promotions
     * Returns price string in the £X.XX format
     *
     * @return string
     */
    public function total()
    {
        $basket = Basket::withItems($this->items)->includePromotions($this->promotionalRules);

        return $this->formattedTotal($basket->total());
    }

    /**
     * Format the checkout total
     *
     * @param $total
     * @return string
     */
    protected function formattedTotal($total)
    {
        $total = $total / 100;

        $formatter = new \NumberFormatter('en_GB', \NumberFormatter::CURRENCY);

        return $formatter->formatCurrency($total, 'GBP');
    }
}
