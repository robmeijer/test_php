<?php

namespace App\Promotion\Rule;

use App\Promotion\Rule;

class OrderLineRule extends Rule
{
    /**
     * Rule type
     */
    const RULE_TYPE = Rule::RULE_TYPE_LINE;

    /**
     * Product code which rule applies to
     *
     * @var string
     */
    protected $productCode;

    /**
     * Minimum quantity of item for rule to trigger
     *
     * @var int
     */
    protected $minimumQuantity;

    /**
     * Adjusted unit price if rule is triggered
     *
     * @var int
     */
    protected $adjustedUnitPrice;

    /**
     * @param string $productCode
     * @param int $minimumQuantity
     * @param int $adjustedUnitPrice
     */
    public function __construct($productCode, $minimumQuantity, $adjustedUnitPrice)
    {
        $this->productCode = $productCode;
        $this->minimumQuantity = $minimumQuantity;
        $this->adjustedUnitPrice = $adjustedUnitPrice;
    }

    /**
     * Apply promotion rule
     * @param $value
     * @return int
     */
    public function apply($value)
    {
        return $this->adjustedUnitPrice;
    }

    /**
     * Return promotion rule type
     *
     * @return string
     */
    public function type()
    {
        return self::RULE_TYPE;
    }

    /**
     * Return product code which rule applies to
     *
     * @return string
     */
    public function productCode()
    {
        return $this->productCode;
    }

    /**
     * Return minimum quantity of item for rule to trigger
     *
     * @return int
     */
    public function minimumQuantity()
    {
        return $this->minimumQuantity;
    }
}
