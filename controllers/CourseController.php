<?php
    session_start();

    class CourseController{
        public function acao($rotas){
            switch($rotas){
                case "course":
                    $this->viewCurse();
                break;
            }
        }

        private function viewHome(){
            $_SESSION['title'] = "Dani Repetti - Agendamento de Aulas";
            include "assets/course/course.php";
        }
    }
?>