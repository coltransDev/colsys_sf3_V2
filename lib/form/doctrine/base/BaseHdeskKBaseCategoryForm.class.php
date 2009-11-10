<?php

/**
 * HdeskKBaseCategory form base class.
 *
 * @method HdeskKBaseCategory getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseHdeskKBaseCategoryForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idcategory' => new sfWidgetFormInputHidden(),
      'ca_parent'     => new sfWidgetFormInputText(),
      'ca_name'       => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'ca_idcategory' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idcategory', 'required' => false)),
      'ca_parent'     => new sfValidatorInteger(array('required' => false)),
      'ca_name'       => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('hdesk_k_base_category[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'HdeskKBaseCategory';
  }

}
