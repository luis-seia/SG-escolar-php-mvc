<?php 

class App {

    // default values
    protected $controller = 'Home';
    protected $method = 'index';
    protected $page404 = false;
    protected $params = [];

    public function __construct() {
        $url = $this->parseUrl();

        $this->getControllerFromUrl($url);
        $this->getMethodFromUrl($url);
        $this->getParamsFromUrl($url);

        // Chama um método de uma classe passando os parâmetros
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    private function parseUrl() {
        if(isset($_GET["url"])) {
            $url = rtrim($_GET["url"], "/"); // eliminate white spaces and slash at the end
            $url = filter_var($url, FILTER_SANITIZE_URL); // sanitize (limpar)
            $url = explode("/", $url); // separate by forward slash (/)
            return $url;
        }
    }

    private function getControllerFromUrl($url) {
        if (!empty($url[0]) && isset($url[0])) {
            if (file_exists("../app/controllers/" . ucfirst($url[0]) . ".php") ) {
                $this->controller = ucfirst($url[0]);
            } else {
                $this->page404 = true;
                $this->method = "pageNotFound";
            }
        }

        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller();
    }

    private function getMethodFromUrl($url) {
        if (!empty($url[1]) && isset($url[1]) ) {
            if (method_exists($this->controller, $url[1]) && !$this->page404) {
                $this->method = $url[1];
            } else {
                // caso a classe ou o método informado não exista, o método pageNotFound
                // do Controller é chamado.
                $this->method = "pageNotFound";
            }
        }
    }

    private function getParamsFromUrl($url) {
        if ($url && count($url) > 2) {
            $this->params = array_slice($url, 2);
        }
    }
}