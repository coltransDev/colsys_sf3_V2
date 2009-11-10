<?php

/**
 * IdsEvaluacionxCriterio form base class.
 *
 * @method IdsEvaluacionxCriterio getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseIdsEvaluacionxCriterioForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idevaluacion'   => new sfWidgetFormInputHidden(),
      'ca_idcriterio'     => new sfWidgetFormInputHidden(),
      'ca_valor'          => new sfWidgetFormInputText(),
      'ca_ponderacion'    => new sfWidgetFormInputText(),
      'ca_observaciones'  => new sfWidgetFormInputText(),
      'ca_usucreado'      => new sfWidgetFormInputText(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usuactualizado' => new sfWidgetFormInputText(),
      'ca_fchactualizado' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'ca_idevaluacion'   => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idevaluacion', 'required' => false)),
      'ca_idcriterio'     => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idcriterio', 'required' => false)),
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

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'IdsEvaluacionxCriterio';
  }

}
