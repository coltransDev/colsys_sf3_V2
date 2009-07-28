<?php

/**
 * HdeskKBaseCategory form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseHdeskKBaseCategoryForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idcategory' => new sfWidgetFormInputHidden(),
      'ca_parent'     => new sfWidgetFormInput(),
      'ca_name'       => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idcategory' => new sfValidatorPropelChoice(array('model' => 'HdeskKBaseCategory', 'column' => 'ca_idcategory', 'required' => false)),
      'ca_parent'     => new sfValidatorInteger(),
      'ca_name'       => new sfValidatorString(),
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
