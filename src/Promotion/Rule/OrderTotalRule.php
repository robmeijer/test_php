<?php

namespace App\Promotion\Rule;

use App\Promotion\Rule;

class OrderTotalRule extends Rule
{
    /**
     * Rule type
     */
    const RULE_TYPE = Rule::RULE_TYPE_TOTAL;

    /**
     * Minimum order total for rule to trigger
     *
     * @var int
     */
    protected $minimumTotal;

    /**
     * Adjustment to order total if rule is triggered
     *
     * @var int
     */
    protected $adjustedTotal;

    /**
     * @param $minimumTotal
     * @param $adjustedTotal
     */
    public function __construct($minimumTotal, $adjustedTotal)
    {
        $this->minimumTotal = $minimumTotal;
        $this->adjustedTotal = $adjustedTotal;
    }


    /**
     * Apply promotion rule
     *
     * @param $total
     * @return int
     */
    public function apply($total)
    {
        if ($total >= $this->minimumTotal) {
            return ceil($total * $this->adjustedTotal);
        }

        return $total;
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
}
