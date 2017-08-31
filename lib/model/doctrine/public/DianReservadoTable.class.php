<?php

class DianReservadoTable extends Doctrine_Table {
    /* Método que invoca procedimiento almacenado que toma el último 
     * número reservado disponible, y lo actualiza con número de envío
     * año, fecha, hora y usuario
     */

    public static function retrieveLastAvailable($NumEnvio, $fchtrans) {
        $con = Doctrine_Manager::getInstance()->connection();
        $sql = "select fun_numreserva($NumEnvio, " . substr($fchtrans, 0, 4) . ", '" . $this->user->getUserId() . "') as ca_numero_resv";
        $numero = $con->execute($sql);
        return $numero["ca_numero_resv"];
    }

}
