<?php
    session_start();

    class HomeController{
        public function acao($rotas){
            switch($rotas){
                case "home":
                    $this->viewHome();
                break;
            }
        }

        private function viewHome(){
            $_SESSION['title'] = "Dani Repetti - Personalized English - Aulas de Inglês Particular em Pinheiros SP";
            include "assets/home.php";
        }
    }
?>