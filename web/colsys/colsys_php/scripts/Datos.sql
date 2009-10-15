/* Datos de Base */

Insert into tb_grupos (ca_descripcion) values ('Norte América');
Insert into tb_grupos (ca_descripcion) values ('Centro América');
Insert into tb_grupos (ca_descripcion) values ('Sur América');
Insert into tb_grupos (ca_descripcion) values ('Europa');
Insert into tb_grupos (ca_descripcion) values ('Mediano Oriente');
Insert into tb_grupos (ca_descripcion) values ('Lejano Oriente');

Insert into tb_tiporecargo (ca_descripcion) values ('Por Combustible');
Insert into tb_tiporecargo (ca_descripcion) values ('En Origen');
Insert into tb_tiporecargo (ca_descripcion) values ('En Destino');
Insert into tb_tiporecargo (ca_descripcion) values ('Otros');

Insert into tb_monedas (ca_idmoneda,ca_nombre,ca_referencia) values ('COP','Peso Colombiano','COP');
Insert into tb_monedas (ca_idmoneda,ca_nombre,ca_referencia) values ('USD','Dolar Americano','COP');
Insert into tb_monedas (ca_idmoneda,ca_nombre,ca_referencia) values ('EUR','Euro','USD');
Insert into tb_monedas (ca_idmoneda,ca_nombre,ca_referencia) values ('GBP','Libra Esterlina','USD');
Insert into tb_monedas (ca_idmoneda,ca_nombre,ca_referencia) values ('CAD','Dolar Canadiense','USD');
Insert into tb_monedas (ca_idmoneda,ca_nombre,ca_referencia) values ('JPY','Yen Japones','USD');
Insert into tb_monedas (ca_idmoneda,ca_nombre,ca_referencia) values ('CHF','Franco Suizo','USD');
Insert into tb_monedas (ca_idmoneda,ca_nombre,ca_referencia) values ('AUD','Dolar Australiano','USD');
Insert into tb_monedas (ca_idmoneda,ca_nombre,ca_referencia) values ('INR','Rupias Indias','USD');
Insert into tb_monedas (ca_idmoneda,ca_nombre,ca_referencia) values ('SGD','Dolar de Singapur','USD');
Insert into tb_monedas (ca_idmoneda,ca_nombre,ca_referencia) values ('SEK','Corona Sueca','USD');
Insert into tb_monedas (ca_idmoneda,ca_nombre,ca_referencia) values ('ZAR','Rand Sur Africano','USD');

