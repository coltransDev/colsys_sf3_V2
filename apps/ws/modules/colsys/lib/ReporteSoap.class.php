<?php

/*
 * (c) Coltrans S.A. - Colmas Ltda.
 * 
 */

/**
 * Description of ReporteSoap
 *
 * @author maquinche
 */
class ReporteSoap {
    /**
     * View method
     *
     * @param string $parametros     
     * @return string
     */
    public function viewReporte( $parametros ) {
        try{
        print_r($parametros);
            $reporte = Doctrine::getTable("Reporte")->find( $parametros );
            //$reporte= new Reporte();
            //$reporte->setCaDeclaracionant(true);
            //$reporte->setCaTiporep(2);
            //$reporte->stopBlaming();
            //$reporte->save();
        return $reporte->getCaConsecutivo();

//            return $parametros;
        }
        catch (Exception $e)
        {
            //print_r($e->getMessage());
            //return $e->getMessage();
            return "Remote: ".$e->getMessage()." server:".$_SERVER["SERVER_ADDR"];//." u:".$usuario."-nu:".$newUsuario;
        }
        
    }
}

?>
