echo "  <TD style='vertical-align=top; text-align: left' COLSPAN=4>Detalles: <TEXTAREA ID=fobsv_$i Class=field READONLY NAME='productos[$i][fobsv]' WRAP=virtual ROWS=1 COLS=80>".$tm->Value('ca_observaciones')."</TEXTAREA></TD>";

echo "  <TD style='vertical-align=top; text-align: left' COLSPAN=4>Detalles: <INPUT ID=fobsv_$i Class=field TYPE='TEXT' READONLY NAME='productos[$i][fobsv]' VALUE='".$tm->Value('ca_observaciones')."'></TD>";


Comandos SQL para acutalizar

update control.tb_niveles set ca_nivel = 0 where ca_nivel = 'Usuario';
update control.tb_niveles set ca_nivel = 5 where ca_nivel = 'Superusuario';
update control.tb_niveles set ca_nivel = 4 where ca_basededatos = 'Coltrans' and ca_login = 'thomaspeters';
update control.tb_niveles set ca_nivel = 3 where ca_basededatos = 'Coltrans' and ca_login = 'parteaga';
update control.tb_niveles set ca_nivel = 2 where ca_basededatos = 'Coltrans' and ca_login = 'bbetancourt';
update control.tb_niveles set ca_nivel = 2 where ca_basededatos = 'Coltrans' and ca_login = 'clozano';
update control.tb_usuarios set ca_rutinas = replace (ca_rutinas,'0101800000','0101300000') where ca_rutinas like '%0101800000%';
update control.tb_usuarios set ca_rutinas = replace (ca_rutinas,'0101100000','0300200000') where ca_rutinas like '%0101100000%';
delete from control.tb_rutinas where ca_rutina = '0101800000';
delete from control.tb_rutinas where ca_rutina = '0101100000';
update control.tb_rutinas set ca_rutina = 'liberaciones.php' where ca_rutina = '0300200000';
drop sequence tb_liberaciones_id;
drop view vi_liberaciones;
drop table tb_liberaciones;
update tb_clientes set ca_compania = 'FERRETERIA SUMIVALLE LTDA.' where ca_idcliente = 800034768;
update tb_clientes set ca_compania = 'FERRETERIA BARBOSA & CIA. S EN C' where ca_idcliente = 890308587;
update tb_clientes set ca_compania = 'C.I. FARMACAPSULAS DE COLOMBIA S.A.' where ca_idcliente = 890115118;
update tb_clientes set ca_compania = 'URIGO LTDA.' where ca_idcliente = 860006237;
update tb_clientes set ca_compania = 'COMPAÑÍA COLOMBIANA DE TABACO S.A.' where ca_idcliente = 890900043;
update tb_clientes set ca_compania = 'COMERCIALIZADORA INTERNACIONAL DE PARTES UNIPARTES LTDA.' where ca_idcliente = 800255686;
update tb_clientes set ca_compania = 'LATINOTEX LTDA.' where ca_idcliente = 830066909;
update tb_clientes set ca_compania = 'PROMOTORA INTERNACIONAL DE PARTES LTDA PROPARTES' where ca_idcliente = 860350170;
update tb_clientes set ca_compania = 'FABRICA DE TORNILLOS GUTEMBERTO S.A.' where ca_idcliente = 860001111;
update tb_clientes set ca_compania = 'ANIPLAST LTDA.' where ca_idcliente = 860536001;

update tb_clientes set ca_compania = 'EL PORTON DEL CRISTAL Y CIA LTDA.' where ca_idcliente = 811005516;
update tb_clientes set ca_compania = 'HEILDELBERG COLOMBIA S.A.' where ca_idcliente = 830044682;
update tb_clientes set ca_compania = 'INVERSIONES AJOVECO S.A.' where ca_idcliente = 860010268;
update tb_clientes set ca_compania = 'TEXTILIA S.A.' where ca_idcliente = 860027136;
update tb_clientes set ca_compania = 'BASF QUIMICA COLOMBIANA S.A.' where ca_idcliente = 860030619;
update tb_clientes set ca_compania = 'GRUPO SIDERURGICO DIACO S.A.' where ca_idcliente = 891800111;


 
Ojo -> Borrar clientes_adm.php y concliente_adm.php
Ojo -> No cambiar el vendedor cuando el que hace el mantenimiento es un nivel > 0
Usuarios con opcion de Admon sobre Clientes
cgonzalez
arubiano
falopez
Administrador
bbetancourt
clozano
pizquierdo


alter table tb_inomaestra_Sea add column ca_provisional bool;
update tb_inomaestra_sea set ca_provisional = false;
alter table tb_inomaestra_sea alter column ca_provisional set NOT NULL;

=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*

alter table tb_repavisos add column ca_doctransporte varchar(20);
alter table tb_repavisos add column ca_idnave varchar(50);
update tb_repavisos set ca_doctransporte = '';
update tb_repavisos set ca_idnave = '';
alter table tb_repavisos alter column ca_doctransporte set NOT NULL;
alter table tb_repavisos alter column ca_idnave set NOT NULL;
insert into tb_parametros values ('CU039',1,'PLEASE LET US KNOW STATUS CARGO AND AS SOON YOU HAVE DOCUMENTS READY E-MAIL US A COPY BEFORE SEND THE CARGO TO AIRLINE')
=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*

create table bk_cotproductos as select * from tb_cotproductos;
drop table tb_cotproductos cascade;
create table tb_cotproductos
( ca_idcotizacion smallint NOT NULL
, ca_idproducto smallint DEFAULT nextval('tb_cotproductos_id') NOT NULL
, ca_producto varchar (250) NOT NULL
, ca_impoexpo text NOT NULL
, ca_transporte text NOT NULL
, ca_modalidad varchar (12) NOT NULL
, ca_incoterms varchar (50) NOT NULL
, ca_origen varchar (8) NOT NULL
, ca_destino varchar (8) NOT NULL
, ca_frecuencia varchar (20)
, ca_tiempotransito varchar (25)
, ca_locrecargos text
, ca_datosag text
, ca_observaciones text 
, ca_fchcreado timestamp NOT NULL
, ca_usucreado varchar (20) NOT NULL
, ca_fchactualizado timestamp
, ca_usuactualizado varchar (20) 
, constraint pk_tb_cotproductos PRIMARY KEY (ca_idcotizacion, ca_idproducto)
, constraint fk_tb_cotizaciones FOREIGN KEY (ca_idcotizacion) REFERENCES tb_cotizaciones (ca_idcotizacion)
, constraint fk_tb_cotproductos_o FOREIGN KEY (ca_origen) REFERENCES tb_ciudades (ca_idciudad)
, constraint fk_tb_cotproductos_d FOREIGN KEY (ca_destino) REFERENCES tb_ciudades (ca_idciudad)
);
REVOKE ALL ON tb_cotproductos FROM PUBLIC;
GRANT ALL ON tb_cotproductos TO "Administrador";
GRANT ALL ON tb_cotproductos TO GROUP "Usuarios";
delete from bk_cotproductos where ca_idcotizacion not in (select ca_idcotizacion from tb_cotizaciones);
insert into tb_cotproductos select * from bk_cotproductos;


create table bk_cotopciones as select * from tb_cotopciones;
drop table tb_cotopciones cascade;

create sequence tb_cotopciones_id
minvalue     1
maxvalue 32767
increment    1
start        1;
REVOKE ALL ON tb_cotopciones_id FROM PUBLIC;
GRANT ALL ON tb_cotopciones_id TO "Administrador";
GRANT ALL ON tb_cotopciones_id TO GROUP "Usuarios";

create table tb_cotopciones
( ca_idcotizacion smallint NOT NULL
, ca_idproducto smallint NOT NULL
, ca_idopcion smallint DEFAULT nextval('tb_cotopciones_id') NOT NULL
, ca_idconcepto smallint NOT NULL
, ca_idmoneda varchar (3) references tb_monedas NOT NULL
, ca_tarifa varchar (250) NOT NULL
, ca_oferta varchar (250) NOT NULL
, ca_recargos text
, ca_observaciones text 
, ca_fchcreado timestamp NOT NULL
, ca_usucreado varchar (20) NOT NULL
, ca_fchactualizado timestamp
, ca_usuactualizado varchar (20) 
, constraint pk_tb_cotopciones PRIMARY KEY (ca_idcotizacion, ca_idproducto, ca_idopcion)
, constraint fk_tb_cotproductos FOREIGN KEY (ca_idcotizacion, ca_idproducto) REFERENCES tb_cotproductos (ca_idcotizacion, ca_idproducto)
, constraint fk_tb_cotopciones_c FOREIGN KEY (ca_idconcepto) REFERENCES tb_conceptos (ca_idconcepto)
);
REVOKE ALL ON tb_cotopciones FROM PUBLIC;
GRANT ALL ON tb_cotopciones TO "Administrador";
GRANT ALL ON tb_cotopciones TO GROUP "Usuarios";

delete from bk_cotopciones where ca_idcotizacion||'-'||ca_idproducto not in (select ca_idcotizacion||'-'||ca_idproducto from tb_cotproductos);

insert into tb_cotopciones (ca_idcotizacion, ca_idproducto, ca_idconcepto, ca_idmoneda, ca_tarifa, ca_oferta, ca_recargos, ca_observaciones, ca_fchcreado, ca_usucreado, ca_fchactualizado, ca_usuactualizado)  select ca_idcotizacion, ca_idproducto, ca_idconcepto, ca_idmoneda, ca_tarifa, ca_oferta, ca_recargos, ca_observaciones, ca_fchcreado, ca_usucreado, ca_fchactualizado, ca_usuactualizado from bk_cotopciones;


=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*

create table bk_reportes as select * from tb_reportes;
drop table tb_reportes cascade;
create table tb_reportes
( ca_idreporte smallint DEFAULT nextval('tb_reportes_id') UNIQUE NOT NULL
, ca_fchreporte date NOT NULL
, ca_consecutivo varchar (10) NOT NULL
, ca_version smallint NOT NULL DEFAULT 1
, ca_idcotizacion numeric(8) NOT NULL
, ca_origen varchar (8) NOT NULL
, ca_destino varchar (8) NOT NULL
, ca_impoexpo text NOT NULL
, ca_fchdespacho date NOT NULL
, ca_idagente numeric(9) NOT NULL
, ca_incoterms varchar (50) NOT NULL
, ca_mercancia_desc text NOT NULL
, ca_idproveedor varchar (255) NOT NULL
, ca_orden_prov  varchar (255) NOT NULL
, ca_idconsignatario numeric(9) NOT NULL
, ca_orden_cons varchar (255) NOT NULL
, ca_confirmar_cons varchar (250) NOT NULL
, ca_idrepresentante numeric(9) NOT NULL
, ca_informar_repr varchar (2) NOT NULL
, ca_transporte varchar (30) NOT NULL
, ca_modalidad varchar (12) NOT NULL
, ca_colmas varchar (2) NOT NULL
, ca_seguro varchar (2) NOT NULL
, ca_liberacion varchar (2) NOT NULL
, ca_tiempocredito varchar (20) NOT NULL
, ca_preferencias_clie text NOT NULL
, ca_instrucciones text NOT NULL
, ca_idlinea smallint NOT NULL
, ca_idconsignar smallint references tb_bodegas NOT NULL
, ca_idbodega smallint references tb_bodegas NOT NULL
, ca_mastersame varchar (2) NOT NULL
, ca_continuacion varchar (10) NOT NULL
, ca_continuacion_dest varchar (8)
, ca_continuacion_conf varchar (250)
, ca_login varchar (15) NOT NULL
, ca_fchcreado timestamp NOT NULL
, ca_usucreado varchar (20) NOT NULL
, ca_fchactualizado timestamp
, ca_usuactualizado varchar (20) 
, ca_fchanulado timestamp
, ca_usuanulado varchar (20) 
, constraint pk_tb_reportes PRIMARY KEY (ca_idreporte)
, constraint uq_tb_reportes UNIQUE (ca_consecutivo, ca_version)
, constraint fk_tb_reportes_o FOREIGN KEY (ca_origen) REFERENCES tb_ciudades (ca_idciudad)
, constraint fk_tb_reportes_d FOREIGN KEY (ca_destino) REFERENCES tb_ciudades (ca_idciudad)
);
REVOKE ALL ON tb_reportes FROM PUBLIC;
GRANT ALL ON tb_reportes TO "Administrador";
GRANT ALL ON tb_reportes TO GROUP "Usuarios";

insert into tb_reportes select * from bk_reportes;


=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*
alter table tb_repavisos add column ca_doctransporte varchar(20);


=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*
alter table tb_inoclientes_sea add column ca_continuacion varchar (10) NOT NULL DEFAULT 'N/A';
alter table tb_inoclientes_sea add column ca_continuacion_dest varchar (8);
alter table tb_inoclientes_sea add column ca_idbodega smallint NOT NULL DEFAULT 0;
alter table tb_inoingresos_sea add column ca_observaciones varchar (100);


=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*

create table bk_repmaritimo as select * from tb_repmaritimo;
create table bk_repaereo as select * from tb_repaereo;

drop table tb_repmaritimo cascade;
create table tb_repmaritimo
( ca_idreporte smallint NOT NULL
, ca_idconcepto smallint NOT NULL
, ca_cantidad decimal (5,2) NOT NULL
, ca_neta_tar decimal (10,2) NOT NULL
, ca_neta_min decimal (10,2) NOT NULL
, ca_neta_idm varchar (3) references tb_monedas NOT NULL
, ca_reportar_tar decimal (10,2) NOT NULL
, ca_reportar_min decimal (10,2) NOT NULL
, ca_reportar_idm varchar (3) references tb_monedas NOT NULL
, ca_cobrar_tar decimal (10,2) NOT NULL
, ca_cobrar_min decimal (10,2) NOT NULL
, ca_cobrar_idm varchar (3) references tb_monedas NOT NULL
, constraint pk_tb_repmaritimo PRIMARY KEY (ca_idreporte, ca_idconcepto)
, constraint fk_tb_repmaritimo FOREIGN KEY (ca_idreporte) REFERENCES tb_reportes (ca_idreporte)
);
REVOKE ALL ON tb_repmaritimo FROM PUBLIC;
GRANT ALL ON tb_repmaritimo TO "Administrador";
GRANT ALL ON tb_repmaritimo TO GROUP "Usuarios";

drop table tb_repaereo cascade;
create table tb_repaereo
( ca_idreporte smallint NOT NULL
, ca_idconcepto smallint NOT NULL
, ca_reportar_tar decimal (10,2) NOT NULL
, ca_reportar_min decimal (10,2) NOT NULL
, ca_reportar_idm varchar (3) references tb_monedas NOT NULL
, ca_cobrar_tar decimal (10,2) NOT NULL
, ca_cobrar_min decimal (10,2) NOT NULL
, ca_cobrar_idm varchar (3) references tb_monedas NOT NULL
, constraint pk_tb_repaereo PRIMARY KEY (ca_idreporte, ca_idconcepto)
, constraint fk_tb_repaereo FOREIGN KEY (ca_idreporte) REFERENCES tb_reportes (ca_idreporte)
);
REVOKE ALL ON tb_repaereo FROM PUBLIC;
GRANT ALL ON tb_repaereo TO "Administrador";
GRANT ALL ON tb_repaereo TO GROUP "Usuarios";

delete from bk_repmaritimo where ca_idreporte not in (select ca_idreporte from tb_reportes);
delete from bk_repaereo where ca_idreporte not in (select ca_idreporte from tb_reportes);

insert into tb_repmaritimo select ca_idreporte, ca_idconcepto, ca_cantidad, ca_neta_tar, ca_neta_min, ca_idmoneda_tar, ca_reportar_tar, ca_reportar_min, ca_idmoneda_tar, ca_cobrar_tar, ca_cobrar_min, ca_idmoneda_tar from bk_repmaritimo;
insert into tb_repaereo select ca_idreporte, ca_idconcepto, ca_reportar_tar, ca_reportar_min, ca_idmoneda_tar, ca_cobrar_tar, ca_cobrar_min, ca_idmoneda_tar from bk_repaereo;

Create view vi_repmaritimo as
select r.ca_idreporte, r.ca_idconcepto, c.ca_concepto, r.ca_cantidad, r.ca_neta_tar, r.ca_neta_min, r.ca_neta_idm, r.ca_reportar_tar, r.ca_reportar_min, r.ca_reportar_idm, r.ca_cobrar_tar, r.ca_cobrar_min, r.ca_cobrar_idm
       from tb_repmaritimo r, tb_conceptos c where r.ca_idconcepto = c.ca_idconcepto
       order by r.ca_idreporte, c.ca_liminferior, c.ca_concepto desc;
REVOKE ALL ON vi_repmaritimo FROM PUBLIC;
GRANT ALL ON vi_repmaritimo TO "Administrador";
GRANT ALL ON vi_repmaritimo TO GROUP "Usuarios";

Create view vi_repaereo as
select r.ca_idreporte, r.ca_idconcepto, c.ca_concepto, r.ca_reportar_tar, r.ca_reportar_min, r.ca_reportar_idm, r.ca_cobrar_tar, r.ca_cobrar_min, r.ca_cobrar_idm
       from tb_repaereo r, tb_conceptos c where r.ca_idconcepto = c.ca_idconcepto
       order by r.ca_idreporte, c.ca_liminferior, c.ca_concepto desc;
REVOKE ALL ON vi_repaereo FROM PUBLIC;
GRANT ALL ON vi_repaereo TO "Administrador";
GRANT ALL ON vi_repaereo TO GROUP "Usuarios";

=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*


create table bk_reportes as select * from tb_reportes;

drop table tb_reportes cascade;
create table tb_reportes
( ca_idreporte smallint DEFAULT nextval('tb_reportes_id') UNIQUE NOT NULL
, ca_fchreporte date NOT NULL
, ca_consecutivo varchar (10) NOT NULL
, ca_version smallint NOT NULL DEFAULT 1
, ca_idcotizacion numeric(8) NOT NULL
, ca_origen varchar (8) NOT NULL
, ca_destino varchar (8) NOT NULL
, ca_impoexpo text NOT NULL
, ca_fchdespacho date NOT NULL
, ca_idagente numeric(9) NOT NULL
, ca_incoterms varchar (250) NOT NULL
, ca_mercancia_desc text NOT NULL
, ca_idproveedor varchar (255) NOT NULL
, ca_orden_prov  varchar (255) NOT NULL
, ca_idconsignatario numeric(9) NOT NULL
, ca_orden_cons varchar (255) NOT NULL
, ca_confirmar_cons varchar (300) NOT NULL
, ca_idrepresentante numeric(9) NOT NULL
, ca_informar_repr varchar (2) NOT NULL
, ca_idnotify numeric(9) NOT NULL
, ca_informar_noti varchar (2) NOT NULL
, ca_transporte varchar (30) NOT NULL
, ca_modalidad varchar (12) NOT NULL
, ca_colmas varchar (2) NOT NULL
, ca_seguro varchar (2) NOT NULL
, ca_liberacion varchar (2) NOT NULL
, ca_tiempocredito varchar (20) NOT NULL
, ca_preferencias_clie text NOT NULL
, ca_instrucciones text NOT NULL
, ca_idlinea smallint NOT NULL
, ca_idconsignar smallint references tb_bodegas NOT NULL
, ca_idbodega smallint references tb_bodegas NOT NULL
, ca_mastersame varchar (2) NOT NULL
, ca_continuacion varchar (10) NOT NULL
, ca_continuacion_dest varchar (8)
, ca_continuacion_conf varchar (250)
, ca_login varchar (15) NOT NULL
, ca_fchcreado timestamp NOT NULL
, ca_usucreado varchar (20) NOT NULL
, ca_fchactualizado timestamp
, ca_usuactualizado varchar (20)
, ca_fchanulado timestamp
, ca_usuanulado varchar (20)
, constraint pk_tb_reportes PRIMARY KEY (ca_idreporte)
, constraint uq_tb_reportes UNIQUE (ca_consecutivo, ca_version)
, constraint fk_tb_reportes_o FOREIGN KEY (ca_origen) REFERENCES tb_ciudades (ca_idciudad)
, constraint fk_tb_reportes_d FOREIGN KEY (ca_destino) REFERENCES tb_ciudades (ca_idciudad)
);
REVOKE ALL ON tb_reportes FROM PUBLIC;
GRANT ALL ON tb_reportes TO "Administrador";
GRANT ALL ON tb_reportes TO GROUP "Usuarios";

insert into tb_reportes select ca_idreporte, ca_fchreporte, ca_consecutivo, ca_version, ca_idcotizacion, ca_origen, ca_destino, ca_impoexpo, ca_fchdespacho, ca_idagente, ca_incoterms, ca_mercancia_desc, ca_idproveedor, ca_orden_prov, ca_idconsignatario, ca_orden_cons, ca_confirmar_cons, ca_idrepresentante, ca_informar_repr, 0, '', ca_transporte, ca_modalidad, ca_colmas, ca_seguro, ca_liberacion, ca_tiempocredito, ca_preferencias_clie, ca_instrucciones, ca_idlinea, ca_idconsignar, ca_idbodega, ca_mastersame, ca_continuacion, ca_continuacion_dest, ca_continuacion_conf, ca_login, ca_fchcreado, ca_usucreado, ca_fchactualizado, ca_usuactualizado, ca_fchanulado, ca_usuanulado from bk_reportes

