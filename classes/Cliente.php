<?php
	class Cliente {
		private $conn;
		
		function __construct() {
			$this->conn = require "connection.php";
		}
		
		function cadastrarCliente($cpf, $nome, $sexo, $email, $senha, $telefone, $idEndereco){ 
			$sql = "INSERT INTO cliente VALUES($1, $2, $3, $4, $5, $6, $7)";
			$result = pg_query_params($this->conn, $sql, array($cpf, $nome, $sexo, $email, $senha, $telefone, $idEndereco));
			$row = pg_fetch_row ($result);
			return $row;
		}
		
		function editarCliente($cpf, $nome, $sexo, $email, $senha, $telefone, $idEndereco){
			$sql = "UPDATE cliente SET nome_completo = $1, sexo=$2, email=$3, senha=$4, telefone=$5, idEndereco=$6 WHERE cpf = $7";
			$result = pg_query_params($this->conn, $sql, array($nome, $sexo, $email, $senha, $telefone, $idEndereco, $cpf));
			$row = pg_fetch_row ($result);
			return $row;
		}
		
		function excluirCliente($cpf){
			$sql = "DELETE FROM cliente WHERE cpf = $1";
			$result = pg_query_params($this->conn, $sql, array($cpf));
			$row = pg_fetch_row ($result);
			return $row;
		}
		
		function buscarClientes(){
			$sql = "SELECT * FROM cliente ORDER BY nome_completo";
			$result = pg_query($this->conn, $sql);
			return $result;
		}

		function buscarClientePorCPF($cpf){
			$sql = "SELECT id, logradouro, numero, complemento, cidade, estado, cep, nome_associado FROM cliente INNER JOIN endereco ON id_endereco = endereco.id WHERE cpf = $1";
			$result = pg_query_params($this->conn, $sql, array($cpf));
			return $result;
		}

		function login($email, $senha){
			$sql = "SELECT * FROM cliente WHERE email=$1 AND senha=$2";
			$result = pg_query_params($this->conn, $sql, array($email, $senha));
			return $result;
		}
	}
?>