<?php
require_once 'PriceCalculationStrategy.php';

class PriceCalculator {
    private $strategy;

    public function __construct(PriceCalculationStrategy $strategy) {
        $this->strategy = $strategy;
    }

    public function calculate($price) {
        return $this->strategy->calculatePrice($price);
    }
}
?>
