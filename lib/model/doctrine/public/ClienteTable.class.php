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
            $fch_ini = date('Y-m-d h:i:s', mktime(0, 0, 0, 1, 1, 1900));
        }

        if ($fch_fin == null) {
            $fch_fin = date('Y-m-d h:i:s');
        }

        //list($ano, $mes, $dia) = sscanf($fch_fin, "%d-%d-%d");
        //$fch_fin = date('Y-m-d h:i:s',mktime(23,59,59, $mes, $dia, $ano)); // Incrementa en un día para tener en cuenta los registros el último día dentro de la consulta
        $query = "select std0.*,cl.ca_compania, cl.ca_vendedor, u.ca_sucursal from tb_stdcliente std0 INNER JOIN tb_clientes cl ON (std0.ca_idcliente = cl.ca_idcliente) ";
        $query.= "INNER JOIN control.tb_usuarios u ON (cl.ca_vendedor = u.ca_login) ";
        $query.= "INNER JOIN (select ca_idcliente, max(ca_fchestado) as ca_fchestado, ca_empresa from tb_stdcliente where ca_fchestado between '$fch_ini' and '$fch_fin' group by ca_idcliente, ca_empresa order by ca_idcliente) std1 ON (std0.ca_idcliente = std1.ca_idcliente) ";
        $query.= "where std0.ca_fchestado = std1.ca_fchestado and std0.ca_empresa = std1.ca_empresa and std0.ca_empresa = '$empresa' and cl.ca_tipo IS NULL ";
        if ($idcliente != null) {
            $query.= "and std0.ca_idcliente = $idcliente ";
        }
        if ($estado != null) {
            $query.= "and std0.ca_estado = '$estado' ";
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

            $query = "select cl.ca_idcliente, ca_fchnegocio, CASE WHEN ca_numnegocios IS NULL THEN 0 ELSE ca_numnegocios END as ca_numnegocios, CASE WHEN ca_totnegocios IS NULL THEN 0 ELSE ca_totnegocios END as ca_totnegocios                from tb_clientes cl ";
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

        $query = "select cl.ca_idcliente, ca_fchnegocio, ca_numnegocios from tb_clientes cl ";
        if ($empresa == 'Coltrans') {
            $query.= "  LEFT OUTER JOIN (select ca_idcliente, $fun(ca_fchcreado) as ca_fchnegocio from (select ca_idcliente, ca_fchcreado from tb_inoclientes_air where ca_fchcreado between '$fch_ini' and '$fch_fin' UNION select ca_idcliente, ca_fchcreado from tb_inoclientes_sea where ca_fchcreado between '$fch_ini' and '$fch_fin') fc group by ca_idcliente) neg_fch ON (cl.ca_idcliente = neg_fch.ca_idcliente) ";
            $query.= "  LEFT OUTER JOIN (select ca_idcliente, count(ca_idcliente) as ca_numnegocios from (select ca_idcliente from tb_inoclientes_air where to_date(ca_fchcreado::text,'YYYY-MM-DD') between '$fch_ini' and '$fch_fin' UNION select ca_idcliente from tb_inoclientes_sea where to_date(ca_fchcreado::text,'YYYY-MM-DD') between '$fch_ini' and '$fch_fin') fc group by ca_idcliente) cant_neg ON (cl.ca_idcliente = cant_neg.ca_idcliente) ";
        } else {
            $query.= "  LEFT OUTER JOIN (select ca_idcliente, $fun(ca_fchfactura) as ca_fchnegocio from (select ca_idcliente, ca_fchfactura from tb_brk_ingresos LEFT OUTER JOIN tb_brk_maestra ON tb_brk_ingresos.ca_referencia = tb_brk_maestra.ca_referencia where ca_fchfactura between '$fch_ini' and '$fch_fin' UNION select ca_idcliente, ca_fchfactura from tb_expo_ingresos where ca_fchfactura between '$fch_ini' and '$fch_fin') fc group by ca_idcliente) fac_fch ON (cl.ca_idcliente = fac_fch.ca_idcliente) ";
            $query.= "  LEFT OUTER JOIN (select ca_idcliente, count(ca_factura) as ca_numnegocios from (select ca_idcliente, ca_factura from tb_brk_ingresos LEFT OUTER JOIN tb_brk_maestra ON tb_brk_ingresos.ca_referencia = tb_brk_maestra.ca_referencia where ca_fchfactura between '$fch_ini' and '$fch_fin' UNION select ca_idcliente, ca_factura from tb_expo_ingresos where ca_fchfactura between '$fch_ini' and '$fch_fin') fc group by ca_idcliente) cant_neg ON (cl.ca_idcliente = cant_neg.ca_idcliente) ";
        }
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

        $query = "select cl.ca_idcliente, ca_fchfactura, ca_valor from tb_clientes cl ";
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

        $query = "select c.ca_idcliente, c.ca_digito, c.ca_compania, replace(c.ca_direccion,'|',' ') as ca_direccion, c.ca_oficina, c.ca_torre, c.ca_bloque, c.ca_interior, c.ca_localidad, c.ca_complemento, c.ca_telefonos, c.ca_fax, d.ca_ciudad, ";
        $query.= "ca_fchcircular, to_date(to_char(to_char(ca_fchcircular, 'YYYY')::int+1, '9999')||'-'||to_char(ca_fchcircular, 'MM')||'-'||to_char(ca_fchcircular, 'DD'),'YYYY-MM-DD') as ca_vnccircular, ct.ca_coltrans_std, cm.ca_colmas_std, c.ca_vendedor, u.ca_nombre, u.ca_sucursal from tb_clientes c ";
        $query.= "LEFT OUTER JOIN control.tb_usuarios u ON (c.ca_vendedor = u.ca_login) ";
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
     * Lista los Clientes que NO tengan Circular 170.
     * @author Carlos G. López M.
     */

    public static function clientesSinCircular($fch_fin, $sucursal, $vendedor) {
        if ($fch_fin == null) {
            $fch_fin = date('Y-m-d', mktime(0, 0, 0, date('m') + 2, 0, date('Y')));
        }

        $query = "select c.ca_idcliente, c.ca_digito, c.ca_compania, replace(c.ca_direccion,'|',' ') as ca_direccion, c.ca_oficina, c.ca_torre, c.ca_bloque, c.ca_interior, c.ca_localidad, c.ca_complemento, c.ca_telefonos, c.ca_fax, d.ca_ciudad, ";
        $query.= "ct.ca_coltrans_std, cm.ca_colmas_std, c.ca_vendedor, u.ca_nombre, u.ca_sucursal from tb_clientes c ";
        $query.= "LEFT OUTER JOIN control.tb_usuarios u ON (c.ca_vendedor = u.ca_login) ";
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

    public static function clientesSinVisita($fch_fin, $sucursal, $vendedor) {
        if ($fch_fin == null) {
            $fch_fin = date('Y-m-d', mktime(0, 0, 0, date('m') + 2, 0, date('Y')));
        }

        $query = "select c.ca_idcliente, c.ca_digito, c.ca_compania, replace(c.ca_direccion,'|',' ') as ca_direccion, c.ca_oficina, c.ca_torre, c.ca_bloque, c.ca_interior, c.ca_localidad, c.ca_complemento, c.ca_telefonos, c.ca_fax, d.ca_ciudad, ";
        $query.= "ct.ca_coltrans_std, cm.ca_colmas_std, c.ca_vendedor, e.ca_fchvisita, u.ca_nombre, u.ca_sucursal from tb_clientes c ";
        $query.= "LEFT OUTER JOIN control.tb_usuarios u ON (c.ca_vendedor = u.ca_login) ";
        $query.= "LEFT OUTER JOIN tb_ciudades d ON (c.ca_idciudad = d.ca_idciudad) ";
        $query.= "LEFT OUTER JOIN (select ca_idcliente, max(ca_fchvisita) as ca_fchvisita from tb_enccliente group by ca_idcliente) e ON (e.ca_idcliente = c.ca_idcliente) ";
        $query.= "LEFT OUTER JOIN (select colt.ca_idcliente as ca_idcliente_colt, colt.ca_estado as ca_coltrans_std, colt.ca_fchestado as ca_coltrans_fch from tb_stdcliente colt INNER JOIN (select ca_idcliente, max(ca_fchestado) as ca_fchestado from tb_stdcliente where ca_empresa = 'Coltrans' and ca_fchestado <= '$fch_fin' group by ca_idcliente order by ca_idcliente) sub ON (colt.ca_idcliente = sub.ca_idcliente and colt.ca_fchestado = sub.ca_fchestado and colt.ca_empresa = 'Coltrans')) ct ON (ct.ca_idcliente_colt = c.ca_idcliente) ";
        $query.= "LEFT OUTER JOIN (select colm.ca_idcliente as ca_idcliente_colm, colm.ca_estado as ca_colmas_std, colm.ca_fchestado as ca_colmas_fch from tb_stdcliente colm INNER JOIN (select ca_idcliente, max(ca_fchestado) as ca_fchestado from tb_stdcliente where ca_empresa = 'Colmas' and ca_fchestado <= '$fch_fin' group by ca_idcliente order by ca_idcliente) sub ON (colm.ca_idcliente = sub.ca_idcliente and colm.ca_fchestado = sub.ca_fchestado and colm.ca_empresa = 'Colmas')) cm ON (cm.ca_idcliente_colm = c.ca_idcliente) ";
        $query.= "where ca_fchvisita IS NULL and (ct.ca_coltrans_std = 'Activo' or cm.ca_colmas_std = 'Activo') ";

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
     * Lista los Clientes Activos que perderán Beneficios Crediticios, Tiempo y Cupo de Crédito por vencimiento de circular.
     * @author Carlos G. López M.
     */

    public static function pierdenBeneficios($fch_fin, $sucursal, $vendedor) {
        if ($fch_fin == null) {
            $fch_fin = date('Y-m-d', mktime(0, 0, 0, date('m') + 2, 0, date('Y')));
        }

        $query = "select c.ca_idcliente, c.ca_digito, c.ca_compania, replace(c.ca_direccion,'|',' ') as ca_direccion, c.ca_oficina, c.ca_torre, c.ca_bloque, c.ca_interior, c.ca_localidad, c.ca_complemento, c.ca_telefonos, c.ca_fax, d.ca_ciudad, ";
        $query.= "ca_fchcircular, to_date(to_char(to_char(ca_fchcircular, 'YYYY')::int+1, '9999')||'-'||to_char(ca_fchcircular, 'MM')||'-'||to_char(ca_fchcircular, 'DD'),'YYYY-MM-DD') as ca_vnccircular, ct.ca_coltrans_std, cm.ca_colmas_std, c.ca_vendedor, u.ca_nombre, u.ca_sucursal, l.ca_cupo, l.ca_diascredito from tb_libcliente l ";
        $query.= "LEFT OUTER JOIN tb_clientes c ON (l.ca_idcliente = c.ca_idcliente)";
        $query.= "LEFT OUTER JOIN control.tb_usuarios u ON (c.ca_vendedor = u.ca_login) ";
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