<?php

/**
 * inoExpo components.
 *
 * @package    colsys
 * @subpackage inoExpo
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class inoExpoComponents extends sfComponents {

    public function executeGridDocsTransporte(sfWebRequest $request) {
        $this->referencia = base64_decode($request->getParameter("id"));
        $expoMaestra = Doctrine::getTable("InoMaestraExpo")->find($this->referencia);
        $idtrafico = $expoMaestra->getDestino()->getCaIdtrafico();
    }

    public function executeGridAwbsTransporte(sfWebRequest $request) {
        $this->referencia = base64_decode($request->getParameter("id"));
        $expoMaestra = Doctrine::getTable("InoMaestraExpo")->find($this->referencia);
    }

    public function executeGridItemsDocs(sfWebRequest $request) {
        
    }

    public function executeGridNumerosDocsTransporte(sfWebRequest $request) {
        
    }
    
}

?>