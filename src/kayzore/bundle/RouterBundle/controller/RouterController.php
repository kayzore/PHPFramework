<?php

namespace kayzore\bundle\RouterBundle\controller;

use app\AppKernel;
use kayzore\bundle\RouterBundle\model\Router;

class RouterController
{
    private $router;
    private $controller;

    /**
     * Start routes, controller and PDO
     */
    public function __construct() {
        $appKernel = new AppKernel();

        $registerController = $appKernel->registerController();
        foreach ($registerController as $name => $controller) {
            $this->controller[$name] = $controller;
        }

        $this->router = new Router($_GET['url']);
        $this->routes();
        $this->start();
    }

    /**
     * Lance le système de route
     */
    private function start() {
        $this->router->run();
    }

    /**
     * Liste les routes
     *
     * Exemple :
     * $this->router->get('/', function(){
     *      $this->controller->test();
     *      $this->showView($arrayPath);
     * });
     * $this->router->get('/posts/:id/:name', function($id, $name){
     *      $this->controller->test($id, $name);
     *      $this->showView($arrayPath);
     * });
     *
     */
    private function routes() {
        require_once DIR_CONFIG . 'routing.php';
    }
}