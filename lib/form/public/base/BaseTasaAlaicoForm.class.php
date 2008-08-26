<?php

/**
 * TasaAlaico form base class.
 *
 * @package    form
 * @subpackage tasa_alaico
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseTasaAlaicoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_fechainicial' => new sfWidgetFormInputHidden(),
      'ca_fechafinal'   => new sfWidgetFormDate(),
      'ca_valortasa'    => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_fechainicial' => new sfValidatorPropelChoice(array('model' => 'TasaAlaico', 'column' => 'ca_fechainicial', 'required' => false)),
      'ca_fechafinal'   => new sfValidatorDate(),
      'ca_valortasa'    => new sfValidatorString(),
    ));

    $this->widgetSchema->setNameFormat('tasa_alaico[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TasaAlaico';
  }


}
