CREATE TABLE marca (
	id serial PRIMARY KEY,
	nome VARCHAR(40) NOT NULL
);

CREATE TABLE produto (
	codigo serial PRIMARY KEY,
	nome VARCHAR(100) NOT NULL,
	preco int,
	material VARCHAR(50),
	publico VARCHAR(20),
	tipo_fechamento VARCHAR(30),
	tem_amortecedor bool,
	tem_palmilha_antiodor bool,
	id_marca int,
	CONSTRAINT fk_marca
		FOREIGN KEY(id_marca)
			REFERENCES marca(id)
);

CREATE TABLE estoque_produto (
	id serial PRIMARY KEY,
	id_produto int,
	numeracao int,
	cor VARCHAR(30),
	quantidade int,
	CONSTRAINT fk_produto
		FOREIGN KEY(id_produto)
			REFERENCES produto(codigo)
);

CREATE TABLE endereco (
	id serial PRIMARY KEY,
	logradouro VARCHAR(100),
	numero int,
	complemento VARCHAR(30),
	cidade VARCHAR(50),
	estado VARCHAR(2),
	CEP VARCHAR(9),
	nome_associado VARCHAR(50)
);

CREATE TABLE cliente (
	CPF VARCHAR(14) PRIMARY KEY,
	nome_completo VARCHAR(200),
	sexo char,
	email VARCHAR(200),
	senha VARCHAR(50),
	telefone VARCHAR(20),
	id_endereco integer,
	CONSTRAINT fk_cliente
		FOREIGN KEY(id_endereco)
			REFERENCES endereco(id)
);
	
CREATE TABLE pedido (
	id serial PRIMARY KEY,
	data_hora timestamp,
	cpf_cliente VARCHAR(14),
	id_endereco_entrega int,
	CONSTRAINT fk_endereco
		FOREIGN KEY(id_endereco_entrega)
			REFERENCES endereco(id),
	CONSTRAINT fk_cliente
		FOREIGN KEY(cpf_cliente)
			REFERENCES cliente(CPF)
);

CREATE TABLE item_pedido (
	id serial PRIMARY KEY,
	valor int,
	tipo_embalagem VARCHAR(14),
	id_estoque_produto int,
	CONSTRAINT fk_estoque
		FOREIGN KEY(id_estoque_produto)
			REFERENCES estoque_produto(id)
);

ALTER TABLE IF EXISTS public.item_pedido
    ADD COLUMN id_pedido integer;
	
ALTER TABLE IF EXISTS public.item_pedido
    ADD CONSTRAINT fk_pedido FOREIGN KEY (id_pedido)
    REFERENCES public.pedido (id) MATCH SIMPLE
    ON UPDATE NO ACTION
    ON DELETE NO ACTION
    NOT VALID;