<?php

/**
 * HdeskKBase form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseHdeskKBaseForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idkbase'    => new sfWidgetFormInputHidden(),
      'ca_idcategory' => new sfWidgetFormPropelChoice(array('model' => 'HdeskKBaseCategory', 'add_empty' => false)),
      'ca_login'      => new sfWidgetFormPropelChoice(array('model' => 'Usuario', 'add_empty' => false)),
      'ca_createdat'  => new sfWidgetFormDateTime(),
      'ca_text'       => new sfWidgetFormInput(),
      'ca_title'      => new sfWidgetFormInput(),
      'ca_private'    => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'ca_idkbase'    => new sfValidatorPropelChoice(array('model' => 'HdeskKBase', 'column' => 'ca_idkbase', 'required' => false)),
      'ca_idcategory' => new sfValidatorPropelChoice(array('model' => 'HdeskKBaseCategory', 'column' => 'ca_idcategory')),
      'ca_login'      => new sfValidatorPropelChoice(array('model' => 'Usuario', 'column' => 'ca_login')),
      'ca_createdat'  => new sfValidatorDateTime(),
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
