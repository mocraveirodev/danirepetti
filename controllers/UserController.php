<?php
    session_start();

    class UserController{
        public function acao($rotas){
            switch($rotas){
                case "cadastro":
                    $this->cadastrarUsuario();
                break;
            }
        }

        private function cadastrarUsuario(){

        }
    }
?>