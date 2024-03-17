<?php
namespace App\Controller;

use App\Core\Render;
use App\Model\UsersModel;
use Exception;

class Users{
    var $model;
    function __construct()
    {
        $this->model = new UsersModel;
    }

    function index(){
        $view = new Render;
        $view->view('registrasi');
    }

    function signIn(){
        $view = new Render;
        $view->view('login');
    }

    function list(){
        $view = new Render;
        $user_data = $this->model->getAllUsers();
        $view->view('list', $user_data);
    }

    function edit($id){
        $view = new Render;
        $user_data = $this->model->getUserByID($id);
        $view->view('edit', $user_data);
    }

    function authenticate(){
        try{
            $data = $_POST;
            if($validate = self::validateUser($data)){
                $registerUser = $this->model->loginUser($data);
                if($registerUser){
                    $_SESSION['user_id'] = $registerUser->id;
                    echo json_encode([
                        "code" => 200,
                        "message" => "user berhasil login",
                    ]);
                    echo "<script type='text/javascript'>window.location.href = '/list_user';</script>";
                    exit();
                }
                echo json_encode([
                    "code" => 406,
                    "message" => "user gagal login",
                ]);
                echo "<script type='text/javascript'>window.location.href = '/signin';</script>";
                exit();
            }
            throw new Exception($validate[0]);
        }catch(Exception $error){
            echo json_encode($error->getMessage());
        }        
    }

    function insert(){
        try{
            $data = json_decode(file_get_contents("php://input"), true);
            if($validate = self::validateUser($data)){
                $registerUser = $this->model->insertUser($data);
                if($registerUser){
                    echo json_encode([
                        "code" => 201,
                        "message" => "user berhasil dibuat",
                    ]);
                    exit();
                }
                echo json_encode([
                    "code" => 406,
                    "message" => "user gagal dibuat",
                ]);
                exit();
            }
            throw new Exception($validate[0]);
        }catch(Exception $error){
            echo json_encode($error->getMessage());
        }
    }

    function update($id){
        try{
            $data = $_POST;
            if($validate = self::validateUser($data)){
                $registerUser = $this->model->updateUser($data, $id);
                if($registerUser){
                    echo json_encode([
                        "code" => 200,
                        "message" => "user berhasil diubah",
                    ]);
                    echo "<script type='text/javascript'>window.location.href = '/list_user';</script>";
                    exit();
                }
                echo json_encode([
                    "code" => 406,
                    "message" => "user gagal diubah",
                ]);
                exit();
            }
            throw new Exception($validate[0]);
        }catch(Exception $error){
            echo json_encode($error->getMessage());
        }
    }

    function delete($id){
        try{
            $deleteUser = $this->model->deleteUser($id);
            if($deleteUser){
                echo json_encode([
                    "code" => 200,
                    "message" => "user berhasil dihapus",
                ]);
                exit();
            }
            echo json_encode([
                "code" => 406,
                "message" => "user gagal dihapus",
                "id" => $id,
            ]);
            exit();
        }catch(Exception $error){
            echo json_encode($error->getMessage());
        }
    }

    function validateUser($data){
        foreach($data as $key => $value){
            if(empty($value)){
                return [false, $key." harus terisi"];
            }
        }
        return [true];
    }
}