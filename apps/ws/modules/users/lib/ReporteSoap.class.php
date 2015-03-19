<?php

/*
 * (c) Coltrans S.A. - Colmas Ltda.
 * 
 */

/**
 * Description of myClass
 *
 * @author maquinche
 */
class ReporteSoap {
    /**
     * Add method
     *
     * @param string $usuario
     * @param string $signature
     * @return string
     */
    public function viewReporte( $parametros ) {
        try{
        print_r($parametros);
        
        //return null;
        }
        catch (Exception $e)
        {
            print_r($e->getMessage());
        }
        return null;
    }
}

?>
