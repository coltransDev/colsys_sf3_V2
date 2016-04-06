<?php

/**
 */
class ClienteTable extends Doctrine_Table {
    /*
     * Lista los Clientes que hayan cambiado de estado en un determinado periodo de tiempo
     * @author Carlos G. López M.
     */

    public static function estadoClientes($fch_ini, $fch_fin, $empresa, $idcliente, $estado, $sucursal) {
        if ($fch_ini == null) {
            $fch_ini = date('Y-m-d H:i:s', mktime(0, 0, 0, 1, 1, 1900));
        }

        if ($fch_fin == null) {
            $fch_fin = date('Y-m-d H:i:s', mktime(23, 59, 59, date('m'), date('d'), date('Y')));
        }

        //list($ano, $mes, $dia) = sscanf($fch_fin, "%d-%d-%d");
        //$fch_fin = date('Y-m-d h:i:s',mktime(23,59,59, $mes, $dia, $ano)); // Incrementa en un día para tener en cuenta los registros el último día dentro de la consulta
        $query = "select std0.*, vs.ca_fchvisita, u.ca_sucursal, cl.ca_idalterno, cl.ca_compania, cl.ca_vendedor, cl.ca_tipo, cl.ca_entidad, cl.ca_fchcircular, ";
        $query.= "  CASE WHEN cl.ca_tipo IS NOT NULL OR length(cl.ca_tipo::text) <> 0 THEN 'Vigente'::text ELSE CASE WHEN cl.ca_fchcircular IS NULL THEN 'Sin'::text ELSE CASE WHEN (cl.ca_fchcircular + 365) < now() THEN 'Vencido'::text ELSE 'Vigente'::text END END END AS ca_stdcircular ";
        $query.= "FROM tb_stdcliente std0 INNER JOIN vi_clientes_reduc cl ON (std0.ca_idcliente = cl.ca_idcliente) ";
        $query.= "LEFT JOIN vi_usuarios u ON (cl.ca_vendedor = u.ca_login) ";
        $query.= "LEFT JOIN (select ca_idcliente, max(ca_fchvisita) as ca_fchvisita from tb_enccliente where ca_fchvisita <= '$fch_fin' group by ca_idcliente order by ca_idcliente) vs ON (cl.ca_idcliente = vs.ca_idcliente) ";
        $query.= "INNER JOIN (select ca_idcliente, max(ca_fchestado) as ca_fchestado, ca_empresa from tb_stdcliente where ca_fchestado between '$fch_ini' and '$fch_fin' group by ca_idcliente, ca_empresa order by ca_idcliente) std1 ON (std0.ca_idcliente = std1.ca_idcliente) ";
        $query.= "where std0.ca_fchestado = std1.ca_fchestado and std0.ca_empresa = std1.ca_empresa and std0.ca_empresa = '$empresa' and cl.ca_tipo IS NULL ";
        if ($idcliente != null) {
            $query.= "and std0.ca_idcliente = $idcliente ";
        }
        if ($estado != null) {
            $query.= "and std0.ca_estado = '$estado' ";
            if ($estado == 'Activo') {
                $query.= "and (cl.ca_tipo is null  or cl.ca_tipo = '') ";
                $query.= "and cl.ca_entidad = 'Vigente' ";
            }
        }
        if ($sucursal != null) {
            $query.= "and u.ca_sucursal = '$sucursal' ";
        }
        $query.= "order by 7, 6, 5 ";

        // echo "<br />".$query."<br />";
        $q = Doctrine_Manager::getInstance()->connection();
        $stmt = $q->execute($query);
        return $stmt;
    }

    /*
    * Relaciona los negocios de Clientes en un determinado periodo de tiempo, retorna fecha ultimo negocio y sumataria de facturas en un periodo
    * @author Carlos G. López M.
    */
    public static function negociosClientes( $fch_ini, $fch_fin, $empresa, $idcliente ){
            if ($fch_ini == null){
                    $fch_ini = date('Y-m-d',mktime(0, 0, 0, 1, 1, 1900)); }

            if ($fch_fin == null){
                    $fch_fin = date('Y-m-d'); }

            $query = "select cl.ca_idcliente, cl.ca_idalterno, ca_fchnegocio, CASE WHEN ca_numnegocios IS NULL THEN 0 ELSE ca_numnegocios END as ca_numnegocios, CASE WHEN ca_totnegocios IS NULL THEN 0 ELSE ca_totnegocios END as ca_totnegocios                from vi_clientes_reduc cl ";
            if ($empresa == 'Coltrans'){
                $query.= "LEFT JOIN (select ca_idcliente, max(ca_fchcreado) as ca_fchnegocio, count(ca_fchcreado) as ca_totnegocios ";
                $query.= "  from (select ca_idcliente, ca_fchcreado from tb_inoclientes_sea where ca_fchcreado <= '$fch_fin' UNION select ca_idcliente, ca_fchcreado from tb_inoclientes_air  where ca_fchcreado <= '$fch_fin') fc group by ca_idcliente) neg_tot ON (cl.ca_idcliente = neg_tot.ca_idcliente)";
                $query.= "LEFT JOIN (select ca_idcliente, count(ca_fchcreado) as ca_numnegocios ";
                $query.= "  from (select ca_idcliente, ca_fchcreado from tb_inoclientes_sea where ca_fchcreado >= '$fch_ini' and ca_fchcreado <= '$fch_fin' UNION select ca_idcliente, ca_fchcreado from tb_inoclientes_air where ca_fchcreado >= '$fch_ini' and ca_fchcreado <= '$fch_fin') fc group by ca_idcliente) num_neg ON (cl.ca_idcliente = num_neg.ca_idcliente)";
                //$query.= "LEFT OUTER JOIN (select ca_idcliente, max(ca_fchfactura) as ca_fchfactura from (select ca_idcliente, ca_fchfactura from tb_inoingresos_sea where ca_fchfactura <= '$fch_fin' UNION select ca_idcliente, ca_fchfactura from tb_inoingresos_air where ca_fchfactura <= '$fch_fin') fc group by ca_idcliente) fac_fch ON (cl.ca_idcliente = fac_fch.ca_idcliente) ";
                //$query.= "LEFT OUTER JOIN (select ca_idcliente, sum(ca_valor) as ca_valor from (select ca_idcliente, ca_valor from tb_inoingresos_sea where ca_fchfactura between '$fch_ini' and '$fch_fin' UNION select ca_idcliente, (ca_valor*ca_tcalaico) as ca_valor from tb_inoingresos_air where ca_fchfactura between '$fch_ini' and '$fch_fin') fc group by ca_idcliente) fac_val ON (cl.ca_idcliente = fac_val.ca_idcliente) ";
            }else{
                $query.= "LEFT OUTER JOIN (select ca_idcliente, max(ca_fchcreado) as ca_fchnegocio, count(ca_fchcreado) as ca_totnegocios ";
                $query.= "  from (select ca_idcliente, ca_fchcreado from tb_expo_maestra where ca_fchcreado <= '$fch_fin' UNION select ca_idcliente, ca_fchcreado from tb_brk_maestra where ca_fchcreado <= '$fch_fin') fc group by ca_idcliente) neg_tot ON (cl.ca_idcliente = neg_tot.ca_idcliente)";
                $query.= "LEFT OUTER JOIN (select ca_idcliente, count(ca_fchcreado) as ca_numnegocios ";
                $query.= "  from (select ca_idcliente, ca_fchcreado from tb_expo_maestra where ca_fchcreado >= '$fch_ini' and ca_fchcreado <= '$fch_fin' UNION select ca_idcliente, ca_fchcreado from tb_brk_maestra where ca_fchcreado >= '$fch_ini' and ca_fchcreado <= '$fch_fin') fc group by ca_idcliente) num_neg ON (cl.ca_idcliente = num_neg.ca_idcliente)";
                //$query.= "LEFT OUTER JOIN (select ca_idcliente, max(ca_fchfactura) as ca_fchfactura from (select ca_idcliente, ca_fchfactura from tb_brk_ingresos LEFT OUTER JOIN tb_brk_maestra ON tb_brk_ingresos.ca_referencia = tb_brk_maestra.ca_referencia where ca_fchfactura <= '$fch_fin' UNION select ca_idcliente, ca_fchfactura from tb_expo_ingresos where ca_fchfactura <= '$fch_fin') fc group by ca_idcliente) fac_fch ON (cl.ca_idcliente = fac_fch.ca_idcliente) ";
                //$query.= "LEFT OUTER JOIN (select ca_idcliente, sum(ca_valor) as ca_valor from (select ca_idcliente, (ca_valor*ca_tasacambio) as ca_valor from tb_brk_ingresos LEFT OUTER JOIN tb_brk_maestra ON tb_brk_ingresos.ca_referencia = tb_brk_maestra.ca_referencia where ca_fchfactura between '$fch_ini' and '$fch_fin' UNION select ca_idcliente, (ca_valor*ca_tasacambio) as ca_valor from tb_expo_ingresos where ca_fchfactura between '$fch_ini' and '$fch_fin') fc group by ca_idcliente) fac_val ON (cl.ca_idcliente = fac_val.ca_idcliente) ";
            }
            $query.= "where cl.ca_idcliente = $idcliente";

            // echo "<br />".$query."<br />";
            $q = Doctrine_Manager::getInstance()->connection();
            $stmt = $q->execute($query);
            return $stmt;
    }


