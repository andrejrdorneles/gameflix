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