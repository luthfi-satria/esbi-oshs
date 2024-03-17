<?php
namespace App\Core;

class Render{
    function view($viewFile, $params=null){
        $data = $params;
        include (__DIR__."/../View/".$viewFile.".php");
    }
}