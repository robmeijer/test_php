<?php

namespace App\Promotion;

abstract class Rule
{
    /**
     * Rule Type for Order Total rules
     */
    const RULE_TYPE_TOTAL = 'total';

    /**
     * Rule Type for Order Line rules
     */
    const RULE_TYPE_LINE = 'line';

    /**
     * Apply promotion rule
     *
     * @param $value
     * @return int
     */
    abstract public function apply($value);

    /**
     * Return promotion rule type
     *
     * @return string
     */
    abstract public function type();
}
