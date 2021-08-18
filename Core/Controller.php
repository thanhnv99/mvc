<?php

namespace mvc\Core;

class Controller
{
    public $vars = [];
    public $layout = "default";

    function set($d)
    {
        //noi mang d vao mang vars[]
        $this->vars = array_merge($this->vars, $d);
    }

    function render($filename)
    {
        extract($this->vars);
        ob_start();
        $get_url = ucfirst(str_replace('Controller', '', get_class($this)));
        require(ROOT . "Views/" . ucfirst(str_replace('Mvc\s\\', '', $get_url )). '/' . $filename . '.php');
        $content_for_layout = ob_get_clean();
        if ($this->layout == false) {
            $content_for_layout;
        } else {
            require(ROOT . "Views/Layouts/" . $this->layout . '.php');
        }
    }

    private function secure_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    protected function secure_form($form)
    {
        foreach ($form as $key => $value) {
            $form[$key] = $this->secure_input($value);
        }
    }
}
