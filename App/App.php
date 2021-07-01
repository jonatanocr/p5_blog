<?php

namespace App;

class App
{
    public function run() {
        session_start();

        require ROOT.'/core/Autoloader.php';
        $autoloader = new \Core\Autoloader();
        $autoloader->register();
    }
}