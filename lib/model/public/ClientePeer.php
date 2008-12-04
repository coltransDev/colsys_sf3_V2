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
			$fch_ini = date('Y-m-d',mktime(0, 0, 0, 1, 1, 1900)); }
			
		if ($fch_fin == null){
			$fch_fin = date('Y-m-d'); }
			
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
			$fch_ini = date('Y-m-d',mktime(0, 0, 0, 1, 1, 1900)); }
			
		if ($fch_fin == null){
			$fch_fin = date('Y-m-d'); }

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
	

	/*
	* Lista los Clientes que tengan vencimiento de su Circular 170 en los pr�ximos 30 d�as a partir de una fecha espec�ficada.
	* @author Carlos G. L�pez M.
	*/
	public static function circularClientes( $fch_ini, $fch_fin, $sucursal ){
		if ($fch_ini == null){
			$fch_ini = date('Y-m-d',mktime(0, 0, 0, date('m')+1, 1, date('Y'))); }
			
		if ($fch_fin == null){
			$fch_fin = date('Y-m-d',mktime(0, 0, 0, date('m')+2, 0, date('Y'))); }
			
		$query = "select c.ca_idcliente, c.ca_digito, c.ca_compania, replace(c.ca_direccion,'|',' ') as ca_direccion, c.ca_oficina, c.ca_torre, c.ca_bloque, c.ca_interior, c.ca_localidad, c.ca_complemento, c.ca_telefonos, c.ca_fax, d.ca_ciudad, ";
		$query.= "ca_fchcircular, to_date(to_char(to_char(ca_fchcircular, 'YYYY')::int+1, '9999')||'-'||to_char(ca_fchcircular, 'MM')||'-'||to_char(ca_fchcircular, 'DD'),'YYYY-MM-DD') as ca_vnccircular, ";
		$query.= "c.ca_vendedor, u.ca_nombre, u.ca_sucursal from tb_clientes c LEFT OUTER JOIN control.tb_usuarios u ON (c.ca_vendedor = u.ca_login) LEFT OUTER JOIN tb_ciudades d ON (c.ca_idciudad = d.ca_idciudad) ";
		$query.= "where to_date(to_char(to_char(ca_fchcircular, 'YYYY')::int+1, '9999')||'-'||to_char(ca_fchcircular, 'MM')||'-'||to_char(ca_fchcircular, 'DD'),'YYYY-MM-DD') between '$fch_ini' and '$fch_fin'" ;

		if ($sucursal != null){
			$query.= "and u.ca_sucursal = '$sucursal' ";
		}
		
		$query.= "order by 18, 15 ";

		// echo "<br />".$query."<br />"; 
		$con = Propel::getConnection(SdnPeer::DATABASE_NAME);
		$stmt = $con->prepareStatement($query);
		return $stmt->executeQuery();
	}
}
