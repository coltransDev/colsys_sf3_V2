<?php

/**
 * FileColumn form base class.
 *
 * @package    form
 * @subpackage file_column
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseFileColumnForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idfileheader'   => new sfWidgetFormPropelSelect(array('model' => 'FileHeader', 'add_empty' => false)),
      'ca_idcolumna'      => new sfWidgetFormInputHidden(),
      'ca_columna'        => new sfWidgetFormInput(),
      'ca_label'          => new sfWidgetFormInput(),
      'ca_mascara'        => new sfWidgetFormInput(),
      'ca_tipo'           => new sfWidgetFormInput(),
      'ca_longitud'       => new sfWidgetFormInput(),
      'ca_precision'      => new sfWidgetFormInput(),
      'ca_idregistro'     => new sfWidgetFormInput(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usucreado'      => new sfWidgetFormInput(),
      'ca_fchactualizado' => new sfWidgetFormDateTime(),
      'ca_usuactualizado' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idfileheader'   => new sfValidatorPropelChoice(array('model' => 'FileHeader', 'column' => 'ca_idfileheader')),
      'ca_idcolumna'      => new sfValidatorPropelChoice(array('model' => 'FileColumn', 'column' => 'ca_idcolumna', 'required' => false)),
      'ca_columna'        => new sfValidatorString(),
      'ca_label'          => new sfValidatorString(),
      'ca_mascara'        => new sfValidatorString(),
      'ca_tipo'           => new sfValidatorString(),
      'ca_longitud'       => new sfValidatorInteger(),
      'ca_precision'      => new sfValidatorInteger(),
      'ca_idregistro'     => new sfValidatorInteger(),
      'ca_fchcreado'      => new sfValidatorDateTime(),
      'ca_usucreado'      => new sfValidatorString(),
      'ca_fchactualizado' => new sfValidatorDateTime(),
      'ca_usuactualizado' => new sfValidatorString(),
    ));

    $this->widgetSchema->setNameFormat('file_column[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'FileColumn';
  }


}
