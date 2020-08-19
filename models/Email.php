<?php
    include_once 'Connection.php';
    
    class Email extends Connection{
        public function emailStudent($email,$sent,$msg_log){
            $db = parent::createConnection();

            $query = $db->prepare("INSERT INTO email_student (email,sent,msg_log) VALUES (:email,:sent,:msg_log)");
            $query->bindValue(":email", $email);
            $query->bindValue(":sent", $sent);
            $query->bindValue(":msg_log", $msg_log);
            $resultado = $query->execute();

            return $resultado;
        }

        public function emailDani($email,$sent,$msg_log){
            $db = parent::createConnection();

            $query = $db->prepare("INSERT INTO email_dani (email,sent,msg_log) VALUES (:email,:sent,:msg_log)");
            $query->bindValue(":email", $email);
            $query->bindValue(":sent", $sent);
            $query->bindValue(":msg_log", $msg_log);
            $resultado = $query->execute();

            return $resultado;
        }

        public function falha_email($origin,$email,$sent,$msg_log){
            $db = parent::createConnection();

            $query = $db->prepare("INSERT INTO falha_email (origin,email,sent,msg_log) VALUES (:origin,:email,:sent,:msg_log)");
            $query->bindValue(":origin", $origin);
            $query->bindValue(":email", $email);
            $query->bindValue(":sent", $sent);
            $query->bindValue(":msg_log", $msg_log);
            $resultado = $query->execute();

            return $resultado;
        }
    }
?>