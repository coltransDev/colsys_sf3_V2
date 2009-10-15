<?php

/**
 * Departamento form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseDepartamentoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_iddepartamento' => new sfWidgetFormInputHidden(),
      'ca_nombre'         => new sfWidgetFormInput(),
      'ca_inhelpdesk'     => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'ca_iddepartamento' => new sfValidatorPropelChoice(array('model' => 'Departamento', 'column' => 'ca_iddepartamento', 'required' => false)),
      'ca_nombre'         => new sfValidatorString(array('required' => false)),
      'ca_inhelpdesk'     => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('departamento[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Departamento';
  }


}
