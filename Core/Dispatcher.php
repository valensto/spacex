<?php

namespace Core;

class Dispatcher
{
    public function dispatch($infos, $params)
    {
        $controller = $infos['controller'];
        $controller = $this->toPascalCase($controller);
        $controller = $this->getNamespace($infos) . $controller;

        if (class_exists($controller)) {
            $controller_object = new $controller($params);

            $action = $infos['action'];
            $action = $this->toCamelCase($action);

            if (is_callable([$controller_object, $action])) {
                $controller_object->$action();
            } else {
                echo "Method $action (in controller $controller) not found";
            }
        } else {
            echo "Controller class $controller not found";
        }
    }

    protected function toPascalCase($string)
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    }


    protected function toCamelCase($string)
    {
        return lcfirst($this->toPascalCase($string));
    }


    protected function getNamespace($infos)
    {
        $namespace = 'App\Controllers\\';

        if (array_key_exists('namespace', $infos)) {
            $namespace .= $infos['namespace'] . '\\';
        }

        return $namespace;
    }
}
