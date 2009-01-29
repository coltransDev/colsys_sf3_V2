<?php

/**
 * TRM form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseTRMForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_fecha'      => new sfWidgetFormInputHidden(),
      'ca_euro'       => new sfWidgetFormInput(),
      'ca_pesos'      => new sfWidgetFormInput(),
      'ca_libra'      => new sfWidgetFormInput(),
      'ca_fsuizo'     => new sfWidgetFormInput(),
      'ca_marco'      => new sfWidgetFormInput(),
      'ca_yen'        => new sfWidgetFormInput(),
      'ca_rupee'      => new sfWidgetFormInput(),
      'ca_ausdolar'   => new sfWidgetFormInput(),
      'ca_candolar'   => new sfWidgetFormInput(),
      'ca_cornoruega' => new sfWidgetFormInput(),
      'ca_singdolar'  => new sfWidgetFormInput(),
      'ca_rand'       => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_fecha'      => new sfValidatorPropelChoice(array('model' => 'TRM', 'column' => 'ca_fecha', 'required' => false)),
      'ca_euro'       => new sfValidatorNumber(array('required' => false)),
      'ca_pesos'      => new sfValidatorNumber(),
      'ca_libra'      => new sfValidatorNumber(array('required' => false)),
      'ca_fsuizo'     => new sfValidatorNumber(array('required' => false)),
      'ca_marco'      => new sfValidatorNumber(array('required' => false)),
      'ca_yen'        => new sfValidatorNumber(array('required' => false)),
      'ca_rupee'      => new sfValidatorNumber(array('required' => false)),
      'ca_ausdolar'   => new sfValidatorNumber(array('required' => false)),
      'ca_candolar'   => new sfValidatorNumber(array('required' => false)),
      'ca_cornoruega' => new sfValidatorNumber(array('required' => false)),
      'ca_singdolar'  => new sfValidatorNumber(array('required' => false)),
      'ca_rand'       => new sfValidatorNumber(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('trm[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TRM';
  }


}
