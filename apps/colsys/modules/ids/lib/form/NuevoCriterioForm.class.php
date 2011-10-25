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
class NuevoCriterioForm extends BaseForm{

     

     

     public function configure(){

		sfValidatorBase::setCharset('ISO-8859-1');


		$widgets = array();

		$widgets['tipoprov'] = new sfWidgetFormInputHidden();        
        $widgets['tipo_eval'] = new sfWidgetFormChoice(array(
															  'choices' => array('seleccion'=>'Selección',
                                                                                 'desempeno'=>'Desempeño'
                                                                                )
															)
                                                    );        
        $widgets['nombre'] = new sfWidgetFormInputText(array(), array("size"=>100, "maxlength"=>80));
        $this->setWidgets( $widgets );
        
        
        $validator = array();        		
        $validator["tipoprov"] =new sfValidatorString( array('required' => true ),
														array('required' => 'Este campo es requerido'));
        $validator["tipo_eval"] =new sfValidatorString( array('required' => true ),
														array('required' => 'Este campo es requerido'));
       

        $validator["nombre"] =new sfValidatorString( array('required' => true ),
														array('required' => 'Este campo es requerido'));
       
       
        $this->setValidators( $validator );
        
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
