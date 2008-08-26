<?php

/**
 * Sia form base class.
 *
 * @package    form
 * @subpackage sia
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseSiaForm extends BaseFormPropel
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
      'ca_idsia'    => new sfValidatorPropelChoice(array('model' => 'Sia', 'column' => 'ca_idsia', 'required' => false)),
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
