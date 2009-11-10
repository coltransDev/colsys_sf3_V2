<?php

/**
 * Departamento form base class.
 *
 * @method Departamento getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseDepartamentoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_iddepartamento' => new sfWidgetFormInputHidden(),
      'ca_nombre'         => new sfWidgetFormInputText(),
      'ca_inhelpdesk'     => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'ca_iddepartamento' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_iddepartamento', 'required' => false)),
      'ca_nombre'         => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'ca_inhelpdesk'     => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('departamento[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Departamento';
  }

}
