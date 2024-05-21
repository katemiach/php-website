<?php
require_once 'PriceCalculationStrategy.php';

class SimplePriceCalculationStrategy implements PriceCalculationStrategy {
    public function calculatePrice($price) {
        return $price; // Без знижки
    }
}
?>