Create view vi_reportes as
select r.ca_idreporte, r.ca_version, (select max(rr.ca_version) from tb_reportes rr where r.ca_consecutivo = rr.ca_consecutivo) as ca_versiones, r.ca_fchreporte, r.ca_consecutivo, r.ca_idcotizacion, r.ca_origen, c1.ca_ciudad as ca_ciuorigen, t1.ca_idtrafico as ca_idtraorigen, t1.ca_nombre as ca_traorigen, r.ca_destino, c2.ca_ciudad as ca_ciudestino, t2.ca_idtrafico as ca_idtradestino, t2.ca_nombre as ca_tradestino,
       r.ca_impoexpo, r.ca_fchdespacho, r.ca_idagente, a.ca_nombre as ca_agente, r.ca_incoterms, r.ca_mercancia_desc, r.ca_idproveedor, r.ca_orden_prov, r.ca_idconsignatario, r.ca_orden_cons, r.ca_confirmar_cons, r.ca_idnotify, r.ca_informar_noti, r.ca_idrepresentante, r.ca_informar_repr, r.ca_transporte, r.ca_modalidad, r.ca_colmas, r.ca_seguro, r.ca_liberacion,
       r.ca_tiempocredito, r.ca_preferencias_clie, r.ca_instrucciones, r.ca_idconsignar, b1.ca_nombre as ca_consignar, r.ca_idbodega, b2.ca_nombre as ca_bodega, b2.ca_tipo as ca_tipobodega, r.ca_mastersame, r.ca_continuacion, r.ca_continuacion_dest, c3.ca_ciudad as ca_final_dest, r.ca_continuacion_conf, r.ca_idlinea, l.ca_nombre, r.ca_fchcreado, r.ca_usucreado, r.ca_fchactualizado, r.ca_usuactualizado, r.ca_fchanulado, r.ca_usuanulado,
       tr1.ca_nombre as ca_nombre_pro, tr1.ca_contacto as ca_contacto_pro, tr1.ca_direccion as ca_direccion_pro, tr1.ca_telefonos as ca_telefonos_pro, tr1.ca_fax as ca_fax_pro, tr1.ca_email as ca_email_pro,
       tr2.ca_compania as ca_nombre_con, tr2.ca_idcliente, tr2.ca_ncompleto_cn as ca_contacto_con, tr2.ca_telefonos as ca_telefonos_con, tr2.ca_fax as ca_fax_con, tr2.ca_email as ca_email_con,
       replace(tr2.ca_direccion_cl,'|',' ')|| case when tr2.ca_oficina <> '' then ' Of. '||tr2.ca_oficina else '' end|| case when tr2.ca_torre <> '' then ' Torre '||tr2.ca_torre else '' end|| case when tr2.ca_bloque <> '' then ' Bl. '||tr2.ca_bloque else '' end|| case when tr2.ca_interior <> '' then ' Int. '||tr2.ca_interior else '' end|| case when tr2.ca_complemento <> '' then ' '||tr2.ca_complemento else '' end ||' '|| tr2.ca_ciudad as ca_direccion_con,
       tr3.ca_nombre as ca_nombre_rep, tr3.ca_contacto as ca_contacto_rep, tr3.ca_direccion||' '|| tr3.ca_ciudad as ca_direccion_rep, tr3.ca_telefonos as ca_telefonos_rep, tr3.ca_fax as ca_fax_rep, tr3.ca_email as ca_email_rep,
       tr4.ca_nombre as ca_nombre_not, tr4.ca_contacto as ca_contacto_not, tr4.ca_direccion||' '|| tr4.ca_ciudad as ca_direccion_not, tr4.ca_telefonos as ca_telefonos_not, tr4.ca_fax as ca_fax_not, tr4.ca_email as ca_email_not,
       s.ca_modalventa, s.ca_modaltrans, s.ca_vlrasegurado, s.ca_idmoneda_vlr, s.ca_primaneta, s.ca_minimaneta, s.ca_idmoneda_net, s.ca_primaventa, s.ca_minimaventa, s.ca_idmoneda_vta, s.ca_obtencionpoliza, s.ca_idmoneda_pol, s.ca_seguro_conf, r.ca_login, u.ca_nombre as ca_vendedor, u.ca_sucursal
       from tb_reportes r LEFT OUTER JOIN tb_transporlineas l ON (r.ca_idlinea = l.ca_idlinea) LEFT OUTER JOIN vi_terceros tr1 ON (tr1.ca_idtercero IN (array_to_string(string_to_array(r.ca_idproveedor,'|'),','))) LEFT OUTER JOIN vi_concliente tr2 ON (r.ca_idconsignatario = tr2.ca_idcontacto)
            LEFT OUTER JOIN vi_terceros tr3 ON (r.ca_idrepresentante = tr3.ca_idtercero) LEFT OUTER JOIN vi_terceros tr4 ON (r.ca_idnotify = tr4.ca_idtercero) LEFT OUTER JOIN tb_repseguro s ON (r.ca_idreporte = s.ca_idreporte), tb_agentes a, tb_ciudades c1, tb_ciudades c2, tb_ciudades c3, tb_traficos t1, tb_traficos t2, tb_bodegas b1, tb_bodegas b2, control.tb_usuarios u where r.ca_idagente = a.ca_idagente
            and r.ca_origen = c1.ca_idciudad and r.ca_destino = c2.ca_idciudad and r.ca_continuacion_dest = c3.ca_idciudad and c1.ca_idtrafico = t1.ca_idtrafico and c2.ca_idtrafico = t2.ca_idtrafico and r.ca_idconsignar = b1.ca_idbodega and r.ca_idbodega = b2.ca_idbodega and r.ca_login = u.ca_login and nullvalue(r.ca_usuanulado)
       order by ca_idreporte DESC, to_number(ca_consecutivo,'9999999"-"9999') DESC, r.ca_version DESC;
REVOKE ALL ON vi_reportes FROM PUBLIC;
GRANT ALL ON vi_reportes TO "Administrador";
GRANT ALL ON vi_reportes TO GROUP "Usuarios";


=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*

create table bk_repstatus as select * from tb_repstatus;

drop table tb_repstatus cascade;
create table tb_repstatus
( ca_idreporte smallint NOT NULL
, ca_idemail smallint references tb_emails NOT NULL
, ca_fchstatus date NOT NULL
, ca_status text NOT NULL
, ca_comentarios text NOT NULL
, ca_fchrecibo timestamp NOT NULL
, ca_fchenvio timestamp NOT NULL
, ca_usuenvio varchar(20) NOT NULL
, constraint pk_tb_repstatus PRIMARY KEY (ca_idreporte, ca_idemail)
, constraint fk_tb_repstatus FOREIGN KEY (ca_idreporte) REFERENCES tb_reportes (ca_idreporte)
);
REVOKE ALL ON tb_repstatus FROM PUBLIC;
GRANT ALL ON tb_repstatus TO "Administrador";
GRANT ALL ON tb_repstatus TO GROUP "Usuarios";

Create view vi_repstatus as
select r.ca_idreporte, r.ca_idemail, r.ca_fchstatus, r.ca_status, r.ca_comentarios, r.ca_fchrecibo, r.ca_fchenvio, r.ca_usuenvio, e.ca_tipo, e.ca_idcaso, e.ca_from, e.ca_fromname, e.ca_cc, e.ca_replyto, e.ca_address, e.ca_attachment, e.ca_subject, e.ca_body
       from tb_repstatus r, tb_emails e where r.ca_idemail = e.ca_idemail and e.ca_tipo = 'Envío de Status'
       order by r.ca_idreporte, r.ca_idemail DESC;
REVOKE ALL ON vi_repstatus FROM PUBLIC;
GRANT ALL ON vi_repstatus TO "Administrador";
GRANT ALL ON vi_repstatus TO GROUP "Usuarios";

insert into tb_repstatus select ca_idreporte, ca_idemail, ca_fchstatus, ca_status, ca_comentarios, ca_fchenvio, ca_fchenvio, ca_usuenvio from bk_repstatus where ca_idemail in (select ca_idemail from tb_emails)
update tb_repstatus set ca_fchrecibo = to_timestamp('01/01/2007 00:00:00', 'DD MM YYYY hh:mi:ss');


=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*

insert into tb_parametros values ('CU042',9,'1|1000');
insert into tb_parametros values ('CU042',10,'33.18|2230');
insert into tb_parametros values ('CU042',11,'36.498|2530');
insert into tb_parametros values ('CU042',12,'32.16|2400');
insert into tb_parametros values ('CU042',13,'28.31|3200');
insert into tb_parametros values ('CU042',14,'74.437|5800');
insert into tb_parametros values ('CU042',15,'67.67|3700');
insert into tb_parametros values ('CU042',16,'74.437|5800');
insert into tb_parametros values ('CU042',17,'66.6|4500');
insert into tb_parametros values ('CU042',18,'66.54|3850');
insert into tb_parametros values ('CU042',19,'74.437|5798');
insert into tb_parametros values ('CU042',20,'57.76|4900');
insert into tb_parametros values ('CU042',21,'76.28|3970');
insert into tb_parametros values ('CU042',54,'57.76|4900');
insert into tb_parametros values ('CU042',55,'66.6|4500');
insert into tb_parametros values ('CU042',56,'85.7|4110');


insert into tb_parametros values ('CU045',0,'Pendiente de Coordinación');
insert into tb_parametros values ('CU045',1,'Contacto con nuestro Agente');
insert into tb_parametros values ('CU045',2,'Carga Por Recoger');
insert into tb_parametros values ('CU045',3,'Carga Recogida');
insert into tb_parametros values ('CU045',4,'En Tránsito a Bodega del Agente');
insert into tb_parametros values ('CU045',5,'En Bodega del Agente');
insert into tb_parametros values ('CU045',6,'Carga con Reserva');
insert into tb_parametros values ('CU045',7,'Carga Embarcada');
insert into tb_parametros values ('CU045',8,'Carga con Demora');
insert into tb_parametros values ('CU045',9,'Carga en Tránsito a Destino');
insert into tb_parametros values ('CU045',10,'Recepción documentos completos');
insert into tb_parametros values ('CU045',11,'Reserva y confirmación');
insert into tb_parametros values ('CU045',12,'Carga en inspección y legalización');
insert into tb_parametros values ('CU045',13,'Facturación y Soportes');
insert into tb_parametros values ('CU045',14,'Entrega DEX');


insert into tb_parametros values ('CU046',0,'COL-0000|Sandra Yepes Sucursal Bogotá Tel: (57 1) 4 239 300 - Ext 127 ó al correo syepes@coltrans.com.co');
insert into tb_parametros values ('CU046',1,'BAQ-0005|');
insert into tb_parametros values ('CU046',2,'BOG-0001|Sandra Yepes Ext 127, Lucelida moreno Ext 155 ó al correo syepes@coltrans.com.co, lmoreno@coltrans.com.co');
insert into tb_parametros values ('CU046',3,'CLO-0002|');
insert into tb_parametros values ('CU046',4,'MDE-0004|Adriana M. Monsalve S. Ext 102, Lina María Alvarez G. Ext 160 ó al correo amonsalve@coltrans.com.co, lmalvarez@coltrans.com.co');


insert into tb_parametros values ('CU057',0,'20 Dry Freight (STD)','20G0');
insert into tb_parametros values ('CU057',0,'20 Flat Rack','22P1');
insert into tb_parametros values ('CU057',0,'20 Open Top','22U0');
insert into tb_parametros values ('CU057',0,'20 Reefer','22R0');
insert into tb_parametros values ('CU057',0,'20 Tank Container (ISO)','22T0');
insert into tb_parametros values ('CU057',0,'40 Collapsible Flat Rack','42P3');
insert into tb_parametros values ('CU057',0,'40 Dry Freight (STD)','42G0');
insert into tb_parametros values ('CU057',0,'40 Flat Rack','42P1');
insert into tb_parametros values ('CU057',0,'40 High Cube Reefer','45R1');
insert into tb_parametros values ('CU057',0,'40 Open Top','42U1');
insert into tb_parametros values ('CU057',0,'40 Platform','48P0');
insert into tb_parametros values ('CU057',0,'40 Reefer','42R0');
insert into tb_parametros values ('CU057',0,'40 High Cube Dry','45G0');


insert into tb_parametros values ('CU037',1,'Solicitud de Clasificación Arancelaria','');
insert into tb_parametros values ('CU037',2,'Entrega Clasificación','');
insert into tb_parametros values ('CU037',3,'Solicitud de Anticipo','');
insert into tb_parametros values ('CU037',4,'Recibo de Anticipo','');
insert into tb_parametros values ('CU037',5,'Solicitud de Preinspección','');
insert into tb_parametros values ('CU037',6,'Recibo de Preinspección','');
insert into tb_parametros values ('CU037',7,'Apertura de Digitación','');
insert into tb_parametros values ('CU037',8,'Cierre de Digitación','');
insert into tb_parametros values ('CU037',9,'Apertura de Revisión','');
insert into tb_parametros values ('CU037',10,'Cierre de Revisión','');
insert into tb_parametros values ('CU037',11,'Pago en Bancos','');
insert into tb_parametros values ('CU037',12,'Solicitud de Levante','');
insert into tb_parametros values ('CU037',13,'Entrega de Mercancia','');
insert into tb_parametros values ('CU037',14,'Levante de Mercancia','');
insert into tb_parametros values ('CU037',15,'Entrega a Facturación','');
insert into tb_parametros values ('CU037',16,'Elaboración de Factura','');
insert into tb_parametros values ('CU037',17,'Entrega de Factura a Mensajería','');
insert into tb_parametros values ('CU037',18,'Entrega de Último Documento','');

insert into tb_parametros values ('CU062',1,'EXW - EX Works');
insert into tb_parametros values ('CU062',2,'FCA - Free Carrier');
insert into tb_parametros values ('CU062',3,'FAS - Free Alongside Ship');
insert into tb_parametros values ('CU062',4,'FOB - Free On Board');
insert into tb_parametros values ('CU062',5,'CIF - Cost, Insuarance & Freight');
insert into tb_parametros values ('CU062',6,'CIP - Carriage and Insurence Paid');
insert into tb_parametros values ('CU062',7,'CPT - Carriage Paid To');
insert into tb_parametros values ('CU062',8,'CFR - Cost and Freight');
insert into tb_parametros values ('CU062',9,'DDP - Delivered Duty Paid');
insert into tb_parametros values ('CU062',10,'DDU - Delivered Duty Unpaid');
insert into tb_parametros values ('CU062',11,'DAF - Delivered at Frontier');

insert into tb_parametros values ('CU063',1,'Aéreo','CONSOLIDADO');
insert into tb_parametros values ('CU063',2,'Marítimo','FCL|LCL|COLOADING');
insert into tb_parametros values ('CU063',3,'Terrestre','');

insert into tb_parametros values ('CU059',860005224,'fchdoctransporte','Fch/Doc.Transporte');
insert into tb_parametros values ('CU059',860005224,'fchfactproveedor','Fch/Fact.Proveedor');
insert into tb_parametros values ('CU059',860005224,'numfactproveedor','Num/Fact.Proveedor');
insert into tb_parametros values ('CU059',860005224,'vlrfactproveedor','Vlr/Fact.Proveedor');
insert into tb_parametros values ('CU059',860005224,'fchrecibocarga','Fch/Recibida Carga');

create table bk_repseguro as select * from tb_repseguro;

alter table tb_repseguro drop column ca_modalventa;
alter table tb_repseguro drop column ca_modaltrans;
alter table tb_repseguro drop column ca_primaneta;
alter table tb_repseguro drop column ca_minimaneta;
alter table tb_repseguro drop column ca_idmoneda_net;


alter table tb_repseguro add column ca_modalventa varchar (20);
alter table tb_repseguro add column ca_modaltrans varchar (35);
alter table tb_repseguro add column ca_primaneta decimal (5,2);
alter table tb_repseguro add column ca_minimaneta decimal (5,2);
alter table tb_repseguro add column ca_idmoneda_net varchar (3);


alter table tb_emails drop constraint pk_tb_emails;
alter table tb_emails add constraint pk_tb_emails UNIQUE (ca_idcaso, ca_idemail);


alter table tb_repgastos add column ca_fchcreado timestamp;
alter table tb_repgastos add column ca_usucreado varchar (20);
alter table tb_repgastos add column ca_fchactualizado timestamp;
alter table tb_repgastos add column ca_usuactualizado varchar (20);

alter table tb_falaheader_adu add column ca_fchanulado timestamp;
alter table tb_falaheader_adu add column ca_usuanulado varchar (20);

================== Migración Tablas de Fletes a Tabla unificada para Impo Expo / Aereo - Maritimo ==================

create table bk_reptarifas as select * from tb_reptarifas;

drop table tb_reptarifas cascade;
create table tb_reptarifas
( ca_idreporte integer NOT NULL
, ca_idconcepto smallint NOT NULL
, ca_cantidad numeric(5,2)
, ca_neta_tar numeric(10,2)
, ca_neta_min numeric(10,2)
, ca_neta_idm character varying(3)
, ca_reportar_tar numeric(10,2) NOT NULL
, ca_reportar_min numeric(10,2) NOT NULL
, ca_reportar_idm character varying(3) NOT NULL
, ca_cobrar_tar numeric(10,2) NOT NULL
, ca_cobrar_min numeric(10,2) NOT NULL
, ca_cobrar_idm character varying(3) NOT NULL
, ca_observaciones character varying(255)
, ca_fchcreado timestamp
, ca_usucreado varchar (20)
, ca_fchactualizado timestamp
, ca_usuactualizado varchar (20)
, constraint pk_tb_reptarifas PRIMARY KEY (ca_idreporte, ca_idconcepto)
, constraint tb_reptarifas_ca_reportar_idm_fkey FOREIGN KEY (ca_reportar_idm) REFERENCES tb_monedas (ca_idmoneda)
, constraint tb_reptarifas_ca_cobrar_idm_fkey FOREIGN KEY (ca_cobrar_idm) REFERENCES tb_monedas (ca_idmoneda)
) WITH OIDS;
REVOKE ALL ON tb_reptarifas FROM PUBLIC;
GRANT ALL ON tb_reptarifas TO "Administrador";
GRANT ALL ON tb_reptarifas TO GROUP "Usuarios";


delete from tb_repmaritimo where ca_idreporte in (select ca_idreporte from tb_reportes where ca_transporte != 'Marítimo');

delete from tb_repaereo where ca_idreporte in (select ca_idreporte from tb_reportes where ca_transporte != 'Aéreo');

insert into tb_reptarifas 
	select ca_idreporte, ca_idconcepto, ca_cantidad, ca_neta_tar, ca_neta_min, ca_neta_idm, ca_reportar_tar, ca_reportar_min, ca_reportar_idm, ca_cobrar_tar, ca_cobrar_min, ca_cobrar_idm, '' as ca_observaciones, ca_fchcreado, ca_usucreado, ca_fchactualizado, ca_usuactualizado
		from tb_repmaritimo
	union
	select ca_idreporte, ca_idconcepto, 0 as ca_cantidad, 0 as ca_neta_tar, 0 as ca_neta_min, '' as ca_neta_idm, ca_reportar_tar, ca_reportar_min, ca_reportar_idm, ca_cobrar_tar, ca_cobrar_min, ca_cobrar_idm, '' as ca_observaciones, ca_fchcreado, ca_usucreado, ca_fchactualizado, ca_usuactualizado
		from tb_repaereo
	union
	select ca_idreporte, ca_idconcepto, ca_cantidad, ca_neta_tar, ca_neta_min, ca_neta_idm, ca_reportar_tar, ca_reportar_min, ca_reportar_idm, ca_cobrar_tar, ca_cobrar_min, ca_cobrar_idm, ca_observaciones, '2008-09-01 00:00:00'::timestamp as ca_fchcreado, '' as ca_usucreado, null as ca_fchactualizado, null as ca_usuactualizado
		from bk_reptarifas
	order by 1, 2


update tb_reptarifas set ca_fchcreado = '2008-09-01 00:00:00'::timestamp, ca_usucreado = 'Administrador' where nullvalue(ca_usucreado);
update tb_reptarifas set ca_fchcreado = '2008-09-01 00:00:00'::timestamp where nullvalue(ca_fchcreado);
update tb_reptarifas set ca_usucreado = 'Administrador' where ca_usucreado = '';

alter table tb_reptarifas 
	alter column ca_fchcreado set NOT NULL,
	alter column ca_usucreado set NOT NULL
	
Drop view vi_reptarifas;
Create view vi_reptarifas as
select r.oid as ca_oid, r.ca_idreporte, r.ca_idconcepto, c.ca_concepto, r.ca_cantidad, r.ca_neta_tar, r.ca_neta_min, r.ca_neta_idm, r.ca_reportar_tar, r.ca_reportar_min, r.ca_reportar_idm, r.ca_cobrar_tar, r.ca_cobrar_min, r.ca_cobrar_idm, r.ca_observaciones
       from tb_reptarifas r
       LEFT OUTER JOIN tb_conceptos c ON (r.ca_idconcepto = c.ca_idconcepto)
       order by r.ca_idreporte, c.ca_liminferior, c.ca_concepto desc;
REVOKE ALL ON vi_reptarifas FROM PUBLIC;
GRANT ALL ON vi_reptarifas TO "Administrador";
GRANT ALL ON vi_reptarifas TO GROUP "Usuarios";


alter table tb_cotopciones add column ca_valor_tar decimal (10,2);
alter table tb_cotopciones add column ca_aplica_tar varchar (25);
alter table tb_cotopciones add column ca_valor_min decimal (10,2);
alter table tb_cotopciones add column ca_aplica_min varchar (25);

alter table tb_cotcontinuacion add column ca_valor_tar decimal (10,2);
alter table tb_cotcontinuacion add column ca_valor_min decimal (10,2);

alter table tb_cotcontinuacion alter column ca_tarifa drop not null;

alter table tb_cotseguro add column ca_prima_tip character varying(1);
alter table tb_cotseguro add column ca_prima_vlr decimal (10,2);
alter table tb_cotseguro add column ca_prima_min decimal (10,2);
alter table tb_cotseguro alter column ca_prima drop not null;


alter table tb_clientes add column ca_idgrupo numeric(11) NOT NULL DEFAULT 0;
update tb_clientes set ca_idgrupo = ca_idcliente;
alter table tb_clientes alter column ca_idgrupo drop DEFAULT;

update tb_clientes set ca_idgrupo = 860005224
	where ca_idcliente in (
		select DISTINCT ca_idcliente from tb_concliente where ca_email like '%bav.sabmiller.com%'
	)

/* Tabla de Notificaciones de Embarque Bavaria */;

drop table tb_bavarianotify cascade;
create table tb_bavarianotify
( ca_consecutivo varchar (10) NOT NULL
, ca_fchenvio timestamp
, ca_usuenvio varchar (20)
, constraint pk_tb_bavarianotify PRIMARY KEY (ca_consecutivo)
);
REVOKE ALL ON tb_bavarianotify FROM PUBLIC;
GRANT ALL ON tb_bavarianotify TO "Administrador";
GRANT ALL ON tb_bavarianotify TO GROUP "Usuarios";



insert into tb_deducciones (ca_deduccion, ca_transporte, ca_impoexpo, ca_modalidad) values('Escolta','Marítimo','Importación','PROYECTOS');
insert into tb_deducciones (ca_deduccion, ca_transporte, ca_impoexpo, ca_modalidad) values('Seguro Anker','Marítimo','Importación','PROYECTOS');
insert into tb_deducciones (ca_deduccion, ca_transporte, ca_impoexpo, ca_modalidad) values('Documentación Anker','Marítimo','Importación','PROYECTOS');
insert into tb_deducciones (ca_deduccion, ca_transporte, ca_impoexpo, ca_modalidad) values('Comunicaciones','Marítimo','Importación','PROYECTOS');
insert into tb_deducciones (ca_deduccion, ca_transporte, ca_impoexpo, ca_modalidad) values('Inspecciones','Marítimo','Importación','PROYECTOS');
insert into tb_deducciones (ca_deduccion, ca_transporte, ca_impoexpo, ca_modalidad) values('Repesaje o Movimientos en Pto','Marítimo','Importación','PROYECTOS');
insert into tb_deducciones (ca_deduccion, ca_transporte, ca_impoexpo, ca_modalidad) values('Nota Crédito','Marítimo','Importación','PROYECTOS');
insert into tb_deducciones (ca_deduccion, ca_transporte, ca_impoexpo, ca_modalidad) values('Contenedores','Marítimo','Importación','PROYECTOS');
insert into tb_deducciones (ca_deduccion, ca_transporte, ca_impoexpo, ca_modalidad) values('Coordinación Embarque','Marítimo','Importación','PROYECTOS');

