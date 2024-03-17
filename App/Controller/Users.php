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
        $view->view('list');
    }

    function authenticate(){
        try{
            ob_start();
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

    function update(){
        try{

        }catch(Exception $error){
            return $error->getMessage();
        }
    }

    function delete(){
        try{

        }catch(Exception $error){
            return $error->getMessage();
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