<?php

/**
 * EmailAttachment form base class.
 *
 * @package    form
 * @subpackage email_attachment
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseEmailAttachmentForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idattachment' => new sfWidgetFormInputHidden(),
      'ca_idemail'      => new sfWidgetFormPropelSelect(array('model' => 'Email', 'add_empty' => false)),
      'ca_extension'    => new sfWidgetFormInput(),
      'ca_header_file'  => new sfWidgetFormInput(),
      'ca_filesize'     => new sfWidgetFormInput(),
      'ca_content'      => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idattachment' => new sfValidatorPropelChoice(array('model' => 'EmailAttachment', 'column' => 'ca_idattachment', 'required' => false)),
      'ca_idemail'      => new sfValidatorPropelChoice(array('model' => 'Email', 'column' => 'ca_idemail')),
      'ca_extension'    => new sfValidatorString(),
      'ca_header_file'  => new sfValidatorString(array('required' => false)),
      'ca_filesize'     => new sfValidatorString(array('required' => false)),
      'ca_content'      => new sfValidatorPass(array('required' => false)),
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
