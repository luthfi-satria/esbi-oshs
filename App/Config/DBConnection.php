<?php
    namespace App\Config;

    use Exception;
    use mysqli;

    class DBConnection extends mysqli{
        var $db;
        function __construct()
        {
            parent::__construct();
        }

        function setup(){
            $DBHOST = $_ENV['DB_HOST'];
            $DBUSER = $_ENV['DB_USER'];
            $DBPASS = $_ENV['DB_PASS'];
            $DBNAME = $_ENV['DB_NAME'];
            $DBPORT = $_ENV['DB_PORT'];
            $this->db = new mysqli($DBHOST, $DBUSER, $DBPASS, $DBNAME, $DBPORT);
            if($this->db->connect_errno){
                throw new Exception(
                    $this->db->connect_error,
                    $this->db->connect_errno
                );
            }
            return $this->db;
        }
    }
?>