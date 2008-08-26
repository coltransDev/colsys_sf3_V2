<?php

/**
 * AduanaEventoExtra form base class.
 *
 * @package    form
 * @subpackage aduana_evento_extra
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseAduanaEventoExtraForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_referencia'     => new sfWidgetFormPropelSelect(array('model' => 'AduanaMaestra', 'add_empty' => false)),
      'ca_idevento'       => new sfWidgetFormInputHidden(),
      'ca_usucreado'      => new sfWidgetFormInput(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_fchactualizado' => new sfWidgetFormDate(),
      'ca_usuactualizado' => new sfWidgetFormInput(),
      'ca_texto'          => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_referencia'     => new sfValidatorPropelChoice(array('model' => 'AduanaMaestra', 'column' => 'ca_referencia')),
      'ca_idevento'       => new sfValidatorPropelChoice(array('model' => 'AduanaEventoExtra', 'column' => 'ca_idevento', 'required' => false)),
      'ca_usucreado'      => new sfValidatorString(array('required' => false)),
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
      'ca_fchactualizado' => new sfValidatorDate(array('required' => false)),
      'ca_usuactualizado' => new sfValidatorString(array('required' => false)),
      'ca_texto'          => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('aduana_evento_extra[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'AduanaEventoExtra';
  }


}
