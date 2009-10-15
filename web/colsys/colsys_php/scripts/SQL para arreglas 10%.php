create table bk_inodeduccion_sea as select * from tb_inodeduccion_sea;
drop table tb_inodeduccion_sea cascade;
create table tb_inodeduccion_sea
( ca_referencia varchar (16) NOT NULL
, ca_idcliente numeric(9) NOT NULL
, ca_hbls varchar (20) NOT NULL 
, ca_factura varchar(15) NOT NULL
, ca_iddeduccion smallint NOT NULL
, ca_valor decimal (15,2) NOT NULL
, ca_fchcreado timestamp NOT NULL
, ca_usucreado varchar (20) NOT NULL
, ca_fchactualizado timestamp
, ca_usuactualizado varchar (20) 
, constraint pk_tb_inodeduccion_sea PRIMARY KEY (ca_referencia, ca_idcliente, ca_hbls, ca_factura, ca_iddeduccion)
, constraint fk_tb_inodeduccion_sea FOREIGN KEY (ca_referencia, ca_idcliente, ca_hbls) REFERENCES tb_inoclientes_sea (ca_referencia, ca_idcliente, ca_hbls)
);
REVOKE ALL ON tb_inodeduccion_sea FROM PUBLIC;
GRANT ALL ON tb_inodeduccion_sea TO "Administrador";
GRANT ALL ON tb_inodeduccion_sea TO GROUP "Usuarios";

-- select * from bk_inodeduccion_sea where ca_referencia in ('400.35.06.009.5', '400.42.02.015.5', '400.45.06.004.5', '400.50.02.002.0', '400.50.02.020.5', '400.50.11.013.5', '42.85.11.005.5', '420.10.01.004.5', '420.50.05.124.5', '420.50.08.081.5', '420.50.09.098.8', '421.50.10.094.5', '510.10.11.005.5', '510.50.10.003.5', '510.50.10.004.5', '520.50.50.002.5');
-- select d.ca_referencia, d.ca_idcliente, d.ca_hbls, (select i.ca_factura from tb_inoingresos_sea i where d.ca_referencia = i.ca_referencia and d.ca_idcliente = i.ca_idcliente and d.ca_hbls = i.ca_hbls order by i.ca_valor DESC limit 1) as ca_factura, d.ca_iddeduccion, d.ca_valor, d.ca_fchcreado, d.ca_usucreado, d.ca_fchactualizado, d.ca_usuactualizado from bk_inodeduccion_sea d;

insert into tb_inodeduccion_sea  select d.ca_referencia, d.ca_idcliente, d.ca_hbls, (select i.ca_factura from tb_inoingresos_sea i where d.ca_referencia = i.ca_referencia and d.ca_idcliente = i.ca_idcliente and d.ca_hbls = i.ca_hbls  order by i.ca_valor DESC limit 1) as ca_factura, d.ca_iddeduccion, d.ca_valor, d.ca_fchcreado, d.ca_usucreado, d.ca_fchactualizado, d.ca_usuactualizado from bk_inodeduccion_sea d where d.ca_referencia not in ('400.35.06.009.5', '400.42.02.015.5', '400.45.06.004.5', '400.50.02.002.0', '400.50.02.020.5', '400.50.11.013.5', '42.85.11.005.5', '420.10.01.004.5', '420.50.05.124.5', '420.50.08.081.5', '420.50.09.098.8', '421.50.10.094.5', '510.10.11.005.5', '510.50.10.003.5', '510.50.10.004.5', '520.50.50.002.5', '420.50.11.122.5', '500.60.11.001.5', '500.70.11.001.5', '420.50.11.026.5');

