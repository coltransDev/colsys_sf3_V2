<?php

class InoClientesAirTable extends Doctrine_Table
{

    /*
     * Lista el número de facturas de un documento de transporte y la persona que las ingreso al sistema.
     * @author Carlos G. López M.
     */

    public static function facturasPorReporte($referencia, $idcliente, $consecutivo, $usuenvio) {
        $user_filter = "";
        if($usuenvio != ""){
            $user_filter = "and ii.ca_usucreado = '$usuenvio'";
        }
        $result = array();
        if ($referencia != null and $idcliente != null and $consecutivo != null) {
            $query = "select ic.ca_referencia, ic.ca_idcliente, ic.ca_idreporte as ca_consecutivo, ii.ca_usucreado, us.ca_nombre as ca_nomoperativo, count(ii.ca_factura) as ca_cant_facturas ";
            $query.= "  from tb_inoclientes_air ic ";
            $query.= "  INNER JOIN tb_inoingresos_air ii ON (ic.ca_referencia = ii.ca_referencia and ic.ca_idcliente = ii.ca_idcliente and ic.ca_hawb = ii.ca_hawb) ";
            $query.= "  INNER JOIN control.tb_usuarios us ON (ii.ca_usucreado = us.ca_login) ";
            $query.= "  where ic.ca_referencia = '$referencia' and ic.ca_idcliente = $idcliente and ic.ca_idreporte = '$consecutivo' $user_filter";
            $query.= "  group by ic.ca_referencia, ic.ca_idcliente, ic.ca_idreporte, ii.ca_usucreado, us.ca_nombre ";

            // echo "<br />".$query."<br />";
            $q = Doctrine_Manager::getInstance()->connection();
            $stmt = $q->execute($query);

            while ($row = $stmt->fetch()) {
               $result[] = array($row["ca_usucreado"], $row["ca_cant_facturas"], $row["ca_nomoperativo"]); // $row["ca_referencia"], $row["ca_idcliente"], $row["ca_consecutivo"],
            }
        }
        return $result;
    }

}
