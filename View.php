<?php
class View {
    protected $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function render() {
        // Відображення представлення
        echo $this->model->getData();
    }
}
?>
