<?php
    $rotas = key($_GET)?key($_GET):"home";

    switch($rotas){
        case "home":
            include "controllers/HomeController.php";
            $controller = new HomeController();
            $controller->acao($rotas);
        break;
        case "register":
            include "controllers/UserController.php";
            $controller = new UserController();
            $controller->acao($rotas);
        break;
        case "login":
            include "controllers/UserController.php";
            $controller = new UserController();
            $controller->acao($rotas);
        break;
        case "email":
            include "controllers/UserController.php";
            $controller = new UserController();
            $controller->acao($rotas);
        break;
    }
?>