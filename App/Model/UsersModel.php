<?php
namespace App\Model;

class UsersModel extends CoreModel{

    function getUserID($username, $password=null){
        $query = "SELECT id from users WHERE username='$username'";
        $query .= !empty($password) ? " AND password='$password'" : "";
        $result = $this->db->query($query);
        return $result->fetch_object();
    }

    function getUserByID($id){
        $query = "SELECT * from users where id='".$id."'";
        $result = $this->db->query($query);
        return $result->fetch_object();
    }

    function getAllUsers(){
        $query = "SELECT * from users";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
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

    function updateUser($data, $id){
        $username = $data['username'];
        $email = $data['email'];
        
        $updateSQL = "UPDATE users SET username='$username', email='$email' WHERE id='$id'";
        return $this->db->query($updateSQL);
    }

    function deleteUser($id){
        $updateSQL = "DELETE FROM users WHERE id='$id'";
        return $this->db->query($updateSQL);
    }
}