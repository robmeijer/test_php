<?php

namespace App\Checkout\Basket;

use App\Item;

class OrderLine
{
    /**
     * Order line item
     *
     * @var Item
     */
    protected $item;

    /**
     * Order line item unit price
     *
     * @var int
     */
    protected $unitPrice = 0;

    /**
     * Order line item quantity
     *
     * @var int
     */
    protected $quantity = 0;

    /**
     * Update order line with new item
     *
     * @param Item $item
     */
    public function updateLine(Item $item)
    {
        if (! $this->item) {
            $this->item = $item;
            $this->unitPrice = $item->price();
        }

        if ($this->validItem($item)) {
            $this->quantity++;
        }
    }

    /**
     * Apply promotions to order line
     *
     * @param array $orderLinePromotions
     * @return OrderLine
     */
    public function applyPromotions($orderLinePromotions)
    {
        foreach ($orderLinePromotions as $rule) {
            if (
                $this->item->productCode() == $rule->productCode() &&
                $this->quantity >= $rule->minimumQuantity()
            ) {
                $this->unitPrice = $rule->apply($this->unitPrice);
            }
        }

        return $this;
    }

    /**
     * Return the order line total
     *
     * @return int
     */
    public function total()
    {
        return $this->quantity * $this->unitPrice;
    }

    /**
     * Check that item is valid before adding to order line
     *
     * @param Item $item
     * @return bool
     */
    protected function validItem(Item $item)
    {
        return $this->item->productCode() === $item->productCode();
    }
}
