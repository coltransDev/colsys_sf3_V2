<?php

/**
 * widgets actions.
 *
 * @package    colsys
 * @subpackage widgets
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class widgets5Actions extends sfActions {

    public function executeListaBodegasJSON($request) {
        $criterio = $this->getRequestParameter("query");
        
        if ($this->modo == Constantes::TERRESTRE) {
            $modo = constantes::MARITIMO;
        } else {
            $modo = $this->modo;
        }

        $q = Doctrine::getTable("Bodega")
                ->createQuery("b")
                ->select("b.*")
                ->addOrderBy("b.ca_tipo ASC")
                ->addOrderBy("b.ca_nombre ASC")
                ->distinct()
                ->where("b.ca_transporte like ? and b.ca_nombre<>'-' and ca_tipo!='Operador Multimodal'", "%" . $modo . "%")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
                //->execute();
        if($criterio!="")
        {
            $q-addWhere("ca_nombre like ?","%$criterio%");
        }
        $this->data=$q->execute();

        $bodegas= array();
        foreach ($this->data as $key => $val) {
            $bodegas[] =array(
                "idbodega"       => $val["b_ca_idbodega"],
                "tipo"           => utf8_encode($val["b_ca_tipo"]),
                "transporte"     => $modo/*utf8_encode($val["b_ca_transporte"])*/,
                "nombre"         => utf8_encode($val["b_ca_nombre"]),
                "identificacion" => utf8_encode($val["b_ca_identificacion"]),
                "direccion" => utf8_encode($val["b_ca_direccion"])
                );
            //$arrTransporte = explode("|", $this->data[$key]["b_ca_transporte"]);
            //$this->data[$key]["b_ca_nombre"] = utf8_encode($this->data[$key]["b_ca_nombre"]."-Nit:".$this->data[$key]["b_ca_identificacion"]." ".$this->data[$key]["b_ca_direccion"]) . "-" . $this->data[$key]["b_ca_tipo"];
            //$this->data[$key]["b_ca_transporte"] = $modo;
            //$this->data[$key]["b_ca_transporte"] = ($modo);
        }
        
        $this->responseArray = array("root" => $bodegas, "total" => count($bodegas), "success" => true);
        $this->setTemplate("responseTemplate");
    }

}

?>
