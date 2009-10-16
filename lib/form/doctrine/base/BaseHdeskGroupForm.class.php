<?php

/**
 * HdeskGroup form base class.
 *
 * @package    form
 * @subpackage hdesk_group
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseHdeskGroupForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idgroup'         => new sfWidgetFormInputHidden(),
      'ca_iddepartament'   => new sfWidgetFormDoctrineSelect(array('model' => 'Departamento', 'add_empty' => true)),
      'ca_name'            => new sfWidgetFormInput(),
      'ca_maxresponsetime' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idgroup'         => new sfValidatorDoctrineChoice(array('model' => 'HdeskGroup', 'column' => 'ca_idgroup', 'required' => false)),
      'ca_iddepartament'   => new sfValidatorDoctrineChoice(array('model' => 'Departamento', 'required' => false)),
      'ca_name'            => new sfValidatorString(array('required' => false)),
      'ca_maxresponsetime' => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('hdesk_group[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'HdeskGroup';
  }

}