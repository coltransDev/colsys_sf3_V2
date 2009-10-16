<?php

/**
 * IdsDocumento form base class.
 *
 * @package    form
 * @subpackage ids_documento
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseIdsDocumentoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_iddocumento'    => new sfWidgetFormInputHidden(),
      'ca_id'             => new sfWidgetFormDoctrineSelect(array('model' => 'Ids', 'add_empty' => true)),
      'ca_idtipo'         => new sfWidgetFormDoctrineSelect(array('model' => 'IdsTipoDocumento', 'add_empty' => true)),
      'ca_ubicacion'      => new sfWidgetFormInput(),
      'ca_observaciones'  => new sfWidgetFormInput(),
      'ca_fchinicio'      => new sfWidgetFormDate(),
      'ca_fchvencimiento' => new sfWidgetFormDate(),
      'ca_usucreado'      => new sfWidgetFormInput(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'ca_iddocumento'    => new sfValidatorDoctrineChoice(array('model' => 'IdsDocumento', 'column' => 'ca_iddocumento', 'required' => false)),
      'ca_id'             => new sfValidatorDoctrineChoice(array('model' => 'Ids', 'required' => false)),
      'ca_idtipo'         => new sfValidatorDoctrineChoice(array('model' => 'IdsTipoDocumento', 'required' => false)),
      'ca_ubicacion'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'ca_observaciones'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'ca_fchinicio'      => new sfValidatorDate(array('required' => false)),
      'ca_fchvencimiento' => new sfValidatorDate(array('required' => false)),
      'ca_usucreado'      => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ids_documento[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'IdsDocumento';
  }

}