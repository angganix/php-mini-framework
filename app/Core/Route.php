<?php

namespace App\Core;

use App\Core\Request;

class Route {

   private static $routes = [];

   public static function add($path, $controller, $method = "GET")
   {
      $controllerAction = explode("@", $controller);
      $controllerClass = $controllerAction[0];
      $controllerMethod = $controllerAction[1];
      
      self::$routes[] = [
         "path"         => $path,
         "controller"   => $controllerClass,
         "action"       => $controllerMethod,
         "method"       => $method
      ];
   }

   public static function dispatch()
   {
      $request = $_SERVER['REQUEST_URI'];
      $request = explode("?", $request)[0];

      $current_route = array_values(
         array_filter(self::$routes, function($route) use ($request) {
            return $request === $route['path'];
         })
      )[0];

      if ($current_route) {
         $string_class = "App\\Controllers\\{$current_route['controller']}";
         
         if (class_exists($string_class)) {
            $object_class = new $string_class();
            
            if (method_exists($object_class, $current_route['action'])) {
               $requestObject = new Request();
               $object_class->{$current_route['action']}($requestObject);
            } else {
               echo "Method {$current_route['action']} not exist on class {$current_route['controller']}";
            }

         } else {
            echo "Class {$current_route['controller']} Doesn\'t Exists!";
         }
      } else {
         echo "Not Found!";
      }
   }

}