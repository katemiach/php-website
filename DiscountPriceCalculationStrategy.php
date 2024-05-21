<?php
require_once 'PriceCalculationStrategy.php';

class DiscountPriceCalculationStrategy implements PriceCalculationStrategy {
    public function calculatePrice($price) {
        return $price * 0.9; // Знижка 10%
    }
}
?>
