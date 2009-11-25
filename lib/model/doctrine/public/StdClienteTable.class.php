<?php

class StdClienteTable extends Doctrine_Table
{
        /*
	* Lista los Clientes que tengan estado ACTIVO sin negocios desde hace más de un año, contado a partir de hoy
	* @author Carlos G. López M.
	*/
	public static function vencimientoEstado($empresa, $estado, $idcliente){

            if ($empresa == 'Coltrans') {
                $query = "select act.ca_idcliente from ( select ca_idcliente, max(ca_fchcreado) as ca_fchcreado from (select ca_idcliente, ca_fchcreado from tb_inoclientes_sea UNION select ca_idcliente, ca_fchcreado from tb_inoclientes_air) cl group by ca_idcliente ) act";
            } else if ($empresa == 'Colmas'){
                $query = "select act.ca_idcliente from ( select ca_idcliente, max(ca_fchcreado) as ca_fchcreado from (select ca_idcliente, ca_fchcreado from tb_expo_maestra UNION select ca_idcliente, ca_fchcreado from tb_brk_maestra) cl group by ca_idcliente ) act";
            }
            $query.= " LEFT OUTER JOIN ( select ca_idcliente, max(ca_fchestado) as ca_fchestado from tb_stdcliente where ca_empresa = '$empresa' group by ca_idcliente ) ult ON (act.ca_idcliente = ult.ca_idcliente)";
            $query.= " LEFT OUTER JOIN ( select ca_idcliente, ca_fchestado, ca_estado from tb_stdcliente where ca_empresa= '$empresa' ) std ON (std.ca_idcliente = ult.ca_idcliente and std.ca_fchestado = ult.ca_fchestado)";
            $query.= " where act.ca_fchcreado <= to_date(date_part('year',now())::int-1||'-'||date_part('month',now())||'-'||date_part('day',now()),'YYYY-MM-DD')  and std.ca_estado = '$estado' ";

            if ($idcliente != null){
                $query.= "and act.ca_idcliente = $idcliente";
            }

            // echo "<br />".$query."<br />";
            $q = Doctrine_Manager::getInstance()->connection();
            $stmt = $q->execute($query);
            return $stmt;
	}

}
