<?php

class StdClienteTable extends Doctrine_Table
{
        /*
	* Lista los Clientes que tengan estado ACTIVO sin negocios desde hace más de un año, contado a partir de hoy
	* @author Carlos G. López M.
	*/
	public static function vencimientoEstado($empresa, $estado, $idcliente){

            $query = "select cl.ca_idcliente from tb_clientes cl ";
            if ($empresa == 'Coltrans') {
                $query.= "LEFT JOIN ( select ca_idcliente, max(ca_fchcreado) as ca_fchcreado from (select ca_idcliente, ca_fchcreado from tb_inoclientes_sea UNION select ca_idcliente, ca_fchcreado from tb_inoclientes_air UNION select em.ca_idcliente, ei.ca_fchcreado from tb_expo_ingresos ei INNER JOIN tb_expo_maestra em ON ei.ca_referencia = em.ca_referencia) cl group by ca_idcliente ) act ON (cl.ca_idcliente = act.ca_idcliente)";
            } else if ($empresa == 'Colmas'){
                $query.= "LEFT JOIN ( select ca_idcliente, max(ca_fchcreado) as ca_fchcreado from (select bm.ca_idcliente, bi.ca_fchcreado from tb_brk_maestra bm INNER JOIN tb_brk_ingresos bi ON bi.ca_referencia = bm.ca_referencia) cl group by ca_idcliente ) act ON (cl.ca_idcliente = act.ca_idcliente)";
            } else if ($empresa == 'Colotm') {
                $query.= "LEFT JOIN (select cm.ca_id as ca_idcliente, max(cm.ca_fchcomprobante) as ca_fchcreado from ino.tb_comprobantes cm join ino.tb_tipos_comprobante tc on cm.ca_idtipo = tc.ca_idtipo and tc.ca_idempresa = 8 and tc.ca_tipo = 'F' and cm.ca_consecutivo IS NOT NULL and cm.ca_estado IN (5,6) join ino.tb_house hs on cm.ca_idhouse = hs.ca_idhouse group by cm.ca_id) act ON (cl.ca_idcliente = act.ca_idcliente) ";
            } else if ($empresa == 'Coldepósitos') {
                $query.= "LEFT JOIN (select cc.ca_idcliente, max(tr.ca_fchcreado) as ca_fchcreado from tb_cotizaciones ct join tb_concliente cc on ct.ca_idcontacto = cc.ca_idcontacto and ct.ca_empresa = '$empresa' join notificaciones.tb_tareas tr on ct.ca_idg_envio_oportuno = tr.ca_idtarea group by cc.ca_idcliente) act ON (cl.ca_idcliente = act.ca_idcliente) ";
            }
            $query.= " INNER JOIN ( select ca_idcliente, max(ca_fchestado) as ca_fchestado from tb_stdcliente where ca_empresa = '$empresa' group by ca_idcliente ) ult ON (cl.ca_idcliente = ult.ca_idcliente)";
            $query.= " INNER JOIN ( select ca_idcliente, ca_fchestado, ca_estado from tb_stdcliente where ca_empresa= '$empresa' ) std ON (std.ca_idcliente = ult.ca_idcliente and std.ca_fchestado::text = ult.ca_fchestado::text)";
            $query.= " where (act.ca_fchcreado IS NULL or act.ca_fchcreado::date <= to_date(date_part('year',now())::int-1||'-'||date_part('month',now())||'-'||date_part('day',now()),'YYYY-MM-DD')) and std.ca_estado = '$estado'::text ";

            if ($idcliente != null){
                $query.= "and act.ca_idcliente = $idcliente";
            }

            // echo "<br />".$query."<br />";
            $q = Doctrine_Manager::getInstance()->connection();
            $stmt = $q->execute($query);
            return $stmt;
	}

}