insert into tb_costos (ca_costo, ca_transporte, ca_impoexpo, ca_modalidad, ca_comisionable) values('Flete Marítimo','Marítimo','Importación','PROYECTOS','Sí');
insert into tb_costos (ca_costo, ca_transporte, ca_impoexpo, ca_modalidad, ca_comisionable) values('Flete Maritimo + Profit','Marítimo','Importación','PROYECTOS','Sí');
insert into tb_costos (ca_costo, ca_transporte, ca_impoexpo, ca_modalidad, ca_comisionable) values('Gastos En Puerto','Marítimo','Importación','PROYECTOS','Sí');
insert into tb_costos (ca_costo, ca_transporte, ca_impoexpo, ca_modalidad, ca_comisionable) values('Al Dia Otm','Marítimo','Importación','PROYECTOS','Sí');
insert into tb_costos (ca_costo, ca_transporte, ca_impoexpo, ca_modalidad, ca_comisionable) values('Bodegajes','Marítimo','Importación','PROYECTOS','Sí');
insert into tb_costos (ca_costo, ca_transporte, ca_impoexpo, ca_modalidad, ca_comisionable) values('Recargos Locales','Marítimo','Importación','PROYECTOS','Sí');
insert into tb_costos (ca_costo, ca_transporte, ca_impoexpo, ca_modalidad, ca_comisionable) values('Demoras Contenedor','Marítimo','Importación','PROYECTOS','Sí');
insert into tb_costos (ca_costo, ca_transporte, ca_impoexpo, ca_modalidad, ca_comisionable) values('CFEE + BAF','Marítimo','Importación','PROYECTOS','Sí');
insert into tb_costos (ca_costo, ca_transporte, ca_impoexpo, ca_modalidad, ca_comisionable) values('Seguro','Marítimo','Importación','PROYECTOS','No');
insert into tb_costos (ca_costo, ca_transporte, ca_impoexpo, ca_modalidad, ca_comisionable) values('Gastos en Origen','Marítimo','Importación','PROYECTOS','Sí');
insert into tb_costos (ca_costo, ca_transporte, ca_impoexpo, ca_modalidad, ca_comisionable) values('Profit','Marítimo','Importación','PROYECTOS','Sí');
insert into tb_costos (ca_costo, ca_transporte, ca_impoexpo, ca_modalidad, ca_comisionable) values('Gastos Origen+Profit','Marítimo','Importación','PROYECTOS','Sí');
insert into tb_costos (ca_costo, ca_transporte, ca_impoexpo, ca_modalidad, ca_comisionable) values('Desconsolidación','Marítimo','Importación','PROYECTOS','Sí');
insert into tb_costos (ca_costo, ca_transporte, ca_impoexpo, ca_modalidad, ca_comisionable) values('Uso Instalaciones','Marítimo','Importación','PROYECTOS','Sí');
insert into tb_costos (ca_costo, ca_transporte, ca_impoexpo, ca_modalidad, ca_comisionable) values('Emision Obl','Marítimo','Importación','PROYECTOS','Sí');
insert into tb_costos (ca_costo, ca_transporte, ca_impoexpo, ca_modalidad, ca_comisionable) values('Limpieza','Marítimo','Importación','PROYECTOS','Sí');
insert into tb_costos (ca_costo, ca_transporte, ca_impoexpo, ca_modalidad, ca_comisionable) values('Nota Credito','Marítimo','Importación','PROYECTOS','Sí');
insert into tb_costos (ca_costo, ca_transporte, ca_impoexpo, ca_modalidad, ca_comisionable) values('Profit Gamma Cargo','Marítimo','Importación','PROYECTOS','Sí');
insert into tb_costos (ca_costo, ca_transporte, ca_impoexpo, ca_modalidad, ca_comisionable) values('Uso Instalaciones','Marítimo','Importación','PROYECTOS','Sí');
insert into tb_costos (ca_costo, ca_transporte, ca_impoexpo, ca_modalidad, ca_comisionable) values('Costo de Reposición','Marítimo','Importación','PROYECTOS','Sí');
insert into tb_costos (ca_costo, ca_transporte, ca_impoexpo, ca_modalidad, ca_comisionable) values('Drop off','Marítimo','Importación','PROYECTOS','Sí');
insert into tb_costos (ca_costo, ca_transporte, ca_impoexpo, ca_modalidad, ca_comisionable) values('Factura USA','Marítimo','Importación','PROYECTOS','Sí');
insert into tb_costos (ca_costo, ca_transporte, ca_impoexpo, ca_modalidad, ca_comisionable) values('Nota Credito USA','Marítimo','Importación','PROYECTOS','Sí');
insert into tb_costos (ca_costo, ca_transporte, ca_impoexpo, ca_modalidad, ca_comisionable) values('Transporte Terrestre','Marítimo','Importación','PROYECTOS','Sí');
insert into tb_costos (ca_costo, ca_transporte, ca_impoexpo, ca_modalidad, ca_comisionable) values('Costos Naviera','Marítimo','Importación','PROYECTOS','Sí');
insert into tb_costos (ca_costo, ca_transporte, ca_impoexpo, ca_modalidad, ca_comisionable) values('Diferencia Recargos Locales','Marítimo','Importación','PROYECTOS','Sí');
insert into tb_costos (ca_costo, ca_transporte, ca_impoexpo, ca_modalidad, ca_comisionable) values('Otros contenedor','Marítimo','Importación','PROYECTOS','Sí');

-- Correr el script de la funcion fun_ref

ALTER TABLE tb_reportes DROP CONSTRAINT chk_impoexpo;

ALTER TABLE tb_reportes ADD CONSTRAINT chk_impoexpo CHECK (ca_impoexpo = 'Importación'::text OR ca_impoexpo = 'Exportación'::text OR ca_impoexpo = 'Triangulación'::text);

update tb_deducciones set ca_deduccion = 'Seguro de Riesgo' where ca_deduccion = 'Seguro Anker';
update tb_deducciones set ca_deduccion = 'Documentación Seguro' where ca_deduccion = 'Documentación Anker';


-- drop table bk_inoingresos_sea;
create table bk_inoingresos_sea WITH OIDS as select * from tb_inoingresos_sea;

drop table tb_inoingresos_sea cascade;

create table tb_inoingresos_sea
( ca_referencia varchar (16) NOT NULL
, ca_idcliente numeric(11) NOT NULL
, ca_hbls varchar (25) NOT NULL
, ca_factura varchar(15) NOT NULL
, ca_fchfactura date NOT NULL
, ca_idmoneda varchar (3) references tb_monedas NOT NULL
, ca_neto decimal (15,2) NOT NULL
, ca_valor decimal (15,2) NOT NULL
, ca_reccaja varchar(15) NOT NULL
, ca_fchpago date
, ca_tcambio decimal (7,2) NOT NULL
, ca_observaciones character (100)
, ca_fchcreado timestamp NOT NULL
, ca_usucreado varchar (20) NOT NULL
, ca_fchactualizado timestamp
, ca_usuactualizado varchar (20)
, constraint pk_tb_inoingresos_sea PRIMARY KEY (ca_referencia, ca_idcliente, ca_hbls, ca_factura)
, constraint fk_tb_inoingresos_sea FOREIGN KEY (ca_idcliente) REFERENCES tb_clientes (ca_idcliente)
, constraint fk_tb_inoingresos_sea_i FOREIGN KEY (ca_referencia, ca_idcliente, ca_hbls) REFERENCES tb_inoclientes_sea (ca_referencia, ca_idcliente, ca_hbls)
) WITH OIDS;
create index in_tb_inoingresos_sea on tb_inoingresos_sea (ca_factura, ca_referencia);
REVOKE ALL ON tb_inoingresos_sea FROM PUBLIC;
GRANT ALL ON tb_inoingresos_sea TO "Administrador";
GRANT ALL ON tb_inoingresos_sea TO GROUP "Usuarios";

insert into tb_inoingresos_sea (ca_referencia, ca_idcliente, ca_hbls, ca_factura, ca_fchfactura, ca_idmoneda, ca_neto, ca_valor, ca_reccaja, ca_fchpago, ca_tcambio, ca_observaciones, ca_fchcreado, ca_usucreado, ca_fchactualizado, ca_usuactualizado)
	select ca_referencia, ca_idcliente, ca_hbls, ca_factura, ca_fchfactura, 'USD', ca_neto, ca_valor, ca_reccaja, ca_fchpago, ca_tcambio, ca_observaciones, ca_fchcreado, ca_usucreado, ca_fchactualizado, ca_usuactualizado from bk_inoingresos_sea
	

create table bk_inodeduccion_sea WITH OIDS as select * from tb_inodeduccion_sea;

drop table tb_inodeduccion_sea cascade;

create table tb_inodeduccion_sea
( ca_referencia varchar (16) NOT NULL
, ca_idcliente numeric(11) NOT NULL
, ca_hbls varchar (25) NOT NULL
, ca_factura varchar(15) NOT NULL
, ca_iddeduccion smallint NOT NULL
, ca_neto decimal (15,2) NOT NULL
, ca_valor decimal (15,2) NOT NULL
, ca_fchcreado timestamp NOT NULL
, ca_usucreado varchar (20) NOT NULL
, ca_fchactualizado timestamp
, ca_usuactualizado varchar (20)
, constraint pk_tb_inodeduccion_sea PRIMARY KEY (ca_referencia, ca_idcliente, ca_hbls, ca_factura, ca_iddeduccion)
, constraint fk_tb_inodeduccion_sea FOREIGN KEY (ca_referencia, ca_idcliente, ca_hbls) REFERENCES tb_inoclientes_sea (ca_referencia, ca_idcliente, ca_hbls)
, constraint fk_tb_inodeduccion_sea_c FOREIGN KEY (ca_iddeduccion) REFERENCES tb_deducciones (ca_iddeduccion)
) WITH OIDS;
REVOKE ALL ON tb_inodeduccion_sea FROM PUBLIC;
GRANT ALL ON tb_inodeduccion_sea TO "Administrador";
GRANT ALL ON tb_inodeduccion_sea TO GROUP "Usuarios";

select count(*) from bk_inodeduccion_sea;

insert into tb_inodeduccion_sea (ca_referencia, ca_idcliente, ca_hbls, ca_factura, ca_iddeduccion, ca_neto, ca_valor, ca_fchcreado, ca_usucreado, ca_fchactualizado, ca_usuactualizado)
select id.ca_referencia, id.ca_idcliente, id.ca_hbls, id.ca_factura, id.ca_iddeduccion, (round(id.ca_valor / case when nullvalue(ii.ca_tcambio) or ii.ca_tcambio = 0 then 1 else ii.ca_tcambio end,2)) as ca_neto, id.ca_valor, id.ca_fchcreado, id.ca_usucreado, id.ca_fchactualizado, id.ca_usuactualizado 
	from bk_inodeduccion_sea id 
		left outer join tb_inoingresos_sea ii on (id.ca_referencia = ii.ca_referencia and id.ca_idcliente = ii.ca_idcliente and id.ca_hbls = ii.ca_hbls and id.ca_factura = ii.ca_factura)



Create view vi_inomaestra_sea as
Select substr(i.ca_referencia,15,1) as ca_ano, substr(i.ca_referencia,8,2)||'-'||substr(i.ca_referencia,15,1) as ca_mes, substr(i.ca_referencia,5,2) as ca_trafico, substr(i.ca_referencia,1,3) as ca_modal, i.ca_fchreferencia, i.ca_referencia, i.ca_impoexpo, i.ca_origen, c1.ca_ciudad as ca_ciuorigen, t1.ca_nombre as ca_traorigen, i.ca_destino,
       c2.ca_ciudad as ca_ciudestino, t2.ca_nombre as ca_tradestino, i.ca_fchembarque, i.ca_fcharribo, i.ca_modalidad, i.ca_idlinea, t.ca_nombre, t.ca_sigla, t.ca_nomtransportista, i.ca_motonave, i.ca_ciclo, i.ca_mbls, i.ca_observaciones, i.ca_fchconfirmacion, i.ca_horaconfirmacion, i.ca_registroadu, i.ca_fchregistroadu, i.ca_registrocap,
       i.ca_bandera, i.ca_fchdesconsolidacion, i.ca_mnllegada, i.ca_fchliberacion, i.ca_nroliberacion, i.ca_mensaje, i.ca_fchconfirmado, i.ca_usuconfirmado, i.ca_asunto_otm, i.ca_mensaje_otm, i.ca_fchllegada_otm, i.ca_ciudad_otm , i.ca_anulado, i.ca_fchcreado, i.ca_usucreado, i.ca_fchactualizado, i.ca_usuactualizado, i.ca_fchliquidado, i.ca_usuliquidado, i.ca_fchcerrado, i.ca_usucerrado, i.ca_provisional,
       (select sum(ie.ca_peso) from vi_inoequipos_sea ie where i.ca_referencia = ie.ca_referencia) as ca_peso_cap,
       (select sum(ie.ca_volumen) from vi_inoequipos_sea ie where i.ca_referencia = ie.ca_referencia) as ca_volumen_cap,
       (select sum(ic.ca_numpiezas) from tb_inoclientes_sea ic where i.ca_referencia = ic.ca_referencia) as ca_numpiezas,
       (select sum(ic.ca_peso) from tb_inoclientes_sea ic where i.ca_referencia = ic.ca_referencia) as ca_peso,
       (select sum(ic.ca_volumen) from tb_inoclientes_sea ic where i.ca_referencia = ic.ca_referencia) as ca_volumen,
       (select sum(ic.ca_neto*ic.ca_tcambio) from tb_inocostos_sea ic where i.ca_referencia = ic.ca_referencia) as ca_costoneto,
       (select sum(ic.ca_venta)-sum(ic.ca_neto*ic.ca_tcambio) from tb_inocostos_sea ic, tb_costos c where ic.ca_idcosto = c.ca_idcosto and i.ca_referencia = ic.ca_referencia and c.ca_comisionable != 'No') as ca_comisionable,
       (select sum(ic.ca_venta)-sum(ic.ca_neto*ic.ca_tcambio) from tb_inocostos_sea ic, tb_costos c where ic.ca_idcosto = c.ca_idcosto and i.ca_referencia = ic.ca_referencia and c.ca_comisionable = 'No') as ca_nocomisionable,
       (select sum(ii.ca_valor) from tb_inoingresos_sea ii where i.ca_referencia = ii.ca_referencia) as ca_facturacion,
       (select sum(d.ca_valor) from tb_inodeduccion_sea d where i.ca_referencia = d.ca_referencia) as ca_deduccion,
       (select sum(ic.ca_venta) from tb_inocostos_sea ic, tb_costos c where ic.ca_idcosto = c.ca_idcosto and i.ca_referencia = ic.ca_referencia and c.ca_comisionable != 'No' and ic.ca_login = '') as ca_utilidad,
       (case when i.ca_provisional then 'Provisional' else (case when nullvalue(i.ca_usucerrado) = false and length(i.ca_usucerrado) != 0 then 'Cerrado' else 'Abierto' end) end) as ca_estado
       from tb_inomaestra_sea i, tb_ciudades c1, tb_ciudades c2, tb_traficos t1, tb_traficos t2, vi_transporlineas t where i.ca_origen = c1.ca_idciudad and i.ca_destino = c2.ca_idciudad and c1.ca_idtrafico = t1.ca_idtrafico and c2.ca_idtrafico = t2.ca_idtrafico and i.ca_idlinea = t.ca_idlinea
       order by ca_ano DESC, ca_mes, ca_trafico, ca_modal, ca_referencia;
REVOKE ALL ON vi_inomaestra_sea FROM PUBLIC;
GRANT ALL ON vi_inomaestra_sea TO "Administrador";
GRANT ALL ON vi_inomaestra_sea TO GROUP "Usuarios";

Create view vi_inocontenedores_sea as
Select substr(i.ca_referencia,15,1) as ca_ano, substr(i.ca_referencia,8,2)||'-'||substr(i.ca_referencia,15,1) as ca_mes, substr(i.ca_referencia,5,2) as ca_trafico, substr(i.ca_referencia,1,3) as ca_modal, i.ca_fchreferencia, i.ca_referencia, i.ca_impoexpo, i.ca_origen, c1.ca_ciudad as ca_ciuorigen, t1.ca_nombre as ca_traorigen, i.ca_destino,
       c2.ca_ciudad as ca_ciudestino, t2.ca_nombre as ca_tradestino, i.ca_fchembarque, i.ca_fcharribo, i.ca_modalidad, i.ca_idlinea, t.ca_nombre, t.ca_sigla, t.ca_nomtransportista, i.ca_motonave, i.ca_ciclo, i.ca_mbls, i.ca_observaciones, i.ca_fchconfirmacion, i.ca_horaconfirmacion, i.ca_registroadu, i.ca_fchregistroadu, i.ca_registrocap,
       i.ca_bandera, i.ca_fchdesconsolidacion, i.ca_mnllegada, i.ca_fchliberacion, i.ca_nroliberacion, i.ca_mensaje, i.ca_fchconfirmado, i.ca_usuconfirmado, i.ca_asunto_otm, i.ca_mensaje_otm, i.ca_fchllegada_otm, i.ca_ciudad_otm, i.ca_anulado, i.ca_fchcreado, i.ca_usucreado, i.ca_fchactualizado, i.ca_usuactualizado, i.ca_fchliquidado, i.ca_usuliquidado, i.ca_fchcerrado, i.ca_usucerrado, i.ca_provisional,
       (select sum(ic.ca_numpiezas) from tb_inoclientes_sea ic where i.ca_referencia = ic.ca_referencia) as ca_numpiezas,
       (select sum(ic.ca_peso) from tb_inoclientes_sea ic where i.ca_referencia = ic.ca_referencia) as ca_peso,
       (select sum(ic.ca_volumen) from tb_inoclientes_sea ic where i.ca_referencia = ic.ca_referencia) as ca_volumen,
       (select sum(ic.ca_neto*ic.ca_tcambio) from tb_inocostos_sea ic where i.ca_referencia = ic.ca_referencia) as ca_costoneto,
       (select sum(ic.ca_venta)-sum(ic.ca_neto*ic.ca_tcambio) from tb_inocostos_sea ic, tb_costos c where ic.ca_idcosto = c.ca_idcosto and i.ca_referencia = ic.ca_referencia and c.ca_comisionable != 'No') as ca_comisionable,
       (select sum(ic.ca_venta)-sum(ic.ca_neto*ic.ca_tcambio) from tb_inocostos_sea ic, tb_costos c where ic.ca_idcosto = c.ca_idcosto and i.ca_referencia = ic.ca_referencia and c.ca_comisionable = 'No') as ca_nocomisionable,
       (select sum(ii.ca_valor) from tb_inoingresos_sea ii where i.ca_referencia = ii.ca_referencia) as ca_facturacion,
       (select sum(d.ca_valor) from tb_inodeduccion_sea d where i.ca_referencia = d.ca_referencia) as ca_deduccion,
       (select sum(ic.ca_venta) from tb_inocostos_sea ic, tb_costos c where ic.ca_idcosto = c.ca_idcosto and i.ca_referencia = ic.ca_referencia and c.ca_comisionable != 'No' and ic.ca_login = '') as ca_utilidad,
       (case when i.ca_provisional then 'Provisional' else (case when nullvalue(i.ca_usucerrado) = false and length(i.ca_usucerrado) != 0 then 'Cerrado' else 'Abierto' end) end) as ca_estado
       from tb_inomaestra_sea i, tb_ciudades c1, tb_ciudades c2, tb_traficos t1, tb_traficos t2, vi_transporlineas t where i.ca_origen = c1.ca_idciudad and i.ca_destino = c2.ca_idciudad and c1.ca_idtrafico = t1.ca_idtrafico and c2.ca_idtrafico = t2.ca_idtrafico and i.ca_idlinea = t.ca_idlinea
       order by ca_ano DESC, ca_mes, ca_trafico, ca_modal, ca_referencia;
REVOKE ALL ON vi_inocontenedores_sea FROM PUBLIC;
GRANT ALL ON vi_inocontenedores_sea TO "Administrador";
GRANT ALL ON vi_inocontenedores_sea TO GROUP "Usuarios";

Create view vi_inoclientes_sea as
Select i.oid as ca_oid, i.ca_referencia, i.ca_idcliente, c.ca_compania, i.ca_idreporte, r.ca_consecutivo, i.ca_hbls, i.ca_idproveedor, i.ca_proveedor, i.ca_numpiezas, i.ca_peso, i.ca_volumen, i.ca_numorden, i.ca_confirmar, i.ca_mensaje, i.ca_login, i.ca_continuacion, i.ca_continuacion_dest, cu.ca_ciudad as ca_ciudad_dest, i.ca_idbodega, b.ca_nombre as ca_bodega, u.ca_sucursal, i.ca_observaciones, i.ca_fchliberacion, i.ca_notaliberacion,
       i.ca_fchcreado as ca_fchcreado_cl, i.ca_usucreado as ca_usucreado_cl, i.ca_fchactualizado as ca_fchactualizado_cl, i.ca_usuactualizado as ca_usuactualizado_cl, i.ca_usuliberado, i.ca_fchliberado, f.oid as ca_oid_fc, f.ca_factura, f.ca_fchfactura, f.ca_neto, f.ca_idmoneda, f.ca_valor, f.ca_reccaja, f.ca_fchpago, f.ca_tcambio, f.ca_observaciones as ca_observaciones_fact,
       (select sum(d.ca_valor) from tb_inodeduccion_sea d where f.ca_referencia = d.ca_referencia and f.ca_idcliente = d.ca_idcliente and f.ca_hbls = d.ca_hbls and f.ca_factura = d.ca_factura) as ca_deduccion,
       (select count(cl.ca_hbls) from tb_inoclientes_sea cl where cl.ca_referencia = i.ca_referencia) as ca_nrohbls,
       f.ca_fchcreado as ca_fchcreado_fc, f.ca_usucreado as ca_usucreado_fc, f.ca_fchactualizado as ca_fchactualizado_fc, f.ca_usuactualizado as ca_usuactualizado_fc,
       (select max(ca_fchvencimiento) as ca_fchvencimiento from tb_comcliente where i.ca_idcliente = ca_idcliente group by ca_idcliente) as ca_fchvencimiento
       from tb_inoclientes_sea i LEFT OUTER JOIN tb_inoingresos_sea f ON (i.ca_referencia = f.ca_referencia and i.ca_idcliente = f.ca_idcliente and i.ca_hbls = f.ca_hbls) LEFT OUTER JOIN tb_clientes c ON (i.ca_idcliente = c.ca_idcliente) LEFT OUTER JOIN tb_ciudades cu ON (i.ca_continuacion_dest = cu.ca_idciudad) LEFT OUTER JOIN tb_bodegas b ON (i.ca_idbodega = b.ca_idbodega) LEFT OUTER JOIN tb_reportes r ON (i.ca_idreporte = r.ca_idreporte) LEFT OUTER JOIN control.tb_usuarios u ON (i.ca_login = u.ca_login)
       order by i.ca_referencia, c.ca_compania, i.ca_hbls, f.ca_factura;
REVOKE ALL ON vi_inoclientes_sea FROM PUBLIC;
GRANT ALL ON vi_inoclientes_sea TO "Administrador";
GRANT ALL ON vi_inoclientes_sea TO GROUP "Usuarios";

Create view vi_inoconsulta_sea as
Select substr(im.ca_referencia,15,1) as ca_ano, substr(im.ca_referencia,8,2)||'-'||substr(im.ca_referencia,15,1) as ca_mes, substr(im.ca_referencia,5,2) as ca_trafico, substr(im.ca_referencia,1,3) as ca_modal, im.ca_referencia, im.ca_mbls, im.ca_motonave, im.ca_observaciones, t.ca_nombre, t.ca_sigla, ie.ca_idequipo, im.ca_origen, c1.ca_ciudad as ca_ciuorigen, t1.ca_nombre as ca_traorigen, im.ca_destino,
       c2.ca_ciudad as ca_ciudestino, t2.ca_nombre as ca_tradestino, im.ca_fchembarque, im.ca_fcharribo, ic.ca_hbls, ic.ca_idcliente, c.ca_compania, ii.ca_factura, it.ca_factura as ca_factura_prov, us.ca_sucursal
       from tb_inomaestra_sea im
       LEFT OUTER JOIN tb_ciudades c1 ON (im.ca_origen = c1.ca_idciudad)
       LEFT OUTER JOIN tb_ciudades c2 ON (im.ca_destino = c2.ca_idciudad)
       LEFT OUTER JOIN tb_traficos t1 ON (c1.ca_idtrafico = t1.ca_idtrafico)
       LEFT OUTER JOIN tb_traficos t2 ON (c2.ca_idtrafico = t2.ca_idtrafico)
       LEFT OUTER JOIN tb_transporlineas t ON (im.ca_idlinea = t.ca_idlinea)
       LEFT OUTER JOIN tb_inoequipos_sea ie ON (im.ca_referencia = ie.ca_referencia)
       LEFT OUTER JOIN tb_inoclientes_sea ic ON (im.ca_referencia = ic.ca_referencia)
       LEFT OUTER JOIN tb_clientes c ON (ic.ca_idcliente = c.ca_idcliente)
       LEFT OUTER JOIN tb_inoingresos_sea ii ON (im.ca_referencia = ii.ca_referencia and ic.ca_idcliente = ii.ca_idcliente and ic.ca_hbls = ii.ca_hbls)
       LEFT OUTER JOIN tb_inocostos_sea it ON (im.ca_referencia = it.ca_referencia)
	   LEFT OUTER JOIN control.tb_usuarios us ON (im.ca_usucreado = us.ca_login);
