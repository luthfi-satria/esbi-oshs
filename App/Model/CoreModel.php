<?php
namespace App\Model;

use App\Config\DBConnection;

class CoreModel extends DBConnection{
    function __construct()
    {
        $this->db = self::setup();
        $latest = $this->checkMigration();
        if(empty($latest) || $latest->last_update <= strtotime('now')){
            $this->migrate();
        }
    }

    function checkMigration(){
        $sql = "SELECT id, last_update FROM migration ORDER BY id DESC";
        $query = $this->db->query($sql);
        return $query->fetch_object();
    }

    function migrate(){
        $command = 'CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTO_INCREMENT,
            username VARCHAR(50) DEFAULT NULL,
            email VARCHAR (50) DEFAULT NULL,
            password VARCHAR(255) DEFAULT NULL
        );';
        $this->db->query($command);

        $command = "INSERT INTO migration(`last_update`) VALUE( NOW() );";
        $this->db->query($command);
    }
}