<?php

namespace App\Promotion;

class PromotionalRules
{
    /**
     * All promotional rules
     *
     * @var array
     */
    protected $rules = [
        Rule::RULE_TYPE_LINE => [],
        Rule::RULE_TYPE_TOTAL => [],
    ];

    /**
     * Add rule to promotional rules
     *
     * @param Rule $rule
     */
    public function addRule(Rule $rule)
    {
        if ($rule->type() == Rule::RULE_TYPE_LINE) {
            $this->rules[Rule::RULE_TYPE_LINE][] = $rule;
        } elseif ($rule->type() == Rule::RULE_TYPE_TOTAL) {
            $this->rules[Rule::RULE_TYPE_TOTAL][] = $rule;
        }
    }

    /**
     * Return order line promotion rules
     *
     * @return array
     */
    public function orderLinePromotions()
    {
        return $this->rules[Rule::RULE_TYPE_LINE];
    }

    /**
     * Return order total promotion rules
     *
     * @return array
     */
    public function orderTotalPromotions()
    {
        return $this->rules[Rule::RULE_TYPE_TOTAL];
    }
}
