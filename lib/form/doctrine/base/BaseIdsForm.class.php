<?php

/**
 * Ids form base class.
 *
 * @package    form
 * @subpackage ids
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseIdsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_id'                 => new sfWidgetFormInputHidden(),
      'ca_dv'                 => new sfWidgetFormInput(),
      'ca_idalterno'          => new sfWidgetFormInput(),
      'ca_tipoidentificacion' => new sfWidgetFormInput(),
      'ca_idgrupo'            => new sfWidgetFormDoctrineSelect(array('model' => 'Ids', 'add_empty' => true)),
      'ca_nombre'             => new sfWidgetFormInput(),
      'ca_website'            => new sfWidgetFormInput(),
      'ca_actividad'          => new sfWidgetFormInput(),
      'ca_sectoreco'          => new sfWidgetFormInput(),
      'ca_usucreado'          => new sfWidgetFormInput(),
      'ca_fchcreado'          => new sfWidgetFormDateTime(),
      'ca_usuactualizado'     => new sfWidgetFormInput(),
      'ca_fchactualizado'     => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'ca_id'                 => new sfValidatorDoctrineChoice(array('model' => 'Ids', 'column' => 'ca_id', 'required' => false)),
      'ca_dv'                 => new sfValidatorInteger(array('required' => false)),
      'ca_idalterno'          => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'ca_tipoidentificacion' => new sfValidatorInteger(array('required' => false)),
      'ca_idgrupo'            => new sfValidatorDoctrineChoice(array('model' => 'Ids', 'required' => false)),
      'ca_nombre'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'ca_website'            => new sfValidatorString(array('max_length' => 60, 'required' => false)),
      'ca_actividad'          => new sfValidatorString(array('required' => false)),
      'ca_sectoreco'          => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'ca_usucreado'          => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'ca_fchcreado'          => new sfValidatorDateTime(array('required' => false)),
      'ca_usuactualizado'     => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'ca_fchactualizado'     => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ids[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Ids';
  }

}