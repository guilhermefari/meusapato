<?php
	class Pedido {
		private $conn;
		
		function __construct() {
			$this->conn = require "connection.php";
            require_once "ItemPedido.php";
		}
		
		function criarPedido($cpfCliente, $idEndereco){ 
			$sql = "INSERT INTO pedido (data_hora, cpf_cliente, id_endereco_entrega) VALUES(NOW(), $1, $2) RETURNING id";
			$result = pg_query_params($this->conn, $sql, array($cpfCliente, $idEndereco));
            $row = pg_fetch_row($result);
            return $row[0];
		}

        function cadastrarItem($item, $idPedido){
            $sql = "INSERT INTO item_pedido (valor, tipo_embalagem, id_estoque_produto, id_pedido) VALUES ($1, $2, $3, $4)";
            $result = pg_query_params($this->conn, $sql, (array($item->getValor(), $item->getTipoEmbalagem(), $item->getIdEstoqueProduto(), $idPedido)));
            return $result;
        }
		
	}
?>