REVOKE ALL ON vi_inoconsulta_sea FROM PUBLIC;
GRANT ALL ON vi_inoconsulta_sea TO "Administrador";
GRANT ALL ON vi_inoconsulta_sea TO GROUP "Usuarios";

Create view vi_inocomisiones_sea as
Select i.ca_ano, i.ca_mes, i.ca_trafico, i.ca_modal, i.ca_traorigen, i.ca_ciuorigen, i.ca_ciudestino, i.ca_modalidad, i.ca_referencia, c.ca_login, l.ca_sucursal, c.ca_idcliente, cl.ca_compania, c.ca_hbls, c.ca_volumen, i.ca_facturacion AS ca_facturacion_r, i.ca_deduccion AS ca_deduccion_r, i.ca_utilidad AS ca_utilidad_r, i.ca_volumen AS ca_volumen_r,
       u.ca_idcosto AS ca_idcosto_ded, s.ca_costo AS ca_costo_ded, u.ca_factura AS ca_factura_ded, u.ca_valor AS ca_valor_ded, i.ca_estado,
       (select sum(n.ca_valor) from tb_inoingresos_sea n where c.ca_referencia = n.ca_referencia AND c.ca_idcliente = n.ca_idcliente AND c.ca_hbls = n.ca_hbls) as ca_valor,
       (select sum(s.ca_vlrcomision) from tb_inocomisiones_sea s where s.ca_referencia = c.ca_referencia AND s.ca_idcliente = c.ca_idcliente AND s.ca_hbls = c.ca_hbls) as ca_vlrcomisiones,
       (select sum(s.ca_sbrcomision) from tb_inocomisiones_sea s where s.ca_referencia = c.ca_referencia AND s.ca_idcliente = c.ca_idcliente AND s.ca_hbls = c.ca_hbls) as ca_sbrcomisiones
   FROM vi_inocontenedores_sea i
   LEFT JOIN tb_inoclientes_sea c ON (i.ca_referencia = c.ca_referencia)
   LEFT JOIN tb_inoutilidad_sea u ON (u.ca_referencia = c.ca_referencia AND u.ca_idcliente = c.ca_idcliente AND u.ca_hbls = c.ca_hbls)
   LEFT JOIN tb_costos s ON u.ca_idcosto = s.ca_idcosto
   LEFT JOIN tb_clientes cl ON cl.ca_idcliente = c.ca_idcliente
   LEFT JOIN control.tb_usuarios l ON c.ca_login = l.ca_login
   ORDER BY ca_mes, c.ca_login, i.ca_referencia, cl.ca_compania, c.ca_hbls;
REVOKE ALL ON public.vi_inocomisiones_sea FROM PUBLIC;
GRANT ALL ON TABLE public.vi_inocomisiones_sea TO postgres WITH GRANT OPTION;
GRANT ALL ON TABLE public.vi_inocomisiones_sea TO "Administrador";
GRANT ALL ON TABLE public.vi_inocomisiones_sea TO GROUP "Usuarios";

Create view vi_inoingresos_sea as
Select i.oid as ca_oid, substr(i.ca_referencia,15,1) as ca_ano, substr(i.ca_referencia,8,2)||'-'||substr(i.ca_referencia,15,1) as ca_mes, i.ca_referencia, i.ca_idcliente, c.ca_compania, l.ca_hbls, l.ca_login, l.ca_volumen,
       i.ca_factura, i.ca_fchfactura, i.ca_reccaja, i.ca_fchpago, i.ca_idmoneda, i.ca_neto, i.ca_valor, i.ca_observaciones, i.ca_fchcreado, i.ca_usucreado, i.ca_fchactualizado, i.ca_usuactualizado,
       (select sum(cm.ca_vlrcomision) from tb_inocomisiones_sea cm where l.ca_referencia = cm.ca_referencia and l.ca_hbls = cm.ca_hbls) as ca_vlrcomisiones,
       (select sum(cm.ca_sbrcomision) from tb_inocomisiones_sea cm where l.ca_referencia = cm.ca_referencia and l.ca_hbls = cm.ca_hbls) as ca_sbrcomisiones,
       (select sum(ic.ca_volumen) from tb_inoclientes_sea ic where i.ca_referencia = ic.ca_referencia) as ca_volumen_r,
       (select sum(ii.ca_valor) from tb_inoingresos_sea ii where i.ca_referencia = ii.ca_referencia) as ca_facturacion_r,
       (select sum(d.ca_valor) from tb_inodeduccion_sea d where i.ca_referencia = d.ca_referencia) as ca_deduccion_r,
       (select sum(ic.ca_venta) from tb_inocostos_sea ic, tb_costos c where ic.ca_idcosto = c.ca_idcosto and i.ca_referencia = ic.ca_referencia and c.ca_comisionable != 'No' and ic.ca_login = '') as ca_utilidad_r,
       (select sum(iu.ca_valor) from tb_inoutilidad_sea iu where l.ca_referencia = iu.ca_referencia and l.ca_idcliente = iu.ca_idcliente and l.ca_hbls = iu.ca_hbls) as ca_sbrcomision,
       cm.ca_comprobante, cm.ca_fchliquidacion, cm.ca_vlrcomision as ca_vlrcomision_cob, cm.ca_sbrcomision as ca_sbrcomision_cob,
       (case when m.ca_provisional then 'Provisional' else (case when nullvalue(m.ca_usucerrado) = false and length(m.ca_usucerrado) != 0 then 'Cerrado' else 'Abierto' end) end) as ca_estado
       FROM tb_inoingresos_sea i
       LEFT JOIN tb_inoclientes_sea l ON (i.ca_referencia = l.ca_referencia and i.ca_hbls = l.ca_hbls)
       LEFT JOIN tb_clientes c ON (l.ca_idcliente = c.ca_idcliente)
       LEFT JOIN tb_inomaestra_sea m ON (i.ca_referencia = m.ca_referencia )
       LEFT JOIN tb_inocomisiones_sea cm ON (i.ca_referencia = cm.ca_referencia and i.ca_idcliente = cm.ca_idcliente and i.ca_hbls = cm.ca_hbls)
       order by ca_login, ca_compania, ca_referencia, ca_hbls, ca_factura;
REVOKE ALL ON vi_inoingresos_sea FROM PUBLIC;
GRANT ALL ON vi_inoingresos_sea TO "Administrador";
GRANT ALL ON vi_inoingresos_sea TO GROUP "Usuarios";

Create view vi_inocarga_fcl as
Select im.ca_mes, im.ca_trafico, im.ca_modalidad, im.ca_traorigen, im.ca_ciudestino, c.ca_liminferior as ca_capacidad, sum(round(c.ca_liminferior/20,0)*ic.ca_factor) as ca_teus, sum(ie.ca_cantidad*ic.ca_factor) as ca_cantidad, ca_sucursal from ( select inoc.ca_referencia, inoc.ca_idcliente, ca_login, sum(inoc.ca_volumen) / (case when max(inov.ca_granvol) <> 0 then max(inov.ca_granvol) else 1 end) as ca_factor from tb_inoclientes_sea inoc, (select ca_referencia, sum(ca_volumen) as ca_granvol from tb_inoclientes_sea group by ca_referencia) inov
       where inoc.ca_referencia = inov.ca_referencia group by inoc.ca_referencia, inoc.ca_idcliente, inoc.ca_login order by inoc.ca_referencia, inoc.ca_idcliente, inoc.ca_login ) ic
       LEFT OUTER JOIN vi_inocontenedores_sea im ON (ic.ca_referencia = im.ca_referencia)
       LEFT OUTER JOIN tb_inoequipos_sea ie ON (ic.ca_referencia = ie.ca_referencia)
       LEFT OUTER JOIN tb_conceptos c ON (ie.ca_idconcepto = c.ca_idconcepto), control.tb_usuarios u
       where im.ca_modalidad = 'FCL' and ic.ca_login = u.ca_login
       group by ca_mes, im.ca_modalidad, ca_liminferior, ca_trafico, ca_traorigen, ca_ciudestino, u.ca_sucursal
       order by ca_mes, ca_sucursal, im.ca_modalidad, ca_traorigen, ca_ciudestino, ca_capacidad;
REVOKE ALL ON vi_inocarga_fcl FROM PUBLIC;
GRANT ALL ON vi_inocarga_fcl TO "Administrador";
GRANT ALL ON vi_inocarga_fcl TO GROUP "Usuarios";

Create view vi_inocarga_lcl as
Select i.ca_mes, u.ca_sucursal, i.ca_trafico, i.ca_traorigen, i.ca_ciudestino, sum(c.ca_volumen) as ca_volumen
       from vi_inocontenedores_sea i, tb_inoclientes_sea c, control.tb_usuarios u
       where i.ca_modalidad != 'FCL' and i.ca_referencia = c.ca_referencia and c.ca_login = u.ca_login
       group by ca_mes, ca_sucursal, ca_trafico, ca_traorigen, ca_ciudestino
       order by ca_mes, u.ca_sucursal, i.ca_traorigen, i.ca_ciudestino;
REVOKE ALL ON vi_inocarga_lcl FROM PUBLIC;
GRANT ALL ON vi_inocarga_lcl TO "Administrador";
GRANT ALL ON vi_inocarga_lcl TO GROUP "Usuarios";

Create view vi_inonaviera_fcl as
Select i.ca_mes, i.ca_trafico, i.ca_nomtransportista, i.ca_nombre, i.ca_traorigen, i.ca_ciudestino, substr(e.ca_concepto,1,2) as ca_capacidad, sum(e.ca_cantidad) as ca_cantidad
       from vi_inocontenedores_sea i, vi_inoequipos_sea e
       where i.ca_modalidad = 'FCL' and i.ca_referencia = e.ca_referencia
       group by ca_mes, ca_nomtransportista, ca_nombre, ca_modalidad, substr(ca_concepto,1,2), ca_trafico, ca_traorigen, ca_ciudestino
       order by ca_mes, ca_nomtransportista, ca_nombre, ca_modalidad, ca_traorigen, ca_ciudestino, ca_capacidad;
REVOKE ALL ON vi_inonaviera_fcl FROM PUBLIC;
GRANT ALL ON vi_inonaviera_fcl TO "Administrador";
GRANT ALL ON vi_inonaviera_fcl TO GROUP "Usuarios";

Create view vi_inonaviera_lcl as
Select i.ca_mes, i.ca_trafico, i.ca_nomtransportista, i.ca_nombre, i.ca_traorigen, i.ca_ciudestino, sum(c.ca_numpiezas) as ca_numpiezas, sum(c.ca_peso) as ca_peso, sum(c.ca_volumen) as ca_volumen
       from vi_inocontenedores_sea i, tb_inoclientes_sea c
       where i.ca_modalidad != 'FCL' and i.ca_referencia = c.ca_referencia
       group by ca_mes, ca_nomtransportista, ca_nombre, ca_modalidad, ca_trafico, ca_traorigen, ca_ciudestino
       order by ca_mes, ca_nomtransportista, ca_nombre, ca_traorigen, ca_ciudestino;
REVOKE ALL ON vi_inonaviera_lcl FROM PUBLIC;
GRANT ALL ON vi_inonaviera_lcl TO "Administrador";
GRANT ALL ON vi_inonaviera_lcl TO GROUP "Usuarios";

Create view vi_inotrafico_fcl as
Select i.ca_ano, i.ca_mes, i.ca_trafico, i.ca_traorigen, i.ca_ciudestino, sum(e.ca_20pies) as ca_20pies, sum(q.ca_40pies) as ca_40pies, sum((case when e.ca_20pies <> 0 then e.ca_20pies else 0 end) + ((case when q.ca_40pies <> 0 then q.ca_40pies else 0 end)*2)) as ca_teus
       from vi_inocontenedores_sea i
       LEFT OUTER JOIN (select ie.ca_referencia, count(ie.ca_idequipo) as ca_20pies from vi_inoequipos_sea ie where ie.ca_liminferior = 20 group by ie.ca_referencia) e ON (i.ca_referencia = e.ca_referencia)
       LEFT OUTER JOIN (select ie.ca_referencia, count(ie.ca_idequipo) as ca_40pies from vi_inoequipos_sea ie where ie.ca_liminferior in (40, 45) group by ie.ca_referencia) q ON (i.ca_referencia = q.ca_referencia)
       where i.ca_modalidad = 'FCL'
       group by ca_ano, ca_mes, ca_trafico, ca_traorigen, ca_ciudestino
       order by ca_ano, ca_mes, ca_traorigen, ca_ciudestino;
REVOKE ALL ON vi_inotrafico_fcl FROM PUBLIC;
GRANT ALL ON vi_inotrafico_fcl TO "Administrador";
GRANT ALL ON vi_inotrafico_fcl TO GROUP "Usuarios";

Create view vi_inotrafico_lcl as
Select i.ca_ano, i.ca_mes, i.ca_trafico, i.ca_traorigen, i.ca_ciudestino, sum(c.ca_volumen) as ca_volumen, sum(e.ca_20pies) as ca_20pies, sum(q.ca_40pies) as ca_40pies, sum((case when e.ca_20pies <> 0 then e.ca_20pies else 0 end) + ((case when q.ca_40pies <> 0 then q.ca_40pies else 0 end)*2)) as ca_teus
       from vi_inocontenedores_sea i
       INNER JOIN (select ic.ca_referencia, sum(ic.ca_volumen) as ca_volumen from tb_inoclientes_sea ic group by ic.ca_referencia) c ON (i.ca_referencia = c.ca_referencia)
       LEFT OUTER JOIN (select ie.ca_referencia, sum(ie.ca_cantidad) as ca_20pies from vi_inoequipos_sea ie where ie.ca_liminferior = 20 group by ie.ca_referencia) e ON (i.ca_referencia = e.ca_referencia)
       LEFT OUTER JOIN (select ie.ca_referencia, sum(ie.ca_cantidad) as ca_40pies from vi_inoequipos_sea ie where ie.ca_liminferior in (40, 45) group by ie.ca_referencia) q ON (i.ca_referencia = q.ca_referencia)
       where i.ca_modalidad != 'FCL'
       group by ca_ano, ca_mes, ca_trafico, ca_traorigen, ca_ciudestino
       order by ca_ano, ca_mes, ca_traorigen, ca_ciudestino;
REVOKE ALL ON vi_inotrafico_lcl FROM PUBLIC;
GRANT ALL ON vi_inotrafico_lcl TO "Administrador";
GRANT ALL ON vi_inotrafico_lcl TO GROUP "Usuarios";

Create view vi_inosufijos_sea as
select i.ca_ano, i.ca_mes, i.ca_idcliente, i.ca_compania, i.ca_trafico, i.ca_traorigen, count(DISTINCT i.ca_referencia||'|'||i.ca_idcliente||'|'||i.ca_hbls) as ca_hbls,
       sum((case when i.ca_valor <> 0 then i.ca_valor else 0 end)) as ca_facturacion,
       sum(round((((case when i.ca_facturacion_r <> 0 then i.ca_facturacion_r else 0 end)-
       (case when i.ca_deduccion_r <> 0 then i.ca_deduccion_r else 0 end)-
       (case when i.ca_utilidad_r <> 0 then i.ca_utilidad_r else 0 end))/
       (case when i.ca_volumen_r <> 0 then i.ca_volumen_r else 1 end))*
       (case when i.ca_volumen <> 0 then i.ca_volumen else 0 end),0)) as ca_utilidad,
       ( select sum(iu.ca_valor) from tb_inoutilidad_sea iu
         LEFT OUTER JOIN tb_inomaestra_sea im ON (iu.ca_referencia = im.ca_referencia)
         LEFT OUTER JOIN tb_inoclientes_sea ic ON (iu.ca_referencia = ic.ca_referencia and iu.ca_idcliente = ic.ca_idcliente and iu.ca_hbls = ic.ca_hbls)
         LEFT OUTER JOIN tb_ciudades c ON (im.ca_origen = c.ca_idciudad)
         LEFT OUTER JOIN tb_traficos t ON (c.ca_idtrafico = t.ca_idtrafico)
         where substr(ic.ca_referencia,15,1) = i.ca_ano and substr(ic.ca_referencia,8,2)||'-'||substr(ic.ca_referencia,15,1) = i.ca_mes and iu.ca_idcliente = i.ca_idcliente and t.ca_nombre = i.ca_traorigen
       ) as ca_sobreventa,
       ( select sum(round(c.ca_liminferior/20,0)*ic.ca_factor) from ( select inoc.ca_referencia, inoc.ca_idcliente, ca_login, sum(inoc.ca_volumen) / (case when max(inov.ca_granvol) <> 0 then max(inov.ca_granvol) else 1 end) as ca_factor from tb_inoclientes_sea inoc, (select ca_referencia, sum(ca_volumen) as ca_granvol from tb_inoclientes_sea group by ca_referencia) inov
         where inoc.ca_referencia = inov.ca_referencia group by inoc.ca_referencia, inoc.ca_idcliente, inoc.ca_login order by inoc.ca_referencia, inoc.ca_idcliente, inoc.ca_login ) ic
         LEFT OUTER JOIN tb_inomaestra_sea im ON (ic.ca_referencia = im.ca_referencia)
         LEFT OUTER JOIN tb_inoequipos_sea ie ON (ic.ca_referencia = ie.ca_referencia)
         LEFT OUTER JOIN tb_conceptos c ON (ie.ca_idconcepto = c.ca_idconcepto)
         LEFT OUTER JOIN tb_ciudades d ON (im.ca_origen = d.ca_idciudad)
         LEFT OUTER JOIN tb_traficos t ON (d.ca_idtrafico = t.ca_idtrafico)
         where im.ca_modalidad = 'FCL' and substr(im.ca_referencia,15,1) = i.ca_ano and substr(im.ca_referencia,8,2)||'-'||substr(im.ca_referencia,15,1) = i.ca_mes and ic.ca_idcliente = i.ca_idcliente and t.ca_nombre = i.ca_traorigen
       ) as ca_teus,
       ( select sum(ic.ca_volumen) from tb_inoclientes_sea ic
         LEFT OUTER JOIN tb_inomaestra_sea im ON (ic.ca_referencia = im.ca_referencia)
         LEFT OUTER JOIN tb_ciudades c ON (im.ca_origen = c.ca_idciudad)
         LEFT OUTER JOIN tb_traficos t ON (c.ca_idtrafico = t.ca_idtrafico)
         where im.ca_modalidad != 'FCL' and substr(im.ca_referencia,15,1) = i.ca_ano and substr(im.ca_referencia,8,2)||'-'||substr(im.ca_referencia,15,1) = i.ca_mes and ic.ca_idcliente = i.ca_idcliente and t.ca_nombre = i.ca_traorigen
       ) as ca_cbms
       from ( select im.ca_ano, im.ca_mes, im.ca_trafico, im.ca_traorigen, ic.ca_referencia, ic.ca_idcliente, c.ca_compania, ic.ca_hbls, ic.ca_volumen, sum(ii.ca_valor) as ca_valor, im.ca_facturacion as ca_facturacion_r, im.ca_deduccion as ca_deduccion_r, im.ca_utilidad as ca_utilidad_r, im.ca_volumen as ca_volumen_r, u.ca_login, u.ca_sucursal
              from tb_inoclientes_sea ic LEFT OUTER JOIN tb_inoingresos_sea ii ON (ic.ca_referencia = ii.ca_referencia and ic.ca_idcliente = ii.ca_idcliente and ic.ca_hbls = ii.ca_hbls) LEFT OUTER JOIN control.tb_usuarios u ON (ic.ca_login = u.ca_login), vi_inocontenedores_sea im, tb_clientes c
              where ic.ca_referencia = im.ca_referencia and ic.ca_idcliente = c.ca_idcliente
              group by im.ca_ano, im.ca_mes, im.ca_trafico, im.ca_traorigen, ic.ca_referencia, ic.ca_idcliente, c.ca_compania, ic.ca_hbls, ic.ca_volumen, im.ca_facturacion, im.ca_deduccion, im.ca_utilidad, im.ca_volumen, u.ca_sucursal, u.ca_login ) as i
       group by i.ca_ano, i.ca_mes, i.ca_idcliente, i.ca_compania, i.ca_trafico, i.ca_traorigen
       order by ca_facturacion DESC;
REVOKE ALL ON vi_inosufijos_sea FROM PUBLIC;
GRANT ALL ON vi_inosufijos_sea TO "Administrador";
GRANT ALL ON vi_inosufijos_sea TO GROUP "Usuarios";

Create view vi_inotraficos_sea as
Select substr(m.ca_referencia,8,2)||'-'||substr(m.ca_referencia,15,1) as ca_mes, t.ca_nombre as ca_traorigen, substr(m.ca_referencia,5,2) as ca_sufijo,
       count(DISTINCT m.ca_referencia) as ca_referencias,
       count(DISTINCT c.ca_referencia||'|'||c.ca_idcliente||'|'||c.ca_hbls) as ca_hbls,
       count(DISTINCT c.ca_idcliente) as ca_clientes,
       sum(i.ca_valor) as ca_facturacion
       from tb_inomaestra_sea m LEFT OUTER JOIN tb_inoclientes_sea c ON (c.ca_referencia = m.ca_referencia)
       LEFT OUTER JOIN (select ca_referencia, ca_idcliente, ca_hbls, sum(ca_valor) as ca_valor from tb_inoingresos_sea group by ca_referencia, ca_idcliente, ca_hbls) i ON (c.ca_referencia = i.ca_referencia and c.ca_idcliente = i.ca_idcliente and c.ca_hbls = i.ca_hbls), tb_ciudades p, tb_traficos t
       where m.ca_origen = p.ca_idciudad and p.ca_idtrafico = t.ca_idtrafico
       group by ca_mes, ca_sufijo, ca_traorigen
       order by ca_mes, ca_traorigen;
REVOKE ALL ON vi_inotraficos_sea FROM PUBLIC;
GRANT ALL ON vi_inotraficos_sea TO "Administrador";
GRANT ALL ON vi_inotraficos_sea TO GROUP "Usuarios";

Create view vi_inoutilidades_sea as
select i.ca_mes, i.ca_trafico, i.ca_modal, i.ca_traorigen, i.ca_ciuorigen, i.ca_ciudestino, i.ca_modalidad, i.ca_referencia, i.ca_estado,
       (case when i.ca_facturacion <> 0 then i.ca_facturacion else 0 end) - (case when i.ca_deduccion <> 0 then i.ca_deduccion else 0 end) - (case when i.ca_utilidad <> 0 then i.ca_utilidad else 0 end) as ca_utilcons,
       (((case when i.ca_facturacion <> 0 then i.ca_facturacion else 0 end) - (case when i.ca_deduccion <> 0 then i.ca_deduccion else 0 end) - (case when i.ca_utilidad <> 0 then i.ca_utilidad else 0 end)) / case when i.ca_volumen <> 0 then i.ca_volumen else 1 end) as ca_utilxcbm
       from vi_inocontenedores_sea i order by ca_ano, ca_mes, ca_traorigen, ca_modalidad, ca_utilxcbm;
REVOKE ALL ON vi_inoutilidades_sea FROM PUBLIC;
GRANT ALL ON vi_inoutilidades_sea TO "Administrador";
GRANT ALL ON vi_inoutilidades_sea TO GROUP "Usuarios";

