<?php
class App {
    protected $controller = 'AuthController';
    protected $method = 'login';
    protected $params = [];

    public function __construct() {
    $url = $this->parseUrl();

    // ✅ Si no hay controlador en la URL, redirigir al dashboard si hay sesión
    if (empty($url)) {
        if (isset($_SESSION['user_id']) && isset($_SESSION['rol'])) {
            $rol = $_SESSION['rol'];
            header("Location: index.php?url=$rol/dashboard");
            exit;
        } else {
            // No hay sesión activa: ir al login
            $this->controller = 'AuthController';
            $this->method = 'login';
        }
    }

    // Cargar controlador si está especificado
    if (isset($url[0])) {
        $controllerName = ucfirst($url[0]) . 'Controller';
        if (file_exists('../app/controllers/' . $controllerName . '.php')) {
            $this->controller = $controllerName;
            unset($url[0]);
        }
    }

    require_once '../app/controllers/' . $this->controller . '.php';
    $this->controller = new $this->controller;

    if (isset($url[1]) && method_exists($this->controller, $url[1])) {
        $this->method = $url[1];
        unset($url[1]);
    }

    $this->params = $url ? array_values($url) : [];

    call_user_func_array([$this->controller, $this->method], $this->params);
}

    public function parseUrl() {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return [];
    }
}
?>
