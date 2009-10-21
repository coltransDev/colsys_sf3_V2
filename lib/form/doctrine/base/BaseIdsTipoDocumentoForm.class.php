<?php

/**
 * IdsTipoDocumento form base class.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseIdsTipoDocumentoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idtipo'         => new sfWidgetFormInputHidden(),
      'ca_tipo'           => new sfWidgetFormInputText(),
      'ca_equivalentea'   => new sfWidgetFormInputText(),
      'ca_vigencia'       => new sfWidgetFormInputText(),
      'ca_observaciones'  => new sfWidgetFormInputText(),
      'ca_usucreado'      => new sfWidgetFormInputText(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usuactualizado' => new sfWidgetFormInputText(),
      'ca_fchactualizado' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'ca_idtipo'         => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idtipo', 'required' => false)),
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

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'IdsTipoDocumento';
  }

}
