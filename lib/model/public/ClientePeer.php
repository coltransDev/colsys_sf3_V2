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
	* @author Carlos G. L�pez M.
	*/
	public static function estadoClientes( $fch_ini, $fch_fin, $empresa, $idcliente, $estado ){
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
		if ($estado != null){
			$query.= "and std0.ca_estado = '$estado' ";
		}
		
		$query.= "order by ca_idcliente ";
		
		// echo "<br />".$query."<br />"; 
		$con = Propel::getConnection(SdnPeer::DATABASE_NAME);
		$stmt = $con->prepareStatement($query);
		return $stmt->executeQuery();
	}


	/*
	* Relaciona las factura de Clientes en un determinado periodo de tiempo, retorna fecha ultima factura y sumataria de facturas en un periodo 
	* @author Carlos G. L�pez M.
	*/
	public static function facturacionClientes( $fch_ini, $fch_fin, $empresa, $idcliente ){
		if ($fch_ini == null){
			$fch_ini = date('m-d-Y',mktime(0, 0, 0, 1, 1, 1900)); }
			
		if ($fch_fin == null){
			$fch_fin = date('m-d-Y'); }

		$query = "select cl.ca_idcliente, ca_fchfactura, ca_valor from tb_clientes cl ";
		if ($empresa = 'Coltrans'){
			$query.= "LEFT OUTER JOIN (select ca_idcliente, max(ca_fchfactura) as ca_fchfactura from (select ca_idcliente, ca_fchfactura from tb_inoingresos_sea where ca_fchfactura <= '$fch_fin' UNION select ca_idcliente, ca_fchfactura from tb_inoingresos_air where ca_fchfactura <= '$fch_fin') fc group by ca_idcliente) fac_fch ON (cl.ca_idcliente = fac_fch.ca_idcliente) ";
			$query.= "LEFT OUTER JOIN (select ca_idcliente, sum(ca_valor) as ca_valor from (select ca_idcliente, ca_valor from tb_inoingresos_sea where ca_fchfactura between '$fch_ini' and '$fch_fin' UNION select ca_idcliente, (ca_valor*ca_tcalaico) as ca_valor from tb_inoingresos_air where ca_fchfactura between '$fch_ini' and '$fch_fin') fc group by ca_idcliente) fac_val ON (cl.ca_idcliente = fac_val.ca_idcliente) ";
		}else{
			$query.= "LEFT OUTER JOIN (select ca_idcliente, max(ca_fchfactura) as ca_fchfactura from (select ca_idcliente, ca_fchfactura from tb_brk_ingresos where ca_fchfactura <= '$fch_fin' UNION select ca_idcliente, ca_fchfactura from tb_expo_ingresos where ca_fchfactura <= '$fch_fin') fc group by ca_idcliente) fac_fch ON (cl.ca_idcliente = fac_fch.ca_idcliente) ";
			$query.= "LEFT OUTER JOIN (select ca_idcliente, sum(ca_valor) as ca_valor from (select ca_idcliente, (ca_valor*ca_tasacambio) as ca_valor from tb_brk_ingresos where ca_fchfactura between '$fch_ini' and '$fch_fin' UNION select ca_idcliente, (ca_valor*ca_tasacambio) as ca_valor from tb_expo_ingresos where ca_fchfactura between '$fch_ini' and '$fch_fin') fc group by ca_idcliente) fac_val ON (cl.ca_idcliente = fac_val.ca_idcliente) ";
		}
		$query.= "where cl.ca_idcliente = $idcliente";		
		
		// echo "<br />".$query."<br />"; 
		$con = Propel::getConnection(SdnPeer::DATABASE_NAME);
		$stmt = $con->prepareStatement($query);
		return $stmt->executeQuery();
	}
	

}
