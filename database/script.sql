/* mer: */

CREATE TABLE clientes (
    id_cliente int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    cpf_cnpj_cliente char(20) UNIQUE NOT NULL,
    email char(50) UNIQUE NOT NULL,
    senha char(50) NOT NULL,
    nm_cliente char(50) NOT NULL,
    cep_cliente char(10) NOT NULL,
    cidade_cliente char(50) NOT NULL,
    estado_cliente char(30) NOT NULL,
    bairro_cliente char(50) NOT NULL,
    logradouro_cliente char(50) NOT NULL,
    nr_cliente int NOT NULL
);

CREATE TABLE vendedores (
    id_vendedor int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    cpf_cnpj_vendedor char(20) UNIQUE NOT NULL,
    nm_vendedor char(50) NOT NULL
);

CREATE TABLE compras (
    id_compra int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    vl_comissao decimal(10,2) NOT NULL,
    vl_transporte decimal(10,2) NOT NULL,
    cpf_cnpj_cliente char(20),
    cpf_cnpj_vendedor char(20),
    cpf_cnpj_transportadora char(20)
);

CREATE TABLE itens_compra (
    id_item_compra int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    vl_item_compra decimal(10,2) NOT NULL,
    qt_item_compra decimal(10,2) NOT NULL,
    id_compra int,
    id_produto int
);

CREATE TABLE produtos (
    id_produto int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nm_produto char(50) NOT NULL,
    ds_produto varchar(200) NOT NULL,
    vl_produto decimal(10,2) NOT NULL,
    qt_estoque decimal(10,2) NOT NULL,
    dimensoes_produto char(50) NOT NULL,
    peso_produto decimal(7,3) NOT NULL,
    status_produto char(10) NOT NULL DEFAULT 'Ativo',
    id_unidade_medida int,
    id_categoria int
);

CREATE TABLE categorias (
    id_categoria int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    ds_categoria char(100) NOT NULL
);

CREATE TABLE unidades_medida (
    id_unidade_medida int PRIMARY KEY NOT NULL AUTO_INCREMENT,
	sg_unidade_medida char(2) NOT NULL,
    ds_unidade_medida char(100) NOT NULL
);

CREATE TABLE imagens (
    id_imagem int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nm_imagem char(100) NOT NULL,
    id_produto int
);

CREATE TABLE transportadoras (
    id_transportadora int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    cpf_cnpj_transportadora char(20) UNIQUE,
    nm_transportadora char(50) NOT NULL,
    cep_transportadora char(10) NOT NULL,
    cidade_transportadora char(50) NOT NULL,
    estado_transportadora char(30) NOT NULL,
    bairro_transportadora char(50) NOT NULL,
    logradouro_transportadora char(50) NOT NULL,
    nr_transportadora int NOT NULL
);
 
ALTER TABLE compras ADD CONSTRAINT FK_compras_2
    FOREIGN KEY (cpf_cnpj_cliente)
    REFERENCES clientes (cpf_cnpj_cliente);
 
ALTER TABLE compras ADD CONSTRAINT FK_compras_3
    FOREIGN KEY (cpf_cnpj_transportadora)
    REFERENCES transportadoras (cpf_cnpj_transportadora);
 
ALTER TABLE compras ADD CONSTRAINT FK_compras_4
    FOREIGN KEY (cpf_cnpj_vendedor)
    REFERENCES vendedores (cpf_cnpj_vendedor);
 
ALTER TABLE itens_compra ADD CONSTRAINT FK_itens_compra_2
    FOREIGN KEY (id_compra)
    REFERENCES compras (id_compra);
 
ALTER TABLE itens_compra ADD CONSTRAINT FK_itens_compra_3
    FOREIGN KEY (id_produto)
    REFERENCES produtos (id_produto);
 
ALTER TABLE produtos ADD CONSTRAINT FK_produtos_2
    FOREIGN KEY (id_unidade_medida)
    REFERENCES unidades_medida (id_unidade_medida);
 
ALTER TABLE produtos ADD CONSTRAINT FK_produtos_3
    FOREIGN KEY (id_categoria)
    REFERENCES categorias (id_categoria);
 
ALTER TABLE imagens ADD CONSTRAINT FK_imagens_2
    FOREIGN KEY (id_produto)
    REFERENCES produtos (id_produto);