<?php

/**
 * Departamento form base class.
 *
 * @package    form
 * @subpackage departamento
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseDepartamentoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_iddepartamento' => new sfWidgetFormInputHidden(),
      'ca_nombre'         => new sfWidgetFormInput(),
      'ca_inhelpdesk'     => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'ca_iddepartamento' => new sfValidatorDoctrineChoice(array('model' => 'Departamento', 'column' => 'ca_iddepartamento', 'required' => false)),
      'ca_nombre'         => new sfValidatorString(array('max_length' => 30, 'required' => false)),
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