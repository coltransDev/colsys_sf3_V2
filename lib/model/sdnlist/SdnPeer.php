<?php

/**
 * Subclass for performing query and update operations on the 'tb_sdn' table.
 *
 * 
 *
 * @package lib.model.sdnlist
 */ 
class SdnPeer extends BaseSdnPeer
{
	/*
	* Elimina todos los Registros importados de la publicación anterior
	* @author Carlos G. López M.
	*/
	public static function eliminarRegistros(){
		$sql_array = array("delete from tb_sdnaddress","delete from tb_sdnaka","delete from tb_sdnid","delete from tb_sdn");
		$con = Propel::getConnection(SdnPeer::DATABASE_NAME);
		while (list ($clave, $sql) = each ($sql_array)) {
			$stmt = $con->prepare($sql);
			$stmt->execute();
		}
		return;
	}
	
	/*
	* Compara los Registros importados con la Base de Datos de Clientes
	* @author Carlos G. López M.
	*/
	public static function evaluaClientes(){
		$query = "select cl.ca_idcliente, cl.ca_compania, cl.ca_nombres, cl.ca_papellido, cl.ca_sapellido, cl.ca_vendedor,";
		$query.= " sdnm.ca_uid as sdnm_uid, sdnm.ca_firstname as sdnm_firstname, sdnm.ca_lastname as sdnm_lastname, sdnm.ca_title as sdnm_title, sdnm.ca_sdntype as sdnm_sdntype, sdnm.ca_remarks as sdnm_remarks,";
		$query.= " sdid.ca_uid_id as sdid_uid_id, sdid.ca_idtype as sdid_idtype, sdid.ca_idnumber as sdid_idnumber, sdid.ca_idcountry as sdid_idcountry, sdid.ca_issuedate as sdid_issuedate, sdid.ca_expirationdate as sdid_expirationdate,";
		$query.= " sdal.ca_uid_aka as sdal_uid_aka, sdal.ca_type as sdal_type, sdal.ca_category as sdal_category, sdal.ca_firstname as sdal_firstname, sdal.ca_lastname as sdal_lastname,";
		$query.= " sdak.ca_uid_aka as sdak_uid_aka, sdak.ca_type as sdak_type, sdak.ca_category as sdak_category, sdak.ca_firstname as sdak_firstname, sdak.ca_lastname as sdak_lastname ";
		$query.= "from tb_clientes cl ";

		$query.= "	LEFT OUTER JOIN tb_sdn sdnm";
		$query.= "	ON ( fun_similarpercent(cl.ca_compania, textcat(case when nullvalue(sdnm.ca_firstname) then '' else sdnm.ca_firstname end, case when nullvalue(sdnm.ca_lastname) then '' else sdnm.ca_lastname end)) >90 )";
		
		$query.= "	LEFT OUTER JOIN tb_sdnid sdid";
		$query.= "	ON ( fun_similarpercent(cl.ca_idcliente::text, sdid.ca_idnumber) >90 )";
		
		$query.= "	LEFT OUTER JOIN tb_sdnaka sdal";
		$query.= "	ON ( fun_similarpercent(cl.ca_compania, textcat(case when nullvalue(sdal.ca_firstname) then '' else sdal.ca_firstname end, case when nullvalue(sdal.ca_lastname) then '' else sdal.ca_lastname end)) >90 )";
		
		$query.= "	LEFT OUTER JOIN tb_sdnaka sdak";
		$query.= "	ON ( fun_similarpercent(cl.ca_nombres||' '||cl.ca_papellido||' '||cl.ca_sapellido, textcat(case when nullvalue(sdak.ca_firstname) then '' else sdak.ca_firstname end, case when nullvalue(sdak.ca_lastname) then '' else sdak.ca_lastname end)) >90 )";
		
		$query.= "	where NOT nullvalue(sdnm.ca_uid) or NOT nullvalue(sdid.ca_uid) or NOT nullvalue(sdak.ca_uid)";
		
		$query.= "  order by cl.ca_vendedor, cl.ca_compania";
		
		$con = Propel::getConnection(SdnPeer::DATABASE_NAME);
		$stmt = $con->prepare($query);
		$stmt->execute();
		return $stmt;
	}
	
}
