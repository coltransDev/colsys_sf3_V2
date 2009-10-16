<?php

/**
 * IdsCriterio form base class.
 *
 * @package    form
 * @subpackage ids_criterio
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseIdsCriterioForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idcriterio'     => new sfWidgetFormInputHidden(),
      'ca_tipo'           => new sfWidgetFormInput(),
      'ca_criterio'       => new sfWidgetFormInput(),
      'ca_ponderacion'    => new sfWidgetFormInput(),
      'ca_tipocriterio'   => new sfWidgetFormInput(),
      'ca_activo'         => new sfWidgetFormInputCheckbox(),
      'ca_usucreado'      => new sfWidgetFormInput(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usuactualizado' => new sfWidgetFormInput(),
      'ca_fchactualizado' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'ca_idcriterio'     => new sfValidatorDoctrineChoice(array('model' => 'IdsCriterio', 'column' => 'ca_idcriterio', 'required' => false)),
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

    parent::setup();
  }

  public function getModelName()
  {
    return 'IdsCriterio';
  }

}