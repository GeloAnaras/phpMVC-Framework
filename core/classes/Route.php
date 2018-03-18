<?php
class Route{
    private $components = [];
    private $controller = NULL;
    private $action = NULL;
    private $params = [];

    public function __construct( $pattern, $paramsDefault = [] ){
        $this->components = explode( "/", trim($pattern,"/"));
        $this->controller = strtolower( @$paramsDefault["controller"] );
        $this->action = strtolower( @$paramsDefault["action"] );
        $this->params = $paramsDefault;
    }

    const PARAM_REGEXP = "/\{\??([a-z][a-z0-9]*)\}/i";
    const OPTIONAL_PARAM_REGEXP = "/\{\?([a-z][a-z0-9]*)\}/i";

    private function isParam($name,$value){
        $value = strtolower($value);

        if( !preg_match( self::PARAM_REGEXP, $name, $paramMatch ) ){

            return false;
        }

        $param = $paramMatch[1];

        if( $param == "controller" ){
            $this->controller = $value;
        } else if ( $param == "action" ){
            $this->action = $value;
        }
        else{
            $this->params[$param] = $value;
        }
        return true;
    }

    private function isTmpParam($name){
        return preg_match( self::OPTIONAL_PARAM_REGEXP, $name );
    }

    public function exec(array $realRouteComponents){
        if( $realRouteComponents[0] == "" && $this->components[0] == "" ){
            return true;
        }
        $countComponents = count($this->components);

        if( count($realRouteComponents) > $countComponents ){

            return false;
        }

        for( $i=0; $i<$countComponents; $i++ ){
            if( empty( $realRouteComponents[$i] ) && $this->isTmpParam( $this->components[$i] ) ){
                return true;
            }
            if( empty( $realRouteComponents[$i]) ){
                return false;
            }
            if( $this->isParam( $this->components[$i], $realRouteComponents[$i] ) ){
                continue;
            }
            if( $this->components[$i] != $realRouteComponents[$i] ){

                return false;
            }
        }
        return true;
    }

    public function getController(){
        return $this->controller;
    }

    public function getAction(){
        return $this->action;
    }

    public function getParams($name){
        return @$this->params[$name];
    }
}