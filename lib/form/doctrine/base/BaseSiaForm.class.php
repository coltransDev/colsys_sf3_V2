<?php

/**
 * Sia form base class.
 *
 * @package    form
 * @subpackage sia
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseSiaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idsia'    => new sfWidgetFormInputHidden(),
      'ca_nombre'   => new sfWidgetFormInput(),
      'ca_tel'      => new sfWidgetFormInput(),
      'ca_contacto' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idsia'    => new sfValidatorDoctrineChoice(array('model' => 'Sia', 'column' => 'ca_idsia', 'required' => false)),
      'ca_nombre'   => new sfValidatorString(array('required' => false)),
      'ca_tel'      => new sfValidatorString(array('required' => false)),
      'ca_contacto' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sia[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Sia';
  }

}