Create view vi_repgerencia_sea as
select substr(ic.ca_referencia,15) as ca_ano, substr(ic.ca_referencia,8,2) as ca_mes, substr(ic.ca_referencia,5,2) as ca_sufijo,
	ic.ca_referencia, im.ca_modalidad, tr.ca_nombre as ca_traorigen, co.ca_ciudad as ca_ciuorigen, cd.ca_ciudad as ca_ciudestino, us.ca_sucursal, ic.ca_idcliente, cl.ca_compania, ic.ca_hbls,
	ii.ca_facturacion, (round(iu.ca_utilidad_r / (case when iu.ca_volumen_r = 0 then 1 else iu.ca_volumen_r end) * ic.ca_volumen,0)) as ca_utilidad, iv.ca_sobreventa,
	(case when im.ca_modalidad != 'FCL' then ic.ca_volumen else 0 end) as ca_cbm,
	(case when im.ca_modalidad = 'FCL' then (round(ie.ca_teus / (case when iu.ca_volumen_r = 0 then 1 else iu.ca_volumen_r end) * ic.ca_volumen,2)) else 0 end) as ca_teus,
	(case when im.ca_provisional then 'Provisional' else (case when nullvalue(im.ca_usucerrado) = false and length(im.ca_usucerrado) != 0 then 'Cerrado' else 'Abierto' end) end) as ca_estado,
	nv.ca_nombre as ca_nomlinea, ic.ca_login, us.ca_nombre as ca_vendedor
	
	from tb_inoclientes_sea ic
		LEFT OUTER JOIN (select ca_referencia, ca_hbls, ca_idcliente, sum(to_number(ca_valor::text,'9999999999.99')) as ca_facturacion from tb_inoingresos_sea group by ca_referencia, ca_hbls, ca_idcliente) ii ON (ic.ca_referencia = ii.ca_referencia and ic.ca_idcliente = ii.ca_idcliente and ic.ca_hbls = ii.ca_hbls)
		LEFT OUTER JOIN (
			select im.ca_referencia, iv.ca_volumen_r, (case when not nullvalue(ii.ca_facturacion_r) then ii.ca_facturacion_r else 0 end)-(case when not nullvalue(id.ca_deduccion_r) then id.ca_deduccion_r else 0 end)-(case when not nullvalue(ic.ca_costosplus_r) then ic.ca_costosplus_r else 0 end) as ca_utilidad_r from tb_inomaestra_sea im
			LEFT OUTER JOIN (select ca_referencia, sum(ca_volumen) as ca_volumen_r from tb_inoclientes_sea group by ca_referencia) iv on (im.ca_referencia = iv.ca_referencia)
			LEFT OUTER JOIN (select ca_referencia, sum(ca_valor) as ca_facturacion_r from tb_inoingresos_sea group by ca_referencia) ii on (im.ca_referencia = ii.ca_referencia)
			LEFT OUTER JOIN (select ca_referencia, sum(ca_valor) as ca_deduccion_r from tb_inodeduccion_sea group by ca_referencia) id on (im.ca_referencia = id.ca_referencia)
			LEFT OUTER JOIN (select ca_referencia, sum(ca_venta) as ca_costosplus_r from tb_inocostos_sea group by ca_referencia) ic on (im.ca_referencia = ic.ca_referencia)
		) iu ON (ic.ca_referencia = iu.ca_referencia)
		LEFT OUTER JOIN (
			select im.ca_referencia, sum(round(cp.ca_liminferior/20,0)) as ca_teus from tb_inomaestra_sea im, tb_inoequipos_sea ie, tb_conceptos cp
			where im.ca_referencia = ie.ca_referencia and ie.ca_idconcepto = cp.ca_idconcepto and im.ca_modalidad = cp.ca_modalidad and im.ca_modalidad = 'FCL'
			group by im.ca_referencia
		) ie ON (ic.ca_referencia = ie.ca_referencia)
		LEFT OUTER JOIN (
			select iu.ca_referencia, iu.ca_idcliente, iu.ca_hbls, sum(ic.ca_venta-(ic.ca_tcambio*ic.ca_neto)) as ca_sobreventa from tb_inoutilidad_sea iu
			LEFT OUTER JOIN tb_inocostos_sea ic ON (iu.ca_referencia = ic.ca_referencia and iu.ca_idcosto = ic.ca_idcosto and iu.ca_factura = ic.ca_factura)
			group by iu.ca_referencia, iu.ca_idcliente, iu.ca_hbls
		) iv ON (ic.ca_referencia = iv.ca_referencia and ic.ca_idcliente = iv.ca_idcliente and ic.ca_hbls = iv.ca_hbls)
		LEFT OUTER JOIN tb_inomaestra_sea im ON (ic.ca_referencia = im.ca_referencia)
		LEFT OUTER JOIN tb_clientes cl ON (ic.ca_idcliente = cl.ca_idcliente)
		LEFT OUTER JOIN tb_ciudades co ON (im.ca_origen = co.ca_idciudad)
		LEFT OUTER JOIN tb_ciudades cd ON (im.ca_destino = cd.ca_idciudad)
		LEFT OUTER JOIN tb_traficos tr ON (co.ca_idtrafico = tr.ca_idtrafico)
		LEFT OUTER JOIN tb_transporlineas nv ON (im.ca_idlinea = nv.ca_idlinea)
		LEFT OUTER JOIN control.tb_usuarios us ON (ic.ca_login = us.ca_login)
		order by ca_referencia;
REVOKE ALL ON vi_repgerencia_sea FROM PUBLIC;
GRANT ALL ON vi_repgerencia_sea TO "Administrador";
GRANT ALL ON vi_repgerencia_sea TO GROUP "Usuarios";
<<<<<<< .mine
<<<<<<< .mine

=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*

create table bk_reportes as select * from tb_reportes;
drop table tb_reportes cascade;

CREATE TABLE tb_reportes
( ca_idreporte integer NOT NULL DEFAULT nextval('tb_reportes_id'::regclass)
, ca_fchreporte date NOT NULL
, ca_consecutivo character varying(10) NOT NULL
, ca_version smallint NOT NULL DEFAULT 1
, ca_idcotizacion numeric(8)
, ca_origen character varying(8) NOT NULL
, ca_destino character varying(8) NOT NULL
, ca_impoexpo text NOT NULL
, ca_fchdespacho date NOT NULL
, ca_idagente numeric(9)
, ca_incoterms character varying(250) NOT NULL
, ca_mercancia_desc text NOT NULL
, ca_idproveedor character varying(255) NOT NULL
, ca_orden_prov character varying(255) NOT NULL
, ca_idconcliente smallint NOT NULL
, ca_orden_clie character varying(255) NOT NULL
, ca_confirmar_clie text NOT NULL
, ca_idrepresentante numeric(9) NOT NULL
, ca_informar_repr character varying(2) NOT NULL
, ca_idconsignatario numeric(9) NOT NULL
, ca_informar_cons character varying(2) NOT NULL
, ca_idnotify numeric(9) NOT NULL
, ca_informar_noti character varying(2) NOT NULL
, ca_idmaster numeric(9) NOT NULL
, ca_informar_mast varchar (2) NOT NULL
, ca_notify numeric(1) NOT NULL
, ca_transporte character varying(30) NOT NULL
, ca_modalidad character varying(12) NOT NULL
, ca_colmas character varying(2) NOT NULL
, ca_seguro character varying(2) NOT NULL
, ca_liberacion character varying(2) NOT NULL
, ca_tiempocredito character varying(20) NOT NULL
, ca_preferencias_clie text NOT NULL
, ca_instrucciones text NOT NULL
, ca_idlinea smallint NOT NULL
, ca_idconsignar smallint NOT NULL
, ca_idbodega smallint
, ca_mastersame character varying(2) NOT NULL
, ca_continuacion character varying(10) NOT NULL
, ca_continuacion_dest character varying(8)
, ca_continuacion_conf character varying(250)
, ca_etapa_actual character varying(50) DEFAULT ''::character varying
, ca_login character varying(15) NOT NULL
, ca_idconsignarmaster smallint
, ca_propiedades character varying(100) -- propiedades propias del usuario definidas en CU059
, ca_fchcreado timestamp without time zone NOT NULL
, ca_usucreado character varying(20)
, ca_fchactualizado timestamp without time zone
, ca_usuactualizado character varying(20)
, ca_fchanulado timestamp without time zone
, ca_usuanulado character varying(20)
, ca_fchcerrado timestamp without time zone
, ca_usucerrado character varying(20)
, CONSTRAINT pk_tb_reportes PRIMARY KEY (ca_idreporte)
, CONSTRAINT fk_tb_concliente FOREIGN KEY (ca_idconcliente)
      REFERENCES tb_concliente (ca_idcontacto) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
, CONSTRAINT fk_tb_reportes_d FOREIGN KEY (ca_destino)
      REFERENCES tb_ciudades (ca_idciudad) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
, CONSTRAINT fk_tb_reportes_o FOREIGN KEY (ca_origen)
      REFERENCES tb_ciudades (ca_idciudad) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
, CONSTRAINT fk_tb_reportes_tb_usuarios FOREIGN KEY (ca_login)
      REFERENCES control.tb_usuarios (ca_login) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
, CONSTRAINT tb_reportes_ca_idbodega_fkey FOREIGN KEY (ca_idbodega)
      REFERENCES tb_bodegas (ca_idbodega) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
, CONSTRAINT tb_reportes_ca_idconsignar_fkey FOREIGN KEY (ca_idconsignar)
      REFERENCES tb_bodegas (ca_idbodega) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
, CONSTRAINT uq_tb_reportes UNIQUE (ca_consecutivo, ca_version)
, CONSTRAINT chk_fchdespacho CHECK (ca_fchdespacho >= '2005-12-31'::date AND ca_fchdespacho <= '2020-12-31'::date)
, CONSTRAINT chk_impoexpo CHECK (ca_impoexpo = 'Importación'::text OR ca_impoexpo = 'Exportación'::text OR ca_impoexpo = 'Triangulación'::text)
, CONSTRAINT chk_transporte CHECK (ca_transporte::text = 'Marítimo'::text OR ca_transporte::text = 'Aéreo'::text OR ca_transporte::text = 'Terrestre'::text)
)
WITH (OIDS=FALSE);
ALTER TABLE tb_reportes OWNER TO "Administrador";
GRANT ALL ON TABLE tb_reportes TO "Administrador";
GRANT ALL ON TABLE tb_reportes TO "Usuarios";
COMMENT ON COLUMN tb_reportes.ca_propiedades IS 'propiedades propias del usuario definidas en CU059';


insert into tb_reportes 
select ca_idreporte, ca_fchreporte, ca_consecutivo, ca_version, ca_idcotizacion, ca_origen, ca_destino, ca_impoexpo, ca_fchdespacho, ca_idagente,
	ca_incoterms, ca_mercancia_desc, ca_idproveedor, ca_orden_prov, ca_idconcliente, ca_orden_clie, ca_confirmar_clie, ca_idrepresentante, ca_informar_repr, ca_idconsignatario,
	ca_informar_cons, ca_idnotify, ca_informar_noti, 0 as ca_idmaster, '' as ca_informar_mast, ca_notify, ca_transporte, ca_modalidad, ca_colmas, ca_seguro, ca_liberacion, ca_tiempocredito,
	ca_preferencias_clie, ca_instrucciones, ca_idlinea, ca_idconsignar, ca_idbodega, ca_mastersame, ca_continuacion, ca_continuacion_dest, ca_continuacion_conf, ca_etapa_actual,
	ca_login, ca_idconsignarmaster, ca_propiedades, ca_fchcreado, ca_usucreado, ca_fchactualizado, ca_usuactualizado, ca_fchanulado, ca_usuanulado, ca_fchcerrado, ca_usucerrado
from bk_reportes;


Drop view vi_reportes cascade;
Create view vi_reportes as
select r.ca_idreporte, r.ca_version, (select max(rr.ca_version) from tb_reportes rr where r.ca_consecutivo = rr.ca_consecutivo) as ca_versiones, r.ca_fchreporte, r.ca_consecutivo, r.ca_idcotizacion, r.ca_origen, c1.ca_ciudad as ca_ciuorigen, t1.ca_idtrafico as ca_idtraorigen, t1.ca_nombre as ca_traorigen, r.ca_destino, c2.ca_ciudad as ca_ciudestino, t2.ca_idtrafico as ca_idtradestino, t2.ca_nombre as ca_tradestino,
       r.ca_impoexpo, r.ca_fchdespacho, r.ca_idagente, a.ca_nombre as ca_agente, r.ca_incoterms, r.ca_mercancia_desc, r.ca_idproveedor, r.ca_orden_prov, r.ca_idconcliente, r.ca_orden_clie, r.ca_confirmar_clie, r.ca_idconsignatario, r.ca_informar_cons, r.ca_idnotify, r.ca_informar_noti, r.ca_idmaster, r.ca_informar_mast, r.ca_notify, r.ca_idrepresentante, r.ca_informar_repr, r.ca_transporte, r.ca_modalidad, r.ca_colmas, r.ca_seguro, r.ca_liberacion,
       r.ca_tiempocredito, r.ca_preferencias_clie, r.ca_instrucciones, r.ca_idconsignar, b1.ca_nombre as ca_consignar, r.ca_idbodega, b2.ca_nombre as ca_bodega, b2.ca_tipo as ca_tipobodega, r.ca_mastersame, r.ca_continuacion, r.ca_continuacion_dest, c3.ca_ciudad as ca_final_dest, r.ca_continuacion_conf, r.ca_etapa_actual, r.ca_idlinea, l.ca_nombre, r.ca_propiedades, r.ca_fchcreado, r.ca_usucreado, r.ca_fchactualizado, r.ca_usuactualizado, r.ca_fchanulado, r.ca_usuanulado, r.ca_fchcerrado, r.ca_usucerrado,
       tr1.ca_nombre as ca_nombre_pro, tr1.ca_contacto as ca_contacto_pro, tr1.ca_direccion as ca_direccion_pro, tr1.ca_telefonos as ca_telefonos_pro, tr1.ca_fax as ca_fax_pro, tr1.ca_email as ca_email_pro,
       tr2.ca_compania as ca_nombre_cli, tr2.ca_idcliente, tr2.ca_digito, tr2.ca_ncompleto_cn as ca_contacto_cli, tr2.ca_telefonos as ca_telefonos_cli, tr2.ca_fax as ca_fax_cli, tr2.ca_email as ca_email_cli,
       replace(tr2.ca_direccion_cl,'|',' ')|| case when tr2.ca_oficina <> '' then ' Of. '||tr2.ca_oficina else '' end|| case when tr2.ca_torre <> '' then ' Torre '||tr2.ca_torre else '' end|| case when tr2.ca_bloque <> '' then ' Bl. '||tr2.ca_bloque else '' end|| case when tr2.ca_interior <> '' then ' Int. '||tr2.ca_interior else '' end|| case when tr2.ca_complemento <> '' then ' '||tr2.ca_complemento else '' end ||' '|| tr2.ca_ciudad as ca_direccion_cli,
       tr3.ca_nombre as ca_nombre_rep, tr3.ca_contacto as ca_contacto_rep, tr3.ca_direccion||' '|| tr3.ca_ciudad as ca_direccion_rep, tr3.ca_telefonos as ca_telefonos_rep, tr3.ca_fax as ca_fax_rep, tr3.ca_email as ca_email_rep,
       tr4.ca_nombre as ca_nombre_con, tr4.ca_identificacion as ca_identificacion_con, tr4.ca_contacto as ca_contacto_con, tr4.ca_direccion||' '|| tr4.ca_ciudad as ca_direccion_con, tr4.ca_telefonos as ca_telefonos_con, tr4.ca_fax as ca_fax_con, tr4.ca_email as ca_email_con,
       tr5.ca_nombre as ca_nombre_not, tr5.ca_contacto as ca_contacto_not, tr5.ca_direccion||' '|| tr5.ca_ciudad as ca_direccion_not, tr5.ca_telefonos as ca_telefonos_not, tr5.ca_fax as ca_fax_not, tr5.ca_email as ca_email_not,
       tr6.ca_nombre as ca_nombre_mas, tr6.ca_contacto as ca_contacto_mas, tr6.ca_direccion||' '|| tr6.ca_ciudad as ca_direccion_mas, tr6.ca_telefonos as ca_telefonos_mas, tr6.ca_fax as ca_fax_mas, tr6.ca_email as ca_email_mas,
       s.ca_vlrasegurado, s.ca_idmoneda_vlr, s.ca_primaventa, s.ca_minimaventa, s.ca_idmoneda_vta, s.ca_obtencionpoliza, s.ca_idmoneda_pol, s.ca_seguro_conf, ra.ca_idrepaduana, ra.ca_coordinador, u2.ca_nombre as ca_namecoordinador, u2.ca_email as ca_aduana_conf, ra.ca_transnacarga, ra.ca_transnatipo, ra.ca_instrucciones as ca_instrucciones_ad, r.ca_login, u.ca_nombre as ca_vendedor, u.ca_sucursal
       from tb_reportes r 
	   LEFT OUTER JOIN tb_transporlineas l ON (r.ca_idlinea = l.ca_idlinea) 
	   LEFT OUTER JOIN tb_terceros tr1 ON (tr1.ca_idtercero::text IN (array_to_string(string_to_array(r.ca_idproveedor,'|'),','))) 
	   LEFT OUTER JOIN (Select cl.ca_compania, cl.ca_idcliente, cl.ca_digito, cn.ca_idcontacto, cn.ca_nombres ||' '|| cn.ca_papellido ||' '|| cn.ca_sapellido as ca_ncompleto_cn, cn.ca_telefonos, cn.ca_fax, cn.ca_email, cl.ca_direccion as ca_direccion_cl, cl.ca_oficina, cl.ca_torre, cl.ca_bloque, cl.ca_interior, cl.ca_complemento, cd.ca_ciudad
       from tb_clientes cl LEFT OUTER JOIN tb_concliente cn ON (cn.ca_idcliente = cl.ca_idcliente) LEFT OUTER JOIN tb_libcliente ca ON (ca.ca_idcliente = cl.ca_idcliente) JOIN tb_ciudades cd ON (cl.ca_idciudad = cd.ca_idciudad)) tr2 ON (r.ca_idconcliente = tr2.ca_idcontacto)
	   LEFT OUTER JOIN (Select t.ca_idtercero, t.ca_nombre, t.ca_contacto, t.ca_direccion, t.ca_telefonos, t.ca_fax, t.ca_email, t.ca_vendedor, t.ca_tipo, t.ca_idciudad, cd.ca_ciudad, cd.ca_idtrafico, tr.ca_nombre as ca_nomtrafico from tb_terceros t, tb_ciudades cd, tb_traficos tr where t.ca_idciudad = cd.ca_idciudad and cd.ca_idtrafico = tr.ca_idtrafico order by t.ca_nombre, t.ca_contacto) tr3 ON (r.ca_idrepresentante = tr3.ca_idtercero)
	   LEFT OUTER JOIN (Select t.ca_idtercero, t.ca_nombre, t.ca_identificacion, t.ca_contacto, t.ca_direccion, t.ca_telefonos, t.ca_fax, t.ca_email, t.ca_vendedor, t.ca_tipo, t.ca_idciudad, cd.ca_ciudad, cd.ca_idtrafico, tr.ca_nombre as ca_nomtrafico from tb_terceros t, tb_ciudades cd, tb_traficos tr where t.ca_idciudad = cd.ca_idciudad and cd.ca_idtrafico = tr.ca_idtrafico order by t.ca_nombre, t.ca_contacto) tr4 ON (r.ca_idconsignatario = tr4.ca_idtercero)
	   LEFT OUTER JOIN (Select t.ca_idtercero, t.ca_nombre, t.ca_contacto, t.ca_direccion, t.ca_telefonos, t.ca_fax, t.ca_email, t.ca_vendedor, t.ca_tipo, t.ca_idciudad, cd.ca_ciudad, cd.ca_idtrafico, tr.ca_nombre as ca_nomtrafico from tb_terceros t, tb_ciudades cd, tb_traficos tr where t.ca_idciudad = cd.ca_idciudad and cd.ca_idtrafico = tr.ca_idtrafico order by t.ca_nombre, t.ca_contacto) tr5 ON (r.ca_idnotify = tr5.ca_idtercero)
	   LEFT OUTER JOIN (Select t.ca_idtercero, t.ca_nombre, t.ca_contacto, t.ca_direccion, t.ca_telefonos, t.ca_fax, t.ca_email, t.ca_vendedor, t.ca_tipo, t.ca_idciudad, cd.ca_ciudad, cd.ca_idtrafico, tr.ca_nombre as ca_nomtrafico from tb_terceros t, tb_ciudades cd, tb_traficos tr where t.ca_idciudad = cd.ca_idciudad and cd.ca_idtrafico = tr.ca_idtrafico order by t.ca_nombre, t.ca_contacto) tr6 ON (r.ca_idmaster = tr6.ca_idtercero)
	   LEFT OUTER JOIN tb_repseguro s ON (r.ca_idreporte = s.ca_idreporte)
	   LEFT OUTER JOIN tb_repaduana ra ON (r.ca_idreporte = ra.ca_idreporte)
	   LEFT OUTER JOIN control.tb_usuarios u2 ON (ra.ca_coordinador = u2.ca_login), 
	   tb_agentes a, tb_ciudades c1, tb_ciudades c2, tb_ciudades c3, tb_traficos t1, tb_traficos t2, tb_bodegas b1, tb_bodegas b2, control.tb_usuarios u 
	   where r.ca_idagente = a.ca_idagente and r.ca_origen = c1.ca_idciudad and r.ca_destino = c2.ca_idciudad and r.ca_continuacion_dest = c3.ca_idciudad and c1.ca_idtrafico = t1.ca_idtrafico and c2.ca_idtrafico = t2.ca_idtrafico and r.ca_idconsignar = b1.ca_idbodega and r.ca_idbodega = b2.ca_idbodega and r.ca_login = u.ca_login and nullvalue(r.ca_usuanulado)
	   order by EXTRACT ('year' from ca_fchreporte) DESC, to_number(substr(ca_consecutivo,0,position('-' in ca_consecutivo)),'99999999') DESC, ca_version DESC;
REVOKE ALL ON vi_reportes FROM PUBLIC;
GRANT ALL ON vi_reportes TO "Administrador";
GRANT ALL ON vi_reportes TO GROUP "Usuarios";

Drop view vi_reptarifas;
Create view vi_reptarifas as
select r.oid as ca_oid, r.ca_idreporte, r.ca_idconcepto, c.ca_concepto, r.ca_cantidad, r.ca_neta_tar, r.ca_neta_min, r.ca_neta_idm, r.ca_reportar_tar, r.ca_reportar_min, r.ca_reportar_idm, r.ca_cobrar_tar, r.ca_cobrar_min, r.ca_cobrar_idm, r.ca_observaciones
       from tb_reptarifas r
       LEFT OUTER JOIN tb_conceptos c ON (r.ca_idconcepto = c.ca_idconcepto)
       order by r.ca_idreporte, c.ca_liminferior, c.ca_concepto desc;
REVOKE ALL ON vi_reptarifas FROM PUBLIC;
GRANT ALL ON vi_reptarifas TO "Administrador";
GRANT ALL ON vi_reptarifas TO GROUP "Usuarios";



alter table tb_agentes add column ca_fchcreado timestamp;
alter table tb_agentes add column ca_usucreado varchar (20);
alter table tb_agentes add column ca_fchactualizado timestamp;
alter table tb_agentes add column ca_usuactualizado varchar (20);


alter table tb_contactos add column ca_fchcreado timestamp;
alter table tb_contactos add column ca_usucreado varchar (20);
alter table tb_contactos add column ca_fchactualizado timestamp;
alter table tb_contactos add column ca_usuactualizado varchar (20);


alter table tb_agentes 
	rename column ca_divulgacion to ca_tipo;

update tb_agentes set ca_tipo = 'Oficial' where ca_tipo = 'Pública';
update tb_agentes set ca_tipo = 'No Oficial' where ca_tipo = 'Privada';
	
Drop view vi_agentes;
Create view vi_agentes as
Select a.ca_idagente, a.ca_nombre, a.ca_direccion, a.ca_telefonos, a.ca_fax, a.ca_website, a.ca_email, a.ca_idciudad, c.ca_ciudad, a.ca_zipcode, a.ca_tipo, c.ca_idtrafico,
       t.ca_nombre as ca_nomtrafico from tb_agentes a, tb_ciudades c, tb_traficos t where a.ca_idciudad = c.ca_idciudad and c.ca_idtrafico = t.ca_idtrafico
       order by a.ca_nombre, ca_nomtrafico, ca_ciudad;
