<?php

class Vendas{
    public static function inserirVenda($params){
        $conn = Connection::getConn();
        $sql = $conn->prepare("INSERT INTO tb_vendas (id_produto, id_usuario, preco_produto, data_venda) VALUES (:ID_PRODUTO, :ID_USUARIO, :PRECO_PRODUTO, :DATA_VENDA)");
        $sql->bindValue(":ID_PRODUTO", $params['id_produto']);
        $sql->bindValue(":ID_USUARIO", $params['id_usuario']);
        $sql->bindValue(":PRECO_PRODUTO", $params['preco'] * $params['quantidade']);
        $sql->bindValue(":DATA_VENDA", $params['data_de_venda']);
        $sql->execute();
    }

    public static function selecionaVendas($id_usuario){
        $conn = Connection::getConn();
        $sql = $conn->prepare("SELECT * FROM tb_vendas WHERE id_usuario = :ID");
        $sql->bindValue(':ID', $id_usuario);
        $sql->execute();
        $resultado = array();
        while($row = $sql->fetchObject("Produto")){
            $row->data_de_compra = Produto::converteData($row->data_venda);
            $resultado[] = $row;
        }
        return $resultado;
    }
}

?>