    /*
     * Relaciona los negocios de Clientes en un determinado periodo de tiempo, retorna fecha ultimo negocio y sumataria de facturas en un periodo
     * @author Carlos G. López M.
     */

    public static function verificacionStdCliente($fch_ini, $fch_fin, $empresa, $idcliente, $fun="min") {
        if ($fch_ini == null) {
            $fch_ini = date('Y-m-d', mktime(0, 0, 0, 1, 1, 1900));
        }

        if ($fch_fin == null) {
            $fch_fin = date('Y-m-d');
        }

        $query = "select cl.ca_idcliente, ca_fchnegocio, ca_numnegocios, ca_estado from vi_clientes_reduc cl ";
        if ($empresa == 'Coltrans') {
            $query.= "  LEFT JOIN (select ca_idcliente, $fun(ca_fchcreado) as ca_fchnegocio from (select ca_idcliente, ca_fchcreado from tb_inoclientes_air where ca_fchcreado between '$fch_ini' and '$fch_fin' UNION select ca_idcliente, ca_fchcreado from tb_inoclientes_sea where ca_fchcreado between '$fch_ini' and '$fch_fin' UNION select ca_idcliente, ca_fchfactura from tb_expo_ingresos where ca_fchfactura between '$fch_ini' and '$fch_fin') fc group by ca_idcliente) neg_fch ON (cl.ca_idcliente = neg_fch.ca_idcliente) ";
            $query.= "  LEFT JOIN (select ca_idcliente, count(ca_idcliente) as ca_numnegocios from (select ca_idcliente from tb_inoclientes_air where to_date(ca_fchcreado::text,'YYYY-MM-DD') between '$fch_ini' and '$fch_fin' UNION select ca_idcliente from tb_inoclientes_sea where to_date(ca_fchcreado::text,'YYYY-MM-DD') between '$fch_ini' and '$fch_fin' UNION select ca_idcliente from tb_expo_ingresos where ca_fchfactura between '$fch_ini' and '$fch_fin') fc group by ca_idcliente) cant_neg ON (cl.ca_idcliente = cant_neg.ca_idcliente) ";
        } else {
            $query.= "  LEFT JOIN (select ca_idcliente, $fun(ca_fchfactura) as ca_fchnegocio from (select ca_idcliente, ca_fchfactura from tb_brk_ingresos LEFT OUTER JOIN tb_brk_maestra ON tb_brk_ingresos.ca_referencia = tb_brk_maestra.ca_referencia where ca_fchfactura between '$fch_ini' and '$fch_fin') fc group by ca_idcliente) fac_fch ON (cl.ca_idcliente = fac_fch.ca_idcliente) ";
            $query.= "  LEFT JOIN (select ca_idcliente, count(ca_factura) as ca_numnegocios from (select ca_idcliente, ca_factura from tb_brk_ingresos LEFT OUTER JOIN tb_brk_maestra ON tb_brk_ingresos.ca_referencia = tb_brk_maestra.ca_referencia where ca_fchfactura between '$fch_ini' and '$fch_fin') fc group by ca_idcliente) cant_neg ON (cl.ca_idcliente = cant_neg.ca_idcliente) ";
        }
        $query.= "LEFT JOIN (select std.ca_idcliente, std.ca_fchestado, std.ca_estado, std.ca_empresa from tb_stdcliente std join ( select sc.ca_idcliente, max(sc.ca_fchestado) AS ca_fchestado, sc.ca_empresa from tb_stdcliente sc where sc.ca_empresa::text = '$empresa'::text and sc.ca_fchestado <= '$fch_fin' group by sc.ca_idcliente, sc.ca_empresa) max on std.ca_idcliente = max.ca_idcliente AND std.ca_fchestado = max.ca_fchestado AND std.ca_empresa::text = max.ca_empresa::text) st1 ON cl.ca_idcliente::numeric = st1.ca_idcliente::numeric ";
        $query.= "where cl.ca_idcliente = $idcliente";

        // echo "<br />".$query."<br />";
        $q = Doctrine_Manager::getInstance()->connection();
        $stmt = $q->execute($query);
        return $stmt;
    }

