<?php

/**
 * Subclass for performing query and update operations on the 'tb_clientes' table.
 *
 * 
 *
 * @package lib.model.public
 */ 
class ClientePeer extends BaseClientePeer
{
	/*
	* Lista los Clientes que hayan cambiado de estado en un determinado periodo de tiempo
	* @author Carlos G. López M.
	*/
	public static function estadoClientes( $fch_ini, $fch_fin, $empresa, $idcliente = null ){
		if ($fch_ini == null){
			$fch_ini = date('m-d-Y',mktime(0, 0, 0, 1, 1, 1900)); }
			
		if ($fch_fin == null){
			$fch_fin = date('m-d-Y'); }
			
		$query = "select std0.*,cl.ca_compania from tb_stdcliente std0 LEFT OUTER JOIN tb_clientes cl ON (std0.ca_idcliente = cl.ca_idcliente), ";
		$query.= "(select ca_idcliente, max(ca_fchestado) as ca_fchestado, ca_empresa from tb_stdcliente where ca_fchestado between '$fch_ini' and '$fch_fin' group by ca_idcliente, ca_empresa) std1 ";
		$query.= "where std0.ca_idcliente = std1.ca_idcliente and std0.ca_fchestado = std1.ca_fchestado and std0.ca_empresa = std1.ca_empresa and std0.ca_empresa = '$empresa'" ;
		if ($idcliente != null){
			$query.= "and std0.ca_idcliente = $idcliente ";
		}
		$query.= "order by ca_idcliente ";
		
		//echo "<br />".$query."<br />"; 
		$con = Propel::getConnection(SdnPeer::DATABASE_NAME);
		$stmt = $con->prepareStatement($query);
		return $stmt->executeQuery();
	}
}
