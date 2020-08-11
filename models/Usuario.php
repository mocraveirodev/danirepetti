<?php
    include_once 'Conexao.php';
    
    class Usuario extends Conexao{
        public function cadastrarUsuario($nome,$sobrenome,$telefone,$empresa,$email,$senha){
            $db = parent::criarConexao();
            $query = $db->prepare("INSERT INTO usuarios (nome,sobrenome,telefone,empresa,email,senha) VALUES (?,?,?,?,?,?)");
            return $query->execute([$nome,$sobrenome,$telefone,$empresa,$email,$senha]);
        }
        
        public function recuperaUsuario($email){
            $db = parent::criarConexao();
            $query = $db->prepare("SELECT * FROM usuarios WHERE email = :email");
            $query->bindValue(":email", $email);
            $query->execute();
            $resultado = $query->fetch(PDO::FETCH_OBJ);
            return $resultado;
        }

        public function listarUsuarios(){
            $db = parent::criarConexao();
            $query = $db->prepare("SELECT * FROM usuarios");
            $query->execute();
            $resultado = $query->fetchAll(PDO::FETCH_OBJ);
            return $resultado;
        }

        public function alteraUsuario($id,$nome,$sobrenome,$email,$cpf,$data_nascimento,$telefone,$profissao,$endereco,$numero,$complemento,$bairro,$cidade,$estado,$cep){
            $db = parent::criarConexao();
            $query = $db->prepare("UPDATE usuarios SET nome = :nome, sobrenome = :sobrenome, email = :email, cpf = :cpf, data_nascimento = :data_nascimento, telefone = :telefone, profissao = :profissao, endereco = :endereco, numero = :numero, complemento = :complemento, bairro = :bairro, cidade = :cidade, estado = :estado, cep = :cep WHERE id_usuario = :id");
            $query->bindValue(":id", $id);
            $query->bindValue(":nome", $nome);
            $query->bindValue(":sobrenome", $sobrenome);
            $query->bindValue(":email", $email);
            $query->bindValue(":cpf", $cpf);
            $query->bindValue(":data_nascimento", $data_nascimento);
            $query->bindValue(":telefone", $telefone);
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
            $db = parent::criarConexao();
            $query = $db->prepare("DELETE FROM usuarios WHERE id_usuario = :id");
            $query->bindValue(":id", $id);
            $resultado = $query->execute();
            return $resultado;
        }

        public function alteraSenha($email,$senha){
            $db = parent::criarConexao();
            $query = $db->prepare("UPDATE usuarios SET senha = :senha WHERE email = :email");
            $query->bindValue(":email", $email);
            $query->bindValue(":senha", $senha);
            $resultado = $query->execute();
            return $resultado;
        }

        public function ultimoLogin($id){
            $db = parent::criarConexao();
            $query = $db->prepare("INSERT INTO login (id_usuario, login) VALUES (:id,CURRENT_TIMESTAMP)");
            $query->bindValue(":id", $id);
            $resultado = $query->execute();
            return $resultado;
        }

        public function recuperaLogin($id_usuario){
            $db = parent::criarConexao();
            $query = $db->prepare("SELECT COUNT(*) FROM fuseiot.login WHERE id_usuario = :id_usuario");
            $query->bindValue(":id_usuario", $id_usuario);
            $query->execute();
            $resultado = $query->fetchColumn();
            return $resultado;
        }
    }
?>