    /*
     * Relaciona las factura de Clientes en un determinado periodo de tiempo, retorna fecha ultima factura y sumataria de facturas en un periodo
     * @author Carlos G. López M.
     */

    public static function facturacionClientes($fch_ini, $fch_fin, $empresa, $idcliente) {
        if ($fch_ini == null) {
            $fch_ini = date('Y-m-d', mktime(0, 0, 0, 1, 1, 1900));
        }

        if ($fch_fin == null) {
            $fch_fin = date('Y-m-d');
        }

        $query = "select cl.ca_idcliente, ca_fchfactura, ca_valor from vi_clientes_reduc cl ";
        if ($empresa == 'Coltrans') {
            $query.= "LEFT OUTER JOIN (select ca_idcliente, max(ca_fchfactura) as ca_fchfactura from (select ca_idcliente, ca_fchfactura from tb_inoingresos_sea where ca_fchfactura <= '$fch_fin' UNION select ca_idcliente, ca_fchfactura from tb_inoingresos_air where ca_fchfactura <= '$fch_fin') fc group by ca_idcliente) fac_fch ON (cl.ca_idcliente = fac_fch.ca_idcliente) ";
            $query.= "LEFT OUTER JOIN (select ca_idcliente, sum(ca_valor) as ca_valor from (select ca_idcliente, ca_valor from tb_inoingresos_sea where ca_fchfactura between '$fch_ini' and '$fch_fin' UNION select ca_idcliente, (ca_valor*ca_tcalaico) as ca_valor from tb_inoingresos_air where ca_fchfactura between '$fch_ini' and '$fch_fin') fc group by ca_idcliente) fac_val ON (cl.ca_idcliente = fac_val.ca_idcliente) ";
        } else {
            $query.= "LEFT OUTER JOIN (select ca_idcliente, max(ca_fchfactura) as ca_fchfactura from (select ca_idcliente, ca_fchfactura from tb_brk_ingresos LEFT OUTER JOIN tb_brk_maestra ON tb_brk_ingresos.ca_referencia = tb_brk_maestra.ca_referencia where ca_fchfactura <= '$fch_fin' UNION select ca_idcliente, ca_fchfactura from tb_expo_ingresos where ca_fchfactura <= '$fch_fin') fc group by ca_idcliente) fac_fch ON (cl.ca_idcliente = fac_fch.ca_idcliente) ";
            $query.= "LEFT OUTER JOIN (select ca_idcliente, sum(ca_valor) as ca_valor from (select ca_idcliente, (ca_valor*ca_tasacambio) as ca_valor from tb_brk_ingresos LEFT OUTER JOIN tb_brk_maestra ON tb_brk_ingresos.ca_referencia = tb_brk_maestra.ca_referencia where ca_fchfactura between '$fch_ini' and '$fch_fin' UNION select ca_idcliente, (ca_valor*ca_tasacambio) as ca_valor from tb_expo_ingresos where ca_fchfactura between '$fch_ini' and '$fch_fin') fc group by ca_idcliente) fac_val ON (cl.ca_idcliente = fac_val.ca_idcliente) ";
        }
        $query.= "where cl.ca_idcliente = $idcliente";

        // echo "<br />".$query."<br />";
        $q = Doctrine_Manager::getInstance()->connection();
        $stmt = $q->execute($query);
        return $stmt;
    }

    /*
     * Relaciona los términos de negociación de los Negocios Reportadors por el Clientes en un determinado periodo de tiempo.
     * @author Carlos G. López M.
     */

    public static function terminosClientes($fch_ini, $fch_fin, $idcliente) {
        if ($fch_ini == null) {
            $fch_ini = date('Y-m-d', mktime(0, 0, 0, 1, 1, 1900));
        }

        if ($fch_fin == null) {
            $fch_fin = date('Y-m-d');
        }

        $query = "select DISTINCT cc.ca_idcliente, rps.ca_incoterms from tb_reportes rps ";
        $query.= "INNER JOIN tb_concliente cc ON (rps.ca_idconcliente = cc.ca_idcontacto) ";
        $query.= "where rps.ca_version = fun_last_version(ca_consecutivo) and rps.ca_incoterms != '' and rps.ca_incoterms IS NOT NULL ";
        $query.= "and cc.ca_idcliente = $idcliente and rps.ca_fchreporte between '$fch_ini' and '$fch_fin'";

        // echo "<br />".$query."<br />";
        $q = Doctrine_Manager::getInstance()->connection();
        $stmt = $q->execute($query);
        return $stmt;
    }

    /*
     * Lista los Clientes Activos que tengan vencimiento de su Circular 170 en los próximos 30 días a partir de una fecha específicada.
     * @author Carlos G. López M.
     */

