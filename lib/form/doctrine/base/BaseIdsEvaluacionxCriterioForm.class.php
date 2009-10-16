<?php

/**
 * IdsEvaluacionxCriterio form base class.
 *
 * @package    form
 * @subpackage ids_evaluacionx_criterio
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseIdsEvaluacionxCriterioForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idevaluacion'   => new sfWidgetFormInputHidden(),
      'ca_idcriterio'     => new sfWidgetFormInputHidden(),
      'ca_valor'          => new sfWidgetFormInput(),
      'ca_ponderacion'    => new sfWidgetFormInput(),
      'ca_observaciones'  => new sfWidgetFormInput(),
      'ca_usucreado'      => new sfWidgetFormInput(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usuactualizado' => new sfWidgetFormInput(),
      'ca_fchactualizado' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'ca_idevaluacion'   => new sfValidatorDoctrineChoice(array('model' => 'IdsEvaluacionxCriterio', 'column' => 'ca_idevaluacion', 'required' => false)),
      'ca_idcriterio'     => new sfValidatorDoctrineChoice(array('model' => 'IdsEvaluacionxCriterio', 'column' => 'ca_idcriterio', 'required' => false)),
      'ca_valor'          => new sfValidatorNumber(array('required' => false)),
      'ca_ponderacion'    => new sfValidatorNumber(array('required' => false)),
      'ca_observaciones'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'ca_usucreado'      => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
      'ca_usuactualizado' => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'ca_fchactualizado' => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ids_evaluacionx_criterio[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'IdsEvaluacionxCriterio';
  }

}