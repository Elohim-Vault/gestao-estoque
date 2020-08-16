<?php

class Produto{


    public static function converteData($data){
        return date("d/m/Y", strtotime($data));
    }

    public static function selecionaProdutos($id_usuario){
        $conn = Connection::getConn();
        $sql = $conn->prepare("SELECT * FROM tb_produto WHERE id_usuario = :ID");
        $sql->bindValue(':ID', $id_usuario);
        $res = $sql->execute();
        $resultado = array();
        while($row = $sql->fetchObject("Produto")){
            $row->data_de_compra = self::converteData($row->data_de_compra);
            $resultado[] = $row;
        }
        return $resultado;
    }

    public static function selecionaProdutoPeloId($id_produto){
        $conn = Connection::getConn();
        $sql = $conn->prepare("SELECT * FROM tb_produto WHERE id_produto = :ID_PRODUTO");
        $sql->bindValue(":ID_PRODUTO", $id_produto);
        $sql->execute();
        $resultado = array();
        while($row = $sql->fetchObject("Produto")){
            $resultado[] = $row;
        }
        return $resultado;
    }
    
    public static function criaProduto($params){
        $conn = Connection::getConn();
        $sql = $conn->prepare("INSERT INTO tb_produto (nome, descricao, quantidade, codigo, preco, data_de_compra, id_usuario) 
                                        VALUES (:NOME, :DESCRICAO, :QUANTIDADE, :CODIGO, :PRECO, :DATA_DE_COMPRA, :ID_USUARIO)");
        $sql->bindValue(":NOME", $params['nome']);
        $sql->bindValue(":DESCRICAO", $params['descricao']);
        $sql->bindValue(":QUANTIDADE", $params['quantidade']);
        $sql->bindValue(":CODIGO", $params['codigo']);
        $sql->bindValue(":PRECO", $params['preco']);
        $sql->bindValue(':DATA_DE_COMPRA', $params['data_de_compra']);
        $sql->bindValue(":ID_USUARIO", $params['id_usuario']);
        
        $res = $sql->execute();
    }
        public static function deletaProduto($id_produto){
        $conn = Connection::getConn();
        $sql = $conn->prepare("DELETE FROM tb_produto WHERE id_produto = :ID");
        $sql->bindValue(":ID", $id_produto);
        $sql->execute();
        if($sql->rowCount() > 0){
            return true;
        }
        throw new Exception("Não foi possivel deletar");
        return false;
    }

    public static function editaProduto($params){
        $conn = Connection::getConn();
        $sql = $conn->prepare("UPDATE tb_produto SET nome = :NOME, descricao = :DESCRICAO, quantidade = :QUANTIDADE, codigo = :CODIGO, 
                                                                preco = :PRECO, data_de_compra = :DATA_COMPRA WHERE id_produto = :ID");
        
        var_dump($params);
        $sql->bindValue(":NOME", $params['nome']);
        $sql->bindValue(":DESCRICAO", $params['descricao']);
        $sql->bindValue(":QUANTIDADE", $params['quantidade']);
        $sql->bindValue(":CODIGO", $params['codigo']);
        $sql->bindValue(":PRECO", $params['preco']);
        $sql->bindValue(":DATA_COMPRA", $params['data_de_compra']);
        $sql->bindValue(":ID", $params['id']);
        
        var_dump($params['id']);
        $sql->execute();
    }

}
?>