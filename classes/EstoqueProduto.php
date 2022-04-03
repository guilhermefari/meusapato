<?php
	class EstoqueProduto {
		private $conn;
		
		function __construct() {
			$this->conn = require "connection.php";
		}
		
		function cadastrarEstoque($idProduto, $numeracao, $cor, $quantidade){
            //busca no bd para ver se já existe essa combinação de valores
            $queryEstoque = "SELECT id FROM estoque_produto WHERE id_produto=$1 AND numeracao=$2 AND cor=$3;";
            $resultEstoque = pg_query_params($this-> conn, $queryEstoque, array($idProduto, $numeracao, $cor));
    
            while($row = pg_fetch_row($resultEstoque)){ //se tiver resultado, apenas incrementa
                $updateQuery = "UPDATE estoque_produto SET quantidade = quantidade + $1 WHERE id = $2";
                $resultUpdate = pg_query_params($this->conn, $updateQuery, array($quantidade, $row[0]));
                return $row[0];
            }

            //se não tem resultado, realiza o cadastro
			$sql = "INSERT INTO estoque_produto(id_produto, numeracao, cor, quantidade) VALUES($1, $2, $3, $4) RETURNING id";
			$result = pg_query_params($this->conn, $sql, array($idProduto, $numeracao, $cor, $quantidade));
			$row = pg_fetch_row ($result);
			return $row[0];
		}
		
		function abaixarEstoque($id, $quantidade){
			$sql = "UPDATE estoque_produto SET quantidade = quantidade - $1 WHERE id = $2";
			$result = pg_query_params($this->conn, $sql, array($quantidade, $id));
			$row = pg_fetch_row ($result);
			return $row[0];
		}
		
		function buscarEstoqueProduto($idProduto){
			$sql = "SELECT * FROM estoque_produto WHERE id_produto=$1";
			$result = pg_query_params($this->conn, $sql, array($idProduto));
			return $result;
		}

		function buscarMaiorId(){
			$sql = "SELECT MAX(id) FROM estoque_produto";
			$result = pg_query($this->conn, $sql);
			$row = pg_fetch_row ($result);
			return $row[0];
		}

		function buscarInformacoes($estoqueId){
			$sql = "SELECT * FROM estoque_produto INNER JOIN produto ON estoque_produto.id_produto = produto.codigo WHERE id = $1";
			$result = pg_query_params($this->conn, $sql, array($estoqueId));
			return $result;
		}
	}
?>