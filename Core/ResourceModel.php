<?php

namespace mvc\Core;

use mvc\Config\Database;
use PDO;

class ResourceModel implements ResourceModelInterface
{

    private $table;
    private $id;
    private $model;

    public function _init($table, $id, $model)
    {
        $this->table = $table;
        $this->id = $id;
        $this->model = $model;
    }

    public function save($model)
    {
        //để chuyển đổi object sang mảng key-value
        $properties = $model->getProperties();

        //get model id
        //lấy id 
        $checkID = $model->getId();


        // Nếu ID = null nghĩa là người dùng dùng chức năng thêm 
        if ($checkID == null) {
            //xóa id khỏi mảng properties
            unset($properties->this->id);

            //nối các phần tử mảng bằng dấu , 
            $values = implode(', ', array_keys($properties));
            //values = "title, description"
            // nối các phần tử mảng bằng  , :
            $column = implode(', :', array_keys($properties));
            //column = "title ,: description"            

            $sql = "INSERT INTO {$this->table} (" . $values . ") VALUES ( :" . $column . ")";
            // cấu truy vấn INSERT INTO tasks (title, description) VALUES (:title ,: description)

            $req = Database::getBdd()->prepare($sql);

            // Gán các thông số và thực hiện câu truy vấn 
            // nghĩa là nó sẽ lấy phần tử trong mảng có key là title xong gán value vào bảng
            // câu truy vấn thành INSERT INTO tasks (title, description) VALUES ("Tiêu đề 1","abcd")
            return $req->execute($properties);
        }

        // Nếu có ID thì người dugnf dùng chức năng sửa
        if ($checkID != null) {
            $columns = [];
            foreach (array_keys($properties) as $key => $values) {
                if ($values != 'id') {
                    $columns[] =  $values . ' = :' . $values;
                }
            }
            $column = implode(', ', $columns);
            $sql = "UPDATE {$this->table} SET " . $column . " WHERE {$this->id} = :id";
            $req = Database::getBdd()->prepare($sql);
            return $req->execute($properties);
        }
    }

    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} where {$this->id} =:id";
        $req = Database::getBdd()->prepare($sql);
        return $req->execute([':id' => $id]);
    }

    public function get($id)
    {
        //Tạo câu truy vấn sql lấy tất cả thoogn tin từ bảng và id 
        $sql = "SELECT * FROM {$this->table} where {$this->id} =:id";
        $req = Database::getBdd()->prepare($sql);
        $req->execute([':id' => $id]);
        // Trả về Obj lấy được
        return $req->fetchObject();
    }

    public function getAll()
    {
        //Tạo câu truy vấn sql lấy tất cả thoogn tin từ bảng được truyền vào
        $sql = "SELECT * FROM {$this->table}";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        //Trả về mảng chứa các Obj đã lấy được.
        return $req->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, get_class($this->model));
    }
}
