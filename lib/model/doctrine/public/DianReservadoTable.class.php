<?php

class DianReservadoTable extends Doctrine_Table {
    /* M�todo que invoca procedimiento almacenado que toma el �ltimo 
     * n�mero reservado disponible, y lo actualiza con n�mero de env�o
     * a�o, fecha, hora y usuario
     */

    public static function retrieveLastAvailable($NumEnvio, $fchtrans) {
        $con = Doctrine_Manager::getInstance()->connection();
        $sql = "select fun_numreserva($NumEnvio, " . substr($fchtrans, 0, 4) . ", '" . $this->user->getUserId() . "') as ca_numero_resv";
        $numero = $con->execute($sql);
        return $numero["ca_numero_resv"];
    }

}
