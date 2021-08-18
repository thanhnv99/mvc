<?php

namespace mvc\Core;

class Model
{

    //để chuyển đổi object sang mảng key-value
    public function getProperties()
    {
        return get_object_vars($this);
    }
}
