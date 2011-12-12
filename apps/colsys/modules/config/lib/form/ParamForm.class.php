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
class ParamForm extends BaseForm{

     
     public function configure(){

		sfValidatorBase::setCharset('ISO-8859-1');


		$widgets = array();

		$widgets['idconfig'] = new sfWidgetFormInputHidden();
        $widgets['module'] = new sfWidgetFormInputText();
        $widgets['param'] = new sfWidgetFormInputText();
        $widgets['description'] = new sfWidgetFormTextarea(array(),array("size"=>"50x20" ));
        
        
        $this->setWidgets( $widgets );
        $validator = array();        		

        $validator["idconfig"] =new sfValidatorString( array('required' => false ),
														array('required' => 'Este campo es requerido'));
        $validator["module"] =new sfValidatorString( array('required' => false ),
														array('required' => 'Este campo es requerido'));
       

        $validator["param"] =new sfValidatorString( array('required' => true ),
														array('required' => 'Este campo es requerido'));
        
         $validator["description"] =new sfValidatorString( array('required' => true ),
														array('required' => 'Este campo es requerido'));

        
        $this->setValidators( $validator );
        
    }
    
}
?>
