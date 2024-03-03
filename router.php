<?php
//importando routes

class Router
{
    protected $routes = [];

    private function registerRoute($method, $uri, $controller)
    {
        $this->routes = [
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
        $this->registerRoute("GET", $uri, $controller);
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
    }
}
