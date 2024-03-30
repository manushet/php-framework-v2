<?php

namespace WFM;

class Router
{
    protected static array $routes = [];
    protected static array $route = [];

    
    protected static function toUpperCamelCase(string $name): string 
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $name))) ;
    }

    protected static function toLowerCamelCase(string $name): string 
    {
        return lcfirst(self::toUpperCamelCase($name));
    }  
    
    protected static function removeQueryString(string $url): string 
    {
        if ($url) {
            $params = explode('?', $url, 2);

            return rtrim($params[0], '/');
        }

        return $url;
    }     
    
    public static function add(string $regexp, array $route = [])
    {
        self::$routes[$regexp] = $route;
    }

    public static function getRoutes(): array
    {
        return self::$routes;
    }

    public static function getRoute(): array
    {
        return self::$route;
    }  
    
    public static function dispatch(string $url)
    {
        $url = self::removeQueryString($url);

        if (self::matchRoute($url)) {
            $controller = 'App\controllers\\' . self::$route['admin_prefix'] . self::$route['controller'] . 'Controller';

            if (class_exists($controller)) {
                
                /**
                 * @var Controller $controllerObject
                 */
                $controllerObject = new $controller(self::$route);
                $controllerObject->getModel();
                
                $action = self::toLowerCamelCase(self::$route['action']) . 'Action';

                if (method_exists($controllerObject, $action)) {
                    $controllerObject->$action();
                    $controllerObject->getView();
                } else {
                    throw new \Exception("Method {$action} of controller {$controller} does not exist", 404);
                }
            } else {
                throw new \Exception("Controller {$controller} does not exist", 404);
            }
        } else {
            throw new \Exception('Page not found', 404);
        }
    }

    public static function matchRoute(string $url): bool
    {
        foreach(self::$routes as $pattern => $route) {
            if (preg_match("/{$pattern}/i", $url, $matches)) {
                
                foreach($matches as $key => $value) {
                    if (is_string($key)) {
                        $route[$key] = $value;
                        //self::$route[]
                    }
                }                

                if (empty($route['controller'])) {
                    $route['action'] = 'Main';
                } else {
                    $route['controller'] = self::toUpperCamelCase($route['controller']);
                }

                if (empty($route['action'])) {
                    $route['action'] = 'index';
                } else {
                    $route['action'] = self::toLowerCamelCase($route['action']);
                }

                if (!isset($route['admin_prefix'])) {
                    $route['admin_prefix'] = '';
                } else {
                    $route['admin_prefix'] .= '\\';
                }

                self::$route = $route;

                return true;
            }
        }
        return false;
    }  
    
}