    public static function circularClientes($fch_ini, $fch_fin, $sucursal, $vendedor) {
        if ($fch_ini == null) {
            $fch_ini = date('Y-m-d', mktime(0, 0, 0, date('m') + 1, 1, date('Y')));
        }

        if ($fch_fin == null) {
            $fch_fin = date('Y-m-d', mktime(0, 0, 0, date('m') + 2, 0, date('Y')));
        }

        $query = "select c.ca_idcliente, c.ca_idalterno, c.ca_digito, c.ca_compania, replace(c.ca_direccion,'|',' ') as ca_direccion, c.ca_oficina, c.ca_torre, c.ca_bloque, c.ca_interior, c.ca_localidad, c.ca_complemento, c.ca_telefonos, c.ca_fax, d.ca_ciudad, ";
        $query.= "ca_fchcircular, to_date(to_char(to_char(ca_fchcircular, 'YYYY')::int+1, '9999')||'-'||to_char(ca_fchcircular, 'MM')||'-'||to_char(ca_fchcircular, 'DD'),'YYYY-MM-DD') as ca_vnccircular, ct.ca_coltrans_std, cm.ca_colmas_std, c.ca_vendedor, u.ca_nombre, u.ca_sucursal from vi_clientes_reduc c ";
        $query.= "LEFT OUTER JOIN vi_usuarios u ON (c.ca_vendedor = u.ca_login) ";
        $query.= "LEFT OUTER JOIN tb_ciudades d ON (c.ca_idciudad = d.ca_idciudad) ";
        $query.= "LEFT OUTER JOIN (select colt.ca_idcliente as ca_idcliente_colt, colt.ca_estado as ca_coltrans_std, colt.ca_fchestado as ca_coltrans_fch from tb_stdcliente colt INNER JOIN (select ca_idcliente, max(ca_fchestado) as ca_fchestado from tb_stdcliente where ca_empresa = 'Coltrans' and ca_fchestado <= '$fch_fin' group by ca_idcliente order by ca_idcliente) sub ON (colt.ca_idcliente = sub.ca_idcliente and colt.ca_fchestado = sub.ca_fchestado and colt.ca_empresa = 'Coltrans')) ct ON (ct.ca_idcliente_colt = c.ca_idcliente) ";
        $query.= "LEFT OUTER JOIN (select colm.ca_idcliente as ca_idcliente_colm, colm.ca_estado as ca_colmas_std, colm.ca_fchestado as ca_colmas_fch from tb_stdcliente colm INNER JOIN (select ca_idcliente, max(ca_fchestado) as ca_fchestado from tb_stdcliente where ca_empresa = 'Colmas' and ca_fchestado <= '$fch_fin' group by ca_idcliente order by ca_idcliente) sub ON (colm.ca_idcliente = sub.ca_idcliente and colm.ca_fchestado = sub.ca_fchestado and colm.ca_empresa = 'Colmas')) cm ON (cm.ca_idcliente_colm = c.ca_idcliente) ";
        $query.= "where to_date(to_char(to_char(ca_fchcircular, 'YYYY')::int+1, '9999')||'-'||to_char(ca_fchcircular, 'MM')||'-'||to_char(ca_fchcircular, 'DD'),'YYYY-MM-DD') between '$fch_ini' and '$fch_fin' and (ct.ca_coltrans_std = 'Activo' or cm.ca_colmas_std = 'Activo') ";

        if ($sucursal != null) {
            $query.= "and u.ca_sucursal = '$sucursal' ";
        }
        if ($vendedor != null) {
            $query.= "and u.ca_login = '$vendedor' ";
        }
        $query.= "order by ca_sucursal, ca_vendedor, ca_vnccircular ";

        // echo "<br />".$query."<br />";
        $q = Doctrine_Manager::getInstance()->connection();
        $stmt = $q->execute($query);
        return $stmt;
    }

    /*
     * Lista los Clientes Activos que tengan vencimiento de su Carta de Garantía en los próximos 30 días a partir de una fecha específicada.
     * @author Carlos G. López M.
     */

    public static function cartaGarantiaClientes($fch_ini, $fch_fin, $sucursal, $vendedor) {
        if ($fch_ini == null) {
            $fch_ini = date('Y-m-d', mktime(0, 0, 0, date('m') + 1, 1, date('Y')));
        }

        if ($fch_fin == null) {
            $fch_fin = date('Y-m-d', mktime(0, 0, 0, date('m') + 2, 0, date('Y')));
        }

        $query = "select c.ca_idalterno, c.ca_digito, c.ca_compania, replace(c.ca_direccion,'|',' ') as ca_direccion, c.ca_oficina, c.ca_torre, c.ca_bloque, c.ca_interior, c.ca_localidad, c.ca_complemento, c.ca_telefonos, c.ca_fax, d.ca_ciudad, cn.ca_fchfirmado, cn.ca_fchvencimiento, ct.ca_coltrans_std, cm.ca_colmas_std, c.ca_vendedor, u.ca_nombre, u.ca_sucursal from ";
        $query.= "(SELECT cf.ca_idcliente, cf.ca_fchfirmado, cm.ca_fchvencimiento FROM ( SELECT tb_comcliente.ca_idcliente, max(tb_comcliente.ca_fchfirmado) AS ca_fchfirmado FROM tb_comcliente GROUP BY tb_comcliente.ca_idcliente) cf JOIN ( SELECT tb_comcliente.ca_idcliente, tb_comcliente.ca_fchfirmado, tb_comcliente.ca_fchvencimiento FROM tb_comcliente WHERE tb_comcliente.ca_fchanulado IS NULL) cm ON cf.ca_idcliente = cm.ca_idcliente AND cf.ca_fchfirmado = cm.ca_fchfirmado) cn ";
        $query.= "INNER JOIN vi_clientes_reduc c ON c.ca_idcliente = cn.ca_idcliente ";
        $query.= "LEFT OUTER JOIN vi_usuarios u ON (c.ca_vendedor = u.ca_login) ";
        $query.= "LEFT OUTER JOIN tb_ciudades d ON (c.ca_idciudad = d.ca_idciudad) ";
        $query.= "LEFT OUTER JOIN (select colt.ca_idcliente as ca_idcliente_colt, colt.ca_estado as ca_coltrans_std, colt.ca_fchestado as ca_coltrans_fch from tb_stdcliente colt INNER JOIN (select ca_idcliente, max(ca_fchestado) as ca_fchestado from tb_stdcliente where ca_empresa = 'Coltrans' and ca_fchestado <= '$fch_fin' group by ca_idcliente order by ca_idcliente) sub ON (colt.ca_idcliente = sub.ca_idcliente and colt.ca_fchestado = sub.ca_fchestado and colt.ca_empresa = 'Coltrans')) ct ON (ct.ca_idcliente_colt = c.ca_idcliente) ";
        $query.= "LEFT OUTER JOIN (select colm.ca_idcliente as ca_idcliente_colm, colm.ca_estado as ca_colmas_std, colm.ca_fchestado as ca_colmas_fch from tb_stdcliente colm INNER JOIN (select ca_idcliente, max(ca_fchestado) as ca_fchestado from tb_stdcliente where ca_empresa = 'Colmas' and ca_fchestado <= '$fch_fin' group by ca_idcliente order by ca_idcliente) sub ON (colm.ca_idcliente = sub.ca_idcliente and colm.ca_fchestado = sub.ca_fchestado and colm.ca_empresa = 'Colmas')) cm ON (cm.ca_idcliente_colm = c.ca_idcliente) ";
/*        
        $query.= "RIGHT JOIN ( ";
        $query.= "SELECT cf.ca_idcliente, cf.ca_fchfirmado, cm.ca_fchvencimiento ";
        $query.= "   FROM ( SELECT tb_comcliente.ca_idcliente, max(tb_comcliente.ca_fchfirmado) AS ca_fchfirmado ";
        $query.= "	   FROM tb_comcliente ";
        $query.= "	  GROUP BY tb_comcliente.ca_idcliente) cf ";
        $query.= "   JOIN ( SELECT tb_comcliente.ca_idcliente, tb_comcliente.ca_fchfirmado, tb_comcliente.ca_fchvencimiento ";
        $query.= "	   FROM tb_comcliente ";
        $query.= "	  WHERE tb_comcliente.ca_fchanulado IS NULL) cm ON cf.ca_idcliente = cm.ca_idcliente AND cf.ca_fchfirmado = cm.ca_fchfirmado ";
        $query.= ") cn ON c.ca_idcliente = cn.ca_idcliente ";
*/        
        $query.= "where cn.ca_fchvencimiento between '$fch_ini' and '$fch_fin' and (ct.ca_coltrans_std = 'Activo' or cm.ca_colmas_std = 'Activo') ";
        
        if ($sucursal != null) {
            $query.= "and u.ca_sucursal = '$sucursal' ";
        }
        if ($vendedor != null) {
            $query.= "and u.ca_login = '$vendedor' ";
        }
        $query.= "order by ca_sucursal, ca_vendedor, ca_fchvencimiento ";

        $q = Doctrine_Manager::getInstance()->connection();
        $stmt = $q->execute($query);
        return $stmt;
    }

