<?php

/**
 * inotipodocumentos actions.
 *
 * @package    symfony
 * @subpackage inotipodocumentos
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class inotipocomprobanteActions extends sfActions
{
    /**
    * Executes index action
    *
    * @param sfRequest $request A request object
    */
    public function executeIndex(sfWebRequest $request)
    {
        $this->tipos = Doctrine::getTable( "InoTipoComprobante")
                           ->createQuery("t")
                           ->select("t.*")
                           ->addOrderBy("t.ca_tipo")
                           ->addOrderBy("t.ca_comprobante")
                           ->execute();
    }


    /**
    * Executes index action
    *
    * @param sfRequest $request A request object
    */
    public function executeFormTipo(sfWebRequest $request)
    {
        $form = new InoTipoComprobanteForm();

        if( $request->getParameter("id") ){
            $tipo = Doctrine::getTable("InoTipoComprobante")->find($request->getParameter("id"));
            $this->forward404Unless( $tipo );
        }else{
            $tipo = new InoTipoComprobante();
        }

        if ($request->isMethod('post')){
            $bindValues = $request->getParameter( $form->getName() );
            $form->bind( $bindValues );
            if( $form->isValid() ){
                $tipo->setCaTipo( $bindValues["ca_tipo"] );
                $tipo->setCaComprobante( $bindValues["ca_comprobante"] );
                $tipo->setCaTitulo( $bindValues["ca_titulo"] );
                $tipo->setCaMensaje( $bindValues["ca_mensaje"] );

                if( $bindValues["ca_activo"] ){
                    $tipo->setCaActivo( true );
                }else{
                    $tipo->setCaActivo( false );
                }
                $tipo->setCaNumeracionInicial( $bindValues["ca_numeracion_inicial"] );
                $tipo->setCaNoautorizacion( $bindValues["ca_noautorizacion"] );
                $tipo->setCaPrefijoAut( $bindValues["ca_prefijo_aut"] );
                $tipo->setCaInicialAut( $bindValues["ca_inicial_aut"] );
                $tipo->setCaFinalAut( $bindValues["ca_final_aut"] );
                $tipo->save();
                $this->redirect("inotipocomprobante/index");
            }
        }

        $this->form = $form;
        $this->tipo = $tipo;

    }


    /**
    * Comprueba si ya existe un tipo de comprobante
    *
    * @param sfRequest $request A request object
    */
    public function executeComprobarTipo(sfWebRequest $request)
    {
        $tipo = Doctrine::getTable("InoTipoComprobante")
                        ->createQuery("t")
                        ->select("t.*")
                        ->where("t.ca_tipo = ? AND t.ca_comprobante = ?", array($request->getParameter("tipo"), $request->getParameter("comprobante")))
                        ->fetchOne();
        if( $tipo ){
            $this->responseArray=array("success"=>true, "id"=>$tipo->getCaIdtipo());
        }else{
            $this->responseArray=array("success"=>true);
        }
        $this->setTemplate("responseTemplate");

    }

}
