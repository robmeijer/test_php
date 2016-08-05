<?php

namespace Tests\App;

use App\Checkout\CheckoutFactory;
use App\Item;

class CheckoutTest extends \PHPUnit_Framework_TestCase
{
    public function testOrderTotalDiscount()
    {
        $checkout = CheckoutFactory::create();

        $item = new Item('001', 'Lavender heart', 925);
        $checkout->scan($item);

        $item = new Item('002', 'Personalised cufflinks', 4500);
        $checkout->scan($item);

        $item = new Item('003', 'Kids T-shirt', 1995);
        $checkout->scan($item);

        $this->assertEquals('£66.78', $checkout->total());
    }

    public function testOrderLineDiscount()
    {
        $checkout = CheckoutFactory::create();

        $item = new Item('001', 'Lavender heart', 925);
        $checkout->scan($item);

        $item = new Item('003', 'Kids T-shirt', 1995);
        $checkout->scan($item);

        $item = new Item('001', 'Lavender heart', 925);
        $checkout->scan($item);

        $this->assertEquals('£36.95', $checkout->total());
    }

    public function testOrderLineAndOrderTotalDiscount()
    {
        $checkout = CheckoutFactory::create();

        $item = new Item('001', 'Lavender heart', 925);
        $checkout->scan($item);

        $item = new Item('002', 'Personalised cufflinks', 4500);
        $checkout->scan($item);

        $item = new Item('003', 'Kids T-shirt', 1995);
        $checkout->scan($item);

        $item = new Item('001', 'Lavender heart', 925);
        $checkout->scan($item);

        $this->assertEquals('£73.76', $checkout->total());
    }
}
