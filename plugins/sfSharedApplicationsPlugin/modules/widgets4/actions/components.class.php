<?php

/**
 * widgets actions.
 *
 * @package    colsys
 * @subpackage widgets
 * @author     Andres Botero
 * @version    SVN: $Id: components.class.php 9301 2008-05-27 01:08:46Z abotero $
 */
class widgets4Components extends sfComponents {

    /**
     * Muestra un select con las modalidades
     */
    public function executeWgDocumentosExt5() {

        //$this->idsserie = ($this->getRequestParameter("serie")!="")?$this->getRequestParameter("serie"):"0";
        /*
          $q = Doctrine::getTable("TipoDocumental")
          ->createQuery("t")
          ->select("*")
          ->where("ca_idsserie = ?", $this->idsserie )
          ->setHydrationMode(Doctrine::HYDRATE_ARRAY);

          //echo $q->getSqlQuery();
          $tipoDocs=$q->execute();
          $this->tipoDocs=array();
          foreach($tipoDocs as $t)
          {
          $this->tipoDocs[]=array("id"=>$t["ca_iddocumental"],"name"=>$t["ca_documento"]);
          }
          //print_r($this->tipoDocs);
         * 
         */
    }

    public function executeWgDocumentos() {

        //$this->idsserie = ($this->getRequestParameter("serie")!="")?$this->getRequestParameter("serie"):"0";
        /*
          $q = Doctrine::getTable("TipoDocumental")
          ->createQuery("t")
          ->select("*")
          ->where("ca_idsserie = ?", $this->idsserie )
          ->setHydrationMode(Doctrine::HYDRATE_ARRAY);

          //echo $q->getSqlQuery();
          $tipoDocs=$q->execute();
          $this->tipoDocs=array();
          foreach($tipoDocs as $t)
          {
          $this->tipoDocs[]=array("id"=>$t["ca_iddocumental"],"name"=>$t["ca_documento"]);
          }
          //print_r($this->tipoDocs);
         * 
         */
    }

    public function executeWgHouse() {
        
    }

    public function executeWgCliente() {
        
    }

    public function executeWgClienteSucursal() {
        
    }

    public function executeWgLinea() {
        
    }

    public function executeWgModalidad() {
        
    }

    public function executeWgTransporte() {

        $this->data = array();
        $this->data[] = array("valor" => utf8_encode(Constantes::AEREO));
        $this->data[] = array("valor" => utf8_encode(Constantes::MARITIMO));
        $this->data[] = array("valor" => utf8_encode(Constantes::TERRESTRE));
    }

    public function executeWgImpoexpo() {
        $this->data = array();
        $this->data[] = array("valor" => utf8_encode(Constantes::IMPO));
        $this->data[] = array("valor" => utf8_encode(Constantes::TRIANGULACION));
        $this->data[] = array("valor" => utf8_encode(Constantes::EXPO));
        $this->data[] = array("valor" => utf8_encode(Constantes::OTMDTA));
        $this->data[] = array("valor" => utf8_encode(Constantes::INTERNO));
    }

    public function executeWgMoneda() {

        $this->data = array();

        $monedas = Doctrine::getTable("Moneda")
                ->createQuery("m")
                ->addOrderBy("m.ca_sugerido desc")
                ->addOrderBy("m.ca_idmoneda")
                ->execute();

        foreach ($monedas as $moneda) {
            $this->data[] = array("id" => $moneda->getCaIdmoneda(), "name" => utf8_encode($moneda->getCaNombre()), "sugerido" => $moneda->getCaSugerido());
        }
    }

    public function executeWgTipoComprobante() {
        $user = $this->getUser();
//        $this->tipoComprobante;
        if (count($this->tipoComprobante) < 1) {
            $this->tipoComprobante = array('F', 'C');
        }

        $q = Doctrine::getTable("InoTipoComprobante")
                ->createQuery("t")
                ->select("t.ca_idtipo, t.ca_tipo, t.ca_comprobante, t.ca_titulo, t.ca_idempresa")
                //->innerJoin("t.IdsSucursal s")
                //->innerJoin("s.Ids i")
                //->innerJoin("s.Empresa e")                
                ->whereIn("t.ca_tipo", $this->tipoComprobante)
                ->addwhere("ca_idempresa=? AND ca_activo=?", array($user->getIdempresa() , true))
                ->addOrderBy("t.ca_tipo, t.ca_comprobante");

        $tipos = $q->setHydrationMode(Doctrine::HYDRATE_SCALAR)->execute();

        $this->data = array();
        foreach ($tipos as $tipo) {
            $tipoStr = "";
            if (!isset($this->empresa)) {
                //$tipoStr .= $tipo["e_ca_sigla"] . " » ";
            }
            $tipoStr .= $tipo["t_ca_tipo"] . "-" . str_pad($tipo["t_ca_comprobante"], 2, "0", STR_PAD_LEFT) . " " . $tipo["t_ca_titulo"];
            $this->data[] = array("id" => $tipo["t_ca_idtipo"], "name" => utf8_encode($tipoStr), "idempresa" => $tipo["t_ca_idempresa"]);
        }

        //$this->tipos = array("root" => $tiposArray, "total" => count($tiposArray));
    }

