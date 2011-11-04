<?php
/**
 */
class SdnTable extends Doctrine_Table
{
    /*
	* Elimina todos los Registros importados de la publicación anterior
	* @author Carlos G. López M.
	*/
	public static function eliminarRegistros(){
		$sql_array = array("delete from tb_sdnaddress","delete from tb_sdnaka","delete from tb_sdnid","delete from tb_sdn");
                $q = Doctrine_Manager::getInstance()->connection();
		while (list ($clave, $sql) = each ($sql_array)) {
                    $stmt = $q->execute($sql);
		}
		return;
	}

	/*
	* Compara los Registros importados con la Base de Datos de Clientes
	* @author Carlos G. López M.
	*/
	public static function evaluaClientes(){

        $query = "select cl.ca_idalterno as ca_idcliente, std.ca_compania, cl.ca_nombres, cl.ca_papellido, cl.ca_sapellido, cl.ca_vendedor,";
		$query.= " sdnm.ca_uid as sdnm_uid, sdnm.ca_firstname as sdnm_firstname, sdnm.ca_lastname as sdnm_lastname, sdnm.ca_title as sdnm_title, sdnm.ca_sdntype as sdnm_sdntype, sdnm.ca_remarks as sdnm_remarks,";
		$query.= " sdid.ca_uid_id as sdid_uid_id, sdid.ca_idtype as sdid_idtype, sdid.ca_idnumber as sdid_idnumber, sdid.ca_idcountry as sdid_idcountry, sdid.ca_issuedate as sdid_issuedate, sdid.ca_expirationdate as sdid_expirationdate,";
		$query.= " sdal.ca_uid_aka as sdal_uid_aka, sdal.ca_type as sdal_type, sdal.ca_category as sdal_category, sdal.ca_firstname as sdal_firstname, sdal.ca_lastname as sdal_lastname,";
		$query.= " sdak.ca_uid_aka as sdak_uid_aka, sdak.ca_type as sdak_type, sdak.ca_category as sdak_category, sdak.ca_firstname as sdak_firstname, sdak.ca_lastname as sdak_lastname ";
		$query.= "from vi_clientes cl ";

                $query.= "	RIGHT JOIN (select ca_idcliente, ca_compania, ca_coltrans_std, ca_colmas_std from vi_clientes where ca_coltrans_std = 'Activo' or ca_colmas_std = 'Activo' order by ca_idcliente) as std";
		$query.= "	ON ( cl.ca_idcliente = std.ca_idcliente )";

		$query.= "	LEFT OUTER JOIN tb_sdn sdnm";
		$query.= "	ON ( fun_similarpercent(std.ca_compania, textcat(case when sdnm.ca_firstname IS NULL then '' else sdnm.ca_firstname end, case when sdnm.ca_lastname IS NULL then '' else sdnm.ca_lastname end)) >90 )";

		$query.= "	LEFT OUTER JOIN tb_sdnid sdid";
		$query.= "	ON ( fun_similarpercent(cl.ca_idalterno::text, sdid.ca_idnumber) >90 )";

		$query.= "	LEFT OUTER JOIN tb_sdnaka sdal";
		$query.= "	ON ( fun_similarpercent(std.ca_compania, textcat(case when sdal.ca_firstname IS NULL then '' else sdal.ca_firstname end, case when sdal.ca_lastname IS NULL then '' else sdal.ca_lastname end)) >90 )";

		$query.= "	LEFT OUTER JOIN tb_sdnaka sdak";
		$query.= "	ON ( fun_similarpercent(cl.ca_nombres||' '||cl.ca_papellido||' '||cl.ca_sapellido, textcat(case when sdak.ca_firstname IS NULL then '' else sdak.ca_firstname end, case when sdak.ca_lastname IS NULL then '' else sdak.ca_lastname end)) >90 )";

		$query.= "	where sdnm.ca_uid IS NOT NULL or sdid.ca_uid IS NOT NULL or sdak.ca_uid IS NOT NULL";

		$query.= "  order by cl.ca_vendedor, std.ca_compania";


		$q = Doctrine_Manager::getInstance()->connection();
                $stmt = $q->execute($query);
		return $stmt;
	}
}