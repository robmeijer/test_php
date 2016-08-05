<?php

namespace App\Checkout;

use App\Checkout;
use App\Checkout\Contracts\CheckoutFactoryInterface;
use App\Checkout\Contracts\CheckoutInterface;
use App\Promotion\PromotionalRules;
use App\Promotion\Rule\OrderLineRule;
use App\Promotion\Rule\OrderTotalRule;

class CheckoutFactory implements CheckoutFactoryInterface
{

    /**
     * Create new checkout object
     *
     * @return CheckoutInterface
     */
    public static function create()
    {
        $promotionalRules = new PromotionalRules();

        $rule = new OrderLineRule('001', 2, 850);
        $promotionalRules->addRule($rule);

        $rule = new OrderTotalRule(6000, 0.9);
        $promotionalRules->addRule($rule);

        return new Checkout($promotionalRules);
    }
}