Create view vi_inomaestra_sea as
Select substr(i.ca_referencia,8,2)||'-'||substr(i.ca_referencia,15,1) as ca_mes, substr(i.ca_referencia,5,2) as ca_trafico, substr(i.ca_referencia,1,3) as ca_modal, i.ca_fchreferencia, i.ca_referencia, i.ca_impoexpo, i.ca_origen, c1.ca_ciudad as ca_ciuorigen, t1.ca_nombre as ca_traorigen, i.ca_destino,
       c2.ca_ciudad as ca_ciudestino, t2.ca_nombre as ca_tradestino, i.ca_fchembarque, i.ca_fcharribo, i.ca_modalidad, i.ca_idlinea, t.ca_nombre, t.ca_sigla, t.ca_nomtransportista, i.ca_motonave, i.ca_ciclo, i.ca_mbls, i.ca_observaciones, i.ca_fchconfirmacion, i.ca_horaconfirmacion, i.ca_registroadu,
	   i.ca_fchregistroadu, i.ca_registrocap, i.ca_bandera, i.ca_fchdesconsolidacion, i.ca_mnllegada, i.ca_fchliberacion, i.ca_nroliberacion, i.ca_mensaje, i.ca_anulado, i.ca_fchcreado, i.ca_usucreado, i.ca_fchactualizado, i.ca_usuactualizado, i.ca_fchliquidado, i.ca_usuliquidado, i.ca_fchcerrado, i.ca_usucerrado,
       (select sum(ic.ca_numpiezas) from tb_inoclientes_sea ic where i.ca_referencia = ic.ca_referencia) as ca_numpiezas,
       (select sum(ic.ca_peso) from tb_inoclientes_sea ic where i.ca_referencia = ic.ca_referencia) as ca_peso,
       (select sum(ic.ca_volumen) from tb_inoclientes_sea ic where i.ca_referencia = ic.ca_referencia) as ca_volumen,
       (select sum(ic.ca_neto*ic.ca_tcambio) from tb_inocostos_sea ic where i.ca_referencia = ic.ca_referencia) as ca_costoneto,
	   (select sum(ic.ca_venta)-sum(ic.ca_neto*ic.ca_tcambio) from tb_inocostos_sea ic, tb_costos c where ic.ca_idcosto = c.ca_idcosto and i.ca_referencia = ic.ca_referencia and c.ca_comisionable != 'No') as ca_comisionable,
	   (select sum(ic.ca_venta)-sum(ic.ca_neto*ic.ca_tcambio) from tb_inocostos_sea ic, tb_costos c where ic.ca_idcosto = c.ca_idcosto and i.ca_referencia = ic.ca_referencia and c.ca_comisionable = 'No') as ca_nocomisionable,
       (select sum(ii.ca_valor) from tb_inoingresos_sea ii where i.ca_referencia = ii.ca_referencia) as ca_facturacion,
	   (select sum(d.ca_valor) from tb_inodeduccion_sea d where i.ca_referencia = d.ca_referencia) as ca_deduccion,
	   (select sum(ic.ca_venta) from tb_inocostos_sea ic, tb_costos c where ic.ca_idcosto = c.ca_idcosto and i.ca_referencia = ic.ca_referencia and c.ca_comisionable != 'No' and ic.ca_login = '') as ca_utilidad
       from tb_inomaestra_sea i, tb_ciudades c1, tb_ciudades c2, tb_traficos t1, tb_traficos t2, vi_transporlineas t where i.ca_origen = c1.ca_idciudad and i.ca_destino = c2.ca_idciudad and c1.ca_idtrafico = t1.ca_idtrafico and c2.ca_idtrafico = t2.ca_idtrafico and i.ca_idlinea = t.ca_idlinea 
	   order by ca_mes, ca_trafico, ca_modal, ca_referencia;
REVOKE ALL ON vi_inomaestra_sea FROM PUBLIC;
GRANT ALL ON vi_inomaestra_sea TO "Administrador";
GRANT ALL ON vi_inomaestra_sea TO GROUP "Usuarios";


Create view vi_inotraficos_sea as
Select substr(i.ca_referencia,8,2)||'-'||substr(i.ca_referencia,15,1) as ca_mes, (select ca_traorigen from vi_inomaestra_sea m where m.ca_referencia = i.ca_referencia) as ca_traorigen, substr(ca_referencia,5,2) as ca_sufijo, count(DISTINCT i.ca_referencia) as ca_referencias, count(DISTINCT i.ca_hbls) as ca_hbls, count(DISTINCT i.ca_idcliente) as ca_clientes, sum(i.ca_valor) as ca_facturacion
       from tb_inoingresos_sea i
	   where i.ca_referencia in (select ca_referencia from tb_inomaestra_sea where ca_usucerrado != '')
       group by ca_mes, ca_sufijo, ca_traorigen
       order by ca_mes, ca_traorigen;
REVOKE ALL ON vi_inotraficos_sea FROM PUBLIC;
GRANT ALL ON vi_inotraficos_sea TO "Administrador";
GRANT ALL ON vi_inotraficos_sea TO GROUP "Usuarios";

