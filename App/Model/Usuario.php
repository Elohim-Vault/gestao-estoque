<?php


class Usuario{

    public static function login($email, $senha){
        $conn = Connection::getConn();
        $sql = $conn->prepare("SELECT id_usuario, senha FROM tb_usuario WHERE email = :EMAIL");
        $sql->bindValue(":EMAIL", $email);

        $sql->execute();
        $resultado = $sql->fetchAll();
        if(password_verify($senha, $resultado[0]['senha'])){
            return $resultado[0]['id_usuario'];
        }
        throw new Exception("Verifique se seu E-mail ou senha está correto");
    }

    public static function registra($nome, $email, $senha){
        $conn = Connection::getConn();
        $sql = $conn->prepare("INSERT INTO tb_usuario (nome, email, senha) VALUES (:NOME, :EMAIL, :SENHA)");
        $sql->bindValue(":NOME", $nome);
        $sql->bindValue(":EMAIL", $email);
        $sql->bindValue(":SENHA", password_hash($senha, PASSWORD_BCRYPT, ['cost'=> 8]));
        $resultado = $sql->execute();
        if(!$resultado){
            throw new Exception("Este e-mail já foi cadastrado");
            return false;
        }
        return true;
    }
}
?>