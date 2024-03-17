<?php
namespace App\Model;

class UsersModel extends CoreModel{

    function getUserID($username, $password=null){
        $query = "SELECT id from users WHERE username='$username'";
        $query .= !empty($password) ? " AND password='$password'" : "";
        $result = $this->db->query($query);
        return $result->fetch_object();
    }

    function getAllUsers(){

    }

    function loginUser($data){
        $username = $data['username'];
        $password = md5($data['password']);
        // cek ketersediaan user
        $getUser = self::getUserID($username, $password);
        return $getUser;
    }

    function insertUser($data){
        $username = $data['username'];
        $email = $data['email'];
        $password = md5($data['password']);
        // cek ketersediaan user
        $getUser = self::getUserID($username, $password);
        if(empty($getUser)){
            $insertSQL = "INSERT INTO users(`username`, `email`, `password`) VALUE('$username','$email','$password')";
            $this->db->query($insertSQL);
            return $this->db->insert_id;
        }
        return false;
    }

    function updateUser(){

    }

    function deleteUser(){

    }
}