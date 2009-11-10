<?php

/**
 * IdsCriterio form base class.
 *
 * @method IdsCriterio getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseIdsCriterioForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idcriterio'     => new sfWidgetFormInputHidden(),
      'ca_tipo'           => new sfWidgetFormInputText(),
      'ca_criterio'       => new sfWidgetFormInputText(),
      'ca_ponderacion'    => new sfWidgetFormInputText(),
      'ca_tipocriterio'   => new sfWidgetFormInputText(),
      'ca_activo'         => new sfWidgetFormInputCheckbox(),
      'ca_usucreado'      => new sfWidgetFormInputText(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usuactualizado' => new sfWidgetFormInputText(),
      'ca_fchactualizado' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'ca_idcriterio'     => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idcriterio', 'required' => false)),
      'ca_tipo'           => new sfValidatorString(array('max_length' => 3, 'required' => false)),
      'ca_criterio'       => new sfValidatorString(array('max_length' => 60, 'required' => false)),
      'ca_ponderacion'    => new sfValidatorInteger(array('required' => false)),
      'ca_tipocriterio'   => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'ca_activo'         => new sfValidatorBoolean(array('required' => false)),
      'ca_usucreado'      => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
      'ca_usuactualizado' => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'ca_fchactualizado' => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ids_criterio[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'IdsCriterio';
  }

}
