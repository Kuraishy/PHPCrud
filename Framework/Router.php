<?php
//importando routes
namespace Framework;

//import errorcontroller
use App\Controllers\ErrorController;

class Router
{
    protected $routes = [];

    /**
     * Add a new route
     *
     * @param string $method
     * @param string $uri
     * @param string $action
     * @return void
     */
    // private function registerRoute($method, $uri, $controller)
    private function registerRoute($method, $uri, $action)
    {

        //controler -> HomeController@index
        list($controller, $controllerMethod) = explode('@', $action); //[homeController,index]
        // inspectAndDie($arr);

        $this->routes[] = [ //agregando
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller,
            'controllerMethod' => $controllerMethod
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



    // /**
    //  * load error page 
    //  * @param int $httpCode
    //  * @return void
    //  *
    //  */
    // public function error($httpCode = 404)
    // {
    //     // http_response_code($httpCode);
    //     // loadView("error/{$httpCode}");

    //     exit;
    // }


    /**
     * Routing the request
     * 
     * @param string $uri
     * @param string $method
     * @return void
     */
    public function route($uri)
    {

        //obtenciuon del metodo
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route) {
            //split current URI into segments
            $uriSegments = explode('/', trim($uri, '/'));
            //split the routes URI into segments (todas las routes grabadas)
            $routesSegments = explode('/', trim($route['uri'], '/'));
            //comparando cada segmento
            $match = true;

            //Check if the number of segments matches and method matches
            if (count($uriSegments) === count($routesSegments) && strtoupper($route['method'] === $requestMethod)) {
                //son el mismo route y metodo
                $params = [];
                $match = true;
                //loopeando los segmentos
                for ($i = 0; $i < count($uriSegments); $i++) {
                    //if uri do not match and there is no param
                    if (
                        $routesSegments[$i] !== $uriSegments[$i] && !preg_match('/\{(.+?)\}/', $routesSegments[$i])
                    ) {
                        $match = false;
                        break;
                    }
                    //hay match. Checar el parametro y agregarlo al array
                    if (preg_match('/\{(.+?)\}/', $routesSegments[$i], $matches)) {
                        // inspectAndDie($matches[1]);
                        //agregando params (id)
                        $params[$matches[1]] = $uriSegments[$i];
                        // inspectAndDie($params);
                    }
                }

                //si hay match, redirecciona
                if ($match) {
                    //extract controller and controller method
                    $controller = 'App\\Controllers\\' . $route['controller'];
                    $controllerMethod = $route['controllerMethod'];
                    //instatiate the controller and call the method
                    $controllerInstance = new $controller();
                    $controllerInstance->$controllerMethod($params);
                    return;
                }
            }
        }


        ErrorController::notFound();
    }
}
