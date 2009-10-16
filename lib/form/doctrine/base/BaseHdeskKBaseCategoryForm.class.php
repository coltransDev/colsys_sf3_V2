<?php

/**
 * HdeskKBaseCategory form base class.
 *
 * @package    form
 * @subpackage hdesk_k_base_category
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseHdeskKBaseCategoryForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idcategory' => new sfWidgetFormInputHidden(),
      'ca_parent'     => new sfWidgetFormInput(),
      'ca_name'       => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idcategory' => new sfValidatorDoctrineChoice(array('model' => 'HdeskKBaseCategory', 'column' => 'ca_idcategory', 'required' => false)),
      'ca_parent'     => new sfValidatorInteger(array('required' => false)),
      'ca_name'       => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('hdesk_k_base_category[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'HdeskKBaseCategory';
  }

}