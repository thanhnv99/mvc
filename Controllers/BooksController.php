<?php

namespace mvc\Controllers;

use mvc\Core\Controller;
use mvc\Models\BookModel;
use mvc\Models\BookRepository;

class BooksController extends Controller
{
    private $Repo;

    public function __construct()
    {
        $this->Repo = new BookRepository();
    }

    public function index()
    {
        //Tạo mảng d['books'] chứa dữ liệu tất cả các tasks được lấy thông qua BookRepository
        $d['books'] = $this->Repo->getAll();
        //Gán dữ liệu cho phần view
        $this->set($d);
        // Hiển thị phần view với view là index
        $this->render("index");
    }

    public function create()
    {
        //Tạo 1 đối tượng book
        $book = new BookModel();
        //Lấy thông tin từ mảng Post
        extract($_POST);

        //Kiểm tra nếu mảng post có thông tin title
        if (isset($name)) {
            //đặt cho đối tượng book các thông số
            $book->setName($name);
            $book->setDescription($description);
            //Thực hiện lưu đối tượng book và đưa người dùng về trang chủ
            if ($this->Repo->add($book)) {
                header("Location: " . WEBROOT . "books/index");
            }
        }
        //Nếu không có thông tin mảng post thì đưa người dùng đến giao diện tạo book
        $this->render("create");
    }

    public function edit($id)
    {
        //Lấy thông tin từ mảng Post
        extract($_POST);
        //Kiểm tra nếu mảng post có thông tin title
        if (isset($name)) {
            //Tạo 1 đối tượng book
            $book = new BookModel();
            $book->setId($id);
            $book->setName($name);
            $book->setDescription($description);
            //Thực hiện cập nhật đối tượng book và đưa người dùng về trang chủ
            if ($this->Repo->update($book)) {
                header("Location: " . WEBROOT . "books/index");
            }
        }
        //Nếu mảng post không chứa thông tin
        //Tạo mảng book chứa thông tin của task cần sửa
        $d["book"] = $this->Repo->get($id);
        //Truyền thông tin của book cho phần view
        $this->set($d);
        //Hiển thị phần view edit
        $this->render("edit");
    }

    public function delete($id)
    {
        //Thực hiện delete và đưa người dùng về trang chủ.
        if ($this->Repo->delete($id)) {
            header("Location: " . WEBROOT . "books/index");
        }
    }
}
