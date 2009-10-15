<?php

/**
 * BavariaNotify form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseBavariaNotifyForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_consecutivo' => new sfWidgetFormInputHidden(),
      'ca_fchenvio'    => new sfWidgetFormDateTime(),
      'ca_usuenvio'    => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_consecutivo' => new sfValidatorPropelChoice(array('model' => 'BavariaNotify', 'column' => 'ca_consecutivo', 'required' => false)),
      'ca_fchenvio'    => new sfValidatorDateTime(array('required' => false)),
      'ca_usuenvio'    => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('bavaria_notify[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'BavariaNotify';
  }


}
