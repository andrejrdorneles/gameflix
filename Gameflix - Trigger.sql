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
  
update pedido set valorquitado = 10.99 where idpedido = 3;
  
CREATE SEQUENCE alteracao_pedidoSEQ
MINVALUE 1
START WITH 1
INCREMENT BY 1
NOCACHE;

drop table alteracao_pedido
  
CREATE TABLE alteracao_pedido
( idalteracaopedido INTEGER,
  idpedido INTEGER,
  campoalterado VARCHAR(100),
  valoralterado VARCHAR(100),
  data date
);

select * from user_errors where type = 'TRIGGER' 