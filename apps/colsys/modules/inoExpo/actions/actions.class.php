<?php

/**
 * inoExpo actions.
 *
 * @package    symfony
 * @subpackage inoExpo
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class inoExpoActions extends sfActions {

    /**
     * Abre, cierra o liquida un caso de exportaciones
     *
     * @param sfRequest $request A request object
     */
    public function executeLiquidarCerrarReferencia(sfWebRequest $request) {
        $noReferencia = $request->getParameter("referencia");
        $this->forward404Unless($noReferencia);
        
        $referencia = Doctrine::getTable("InoMaestraExpo")->find( $noReferencia );
        $this->forward404Unless($referencia);
        
        if( $referencia->getCaFchliquidado() ){
            if( $referencia->getCaFchcerrado() ){
                $referencia->setCaFchcerrado(null);
                $referencia->setCaUsucerrado(null);
                $referencia->save();
            }else{

                $numIngresos = Doctrine::getTable("InoIngresosExpo")
                                    ->createQuery("i")
                                    ->select("count(*)")
                                    ->where("i.ca_referencia = ?", $referencia->getCaReferencia())
                                    ->setHydrationMode(Doctrine::HYDRATE_SINGLE_SCALAR)
                                    ->execute();

                if( $numIngresos==0 ){
                    $this->mensaje = "No puede cerrar un caso sin facturas de cliente";
                    $this->referencia = $referencia;
                    return sfView::ERROR;
                }

                $numCostos = Doctrine::getTable("InoCostoExpo")
                                    ->createQuery("i")
                                    ->select("count(*)")
                                    ->where("i.ca_referencia = ?", $referencia->getCaReferencia())
                                    ->setHydrationMode(Doctrine::HYDRATE_SINGLE_SCALAR)
                                    ->execute();

                if( $numCostos==0 ){
                    $this->mensaje = "No puede cerrar un caso sin facturas de costos";
                    $this->referencia = $referencia;
                    return sfView::ERROR;
                }

                $referencia->setCaFchcerrado(date("Y-m-d H:i:s"));
                $referencia->setCaUsucerrado($this->getUser()->getUserId());
                $referencia->save();
            }
        }else{
            $this->mensaje = "No puede cerrar un caso sin liquidarlo";
            $this->referencia = $referencia;
            return sfView::ERROR;
        }
        
        $this->redirect("/Coltrans/Expo/ConsultaReferenciaAction.do?referencia=".$referencia->getCaReferencia());
    }
    
    public function executeFormAlerta(sfWebRequest $request) {
        $noReferencia = $request->getParameter("referencia");
        $this->forward404Unless($noReferencia);
        
        $referencia = Doctrine::getTable("InoMaestraExpo")->find( $noReferencia );
        $this->forward404Unless($referencia);
        
        if( $request->getParameter("idalerta") ){
            $expoAlerta = Doctrine::getTable("ExpoAlerta")->find( $request->getParameter("idalerta") );
            $this->forward404Unless($expoAlerta);
        }else{
            $expoAlerta = new ExpoAlerta();
        }
        
        
        $this->form = new AlertaForm();        
        $this->form->configure();
          
        
        
        
        
        if ($request->isMethod('post')) {

            $bindValues = array();

            $bindValues["referencia"] = $request->getParameter("referencia");
            $bindValues["fchrecordatorio"] = $request->getParameter("fchrecordatorio");
            $bindValues["fchvencimiento"] = $request->getParameter("fchvencimiento");
            $bindValues["cuerpoalerta"] = $request->getParameter("cuerpoalerta");
            $bindValues["notificar"] = $request->getParameter("notificar");
            $bindValues["notificar_jefe"] = $request->getParameter("notificar_jefe");
            $bindValues["copiarChkbox"] = $request->getParameter("copiarChkbox");
            
            $this->form->bind($bindValues);

            if ($this->form->isValid()) {
                $expoAlerta->setCaReferencia($bindValues["referencia"]);
                $expoAlerta->setCaFchrecordatorio($bindValues["fchrecordatorio"]);
                $expoAlerta->setCaFchvencimiento($bindValues["fchvencimiento"]);
                $expoAlerta->setCaCuerpoalerta($bindValues["cuerpoalerta"]);   
                
                if( $bindValues["copiarChkbox"] ){
                    $expoAlerta->setCaNotificar($bindValues["notificar"]);
                    $expoAlerta->setCaNotificarJefe($bindValues["notificar_jefe"]);
                }else{
                    $expoAlerta->setCaNotificar( null );
                }
                
                $expoAlerta->save();
                
                $this->redirect("/Coltrans/Expo/ConsultaReferenciaAction.do?referencia=".$referencia->getCaReferencia());
            }
        }
        
        $this->referencia = $referencia;
        $this->expoAlerta = $expoAlerta;
    }
    

}
