<?php

/**
 * Email form base class.
 *
 * @method Email getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseEmailForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idemail'     => new sfWidgetFormInputHidden(),
      'ca_fchenvio'    => new sfWidgetFormDateTime(),
      'ca_usuenvio'    => new sfWidgetFormTextarea(),
      'ca_tipo'        => new sfWidgetFormTextarea(),
      'ca_idcaso'      => new sfWidgetFormDoctrineChoice(array('model' => 'Reporte', 'add_empty' => true)),
      'ca_from'        => new sfWidgetFormTextarea(),
      'ca_fromname'    => new sfWidgetFormTextarea(),
      'ca_cc'          => new sfWidgetFormTextarea(),
      'ca_replyto'     => new sfWidgetFormTextarea(),
      'ca_address'     => new sfWidgetFormTextarea(),
      'ca_attachment'  => new sfWidgetFormTextarea(),
      'ca_subject'     => new sfWidgetFormTextarea(),
      'ca_body'        => new sfWidgetFormTextarea(),
      'ca_bodyhtml'    => new sfWidgetFormTextarea(),
      'ca_readreceipt' => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'ca_idemail'     => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idemail', 'required' => false)),
      'ca_fchenvio'    => new sfValidatorDateTime(array('required' => false)),
      'ca_usuenvio'    => new sfValidatorString(array('required' => false)),
      'ca_tipo'        => new sfValidatorString(array('required' => false)),
      'ca_idcaso'      => new sfValidatorDoctrineChoice(array('model' => 'Reporte', 'required' => false)),
      'ca_from'        => new sfValidatorString(array('required' => false)),
      'ca_fromname'    => new sfValidatorString(array('required' => false)),
      'ca_cc'          => new sfValidatorString(array('required' => false)),
      'ca_replyto'     => new sfValidatorString(array('required' => false)),
      'ca_address'     => new sfValidatorString(array('required' => false)),
      'ca_attachment'  => new sfValidatorString(array('required' => false)),
      'ca_subject'     => new sfValidatorString(array('required' => false)),
      'ca_body'        => new sfValidatorString(array('required' => false)),
      'ca_bodyhtml'    => new sfValidatorString(array('required' => false)),
      'ca_readreceipt' => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('email[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Email';
  }

}
