<?php

/**
 * HdeskKBase form base class.
 *
 * @package    form
 * @subpackage hdesk_k_base
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseHdeskKBaseForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idkbase'    => new sfWidgetFormInputHidden(),
      'ca_idcategory' => new sfWidgetFormDoctrineSelect(array('model' => 'HdeskKBaseCategory', 'add_empty' => true)),
      'ca_login'      => new sfWidgetFormInput(),
      'ca_createdat'  => new sfWidgetFormDateTime(),
      'ca_text'       => new sfWidgetFormInput(),
      'ca_title'      => new sfWidgetFormInput(),
      'ca_private'    => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'ca_idkbase'    => new sfValidatorDoctrineChoice(array('model' => 'HdeskKBase', 'column' => 'ca_idkbase', 'required' => false)),
      'ca_idcategory' => new sfValidatorDoctrineChoice(array('model' => 'HdeskKBaseCategory', 'required' => false)),
      'ca_login'      => new sfValidatorString(array('required' => false)),
      'ca_createdat'  => new sfValidatorDateTime(array('required' => false)),
      'ca_text'       => new sfValidatorString(array('required' => false)),
      'ca_title'      => new sfValidatorString(array('required' => false)),
      'ca_private'    => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('hdesk_k_base[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'HdeskKBase';
  }

}