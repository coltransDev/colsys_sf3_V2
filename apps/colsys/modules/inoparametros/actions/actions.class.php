<?php

/**
 * parametros actions.
 *
 * @package    symfony
 * @subpackage parametros
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class inoparametrosActions extends sfActions
{

    public function getNivel(){
        $this->modo = $this->getRequestParameter("modo");

        $this->nivel = -1;
		if( !$this->modo ){
			$this->forward( "parametros", "seleccionModo" );
		}
        return 1;
    }


    /*****************************************************************************
    *
    *   PARAMETRIZACION DE CONCEPTOS
    *
    *****************************************************************************/

    /**
    * Asocia los conceptos a cuentas contables
    *
    * @param sfRequest $request A request object
    */
    public function executeConceptos(){
        
    }


    /**
    * Datos de los conceptos para usar en pricing cotizaciones etc.
    *
    * @param sfRequest $request A request object
    */
    public function executeDatosPanelParametrosCuentas(sfWebRequest $request){
        $modo = $request->getParameter("modo");
        //$nivel = $this->getNivel();
        $nivel = 5;

        $idccosto = $request->getParameter("idccosto");

        $q = Doctrine::getTable("InoConcepto")
                         ->createQuery("c")
                         ->select("c.*, cu.ca_idcuenta, cu.ca_cuenta") //,
                         ->addOrderBy( "c.ca_concepto" );
        $modo = "fv";
        if( $modo == "fv" ){
            $q->leftJoin("c.InoParametroFacturacion p")
              ->leftJoin("p.InoCuenta cu")
              ->leftJoin("p.InoCuentaRetencion cr")
              ->addSelect("p.*, cu.ca_cuenta as ca_cuenta, cr.ca_cuenta as ca_cuentaretencion")
              ->addWhere("p.ca_idccosto = ? OR p.ca_idccosto IS NULL", $idccosto )
              ->addWhere("c.ca_recargolocal = ? OR c.ca_recargoorigen = ?", array(true, true));
        }

        if( $modo=="fc" ){
            $q->addWhere( "c.ca_costo = ? ", true);

            $q->leftJoin("c.InoParametroCosto p")
              ->leftJoin("p.InoCuenta cu")
              ->addSelect("p.*, cu.ca_cuenta as ca_cuenta ")
              ->addWhere("p.ca_idccosto = ? OR p.ca_idccosto IS NULL", $idccosto )
              ->addWhere("c.ca_costo = ? ", array(true));
        }
        

        $conceptos = $q->setHydrationMode(Doctrine::HYDRATE_SCALAR )->execute();

        $k = 0;
        foreach( $conceptos as $key=>$val ){
            //echo $conceptos[ $key ]["c_ca_idconcepto"]." -> ".$conceptos[ $key ]["cu_ca_idcuenta"]."<br >";
            $conceptos[ $key ]["c_ca_concepto"]=utf8_encode( $conceptos[ $key ]["c_ca_concepto"] );
            $conceptos[ $key ]["orden"]=str_pad($k,4, "0",STR_PAD_LEFT);
            $k++;

            if( $modo != "edicion" ){
                $conceptos[ $key ]["idccosto"]=$idccosto;
            }

            /*$modalidadesConcepto = Doctrine_Query::create()
                                ->select("cm.ca_idmodalidad")
                                ->from("InoConceptoModalidad cm")
                                ->where("cm.ca_idconcepto = ? ", $conceptos[ $key ]["c_ca_idconcepto"] )
                                ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                                ->execute();
            $modalidades = array();

            foreach( $modalidadesConcepto as $modalidadConcepto ){
                $modalidades[]=$modalidadConcepto["ca_idmodalidad"];
            }
            $conceptos[ $key ]["modalidades"] = implode( "|", $modalidades );*/


            if( $modo == "fv" && $conceptos[ $key ]["p_ca_iva"] ){
                $conceptos[ $key ]["p_ca_iva"] = $conceptos[ $key ]["p_ca_iva"]*100;
            }

        }

        if( $nivel>=1 && $this->modo=="edicion" ){
            $conceptos[] = array("ca_idconcepto"=>"", "ca_concepto"=>"", "orden"=>"Z");
        }

        $this->responseArray = array( "totalCount"=>count( $conceptos ), "root"=>$conceptos  );

		$this->setTemplate("responseTemplate");
    }



    /*
    * guarda el panel de conceptos
    * @param sfRequest $request A request object
    */
    public function executeGuardarPanelParametrosCuentas(sfWebRequest $request){
        $id = $request->getParameter("id");
        $this->responseArray=array("id"=>$id,  "success"=>false);

        $modo = $request->getParameter("modo");

        $tipo = $request->getParameter("tipo");

        $idconcepto = $request->getParameter("idconcepto");

        $this->forward404unless( $idconcepto );

        $concepto = Doctrine::getTable("InoConcepto")->find($idconcepto);
        $this->forward404Unless($concepto);
                

        if( $modo=="fv" ){
            //ca_idparametro
            $idccosto = $request->getParameter("idccosto");
            $parametro = Doctrine::getTable("InoParametroFacturacion")
                                   ->createQuery("p")
                                   ->where("p.ca_idconcepto = ? AND p.ca_idccosto = ?", array($concepto->getCaIdconcepto(), $idccosto) )
                                   ->fetchOne();

            if( !$parametro ){
                $parametro = new InoParametroFacturacion();
                $parametro->setCaIdconcepto( $concepto->getCaIdconcepto() );
                $parametro->setCaIdccosto( $idccosto );
            }
            if( $request->getParameter("idcuenta") ){
                $parametro->setCaIdcuenta( $request->getParameter("idcuenta") );
            }

            if( $request->getParameter("ingreso_propio")!==null ){
                $parametro->setCaIngreso_propio( $request->getParameter("ingreso_propio") );
            }

            if( $request->getParameter("iva")!==null ){
                $parametro->setCaIva( $request->getParameter("iva")/100 );
            }

            if( $request->getParameter("baseretencion")!==null ){
                $parametro->setCaBaseretencion( $request->getParameter("baseretencion") );
            }

            if( $request->getParameter("idcuentaretencion")!==null ){
                $parametro->setCaIdcuentaretencion( $request->getParameter("idcuentaretencion") );
            }

            if( $request->getParameter("valor")!==null ){
                $parametro->setCaValor( $request->getParameter("valor") );
            }
            $parametro->save();

        }

        if( $modo=="fc" ){
            //ca_idparametro
            $idccosto = $request->getParameter("idccosto");
            $parametro = Doctrine::getTable("InoParametroCosto")
                                   ->createQuery("p")
                                   ->where("p.ca_idconcepto = ? AND p.ca_idccosto = ?", array($concepto->getCaIdconcepto(), $idccosto) )
                                   ->fetchOne();

            if( !$parametro ){
                $parametro = new InoParametroCosto();
                $parametro->setCaIdconcepto( $concepto->getCaIdconcepto() );
                $parametro->setCaIdccosto( $idccosto );
            }
            if( $request->getParameter("idcuenta")!==null ){
                $parametro->setCaIdcuenta( $request->getParameter("idcuenta") );
            }

            if( $request->getParameter("ingreso_propio")!==null ){
                $parametro->setCaIngreso_propio( $request->getParameter("ingreso_propio") );
            }

            if( $request->getParameter("iva")!==null ){
                $parametro->setCaIva( $request->getParameter("iva")/100 );
            }

            if( $request->getParameter("baseretencion")!==null ){
                $parametro->setCaBaseretencion( $request->getParameter("baseretencion") );
            }

            if( $request->getParameter("idcuentaretencion")!==null ){
                $parametro->setCaIdcuentaretencion( $request->getParameter("idcuentaretencion") );
            }

            if( $request->getParameter("valor")!==null ){
                $parametro->setCaValor( $request->getParameter("valor") );
            }
            $parametro->save();

        }


        $this->responseArray["success"]=true;

        $this->responseArray["idconcepto"]=$concepto->getCaIdconcepto();


        $this->setTemplate("responseTemplate");
    }


    /*****************************************************************************
    *
    *   PARAMETRIZACION DE CUENTAS
    *
    *****************************************************************************/
    /**
    * Parametrización del PUC
    *
    * @param sfRequest $request A request object
    */
    public function executeCuentas(){

    }

    /**
    * Datos para el panel de parametros. 
    *
    * @param sfRequest $request A request object
    */
    public function executeDatosPanelCuentas(){
        $q = Doctrine::getTable("InoCuenta")
                       ->createQuery("c")
                       ->addOrderBy("c.ca_cuenta");

        $cuentas = $q->execute();

        $data = array();

        foreach( $cuentas as $cuenta ){
            $row = array();
            $row["idcuenta"]=$cuenta->getCaIdcuenta();
            $row["cuenta"]=$cuenta->getCaCuenta();
            $row["descripcion"]=utf8_encode($cuenta->getCaDescripcion());
            $row["naturaleza"]=utf8_encode($cuenta->getCaNaturaleza());
            $row["grupo"]=substr($cuenta->getCaCuenta(), 0, 1 );
            $data[] = $row;
        }

        $this->responseArray = array("root"=>$data, "total"=>count($data), "success"=>true );

        $this->setTemplate("responseTemplate");
    }


    /*****************************************************************************
    *
    *   PARAMETRIZACION DE COMPROBANTES
    *
    *****************************************************************************/
    /**
    * Parametrización de tipos de documentos
    *
    * @param sfRequest $request A request object
    */
    public function executeTiposComprobante(){

    }


    /**
    * Datos para el panel de tipos de comprobante.
    *
    * @param sfRequest $request A request object
    */
    public function executeDatosPanelTiposComprobante(){
        $q = Doctrine::getTable("InoTipoComprobante")
                       ->createQuery("t");
                       

        $tipos = $q->execute();

        $data = array();

        foreach( $tipos as $tipo ){
            $row = array();
            $row["idtipo"]=$tipo->getCaIdtipo();
            $row["tipo"]=$tipo->getCaTipo();
            $row["comprobante"]=utf8_encode($tipo->getCaComprobante());
            $row["descripcion"]=utf8_encode($tipo->getCaDescripcion());
            $row["titulo"]=utf8_encode($tipo->getCaTitulo());
            $data[] = $row;
        }

        $this->responseArray = array("root"=>$data, "total"=>count($data), "success"=>true );

        $this->setTemplate("responseTemplate");
    }



    /*****************************************************************************
    *
    *   PARAMETRIZACION DE CENTROS DE COSTOS
    *
    *****************************************************************************/
   

    


    

}
