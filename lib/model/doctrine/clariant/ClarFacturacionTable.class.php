<?php

class ClarFacturacionTable extends Doctrine_Table
{
        /*
	* Genera la consulta que permitirá exportar los datos en archivo plano para Clariant
	* con el prorrateo de facturación
	*/
	public static function prorrateoFacturacion(){

            // $query = "select cl.ca_doctransporte, cl.ca_orden, cd.ca_posicion, cd.ca_descripcion, cd.ca_despacho, cd.ca_unidad, ct.ca_cantidad_tot, ip.ca_ingresos_prop, it.ca_ingresos_terc from tb_clardetails cd ";
            // $query.= "  INNER JOIN tb_clariant cl ON cd.ca_idclariant = cl.ca_idclariant ";
            // $query.= "  INNER JOIN (select ca_doctransporte, sum(ca_despacho) as ca_cantidad_tot from tb_clardetails scd INNER JOIN tb_clariant scl ON scd.ca_idclariant = scl.ca_idclariant group by ca_doctransporte) ct ON cl.ca_doctransporte = ct.ca_doctransporte ";
            // $query.= "  LEFT JOIN (select ca_doctransporte, sum(ca_ingresos_prop) as ca_ingresos_prop from (select DISTINCT clr.ca_doctransporte, clr.ca_idclariant, (CASE WHEN ca_afecto_vlr IS NULL THEN 0 ELSE ca_afecto_vlr END + CASE WHEN ca_iva_vlr IS NULL THEN 0 ELSE ca_iva_vlr END + CASE WHEN ca_exento_vlr IS NULL THEN 0 ELSE ca_exento_vlr END) * CASE WHEN ca_tipo_cambio IS NULL THEN 1 ELSE ca_tipo_cambio END as ca_ingresos_prop from tb_clariant clr INNER JOIN tb_clarfacturacion clf ON clr.ca_idclariant = clf.ca_idclariant) as prop group by ca_doctransporte) as ip ON cl.ca_doctransporte = ip.ca_doctransporte ";
            // $query.= "  LEFT JOIN (select ca_doctransporte, sum(ca_ingresos_terc) as ca_ingresos_terc from (select DISTINCT clr.ca_doctransporte, clr.ca_idclariant, CASE WHEN ca_vlrdocumento IS NULL THEN 0 ELSE ca_vlrdocumento END * CASE WHEN ca_tipo_cambio IS NULL THEN 1 ELSE ca_tipo_cambio END as ca_ingresos_terc from tb_clariant clr INNER JOIN tb_clarnota_cab cln ON clr.ca_idclariant = cln.ca_idclariant) as terc group by ca_doctransporte) as it ON cl.ca_doctransporte = it.ca_doctransporte order by cl.ca_doctransporte, cl.ca_orden ";

            $query = "select cl.ca_doctransporte, cl.ca_orden, cd.ca_posicion, cd.ca_descripcion, cd.ca_despacho, cd.ca_unidad, ct.ca_cantidad_tot, ip.ca_numfactura, ip.ca_ingresos_prop, it.ca_numnota, it.ca_ingresos_terc ";
            $query.= "from tb_clardetails cd ";
            $query.= "  INNER JOIN tb_clariant cl ON cd.ca_idclariant = cl.ca_idclariant ";
            $query.= "  INNER JOIN (select ca_doctransporte, sum(ca_despacho) as ca_cantidad_tot from tb_clardetails scd INNER JOIN tb_clariant scl ON scd.ca_idclariant = scl.ca_idclariant group by ca_doctransporte) ct ON cl.ca_doctransporte = ct.ca_doctransporte ";
            $query.= "  LEFT JOIN (select ca_doctransporte, ca_numfactura, sum(ca_ingresos_prop) as ca_ingresos_prop from (select DISTINCT clr.ca_doctransporte, clr.ca_idclariant, clf.ca_numdocumento as ca_numfactura, (CASE WHEN ca_afecto_vlr IS NULL THEN 0 ELSE ca_afecto_vlr END + CASE WHEN ca_iva_vlr IS NULL THEN 0 ELSE ca_iva_vlr END + CASE WHEN ca_exento_vlr IS NULL THEN 0 ELSE ca_exento_vlr END) * CASE WHEN ca_tipo_cambio IS NULL THEN 1 ELSE ca_tipo_cambio END as ca_ingresos_prop from tb_clariant clr INNER JOIN tb_clarfacturacion clf ON clr.ca_idclariant = clf.ca_idclariant ) as prop group by ca_doctransporte, ca_numfactura) as ip ON cl.ca_doctransporte = ip.ca_doctransporte ";
            $query.= "  LEFT JOIN (select ca_doctransporte, ca_numnota, sum(ca_ingresos_terc) as ca_ingresos_terc from (select DISTINCT clr.ca_doctransporte, clr.ca_idclariant, cln.ca_numdocumento as ca_numnota, CASE WHEN ca_vlrdocumento IS NULL THEN 0 ELSE ca_vlrdocumento END * CASE WHEN ca_tipo_cambio IS NULL THEN 1 ELSE ca_tipo_cambio END as ca_ingresos_terc from tb_clariant clr INNER JOIN tb_clarnota_cab cln ON clr.ca_idclariant = cln.ca_idclariant ) as terc group by ca_doctransporte, ca_numnota) as it ON cl.ca_doctransporte = it.ca_doctransporte ";
            $query.= "where cl.ca_fchreportado IS NULL ";
            $query.= "order by ca_numfactura, ca_numnota, cl.ca_doctransporte, cl.ca_orden ";

            $q = Doctrine_Manager::getInstance()->connection();
            $stmt = $q->execute($query);
            return $stmt;
	}
}
