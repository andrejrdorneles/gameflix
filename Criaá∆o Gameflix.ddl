CREATE TABLE categoria (
    idcategoria   INTEGER NOT NULL,
    nome          VARCHAR2(100) NOT NULL,
    diaslocacao   DATE NOT NULL
);

ALTER TABLE categoria ADD CONSTRAINT categoria_pk PRIMARY KEY ( idcategoria );

CREATE TABLE cliente (
    idcliente        INTEGER NOT NULL,
    cpf              INTEGER NOT NULL,
    nome             VARCHAR2(255) NOT NULL,
    telefone         INTEGER NOT NULL,
    email            VARCHAR2(255) NOT NULL,
    datanascimento   DATE NOT NULL,
    idendereco       INTEGER NOT NULL
);

ALTER TABLE cliente ADD CONSTRAINT cliente_pk PRIMARY KEY ( idcliente );

CREATE TABLE desenvolvedora (
    iddesenvolvedora   INTEGER NOT NULL,
    nome               VARCHAR2(100) NOT NULL,
    urlimagem          VARCHAR2(500) NOT NULL
);

ALTER TABLE desenvolvedora ADD CONSTRAINT desenvolvedora_pk PRIMARY KEY ( iddesenvolvedora );

CREATE TABLE endereco (
    idendereco   INTEGER NOT NULL,
    rua          VARCHAR2(255) NOT NULL,
    numero       INTEGER NOT NULL,
    bairro       VARCHAR2(100) NOT NULL,
    cidade       VARCHAR2(255) NOT NULL,
    estado       VARCHAR2(2) NOT NULL,
    cep          INTEGER NOT NULL
);

ALTER TABLE endereco ADD CONSTRAINT endereco_pk PRIMARY KEY ( idendereco );

CREATE TABLE jogo (
    idjogo             INTEGER NOT NULL,
    nome               VARCHAR2(255) NOT NULL,
    urlimagem          VARCHAR2(500) NOT NULL,
    genero             INTEGER NOT NULL,
    datalancamento     DATE NOT NULL,
    iddesenvolvedora   INTEGER NOT NULL
);

ALTER TABLE jogo ADD CONSTRAINT jogo_pk PRIMARY KEY ( idjogo );

CREATE TABLE locacao (
    idlocacao       INTEGER NOT NULL,
    datalocacao     DATE NOT NULL,
    datadevolucao   DATE NOT NULL,
    status          INTEGER NOT NULL,
    idmidia         INTEGER NOT NULL,
    idpedido        INTEGER NOT NULL
);

ALTER TABLE locacao ADD CONSTRAINT locacao_pk PRIMARY KEY ( idlocacao );

CREATE TABLE midia (
    idmidia         INTEGER NOT NULL,
    plataforma      INTEGER NOT NULL,
    dataaquisicao   DATE NOT NULL,
    precolocacao    NUMBER NOT NULL,
    idjogo          INTEGER NOT NULL,
    idcategoria     INTEGER NOT NULL
);

ALTER TABLE midia ADD CONSTRAINT midia_pk PRIMARY KEY ( idmidia );

CREATE TABLE operador (
    idoperador   INTEGER NOT NULL,
    nome         VARCHAR2(255) NOT NULL,
    login        VARCHAR2(255) NOT NULL,
    senha        VARCHAR2(500) NOT NULL,
    urlimagem    VARCHAR2(500) NOT NULL
);

ALTER TABLE operador ADD CONSTRAINT operador_pk PRIMARY KEY ( idoperador );

CREATE TABLE pedido (
    idpedido       INTEGER NOT NULL,
    status         INTEGER NOT NULL,
    valortotal     NUMBER NOT NULL,
    valorquitado   NUMBER NOT NULL,
    dataretirada   DATE NOT NULL,
    idcliente      INTEGER NOT NULL,
    idoperador     INTEGER NOT NULL
);

ALTER TABLE pedido ADD CONSTRAINT pedido_pk PRIMARY KEY ( idpedido );

ALTER TABLE cliente
    ADD CONSTRAINT cliente_endereco_fk FOREIGN KEY ( idendereco )
        REFERENCES endereco ( idendereco );

ALTER TABLE jogo
    ADD CONSTRAINT jogo_desenvolvedora_fk FOREIGN KEY ( iddesenvolvedora )
        REFERENCES desenvolvedora ( iddesenvolvedora );

ALTER TABLE locacao
    ADD CONSTRAINT locacao_midia_fk FOREIGN KEY ( idmidia )
        REFERENCES midia ( idmidia );

ALTER TABLE locacao
    ADD CONSTRAINT locacao_pedido_fk FOREIGN KEY ( idpedido )
        REFERENCES pedido ( idpedido );

ALTER TABLE midia
    ADD CONSTRAINT midia_categoria_fk FOREIGN KEY ( idcategoria )
        REFERENCES categoria ( idcategoria );

ALTER TABLE midia
    ADD CONSTRAINT midia_jogo_fk FOREIGN KEY ( idjogo )
        REFERENCES jogo ( idjogo );

ALTER TABLE pedido
    ADD CONSTRAINT pedido_cliente_fk FOREIGN KEY ( idcliente )
        REFERENCES cliente ( idcliente );

ALTER TABLE pedido
    ADD CONSTRAINT pedido_operador_fk FOREIGN KEY ( idoperador )
        REFERENCES operador ( idoperador );


CREATE SEQUENCE clienteSEQ
  MINVALUE 1
  START WITH 1
  INCREMENT BY 1
  CACHE 0;

CREATE SEQUENCE operadorSEQ
  MINVALUE 1
  START WITH 1
  INCREMENT BY 1
  CACHE 0;

CREATE SEQUENCE jogoSEQ
  MINVALUE 1
  START WITH 1
  INCREMENT BY 1
  CACHE 0;

CREATE SEQUENCE pedidoSEQ
  MINVALUE 1
  START WITH 1
  INCREMENT BY 1
  CACHE 0;
  
CREATE SEQUENCE locacaoSEQ
  MINVALUE 1
  START WITH 1
  INCREMENT BY 1
  CACHE 0;

CREATE SEQUENCE midiaSEQ
  MINVALUE 1
  START WITH 1
  INCREMENT BY 1
  CACHE 0;

CREATE SEQUENCE desenvolvedoraSEQ
  MINVALUE 1
  START WITH 1
  INCREMENT BY 1
  CACHE 0;

CREATE SEQUENCE enderecoSEQ
  MINVALUE 1
  START WITH 1
  INCREMENT BY 1
  CACHE 0;

CREATE SEQUENCE categoriaSEQ
  MINVALUE 1
  START WITH 1
  INCREMENT BY 1
  CACHE 0;



  
create user GAMEFLIX identified by GAMEFLIX   default tablespace GAMEFLIXDAT;
grant connect, resource, create view, create sequence, debug any procedure, create synonym to GAMEFLIX;
alter user GAMEFLIX quota unlimited on GAMEFLIXDAT;

 Create tablespace GAMEFLIXDAT 
    datafile 'F:\ORACLEXE\APP\ORACLE\ORADATA\XE\GAMEFLIXDAT.DBF' 
    size 10m
    autoextend on
    next 100m 
     maxsize 500m;