Create view vi_inoclientes_sea as
Select i.oid as ca_oid, i.ca_referencia, i.ca_idcliente, p.ca_compania, i.ca_idreporte, i.ca_hbls, i.ca_idproveedor, i.ca_proveedor, i.ca_numpiezas, i.ca_peso, i.ca_volumen, i.ca_numorden, i.ca_confirmar, i.ca_login, i.ca_observaciones,
       i.ca_fchcreado as ca_fchcreado_cl, i.ca_usucreado as ca_usucreado_cl, i.ca_fchactualizado as ca_fchactualizado_cl, i.ca_usuactualizado as ca_usuactualizado_cl, f.ca_factura, f.ca_fchfactura, f.ca_valor, f.ca_reccaja, f.ca_tcambio,
	   (select sum(d.ca_valor) from tb_inodeduccion_sea d where i.ca_referencia = d.ca_referencia and i.ca_idcliente = d.ca_idcliente and i.ca_hbls = d.ca_hbls and f.ca_factura = d.ca_factura) as ca_deduccion,
	   (select count(cl.ca_hbls) from tb_inoclientes_sea cl where cl.ca_referencia = i.ca_referencia) as ca_nrohbls,
	   f.ca_fchcreado as ca_fchcreado_fc, f.ca_usucreado as ca_usucreado_fc, f.ca_fchactualizado as ca_fchactualizado_fc, f.ca_usuactualizado as ca_usuactualizado_fc
       from tb_inoclientes_sea i LEFT OUTER JOIN tb_inoingresos_sea f ON (i.ca_referencia = f.ca_referencia and i.ca_idcliente = f.ca_idcliente) LEFT OUTER JOIN tb_potenciales p ON (i.ca_idcliente = p.ca_idcliente)
	   order by i.ca_referencia, p.ca_compania, i.ca_hbls, f.ca_factura;
REVOKE ALL ON vi_inoclientes_sea FROM PUBLIC;
GRANT ALL ON vi_inoclientes_sea TO "Administrador";
GRANT ALL ON vi_inoclientes_sea TO GROUP "Usuarios";

Create view vi_inocomisiones_sea as
SELECT i.ca_referencia, c.ca_login, l.ca_sucursal, p.ca_compania, c.ca_hbls, c.ca_volumen, i.ca_facturacion AS ca_facturacion_r, i.ca_deduccion AS ca_deduccion_r, i.ca_utilidad AS ca_utilidad_r, i.ca_volumen AS ca_volumen_r, n.ca_factura, n.ca_fchfactura, n.ca_valor, u.ca_idcosto AS ca_idcosto_ded, s.ca_costo AS ca_costo_ded, u.ca_factura AS ca_factura_ded, u.ca_valor AS ca_valor_ded, i.ca_usucerrado, i.ca_fchcerrado
   FROM vi_inomaestra_sea i
   LEFT JOIN tb_inoclientes_sea c ON (i.ca_referencia = c.ca_referencia)
   LEFT JOIN tb_inoingresos_sea n ON (c.ca_referencia = n.ca_referencia AND c.ca_idcliente = n.ca_idcliente AND c.ca_hbls = n.ca_hbls)
   LEFT JOIN tb_inoutilidad_sea u ON (u.ca_referencia = c.ca_referencia AND u.ca_idcliente = n.ca_idcliente AND u.ca_hbls = n.ca_hbls)
   LEFT JOIN tb_costos s ON u.ca_idcosto = s.ca_idcosto
   LEFT JOIN tb_potenciales p ON p.ca_idcliente = c.ca_idcliente
   LEFT JOIN control.tb_usuarios l ON c.ca_login = l.ca_login
   ORDER BY c.ca_login, i.ca_referencia, p.ca_compania, n.ca_hbls, n.ca_factura;
GRANT ALL ON TABLE public.vi_inocomisiones_sea TO postgres WITH GRANT OPTION;
GRANT ALL ON TABLE public.vi_inocomisiones_sea TO "Administrador";
GRANT ALL ON TABLE public.vi_inocomisiones_sea TO GROUP "Usuarios";

Create view vi_inocarga_fcl as
Select substr(i.ca_referencia,8,2)||'-'||substr(i.ca_referencia,15,1) as ca_mes, u.ca_sucursal, i.ca_traorigen, i.ca_ciudestino, substr(e.ca_concepto,1,2) as ca_capacidad, sum(e.ca_cantidad) as ca_cantidad
	   from vi_inomaestra_sea i, vi_inoequipos_sea e, tb_inoclientes_sea c, control.tb_usuarios u
	   where i.ca_usucerrado != '' and i.ca_modalidad = 'FCL' and i.ca_referencia = e.ca_referencia and i.ca_referencia = c.ca_referencia and c.ca_login = u.ca_login
	   group by substr(i.ca_referencia,8,2)||'-'||substr(i.ca_referencia,15,1), ca_sucursal, i.ca_modalidad, substr(e.ca_concepto,1,2), ca_traorigen, ca_ciudestino
	   order by ca_mes, u.ca_sucursal, i.ca_modalidad, i.ca_traorigen, i.ca_ciudestino, ca_capacidad;
