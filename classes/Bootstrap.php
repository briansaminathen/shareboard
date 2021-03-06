<?php
class Bootstrap {
    private $controller;
    private $action;
    private $request;

    public function __construct($request) {
        $this->request = $request;
        if ($this->request['controller'] == "") {
            $this->controller = 'home';
        } else {
            $this->controller = $this->request['controller'];
        }
        if ($this->request['action'] == "") {
            $this->action = 'index';
        } else {
            $this->action = $this->request['action'];
        }


    }

    public function createController() {
        // Check Class
        if (class_exists($this->controller)) {
            $parents = class_parents($this->controller);
            // Check if extended
            if (in_array('Controller', $parents)) {
                if (method_exists($this->controller, $this->action)) {
                    return new $this->controller($this->action, $this->request);
                } else {
                    echo "Method does not exists";
                    return;
                }
            } else {
                // Base controller does not exists
                echo 'Base controller not found';
                return;
            }
        } else {
            // Controller  does not exist
            echo 'Controller does not exist';
            return;

        }


    }
}



