<?php
    include_once 'Connection.php';
    
    class User extends Connection{
        // Classe para cadastro de usuario
        public function registerUser($name,$lastname,$phone,$company,$profile,$active,$email,$password,$created_on){
            $db = parent::createConnection();
            $query = $db->prepare("INSERT INTO users (name,lastname,phone,company,profile,active,email,password,created_on) VALUES (:name,:lastname,:phone,:company,:profile,:active,:email,:password,STR_TO_DATE(:created_on,'%Y-%m-%d %H:%i:%s'))");
            $query->bindValue(":name", $name);
            $query->bindValue(":lastname", $lastname);
            $query->bindValue(":phone", $phone);
            $query->bindValue(":company", $company);
            $query->bindValue(":profile", $profile);
            $query->bindValue(":active", $active);
            $query->bindValue(":email", $email);
            $query->bindValue(":password", $password);
            $query->bindValue(":created_on", $created_on);
            return $query->execute();
        }
        
        //Retorna um usuario a partir do email
        public function retrieveUser($email){
            $db = parent::createConnection();
            $query = $db->prepare("SELECT * FROM users WHERE email = :email");
            $query->bindValue(":email", $email);
            $query->execute();
            $resultado = $query->fetch(PDO::FETCH_OBJ);
            return $resultado;
        }

        //Salva o ultimo login do usuario no BD
        public function lastLogin($id,$login){
            $db = parent::createConnection();
            $query = $db->prepare("INSERT INTO login (id_user, login) VALUES (:id_user,STR_TO_DATE(:login,'%Y-%m-%d %H:%i:%s'))");
            $query->bindValue(":id_user", $id);
            $query->bindValue(":login", $login);
            $resultado = $query->execute();
            return $resultado;
        }

        public function changePassword($email,$password,$updated_on){
            $db = parent::createConnection();
            $query = $db->prepare("UPDATE users SET password = :password, updated_on = STR_TO_DATE(:updated_on,'%Y-%m-%d %H:%i:%s') WHERE email = :email");
            $query->bindValue(":email", $email);
            $query->bindValue(":password", $password);
            $query->bindValue(":updated_on", $updated_on);
            $resultado = $query->execute();
            return $resultado;
        }

        public function listarusers(){
            $db = parent::createConnection();
            $query = $db->prepare("SELECT * FROM users");
            $query->execute();
            $resultado = $query->fetchAll(PDO::FETCH_OBJ);
            return $resultado;
        }

        public function alteraUsuario($id,$name,$lastname,$email,$cpf,$data_nascimento,$phone,$profissao,$endereco,$numero,$complemento,$bairro,$cidade,$estado,$cep){
            $db = parent::createConnection();
            $query = $db->prepare("UPDATE users SET nome = :nome, sobrenome = :sobrenome, email = :email, cpf = :cpf, data_nascimento = :data_nascimento, telefone = :telefone, profissao = :profissao, endereco = :endereco, numero = :numero, complemento = :complemento, bairro = :bairro, cidade = :cidade, estado = :estado, cep = :cep WHERE id_usuario = :id");
            $query->bindValue(":id", $id);
            $query->bindValue(":nome", $name);
            $query->bindValue(":sobrenome", $lastname);
            $query->bindValue(":email", $email);
            $query->bindValue(":cpf", $cpf);
            $query->bindValue(":data_nascimento", $data_nascimento);
            $query->bindValue(":telefone", $phone);
            $query->bindValue(":profissao", $profissao);
            $query->bindValue(":endereco", $endereco);
            $query->bindValue(":numero", $numero);
            $query->bindValue(":complemento", $complemento);
            $query->bindValue(":bairro", $bairro);
            $query->bindValue(":cidade", $cidade);
            $query->bindValue(":estado", $estado);
            $query->bindValue(":cep", $cep);
            $resultado = $query->execute();
            return $resultado;
        }

        public function deletarUsuario($id){
            $db = parent::createConnection();
            $query = $db->prepare("DELETE FROM users WHERE id_usuario = :id");
            $query->bindValue(":id", $id);
            $resultado = $query->execute();
            return $resultado;
        }

        public function recuperaLogin($id_usuario){
            $db = parent::createConnection();
            $query = $db->prepare("SELECT COUNT(*) FROM fuseiot.login WHERE id_usuario = :id_usuario");
            $query->bindValue(":id_usuario", $id_usuario);
            $query->execute();
            $resultado = $query->fetchColumn();
            return $resultado;
        }
    }
?>