    /*
     * Lista los Clientes Activos que tengan vencimiento de sus Mandatos en los próximos 30 días a partir de una fecha específicada.
     * @author Carlos G. López M.
     */

    public static function controlMandatosClientes($fch_ini, $fch_fin, $sucursal, $vendedor) {
        if ($fch_ini == null) {
            $fch_ini = date('Y-m-d', mktime(0, 0, 0, date('m') + 1, 1, date('Y')));
        }

        if ($fch_fin == null) {
            $fch_fin = date('Y-m-d', mktime(0, 0, 0, date('m') + 2, 0, date('Y')));
        }

        $query = "select c.ca_idalterno, c.ca_digito, c.ca_compania, replace(c.ca_direccion,'|',' ') as ca_direccion, c.ca_oficina, c.ca_torre, c.ca_bloque, c.ca_interior, c.ca_localidad, c.ca_complemento, c.ca_telefonos, c.ca_fax, d.ca_ciudad, mn.ca_lugar, mn.ca_clase, mn.ca_tipo, mn.ca_fchradicado, mn.ca_fchvencimiento, ct.ca_coltrans_std, cm.ca_colmas_std, c.ca_vendedor, u.ca_nombre, u.ca_sucursal from ";
        $query.= "(select mc.ca_idcliente, mt.ca_clase, mt.ca_tipo, cd.ca_ciudad as ca_lugar, mc.ca_fchradicado, mc.ca_fchvencimiento from tb_mancliente mc inner join tb_ciudades cd on cd.ca_idciudad = mc.ca_idciudad inner join tb_mandatos_tipo mt on mt.ca_idtipo = mc.ca_idtipo where mc.ca_fchvencimiento between '$fch_ini' and '$fch_fin') mn ";
        $query.= "INNER JOIN vi_clientes_reduc c ON c.ca_idcliente = mn.ca_idcliente ";
        $query.= "LEFT OUTER JOIN vi_usuarios u ON (c.ca_vendedor = u.ca_login) ";
        $query.= "LEFT OUTER JOIN tb_ciudades d ON (c.ca_idciudad = d.ca_idciudad) ";
        $query.= "LEFT OUTER JOIN (select colt.ca_idcliente as ca_idcliente_colt, colt.ca_estado as ca_coltrans_std, colt.ca_fchestado as ca_coltrans_fch from tb_stdcliente colt INNER JOIN (select ca_idcliente, max(ca_fchestado) as ca_fchestado from tb_stdcliente where ca_empresa = 'Coltrans' and ca_fchestado <= '$fch_fin' group by ca_idcliente order by ca_idcliente) sub ON (colt.ca_idcliente = sub.ca_idcliente and colt.ca_fchestado = sub.ca_fchestado and colt.ca_empresa = 'Coltrans')) ct ON (ct.ca_idcliente_colt = c.ca_idcliente) ";
        $query.= "LEFT OUTER JOIN (select colm.ca_idcliente as ca_idcliente_colm, colm.ca_estado as ca_colmas_std, colm.ca_fchestado as ca_colmas_fch from tb_stdcliente colm INNER JOIN (select ca_idcliente, max(ca_fchestado) as ca_fchestado from tb_stdcliente where ca_empresa = 'Colmas' and ca_fchestado <= '$fch_fin' group by ca_idcliente order by ca_idcliente) sub ON (colm.ca_idcliente = sub.ca_idcliente and colm.ca_fchestado = sub.ca_fchestado and colm.ca_empresa = 'Colmas')) cm ON (cm.ca_idcliente_colm = c.ca_idcliente) ";
        $query.= "where mn.ca_fchvencimiento between '$fch_ini' and '$fch_fin' and (ct.ca_coltrans_std = 'Activo' or cm.ca_colmas_std = 'Activo') ";
        
        if ($sucursal != null) {
            $query.= "and u.ca_sucursal = '$sucursal' ";
        }
        if ($vendedor != null) {
            $query.= "and u.ca_login = '$vendedor' ";
        }
        $query.= "order by ca_sucursal, ca_vendedor, ca_fchvencimiento ";

        $q = Doctrine_Manager::getInstance()->connection();
        $stmt = $q->execute($query);
        return $stmt;
    }
    
    /*
     * Lista los Clientes que NO tengan Circular 170.
     * @author Carlos G. López M.
     */

