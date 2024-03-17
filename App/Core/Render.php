<?php
namespace App\Core;

class Render{
    function view($viewFile){
        include (__DIR__."/../View/".$viewFile.".php");
    }
}