<?php
namespace Core;

class Autoloader {
/*
    function my_autoload($class) {
        include '/App/Controller/'.$class.'.php';
    }

    public static function register() {
        spl_autoload_register('my_autoload');
    }
*/

    public function register() {
        spl_autoload_register(function ($class) {
            var_dump($class);
            include '../App/Controller/'.$class.'.php';
        });
    }

}