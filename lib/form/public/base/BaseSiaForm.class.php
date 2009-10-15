<?php

/**
 * Sia form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
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
