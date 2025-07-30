<?php
class App {
    protected $controller = "PageController"; // Default controller
    protected $method = "home";
    protected $params = [];

    public function __construct($routes) {

        $url = $this->parseUrl();
        $path = '/' . implode('/', $url);

        foreach ($routes as $route => $target) {
            // ✅ Escape '/' ให้ถูกต้อง
            $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([^/]+)', $route);
            $pattern = '#^' . $pattern . '$#'; // ใช้ # แทน / เพื่อป้องกันปัญหา escape

            if (preg_match($pattern, $path, $matches)) {
                array_shift($matches); // ตัด match แรกออก (full match)
                $this->controller = $target[0];
                $this->method = $target[1];
                $this->params = $matches;
                break;
            }
        }

        require_once "../app/controllers/" . $this->controller . ".php";
        $this->controller = new $this->controller;

        call_user_func_array([$this->controller, $this->method],  $this->params);
    }

    private function parseUrl() {
        $url = isset($_GET['url']) ? $_GET['url'] : trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), "/");

        $url = str_replace('public/', '', $url); // ลบ /public/ ออก

        return explode("/", filter_var(rtrim($url, "/"), FILTER_SANITIZE_URL));
    }
}
?>