Insert into tb_traficos (ca_idtrafico,ca_nombre,ca_bandera,ca_idmoneda,ca_idgrupo) values ('DE-049','Alemania','./graficos/alemania.gif','USD',4);
Insert into tb_traficos (ca_idtrafico,ca_nombre,ca_bandera,ca_idmoneda,ca_idgrupo) values ('AR-054','Argentina','./graficos/argentina.gif','USD',3);
Insert into tb_traficos (ca_idtrafico,ca_nombre,ca_bandera,ca_idmoneda,ca_idgrupo) values ('AU-061','Australia','./graficos/australia.gif','USD',6);
Insert into tb_traficos (ca_idtrafico,ca_nombre,ca_bandera,ca_idmoneda,ca_idgrupo) values ('AT-043','Austria','./graficos/austria.gif','USD',4); *
Insert into tb_traficos (ca_idtrafico,ca_nombre,ca_bandera,ca_idmoneda,ca_idgrupo) values ('BE-032','Belgica','./graficos/belgica.gif','USD',4);
Insert into tb_traficos (ca_idtrafico,ca_nombre,ca_bandera,ca_idmoneda,ca_idgrupo) values ('BR-055','Brasil','./graficos/brasil.gif','USD',3);
Insert into tb_traficos (ca_idtrafico,ca_nombre,ca_bandera,ca_idmoneda,ca_idgrupo) values ('CA-001','Canada','./graficos/canada.gif','USD',1);
Insert into tb_traficos (ca_idtrafico,ca_nombre,ca_bandera,ca_idmoneda,ca_idgrupo) values ('CL-056','Chile','./graficos/chile.gif','USD',3);
Insert into tb_traficos (ca_idtrafico,ca_nombre,ca_bandera,ca_idmoneda,ca_idgrupo) values ('CO-057','Colombia','./graficos/colombia.gif','USD',3);
Insert into tb_traficos (ca_idtrafico,ca_nombre,ca_bandera,ca_idmoneda,ca_idgrupo) values ('CR-506','Costa Rica','./graficos/costarica.gif','USD',2);
Insert into tb_traficos (ca_idtrafico,ca_nombre,ca_bandera,ca_idmoneda,ca_idgrupo) values ('DK-045','Dinamarca','./graficos/dinamarca.gif','USD',4);
Insert into tb_traficos (ca_idtrafico,ca_nombre,ca_bandera,ca_idmoneda,ca_idgrupo) values ('EC-593','Ecuador','./graficos/ecuador.gif','USD',3);
Insert into tb_traficos (ca_idtrafico,ca_nombre,ca_bandera,ca_idmoneda,ca_idgrupo) values ('SV-503','El Salvador','./graficos/elsalvador','USD',2);
Insert into tb_traficos (ca_idtrafico,ca_nombre,ca_bandera,ca_idmoneda,ca_idgrupo) values ('ES-034','España','./graficos/espana.gif','USD',4);
Insert into tb_traficos (ca_idtrafico,ca_nombre,ca_bandera,ca_idmoneda,ca_idgrupo) values ('US-001','Estados Unidos','./graficos/estadosun.gif','USD',1);
Insert into tb_traficos (ca_idtrafico,ca_nombre,ca_bandera,ca_idmoneda,ca_idgrupo) values ('FI-358','Finlandia','./graficos/finlandia.gif','USD',4);
Insert into tb_traficos (ca_idtrafico,ca_nombre,ca_bandera,ca_idmoneda,ca_idgrupo) values ('FR-033','Francia','./graficos/francia.gif','USD',4);
Insert into tb_traficos (ca_idtrafico,ca_nombre,ca_bandera,ca_idmoneda,ca_idgrupo) values ('GT-502','Guatemala','./graficos/guatemala.gif','USD',2);
Insert into tb_traficos (ca_idtrafico,ca_nombre,ca_bandera,ca_idmoneda,ca_idgrupo) values ('NL-031','Holanda','./graficos/holanda.gif','USD',4);
Insert into tb_traficos (ca_idtrafico,ca_nombre,ca_bandera,ca_idmoneda,ca_idgrupo) values ('HK-852','Hong Kong','./graficos/hongkong.gif','USD',6);
Insert into tb_traficos (ca_idtrafico,ca_nombre,ca_bandera,ca_idmoneda,ca_idgrupo) values ('IN-091','India','./graficos/india.gif','USD',5);
Insert into tb_traficos (ca_idtrafico,ca_nombre,ca_bandera,ca_idmoneda,ca_idgrupo) values ('ID-062','Indonesia','./graficos/indonesia.gif','USD',5);
Insert into tb_traficos (ca_idtrafico,ca_nombre,ca_bandera,ca_idmoneda,ca_idgrupo) values ('GB-044','Inglaterra','./graficos/inglaterra.gif','USD',4);
Insert into tb_traficos (ca_idtrafico,ca_nombre,ca_bandera,ca_idmoneda,ca_idgrupo) values ('IL-972','Israel','./graficos/israel.gif','USD',5);
Insert into tb_traficos (ca_idtrafico,ca_nombre,ca_bandera,ca_idmoneda,ca_idgrupo) values ('IT-039','Italia','./graficos/italia.gif','USD',4);
Insert into tb_traficos (ca_idtrafico,ca_nombre,ca_bandera,ca_idmoneda,ca_idgrupo) values ('JP-081','Japon','./graficos/japon.gif','USD',6);
Insert into tb_traficos (ca_idtrafico,ca_nombre,ca_bandera,ca_idmoneda,ca_idgrupo) values ('KR-082','Korea','./graficos/coreasur.gif','USD',6);
Insert into tb_traficos (ca_idtrafico,ca_nombre,ca_bandera,ca_idmoneda,ca_idgrupo) values ('MX-052','Mexico','./graficos/mexico.gif','USD',2);
Insert into tb_traficos (ca_idtrafico,ca_nombre,ca_bandera,ca_idmoneda,ca_idgrupo) values ('MY-060','Malasia','./graficos/malasia.gif','USD',6);
Insert into tb_traficos (ca_idtrafico,ca_nombre,ca_bandera,ca_idmoneda,ca_idgrupo) values ('NO-047','Noruega','./graficos/noruega.gif','USD',4);
Insert into tb_traficos (ca_idtrafico,ca_nombre,ca_bandera,ca_idmoneda,ca_idgrupo) values ('PA-507','Panama','./graficos/panama.gif','USD',2);
Insert into tb_traficos (ca_idtrafico,ca_nombre,ca_bandera,ca_idmoneda,ca_idgrupo) values ('PT-351','Portugal','./graficos/portugal.gif','USD',4);
Insert into tb_traficos (ca_idtrafico,ca_nombre,ca_bandera,ca_idmoneda,ca_idgrupo) values ('PE-051','Peru','./graficos/peru.gif','USD',3);
Insert into tb_traficos (ca_idtrafico,ca_nombre,ca_bandera,ca_idmoneda,ca_idgrupo) values ('SG-065','Singapur','./graficos/singapur.gif','USD',6);
Insert into tb_traficos (ca_idtrafico,ca_nombre,ca_bandera,ca_idmoneda,ca_idgrupo) values ('SE-046','Suecia','./graficos/suecia.gif','USD',4);
Insert into tb_traficos (ca_idtrafico,ca_nombre,ca_bandera,ca_idmoneda,ca_idgrupo) values ('CH-041','Suiza','./graficos/suiza.gif','USD',4);
Insert into tb_traficos (ca_idtrafico,ca_nombre,ca_bandera,ca_idmoneda,ca_idgrupo) values ('TH-066','Thailandia','./graficos/thailandia.gif','USD',6);
Insert into tb_traficos (ca_idtrafico,ca_nombre,ca_bandera,ca_idmoneda,ca_idgrupo) values ('TJ-886','Taiwan','./graficos/taiwan.gif','USD',6);
Insert into tb_traficos (ca_idtrafico,ca_nombre,ca_bandera,ca_idmoneda,ca_idgrupo) values ('TR-090','Turquia','./graficos/turquia.gif','USD',5);
Insert into tb_traficos (ca_idtrafico,ca_nombre,ca_bandera,ca_idmoneda,ca_idgrupo) values ('UY-598','Uruguay','./graficos/uruguay.gif','USD',3);
Insert into tb_traficos (ca_idtrafico,ca_nombre,ca_bandera,ca_idmoneda,ca_idgrupo) values ('VE-058','Venezuela','./graficos/venezuela.gif','USD',3);
