<?php

namespace mvc\Models;

use mvc\Core\ResourceModel;
use mvc\Models\BookModel;

class BookResourceModel extends ResourceModel
{
    public function __construct()
    {
        parent::_init('books', 'id', new BookModel);
    }
}
