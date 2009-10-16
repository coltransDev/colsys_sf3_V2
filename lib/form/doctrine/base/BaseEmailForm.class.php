<?php

/**
 * Email form base class.
 *
 * @package    form
 * @subpackage email
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseEmailForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idemail'     => new sfWidgetFormInputHidden(),
      'ca_fchenvio'    => new sfWidgetFormDateTime(),
      'ca_usuenvio'    => new sfWidgetFormInput(),
      'ca_tipo'        => new sfWidgetFormInput(),
      'ca_idcaso'      => new sfWidgetFormDoctrineSelect(array('model' => 'Reporte', 'add_empty' => true)),
      'ca_from'        => new sfWidgetFormInput(),
      'ca_fromname'    => new sfWidgetFormInput(),
      'ca_cc'          => new sfWidgetFormInput(),
      'ca_replyto'     => new sfWidgetFormInput(),
      'ca_address'     => new sfWidgetFormInput(),
      'ca_attachment'  => new sfWidgetFormInput(),
      'ca_subject'     => new sfWidgetFormInput(),
      'ca_body'        => new sfWidgetFormInput(),
      'ca_bodyhtml'    => new sfWidgetFormInput(),
      'ca_readreceipt' => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'ca_idemail'     => new sfValidatorDoctrineChoice(array('model' => 'Email', 'column' => 'ca_idemail', 'required' => false)),
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

    parent::setup();
  }

  public function getModelName()
  {
    return 'Email';
  }

}