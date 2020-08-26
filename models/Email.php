<?php
    include_once 'Connection.php';
    
    class Email extends Connection{
        public function emailStudent($email,$sent,$msg_log,$date_time){
            $db = parent::createConnection();

            $query = $db->prepare("INSERT INTO email_student (email,sent,msg_log,date_time) VALUES (:email,:sent,:msg_log,STR_TO_DATE(:date_time,'%Y-%m-%d %H:%i:%s'))");
            $query->bindValue(":email", $email);
            $query->bindValue(":sent", $sent);
            $query->bindValue(":msg_log", $msg_log);
            $query->bindValue(":date_time", $date_time);
            $resultado = $query->execute();

            return $resultado;
        }

        public function emailDani($email,$sent,$msg_log,$date_time){
            $db = parent::createConnection();

            $query = $db->prepare("INSERT INTO email_dani (email,sent,msg_log,date_time) VALUES (:email,:sent,:msg_log,STR_TO_DATE(:date_time,'%Y-%m-%d %H:%i:%s'))");
            $query->bindValue(":email", $email);
            $query->bindValue(":sent", $sent);
            $query->bindValue(":msg_log", $msg_log);
            $query->bindValue(":date_time", $date_time);
            $resultado = $query->execute();

            return $resultado;
        }

        public function emailChange($email,$sent,$msg_log,$date_time){
            $db = parent::createConnection();

            $query = $db->prepare("INSERT INTO email_change (email,sent,msg_log,date_time) VALUES (:email,:sent,:msg_log,STR_TO_DATE(:date_time,'%Y-%m-%d %H:%i:%s'))");
            $query->bindValue(":email", $email);
            $query->bindValue(":sent", $sent);
            $query->bindValue(":msg_log", $msg_log);
            $query->bindValue(":date_time", $date_time);
            $resultado = $query->execute();

            return $resultado;
        }

        public function emailFail($origin,$email,$sent,$msg_log,$date_time){
            $db = parent::createConnection();

            $query = $db->prepare("INSERT INTO email_fail (origin,email,sent,msg_log,date_time) VALUES (:origin,:email,:sent,:msg_log,STR_TO_DATE(:date_time,'%Y-%m-%d %H:%i:%s'))");
            $query->bindValue(":origin", $origin);
            $query->bindValue(":email", $email);
            $query->bindValue(":sent", $sent);
            $query->bindValue(":msg_log", $msg_log);
            $query->bindValue(":date_time", $date_time);
            $resultado = $query->execute();

            return $resultado;
        }
    }
?>