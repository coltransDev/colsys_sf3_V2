<?php

/**
 * Costo form base class.
 *
 * @package    form
 * @subpackage costo
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseCostoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idcosto'      => new sfWidgetFormInputHidden(),
      'ca_costo'        => new sfWidgetFormInput(),
      'ca_transporte'   => new sfWidgetFormInput(),
      'ca_impoexpo'     => new sfWidgetFormInput(),
      'ca_modalidad'    => new sfWidgetFormInput(),
      'ca_comisionable' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idcosto'      => new sfValidatorPropelChoice(array('model' => 'Costo', 'column' => 'ca_idcosto', 'required' => false)),
      'ca_costo'        => new sfValidatorString(),
      'ca_transporte'   => new sfValidatorString(),
      'ca_impoexpo'     => new sfValidatorString(),
      'ca_modalidad'    => new sfValidatorString(array('required' => false)),
      'ca_comisionable' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('costo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Costo';
  }


}
