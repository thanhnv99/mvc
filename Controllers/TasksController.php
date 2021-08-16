<?php

namespace mvc\Controllers;

use mvc\Core\Controller;
use mvc\Models\TaskModel;
use mvc\Models\TaskRepository;

class TasksController extends Controller
{
    private $Repo;

    public function __construct()
    {
        $this->Repo = new TaskRepository();
    }

    // trang chủ
    public function index()
    {   
        //Tạo mảng d['tasks'] chứa dữ liệu tất cả các tasks được lấy thông qua TaskRepository
        $d['tasks'] = $this->Repo->getAll();
        //Gán dữ liệu cho phần view 
        $this->set($d);
        // Hiển thị phần view với view là index
        $this->render("index");
    }

    public function create()
    {
        //Tạo 1 đối tượng task
        $task = new TaskModel();
        //Lấy thông tin từ mảng Post 
        extract($_POST);

        //Kiểm tra nếu mảng post có thông tin title
        if (isset($title)) {
            //đặt cho đối tượng task các thông số
            $task->setTitle($title);
            $task->setDescription($description);
            //Thực hiện lưu đối tượng task và đưa người dùng về trang chủ
            if ($this->Repo->add($task)) {
                header("Location: " . WEBROOT . "tasks/index");
            }
        }
        //Nếu không có thông tin mảng post thì đưa người dùng đến giao diện tạo task
        $this->render("create");
    }

    public function edit($id)
    {
        //Lấy thông tin từ mảng Post 
        extract($_POST);
        //Kiểm tra nếu mảng post có thông tin title
        if (isset($title)) {
            //Tạo 1 đối tượng task
            $task = new TaskModel();
            $task->setId($id);
            $task->setTitle($title);
            $task->setDescription($description);
            //Thực hiện cập nhật đối tượng task và đưa người dùng về trang chủ
            if ($this->Repo->update($task)) {
                header("Location: " . WEBROOT . "tasks/index");
            }
        }
        //Nếu mảng post không chứa thông tin 
        //Tạo mảng task chứa thông tin của task cần sửa
        $d["task"] = $this->Repo->get($id);
        //Truyền thông tin của task cho phần view
        $this->set($d);
        //Hiển thị phần view edit
        $this->render("edit");
    }

    public function delete($id)
    {
        //Thực hiện delete và đưa người dùng về trang chủ.
        if ($this->Repo->delete($id)) {
            header("Location: " . WEBROOT . "tasks/index");
        }
    }
}
