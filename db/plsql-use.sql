DECLARE
  PIDJOGO NUMBER;
  v_Return NUMBER;
BEGIN
  PIDJOGO := 1;

  v_Return := update_REGISTR_QUITACAO_PREVia(
    PIDJOGO => PIDJOGO
  );
    DBMS_OUTPUT.PUT_LINE('v_Return = ' || v_Return); 
END;
/


DECLARE
  v_Return midia_mais_pedida;
BEGIN

  v_Return := midia_mais_pedida_no_intervalo(
    pDataInicial => to_date('20/06/2019','dd/MM/YYYY'), pDataFinal => to_date('30/06/2019','dd/MM/YYYY')
  );
    DBMS_OUTPUT.PUT_LINE(v_return.idmidia);
    DBMS_OUTPUT.PUT_LINE(v_return.quantidade); 
END;
/


DECLARE
  pSoma NUMBER;
BEGIN
  calcula_valor_pedido(3, pSoma);
  DBMS_OUTPUT.PUT_LINE(pSoma);
END;
/


DECLARE
  pMedia NUMBER;
BEGIN
  media_locacoes_por_cliente(pMedia);
  DBMS_OUTPUT.PUT_LINE(pMedia);
END;
/


BEGIN
  calcula_data_devolucao(1);
END;