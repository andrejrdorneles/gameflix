create or replace
  TRIGGER armazena_alteracao_pedido 
  after UPDATE ON pedido 
  for each row
BEGIN

  IF :new.status != :old.status THEN
      insert into alteracao_pedido values (alteracao_pedidoSEQ.nextval, :old.idpedido, 'Status', TO_CHAR(:new.status), sysdate);
  ELSIF :new.valortotal != :old.valortotal THEN
      insert into alteracao_pedido values (alteracao_pedidoSEQ.nextval, :old.idpedido, 'Valor Total', TO_CHAR(:new.valortotal), sysdate);
  ELSIF :new.valorquitado != :old.valorquitado THEN
      insert into alteracao_pedido values (alteracao_pedidoSEQ.nextval, :old.idpedido, 'Valor Quitado', TO_CHAR(:new.valorquitado), sysdate);
  ELSIF :new.dataretirada != :old.dataretirada THEN
      insert into alteracao_pedido values (alteracao_pedidoSEQ.nextval, :old.idpedido, 'Data Retirada', TO_CHAR(:new.dataretirada, 'YYYY-MM-DD'), sysdate);
  ELSIF :new.idcliente != :old.idcliente THEN
      insert into alteracao_pedido values (alteracao_pedidoSEQ.nextval, :old.idpedido, 'Cliente', TO_CHAR(:new.idcliente), sysdate);
  ELSIF :new.idoperador != :old.idoperador THEN
        insert into alteracao_pedido values (alteracao_pedidoSEQ.nextval, :old.idpedido, 'Operador', TO_CHAR(:new.idoperador), sysdate);
  ELSE
        insert into alteracao_pedido values (alteracao_pedidoSEQ.nextval, :old.idpedido, 'Id', TO_CHAR(:new.idpedido), sysdate);
  END IF;
END;
/



create or replace
  TRIGGER inserir_id_categoria
  before insert ON categoria
  for each row
BEGIN

:new.idcategoria := CategoriaSEQ.nextval;

END inserir_id_categoria;
/

create or replace
  TRIGGER inserir_id_cliente
  before insert ON cliente
  for each row
BEGIN

:new.idcliente := ClienteSEQ.nextval;

END inserir_id_cliente;
/

create or replace
  TRIGGER inserir_id_desenvolvedora
  before insert ON desenvolvedora
  for each row
BEGIN

:new.iddesenvolvedora := DesenvolvedoraSEQ.nextval;

END inserir_id_desenvolvedora;
/

create or replace
  TRIGGER inserir_id_endereco
  before insert ON endereco
  for each row
BEGIN

:new.idendereco := EnderecoSEQ.nextval;

END inserir_id_endereco;
/

create or replace
  TRIGGER inserir_id_jogo
  before insert ON jogo
  for each row
BEGIN

:new.idjogo := JogoSEQ.nextval;

END inserir_id_jogo;
/

create or replace
  TRIGGER inserir_id_locacao
  before insert ON locacao
  for each row
BEGIN

:new.idlocacao := LocacaoSEQ.nextval;

END inserir_id_locacao;
/

create or replace
  TRIGGER inserir_id_midia
  before insert ON midia
  for each row
BEGIN

:new.idmidia := MidiaSEQ.nextval;

END inserir_id_midia;
/

create or replace
  TRIGGER inserir_id_operador
  before insert ON operador
  for each row
BEGIN

:new.idoperador := OperadorSEQ.nextval;

END inserir_id_operador;
/

create or replace
  TRIGGER inserir_id_pedido
  before insert ON pedido
  for each row
BEGIN

:new.idpedido := PedidoSEQ.nextval;

END inserir_id_pedido;
/



CREATE OR REPLACE TYPE midia_disponivel AS OBJECT ( idmidia INTEGER, nomejogo VARCHAR(255), nomeplat VARCHAR(255), nomecat VARCHAR(255));
/
CREATE OR REPLACE TYPE midias_disponiveis AS TABLE OF midia_disponivel; 
/
CREATE OR REPLACE TYPE midia_mais_pedida AS OBJECT ( idmidia INTEGER, quantidade INTEGER);
/



