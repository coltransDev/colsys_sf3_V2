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
class NuevaEvaluacionForm extends BaseForm {

    private $criterios;

    public function configure() {

        sfValidatorBase::setCharset('ISO-8859-1');


        $widgets = array();

        $choices = array();

        for( $i=5; $i>=2; $i--){
            $txt = $i;
            if( $i==5 ){
                $txt.=" - Excelente";
            }
            if( $i==4 ){
                $txt.=" - Bueno";
            }
            if( $i==3 ){
                $txt.=" - Regular";
            }

            if( $i==2 ){
                $txt.=" - Malo";
            }


            $choices[$i] = $txt;
        }

        $widgets['idtipo'] = new sfWidgetFormInputHidden();
        $criterios = $this->getCriterios();
        if ($criterios) {
            foreach ($criterios as $criterio) {

                $widgets['ponderacion_' . $criterio->getCaIdcriterio()] = new sfWidgetFormInputHidden(array(), array("size" => 5, "readOnly" => "true"));
                $widgets['calificacion_' . $criterio->getCaIdcriterio()] = new sfWidgetFormChoice(array(
                            'choices' => $choices
                    ), array( 'onchange'=>"check('".$criterio->getCaIdcriterio()."')" )
                );

                new sfWidgetFormInputText(array(), array("size" => 5));
                $widgets['observaciones_' . $criterio->getCaIdcriterio()] = new sfWidgetFormInputText(array(), array("size" => 30));
            }
        }

        $this->setWidgets($widgets);
        $validator = array();

        $validator["idtipo"] = new sfValidatorString(array('required' => false),
                        array('required' => 'Este campo es requerido'));

        if ($criterios) {
            foreach ($criterios as $criterio) {
                $validator['ponderacion_' . $criterio->getCaIdcriterio()] = new sfValidatorNumber(array('required' => true),
                                array('required' => 'Requerido'));
                $validator['calificacion_' . $criterio->getCaIdcriterio()] = new sfValidatorNumber(array('required' => true, "min" => 0, "max" => 10),
                                array('required' => 'Requerido'));
                $validator['observaciones_' . $criterio->getCaIdcriterio()] = new sfValidatorString(array('required' => false),
                                array('required' => 'Requerido'));
            }
        }





        $this->setValidators($validator);
        $this->validatorSchema->setPostValidator(
                new sfValidatorCallback(array('callback' => array($this, 'checkPonderacion')))
        );
    }

    public function bind(array $taintedValues = null, array $taintedFiles = null){
		/*$request = sfContext::getInstance()->getRequest();
		if ($request->hasParameter(self::$CSRFFieldName)){
			$taintedValues[self::$CSRFFieldName] = $request->getParameter(self::$CSRFFieldName);
		}*/

        $criterios = $this->getCriterios();
        if ($criterios) {
            foreach ( $criterios as $criterio ) {
                if( $taintedValues["calificacion_". $criterio->getCaIdcriterio()]<=3 ){
                    $this->validatorSchema['observaciones_' . $criterio->getCaIdcriterio()]->setOption('required', true);
                }
            }
        }




		parent::bind($taintedValues,  $taintedFiles);
	}

    public function checkPonderacion($validator, $values) {
        $criterios = $this->getCriterios();
        $ponderacion = 0;
        foreach ($criterios as $criterio) {
            $ponderacion+=$values['ponderacion_' . $criterio->getCaIdcriterio()];
        }

        if ($ponderacion != 100) {
            throw new sfValidatorError($validator, 'La ponderacion debe sumar 100');
        }

        return $values;
    }

    public function getCriterios() {
        return $this->criterios;
    }

    public function setCriterios($v) {
        $this->criterios = $v;
    }

}

?>