    public static function clientesSinCircular($fch_fin, $sucursal, $vendedor) {
        if ($fch_fin == null) {
            $fch_fin = date('Y-m-d', mktime(0, 0, 0, date('m') + 2, 0, date('Y')));
        }

        $query = "select c.ca_idcliente, c.ca_idalterno, c.ca_digito, c.ca_compania, replace(c.ca_direccion,'|',' ') as ca_direccion, c.ca_oficina, c.ca_torre, c.ca_bloque, c.ca_interior, c.ca_localidad, c.ca_complemento, c.ca_telefonos, c.ca_fax, d.ca_ciudad, ";
        $query.= "ct.ca_coltrans_std, cm.ca_colmas_std, c.ca_vendedor, u.ca_nombre, u.ca_sucursal from vi_clientes_reduc c ";
        $query.= "LEFT OUTER JOIN vi_usuarios u ON (c.ca_vendedor = u.ca_login) ";
        $query.= "LEFT OUTER JOIN tb_ciudades d ON (c.ca_idciudad = d.ca_idciudad) ";
        $query.= "LEFT OUTER JOIN (select colt.ca_idcliente as ca_idcliente_colt, colt.ca_estado as ca_coltrans_std, colt.ca_fchestado as ca_coltrans_fch from tb_stdcliente colt INNER JOIN (select ca_idcliente, max(ca_fchestado) as ca_fchestado from tb_stdcliente where ca_empresa = 'Coltrans' and ca_fchestado <= '$fch_fin' group by ca_idcliente order by ca_idcliente) sub ON (colt.ca_idcliente = sub.ca_idcliente and colt.ca_fchestado = sub.ca_fchestado and colt.ca_empresa = 'Coltrans')) ct ON (ct.ca_idcliente_colt = c.ca_idcliente) ";
        $query.= "LEFT OUTER JOIN (select colm.ca_idcliente as ca_idcliente_colm, colm.ca_estado as ca_colmas_std, colm.ca_fchestado as ca_colmas_fch from tb_stdcliente colm INNER JOIN (select ca_idcliente, max(ca_fchestado) as ca_fchestado from tb_stdcliente where ca_empresa = 'Colmas' and ca_fchestado <= '$fch_fin' group by ca_idcliente order by ca_idcliente) sub ON (colm.ca_idcliente = sub.ca_idcliente and colm.ca_fchestado = sub.ca_fchestado and colm.ca_empresa = 'Colmas')) cm ON (cm.ca_idcliente_colm = c.ca_idcliente) ";
        $query.= "where ca_fchcircular IS NULL and (ct.ca_coltrans_std = 'Activo' or cm.ca_colmas_std = 'Activo') ";

        if ($sucursal != null) {
            $query.= "and u.ca_sucursal = '$sucursal' ";
        }
        if ($vendedor != null) {
            $query.= "and u.ca_login = '$vendedor' ";
        }
        $query.= "order by ca_sucursal, ca_vendedor ";

        // echo "<br />".$query."<br />";
        $q = Doctrine_Manager::getInstance()->connection();
        $stmt = $q->execute($query);
        return $stmt;
    }

    /*
     * Lista los Clientes Activos que NO tengan Encuesta de Visita.
     * @author Carlos G. López M.
     */

    public static function clientesEncVisita($fch_fin, $sucursal, $vendedor, $tipo = "Sin") {
        if ($fch_fin == null) {
            $fch_fin = date('Y-m-d', mktime(0, 0, 0, date('m') + 2, 0, date('Y')));
        }

        $query = "select c.ca_idcliente, c.ca_idalterno, c.ca_digito, c.ca_compania, replace(c.ca_direccion,'|',' ') as ca_direccion, c.ca_oficina, c.ca_torre, c.ca_bloque, c.ca_interior, c.ca_localidad, c.ca_complemento, c.ca_telefonos, c.ca_fax, d.ca_ciudad, ";
        $query.= "ct.ca_coltrans_std, cm.ca_colmas_std, c.ca_vendedor, e.ca_fchvisita, u.ca_nombre, u.ca_sucursal from vi_clientes_reduc c ";
        $query.= "LEFT OUTER JOIN vi_usuarios u ON (c.ca_vendedor = u.ca_login) ";
        $query.= "LEFT OUTER JOIN tb_ciudades d ON (c.ca_idciudad = d.ca_idciudad) ";
        $query.= "LEFT OUTER JOIN (select ca_idcliente, max(ca_fchvisita) as ca_fchvisita from tb_enccliente group by ca_idcliente) e ON (e.ca_idcliente = c.ca_idcliente) ";
        $query.= "LEFT OUTER JOIN (select colt.ca_idcliente as ca_idcliente_colt, colt.ca_estado as ca_coltrans_std, colt.ca_fchestado as ca_coltrans_fch from tb_stdcliente colt INNER JOIN (select ca_idcliente, max(ca_fchestado) as ca_fchestado from tb_stdcliente where ca_empresa = 'Coltrans' and ca_fchestado <= '$fch_fin' group by ca_idcliente order by ca_idcliente) sub ON (colt.ca_idcliente = sub.ca_idcliente and colt.ca_fchestado = sub.ca_fchestado and colt.ca_empresa = 'Coltrans')) ct ON (ct.ca_idcliente_colt = c.ca_idcliente) ";
        $query.= "LEFT OUTER JOIN (select colm.ca_idcliente as ca_idcliente_colm, colm.ca_estado as ca_colmas_std, colm.ca_fchestado as ca_colmas_fch from tb_stdcliente colm INNER JOIN (select ca_idcliente, max(ca_fchestado) as ca_fchestado from tb_stdcliente where ca_empresa = 'Colmas' and ca_fchestado <= '$fch_fin' group by ca_idcliente order by ca_idcliente) sub ON (colm.ca_idcliente = sub.ca_idcliente and colm.ca_fchestado = sub.ca_fchestado and colm.ca_empresa = 'Colmas')) cm ON (cm.ca_idcliente_colm = c.ca_idcliente) ";
        if ($tipo=="Sin"){
           $query.= "where ca_fchvisita IS NULL and (ct.ca_coltrans_std = 'Activo' or cm.ca_colmas_std = 'Activo') ";
        }else if ($tipo=="Ven"){
           list($ano, $mes, $dia) = sscanf($fch_fin, "%d-%d-%d");       // Calcula Fecha de corte un año atrás para sacar visitas vencidas
           $fch_fin = date("Y-m-d", mktime(0, 0, 0, $mes, $dia, $ano-1));
           $query.= "where ca_fchvisita <= '$fch_fin' and (ct.ca_coltrans_std = 'Activo' or cm.ca_colmas_std = 'Activo') ";
        }

        if ($sucursal != null) {
            $query.= "and u.ca_sucursal = '$sucursal' ";
        }
        if ($vendedor != null) {
            $query.= "and u.ca_login = '$vendedor' ";
        }
        $query.= "order by ca_sucursal, ca_vendedor ";

        // echo "<br />".$query."<br />";
        $q = Doctrine_Manager::getInstance()->connection();
        $stmt = $q->execute($query);
        return $stmt;
    }

     /*
     * Lista los Clientes Potenciales que no tengan seguimientos en los últimos X meses a partir de una fecha específicada.
     * @author Carlos G. López M.
     */

