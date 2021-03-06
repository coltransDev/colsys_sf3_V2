<?php

/**
 * Cliente
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
class Cliente extends BaseCliente {

    public function __toString() {
        return $this->getCaCompania();
    }

    /*
     * Retorna el objeto Usuario de tipo coordinador asociado al reporte
     * @author Andres Botero
     */
    public function getCoordinador() {
        $coordinador = Doctrine::getTable("Usuario")->find($this->getCaCoordinador());
        return $coordinador;
    }

    public function getDireccion() {

        $direccion = str_replace("|", " ", $this->getCaDireccion());

        if ($this->getCaOficina()) {
            $direccion.="Oficina " . $this->getCaOficina() . " ";
        }
        if ($this->getCaTorre()) {
            $direccion.="Torre " . $this->getCaTorre() . " ";
        }
        if ($this->getCaBloque()) {
            $direccion.="Bloque " . $this->getCaBloque() . " ";
        }
        if ($this->getCaInterior()) {
            $direccion.="Interior " . $this->getCaInterior() . " ";
        }
        $direccion.=$this->getCaComplemento() . " ";

        return $direccion;
    }

    /*
     * Retorna un arreglo con el estado de la Carta de Garant?a a una fecha.
     * @author Carlos G. L?pez M.
     */

    public function cartaGarantiaStd($fch_fin) {
        $cartaGarantiaEstado = array();
        if ($fch_fin == null) {
            $fch_fin = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d'), date('Y')));
        }

        $query = "SELECT c.ca_idcliente, cm.ca_fchfirmado, cm.ca_fchvencimiento, CASE WHEN cm.ca_fchfirmado IS NULL THEN 'Sin'::text ELSE CASE WHEN cm.ca_fchvencimiento < now() THEN 'Vencido'::text ELSE 'Vigente'::text END END AS ca_stdcarta_gtia FROM tb_clientes c ";
        $query.= "LEFT JOIN ( SELECT cf.ca_idcliente, cf.ca_fchfirmado, cm.ca_fchvencimiento FROM (SELECT tb_comcliente.ca_idcliente, max(tb_comcliente.ca_fchfirmado) AS ca_fchfirmado FROM tb_comcliente GROUP BY tb_comcliente.ca_idcliente) cf ";
        $query.= "JOIN ( SELECT tb_comcliente.ca_idcliente, tb_comcliente.ca_fchfirmado, tb_comcliente.ca_fchvencimiento FROM tb_comcliente ";
        $query.= "WHERE tb_comcliente.ca_fchanulado IS NULL and tb_comcliente.ca_fchfirmado <= '$fch_fin' and tb_comcliente.ca_fchvencimiento >= '$fch_fin') cm ON cf.ca_idcliente = cm.ca_idcliente AND cf.ca_fchfirmado = cm.ca_fchfirmado) cm ON c.ca_idcliente = cm.ca_idcliente ";
        $query.= "WHERE c.ca_idcliente = ".$this->getCaIdcliente();

        // echo "<br />".$query."<br />";
        $q = Doctrine_Manager::getInstance()->connection();
        $stmt = $q->execute($query);

        return $stmt->fetch();
    }

}