create or replace package pck_gameflix_functions is

  function midia_mais_pedida_no_intervalo(pDataInicial DATE, pDataFinal DATE) return midia_mais_pedida;
  function get_midias_disp_c_categ return midias_disponiveis;
  function update_regist_quitacao_prev (pIdJogo NUMBER) return NUMBER;
  
end pck_gameflix_functions;
/

create or replace package body pck_gameflix_functions is

    FUNCTION midia_mais_pedida_no_intervalo(pDataInicial DATE, pDataFinal DATE) return midia_mais_pedida IS
        midia_contagem midia_mais_pedida;
    
        v_contagem NUMBER;
        v_idmidia NUMBER;
    BEGIN
    
        SELECT contagem, idmidia INTO v_contagem, v_idmidia FROM (
        SELECT count(*) as contagem, m.idmidia as idmidia from pedido p inner join locacao l on l.idpedido = p.idpedido
        inner join midia m on m.idmidia = l.idmidia 
        where p.dataretirada between pDataInicial and pDataFinal
        group by m.idmidia order by contagem desc) temp where rownum = 1;
        
        midia_contagem := midia_mais_pedida(v_idmidia, v_contagem);
        
        RETURN midia_contagem;
    
    END midia_mais_pedida_no_intervalo;

    FUNCTION get_midias_disp_c_categ return midias_disponiveis IS
    v_midias_disponiveis  midias_disponiveis := midias_disponiveis();
    
    CURSOR midias IS
    select m.idmidia as IdMidia, j.nome as NomeJogo, m.plataforma as NomePlat, cat.nome as NomeCat
    from midia m
    inner join jogo j on j.idjogo = m.idjogo
    inner join locacao l on l.idmidia = m.idmidia
    inner join categoria cat on m.idcategoria = cat.idcategoria
    where l.status != 1;
    
    v_numero INTEGER := 1;

    BEGIN
        FOR item IN midias
        LOOP
            v_midias_disponiveis.extend;  
            v_midias_disponiveis(v_numero) := midia_disponivel(item.IdMidia, item.NomeJogo, item.NomePlat, item.NomeCat );
            v_numero := v_numero + 1;
        END LOOP;
        
        RETURN v_midias_disponiveis;
    END get_midias_disp_c_categ;
    
    FUNCTION update_regist_quitacao_prev(pIdJogo NUMBER) return NUMBER IS
    v_valor_restante number;

    v_idpedido pedido.idpedido%type;
    v_preco_locacao midia.precolocacao%type;
    
    BEGIN
        
        SELECT p.idpedido, (p.valortotal - m.precolocacao) as valorrestante, m.precolocacao into v_idpedido, v_valor_restante, v_preco_locacao
        from pedido p 
        inner join locacao l on l.idpedido = p.idpedido 
        inner join midia m on l.idmidia = m.idmidia
        inner join jogo j on j.idjogo = m.idjogo
        and l.status = 1
        and j.idjogo = 1;
        
        update locacao l set l.status = 2 where l.idpedido = v_idpedido;
        update pedido p set p.valorquitado = v_preco_locacao where p.idpedido = v_idpedido;
        
        RETURN v_valor_restante;
    
    END update_regist_quitacao_prev;

end pck_gameflix_functions;
/


CREATE OR REPLACE FUNCTION get_midias_dispon_com_categ return midias_disponiveis IS
    v_midias_disponiveis  midias_disponiveis := midias_disponiveis();
    
    CURSOR midias IS
    select m.idmidia as IdMidia, j.nome as NomeJogo, m.plataforma as NomePlat, cat.nome as NomeCat
    from midia m
    inner join jogo j on j.idjogo = m.idjogo
    inner join locacao l on l.idmidia = m.idmidia
    inner join categoria cat on m.idcategoria = cat.idcategoria
    where l.status != 1;
    
    v_numero INTEGER := 1;

