<?php 

class Router {
    public static function route($url) {
        $controller = 'HomeController';
        $action = 'index';

        $urlParts = explode('/', $url);

        if (isset($urlParts[0]) && !empty($urlParts[0])) {
            $controller = ucfirst($urlParts[0]) . 'Controller';
        }

        if (isset($urlParts[1]) && !empty($urlParts[1])) {
            $action = $urlParts[1];
        }

        $controllerFile = __DIR__ . '/../app/controllers/' . $controller . '.php';

        if (file_exists($controllerFile)) {
            include $controllerFile;

            if (class_exists($controller)) {
                $controllerInstance = new $controller();

                if (method_exists($controllerInstance, $action)) {
                    $controllerInstance->$action();
                } else {
                    // Handle action not found
                    echo "Action not found!";
                }
            } else {
                // Handle controller class not found
                echo "Controller class not found!";
            }
        } else {
            // Handle controller file not found
            echo "Controller file not found!";
        }
    }
}

?>