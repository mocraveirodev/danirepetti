<?php
    session_start();

    header('Content-Type: text/html; charset=UTF-8');

    date_default_timezone_set('America/Sao_Paulo');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'vendor/autoload.php';

    include_once "models/User.php";
    include_once "models/Email.php";

    class UserController{
        public function acao($rotas){
            switch($rotas){
                case "register":
                    $this->registerUser();
                break;
                case "login":
                    $this->loginUser();
                break;
                case "logout":
                    $this->logoutUser();
                break;
            }
        }

        private function registerUser(){
            if($_POST){
                $name = $_POST['name'];
                $lastname = $_POST['lastname'];
                $phone = $_POST['phone'];
                $company = $_POST['company'];
                $profile = "student";
                $active = false;
                $email = $_POST['email'];
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $created_on = date('Y-m-d H:i:s');

                $user = new User();

                if($user->registerUser($name,$lastname,$phone,$company,$profile,$active,$email,$password,$created_on)){
                    $_SESSION['modal'] = "cadastro";
                    $email1 = $this->sendMail($name,$lastname,$phone,$company,$email,"student");
                    $email2 = $this->sendMail($name,$lastname,$phone,$company,$email,"dani");
                    echo "<script>window.location.href = '/register';</script>";
                    die;
                }else{
                    $_SESSION['error'] = "Falha no cadastro do aluno, tente novamente!";
                    echo "<script>window.location.href = '/register';</script>";
                    die;
                }
            }
            
            $_SESSION['title'] = "Dani Repetti - Cadastro de Aluno";
            include "assets/user/register.php";
        }

        private function loginUser(){
            if(!is_null($_SESSION['user'])){
                if($_SESSION['user']->active){
                    echo "<script>window.location.href = '/course';</script>";
                    die;
                }else{
                    echo "<script>window.location.href = '/notactive';</script>";
                    die;
                }
            }

            if(isset($_POST['email'])){
                $email = $_POST['email'];
                $password = $_POST['password'];

                if($this->checkUser($email,$password)){
                    $user = new User();
                    $_SESSION['user'] = $user->retrieveUser($email);
                    unset($_SESSION['user']->password);
                    $login = date('Y-m-d H:i:s');
                    $user->lastLogin($_SESSION['user']->id_user,$login);
                    if($_SESSION['user']->active){
                        echo "<script>window.location.href = '/course';</script>";
                        die;
                    }else{
                        echo "<script>window.location.href = '/notactive';</script>";
                        die;
                    }
                }else{
                    $_SESSION['error'] = "Email e/ou senha incorretos!";
                    echo "<script>window.location.href = '/login';</script>";
                    die;
                }
            }

            $_SESSION['title'] = "Dani Repetti - Login de Aluno";
            include "assets/user/login.php";
        }

        private function checkUser($email,$password){
            $db = new User();

            $user = $db->retrieveUser($email);

            return password_verify($password,$user->password) ? true : false;
        }

        private function logoutUser(){
            session_gc();
            session_destroy();
            unset($_SESSION['user']);
            echo "<script>window.location.href = '/login';</script>";
        }

        private function sendMail($name,$lastname,$phone,$company,$email,$from){
            $sent = [];
            $mail = new PHPMailer(true);
            $db = new Email();

            if($from != "dani"){
                $subject = "Pré-cadastro de Aluno - Dani Repetti";
                $message = "<div style='background-color: #4686a0;height: 100%;width: 100%;color: #fff;'><img src='cid:logo-dani' style='margin: 20px;width: 20%;height: auto;' alt='Logo Dani Repetti'><br><br><h1 style='margin: 0 20px 20px 20px;color: #E4183E;'>Pré-cadastro realizado com sucesso!</h1><hr style='border: 1px solid #f1f1f1; margin:20px;'><h3 style='margin: 20px;'><strong>Em breve entraremos em contato com você por e-mail para dar mais detalhes sobre a Metodologia da Dani Repetti</strong></h3><br><br><p style='margin: 20px;'>Obrigada pelo interesse nas aulas de inglês! Seguem abaixo os dados que recebemos:<br><br><strong>Nome Completo: </strong>$name $lastname<br><strong>Telefone: </strong>$phone<br><strong>Empresa: </strong>$company<br><strong>E-mail: </strong><a href='mailto:$email' style='color: #fff; font-weight:bold;'>$email<br></a></p><br><br><div style='background-color: #fff;width: 100%;height: 3rem;'></div></div>";
                $messagePlain = "Pré-cadastro realizado com sucesso!
                Em breve entraremos em contato com você por e-mail para dar mais detalhes sobre a Metodologia da Dani Repetti
                
                Obrigada pelo interesse nas aulas de inglês! Seguem abaixo os dados que recebemos:
                Nome Completo: $name $lastname
                Telefone: $phone
                Empresa: $company
                E-mail: $email";
            }else{
                $subject = "Novo Cadastro de Aluno - Dani Repetti";
                $message = "<div style='background-color: #4686a0;height: 100%;width: 100%;color: #fff;'><img src='cid:logo-dani' style='margin: 20px;width: 20%;height: auto;' alt='Logo Dani Repetti'><br><br><h1 style='margin: 0 20px 20px 20px;color: #E4183E;'>Um aluno realizou o pré-cadastro!</h1><hr style='border: 1px solid #f1f1f1; margin:20px;'>
                <br><p style='margin: 20px;'>Seguem abaixo os dados que recebemos:<br><br><strong>Nome Completo: </strong>$name $lastname<br><strong>Telefone: </strong>$phone<br><strong>Empresa: </strong>$company<br><strong>E-mail: </strong><a href='mailto:$email' style='color: #fff; font-weight:bold;'>$email</a><br></p><br><br><div style='background-color: #fff;width: 100%;height: 3rem;'></div></div>";
                $messagePlain = "Um aluno realizou o pré-cadastro!
                
                Seguem abaixo os dados que recebemos:
                Nome Completo: $name $lastname
                Telefone: $phone
                Empresa: $company
                E-mail: $email";
            }
            
            try {
                $mail->SMTPDebug = SMTP::DEBUG_OFF;
                $mail->IsSMTP();
                $mail->Host = "localhost";
                $mail->SMTPAuth = false; 
                $mail->SMTPSecure = false;
                $mail->SMTPAutoTLS = false;

                $mail->setFrom("contato@danirepetti.com", "Dani Repetti");
                ($from != "dani") ? $mail->addAddress($email) : $mail->addAddress("contato@danirepetti.com") ;
                $mail->AddEmbeddedImage('images/danirepetti-aulainglespinheiros.png',"logo-dani","logo-dani");

                $mail->isHTML(true);
                $mail->CharSet = 'UTF-8';
                $mail->Subject = $subject;
                $mail->Body    = $message;
                $mail->AltBody = $messagePlain;

                $mailresult = $mail->Send();

                if($from != "dani"){
                    if($db->emailStudent($email,true,$mailresult)){
                        array_push($sent,["enviado_student"=>true,"DB_student"=>true]);
                    }else{
                        array_push($sent,["enviado_student"=>true,"DB_student"=>false]);
                    }
                }else{
                    if($db->emailDani($email,true,$mailresult)){
                        array_push($sent,["enviado_dani"=>true,"DB_dani"=>true]);
                    }else{
                        array_push($sent,["enviado_dani"=>true,"DB_dani"=>false]);
                    }
                }

            }catch (Exception $e) {
                if($from != "dani"){
                    $_SESSION['ErrorInfo'] = "$mail->ErrorInfo";

                    if($db->falha_email("mail_student",$email,false,$_SESSION['ErrorInfo'])){
                        array_push($sent,["enviado_student"=>false,"DB_falha"=>true]);
                    }else{
                        array_push($sent,["enviado_student"=>false,"DB_falha"=>false]);
                    }
                }else{
                    $_SESSION['ErrorInfo'] = "$mail->ErrorInfo";
                
                    if($db->falhaEmail("mail_dani",$email,false,$_SESSION['ErrorInfo'])){
                        array_push($sent,["enviado_dani"=>false,"DB_falha"=>true]);
                    }else{
                        array_push($sent,["enviado_dani"=>false,"DB_falha"=>false]);
                    }
                }
            }

            $mail->clearAddresses();
            $mail->clearAttachments();
            $mail->ClearAllRecipients();

            return $sent;
        }
    }
?>