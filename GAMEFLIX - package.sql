create or replace package pck_gameflix_functions is

  function midia_mais_pedida_no_intervalo(pDataInicial DATE, pDataFinal DATE) return midia_mais_pedida;
  function get_midias_disp_c_categ return midias_disponiveis;
  function update_regist_quitacao_prev (pIdJogo NUMBER) return NUMBER;
  
end pck_gameflix_functions;

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