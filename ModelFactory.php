<?php
require_once 'ProductModel.php';
require_once 'UserModel.php';

class ModelFactory {
    public static function createModel($type) {
        switch ($type) {
            case 'product':
                return new ProductModel();
            case 'user':
                return new UserModel();
            default:
                throw new Exception("Тип моделі не знайдено.");
        }
    }
}
?>
