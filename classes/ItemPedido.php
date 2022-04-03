<?php
	class ItemPedido {
        
        private $valor, $tipo_embalagem, $id_estoque_produto;

		function __construct($valor, $tipo_embalagem, $id_estoque_produto) {
			$this->valor = $valor;
			$this->tipo_embalagem = $tipo_embalagem;
			$this->id_estoque_produto = $id_estoque_produto;
		}

        function getValor(){
            return $this->valor;
        }

        function getTipoEmbalagem(){
            return $this->tipo_embalagem;
        }

        function getIdEstoqueProduto(){
            return $this->id_estoque_produto;
        }

        function setTipoEmbalagem($tipo){
            $this->tipo_embalagem = $tipo;
        }
    }

?>