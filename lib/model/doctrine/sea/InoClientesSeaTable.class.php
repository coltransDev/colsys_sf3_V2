<?php
/**
 */
class InoClientesSeaTable extends Doctrine_Table
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
            $query = "select ic.ca_referencia, ic.ca_idcliente, rp.ca_consecutivo, ii.ca_usucreado, count(ii.ca_factura) as ca_cant_facturas ";
            $query.= "  from tb_inoclientes_sea ic ";
            $query.= "  INNER JOIN tb_reportes rp ON (ic.ca_idreporte = rp.ca_idreporte) ";
            $query.= "  INNER JOIN tb_inoingresos_sea ii ON (ic.ca_referencia = ii.ca_referencia and ic.ca_idcliente = ii.ca_idcliente and ic.ca_hbls = ii.ca_hbls) ";
            $query.= "  where ic.ca_referencia = '$referencia' and ic.ca_idcliente = $idcliente and rp.ca_consecutivo = '$consecutivo' $user_filter";
            $query.= "  group by ic.ca_referencia, ic.ca_idcliente, rp.ca_consecutivo, ii.ca_usucreado ";

            // echo "<br />".$query."<br />";
            $q = Doctrine_Manager::getInstance()->connection();
            $stmt = $q->execute($query);

            while ($row = $stmt->fetch()) {
               $result[] = array($row["ca_usucreado"], $row["ca_cant_facturas"]); // $row["ca_referencia"], $row["ca_idcliente"], $row["ca_consecutivo"],
            }
        }
        return $result;
    }
}