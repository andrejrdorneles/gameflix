DROP TABLE alteracao_pedido;
DROP TABLE categoria;
DROP TABLE cliente;
DROP TABLE desenvolvedora;
DROP TABLE endereco;
DROP TABLE jogo;
DROP TABLE locacao;
DROP TABLE midia;
DROP TABLE operador;
DROP TABLE pedido;

DROP PACKAGE pck_gameflix_functions;

DROP FUNCTION atualizar_registro_quitacao_previa; 
DROP FUNCTION buscar_midias_disponiveis_com_categoria;
DROP FUNCTION midia_mais_pedida_no_intervalo;

DROP PROCEDURE calcula_data_devolucao;
DROP PROCEDURE calcula_valor_pedido;
DROP PROCEDURE media_locacoes_por_cliente;

DROP TRIGGER armazena_alteracao_pedido;

DROP TYPE midia_disponivel FORCE;
DROP TYPE midia_mais_pedida FORCE;
DROP TYPE midias_disponiveis FORCE;
