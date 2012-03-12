<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

/**
 * Description of NuevaEvaluacion
 *
 * @author abotero
 */
class NuevaEvaluacionForm extends BaseForm{

     

     private $criterios;

     public function configure(){

		sfValidatorBase::setCharset('ISO-8859-1');


		$widgets = array();



		$widgets['concepto'] = new sfWidgetFormInputHidden();
        $widgets['fchevaluacion'] = new sfWidgetFormExtDate();
        $widgets['ano'] = new sfWidgetFormInputText(array(), array("size"=>10, "readOnly"=>"true" ));
        $widgets['periodo'] = new sfWidgetFormInputText(array(), array("size"=>10, "readOnly"=>"true" ));
        $widgets['tipo'] = new sfWidgetFormChoice(array(
  								'choices' => array( "desempeno"=>"Desempe&ntilde;o", 
													"reevaluacion"=>"Reevaluacion: Desempe&ntilde;o" 
                                                  )
													
								));
        
        
        
        $criterios = $this->getCriterios();
        if( $criterios ){            
            foreach( $criterios as $criterio ){
               
                $widgets['ponderacion_'.$criterio->getCaIdcriterio()] = new sfWidgetFormInputText(array(), array("size"=>5 , "readOnly"=>"true"));
                $widgets['calificacion_'.$criterio->getCaIdcriterio()] = new sfWidgetFormInputText(array(), array("size"=>5 ));
                $widgets['observaciones_'.$criterio->getCaIdcriterio()] = new sfWidgetFormInputText(array(), array("size"=>50));
            }
        }
        
        $this->setWidgets( $widgets );
        $validator = array();        		

        $validator["tipo"] =new sfValidatorString( array('required' => false ),
														array('required' => 'Este campo es requerido'));
        $validator["concepto"] =new sfValidatorString( array('required' => false ),
														array('required' => 'Este campo es requerido'));
        /*$validator["fchevaluacion"] =new sfValidatorString( array('required' => true ),
														array('required' => 'Este campo es requerido'));*/

        $validator["ano"] =new sfValidatorString( array('required' => true ),
														array('required' => 'Este campo es requerido'));

        $validator["periodo"] =new sfValidatorString( array('required' => true ),
														array('required' => 'Este campo es requerido'));

        if( $criterios ){
            foreach( $criterios as $criterio ){
                $validator['ponderacion_'.$criterio->getCaIdcriterio()] = new sfValidatorNumber( array('required' => true ),
														array('required' => 'Requerido'));
                $validator['calificacion_'.$criterio->getCaIdcriterio()] = new sfValidatorNumber( array('required' => true,  "min"=>0, "max"=>10 ),
														array('required' => 'Requerido'));
                $validator['observaciones_'.$criterio->getCaIdcriterio()] = new sfValidatorString( array('required' => false ),
														array('required' => 'Requerido'));
            }
        }

        
        

       
        $this->setValidators( $validator );
        $this->validatorSchema->setPostValidator(
              new sfValidatorCallback(array('callback' => array($this, 'checkPonderacion')))
            );
    }


   

    public function checkPonderacion($validator, $values)
    {       
        $criterios = $this->getCriterios();
        $ponderacion = 0;
        foreach( $criterios as $criterio ){
            $ponderacion+=$values['ponderacion_'.$criterio->getCaIdcriterio()];
        }
        
        if( $ponderacion!=100 ){
            throw new sfValidatorError($validator, 'La ponderacion debe sumar 100');
        }

        return $values;
    }



    public function getCriterios(){
        return $this->criterios;
    }

    public function setCriterios( $v ){
        $this->criterios = $v;
        
    }

    
}
?>
