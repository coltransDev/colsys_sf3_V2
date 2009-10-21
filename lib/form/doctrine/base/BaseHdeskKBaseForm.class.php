<?php

/**
 * HdeskKBase form base class.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseHdeskKBaseForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idkbase'    => new sfWidgetFormInputHidden(),
      'ca_idcategory' => new sfWidgetFormDoctrineChoice(array('model' => 'HdeskKBaseCategory', 'add_empty' => true)),
      'ca_login'      => new sfWidgetFormTextarea(),
      'ca_createdat'  => new sfWidgetFormDateTime(),
      'ca_text'       => new sfWidgetFormTextarea(),
      'ca_title'      => new sfWidgetFormTextarea(),
      'ca_private'    => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'ca_idkbase'    => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idkbase', 'required' => false)),
      'ca_idcategory' => new sfValidatorDoctrineChoice(array('model' => 'HdeskKBaseCategory', 'required' => false)),
      'ca_login'      => new sfValidatorString(array('required' => false)),
      'ca_createdat'  => new sfValidatorDateTime(array('required' => false)),
      'ca_text'       => new sfValidatorString(array('required' => false)),
      'ca_title'      => new sfValidatorString(array('required' => false)),
      'ca_private'    => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('hdesk_k_base[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'HdeskKBase';
  }

}
