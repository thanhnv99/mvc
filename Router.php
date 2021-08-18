<?php

namespace mvc;


class Router
{

    static public function parse(string $url,Request $request)
    {
        $url = trim($url);

        if ($url == "/mvc/")
        {
            $request->controller = "tasks";
            $request->action = "index";
            $request->params = [];
        }
        else
        {
            //cat url thanh cac pha tu nho : url/mvc/controller/action/params
            $explode_url = explode('/', $url);
            //lay phan tu controller/action/params
            $explode_url = array_slice($explode_url, 2);
            $request->controller = $explode_url[0];
            $request->action = $explode_url[1];
            $request->params = array_slice($explode_url, 2);
        }

    }
}
?>