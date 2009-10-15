<?php

/**
 * FileHeader form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseFileHeaderForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idfileheader'   => new sfWidgetFormInputHidden(),
      'ca_descripcion'    => new sfWidgetFormInput(),
      'ca_tipoarchivo'    => new sfWidgetFormInput(),
      'ca_separador'      => new sfWidgetFormInput(),
      'ca_separadordec'   => new sfWidgetFormInput(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usucreado'      => new sfWidgetFormInput(),
      'ca_fchactualizado' => new sfWidgetFormDateTime(),
      'ca_usuactualizado' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idfileheader'   => new sfValidatorPropelChoice(array('model' => 'FileHeader', 'column' => 'ca_idfileheader', 'required' => false)),
      'ca_descripcion'    => new sfValidatorString(),
      'ca_tipoarchivo'    => new sfValidatorString(),
      'ca_separador'      => new sfValidatorString(),
      'ca_separadordec'   => new sfValidatorString(),
      'ca_fchcreado'      => new sfValidatorDateTime(),
      'ca_usucreado'      => new sfValidatorString(),
      'ca_fchactualizado' => new sfValidatorDateTime(),
      'ca_usuactualizado' => new sfValidatorString(),
    ));

    $this->widgetSchema->setNameFormat('file_header[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'FileHeader';
  }


}