    public static function actividadEnClientes($fch_ini, $fch_fin, $sucursal, $vendedor, $estado = 'Potencial') {
        if ($fch_ini == null) {
            $fch_ini = date('Y-m-d H:i:s', mktime(0, 0, 0, 1, 1, 1900));
        }

        if ($fch_fin == null) {
            $fch_fin = date('Y-m-d H:i:s', mktime(23, 59, 59, date('m'), date('d'), date('Y')));
        }

        $query = "SELECT c.ca_idcliente, c.ca_idalterno, ca_digito, c.ca_compania, c.ca_vendedor, c.ca_sucursal, c.ca_fchcreado::date as ca_fchcreado_clie, cot.ca_cotizacion_last, rep.ca_reporte_last, seg.ca_seguimiento_last, eve.ca_evento_max, c.ca_coltrans_std, c.ca_coltrans_fch::date, c.ca_colmas_std, c.ca_colmas_fch::date ";
        $query.= "FROM vi_clientes c ";
        $query.= "LEFT JOIN (select cl.ca_idcliente, max(co.ca_fchcreado)::date as ca_cotizacion_last, count(co.ca_idcotizacion) as ca_cotizaciones from tb_cotizaciones co inner join tb_concliente cl on co.ca_idcontacto = cl.ca_idcontacto where co.ca_fchcreado <= '$fch_fin' group by cl.ca_idcliente order by cl.ca_idcliente) cot ON c.ca_idcliente = cot.ca_idcliente ";
        $query.= "LEFT JOIN (select cl.ca_idcliente, max(rp.ca_fchreporte)::date as ca_reporte_last, count(rp.ca_idreporte) as ca_reportes from tb_reportes rp inner join tb_concliente cl on rp.ca_idconcliente = cl.ca_idcontacto where rp.ca_fchreporte <= '$fch_fin' group by cl.ca_idcliente order by cl.ca_idcliente) rep ON c.ca_idcliente = rep.ca_idcliente ";
        $query.= "LEFT JOIN (select cl.ca_idcliente, max(sg.ca_fchseguimiento)::date as ca_seguimiento_last, count(sg.ca_idseguimiento) as ca_seguimientos_cot from tb_cotseguimientos sg inner join tb_cotproductos pr on sg.ca_idproducto = pr.ca_idproducto inner join tb_cotizaciones ct on ct.ca_idcotizacion = pr.ca_idcotizacion inner join tb_concliente cl on ct.ca_idcontacto = cl.ca_idcontacto where sg.ca_fchseguimiento <= '$fch_fin' group by cl.ca_idcliente order by cl.ca_idcliente) seg ON c.ca_idcliente = seg.ca_idcliente ";
        $query.= "LEFT JOIN (select cl.ca_idcliente, max(ev.ca_fchevento)::date as ca_evento_max, count(ev.ca_idevento) as ca_seguimientos_cli from tb_evecliente ev inner join tb_clientes cl on ev.ca_idcliente = cl.ca_idcliente where ev.ca_fchevento <= '$fch_fin' group by cl.ca_idcliente order by cl.ca_idcliente) eve ON c.ca_idcliente = eve.ca_idcliente ";
        $query.= "where c.ca_coltrans_std = '$estado' and c.ca_colmas_std = '$estado' ";

        if ($sucursal != null) {
            $query.= "and c.ca_sucursal = '$sucursal' ";
        }
        if ($vendedor != null) {
            $query.= "and c.ca_vendedor = '$vendedor' ";
        }
        $query.= "order by ca_sucursal, ca_vendedor, ca_compania ";

        // echo "<br />".$query."<br />";
        $q = Doctrine_Manager::getInstance()->connection();
        $stmt = $q->execute($query);
        return $stmt;
    }


     /*
     * Libera los Clientes Potenciales que no tengan seguimientos en los últimos X meses a partir de una fecha específicada.
     * @author Carlos G. López M.
     */

    public static function liberarClientesSinSeguimiento($fch_ini, $fch_fin, $clientesSinSeguimiento) {
        set_time_limit(0);
        $liberado = array();
        $q = Doctrine_Manager::getInstance()->connection();
        foreach ($clientesSinSeguimiento as $clienteSinSeguimiento){
            $fechas = array($clienteSinSeguimiento["ca_fchcreado_clie"], $clienteSinSeguimiento["ca_cotizacion_last"], $clienteSinSeguimiento["ca_reporte_last"], $clienteSinSeguimiento["ca_seguimiento_last"], $clienteSinSeguimiento["ca_evento_max"]);
            rsort($fechas);
            if ($fechas[0]<$fch_fin){
                $sql =  "select ca_idcliente, ca_vendedor, sc.ca_nombre as ca_sucursal from tb_clientes cl inner join control.tb_usuarios us on us.ca_login = cl.ca_vendedor inner join control.tb_sucursales sc on sc.ca_idsucursal = us.ca_idsucursal where ca_idcliente = ".$clienteSinSeguimiento["ca_idcliente"];
                $stmt = $q->execute($sql);
                $row = $stmt->fetch();
                
                if ($row["ca_sucursal"] != ""){
                    $parametros = Doctrine::getTable("Parametro")->retrieveByCaso("CU238", $row["ca_sucursal"]);
                    if ($parametros){
                        foreach($parametros as $parametro) {
                            $cuentas = explode(",", $parametro->getCaValor2());
                            if (!in_array($row["ca_vendedor"], $cuentas)){
                                $query = "update tb_clientes set ca_vendedor = '".$cuentas[0]."', ca_usuactualizado = 'Administrador', ca_fchactualizado = '".date("Y-m-d H:i:s")."' where ca_idcliente = ".$clienteSinSeguimiento["ca_idcliente"];
                                $q->execute($query);
                                $liberado[] = $row["ca_idcliente"];
                            }
                        }
                    }
                }
            }
        }
        return $liberado;
    }
    
    
    /*
     * Lista los Clientes Activos para hacer analisis de la fluctuación de sus negocios.
     * @author Carlos G. López M.
     */

