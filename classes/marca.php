<?php
	class Marca {
		private $conn;
		
		function __construct() {
			$this->conn = require "../bd/connection.php";
		}
		
		function cadastrarMarca($nome){ //Cadastra a marca e retorna o id
			$sql = "INSERT INTO marca(nome) VALUES($1) RETURNING id";
			$result = pg_query_params($this->conn, $sql, array($nome));
			$row = pg_fetch_row ($result);
			return $row[0];
		}
		
		function editarMarca($id, $nome){
			$sql = "UPDATE marca SET nome = $1 WHERE id = $2";
			$result = pg_query_params($this->conn, $sql, array($nome, $id));
			$row = pg_fetch_row ($result);
			return $row;
		}
		
		function excluirMarca($id){
			$sql = "DELETE FROM marca WHERE id = $1";
			$result = pg_query_params($this->conn, $sql, array($id));
			$row = pg_fetch_row ($result);
			return $row;
		}
		
		function buscarMarcas(){
			$sql = "SELECT * FROM marca ORDER BY nome";
			$result = pg_query($this->conn, $sql);
			return $result;
		}
	}
?>