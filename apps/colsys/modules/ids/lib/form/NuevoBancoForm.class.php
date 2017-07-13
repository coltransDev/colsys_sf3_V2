<?php

/*
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

/**
 * Description of NuevoBancoForm
 *
 * @author clopez
 */
class NuevoBancoForm extends BaseForm {

    private $codigos_entidad;
    private $tipos_cuenta;

    public function configure() {

        sfValidatorBase::setCharset('ISO-8859-1');

        $widgets = array();
        $validator = array();
        
        $tiposCuenta = $this->getTiposCuenta();
        $choices = array();
        if (count($tiposCuenta) > 0) {
            foreach ($tiposCuenta as $tipo) {
                $choices[$tipo] = $tipo;
            }
        }

        $widgets['tipo_cuenta'] = new sfWidgetFormChoice(array(
            'choices' => $choices,
                )
        );
        
        $codigosEntidad = $this->getCodigosEntidad();
        $choices = array();
        if (count($codigosEntidad) > 0) {
            foreach ($codigosEntidad as $codigo) {
                $choices[$codigo["ca_idvalue"]] = $codigo["ca_value"];
            }
        }

        $widgets['codigo_entidad'] = new sfWidgetFormChoice(array(
            'choices' => $choices,
                )
        );

        $widgets['numero_cuenta'] = new sfWidgetFormInputText(array(), array("size"=>50 ));
        $widgets['observaciones'] = new sfWidgetFormTextarea(array(), array("rows" => 3, "cols" => 80));        
        
        $this->setWidgets($widgets);

        $validator["tipo_cuenta"] = new sfValidatorString(array('required' => true), array('required' => 'El tipo de cuenta es requerido'));
        $validator["codigo_entidad"] = new sfValidatorString(array('required' => true), array('required' => 'El campo entidad es requerido'));
        $validator["numero_cuenta"] = new sfValidatorString(array('required' => true), array('required' => 'El campo numero de cuenta es requerido'));
        $validator["observaciones"] = new sfValidatorString(array('required' => false));

        $this->setValidators($validator);
    }

    public function bind(array $taintedValues = null, array $taintedFiles = null) {
        parent::bind($taintedValues, $taintedFiles);
    }

    public function getCodigosEntidad() {
        return $this->codigos_entidad;
    }

    public function setCodigosEntidad($v) {
        $this->codigos_entidad = $v;
    }

    public function getTiposCuenta() {
        return $this->tipos_cuenta;
    }

    public function setTiposCuenta($v) {
        $this->tipos_cuenta = $v;
    }
}
?>