
INSERT INTO CATEGORIA VALUES (CATEGORIASEQ.nextval, 'Lançamento', 5);
INSERT INTO DESENVOLVEDORA VALUES(DESENVOLVEDORASEQ.nextval, 'CD Projekt', 'https://pbs.twimg.com/profile_images/924947343077773312/8KIZSNlv_400x400.jpg');
INSERT INTO JOGO VALUES (JOGOSEQ.nextval, 'Cyberpunk 2077', 'https://media.comicbook.com/2019/06/cyberpunk-2077-non-lethal-1174992-1280x0.jpeg', 1, sysdate, 1);
INSERT INTO MIDIA VALUES(MIDIASEQ.nextval, 1, sysdate, 7.99, 1, 1);


INSERT INTO LOCACAO VALUES(LOCACAOSEQ.nextval, sysdate, NULL, 1, 1, 3);
INSERT INTO PEDIDO VALUES(PEDIDOSEQ.nextval, 1, NULL, NULL, sysdate, 3 ,1);
INSERT INTO CLIENTE VALUES(CLIENTESEQ.nextval, 123456789, 'Maria Antonieta Da Áustria', 51912341234, 'maria.antonieta@hotmail.com.fr', '02/11/1755',  1);
INSERT INTO ENDERECO VALUES (ENDERECOSEQ.nextval, 'Av. Unisinos', 67, 'Cristo Rei', 'São Leopoldo', 'RS', 	93022750 );
INSERT INTO OPERADOR VALUES (OPERADORSEQ.nextval, 'Jeanne-Antoinette Poisson', 'jeanne.poisson', 'umasenhaai', 'https://i.pinimg.com/originals/92/ab/0d/92ab0de0f32c1af1ff5851b0538ac0b3.jpg');