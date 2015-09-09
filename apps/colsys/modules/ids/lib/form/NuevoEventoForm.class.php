<?php

/*
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

/**
 * Description of NuevoEventoForm
 *
 * @author abotero
 */
class NuevoEventoForm extends BaseForm {

    private $idproveedor;
    private $tipo;
    private $criterios;

    public function configure() {

        sfValidatorBase::setCharset('ISO-8859-1');

        $widgets = array();
        $validator = array();
        
        $criterios = $this->getCriterios();
        $choices = array();
        if (count($criterios) > 0) {
            foreach ($criterios as $criterio) {
                $choices[$criterio->getCaIdcriterio()] = $criterio->getCaCriterio();
            }
        }

        $widgets['tipo_evento'] = new sfWidgetFormChoice(array(
            'choices' => $choices,
                )
        );

        $widgets['evento'] = new sfWidgetFormTextarea(array(), array("rows" => 3, "cols" => 80));        
        $widgets['referencia'] = new sfWidgetFormInputText(array(), array("size"=>15 ));
        
        $idproveedor = $this->getIdproveedor();
        if ($idproveedor) {
            $choices = array();

            $proveedor = Doctrine::getTable("Ids")->find($idproveedor);
            $choices[$proveedor->getCaId()] = $proveedor->getCaNombre();

            $widgets['id'] = new sfWidgetFormChoice(array(
                'choices' => $choices,
                    )
            );
        }
        $this->setWidgets($widgets);

        $validator["id"] = new sfValidatorString(array('required' => true), array('required' => 'El proveedor es requerido'));
        $validator["tipo_evento"] = new sfValidatorString(array('required' => true), array('required' => 'El tipo de evento es requerido'));
        $validator["evento"] = new sfValidatorString(array('required' => true), array('required' => 'El evento es requerido'));
        $validator["referencia"] = new sfValidatorString( array('required' => false ),array('required' => 'Este campo es requerido'));

        $this->setValidators($validator);
    }

    public function bind(array $taintedValues = null, array $taintedFiles = null) {
        parent::bind($taintedValues, $taintedFiles);
    }

    public function setIdproveedor($v) {
        $this->idproveedor = $v;
    }

    public function getIdproveedor() {
        return $this->idproveedor;
    }

    public function setTipo($v) {
        $this->tipo = $v;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function getCriterios() {
        return $this->criterios;
    }

    public function setCriterios($v) {
        $this->criterios = $v;
    }
}
?>