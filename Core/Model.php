<?php

namespace mvc\Core;

class Model
{
    //get model data hàm getProperties sẽ trả về một mảng các thuộc stinhs của Model
    // array{ ["id"]=> 1 , ["title"]=>"task một",["description"]=>"abcd" }
    public function getProperties()
    {
        return get_object_vars($this);
    }
}
