<?php

/**
 * parametros actions.
 *
 * @package    symfony
 * @subpackage parametros
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class parametrosActions extends sfActions
{

    /**
    * Executes index action
    *
    * @param sfRequest $request A request object
    */
    public function executeIndex(){
        
    }


    /**
    * Executes index action
    *
    * @param sfRequest $request A request object
    */
    public function executeBusqueda(){
        
    }


    /**
    * Datos de los conceptos para usar en pricing cotizaciones etc.
    *
    * @param sfRequest $request A request object
    */
    public function executeDatosConceptos(sfWebRequest $request)
    {		
		$transporte = utf8_decode($request->getParameter("transporte"));
		$modalidad = utf8_decode($request->getParameter("modalidad"));
		$impoexpo = utf8_decode($request->getParameter("impoexpo"));
		$tipo = utf8_decode($request->getParameter("tipo"));
		$modo = $request->getParameter("modo");

		$this->forward404Unless( $transporte );

		if( $modo=="recargos" ){			

			//$c->setLimit(3);
			$recargos = Doctrine::getTable("TipoRecargo")
                         ->createQuery("c")
                         ->where("c.ca_transporte = ? AND ca_tipo = ? AND c.ca_impoexpo like ?", array($transporte, $tipo, "%".$impoexpo."%" ))
                         ->addOrderBy( "c.ca_recargo" )
                         ->execute();

			$this->conceptos = array();
			foreach( $recargos as $recargo ){
				$row = array("idconcepto"=>$recargo->getCaIdrecargo(),
							 "concepto"=>utf8_encode($recargo->getCaRecargo())
							);
				$this->conceptos[]=$row;

			}
		}else{
			$this->forward404Unless( $modalidad );
				
			$conceptos = Doctrine::getTable("Concepto")
                         ->createQuery("c")
                         ->where("c.ca_transporte = ? AND c.ca_modalidad = ?", array($transporte, $modalidad ))
                         ->addOrderBy( "c.ca_liminferior" )
                         ->addOrderBy( "c.ca_concepto" )
                         ->execute();
			$this->conceptos = array();
			foreach( $conceptos as $concepto ){
				$row = array("idconcepto"=>$concepto->getCaIdconcepto(),
							 "concepto"=>utf8_encode($concepto->getCaConcepto())
							);
				$this->conceptos[]=$row;
			}

			$this->conceptos[] = array("idconcepto"=>9999,
								 "concepto"=>utf8_encode("Recargos generales del trayecto")
								);

		}

        $this->responseArray = array( "totalCount"=>count( $this->conceptos ), "root"=>$this->conceptos  );
		$this->setTemplate("responseTemplate");		

    }


    /**
    * Datos de los conceptos para usar en pricing cotizaciones etc.
    *
    * @param sfRequest $request A request object
    */
    public function executeFormConcepto(sfWebRequest $request){


        if( $request->getParameter("idconcepto") ){
            $concepto = Doctrine::getTable("InoConcepto")->find( $request->getParameter("idconcepto") );
            $this->forward404Unless($concepto);
        }else{
            $concepto = new InoConcepto();
        }
        $form = new myInoConceptoForm();


         if ($request->isMethod('post')){
             $bindValues = $request->getParameter($form->getName());
             //print_r( $bindValues );
             $form->bind( $bindValues );
             if( $form->isValid() ){

                $concepto->setCaConcepto($bindValues["ca_concepto"]);
                if( !$request->getParameter("idconcepto") ){
                    $concepto->setCaTipo($bindValues["ca_tipo"]);
                }
                $concepto->save();
                //$this->redirect("ino/verReferencia?id=".$this->referencia->getCaIdmaestra());
            }
         }

         $this->form = $form;
         $this->concepto = $concepto;

    }



}
