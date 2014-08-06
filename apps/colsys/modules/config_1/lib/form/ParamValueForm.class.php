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
class ParamValueForm extends BaseForm {

    public function configure() {

        sfValidatorBase::setCharset('ISO-8859-1');

        $widgets = array();
        $widgets['idvalue'] = new sfWidgetFormInputHidden();
        $widgets['idconfig'] = new sfWidgetFormInputHidden();
        $widgets['value'] = new sfWidgetFormInputText();
        $widgets['value2'] = new sfWidgetFormTextarea(array(), array("size" => "50x20"));
        $widgets['ident'] = new sfWidgetFormInputText();


        $this->setWidgets($widgets);
        
        $validator = array();
        $validator["idvalue"] = new sfValidatorString(array('required' => false),
                        array('required' => 'Este campo es requerido'));
        $validator["idconfig"] = new sfValidatorString(array('required' => true),
                        array('required' => 'Este campo es requerido'));
        $validator["value"] = new sfValidatorString(array('required' => true),
                        array('required' => 'Este campo es requerido'));
        $validator["value2"] = new sfValidatorString(array('required' => false),
                        array('required' => 'Este campo es requerido'));

        $validator["ident"] = new sfValidatorString(array('required' => true),
                        array('required' => 'Este campo es requerido'));


        $this->setValidators($validator);
    }

}

?>
