<?php
class Controller {
    protected $model;
    protected $view;

    public function __construct($model, $view) {
        $this->model = $model;
        $this->view = $view;
    }

    public function handleRequest() {
        // Логіка обробки запиту
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST['data'] ?? 'Немає даних';
            $this->model->setData($data);
        } else {
            $this->model->setData("Це дані продукту");
        }
    }
}
?>