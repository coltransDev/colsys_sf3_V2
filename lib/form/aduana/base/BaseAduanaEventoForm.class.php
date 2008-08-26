<?php

/**
 * AduanaEvento form base class.
 *
 * @package    form
 * @subpackage aduana_evento
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseAduanaEventoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_referencia' => new sfWidgetFormInputHidden(),
      'ca_realizado'  => new sfWidgetFormInput(),
      'ca_idevento'   => new sfWidgetFormInputHidden(),
      'ca_usuario'    => new sfWidgetFormInput(),
      'ca_fchevento'  => new sfWidgetFormDateTime(),
      'ca_notas'      => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_referencia' => new sfValidatorPropelChoice(array('model' => 'AduanaMaestra', 'column' => 'ca_referencia', 'required' => false)),
      'ca_realizado'  => new sfValidatorInteger(array('required' => false)),
      'ca_idevento'   => new sfValidatorPropelChoice(array('model' => 'AduanaEvento', 'column' => 'ca_idevento', 'required' => false)),
      'ca_usuario'    => new sfValidatorString(array('required' => false)),
      'ca_fchevento'  => new sfValidatorDateTime(array('required' => false)),
      'ca_notas'      => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('aduana_evento[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'AduanaEvento';
  }


}
