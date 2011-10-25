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
class CriteriosForm extends BaseForm{

     

     private $criterios;

     public function configure(){

		sfValidatorBase::setCharset('ISO-8859-1');


		$widgets = array();

		$widgets['impoexpo'] = new sfWidgetFormInputHidden();
        $widgets['transporte'] = new sfWidgetFormInputHidden();
        $widgets['tipo'] = new sfWidgetFormInputHidden();
        $widgets['tipoprov'] = new sfWidgetFormInputHidden();
        
        $criterios = $this->getCriterios();
        if( $criterios ){            
            foreach( $criterios as $criterio ){               
                $widgets['ponderacion_'.$criterio->getCaIdcriterio()] = new sfWidgetFormInputText(array(), array("size"=>5 ));               
            }
        }
        
        $this->setWidgets( $widgets );
        $validator = array();        		

        $validator["impoexpo"] =new sfValidatorString( array('required' => false ),
														array('required' => 'Este campo es requerido'));
        $validator["transporte"] =new sfValidatorString( array('required' => false ),
														array('required' => 'Este campo es requerido'));
       

        $validator["tipo"] =new sfValidatorString( array('required' => true ),
														array('required' => 'Este campo es requerido'));

        $validator["tipoprov"] =new sfValidatorString( array('required' => true ),
														array('required' => 'Este campo es requerido'));

        if( $criterios ){
            foreach( $criterios as $criterio ){
                $validator['ponderacion_'.$criterio->getCaIdcriterio()] = new sfValidatorNumber( array('required' => true ),
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