    public static function negociosEnClientes($fch_ini, $fch_fin, $sucursal, $vendedor, $estado = 'Activo') {
        if ($fch_ini == null) {
            $fch_ini = date('Y-m-d H:i:s', mktime(0, 0, 0, 1, 1, 1900));
        }

        if ($fch_fin == null) {
            $fch_fin = date('Y-m-d H:i:s', mktime(23, 59, 59, date('m'), date('d'), date('Y')));
        }
        
        $query = "select od.*, cl.ca_idalterno, cl.ca_digito, cl.ca_compania, cl.ca_vendedor, cl.ca_sucursal, cl.ca_coltrans_std, cl.ca_coltrans_fch, cl.ca_colmas_std, cl.ca_colmas_fch from ";
        $query.= "( ";
        $query.= "  select date_part('year', ai.ca_fchreferencia) as ca_ano, (string_to_array(ac.ca_referencia,'.'))[3] as ca_mes, ai.ca_fchreferencia, ac.ca_referencia, ac.ca_hawb as ca_doctransporte, ac.ca_idcliente from tb_inoclientes_air ac inner join tb_inomaestra_air ai on ac.ca_referencia = ai.ca_referencia union ";
        $query.= "  select date_part('year', mi.ca_fchreferencia) as ca_ano, (string_to_array(mc.ca_referencia,'.'))[3] as ca_mes, mi.ca_fchreferencia, mc.ca_referencia, mc.ca_hbls as ca_doctransporte, mc.ca_idcliente from tb_inoclientes_sea mc inner join tb_inomaestra_sea mi on mc.ca_referencia = mi.ca_referencia union ";
        $query.= "  select date_part('year', em.ca_fchreferencia) as ca_ano, (string_to_array(em.ca_referencia,'.'))[3] as ca_mes, em.ca_fchreferencia, em.ca_referencia, ei.ca_documento as ca_doctransporte, em.ca_idcliente from tb_expo_maestra em inner join tb_expo_ingresos ei on em.ca_referencia = ei.ca_referencia union ";
        $query.= "  select date_part('year', am.ca_fchreferencia) as ca_ano, (string_to_array(am.ca_referencia,'.'))[3] as ca_mes, am.ca_fchreferencia, am.ca_referencia, am.ca_pedido as ca_doctransporte, am.ca_idcliente from tb_brk_maestra am ";
        $query.= ") od inner join vi_clientes cl on cl.ca_idcliente = od.ca_idcliente ";
        $query.= "where ca_fchreferencia between '$fch_ini' and '$fch_fin' and (cl.ca_coltrans_std = '$estado' or cl.ca_colmas_std = '$estado') ";

        if ($sucursal != null) {
            $query.= "and cl.ca_sucursal = '$sucursal' ";
        }
        if ($vendedor != null) {
            $query.= "and cl.ca_vendedor = '$vendedor' ";
        }
        $query.= "order by ca_ano, ca_mes, ca_sucursal, ca_vendedor, ca_compania ";

        // echo "<br />".$query."<br />";
        $q = Doctrine_Manager::getInstance()->connection();
        $stmt = $q->execute($query);
        return $stmt;
    }

   /*
     * Lista los Clientes Activos que perderán Beneficios Crediticios, Tiempo y Cupo de Crédito por vencimiento de circular.
     * @author Carlos G. López M.
     */

    public static function pierdenBeneficios($fch_fin, $sucursal, $vendedor) {
        if ($fch_fin == null) {
            $fch_fin = date('Y-m-d', mktime(0, 0, 0, date('m') + 2, 0, date('Y')));
        }

        $query = "select c.ca_idcliente, c.ca_digito, c.ca_compania, replace(c.ca_direccion,'|',' ') as ca_direccion, c.ca_oficina, c.ca_torre, c.ca_bloque, c.ca_interior, c.ca_localidad, c.ca_complemento, c.ca_telefonos, c.ca_fax, d.ca_ciudad, ";
        $query.= "ca_fchcircular, to_date(to_char(to_char(ca_fchcircular, 'YYYY')::int+1, '9999')||'-'||to_char(ca_fchcircular, 'MM')||'-'||to_char(ca_fchcircular, 'DD'),'YYYY-MM-DD') as ca_vnccircular, ct.ca_coltrans_std, cm.ca_colmas_std, c.ca_vendedor, u.ca_nombre, u.ca_sucursal, l.ca_cupo, l.ca_diascredito from tb_libcliente l ";
        $query.= "LEFT OUTER JOIN vi_clientes_reduc c ON (l.ca_idcliente = c.ca_idcliente)";
        $query.= "LEFT OUTER JOIN vi_usuarios u ON (c.ca_vendedor = u.ca_login) ";
        $query.= "LEFT OUTER JOIN tb_ciudades d ON (c.ca_idciudad = d.ca_idciudad) ";
        $query.= "LEFT OUTER JOIN (select colt.ca_idcliente as ca_idcliente_colt, colt.ca_estado as ca_coltrans_std, colt.ca_fchestado as ca_coltrans_fch from tb_stdcliente colt INNER JOIN (select ca_idcliente, max(ca_fchestado) as ca_fchestado from tb_stdcliente where ca_empresa = 'Coltrans' and ca_fchestado <= '$fch_fin' group by ca_idcliente order by ca_idcliente) sub ON (colt.ca_idcliente = sub.ca_idcliente and colt.ca_fchestado = sub.ca_fchestado and colt.ca_empresa = 'Coltrans')) ct ON (ct.ca_idcliente_colt = c.ca_idcliente) ";
        $query.= "LEFT OUTER JOIN (select colm.ca_idcliente as ca_idcliente_colm, colm.ca_estado as ca_colmas_std, colm.ca_fchestado as ca_colmas_fch from tb_stdcliente colm INNER JOIN (select ca_idcliente, max(ca_fchestado) as ca_fchestado from tb_stdcliente where ca_empresa = 'Colmas' and ca_fchestado <= '$fch_fin' group by ca_idcliente order by ca_idcliente) sub ON (colm.ca_idcliente = sub.ca_idcliente and colm.ca_fchestado = sub.ca_fchestado and colm.ca_empresa = 'Colmas')) cm ON (cm.ca_idcliente_colm = c.ca_idcliente) ";
        $query.= "where ( ca_fchcircular IS NULL OR to_date(to_char(to_char(ca_fchcircular, 'YYYY')::int+1, '9999')||'-'||to_char(ca_fchcircular, 'MM')||'-'||to_char(ca_fchcircular, 'DD'),'YYYY-MM-DD') <= '$fch_fin') and (ca_diascredito != 0 or ca_cupo != 0) and (ct.ca_coltrans_std = 'Activo' or cm.ca_colmas_std = 'Activo') ";

        if ($sucursal != null) {
            $query.= "and u.ca_sucursal = '$sucursal' ";
        }
        if ($vendedor != null) {
            $query.= "and u.ca_login = '$vendedor' ";
        }
        $query.= "order by ca_sucursal, ca_vendedor, ca_vnccircular ";

        // echo "<br />".$query."<br />";
        $q = Doctrine_Manager::getInstance()->connection();
        $stmt = $q->execute($query);
        return $stmt;
    }

}