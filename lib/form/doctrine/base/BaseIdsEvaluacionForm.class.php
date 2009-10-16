<?php

/**
 * IdsEvaluacion form base class.
 *
 * @package    form
 * @subpackage ids_evaluacion
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseIdsEvaluacionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idevaluacion'   => new sfWidgetFormInputHidden(),
      'ca_id'             => new sfWidgetFormDoctrineSelect(array('model' => 'Ids', 'add_empty' => true)),
      'ca_tipo'           => new sfWidgetFormInput(),
      'ca_concepto'       => new sfWidgetFormInput(),
      'ca_fchevaluacion'  => new sfWidgetFormDate(),
      'ca_usucreado'      => new sfWidgetFormInput(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usuactualizado' => new sfWidgetFormInput(),
      'ca_fchactualizado' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'ca_idevaluacion'   => new sfValidatorDoctrineChoice(array('model' => 'IdsEvaluacion', 'column' => 'ca_idevaluacion', 'required' => false)),
      'ca_id'             => new sfValidatorDoctrineChoice(array('model' => 'Ids', 'required' => false)),
      'ca_tipo'           => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'ca_concepto'       => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'ca_fchevaluacion'  => new sfValidatorDate(array('required' => false)),
      'ca_usucreado'      => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
      'ca_usuactualizado' => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'ca_fchactualizado' => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ids_evaluacion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'IdsEvaluacion';
  }

}