BEGIN
    FOR item IN midias
    LOOP
        v_midias_disponiveis.extend;  
        v_midias_disponiveis(v_numero) := midia_disponivel(item.IdMidia, item.NomeJogo, item.NomePlat, item.NomeCat );
        v_numero := v_numero + 1;
    END LOOP;
    
    RETURN v_midias_disponiveis;
END get_midias_dispon_com_categ;
/


CREATE OR REPLACE FUNCTION update_registr_quitacao_previa(pIdJogo NUMBER) return NUMBER IS
    v_valor_restante number;

v_idpedido pedido.idpedido%type;
v_preco_locacao midia.precolocacao%type;

BEGIN

  SELECT p.idpedido, (p.valortotal - m.precolocacao) as valorrestante, m.precolocacao into v_idpedido, v_valor_restante, v_preco_locacao
  from pedido p 
  inner join locacao l on l.idpedido = p.idpedido 
  inner join midia m on l.idmidia = m.idmidia
  inner join jogo j on j.idjogo = m.idjogo
  and l.status = 1
  and j.idjogo = 1;

  update locacao l set l.status = 2 where l.idpedido = v_idpedido;
  update pedido p set p.valorquitado = v_preco_locacao where p.idpedido = v_idpedido;

  RETURN v_valor_restante;

END update_registr_quitacao_previa;
/


CREATE OR REPLACE FUNCTION midia_mais_pedida_no_intervalo(pDataInicial DATE, pDataFinal DATE) return midia_mais_pedida IS
    midia_contagem midia_mais_pedida;

    v_contagem NUMBER;
    v_idmidia NUMBER;
BEGIN

  SELECT contagem, idmidia INTO v_contagem, v_idmidia FROM (
  SELECT count(*) as contagem, m.idmidia as idmidia from pedido p inner join locacao l on l.idpedido = p.idpedido
  inner join midia m on m.idmidia = l.idmidia 
  where p.dataretirada between pDataInicial and pDataFinal
  group by m.idmidia order by contagem desc) temp where rownum = 1;

  midia_contagem := midia_mais_pedida(v_idmidia, v_contagem);

  RETURN midia_contagem;

END midia_mais_pedida_no_intervalo;
/


CREATE OR REPLACE PROCEDURE calcula_valor_pedido(pIdPedido IN integer, pSomaValoresLocacoes OUT NUMBER) as 
BEGIN

  select sum(precolocacao) into pSomaValoresLocacoes from locacao inner join midia on locacao.idmidia = midia.idmidia
  inner join pedido p on locacao.idpedido = p.idpedido where p.idpedido = pidpedido;
  update pedido set valortotal = pSomaValoresLocacoes where pedido.idpedido = pIdPedido; 

END;
/


CREATE OR REPLACE PROCEDURE media_locacoes_por_cliente(media OUT NUMBER) is
v_contagem_locacoes INTEGER;
v_contagem_clientes INTEGER;

BEGIN
  select count(*) into v_contagem_locacoes from locacao;
  select count(*) into v_contagem_clientes from cliente;

  media := v_contagem_locacoes/ v_contagem_clientes;

END media_locacoes_por_cliente;
/


CREATE OR REPLACE PROCEDURE calcula_data_devolucao(pIdmidia IN INTEGER) is
v_dias_locacao INTEGER;

BEGIN

SELECT diaslocacao into v_dias_locacao from categoria c 
  inner join midia m on m.idcategoria = c.idcategoria
  inner join locacao l on l.idmidia = m.idmidia 
  where m.idmidia = pIdmidia 
  and l.status = 1;

  UPDATE locacao l set l.datadevolucao = sysdate + v_dias_locacao where l.idmidia = pIdmidia and l.status = 1;

END calcula_data_devolucao;
/
