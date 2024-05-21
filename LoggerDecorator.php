<?php
require_once 'Model.php';

class LoggerDecorator extends Model {
    protected $wrappedModel;

    public function __construct(Model $model) {
        $this->wrappedModel = $model;
    }

    public function save() {
        $this->log();
        $this->wrappedModel->save();
    }

    private function log() {
        // Логування даних моделі
        error_log(json_encode($this->wrappedModel->getData()));
    }
}
?>