REVOKE ALL ON vi_agentes FROM PUBLIC;
GRANT ALL ON vi_agentes TO "Administrador";
GRANT ALL ON vi_agentes TO GROUP "Usuarios";

Drop view vi_agentesxcont;
Create view vi_agentesxcont as
Select a.ca_idagente, a.ca_nombre as ca_nombre_ag, a.ca_direccion as ca_direccion_ag, a.ca_telefonos as ca_telefonos_ag, a.ca_fax as ca_fax_ag, a.ca_website, a.ca_email as ca_email_ag, a.ca_idciudad as ca_idciudad_ag, c1.ca_ciudad as ca_ciudad_ag, a.ca_zipcode, a.ca_tipo, c1.ca_idtrafico as ca_idtrafico_ag, t1.ca_nombre as ca_nomtrafico_ag,
       c.ca_idcontacto, c.ca_nombre as ca_nombre_co, c.ca_direccion as ca_direccion_co, c.ca_telefonos as ca_telefonos_co, c.ca_fax as ca_fax_co, c.ca_email as ca_email_co, c.ca_cargo, c.ca_detalle, c.ca_idciudad as ca_idciudad_co, c2.ca_ciudad as ca_ciudad_co, c2.ca_idtrafico as ca_idtrafico_co, t2.ca_nombre as ca_nomtrafico_co, c.ca_impoexpo, c.ca_transporte
       from tb_agentes a LEFT OUTER JOIN tb_contactos c ON (a.ca_idagente = c.ca_idagente)
       JOIN tb_ciudades c1 ON (a.ca_idciudad = c1.ca_idciudad)
       LEFT OUTER JOIN tb_ciudades c2 ON (c.ca_idciudad = c2.ca_idciudad)
       LEFT OUTER JOIN tb_traficos t1 ON (c1.ca_idtrafico = t1.ca_idtrafico)
       LEFT OUTER JOIN tb_traficos t2 ON (c2.ca_idtrafico = t2.ca_idtrafico)
       order by a.ca_nombre, ca_nomtrafico_co, ca_ciudad_co, c.ca_nombre;
REVOKE ALL ON vi_agentesxcont FROM PUBLIC;
GRANT ALL ON vi_agentesxcont TO "Administrador";
GRANT ALL ON vi_agentesxcont TO GROUP "Usuarios";	
=======
>>>>>>> .r95
=======

=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*

create table bk_reportes as select * from tb_reportes;
drop table tb_reportes cascade;

CREATE TABLE tb_reportes
( ca_idreporte integer NOT NULL DEFAULT nextval('tb_reportes_id'::regclass)
, ca_fchreporte date NOT NULL
, ca_consecutivo character varying(10) NOT NULL
, ca_version smallint NOT NULL DEFAULT 1
, ca_idcotizacion numeric(8)
, ca_origen character varying(8) NOT NULL
, ca_destino character varying(8) NOT NULL
, ca_impoexpo text NOT NULL
, ca_fchdespacho date NOT NULL
, ca_idagente numeric(9)
, ca_incoterms character varying(250) NOT NULL
, ca_mercancia_desc text NOT NULL
, ca_idproveedor character varying(255) NOT NULL
, ca_orden_prov character varying(255) NOT NULL
, ca_idconcliente smallint NOT NULL
, ca_orden_clie character varying(255) NOT NULL
, ca_confirmar_clie text NOT NULL
, ca_idrepresentante numeric(9) NOT NULL
, ca_informar_repr character varying(2) NOT NULL
, ca_idconsignatario numeric(9) NOT NULL
, ca_informar_cons character varying(2) NOT NULL
, ca_idnotify numeric(9) NOT NULL
, ca_informar_noti character varying(2) NOT NULL
, ca_idmaster numeric(9) NOT NULL
, ca_informar_mast varchar (2) NOT NULL
, ca_notify numeric(1) NOT NULL
, ca_transporte character varying(30) NOT NULL
, ca_modalidad character varying(12) NOT NULL
, ca_colmas character varying(2) NOT NULL
, ca_seguro character varying(2) NOT NULL
, ca_liberacion character varying(2) NOT NULL
, ca_tiempocredito character varying(20) NOT NULL
, ca_preferencias_clie text NOT NULL
, ca_instrucciones text NOT NULL
, ca_idlinea smallint NOT NULL
, ca_idconsignar smallint NOT NULL
, ca_idbodega smallint
, ca_mastersame character varying(2) NOT NULL
, ca_continuacion character varying(10) NOT NULL
, ca_continuacion_dest character varying(8)
, ca_continuacion_conf character varying(250)
, ca_etapa_actual character varying(50) DEFAULT ''::character varying
, ca_login character varying(15) NOT NULL
, ca_idconsignarmaster smallint
, ca_propiedades character varying(100) -- propiedades propias del usuario definidas en CU059
, ca_fchcreado timestamp without time zone NOT NULL
, ca_usucreado character varying(20)
, ca_fchactualizado timestamp without time zone
, ca_usuactualizado character varying(20)
, ca_fchanulado timestamp without time zone
, ca_usuanulado character varying(20)
, ca_fchcerrado timestamp without time zone
, ca_usucerrado character varying(20)
, CONSTRAINT pk_tb_reportes PRIMARY KEY (ca_idreporte)
, CONSTRAINT fk_tb_concliente FOREIGN KEY (ca_idconcliente)
      REFERENCES tb_concliente (ca_idcontacto) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
, CONSTRAINT fk_tb_reportes_d FOREIGN KEY (ca_destino)
      REFERENCES tb_ciudades (ca_idciudad) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
, CONSTRAINT fk_tb_reportes_o FOREIGN KEY (ca_origen)
      REFERENCES tb_ciudades (ca_idciudad) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
, CONSTRAINT fk_tb_reportes_tb_usuarios FOREIGN KEY (ca_login)
      REFERENCES control.tb_usuarios (ca_login) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
, CONSTRAINT tb_reportes_ca_idbodega_fkey FOREIGN KEY (ca_idbodega)
      REFERENCES tb_bodegas (ca_idbodega) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
, CONSTRAINT tb_reportes_ca_idconsignar_fkey FOREIGN KEY (ca_idconsignar)
      REFERENCES tb_bodegas (ca_idbodega) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
, CONSTRAINT uq_tb_reportes UNIQUE (ca_consecutivo, ca_version)
, CONSTRAINT chk_fchdespacho CHECK (ca_fchdespacho >= '2005-12-31'::date AND ca_fchdespacho <= '2020-12-31'::date)
, CONSTRAINT chk_impoexpo CHECK (ca_impoexpo = 'Importación'::text OR ca_impoexpo = 'Exportación'::text OR ca_impoexpo = 'Triangulación'::text)
, CONSTRAINT chk_transporte CHECK (ca_transporte::text = 'Marítimo'::text OR ca_transporte::text = 'Aéreo'::text OR ca_transporte::text = 'Terrestre'::text)
)
WITH (OIDS=FALSE);
ALTER TABLE tb_reportes OWNER TO "Administrador";
GRANT ALL ON TABLE tb_reportes TO "Administrador";
GRANT ALL ON TABLE tb_reportes TO "Usuarios";
COMMENT ON COLUMN tb_reportes.ca_propiedades IS 'propiedades propias del usuario definidas en CU059';


insert into tb_reportes 
select ca_idreporte, ca_fchreporte, ca_consecutivo, ca_version, ca_idcotizacion, ca_origen, ca_destino, ca_impoexpo, ca_fchdespacho, ca_idagente,
	ca_incoterms, ca_mercancia_desc, ca_idproveedor, ca_orden_prov, ca_idconcliente, ca_orden_clie, ca_confirmar_clie, ca_idrepresentante, ca_informar_repr, ca_idconsignatario,
	ca_informar_cons, ca_idnotify, ca_informar_noti, 0 as ca_idmaster, '' as ca_informar_mast, ca_notify, ca_transporte, ca_modalidad, ca_colmas, ca_seguro, ca_liberacion, ca_tiempocredito,
	ca_preferencias_clie, ca_instrucciones, ca_idlinea, ca_idconsignar, ca_idbodega, ca_mastersame, ca_continuacion, ca_continuacion_dest, ca_continuacion_conf, ca_etapa_actual,
	ca_login, ca_idconsignarmaster, ca_propiedades, ca_fchcreado, ca_usucreado, ca_fchactualizado, ca_usuactualizado, ca_fchanulado, ca_usuanulado, ca_fchcerrado, ca_usucerrado
from bk_reportes;


Drop view vi_reportes cascade;
Create view vi_reportes as
select r.ca_idreporte, r.ca_version, (select max(rr.ca_version) from tb_reportes rr where r.ca_consecutivo = rr.ca_consecutivo) as ca_versiones, r.ca_fchreporte, r.ca_consecutivo, r.ca_idcotizacion, r.ca_origen, c1.ca_ciudad as ca_ciuorigen, t1.ca_idtrafico as ca_idtraorigen, t1.ca_nombre as ca_traorigen, r.ca_destino, c2.ca_ciudad as ca_ciudestino, t2.ca_idtrafico as ca_idtradestino, t2.ca_nombre as ca_tradestino,
       r.ca_impoexpo, r.ca_fchdespacho, r.ca_idagente, a.ca_nombre as ca_agente, r.ca_incoterms, r.ca_mercancia_desc, r.ca_idproveedor, r.ca_orden_prov, r.ca_idconcliente, r.ca_orden_clie, r.ca_confirmar_clie, r.ca_idconsignatario, r.ca_informar_cons, r.ca_idnotify, r.ca_informar_noti, r.ca_idmaster, r.ca_informar_mast, r.ca_notify, r.ca_idrepresentante, r.ca_informar_repr, r.ca_transporte, r.ca_modalidad, r.ca_colmas, r.ca_seguro, r.ca_liberacion,
       r.ca_tiempocredito, r.ca_preferencias_clie, r.ca_instrucciones, r.ca_idconsignar, b1.ca_nombre as ca_consignar, r.ca_idbodega, b2.ca_nombre as ca_bodega, b2.ca_tipo as ca_tipobodega, r.ca_mastersame, r.ca_continuacion, r.ca_continuacion_dest, c3.ca_ciudad as ca_final_dest, r.ca_continuacion_conf, r.ca_etapa_actual, r.ca_idlinea, l.ca_nombre, r.ca_propiedades, r.ca_fchcreado, r.ca_usucreado, r.ca_fchactualizado, r.ca_usuactualizado, r.ca_fchanulado, r.ca_usuanulado, r.ca_fchcerrado, r.ca_usucerrado,
       tr1.ca_nombre as ca_nombre_pro, tr1.ca_contacto as ca_contacto_pro, tr1.ca_direccion as ca_direccion_pro, tr1.ca_telefonos as ca_telefonos_pro, tr1.ca_fax as ca_fax_pro, tr1.ca_email as ca_email_pro,
       tr2.ca_compania as ca_nombre_cli, tr2.ca_idcliente, tr2.ca_digito, tr2.ca_ncompleto_cn as ca_contacto_cli, tr2.ca_telefonos as ca_telefonos_cli, tr2.ca_fax as ca_fax_cli, tr2.ca_email as ca_email_cli,
       replace(tr2.ca_direccion_cl,'|',' ')|| case when tr2.ca_oficina <> '' then ' Of. '||tr2.ca_oficina else '' end|| case when tr2.ca_torre <> '' then ' Torre '||tr2.ca_torre else '' end|| case when tr2.ca_bloque <> '' then ' Bl. '||tr2.ca_bloque else '' end|| case when tr2.ca_interior <> '' then ' Int. '||tr2.ca_interior else '' end|| case when tr2.ca_complemento <> '' then ' '||tr2.ca_complemento else '' end ||' '|| tr2.ca_ciudad as ca_direccion_cli,
       tr3.ca_nombre as ca_nombre_rep, tr3.ca_contacto as ca_contacto_rep, tr3.ca_direccion||' '|| tr3.ca_ciudad as ca_direccion_rep, tr3.ca_telefonos as ca_telefonos_rep, tr3.ca_fax as ca_fax_rep, tr3.ca_email as ca_email_rep,
       tr4.ca_nombre as ca_nombre_con, tr4.ca_identificacion as ca_identificacion_con, tr4.ca_contacto as ca_contacto_con, tr4.ca_direccion||' '|| tr4.ca_ciudad as ca_direccion_con, tr4.ca_telefonos as ca_telefonos_con, tr4.ca_fax as ca_fax_con, tr4.ca_email as ca_email_con,
       tr5.ca_nombre as ca_nombre_not, tr5.ca_contacto as ca_contacto_not, tr5.ca_direccion||' '|| tr5.ca_ciudad as ca_direccion_not, tr5.ca_telefonos as ca_telefonos_not, tr5.ca_fax as ca_fax_not, tr5.ca_email as ca_email_not,
       tr6.ca_nombre as ca_nombre_mas, tr6.ca_contacto as ca_contacto_mas, tr6.ca_direccion||' '|| tr6.ca_ciudad as ca_direccion_mas, tr6.ca_telefonos as ca_telefonos_mas, tr6.ca_fax as ca_fax_mas, tr6.ca_email as ca_email_mas,
       s.ca_vlrasegurado, s.ca_idmoneda_vlr, s.ca_primaventa, s.ca_minimaventa, s.ca_idmoneda_vta, s.ca_obtencionpoliza, s.ca_idmoneda_pol, s.ca_seguro_conf, ra.ca_idrepaduana, ra.ca_coordinador, u2.ca_nombre as ca_namecoordinador, u2.ca_email as ca_aduana_conf, ra.ca_transnacarga, ra.ca_transnatipo, ra.ca_instrucciones as ca_instrucciones_ad, r.ca_login, u.ca_nombre as ca_vendedor, u.ca_sucursal
       from tb_reportes r 
	   LEFT OUTER JOIN tb_transporlineas l ON (r.ca_idlinea = l.ca_idlinea) 
	   LEFT OUTER JOIN tb_terceros tr1 ON (tr1.ca_idtercero::text IN (array_to_string(string_to_array(r.ca_idproveedor,'|'),','))) 
	   LEFT OUTER JOIN (Select cl.ca_compania, cl.ca_idcliente, cl.ca_digito, cn.ca_idcontacto, cn.ca_nombres ||' '|| cn.ca_papellido ||' '|| cn.ca_sapellido as ca_ncompleto_cn, cn.ca_telefonos, cn.ca_fax, cn.ca_email, cl.ca_direccion as ca_direccion_cl, cl.ca_oficina, cl.ca_torre, cl.ca_bloque, cl.ca_interior, cl.ca_complemento, cd.ca_ciudad
       from tb_clientes cl LEFT OUTER JOIN tb_concliente cn ON (cn.ca_idcliente = cl.ca_idcliente) LEFT OUTER JOIN tb_libcliente ca ON (ca.ca_idcliente = cl.ca_idcliente) JOIN tb_ciudades cd ON (cl.ca_idciudad = cd.ca_idciudad)) tr2 ON (r.ca_idconcliente = tr2.ca_idcontacto)
	   LEFT OUTER JOIN (Select t.ca_idtercero, t.ca_nombre, t.ca_contacto, t.ca_direccion, t.ca_telefonos, t.ca_fax, t.ca_email, t.ca_vendedor, t.ca_tipo, t.ca_idciudad, cd.ca_ciudad, cd.ca_idtrafico, tr.ca_nombre as ca_nomtrafico from tb_terceros t, tb_ciudades cd, tb_traficos tr where t.ca_idciudad = cd.ca_idciudad and cd.ca_idtrafico = tr.ca_idtrafico order by t.ca_nombre, t.ca_contacto) tr3 ON (r.ca_idrepresentante = tr3.ca_idtercero)
	   LEFT OUTER JOIN (Select t.ca_idtercero, t.ca_nombre, t.ca_identificacion, t.ca_contacto, t.ca_direccion, t.ca_telefonos, t.ca_fax, t.ca_email, t.ca_vendedor, t.ca_tipo, t.ca_idciudad, cd.ca_ciudad, cd.ca_idtrafico, tr.ca_nombre as ca_nomtrafico from tb_terceros t, tb_ciudades cd, tb_traficos tr where t.ca_idciudad = cd.ca_idciudad and cd.ca_idtrafico = tr.ca_idtrafico order by t.ca_nombre, t.ca_contacto) tr4 ON (r.ca_idconsignatario = tr4.ca_idtercero)
	   LEFT OUTER JOIN (Select t.ca_idtercero, t.ca_nombre, t.ca_contacto, t.ca_direccion, t.ca_telefonos, t.ca_fax, t.ca_email, t.ca_vendedor, t.ca_tipo, t.ca_idciudad, cd.ca_ciudad, cd.ca_idtrafico, tr.ca_nombre as ca_nomtrafico from tb_terceros t, tb_ciudades cd, tb_traficos tr where t.ca_idciudad = cd.ca_idciudad and cd.ca_idtrafico = tr.ca_idtrafico order by t.ca_nombre, t.ca_contacto) tr5 ON (r.ca_idnotify = tr5.ca_idtercero)
	   LEFT OUTER JOIN (Select t.ca_idtercero, t.ca_nombre, t.ca_contacto, t.ca_direccion, t.ca_telefonos, t.ca_fax, t.ca_email, t.ca_vendedor, t.ca_tipo, t.ca_idciudad, cd.ca_ciudad, cd.ca_idtrafico, tr.ca_nombre as ca_nomtrafico from tb_terceros t, tb_ciudades cd, tb_traficos tr where t.ca_idciudad = cd.ca_idciudad and cd.ca_idtrafico = tr.ca_idtrafico order by t.ca_nombre, t.ca_contacto) tr6 ON (r.ca_idmaster = tr6.ca_idtercero)
	   LEFT OUTER JOIN tb_repseguro s ON (r.ca_idreporte = s.ca_idreporte)
	   LEFT OUTER JOIN tb_repaduana ra ON (r.ca_idreporte = ra.ca_idreporte)
	   LEFT OUTER JOIN control.tb_usuarios u2 ON (ra.ca_coordinador = u2.ca_login), 
	   tb_agentes a, tb_ciudades c1, tb_ciudades c2, tb_ciudades c3, tb_traficos t1, tb_traficos t2, tb_bodegas b1, tb_bodegas b2, control.tb_usuarios u 
	   where r.ca_idagente = a.ca_idagente and r.ca_origen = c1.ca_idciudad and r.ca_destino = c2.ca_idciudad and r.ca_continuacion_dest = c3.ca_idciudad and c1.ca_idtrafico = t1.ca_idtrafico and c2.ca_idtrafico = t2.ca_idtrafico and r.ca_idconsignar = b1.ca_idbodega and r.ca_idbodega = b2.ca_idbodega and r.ca_login = u.ca_login and nullvalue(r.ca_usuanulado)
	   order by EXTRACT ('year' from ca_fchreporte) DESC, to_number(substr(ca_consecutivo,0,position('-' in ca_consecutivo)),'99999999') DESC, ca_version DESC;
REVOKE ALL ON vi_reportes FROM PUBLIC;
GRANT ALL ON vi_reportes TO "Administrador";
GRANT ALL ON vi_reportes TO GROUP "Usuarios";

Drop view vi_reptarifas;
Create view vi_reptarifas as
select r.oid as ca_oid, r.ca_idreporte, r.ca_idconcepto, c.ca_concepto, r.ca_cantidad, r.ca_neta_tar, r.ca_neta_min, r.ca_neta_idm, r.ca_reportar_tar, r.ca_reportar_min, r.ca_reportar_idm, r.ca_cobrar_tar, r.ca_cobrar_min, r.ca_cobrar_idm, r.ca_observaciones
       from tb_reptarifas r
       LEFT OUTER JOIN tb_conceptos c ON (r.ca_idconcepto = c.ca_idconcepto)
       order by r.ca_idreporte, c.ca_liminferior, c.ca_concepto desc;
REVOKE ALL ON vi_reptarifas FROM PUBLIC;
GRANT ALL ON vi_reptarifas TO "Administrador";
GRANT ALL ON vi_reptarifas TO GROUP "Usuarios";


alter table tb_inomaestra_sea add column ca_fchvaciado date;
alter table tb_inomaestra_sea add column ca_horavaciado time without time zone;

alter table tb_inomaestra_sea add column ca_usuoperacion character varying(20);

insert into tb_parametros values ('CU072',1,'Confirmación Salida de la Carga','');
insert into tb_parametros values ('CU072',2,'Tiempo de Tránsito','');
insert into tb_parametros values ('CU072',3,'Tiempo de Desconsolidación','');
insert into tb_parametros values ('CU072',4,'Emisión de Factura','');
insert into tb_parametros values ('CU072',5,'Información Oportuna','');
insert into tb_parametros values ('CU072',6,'Oportunidad en Entrega de Cotizaciones','');
insert into tb_parametros values ('CU072',7,'Confirmación de llegada','');
insert into tb_parametros values ('CU072',8,'Oportunidada de Primer Status','');
insert into tb_parametros values ('CU072',9,'Cumplimiento de Proveedores','');


// insert into tb_parametros values ('CU072',7,'Eficacia en Captación de Clientes','');


insert into tb_festivos values ('2009-01-01');
insert into tb_festivos values ('2009-01-12');
insert into tb_festivos values ('2009-03-23');
insert into tb_festivos values ('2009-04-09');
insert into tb_festivos values ('2009-04-10');
insert into tb_festivos values ('2009-05-01');
insert into tb_festivos values ('2009-05-25');
insert into tb_festivos values ('2009-06-15');
insert into tb_festivos values ('2009-06-22');
insert into tb_festivos values ('2009-06-29');
insert into tb_festivos values ('2009-07-20');
insert into tb_festivos values ('2009-08-07');
insert into tb_festivos values ('2009-08-17');
insert into tb_festivos values ('2009-10-12');
insert into tb_festivos values ('2009-11-02');
insert into tb_festivos values ('2009-11-16');
insert into tb_festivos values ('2009-12-08');
insert into tb_festivos values ('2009-12-25');


alter table tb_inoequipos_sea add column ca_numprecinto character varying(30);

alter table tb_inoclientes_sea add column ca_fchhbls date;
alter table tb_inoclientes_sea add column ca_contenedores text;


-- Cambiar la pantalla de consulta en todos los módulos
-- Crear la vista de inoequipos
-- Cambiar la vista de reportes para adicionar la ciudad de la Dir. del Cliente
--  NOTICE:  eliminando además vista vi_inomaestra_sea
--  NOTICE:  eliminando además vista vi_inotrafico_lcl
--  NOTICE:  eliminando además vista vi_inonaviera_fcl
--  NOTICE:  eliminando además vista vi_inotrafico_fcl


insert into tb_parametros values ('CU073',0,'Inicial','1');
insert into tb_parametros values ('CU073',0,'Corrección','2');
insert into tb_parametros values ('CU073',0,'Entrega Posterior por Contingencia - Inicial','3');
insert into tb_parametros values ('CU073',0,'Entrega Posterior por Contingencia - Corrección','4');

