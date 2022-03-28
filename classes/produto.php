<?php
	class Produto {
		private $conn;
		
		function __construct() {
			$this->conn = require "connection.php";
		}
		
		function cadastrarProduto($nome, $preco, $material, $publico, $tipoFechamento, $id_marca, $amortecedor, $palmilhaAntiOdor){ //Cadastra a Produto e retorna o código
			$sql = "INSERT INTO produto(nome, preco, material, publico, tipo_fechamento, tem_amortecedor, tem_palmilha_antiodor, id_marca) VALUES($1, $2, $3, $4, $5, $6, $7, $8) RETURNING codigo";
			$result = pg_query_params($this->conn, $sql, array($nome, $preco, $material, $publico, $tipoFechamento, $amortecedor, $palmilhaAntiOdor, $id_marca));
			$row = pg_fetch_row ($result);
			return $row[0];
		}
		
		function editarProduto($codigo, $nome, $preco, $material, $publico, $tipoFechamento, $id_marca, $amortecedor, $palmilhaAntiOdor){
			$sql = "UPDATE produto SET nome = $1, preco=$2, material=$3, publico=$4, tipo_fechamento=$5, tem_amortecedor=$6, tem_palmilha_antiodor=$7, id_marca=$8 WHERE codigo = $9";
			$result = pg_query_params($this->conn, $sql, array($nome, $preco, $material, $publico, $tipoFechamento, $id_marca, $amortecedor, $palmilhaAntiOdor, $codigo));
			$row = pg_fetch_row ($result);
			return $row;
		}
		
		function excluirProduto($codigo){
			$sql = "DELETE FROM produto WHERE codigo = $1";
			$result = pg_query_params($this->conn, $sql, array($codigo));
			$row = pg_fetch_row ($result);
			return $row;
		}
		
		function buscarProdutos(){
			$sql = "SELECT * FROM produto ORDER BY nome";
			$result = pg_query($this->conn, $sql);
			return $result;
		}

		function contarProdutos(){ //retorna a quantidade de produtos cadastrados
			$result = pg_query($this->conn, "SELECT COUNT(codigo) FROM produto");
			$row = pg_fetch_row ($result);
			return $row[0];
		}

		function buscarProdutosComMarca(){
			$sql = "SELECT codigo, produto.nome, material, publico, tipo_fechamento, tem_amortecedor, tem_palmilha_antiodor, marca.nome AS marca, preco
			FROM produto INNER JOIN marca ON produto.id_marca = marca.id";
			$result = pg_query($this->conn, $sql);
			return $result;
		}
	}
?>