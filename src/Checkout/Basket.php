<?php

namespace App\Checkout;

use App\Checkout\Basket\OrderLine;
use App\Item;
use App\Promotion\PromotionalRules;

class Basket
{
    /**
     * Current basket total
     *
     * @var int
     */
    protected $total = 0;

    /**
     * Basket order lines
     *
     * @var array
     */
    protected $orderLines = [];

    /**
     * Create new basket with given items
     *
     * @param array $items
     * @return Basket
     */
    public static function withItems(array $items)
    {
        $basket = new self();

        $basket->addItems($items);

        return $basket;
    }

    /**
     * Return current basket total
     *
     * @return int
     */
    public function total()
    {
        return $this->total;
    }

    /**
     * Include promotions in basket
     *
     * @param PromotionalRules $promotionalRules
     * @return Basket
     */
    public function includePromotions(PromotionalRules $promotionalRules)
    {
        foreach ($this->orderLines as $productCode => $orderLine) {
            $orderLine->applyPromotions($promotionalRules->orderLinePromotions());
            $this->orderLines[$productCode] = $orderLine;
            $this->total += $orderLine->total();
        }

        $this->applyPromotions($promotionalRules->orderTotalPromotions());

        return $this;
    }

    /**
     * Apply promotions to basket total
     *
     * @param $orderTotalPromotions
     */
    public function applyPromotions($orderTotalPromotions)
    {
        foreach ($orderTotalPromotions as $rule) {
            $this->total = $rule->apply($this->total);
        }
    }

    /**
     * Add items to basket
     *
     * @param $items
     */
    protected function addItems($items)
    {
        foreach ($items as $item) {
            $this->addItem($item);
        }
    }

    /**
     * Add order line to basket
     *
     * @param Item $item
     */
    protected function addItem(Item $item)
    {
        if (! array_key_exists($item->productCode(), $this->orderLines)) {
            $this->orderLines[$item->productCode()] = new OrderLine();
        }

        $this->orderLines[$item->productCode()]->updateLine($item);
    }
}
