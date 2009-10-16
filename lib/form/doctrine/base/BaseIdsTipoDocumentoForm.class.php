<?php

/**
 * IdsTipoDocumento form base class.
 *
 * @package    form
 * @subpackage ids_tipo_documento
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseIdsTipoDocumentoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idtipo'         => new sfWidgetFormInputHidden(),
      'ca_tipo'           => new sfWidgetFormInput(),
      'ca_equivalentea'   => new sfWidgetFormInput(),
      'ca_vigencia'       => new sfWidgetFormInput(),
      'ca_observaciones'  => new sfWidgetFormInput(),
      'ca_usucreado'      => new sfWidgetFormInput(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usuactualizado' => new sfWidgetFormInput(),
      'ca_fchactualizado' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'ca_idtipo'         => new sfValidatorDoctrineChoice(array('model' => 'IdsTipoDocumento', 'column' => 'ca_idtipo', 'required' => false)),
      'ca_tipo'           => new sfValidatorString(array('max_length' => 60, 'required' => false)),
      'ca_equivalentea'   => new sfValidatorInteger(array('required' => false)),
      'ca_vigencia'       => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'ca_observaciones'  => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'ca_usucreado'      => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
      'ca_usuactualizado' => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'ca_fchactualizado' => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ids_tipo_documento[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'IdsTipoDocumento';
  }

}