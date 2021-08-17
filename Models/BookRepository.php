<?php

namespace mvc\Models;

use mvc\Models\BookResourceModel;

class BookRepository
{
    protected $bookRes;
    public function __construct()
    {
        $this->bookRes = new BookResourceModel();
    }

    public function getAll(){
        return $this->bookRes->getAll();
    }

    public function get($id){
        return $this->bookRes->get($id);
    }

    public function delete($id){
        return $this->bookRes->delete($id);
    }

    public function add($model){
        return $this->bookRes->save($model);
    }

    public function update($model){
        return $this->bookRes->save($model);
    }
}
