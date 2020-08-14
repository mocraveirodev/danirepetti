<?php
    session_start();

    include_once "models/User.php";

    class UserController{
        public function acao($rotas){
            switch($rotas){
                case "register":
                    $this->viewRegister();
                break;
                case "login":
                    $this->viewLogin();
                break;
            }
        }

        private function viewRegister(){            
            if($_POST){
                $name = $_POST['name'];
                $lastname = $_POST['lastname'];
                $phone = $_POST['phone'];
                $company = $_POST['company'];
                $profile = $_POST['profile'];
                $email = $_POST['email'];
                $password = $_POST['password'];

                $user = new User();

                if($user->registerUser($name,$lastname,$phone,$company,$profile,$email,$password)){
                    $_SESSION['modal'] = "cadastro";
                }else{
                    $_SESSION['error'] = "Falha no cadastro do aluno, tente novamente!";
                }
            }
            
            $_SESSION['title'] = "Dani Repetti - Cadastro de Aluno";
            include "assets/register.php";
        }

        private function viewLogin(){
            $_SESSION['title'] = "Dani Repetti - Login de Aluno";
            include "assets/login.php";
        }
    }
?>