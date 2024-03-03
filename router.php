<?php
//importando routes

class Router
{
    protected $routes = [];

    /**
     * Add a new route
     *
     * @param string $method
     * @param string $uri
     * @param string $controller
     * @return void
     */
    private function registerRoute($method, $uri, $controller)
    {
        $this->routes[] = [ //agregando
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller,
        ];
    }


    /**
     * Adding a Get Rout
     * 
     * @param string $uri
     *@param string $controller
     * @return void
     */
    public function get($uri, $controller)
    {
        $this->registerRoute('GET', $uri, $controller);
    }

    /**
     * Adding a POST Rout
     * 
     * @param string $uri
     *@param string $controller
     * @return void
     */
    public function post($uri, $controller)
    {
        $this->registerRoute("POST", $uri, $controller);
    }

    /**
     * Adding a POST Rout
     * 
     * @param string $uri
     *@param string $controller
     * @return void
     */
    public function put($uri, $controller)
    {
        $this->registerRoute("PUT", $uri, $controller);
    }

    /**
     * Adding a DELETE Rout
     * 
     * @param string $uri
     *@param string $controller
     * @return void
     */
    public function delete($uri, $controller)
    {
        $this->registerRoute("DELETE", $uri, $controller);
    }



    /**
     * load error page 
     * @param int $httpCode
     * @return void
     *
     */
    public function error($httpCode = 404)
    {
        http_response_code($httpCode);
        loadView("error/{$httpCode}");
        exit;
    }

    /**
     * Routing the request
     * 
     * @param string $uri
     * @param string $method
     * @return void
     */
    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            //si el uri y metodo concuerda con lo que tenemo
            if ($route['uri'] === $uri && $route['method'] === $method) {
                //imopta el controlador queirdo y lo pasa al siguiente archivo
                require basePath($route['controller']);
                return;
            }
        }
        //envia el fallo y su view
        $this->error();
        exit; //sale del script
    }
}