    public function executeWgCcostos() {

        /* $centros = Doctrine::getTable("InoCentroCosto")
          ->createQuery("c")
          ->select("c.*")
          ->where("c.ca_subcentro IS NULL")
          ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
          ->execute();
          $centrosArray = array();
          foreach( $centros as $centro ){
          $centrosArray[ $centro["c_ca_centro"] ] = $centro["c_ca_nombre"];
          }


          $this->data = array();


          //TODO Crear widgets independientas para estos dos items
          $centros = Doctrine::getTable("InoCentroCosto")
          ->createQuery("c")
          ->where("c.ca_subcentro IS NOT NULL")
          ->orderBy("c.ca_centro ASC")
          ->addOrderBy("c.ca_subcentro ASC")
          ->execute();

          foreach( $centros as $centro ){
          $centroStr = utf8_encode(str_pad($centro->getCaCentro(), 2, "0", STR_PAD_LEFT) ."-".str_pad($centro->getCaSubcentro(), 2, "0", STR_PAD_LEFT)." ".$centrosArray[$centro->getCaCentro()]." » ".$centro->getCaNombre());
          $this->data[] = array("id"=>$centro->getCaIdccosto(),
          "name"=> $centroStr
          );
          } */
    }

    public function executeWgConceptos() {
        
    }

    public function executeWgConceptosSiigo() {
        
    }

    public function executeWgCuentasSiigo() {
        
    }

    public function executeWgEmpresas() {

        $this->data = array();
        $empresas = Doctrine::getTable("Empresa")
                ->createQuery("e")
                ->select("e.*")
                ->where("e.ca_activo=TRUE ")
                ->execute();

        foreach ($empresas as $e) {
            $this->data[] = array("id" => $e->getCaIdempresa(), "name" => $e->getCaNombre());
        }
    }

    public function executeWgModos() {

        $this->data = array();
        $datos = Doctrine::getTable("Modo")
                ->createQuery("m")
                ->select("m.*")
                ->execute();

        foreach ($datos as $d) {
            $this->data[] = array("id" => $d->getCaIdmodo(), "name" => utf8_encode($d->getCaImpoexpo() . "-" . $d->getCaTransporte()));
        }
    }

    public function executeWgCuentasParametros() {

        $this->data = array();
        $user = $this->getUser();
        $datos = ParametroTable::retrieveByCaso("CU236", 8/* $user->getIdempresa() */);

        foreach ($datos as $d) {
            $this->data[] = array("id" => $d->getCaIdentificacion(), "name" => $d->getCaValor2());
        }

        /* $empresas = Doctrine::getTable("Empresa")
          ->createQuery("e")
          ->select("e.*")
          ->where("e.ca_activo=TRUE ")
          ->execute();

          foreach( $empresas as $e ){
          $this->data[]=array("id"=>$e->getCaIdempresa(),"name"=>$e->getCaNombre());
          } */
    }

    public function executeWgReporte() {
        
    }

    public function executeWgReferencia() {
        
    }

    public function executeWgTercero() {
        
    }

    public function executeWgTrafico() {
        //echo $this->excluidos;
        $traficos = Doctrine::getTable('Trafico')->createQuery('t')
                ->where('t.ca_idtrafico != ?', '99-999')
                ->addOrderBy('t.ca_nombre ASC')
                ->execute();

        $this->data = array();
        foreach ($traficos as $trafico) {
            $this->data[] = array("nombre" => utf8_encode($trafico->getCaNombre()),
                "idtrafico" => $trafico->getCaIdtrafico()
            );
        }
    }

    public function executeWgUsuario() {
        
    }

    public function executeWgParametros() {
        $this->data = array();

        $casos = explode(",", $this->caso_uso);
        $idvalor = explode(",", $this->idvalor);

        foreach ($casos as $k => $caso) {
            $datos = ParametroTable::retrieveByCaso($caso);
            if (!isset($idvalor[$k])) {
                $id = utf8_encode($dato->getCaIdentificacion());
            } else if ($idvalor[$k] == "id") {
                $id = utf8_encode($dato->getCaIdentificacion());
            } else if ($idvalor[$k] == "valor") {
                $id = utf8_encode($dato->getCaValor());
            } else if ($idvalor[$k] == "valor2") {
                $id = utf8_encode($dato->getCaValor2());
            }
            //$id=(!isset($idvalor[$k]))?utf8_encode($dato->getCaIdentificacion()):($id[$k]=="")
            foreach ($datos as $dato) {
                $this->data[] = array("id" => $id, "name" => utf8_encode($dato->getCaValor()), "caso_uso" => $dato->getCaCasouso());
            }
        }
    }

    public function executeWgAgentesAduana() {
        $con = Doctrine_Manager::getInstance()->connection();
        $sql = "select * from ids.tb_proveedores p inner join ids.tb_ids i "
                . "on (i.ca_id = p.ca_idproveedor) where p.ca_tipo = 'ADU'";

        $rs = $con->execute($sql);
        $this->data = array();
        $agentes_rs = $rs->fetchAll();
        foreach ($agentes_rs as $agente) {
            $this->data[] = array("id" => $agente["ca_idproveedor"],
                "nombre" => utf8_encode($agente["ca_nombre"]));
        }
    }

}

?>