REVOKE ALL ON vi_inocarga_fcl FROM PUBLIC;
GRANT ALL ON vi_inocarga_fcl TO "Administrador";
GRANT ALL ON vi_inocarga_fcl TO GROUP "Usuarios";

Create view vi_inocarga_lcl as
Select substr(i.ca_referencia,8,2)||'-'||substr(i.ca_referencia,15,1) as ca_mes, u.ca_sucursal, i.ca_traorigen, i.ca_ciudestino, sum(c.ca_numpiezas) as ca_numpiezas, sum(c.ca_peso) as ca_peso, sum(c.ca_volumen) as ca_volumen
	   from vi_inomaestra_sea i, tb_inoclientes_sea c, control.tb_usuarios u
	   where i.ca_usucerrado != '' and (i.ca_modalidad = 'LCL' or i.ca_modalidad = 'COLOADING') and i.ca_referencia = c.ca_referencia and c.ca_login = u.ca_login
	   group by substr(i.ca_referencia,8,2)||'-'||substr(i.ca_referencia,15,1), ca_sucursal, i.ca_modalidad, ca_traorigen, ca_ciudestino
	   order by i.ca_traorigen, i.ca_ciudestino, ca_mes, u.ca_sucursal;
REVOKE ALL ON vi_inocarga_lcl FROM PUBLIC;
GRANT ALL ON vi_inocarga_lcl TO "Administrador";
GRANT ALL ON vi_inocarga_lcl TO GROUP "Usuarios";

Create view vi_inonaviera_fcl as
Select substr(i.ca_referencia,8,2)||'-'||substr(i.ca_referencia,15,1) as ca_mes, i.ca_nomtransportista, i.ca_nombre, i.ca_traorigen, i.ca_ciudestino, substr(e.ca_concepto,1,2) as ca_capacidad, sum(e.ca_cantidad) as ca_cantidad
	   from vi_inomaestra_sea i, vi_inoequipos_sea e, tb_inoclientes_sea c
	   where i.ca_usucerrado != '' and i.ca_modalidad = 'FCL' and i.ca_referencia = e.ca_referencia and i.ca_referencia = c.ca_referencia
	   group by substr(i.ca_referencia,8,2)||'-'||substr(i.ca_referencia,15,1), i.ca_nomtransportista, i.ca_nombre, i.ca_modalidad, substr(e.ca_concepto,1,2), ca_traorigen, ca_ciudestino
	   order by ca_mes, i.ca_nomtransportista, i.ca_nombre, i.ca_modalidad, i.ca_traorigen, i.ca_ciudestino, ca_capacidad;
REVOKE ALL ON vi_inonaviera_fcl FROM PUBLIC;
GRANT ALL ON vi_inonaviera_fcl TO "Administrador";
GRANT ALL ON vi_inonaviera_fcl TO GROUP "Usuarios";

Create view vi_inonaviera_lcl as
Select substr(i.ca_referencia,8,2)||'-'||substr(i.ca_referencia,15,1) as ca_mes, i.ca_nomtransportista, i.ca_nombre, i.ca_traorigen, i.ca_ciudestino, sum(c.ca_numpiezas) as ca_numpiezas, sum(c.ca_peso) as ca_peso, sum(c.ca_volumen) as ca_volumen
	   from vi_inomaestra_sea i, tb_inoclientes_sea c
	   where i.ca_usucerrado != '' and (i.ca_modalidad = 'LCL' or i.ca_modalidad = 'COLOADING') and i.ca_referencia = c.ca_referencia
	   group by substr(i.ca_referencia,8,2)||'-'||substr(i.ca_referencia,15,1), i.ca_nomtransportista, i.ca_nombre, i.ca_modalidad, ca_traorigen, ca_ciudestino
	   order by ca_mes, i.ca_nomtransportista, i.ca_nombre, i.ca_traorigen, i.ca_ciudestino;
REVOKE ALL ON vi_inonaviera_lcl FROM PUBLIC;
GRANT ALL ON vi_inonaviera_lcl TO "Administrador";
GRANT ALL ON vi_inonaviera_lcl TO GROUP "Usuarios";

