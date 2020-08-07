<?php
    include_once 'Conexao.php';
    
    class Usuario extends Conexao{
        public function cadastrarUsuario($nome,$sobrenome,$email){
            $db = parent::criarConexao();
            $query = $db->prepare("INSERT INTO usuarios (nome,sobrenome,email) VALUES (?,?,?)");
            return $query->execute([$nome,$sobrenome,$email]);
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

        public function cadastrarProgresso($id,$progresso){
            $db = parent::criarConexao();
            $query = $db->prepare("INSERT INTO progresso (id_usuario,progresso) VALUES (:id,:progresso)");
            $query->bindValue(":id", $id);
            $query->bindValue(":progresso", $progresso);
            $resultado = $query->execute();
            return $resultado;
        }

        public function recuperaProgresso($id_usuario){
            $db = parent::criarConexao();
            $query = $db->prepare("SELECT * FROM progresso WHERE id_usuario = :id_usuario");
            $query->bindValue(":id_usuario", $id_usuario);
            $query->execute();
            $resultado = $query->fetch(PDO::FETCH_OBJ);
            return $resultado;
        }

        public function alteraProgresso($id_usuario,$progresso){
            $db = parent::criarConexao();
            $query = $db->prepare("UPDATE progresso SET progresso = :progresso WHERE id_usuario = :id_usuario");
            $query->bindValue(":id_usuario", $id_usuario);
            $query->bindValue(":progresso", $progresso);
            $resultado = $query->execute();
            return $resultado;
        }
        
        public function cadastrarComentario($id_curso,$id_aula,$id_usuario,$comentario){
            $db = parent::criarConexao();
            $query = $db->prepare("INSERT INTO comentarios (id_curso,id_aula,id_usuario,comentario) VALUES (:id_curso,:id_aula,:id_usuario,:comentario)");
            $query->bindValue(":id_curso", $id_curso);
            $query->bindValue(":id_aula", $id_aula);
            $query->bindValue(":id_usuario", $id_usuario);
            $query->bindValue(":comentario", $comentario);
            $resultado = $query->execute();
            return $resultado;
        }

        public function recuperaComentario($id_aula){
            $db = parent::criarConexao();
            $query = $db->prepare("SELECT * FROM comentarios WHERE id_aula = :id_aula");
            $query->bindValue(":id_aula", $id_aula);
            $query->execute();
            $resultado = $query->fetchAll(PDO::FETCH_OBJ);
            return $resultado;
        }

        public function listarComentarios(){
            $db = parent::criarConexao();
            $query = $db->prepare("SELECT * FROM comentarios");
            $query->execute();
            $resultado = $query->fetchAll(PDO::FETCH_OBJ);
            return $resultado;
        }

        public function alteraComentario($id_comentario,$id_curso,$id_aula,$id_usuario,$comentario){
            $db = parent::criarConexao();
            $query = $db->prepare("UPDATE comentarios SET id_curso = :id_curso, id_aula = :id_aula, id_usuario = :id_usuario, comentario = :comentario WHERE id_comentario = :id_comentario");
            $query->bindValue(":id_comentario", $id_comentario);
            $query->bindValue(":id_curso", $id_curso);
            $query->bindValue(":id_aula", $id_aula);
            $query->bindValue(":id_usuario", $id_usuario);
            $query->bindValue(":comentario", $comentario);
            $resultado = $query->execute();
            return $resultado;
        }

        public function deletarComentario($id_comentario){
            $db = parent::criarConexao();
            $query = $db->prepare("DELETE FROM respostas WHERE id_comentario = :id_comentario");
            $query->bindValue(":id_comentario", $id_comentario);
            $resultado[] = $query->execute();
            $query = $db->prepare("DELETE FROM comentarios WHERE id_comentario = :id_comentario");
            $query->bindValue(":id_comentario", $id_comentario);
            $resultado[] = $query->execute();
            return $resultado;
        }

        public function cadastrarResposta($id_comentario,$id_curso,$id_aula,$id_usuario,$resposta){
            $db = parent::criarConexao();
            $query = $db->prepare("INSERT INTO respostas (id_comentario,id_curso,id_aula,id_usuario,resposta) VALUES (:id_comentario,:id_curso,:id_aula,:id_usuario,:resposta)");
            $query->bindValue(":id_comentario", $id_comentario);
            $query->bindValue(":id_curso", $id_curso);
            $query->bindValue(":id_aula", $id_aula);
            $query->bindValue(":id_usuario", $id_usuario);
            $query->bindValue(":resposta", $resposta);
            $resultado = $query->execute();
            return $resultado;
        }

        public function recuperaResposta($id_aula){
            $db = parent::criarConexao();
            $query = $db->prepare("SELECT * FROM respostas WHERE id_aula = :id_aula");
            $query->bindValue(":id_aula", $id_aula);
            $query->execute();
            $resultado = $query->fetchAll(PDO::FETCH_OBJ);
            return $resultado;
        }

        public function listarRespostas(){
            $db = parent::criarConexao();
            $query = $db->prepare("SELECT * FROM respostas");
            $query->execute();
            $resultado = $query->fetchAll(PDO::FETCH_OBJ);
            return $resultado;
        }

        public function alteraResposta($id_resposta,$id_comentario,$id_curso,$id_aula,$id_usuario,$resposta){
            $db = parent::criarConexao();
            $query = $db->prepare("UPDATE id_resposta SET id_comentario = :id_comentario, id_curso = :id_curso, id_aula = :id_aula, id_usuario = :id_usuario, resposta = :resposta WHERE id_resposta = :id_resposta");
            $query->bindValue(":id_resposta", $id_resposta);
            $query->bindValue(":id_comentario", $id_comentario);
            $query->bindValue(":id_curso", $id_curso);
            $query->bindValue(":id_aula", $id_aula);
            $query->bindValue(":id_usuario", $id_usuario);
            $query->bindValue(":resposta", $resposta);
            $resultado = $query->execute();
            return $resultado;
        }

        public function deletarResposta($id_resposta){
            $db = parent::criarConexao();
            $query = $db->prepare("DELETE FROM respostas WHERE id_resposta = :id_resposta");
            $query->bindValue(":id_resposta", $id_resposta);
            $resultado = $query->execute();
            return $resultado;
        }

        public function cadastrarAnotacao($id_usuario,$anotacao){
            $db = parent::criarConexao();
            $query = $db->prepare("INSERT INTO anotacoes (id_usuario,anotacao) VALUES (:id_usuario,:anotacao)");
            $query->bindValue(":id_usuario", $id_usuario);
            $query->bindValue(":anotacao", $anotacao);
            $resultado = $query->execute();
            return $resultado;
        }

        public function recuperaAnotacao($id_usuario){
            $db = parent::criarConexao();
            $query = $db->prepare("SELECT * FROM anotacoes WHERE id_usuario = :id_usuario");
            $query->bindValue(":id_usuario", $id_usuario);
            $query->execute();
            $resultado = $query->fetch(PDO::FETCH_OBJ);
            return $resultado;
        }

        public function alteraAnotacao($id_usuario,$anotacao){
            $db = parent::criarConexao();
            $query = $db->prepare("UPDATE anotacoes SET anotacao = :anotacao WHERE id_usuario = :id_usuario");
            $query->bindValue(":id_usuario", $id_usuario);
            $query->bindValue(":anotacao", $anotacao);
            $resultado = $query->execute();
            return $resultado;
        }
    }
?>