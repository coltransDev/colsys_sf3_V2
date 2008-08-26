<?php

/**
 * PricRecargo form base class.
 *
 * @package    form
 * @subpackage pric_recargo
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BasePricRecargoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idtrayecto'    => new sfWidgetFormInputHidden(),
      'ca_idrecargo'     => new sfWidgetFormInputHidden(),
      'ca_vlrrecargo'    => new sfWidgetFormInput(),
      'ca_vlrminimo'     => new sfWidgetFormInput(),
      'ca_idmoneda'      => new sfWidgetFormInput(),
      'ca_aplicacion'    => new sfWidgetFormInput(),
      'ca_observaciones' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idtrayecto'    => new sfValidatorPropelChoice(array('model' => 'Trayecto', 'column' => 'ca_idtrayecto', 'required' => false)),
      'ca_idrecargo'     => new sfValidatorPropelChoice(array('model' => 'PricRecargo', 'column' => 'ca_idrecargo', 'required' => false)),
      'ca_vlrrecargo'    => new sfValidatorNumber(),
      'ca_vlrminimo'     => new sfValidatorNumber(array('required' => false)),
      'ca_idmoneda'      => new sfValidatorString(array('max_length' => 3)),
      'ca_aplicacion'    => new sfValidatorString(array('required' => false)),
      'ca_observaciones' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('pric_recargo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PricRecargo';
  }


}
