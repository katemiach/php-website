<?php
class Router {
    private static $instance;
    private $routes = [];

    private function __construct() {}

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Router();
        }
        return self::$instance;
    }

    public function addRoute($route, $callback) {
        $this->routes[$route] = $callback;
    }

    public function route($request) {
        foreach ($this->routes as $route => $callback) {
            if (rtrim($route, '/') == rtrim($request, '/')) {
                call_user_func($callback);
                return;
            }
        }
        echo "Маршрут для $request не знайдено";
    }
}
?>
