<?php
    session_start();

    class CourseController{
        public function acao($rotas){
            switch($rotas){
                case "course":
                    $this->viewCourse();
                break;
                case "notactive":
                    $this->notActive();
                break;
            }
        }

        private function viewCourse(){
            $_SESSION['title'] = "Dani Repetti - Agendamento de Aulas";
            if(isset($_SESSION['user'])){
                include "assets/course/course.php";
            }else{
                $_SESSION['error'] = "Para acessar essa página é necessário estar logado!";
                echo "<script>window.location.href = '/login';</script>";
            }
        }
        
        private function notActive(){
            $_SESSION['title'] = "Dani Repetti - Aluno não ativo";
            if(isset($_SESSION['user'])){
                include "assets/course/notactive.php";
            }else{
                $_SESSION['error'] = "Para acessar essa página é necessário estar logado!";
                echo "<script>window.location.href = '/login';</script>";
            }
        }
    }
?>