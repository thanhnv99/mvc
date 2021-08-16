<?php

namespace mvc;

use mvc\Request;
use mvc\Router;

class Dispatcher
{

    private $request;

    public function dispatch()
    {
        //Gán biến request = object Request; 
        $this->request = new Request();
        //$this->request->url = lấy thông tin trên đường dẫn 

        //Tách từ đường dẫn các giá trị controller, action,params và gán vào $this->request
        Router::parse($this->request->url, $this->request);

        //Gọi controller theo tên trên đường dẫn url.
        $controller = $this->loadController();

        //Gọi function theo tên action trên đường dẫn , của class controller, truyển vào với tham số trên đường dẫn
        call_user_func_array([$controller, $this->request->action], $this->request->params);
    }

    public function loadController()
    {      
        //Lấy tên controller trên đường dẫn ví dụ: tasks => Tasks
        $name = ucfirst($this->request->controller);

        //Nối để tạo tên controller ví dụ: Tasks => TasksController.
        $controllerName = $name . "Controller";

        //Tạo đường dẫn gọi class ví dụ: TasksController => mvc\Controllers\TasksController
        $file = 'mvc\\Controllers\\' . $controllerName;

        //Tạo đối tượng controller theo namespace ví dụ new mvc\Controllers\TasksController() 
        $controller = new $file();

        //trả về controller vừa tạo. 
        return $controller;
    }
    
}