insert into tb_parametros values ('CU073',1,'Armenia','1');
insert into tb_parametros values ('CU073',1,'Barranquilla','87');
insert into tb_parametros values ('CU073',1,'Bogotá','3');
insert into tb_parametros values ('CU073',1,'Bucaramanga','4');
insert into tb_parametros values ('CU073',1,'Cali','88');
insert into tb_parametros values ('CU073',1,'Cartagena','48');
insert into tb_parametros values ('CU073',1,'Cúcuta','89');
insert into tb_parametros values ('CU073',1,'Manizales','10');
insert into tb_parametros values ('CU073',1,'Medellín','90');
insert into tb_parametros values ('CU073',1,'Pereira','16');
insert into tb_parametros values ('CU073',1,'Santa Marta','19');
insert into tb_parametros values ('CU073',1,'Riohacha','25');
insert into tb_parametros values ('CU073',1,'San Andrés','27');
insert into tb_parametros values ('CU073',1,'Arauca','34');
insert into tb_parametros values ('CU073',1,'Buenaventura','35');
insert into tb_parametros values ('CU073',1,'Cartago','36');
insert into tb_parametros values ('CU073',1,'Ipiales','37');
insert into tb_parametros values ('CU073',1,'Leticia','38');
insert into tb_parametros values ('CU073',1,'Maicao','39');
insert into tb_parametros values ('CU073',1,'Tumaco','40');
insert into tb_parametros values ('CU073',1,'Urabá','41');
insert into tb_parametros values ('CU073',1,'Puerto Carreño','42');
insert into tb_parametros values ('CU073',1,'Inírida','43');
insert into tb_parametros values ('CU073',1,'Yopal','44');
insert into tb_parametros values ('CU073',1,'Mitú','45');
insert into tb_parametros values ('CU073',1,'Puerto Asís','46');
insert into tb_parametros values ('CU073',1,'Valledupar','24');
insert into tb_parametros values ('CU073',1,'Pamplona','86');

insert into tb_parametros values ('CU073',2,'Ingreso Depósito','10');
insert into tb_parametros values ('CU073',2,'Ingreso Zona Franca','11');
insert into tb_parametros values ('CU073',2,'Continuación de Viaje','12');
insert into tb_parametros values ('CU073',2,'Transbordo Directo','13');
insert into tb_parametros values ('CU073',2,'Transbordo Indirecto','14');
insert into tb_parametros values ('CU073',2,'Tránsito Internacional','15');
insert into tb_parametros values ('CU073',2,'Tránsito Nacional','16');
insert into tb_parametros values ('CU073',2,'Cabotaje','17');
insert into tb_parametros values ('CU073',2,'Depósito Franco','18');
insert into tb_parametros values ('CU073',2,'Equipaje no Acompañado','19');
insert into tb_parametros values ('CU073',2,'Entrega Urgente','20');
insert into tb_parametros values ('CU073',2,'Entrega en Lugar de Arribo','21');
insert into tb_parametros values ('CU073',2,'Ingreso Directo a Depósito/Zona Franca','22');
insert into tb_parametros values ('CU073',2,'Transbordo de Salida','23');
insert into tb_parametros values ('CU073',2,'Cabotaje Especial','24');
insert into tb_parametros values ('CU073',2,'Equipaje acompañado ingresado como carga','25');

insert into tb_parametros values ('CU073',3,'Marítimo','1');
insert into tb_parametros values ('CU073',3,'Aéreo','4');

insert into tb_parametros values ('CU073',4,'Único','1');
insert into tb_parametros values ('CU073',4,'Multimodal','2');
insert into tb_parametros values ('CU073',4,'Combinado','3');

insert into tb_parametros values ('CU073',5,'FCL/FCL','1');
insert into tb_parametros values ('CU073',5,'FCL/LCL','2');
insert into tb_parametros values ('CU073',5,'LCL/FCL','3');
insert into tb_parametros values ('CU073',5,'LCL/LCL','4');

insert into tb_parametros values ('CU073',6,'Suelta','1');
insert into tb_parametros values ('CU073',6,'Contenedorizada','2');

insert into tb_parametros values ('CU073',7,'Máster Nivel 1','2');
insert into tb_parametros values ('CU073',7,'Hijo','3');
insert into tb_parametros values ('CU073',7,'Manifiesto Expreso','4');
insert into tb_parametros values ('CU073',7,'Declaración de Tránsito Aduanero Internacional','8');
insert into tb_parametros values ('CU073',7,'Máster Nivel 2','9');
insert into tb_parametros values ('CU073',7,'Documento Consolidador Nivel 1','10');
insert into tb_parametros values ('CU073',7,'Documento Consolidador Nivel 2','11');

insert into tb_parametros values ('CU073',8,'Barcaza o planchón','1');
insert into tb_parametros values ('CU073',8,'Contenedor','2');
insert into tb_parametros values ('CU073',8,'Furgon','3');
insert into tb_parametros values ('CU073',8,'Paleta','4');
insert into tb_parametros values ('CU073',8,'Remolque o semiremolque','5');
insert into tb_parametros values ('CU073',8,'Tanques','6');
insert into tb_parametros values ('CU073',8,'Vagones o plataformas de ferrocarril','7');
insert into tb_parametros values ('CU073',8,'Otros elementos similares','8');
insert into tb_parametros values ('CU073',8,'Por sus propios medios','9');
insert into tb_parametros values ('CU073',8,'Sin especificar unidad','10');

insert into tb_parametros values ('CU073',9,'AXM-0004','05|059|CO');
insert into tb_parametros values ('CU073',9,'BAQ-0005','08|001|CO');
insert into tb_parametros values ('CU073',9,'BOG-0001','11|001|CO');
insert into tb_parametros values ('CU073',9,'BGA-0007','68|001|CO');
insert into tb_parametros values ('CU073',9,'BUN-0002','76|109|CO');
insert into tb_parametros values ('CU073',9,'CAL-0004','15|131|CO');
insert into tb_parametros values ('CU073',9,'CLO-0002','76|001|CO');
insert into tb_parametros values ('CU073',9,'COL-0006','19|142|CO');
insert into tb_parametros values ('CU073',9,'CTG-0005','13|001|CO');
insert into tb_parametros values ('CU073',9,'COL-0001','76|147|CO');
insert into tb_parametros values ('CU073',9,'COL-0007','17|174|CO');
insert into tb_parametros values ('CU073',9,'COL-0014','25|214|CO');
insert into tb_parametros values ('CU073',9,'CUC-0007','54|001|CO');
insert into tb_parametros values ('CU073',9,'COL-0002','66|170|CO');
insert into tb_parametros values ('CU073',9,'ENV-0004','05|266|CO');
insert into tb_parametros values ('CU073',9,'IBE-0008','73|001|CO');
insert into tb_parametros values ('CU073',9,'IPI-0002','52|356|CO');
insert into tb_parametros values ('CU073',9,'COL-0011','05|360|CO');
insert into tb_parametros values ('CU073',9,'COL-0003','66|400|CO');
insert into tb_parametros values ('CU073',9,'MAN-0006','17|001|CO');
insert into tb_parametros values ('CU073',9,'MDE-0004','05|001|CO');
insert into tb_parametros values ('CU073',9,'NVA-0008','41|001|CO');
insert into tb_parametros values ('CU073',9,'PSO-0002','52|001|CO');
insert into tb_parametros values ('CU073',9,'PEI-0006','66|001|CO');
insert into tb_parametros values ('CU073',9,'COL-0013','52|565|CO');
insert into tb_parametros values ('CU073',9,'COL-0009','68|615|CO');
insert into tb_parametros values ('CU073',9,'SBN-0004','05|631|CO');
insert into tb_parametros values ('CU073',9,'ADZ-0008','88|001|CO');
insert into tb_parametros values ('CU073',9,'STA-0005','47|001|CO');
insert into tb_parametros values ('CU073',9,'COL-0004','66|682|CO');
insert into tb_parametros values ('CU073',9,'COL-0012','25|817|CO');
insert into tb_parametros values ('CU073',9,'COL-0008','15|001|CO');
insert into tb_parametros values ('CU073',9,'VUP-0055','20|001|CO');
insert into tb_parametros values ('CU073',9,'COL-0005','50|001|CO');
insert into tb_parametros values ('CU073',9,'EYP-0008','85|001|CO');
insert into tb_parametros values ('CU073',9,'COL-0010','25|899|CO');

update table tb_parametros set ca_valor2 = 'PK' where ca_casouso = 'CU047' and ca_identificacion = '1';
update table tb_parametros set ca_valor2 = 'BX' where ca_casouso = 'CU047' and ca_identificacion = '2';
update table tb_parametros set ca_valor2 = 'CT' where ca_casouso = 'CU047' and ca_identificacion = '3';
update table tb_parametros set ca_valor2 = 'PK' where ca_casouso = 'CU047' and ca_identificacion = '4';
update table tb_parametros set ca_valor2 = 'YY' where ca_casouso = 'CU047' and ca_identificacion = '5';
update table tb_parametros set ca_valor2 = 'BT' where ca_casouso = 'CU047' and ca_identificacion = '6';
update table tb_parametros set ca_valor2 = 'RO' where ca_casouso = 'CU047' and ca_identificacion = '7';
update table tb_parametros set ca_valor2 = 'SA' where ca_casouso = 'CU047' and ca_identificacion = '8';
update table tb_parametros set ca_valor2 = 'DR' where ca_casouso = 'CU047' and ca_identificacion = '9';


insert into tb_parametros values ('CU074',0,'3000','5000');

/* Comandos para importar tabla de depositos de parametricas de la Dian */

delete from tb_diandepositos;

=CONCATENAR("insert into tb_diandepositos (ca_codigo, ca_nombre, ca_fchdesde, ca_fchhasta, ca_codadmin, ca_codtipo) values(",A15,",'",B15,"',to_date('",C15,"','YYYMMDD'),to_date('",D15,"','YYYMMDD'),",E15,",",G15,");")



alter table tb_dianclientes add column ca_mercancia_desc text;
alter table tb_dianclientes add column ca_iddestino varchar(8);

alter table tb_dianclientes add CONSTRAINT fk_tb_dianclientes_tb_ciudades_ca_idciudad FOREIGN KEY (ca_iddestino)
      REFERENCES tb_ciudades (ca_idciudad) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION


alter table tb_deducciones add column ca_habilitado boolean default TRUE;
alter table tb_deducciones alter column ca_habilitado set NOT NULL;

update tb_deducciones set ca_habilitado = FALSE where TRIM(ca_deduccion) = 'Comunicaciones';
update tb_deducciones set ca_habilitado = FALSE where TRIM(ca_deduccion) = 'Escolta';
update tb_deducciones set ca_habilitado = FALSE where TRIM(ca_deduccion) = 'Inspecciones';
update tb_deducciones set ca_habilitado = FALSE where TRIM(ca_deduccion) = 'Repesaje o Movimientos en Pto';
update tb_deducciones set ca_habilitado = FALSE where TRIM(ca_deduccion) = 'Contenedores';

insert into tb_deducciones (ca_deduccion, ca_transporte, ca_impoexpo, ca_modalidad) values ('Papelería Contrato de Comodato', 'Marítimo','Importaciones','FCL');
insert into tb_deducciones (ca_deduccion, ca_transporte, ca_impoexpo, ca_modalidad) values ('Papelería Contrato de Comodato', 'Marítimo','Importaciones','LCL');
insert into tb_deducciones (ca_deduccion, ca_transporte, ca_impoexpo, ca_modalidad) values ('Papelería Contrato de Comodato', 'Marítimo','Importaciones','COLOADING');
insert into tb_deducciones (ca_deduccion, ca_transporte, ca_impoexpo, ca_modalidad) values ('Papelería Contrato de Comodato', 'Marítimo','Importaciones','PARTICULARES');
insert into tb_deducciones (ca_deduccion, ca_transporte, ca_impoexpo, ca_modalidad) values ('Papelería Contrato de Comodato', 'Marítimo','Importaciones','PROYECTOS');

insert into tb_deducciones (ca_deduccion, ca_transporte, ca_impoexpo, ca_modalidad) values ('Administration Fee', 'Marítimo','Importaciones','FCL');
insert into tb_deducciones (ca_deduccion, ca_transporte, ca_impoexpo, ca_modalidad) values ('Administration Fee', 'Marítimo','Importaciones','LCL');
insert into tb_deducciones (ca_deduccion, ca_transporte, ca_impoexpo, ca_modalidad) values ('Administration Fee', 'Marítimo','Importaciones','COLOADING');
insert into tb_deducciones (ca_deduccion, ca_transporte, ca_impoexpo, ca_modalidad) values ('Administration Fee', 'Marítimo','Importaciones','PARTICULARES');
insert into tb_deducciones (ca_deduccion, ca_transporte, ca_impoexpo, ca_modalidad) values ('Administration Fee', 'Marítimo','Importaciones','PROYECTOS');

insert into tb_deducciones (ca_deduccion, ca_transporte, ca_impoexpo, ca_modalidad) values ('Dropoff (No OTM)', 'Marítimo','Importaciones','FCL');
insert into tb_deducciones (ca_deduccion, ca_transporte, ca_impoexpo, ca_modalidad) values ('Dropoff (No OTM)', 'Marítimo','Importaciones','LCL');
insert into tb_deducciones (ca_deduccion, ca_transporte, ca_impoexpo, ca_modalidad) values ('Dropoff (No OTM)', 'Marítimo','Importaciones','COLOADING');
insert into tb_deducciones (ca_deduccion, ca_transporte, ca_impoexpo, ca_modalidad) values ('Dropoff (No OTM)', 'Marítimo','Importaciones','PARTICULARES');
insert into tb_deducciones (ca_deduccion, ca_transporte, ca_impoexpo, ca_modalidad) values ('Dropoff (No OTM)', 'Marítimo','Importaciones','PROYECTOS');

insert into tb_deducciones (ca_deduccion, ca_transporte, ca_impoexpo, ca_modalidad) values ('Limpiezas Contenedor', 'Marítimo','Importaciones','FCL');
insert into tb_deducciones (ca_deduccion, ca_transporte, ca_impoexpo, ca_modalidad) values ('Limpiezas Contenedor', 'Marítimo','Importaciones','LCL');
insert into tb_deducciones (ca_deduccion, ca_transporte, ca_impoexpo, ca_modalidad) values ('Limpiezas Contenedor', 'Marítimo','Importaciones','COLOADING');
insert into tb_deducciones (ca_deduccion, ca_transporte, ca_impoexpo, ca_modalidad) values ('Limpiezas Contenedor', 'Marítimo','Importaciones','PARTICULARES');
insert into tb_deducciones (ca_deduccion, ca_transporte, ca_impoexpo, ca_modalidad) values ('Limpiezas Contenedor', 'Marítimo','Importaciones','PROYECTOS');

insert into tb_deducciones (ca_deduccion, ca_transporte, ca_impoexpo, ca_modalidad) values ('Coordinación Embarque', 'Marítimo','Importaciones','FCL');
insert into tb_deducciones (ca_deduccion, ca_transporte, ca_impoexpo, ca_modalidad) values ('Coordinación Embarque', 'Marítimo','Importaciones','LCL');
insert into tb_deducciones (ca_deduccion, ca_transporte, ca_impoexpo, ca_modalidad) values ('Coordinación Embarque', 'Marítimo','Importaciones','COLOADING');
insert into tb_deducciones (ca_deduccion, ca_transporte, ca_impoexpo, ca_modalidad) values ('Coordinación Embarque', 'Marítimo','Importaciones','PARTICULARES');
insert into tb_deducciones (ca_deduccion, ca_transporte, ca_impoexpo, ca_modalidad) values ('Coordinación Embarque', 'Marítimo','Importaciones','PROYECTOS');

insert into tb_deducciones (ca_deduccion, ca_transporte, ca_impoexpo, ca_modalidad) values ('Seguro y Admin del Riesgo', 'Marítimo','Importaciones','FCL');
insert into tb_deducciones (ca_deduccion, ca_transporte, ca_impoexpo, ca_modalidad) values ('Seguro y Admin del Riesgo', 'Marítimo','Importaciones','LCL');
insert into tb_deducciones (ca_deduccion, ca_transporte, ca_impoexpo, ca_modalidad) values ('Seguro y Admin del Riesgo', 'Marítimo','Importaciones','COLOADING');
insert into tb_deducciones (ca_deduccion, ca_transporte, ca_impoexpo, ca_modalidad) values ('Seguro y Admin del Riesgo', 'Marítimo','Importaciones','PARTICULARES');
insert into tb_deducciones (ca_deduccion, ca_transporte, ca_impoexpo, ca_modalidad) values ('Seguro y Admin del Riesgo', 'Marítimo','Importaciones','PROYECTOS');

insert into tb_deducciones (ca_deduccion, ca_transporte, ca_impoexpo, ca_modalidad) values ('Emisión Certificación Póliza', 'Marítimo','Importaciones','FCL');
insert into tb_deducciones (ca_deduccion, ca_transporte, ca_impoexpo, ca_modalidad) values ('Emisión Certificación Póliza', 'Marítimo','Importaciones','LCL');
insert into tb_deducciones (ca_deduccion, ca_transporte, ca_impoexpo, ca_modalidad) values ('Emisión Certificación Póliza', 'Marítimo','Importaciones','COLOADING');
insert into tb_deducciones (ca_deduccion, ca_transporte, ca_impoexpo, ca_modalidad) values ('Emisión Certificación Póliza', 'Marítimo','Importaciones','PARTICULARES');
insert into tb_deducciones (ca_deduccion, ca_transporte, ca_impoexpo, ca_modalidad) values ('Emisión Certificación Póliza', 'Marítimo','Importaciones','PROYECTOS');

insert into tb_deducciones (ca_deduccion, ca_transporte, ca_impoexpo, ca_modalidad) values ('Dropoff Carga OTM', 'Marítimo','Importaciones','FCL');
insert into tb_deducciones (ca_deduccion, ca_transporte, ca_impoexpo, ca_modalidad) values ('Dropoff Carga OTM', 'Marítimo','Importaciones','LCL');
insert into tb_deducciones (ca_deduccion, ca_transporte, ca_impoexpo, ca_modalidad) values ('Dropoff Carga OTM', 'Marítimo','Importaciones','COLOADING');
insert into tb_deducciones (ca_deduccion, ca_transporte, ca_impoexpo, ca_modalidad) values ('Dropoff Carga OTM', 'Marítimo','Importaciones','PARTICULARES');
insert into tb_deducciones (ca_deduccion, ca_transporte, ca_impoexpo, ca_modalidad) values ('Dropoff Carga OTM', 'Marítimo','Importaciones','PROYECTOS');

insert into tb_deducciones (ca_deduccion, ca_transporte, ca_impoexpo, ca_modalidad) values ('Devolución Contenedor', 'Marítimo','Importaciones','FCL');
insert into tb_deducciones (ca_deduccion, ca_transporte, ca_impoexpo, ca_modalidad) values ('Devolución Contenedor', 'Marítimo','Importaciones','LCL');
insert into tb_deducciones (ca_deduccion, ca_transporte, ca_impoexpo, ca_modalidad) values ('Devolución Contenedor', 'Marítimo','Importaciones','COLOADING');
insert into tb_deducciones (ca_deduccion, ca_transporte, ca_impoexpo, ca_modalidad) values ('Devolución Contenedor', 'Marítimo','Importaciones','PARTICULARES');
insert into tb_deducciones (ca_deduccion, ca_transporte, ca_impoexpo, ca_modalidad) values ('Devolución Contenedor', 'Marítimo','Importaciones','PROYECTOS');




-- Table: tb_falaheader_adu

-- DROP TABLE tb_falaheader_adu;

CREATE TABLE tb_falaheader_adu
(
  ca_iddoc character varying(25) NOT NULL,
  ca_fecha_carpeta date NOT NULL,
  ca_archivo_origen character varying(24),
  ca_referencia character varying(16),
  ca_num_viaje character varying(12),
  ca_cod_carrier character varying(4),
  ca_codigo_puerto_pickup character varying(5),
  ca_codigo_puerto_descarga character varying(5),
  ca_container_mode character varying(10),
  ca_nombre_proveedor character varying(60),
  ca_campo_59 character varying(2),
  ca_codigo_proveedor character varying(15),
  ca_campo_61 character varying(60),
  ca_monto_invoice_miles numeric(18,4),
  ca_trader character varying(100),
  ca_vendor_id character varying(15),
  ca_vendor_name character varying(100),
  ca_vendor_addr1 character varying(100),
  ca_vendor_city character varying(15),
  ca_vendor_country character varying(15),
  ca_esd date,
  ca_lsd date,
  ca_incoterms character varying(3),
  ca_procesado boolean,
  ca_payment_terms character varying(15),
  ca_proforma_number character varying(30),
  ca_origin character varying(5),
  ca_destination character varying(5),
  ca_trans_ship_port character varying(15),
  ca_reqd_delivery date,
  ca_orden_comments text,
  ca_manufacturer_contact character varying(30),
  ca_manufacturer_phone character varying(25),
  ca_manufacturer_fax character varying(25),
  ca_fchanulado timestamp without time zone,
  ca_usuanulado character varying(20),
  CONSTRAINT pk_tb_falaheader_adu PRIMARY KEY (ca_iddoc),
  CONSTRAINT fk_tb_falaheader_adu_tbusuarios_ca_usuanulado FOREIGN KEY (ca_usuanulado)
      REFERENCES control.tb_usuarios (ca_login) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION
)
WITH (
  OIDS=TRUE
);
ALTER TABLE tb_falaheader_adu OWNER TO postgres;
GRANT ALL ON TABLE tb_falaheader_adu TO postgres;
GRANT ALL ON TABLE tb_falaheader_adu TO "Administrador";
GRANT ALL ON TABLE tb_falaheader_adu TO "Usuarios";



-- Table: tb_faladetails_adu

-- DROP TABLE tb_faladetails_adu;

CREATE TABLE tb_faladetails_adu
(
  ca_iddoc character varying(25) NOT NULL,
  ca_sku character varying(15) NOT NULL,
  ca_vpn character varying(1),
  ca_cantidad_pedido integer,
  ca_cantidad_dav integer,
  ca_cantidad_dim integer,
  ca_valor_fob decimal,
  ca_unidad_medidad_cantidad character varying(2),
  ca_descripcion_item text,
  ca_cantidad_paquetes_miles numeric(18,4),
  ca_unidad_medida_paquetes character varying(2),
  ca_cantidad_volumen_miles numeric(18,4),
  ca_unidad_medida_volumen character varying(2),
  ca_cantidad_peso_miles numeric(18,4),
  ca_unidad_medida_peso character varying(2),
  ca_unidad_comercial character varying(2),
  ca_referencia_prov character varying(15),
  ca_subpartida character varying(10),
  ca_radicado_num character varying(10),
  ca_registro_num character varying(10),
  ca_descripcion_mcia character varying(250),
  ca_preinspeccion text,
  ca_marca character varying(25),
  ca_tipo character varying(15),
  ca_clase character varying(25),
  ca_modelo character varying(10),
  ca_ano character varying(4),
  ca_factura_nro character varying(30),
  ca_factura_fch date,
  CONSTRAINT pk_tb_faladetails_adu PRIMARY KEY (ca_iddoc, ca_sku, ca_subpartida),
  CONSTRAINT fk_tb_faladetails_adu FOREIGN KEY (ca_iddoc)
      REFERENCES tb_falaheader_adu (ca_iddoc) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=TRUE
);
ALTER TABLE tb_faladetails_adu OWNER TO postgres;
GRANT ALL ON TABLE tb_faladetails_adu TO postgres;
GRANT ALL ON TABLE tb_faladetails_adu TO "Administrador";
GRANT ALL ON TABLE tb_faladetails_adu TO "Usuarios";



-- Table: tb_falashipmentinfo_adu

-- DROP TABLE tb_falashipmentinfo_adu;

