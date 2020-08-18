<?php
    session_start();

    header('Content-Type: text/html; charset=UTF-8');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'vendor/autoload.php';

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
                case "email":
                    $this->sendMail();
                break;
            }
        }

        private function viewRegister(){            
            if($_POST){
                $name = $_POST['name'];
                $lastname = $_POST['lastname'];
                $phone = $_POST['phone'];
                $company = $_POST['company'];
                $profile = "student";
                $active = 0;
                $email = $_POST['email'];
                $password = $_POST['password'];

                $user = new User();

                if($user->registerUser($name,$lastname,$phone,$company,$profile,$active,$email,$password)){
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

        private function sendMail($name,$lastname,$phone,$company,$email){
            $mail = new PHPMailer(true);
            $db = new Email();
            $sent = [];
            
            try {
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                $mail->IsSMTP();
                $mail->Host = "localhost";
                $mail->SMTPAuth = false; 
                $mail->SMTPSecure = false;
                $mail->SMTPAutoTLS = false;

                $mail->setFrom("contato@danirepetti.com", "Dani Repetti");
                $mail->addAddress($email);
                $mail->AddEmbeddedImage('images/danirepetti-aulainglespinheiros.png',"logo-dani","logo-dani");

                $mail->isHTML(true);
                $mail->CharSet = 'UTF-8';
                $mail->Subject = "Pré-cadastro de Aluno - Dani Repetti";
                $mail->Body    = "<div style='background-color: #4686a0;width: 100%;color:#fff;'><img src='cid:logo-dani' style='width: 30%;height: auto;margin-top: 20px' alt='Logo Dani Repetti'><br><br><h1 style='color: #E4183E;'>Pré-cadastro realizado com sucesso!</h1><hr style='border: 1px solid #f1f1f1; margin:20px;'><h3><strong>Em breve entraremos em contato com você por e-mail para dar mais detalhes sobre a Metodologia da Dani Repetti</strong></h3><br><br><p>Obrigada pelo interesse nas aulas de inglês! Seguem abaixo os dados que recebemos:<br><strong>Nome Completo: </strong>$name $lastname<br><strong>Telefone: </strong>$phone<br><strong>Empresa: </strong>$company<br><strong>E-mail: </strong>$email<br></p><br><br><div style='background-color: #fff;width: 100%;height: 3rem;'></div></div>";
                $mail->AltBody = "Pré-cadastro realizado com sucesso!
                Em breve entraremos em contato com você por e-mail para dar mais detalhes sobre a Metodologia da Dani Repetti
                
                Obrigada pelo interesse nas aulas de inglês! Seguem abaixo os dados que recebemos:
                Nome Completo: $name $lastname
                Telefone: $phone
                Empresa: $company
                E-mail: $email";

                $mailresult = $mail->Send();
                if($db->emailStudent($email,true,$mailresult)){
                    array_push($sent,["enviado"=>true,"DB"=>true]);
                }else{
                    array_push($sent,["enviado"=>true,"DB"=>false]);
                }

            }catch (Exception $e) {
                $_SESSION['ErrorInfo'] = "$mail->ErrorInfo";
                if($db->falha("mail_student",$email,false,$_SESSION['ErrorInfo'])){
                    array_push($sent,["enviado"=>false,"DB"=>true]);
                }else{
                    array_push($sent,["enviado"=>false,"DB"=>false]);
                }
            }

            $mail->clearAddresses();
            $mail->clearAttachments();
            $mail->ClearAllRecipients();

            try {
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                $mail->IsSMTP();
                $mail->Host = 'localhost';
                $mail->SMTPAuth = false; 
                $mail->SMTPSecure = false;
                $mail->SMTPAutoTLS = false;

                $mail->setFrom("contato@danirepetti.com", "Dani Repetti");
                $mail->addAddress("craveiromonica@gmail.com");

                $mail->isHTML(true);
                $mail->CharSet = 'UTF-8';
                $mail->Subject = "Novo Cadastro de Aluno - Dani Repetti";
                $mail->Body    = "<div style='background-color: #4686a0;width: 100%;color: #fff;'><img src='cid:logo-dani' style='width: 30%;height: auto;margin-top: 20px' alt='Logo Dani Repetti'><br><br><h1 style='color: #E4183E;'>Um aluno realizou o pré-cadastro!</h1><hr style='border: 1px solid #f1f1f1; margin:20px;'>
                <br><p>Seguem abaixo os dados que recebemos:<br><strong>Nome Completo: </strong>$name $lastname<br><strong>Telefone: </strong>$phone<br><strong>Empresa: </strong>$company<br><strong>E-mail: </strong><a href='mailto:$email' style='color: #fff; font-weight:bold;'>$email</a><br></p><br><br><div style='background-color: #fff;width: 100%;height: 3rem;'></div></div>";
                $mail->AltBody = "Um aluno realizou o pré-cadastro!
                
                Seguem abaixo os dados que recebemos:
                Nome Completo: $name $lastname
                Telefone: $phone
                Empresa: $company
                E-mail: $email";

                $mailresult = $mail->Send();

                if($db->emailDani($email,true,$mailresult)){
                    array_push($sent,["enviado"=>true,"DB"=>true]);
                }else{
                    array_push($sent,["enviado"=>true,"DB"=>false]);
                }

            }catch (Exception $e) {
                echo "Erro no envio do email para a Dani ".$mail->ErrorInfo;
                $db->falhaEmail("mail_dani",$email,false,$_SESSION['ErrorInfo']);

                if($db->falha("mail_student",$email,false,$_SESSION['ErrorInfo'])){
                    array_push($sent,["enviado"=>false,"DB"=>true]);
                }else{
                    array_push($sent,["enviado"=>false,"DB"=>false]);
                }
            }

            $mail->clearAddresses();
            $mail->clearAttachments();
            $mail->ClearAllRecipients();
        }
    }
?>