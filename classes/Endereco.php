<?php
	class Endereco {
		private $conn;
		
		function __construct() {
			$this->conn = require "connection.php";
		}
		
		function cadastrarEndereco($logradouro, $numero, $complemento, $cidade, $estado, $cep, $nomeAssociado){ //Cadastra a Endereço e retorna o código
			$sql = "INSERT INTO endereco(logradouro, numero, complemento, cidade, estado, cep, nome_associado) VALUES($1, $2, $3, $4, $5, $6, $7) RETURNING id";
			$result = pg_query_params($this->conn, $sql, array($logradouro, $numero, $complemento, $cidade, $estado, $cep, $nomeAssociado));
			$row = pg_fetch_row ($result);
			return $row[0];
		}
		
		function editarEndereco($id, $logradouro, $numero, $complemento, $cidade, $estado, $cep, $nomeAssociado){
			$sql = "UPDATE endereco SET logradouro = $1, numero=$2, complemento=$3, cidade=$4, estado=$5, cep=$6, nome_associado=$7 WHERE id = $8";
			$result = pg_query_params($this->conn, $sql, array($logradouro, $numero, $complemento, $cidade, $estado, $cep, $nomeAssociado, $id));
			$row = pg_fetch_row ($result);
			return $row;
		}
		
		function excluirEndereco($id){
			$sql = "DELETE FROM endereco WHERE codigo = $1";
			$result = pg_query_params($this->conn, $sql, array($codigo));
			$row = pg_fetch_row ($result);
			return $row;
		}
		
		function buscarEnderecos(){
			$sql = "SELECT * FROM endereco ORDER BY estado";
			$result = pg_query($this->conn, $sql);
			return $result;
		}

		function buscarEnderecoPorCliente($idCliente){
			$sql = "SELECT id, logradouro, numero, complemento, cidade, estado, cep, nome_associado FROM cliente INNER JOIN endereco ON cliente.id_endereco = endereco.id WHERE id = $1";
			$result = pg_query_params($this->conn, $sql, array($idCliente));
			return $result;
		}
	}
?>