CREATE TABLE tb_falashipmentinfo_adu
(
  ca_iddoc character varying(25) NOT NULL,
  ca_begin_window date,
  ca_end_window date,
  ca_commodities character varying(15),
  ca_partial character(1),
  ca_payment_terms character varying(15),
  ca_incoterms character varying(3),
  ca_container_type character varying(10),
  ca_utv character varying(10),
  ca_etv character varying(10),
  ca_line character varying(35),
  ca_contact_line character varying(35),
  ca_contact_importer character varying(35),
  ca_importer_ref character varying(15),
  ca_uppo character varying(10),
  ca_eb character varying(35),
  ca_edd date,
  ca_port character varying(5),
  ca_transshipment character(1),
  ca_transshipment_port character varying(5),
  ca_shipping_org character varying(1),
  ca_original_org character(1),
  ca_fwd_copy_org character(1),
  ca_fcr_org character(1),
  ca_shipping_dst character(1),
  ca_original_dst character(1),
  ca_fwd_copy_dst character(1),
  ca_fcr_dst character(1),
  ca_transport_via character(1),
  ca_invoice_org character(1),
  ca_packing_list_org character(1),
  ca_document_org character(1),
  ca_oc_org character(1),
  ca_others_docs_org character(1),
  ca_invoice_cps character(1),
  ca_packing_list_cps character(1),
  ca_document_cps character(1),
  ca_oc_cps character(1),
  ca_others_docs_cps character(1),
  ca_final_port character(5),
  ca_alter_port character varying(5),
  ca_limit_date date,
  CONSTRAINT tb_falashipmentinfo_adu_pkey PRIMARY KEY (ca_iddoc),
  CONSTRAINT tb_falashipmentinfo_adu_ca_iddoc_fkey FOREIGN KEY (ca_iddoc)
      REFERENCES tb_falashipmentinfo_adu (ca_iddoc) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE tb_falashipmentinfo_adu OWNER TO postgres;
GRANT ALL ON TABLE tb_falashipmentinfo_adu TO postgres;
GRANT ALL ON TABLE tb_falashipmentinfo_adu TO "Administrador";
GRANT ALL ON TABLE tb_falashipmentinfo_adu TO "Usuarios";




-- Sequence: tb_falainstructions_adu_id

-- DROP SEQUENCE tb_falainstructions_adu_id;

CREATE SEQUENCE tb_falainstructions_adu_id
  INCREMENT 1
  MINVALUE 1
  MAXVALUE 9223372036854775807
  START 1
  CACHE 1;
ALTER TABLE tb_falainstructions_adu_id OWNER TO postgres;
GRANT ALL ON TABLE tb_falainstructions_adu_id TO postgres;
GRANT ALL ON TABLE tb_falainstructions_adu_id TO "Administrador";
GRANT ALL ON TABLE tb_falainstructions_adu_id TO "Usuarios";



-- Table: tb_falainstructions_adu

-- DROP TABLE tb_falainstructions_adu;

CREATE TABLE tb_falainstructions_adu
(
  ca_idfalainstructions_adu integer NOT NULL DEFAULT nextval('tb_falainstructions_adu_id'::regclass),
  ca_iddoc character varying(25) NOT NULL,
  ca_instructions text,
  ca_embarque character varying(2),
  CONSTRAINT tb_falainstructions_adu_pkey PRIMARY KEY (ca_idfalainstructions_adu),
  CONSTRAINT fk_falainstruction FOREIGN KEY (ca_iddoc)
      REFERENCES tb_falaheader_adu (ca_iddoc) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE tb_falainstructions_adu OWNER TO postgres;
GRANT ALL ON TABLE tb_falainstructions_adu TO postgres;
GRANT ALL ON TABLE tb_falainstructions_adu TO "Administrador";
GRANT ALL ON TABLE tb_falainstructions_adu TO "Usuarios";



-- Table: tb_faladeclaracion_imp

-- DROP TABLE tb_faladeclaracion_imp;

CREATE TABLE tb_faladeclaracion_imp
(
  ca_referencia character varying(16),
  ca_numinternacion character varying(10),
  ca_ano_trm integer,
  ca_semana_trm integer,
  ca_factor_trm numeric(10,3),
  ca_fchcreado timestamp NOT NULL,
  ca_usucreado varchar (20) NOT NULL,
  ca_fchactualizado timestamp,
  ca_usuactualizado varchar (20),
  CONSTRAINT tb_faladeclaracion_imp_pkey PRIMARY KEY (ca_referencia)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE tb_faladeclaracion_imp OWNER TO postgres;
GRANT ALL ON TABLE tb_faladeclaracion_imp TO postgres;
GRANT ALL ON TABLE tb_faladeclaracion_imp TO "Administrador";
GRANT ALL ON TABLE tb_faladeclaracion_imp TO "Usuarios";


-- Table: tb_faladeclaracion_dts

-- DROP TABLE tb_faladeclaracion_dts;

CREATE TABLE tb_faladeclaracion_dts
(
  ca_referencia character varying(16),
  ca_item integer,
  ca_numdeclaracion character varying(30),
  ca_emision_fch date,
  ca_vencimiento_fch date,
  ca_aceptacion_fch date,
  ca_pago_fch date,
  ca_moneda character varying(3),
  ca_valor_trm numeric(8,2),
  ca_subpartida character varying(10),
  ca_mod character varying(6),
  ca_cantidad numeric(8,2),
  ca_unidad character varying(3),
  ca_valor_fob numeric(15,2),
  ca_gastos_despacho numeric(15,2),
  ca_flete numeric(15,2),
  ca_seguro numeric(15,2),
  ca_gastos_embarque numeric(15,2),
  ca_ajuste_valor numeric(15,2),
  ca_valor_aduana numeric(15,2),
  ca_arancel_porcntj numeric(5,2),
  ca_arancel numeric(15,2),
  ca_iva_porctj numeric(5,2),
  ca_iva numeric(15,2),
  ca_salvaguarda_porcntj numeric(5,2),
  ca_salvaguarda numeric(15,2),
  ca_compensa_porcntj numeric(5,2),
  ca_compensa numeric(15,2),
  ca_antidump_porcntj numeric(5,2),
  ca_antidump numeric(15,2),
  ca_sancion numeric(15,2),
  ca_rescate numeric(15,2),
  ca_peso_bruto numeric(10,2),
  ca_peso_neto numeric(10,2),
  ca_fchcreado timestamp NOT NULL,
  ca_usucreado varchar (20) NOT NULL,
  ca_fchactualizado timestamp,
  ca_usuactualizado varchar (20),
  CONSTRAINT tb_faladeclaracion_dts_pkey PRIMARY KEY (ca_referencia, ca_item),
  CONSTRAINT tb_faladeclaracion_dts_ca_referencia_fkey FOREIGN KEY (ca_referencia)
      REFERENCES tb_faladeclaracion_imp (ca_referencia) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE tb_faladeclaracion_dts OWNER TO postgres;
GRANT ALL ON TABLE tb_faladeclaracion_dts TO postgres;
GRANT ALL ON TABLE tb_faladeclaracion_dts TO "Administrador";
GRANT ALL ON TABLE tb_faladeclaracion_dts TO "Usuarios";



-- Table: tb_falafacturacion_adu

-- DROP TABLE tb_falafacturacion_adu;

CREATE TABLE tb_falafacturacion_adu
(
  ca_referencia character varying(16),
  ca_numdocumento character varying(10),
  ca_emision_fch date,
  ca_vencimiento_fch date,
  ca_moneda character varying(3),
  ca_tipo_cambio numeric(8,2),
  ca_afecto_vlr numeric(15,2),
  ca_iva_vlr numeric(15,2),
  ca_exento_vlr numeric(15,2),
  ca_fchcreado timestamp NOT NULL,
  ca_usucreado varchar (20) NOT NULL,
  ca_fchactualizado timestamp,
  ca_usuactualizado varchar (20),
  CONSTRAINT tb_falafacturacion_adu_pkey PRIMARY KEY (ca_referencia),
  CONSTRAINT tb_falafacturacion_adu_ca_referencia_fkey FOREIGN KEY (ca_referencia)
      REFERENCES tb_faladeclaracion_imp (ca_referencia) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE tb_falafacturacion_adu OWNER TO postgres;
GRANT ALL ON TABLE tb_falafacturacion_adu TO postgres;
GRANT ALL ON TABLE tb_falafacturacion_adu TO "Administrador";
GRANT ALL ON TABLE tb_falafacturacion_adu TO "Usuarios";


-- Table: tb_falanota_cab

-- DROP TABLE tb_falanota_cab;

CREATE TABLE tb_falanota_cab
(
  ca_referencia character varying(16),
  ca_numdocumento character varying(7),
  ca_emision_fch date,
  ca_vlrdocumento numeric(15,2),
  ca_tipo_cambio numeric(8,2),
  ca_fchcreado timestamp NOT NULL,
  ca_usucreado varchar (20) NOT NULL,
  ca_fchactualizado timestamp,
  ca_usuactualizado varchar (20),
  CONSTRAINT tb_falanota_cab_pkey PRIMARY KEY (ca_referencia, ca_numdocumento),
  CONSTRAINT tb_falanota_cab_ca_referencia_fkey FOREIGN KEY (ca_referencia)
      REFERENCES tb_faladeclaracion_imp (ca_referencia) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE tb_falanota_cab OWNER TO postgres;
GRANT ALL ON TABLE tb_falanota_cab TO postgres;
GRANT ALL ON TABLE tb_falanota_cab TO "Administrador";
GRANT ALL ON TABLE tb_falanota_cab TO "Usuarios";


-- Table: tb_falanota_det

-- DROP TABLE tb_falanota_det;

CREATE TABLE tb_falanota_det
(
  ca_referencia character varying(16),
  ca_numdocumento character varying(7),
  ca_idconcepto integer,
  ca_nit_ter character varying(12),
  ca_tipo character varying(1),
  ca_factura_ter character varying(20),
  ca_factura_fch date,
  ca_factura_vlr numeric(15,2),
  ca_factura_iva numeric(15,2),
  ca_fchcreado timestamp NOT NULL,
  ca_usucreado varchar (20) NOT NULL,
  ca_fchactualizado timestamp,
  ca_usuactualizado varchar (20),
  CONSTRAINT tb_falanota_det_pkey PRIMARY KEY (ca_referencia, ca_numdocumento, ca_idconcepto),
  CONSTRAINT tb_falanota_det_ca_referencia_fkey FOREIGN KEY (ca_referencia, ca_numdocumento)
      REFERENCES tb_falanota_cab (ca_referencia, ca_numdocumento) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE tb_falanota_det OWNER TO postgres;
GRANT ALL ON TABLE tb_falanota_det TO postgres;
GRANT ALL ON TABLE tb_falanota_det TO "Administrador";
GRANT ALL ON TABLE tb_falanota_det TO "Usuarios";




alter table tb_fileheader alter column ca_in_out type varchar(50);

update tb_fileheader set ca_in_out = '/home/falabella/OUT' where ca_idfileheader = 1

insert into tb_fileheader (ca_descripcion, ca_tipoarchivo, ca_separador, ca_separadordec, ca_in_out, ca_fchcreado, ca_usucreado) values ('P.O. Falabella Aduana', 'Long.Fija', '', '.', '/home/falafact/OUT', '2009-12-22 12:00:00', 'Administrador');

// <<<< Archivo Excel con Registros tipo 4 >>>>

update tb_filecolumns set ca_idregistro = (select ca_idcolumna from tb_filecolumns where ca_idfileheader = 4 and ca_columna = 'FALPOH01') where ca_idfileheader = 4 and ca_idregistro = 1;
update tb_filecolumns set ca_idregistro = (select ca_idcolumna from tb_filecolumns where ca_idfileheader = 4 and ca_columna = 'FALPOH02') where ca_idfileheader = 4 and ca_idregistro = 44;
update tb_filecolumns set ca_idregistro = (select ca_idcolumna from tb_filecolumns where ca_idfileheader = 4 and ca_columna = 'FALPOH03') where ca_idfileheader = 4 and ca_idregistro = 89;
update tb_filecolumns set ca_idregistro = (select ca_idcolumna from tb_filecolumns where ca_idfileheader = 4 and ca_columna = 'FALPOD01') where ca_idfileheader = 4 and ca_idregistro = 94;

/*
    solo si es necesario!
update tb_filecolumns set ca_idregistro = 1 where ca_idcolumna between 1 and 43;
update tb_filecolumns set ca_idregistro = 44 where ca_idcolumna between 44 and 88;
update tb_filecolumns set ca_idregistro = 89 where ca_idcolumna between 89 and 93;
update tb_filecolumns set ca_idregistro = 94 where ca_idcolumna between 94 and 113;
*/

alter table tb_fileimported add column ca_proceso varchar(15);
update tb_fileimported set ca_proceso = 'Coltrans';

alter table tb_falainstructionsadu add column ca_embarque varchar(2);

=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*
alter table tb_clientes add column ca_tipo varchar (100);
alter table tb_clientes add column ca_entidad varchar (15) NOT NULL DEFAULT 'Vigente'::character varying;
alter table tb_clientes add column ca_fchfinanciero timestamp;
alter table tb_clientes add column ca_usufinanciero varchar (20);


update tb_falaheader_adu set ca_reqd_delivery = '2010-01-19' where ca_fecha_carpeta in ('2010-01-04','2010-01-07');
update tb_falaheader_adu set ca_reqd_delivery = '2010-01-21' where ca_fecha_carpeta in ('2010-01-15');


insert into tb_parametros values ('CU078',0,'Barriles','66');
insert into tb_parametros values ('CU078',0,'Billon de Unidades','63');
insert into tb_parametros values ('CU078',0,'Bulto','10');
insert into tb_parametros values ('CU078',0,'Caneca','62');
insert into tb_parametros values ('CU078',0,'Ciexto','87');
insert into tb_parametros values ('CU078',0,'Cajas Cartón','13');
insert into tb_parametros values ('CU078',0,'Centímetro Cúbico','85');
insert into tb_parametros values ('CU078',0,'Centímetro','46');
insert into tb_parametros values ('CU078',0,'Cono','35');
insert into tb_parametros values ('CU078',0,'Cuartos','36');
insert into tb_parametros values ('CU078',0,'Docena de Pares','21');
insert into tb_parametros values ('CU078',0,'Docena de Piezas','79');
insert into tb_parametros values ('CU078',0,'Decimetro Cuadrado','84');
insert into tb_parametros values ('CU078',0,'Docena','15');
insert into tb_parametros values ('CU078',0,'Fijo','55');
insert into tb_parametros values ('CU078',0,'Frasco','12');
insert into tb_parametros values ('CU078',0,'Galones','65');
insert into tb_parametros values ('CU078',0,'Gramo','18');
insert into tb_parametros values ('CU078',0,'Gramo Base','23');
insert into tb_parametros values ('CU078',0,'Gran Gruesa','16');
insert into tb_parametros values ('CU078',0,'Hojas','38');
insert into tb_parametros values ('CU078',0,'Juego De Docena','72');
insert into tb_parametros values ('CU078',0,'Juego(Conjunto)','20');
insert into tb_parametros values ('CU078',0,'Kilogramo Bruto','31');
insert into tb_parametros values ('CU078',0,'Kilogramo Seco','30');
insert into tb_parametros values ('CU078',0,'Kilogramo Neto','33');
insert into tb_parametros values ('CU078',0,'Kilo Base','48');
insert into tb_parametros values ('CU078',0,'Kilo Humedo','50');
insert into tb_parametros values ('CU078',0,'Kilo Liquido','27');
insert into tb_parametros values ('CU078',0,'Kilo Solido','14');
insert into tb_parametros values ('CU078',0,'Kilo Actividad','47');
insert into tb_parametros values ('CU078',0,'Lamina','43');
insert into tb_parametros values ('CU078',0,'Lata','51');
insert into tb_parametros values ('CU078',0,'Libra Humeda','54');
insert into tb_parametros values ('CU078',0,'Libra Solida','60');
insert into tb_parametros values ('CU078',0,'Libra Seca','32');
insert into tb_parametros values ('CU078',0,'Libra','24');
insert into tb_parametros values ('CU078',0,'Litro','61');
insert into tb_parametros values ('CU078',0,'Lote','26');
insert into tb_parametros values ('CU078',0,'Megawatt Hora','74');
insert into tb_parametros values ('CU078',0,'Miles De Juegos','66');
insert into tb_parametros values ('CU078',0,'Miles De Yardas','22');
insert into tb_parametros values ('CU078',0,'Miles De Unidades','45');
insert into tb_parametros values ('CU078',0,'Miles De Metros','34');
insert into tb_parametros values ('CU078',0,'Miles De Pulgadas','69');
insert into tb_parametros values ('CU078',0,'Miles De Docenas','86');
insert into tb_parametros values ('CU078',0,'Miles De Pliegos','92');
insert into tb_parametros values ('CU078',0,'Miles De Pulgadas Cuadrada','71');
insert into tb_parametros values ('CU078',0,'Metro Cubico','67');
insert into tb_parametros values ('CU078',0,'Metro Cuadrado','82');
insert into tb_parametros values ('CU078',0,'Metro Lineal','91');
insert into tb_parametros values ('CU078',0,'Miligramo','64');
insert into tb_parametros values ('CU078',0,'Onza','57');
insert into tb_parametros values ('CU078',0,'Onza Troy','52');
insert into tb_parametros values ('CU078',0,'Paca','68');
insert into tb_parametros values ('CU078',0,'Paquetes','63');
insert into tb_parametros values ('CU078',0,'Pares','19');
insert into tb_parametros values ('CU078',0,'Pie','80');
insert into tb_parametros values ('CU078',0,'Pie Cubico','83');
insert into tb_parametros values ('CU078',0,'Pie Cuadrado','81');
insert into tb_parametros values ('CU078',0,'Pieza','89');
insert into tb_parametros values ('CU078',0,'Pinta','28');
insert into tb_parametros values ('CU078',0,'Pulgada Cuadrada','75');
insert into tb_parametros values ('CU078',0,'Pulgadas','69');
insert into tb_parametros values ('CU078',0,'Quilates','97');
insert into tb_parametros values ('CU078',0,'Racimos','17');
insert into tb_parametros values ('CU078',0,'Ramo','90');
insert into tb_parametros values ('CU078',0,'Resma','29');
insert into tb_parametros values ('CU078',0,'Rollo','39');
insert into tb_parametros values ('CU078',0,'Saco','25');
insert into tb_parametros values ('CU078',0,'Sobres','94');
insert into tb_parametros values ('CU078',0,'Tambor','70');
insert into tb_parametros values ('CU078',0,'Tarro','40');
insert into tb_parametros values ('CU078',0,'Tonelada Metrica Neta','42');
insert into tb_parametros values ('CU078',0,'Tonelada Metrica Bruta','41');
insert into tb_parametros values ('CU078',0,'Tonelada Corta','37');
insert into tb_parametros values ('CU078',0,'Tonelada Larga','88');
insert into tb_parametros values ('CU078',0,'Tonel','49');
insert into tb_parametros values ('CU078',0,'Tramo','93');
insert into tb_parametros values ('CU078',0,'Tubo','44');
insert into tb_parametros values ('CU078',0,'Unidades O Nar','11');
insert into tb_parametros values ('CU078',0,'Yarda Cuadrada','98');
insert into tb_parametros values ('CU078',0,'Yarda Lineal','68');

insert into tb_parametros values ('CU079',0,'Dólar Americano','USD');
insert into tb_parametros values ('CU079',0,'Pesos Colombianos','COL');

insert into tb_parametros values ('CU080',0,'Bodegajes','01');
insert into tb_parametros values ('CU080',0,'Recargos en Destino','12');


insert into tb_parametros values ('CU082',0,'Chipre','221');
insert into tb_parametros values ('CU082',1,'Happag Lloyd','2759');
insert into tb_parametros values ('CU082',2,'Frontier','4661');
insert into tb_parametros values ('CU082',3,'CMA/CGM','4781');
insert into tb_parametros values ('CU082',4,'CSAV','7235');
insert into tb_parametros values ('CU082',5,'Hamburg Sud','5730');
insert into tb_parametros values ('CU082',6,'MSC','6022');
insert into tb_parametros values ('CU082',7,'King Ocean','2260');
insert into tb_parametros values ('CU082',8,'Navemar','5730');

insert into tb_parametros values ('CU083',1,'DE-049','023');
insert into tb_parametros values ('CU083',1,'US-001','249');
insert into tb_parametros values ('CU083',1,'IT-039','386');


ALTER TABLE tb_falaheader ADD COLUMN ca_fcharchivado timestamp without time zone;
ALTER TABLE tb_falaheader ADD COLUMN ca_usuarchivado character varying(20);
ALTER TABLE tb_falaheader ALTER COLUMN ca_fcharchivado SET STORAGE PLAIN;
ALTER TABLE tb_falaheader ALTER COLUMN ca_usuarchivado SET STORAGE EXTENDED;

ALTER TABLE tb_falaheader_adu ADD COLUMN ca_fcharchivado timestamp without time zone;
ALTER TABLE tb_falaheader_adu ADD COLUMN ca_usuarchivado character varying(20);
ALTER TABLE tb_falaheader_adu ALTER COLUMN ca_fcharchivado SET STORAGE PLAIN;
ALTER TABLE tb_falaheader_adu ALTER COLUMN ca_usuarchivado SET STORAGE EXTENDED;


insert into tb_parametros values ('CU083',10,'Air France','2423');
insert into tb_parametros values ('CU083',11,'American Airlines','2414');
insert into tb_parametros values ('CU083',12,'Arrow Air','3637');
insert into tb_parametros values ('CU083',13,'Cargolux','2463');
insert into tb_parametros values ('CU083',14,'Centurion','4035');
insert into tb_parametros values ('CU083',15,'Iberia','2414');
insert into tb_parametros values ('CU083',16,'KLM','2526');
insert into tb_parametros values ('CU083',17,'L.T.U.','2415');
insert into tb_parametros values ('CU083',18,'Lan Chile','2425');
insert into tb_parametros values ('CU083',19,'Martin Air','2466');
insert into tb_parametros values ('CU083',20,'Tampa / Avianca','2259');
insert into tb_parametros values ('CU083',21,'Tampa Cargo','2076');


insert into tb_parametros values ('CU084',1,'LCL','LCL');
insert into tb_parametros values ('CU084',2,'CY/CY','CY/CY');
insert into tb_parametros values ('CU084',3,'CFS/CFS','CFS/CFS');
insert into tb_parametros values ('CU084',4,'CFS/CY','CFS/CY');

alter table tb_falaheader add column ca_numero_invoice varchar (20);

insert into tb_parametros values ('CU085',1,'yacgarzon@Falabella.com.co',null);
insert into tb_parametros values ('CU085',2,'smrodriguez@Falabella.com.co',null);



ALTER TABLE tb_inoclientes_sea ADD COLUMN ca_fchantecedentes date;


insert into tb_parametros values ('CU086',1,'ES-034','6');
insert into tb_parametros values ('CU086',2,'GB-044','5');
insert into tb_parametros values ('CU086',3,'FR-033','4');
insert into tb_parametros values ('CU086',4,'MX-052','2');
insert into tb_parametros values ('CU086',5,'BE-032','5');
insert into tb_parametros values ('CU086',6,'BR-055','5');
insert into tb_parametros values ('CU086',7,'CL-056','5');
insert into tb_parametros values ('CU086',8,'TW-886','10');
insert into tb_parametros values ('CU086',9,'PA-507','-1');
insert into tb_parametros values ('CU086',10,'NL-031','5');
insert into tb_parametros values ('CU086',11,'DE-049','9');
insert into tb_parametros values ('CU086',12,'IT-039','5');
insert into tb_parametros values ('CU086',13,'US-001','2');
insert into tb_parametros values ('CU086',14,'AR-054','5');
insert into tb_parametros values ('CU086',14,'PE-051','0');
insert into tb_parametros values ('CU086',15,'CN-086','15');
insert into tb_parametros values ('CU086',16,'HK-852','15');
insert into tb_parametros values ('CU086',17,'KR-082','15');


insert into tb_parametros values ('CU091',1,'Se libera sobre canje','');
insert into tb_parametros values ('CU091',2,'Cartera al dia','');
insert into tb_parametros values ('CU091',3,'Viene carga ruteada','');
insert into tb_parametros values ('CU091',4,'Liberación autorizada por Gerente Comercial','');
insert into tb_parametros values ('CU091',5,'Liberación autorizada por Gerente Regional','');
insert into tb_parametros values ('CU091',6,'Carga para nacionalizar en Colmas','');
insert into tb_parametros values ('CU091',7,'Se libera para transito OTM','');
