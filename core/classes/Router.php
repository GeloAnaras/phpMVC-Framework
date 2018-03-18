<?php
require_once CLASSES_PATH."Route.php";

class Router{
    private $routes = [];
    private $activeRoute;

    private static $inst = NULL;

    private function __construct(){
        $this->activeRoute = new Route( URLROOT."404", [
            "controller"=>"404",
            "action"=>"index"
        ] );
    }

    public static function instance(){
        if( self::$inst == NULL ){
            self::$inst = new self();
        }
        return self::$inst;
    }

    public function addRoute(Route $route){
        $this->routes[] = $route;
    }

    private $components = NULL;

    private function parseUri(){
        if( $this->components != NULL ){
            return;
        }
        $uri = explode( "?", $_SERVER["REQUEST_URI"] )[0];
        $uri = trim( $uri, "/" );
        $this->components = explode( "/", $uri );
    }

    public function run(){
        $this->parseUri();
        foreach ( $this->routes as $route ){
            if( !$route->exec( $this->components ) ){
                continue;
            }
            $this->activeRoute = $route;
            echo $route->getParams( "controller" );
            return;
        }
        echo "NO";
    }
}
