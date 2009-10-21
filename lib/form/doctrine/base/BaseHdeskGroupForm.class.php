<?php

/**
 * HdeskGroup form base class.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseHdeskGroupForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idgroup'         => new sfWidgetFormInputHidden(),
      'ca_iddepartament'   => new sfWidgetFormDoctrineChoice(array('model' => 'Departamento', 'add_empty' => true)),
      'ca_name'            => new sfWidgetFormTextarea(),
      'ca_maxresponsetime' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'ca_idgroup'         => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idgroup', 'required' => false)),
      'ca_iddepartament'   => new sfValidatorDoctrineChoice(array('model' => 'Departamento', 'required' => false)),
      'ca_name'            => new sfValidatorString(array('required' => false)),
      'ca_maxresponsetime' => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('hdesk_group[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'HdeskGroup';
  }

}
