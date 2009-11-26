<?php

class LibClienteTable extends Doctrine_Table
{
        /*
	* Lista los Clientes que tengan estado diferente a ACTIVO y liberación Automática (Días y Cupo de C?edito)
	* @author Carlos G. López M.
	*/
	public static function liberacionEstado($idcliente){

            $query = "select * from (select ca_idcliente from tb_libcliente where ca_diascredito != 0 and ca_cupo != 0 order by ca_idcliente) lib LEFT OUTER JOIN ( ";
            $query.= "  select cl.ca_idcliente, stdColt.ca_estado as ca_coltrans_std, stdColt.ca_fchestado as ca_coltrans_fch, stdColm.ca_estado as ca_colmas_std, stdColt.ca_fchestado as ca_colmas_fch ";
            $query.= "  from tb_clientes cl ";
            $query.= "      LEFT OUTER JOIN (select ca_idcliente, max(ca_fchestado) as ca_fchestado from tb_stdcliente where ca_empresa = 'Coltrans' group by ca_idcliente order by ca_idcliente) colt ON (colt.ca_idcliente::text = cl.ca_idcliente::text) ";
            $query.= "      INNER JOIN tb_stdcliente stdColt ON (stdColt.ca_empresa = 'Coltrans' and stdColt.ca_idcliente = cl.ca_idcliente and stdColt.ca_fchestado::text = colt.ca_fchestado::text) ";
            $query.= "      LEFT OUTER JOIN (select ca_idcliente, max(ca_fchestado) as ca_fchestado from tb_stdcliente where ca_empresa = 'Colmas' group by ca_idcliente order by ca_idcliente) colm ON (colm.ca_idcliente::text = cl.ca_idcliente::text) ";
            $query.= "      INNER JOIN tb_stdcliente stdColm ON (stdColm.ca_empresa = 'Colmas' and stdColm.ca_idcliente = cl.ca_idcliente and stdColm.ca_fchestado::text = colm.ca_fchestado::text) ";
            $query.= "      order by cl.ca_idcliente ) std ON (lib.ca_idcliente = std.ca_idcliente) where ca_coltrans_std != 'Activo'  and ca_colmas_std != 'Activo' ";

            if ($idcliente != null){
                $query.= "and cl.ca_idcliente = $idcliente";
            }

            // echo "<br />".$query."<br />";
            $q = Doctrine_Manager::getInstance()->connection();
            $stmt = $q->execute($query);
            return $stmt;
	}


}
