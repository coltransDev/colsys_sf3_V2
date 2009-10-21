<?php

/**
 * EmailAttachment form base class.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseEmailAttachmentForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idattachment' => new sfWidgetFormInputHidden(),
      'ca_idemail'      => new sfWidgetFormDoctrineChoice(array('model' => 'Email', 'add_empty' => true)),
      'ca_extension'    => new sfWidgetFormTextarea(),
      'ca_header_file'  => new sfWidgetFormTextarea(),
      'ca_filesize'     => new sfWidgetFormTextarea(),
      'ca_content'      => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'ca_idattachment' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idattachment', 'required' => false)),
      'ca_idemail'      => new sfValidatorDoctrineChoice(array('model' => 'Email', 'required' => false)),
      'ca_extension'    => new sfValidatorString(array('required' => false)),
      'ca_header_file'  => new sfValidatorString(array('required' => false)),
      'ca_filesize'     => new sfValidatorString(array('required' => false)),
      'ca_content'      => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('email_attachment[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'EmailAttachment';
  }

}
