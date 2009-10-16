<?php

/**
 * EmailAttachment form base class.
 *
 * @package    form
 * @subpackage email_attachment
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseEmailAttachmentForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idattachment' => new sfWidgetFormInputHidden(),
      'ca_idemail'      => new sfWidgetFormDoctrineSelect(array('model' => 'Email', 'add_empty' => true)),
      'ca_extension'    => new sfWidgetFormInput(),
      'ca_header_file'  => new sfWidgetFormInput(),
      'ca_filesize'     => new sfWidgetFormInput(),
      'ca_content'      => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'ca_idattachment' => new sfValidatorDoctrineChoice(array('model' => 'EmailAttachment', 'column' => 'ca_idattachment', 'required' => false)),
      'ca_idemail'      => new sfValidatorDoctrineChoice(array('model' => 'Email', 'required' => false)),
      'ca_extension'    => new sfValidatorString(array('required' => false)),
      'ca_header_file'  => new sfValidatorString(array('required' => false)),
      'ca_filesize'     => new sfValidatorString(array('required' => false)),
      'ca_content'      => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('email_attachment[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'EmailAttachment';
  }

}