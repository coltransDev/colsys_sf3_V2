<?

class UtilidadesNewForm extends BaseForm {

   private $referencia = null;
   private $inoclientes = array();

   public function configure() {

      sfValidatorBase::setCharset('ISO-8859-1');

      $widgets = array();
      $validator = array();

       $widgets["referencia"] = new sfWidgetFormInputHidden();

      foreach ($this->inoclientes as $ic) {
         $widgets["util_" . $ic->getCaIdinocliente()] = new sfWidgetFormInputText(array(), array("size" => 15, "maxlength" => 15, "onchange" => "calcular()"));
         $validator["util_" . $ic->getCaIdinocliente()] = new sfValidatorNumber(array('required' => true),
                         array('required' => 'Requerido',
                             'invalid' => 'No valido'));
      }

      $this->setWidgets($widgets);

      $validator['referencia'] = new sfValidatorString(array('required' => false),
                      array('required' => 'Requerido',
                          'invalid' => 'No valido'));
      $this->setValidators($validator);

   }

   public function bind(array $taintedValues = null, array $taintedFiles = null) {

      parent::bind($taintedValues, $taintedFiles);
   }

   public function setReferencia($v) {
      $this->referencia = $v;
   }

   public function setInoClientes($v) {
      $this->inoclientes = $v;
   }

}
?>