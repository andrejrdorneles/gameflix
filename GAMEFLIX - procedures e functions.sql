CREATE OR REPLACE TYPE midias_disponiveis AS TABLE OF midia_disponivel; 
CREATE OR REPLACE TYPE midia_disponivel AS OBJECT ( idmidia INTEGER, nomejogo VARCHAR(255), nomeplat VARCHAR(255), nomecat VARCHAR(255));

CREATE OR REPLACE FUNCTION buscar_midias_disponiveis_com_categoria return midias_disponiveis IS
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
END buscar_midias_disponiveis_com_categoria;

SELECT * FROM TABLE(buscar_midias_disponiveis_com_categoria);

CREATE OR REPLACE FUNCTION atualizar_registro_quitacao_previa(pIdJogo NUMBER) return NUMBER IS
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

END atualizar_registro_quitacao_previa;

DECLARE
  PIDJOGO NUMBER;
  v_Return NUMBER;
BEGIN
  PIDJOGO := 1;

  v_Return := ATUALIZAR_REGISTRO_QUITACAO_PREVIA(
    PIDJOGO => PIDJOGO
  );
    DBMS_OUTPUT.PUT_LINE('v_Return = ' || v_Return); 
END;

CREATE OR REPLACE TYPE midia_mais_pedida AS OBJECT ( idmidia INTEGER, quantidade INTEGER);
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

DECLARE
  v_Return midia_mais_pedida;
BEGIN

  v_Return := midia_mais_pedida_no_intervalo(
    pDataInicial => to_date('20/06/2019','dd/MM/YYYY'), pDataFinal => to_date('30/06/2019','dd/MM/YYYY')
  );
    DBMS_OUTPUT.PUT_LINE(v_return.idmidia);
    DBMS_OUTPUT.PUT_LINE(v_return.quantidade); 
END;

CREATE OR REPLACE PROCEDURE calcula_valor_pedido(pIdPedido IN integer, pSomaValoresLocacoes OUT NUMBER) as 
BEGIN

select sum(precolocacao) into pSomaValoresLocacoes from locacao inner join midia on locacao.idmidia = midia.idmidia
inner join pedido p on locacao.idpedido = p.idpedido where p.idpedido = pidpedido;
update pedido set valortotal = pSomaValoresLocacoes where pedido.idpedido = pIdPedido; 

END;

DECLARE
  pSoma NUMBER;
BEGIN
  calcula_valor_pedido(3, pSoma);
  DBMS_OUTPUT.PUT_LINE(pSoma);
END;

CREATE OR REPLACE PROCEDURE media_locacoes_por_cliente(media OUT NUMBER) is
v_contagem_locacoes INTEGER;
v_contagem_clientes INTEGER;

BEGIN
select count(*) into v_contagem_locacoes from locacao;
select count(*) into v_contagem_clientes from cliente;

media := v_contagem_locacoes/ v_contagem_clientes;

END media_locacoes_por_cliente;

DECLARE
  pMedia NUMBER;
BEGIN
  media_locacoes_por_cliente(pMedia);
  DBMS_OUTPUT.PUT_LINE(pMedia);
END;

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

BEGIN
  calcula_data_devolucao(1);
END;