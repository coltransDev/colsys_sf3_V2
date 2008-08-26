<?php

/**
 * FileImported form base class.
 *
 * @package    form
 * @subpackage file_imported
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseFileImportedForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idfileheader'   => new sfWidgetFormInputHidden(),
      'ca_fchimportacion' => new sfWidgetFormInputHidden(),
      'ca_content'        => new sfWidgetFormInput(),
      'ca_usuario'        => new sfWidgetFormInput(),
      'ca_procesado'      => new sfWidgetFormInputCheckbox(),
      'ca_nombre'         => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'ca_idfileheader'   => new sfValidatorPropelChoice(array('model' => 'FileHeader', 'column' => 'ca_idfileheader', 'required' => false)),
      'ca_fchimportacion' => new sfValidatorPropelChoice(array('model' => 'FileImported', 'column' => 'ca_fchimportacion', 'required' => false)),
      'ca_content'        => new sfValidatorString(array('required' => false)),
      'ca_usuario'        => new sfValidatorString(),
      'ca_procesado'      => new sfValidatorBoolean(),
      'ca_nombre'         => new sfValidatorPropelChoice(array('model' => 'FileImported', 'column' => 'ca_nombre', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('file_imported[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'FileImported';
  }


}
