<?php
    session_start();

    include_once "models/Usuario.php";

    class UserController{
        public function acao($rotas){
            switch($rotas){
                case "cadastro":
                    $this->viewCadastro();
                break;
                case "cadastrar":
                    $this->cadastrarUsuario();
                break;
            }
        }

        private function viewCadastro(){
            $_SESSION['title'] = "Dani Repetti - Cadastro de Aluno";
            include "assets/cadastro.php";
        }
        private function cadastrarUsuario(){
            // $nome = "Monica";
            // $sobrenome = "Craveiro de Menezes";
            // $telefone = "+55 11 982847734";
            // $empresa = "Mex Consulting";
            // $email = "craveiromonica@gmail.com";
            // $senha = password_hash("12345678", PASSWORD_DEFAULT);

            // $db = new Usuario();

            // $resultado = $db->cadastrarUsuario($nome,$sobrenome,$telefone,$empresa,$email,$senha);

            // var_dump($resultado);
        }
    }
?>