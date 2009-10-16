<?php

/**
 * CotContactoAg form base class.
 *
 * @package    form
 * @subpackage cot_contacto_ag
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseCotContactoAgForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idcontacto'   => new sfWidgetFormInputHidden(),
      'ca_idcotizacion' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'ca_idcontacto'   => new sfValidatorDoctrineChoice(array('model' => 'CotContactoAg', 'column' => 'ca_idcontacto', 'required' => false)),
      'ca_idcotizacion' => new sfValidatorDoctrineChoice(array('model' => 'CotContactoAg', 'column' => 'ca_idcotizacion', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cot_contacto_ag[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'CotContactoAg';
  }

}