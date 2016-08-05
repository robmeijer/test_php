<?php

namespace App;

class Item
{
    /**
     * @var string
     */
    protected $productCode;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var int
     */
    protected $price;

    /**
     * @param string $productCode
     * @param string $name
     * @param int $price
     */
    public function __construct($productCode, $name, $price)
    {
        $this->productCode = $productCode;
        $this->name = $name;
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function productCode()
    {
        return $this->productCode;
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function price()
    {
        return $this->price;
    }

    /**
     * Format price for display
     *
     * @return string
     */
    public function formattedPrice()
    {
        $price = $this->price / 100;

        $formatter = new \NumberFormatter('en_GB', \NumberFormatter::CURRENCY);

        return $formatter->formatCurrency($price, 'GBP');
    }
}
