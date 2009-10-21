<?php

/**
 * Ids form base class.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseIdsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_id'                 => new sfWidgetFormInputHidden(),
      'ca_dv'                 => new sfWidgetFormInputText(),
      'ca_idalterno'          => new sfWidgetFormInputText(),
      'ca_tipoidentificacion' => new sfWidgetFormInputText(),
      'ca_idgrupo'            => new sfWidgetFormDoctrineChoice(array('model' => 'Ids', 'add_empty' => true)),
      'ca_nombre'             => new sfWidgetFormInputText(),
      'ca_website'            => new sfWidgetFormInputText(),
      'ca_actividad'          => new sfWidgetFormTextarea(),
      'ca_sectoreco'          => new sfWidgetFormInputText(),
      'ca_usucreado'          => new sfWidgetFormInputText(),
      'ca_fchcreado'          => new sfWidgetFormDateTime(),
      'ca_usuactualizado'     => new sfWidgetFormInputText(),
      'ca_fchactualizado'     => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'ca_id'                 => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_id', 'required' => false)),
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

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Ids';
  }

}
