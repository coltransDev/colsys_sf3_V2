


Create view rp_inoclientes_sea as
Select i.oid as ca_oid, i.ca_referencia, i.ca_idcliente, c.ca_compania, i.ca_idreporte, i.ca_hbls, i.ca_idproveedor, i.ca_proveedor, i.ca_numpiezas, i.ca_peso, i.ca_volumen, i.ca_numorden, i.ca_confirmar, i.ca_login, u.ca_sucursal, i.ca_observaciones, i.ca_fchliberacion, i.ca_notaliberacion,
       i.ca_fchcreado as ca_fchcreado_cl, i.ca_usucreado as ca_usucreado_cl, i.ca_fchactualizado as ca_fchactualizado_cl, i.ca_usuactualizado as ca_usuactualizado_cl, i.ca_usuliberado, i.ca_fchliberado, f.ca_factura, f.ca_fchfactura, f.ca_valor, f.ca_reccaja, f.ca_fchpago, f.ca_tcambio,
	   (select sum(d.ca_valor) from tb_inodeduccion_sea d where f.ca_referencia = d.ca_referencia and f.ca_idcliente = d.ca_idcliente and f.ca_hbls = d.ca_hbls and f.ca_factura = d.ca_factura) as ca_deduccion,
	   (select count(cl.ca_hbls) from tb_inoclientes_sea cl where cl.ca_referencia = i.ca_referencia) as ca_nrohbls,
	   f.ca_fchcreado as ca_fchcreado_fc, f.ca_usucreado as ca_usucreado_fc, f.ca_fchactualizado as ca_fchactualizado_fc, f.ca_usuactualizado as ca_usuactualizado_fc
       from tb_inoclientes_sea i LEFT OUTER JOIN tb_inoingresos_sea f ON (i.ca_referencia = f.ca_referencia and i.ca_idcliente = f.ca_idcliente and i.ca_hbls = f.ca_hbls) LEFT OUTER JOIN tb_clientes c ON (i.ca_idcliente = c.ca_idcliente) LEFT OUTER JOIN control.tb_usuarios u ON (i.ca_login = u.ca_login)
	   order by i.ca_referencia, c.ca_compania, i.ca_hbls, f.ca_factura;

Create view rp_clientes as
Select c.ca_idcliente, c.ca_digito, c.ca_compania, c.ca_papellido, c.ca_sapellido, c.ca_nombres, c.ca_nombres ||' '|| c.ca_papellido ||' '|| c.ca_sapellido as ca_ncompleto, c.ca_saludo, c.ca_sexo, c.ca_cumpleanos, c.ca_direccion, c.ca_oficina, c.ca_torre, c.ca_bloque, c.ca_interior, c.ca_localidad, c.ca_complemento, c.ca_telefonos, c.ca_fax, c.ca_idciudad, cd.ca_ciudad, c.ca_website, c.ca_email, c.ca_actividad, c.ca_sectoreco, c.ca_vendedor, c.ca_status, c.ca_calificacion, c.ca_preferencias, (select max(e.ca_fchvisita) from vi_enccliente e where c.ca_idcliente = e.ca_idcliente) as ca_fchvisita, c.ca_fchcreado, c.ca_usucreado, c.ca_fchactualizado, c.ca_usuactualizado, u.ca_sucursal
       from tb_clientes c, tb_ciudades cd, control.tb_usuarios u where c.ca_idciudad = cd.ca_idciudad and c.ca_vendedor = u.ca_login order by c.ca_compania, ca_ncompleto;
