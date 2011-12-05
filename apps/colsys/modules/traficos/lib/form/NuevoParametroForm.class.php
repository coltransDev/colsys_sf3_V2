<?php
class NuevoParametroForm extends BaseForm {

    private $widgetsClientes = array();

    public function configure() {

        sfValidatorBase::setCharset('ISO-8859-1');

        $widgets = array();
        $validator = array();


        foreach ($this->widgetsClientes as $name => $val) {

            $type = $val["type"];
            if ($type == "date") {
                $widgets[$name] = new sfWidgetFormExtDate();
                $validator[$name] = new sfValidatorDate(array('required' => false));
            } else {
                $widgets[$name] = new sfWidgetFormInputText();
                $validator[$name] = new sfValidatorString(array('required' => false));
            }
        }


        $this->setWidgets($widgets);

        $this->setValidators($validator);
    }

    public function bind(array $taintedValues = null, array $taintedFiles = null) {
        parent::bind($taintedValues, $taintedFiles);
    }


    public function getWidgetsClientes() {
        return $this->widgetsClientes;
    }

    public function setWidgetsClientes($parametros) {

        foreach ($parametros as $parametro) {

            $valor = explode(":", $parametro->getCaValor());
            $name = $valor[0];
            $type = $valor[1];

            $this->widgetsClientes[$name] = array("type" => $type, "label" => $parametro->getCaValor2());
        }
    }

}