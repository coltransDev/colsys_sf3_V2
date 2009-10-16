<?php

/**
 * Trayecto form base class.
 *
 * @package    form
 * @subpackage trayecto
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseTrayectoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idtrayecto'     => new sfWidgetFormInputHidden(),
      'ca_origen'         => new sfWidgetFormDoctrineSelect(array('model' => 'Ciudad', 'add_empty' => true)),
      'ca_destino'        => new sfWidgetFormDoctrineSelect(array('model' => 'Ciudad', 'add_empty' => true)),
      'ca_idlinea'        => new sfWidgetFormDoctrineSelect(array('model' => 'IdsProveedor', 'add_empty' => true)),
      'ca_transporte'     => new sfWidgetFormInput(),
      'ca_impoexpo'       => new sfWidgetFormInput(),
      'ca_frecuencia'     => new sfWidgetFormInput(),
      'ca_modalidad'      => new sfWidgetFormInput(),
      'ca_tiempotransito' => new sfWidgetFormInput(),
      'ca_observaciones'  => new sfWidgetFormInput(),
      'ca_idagente'       => new sfWidgetFormDoctrineSelect(array('model' => 'IdsAgente', 'add_empty' => true)),
      'ca_activo'         => new sfWidgetFormInputCheckbox(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'ca_idtrayecto'     => new sfValidatorDoctrineChoice(array('model' => 'Trayecto', 'column' => 'ca_idtrayecto', 'required' => false)),
      'ca_origen'         => new sfValidatorDoctrineChoice(array('model' => 'Ciudad', 'required' => false)),
      'ca_destino'        => new sfValidatorDoctrineChoice(array('model' => 'Ciudad', 'required' => false)),
      'ca_idlinea'        => new sfValidatorDoctrineChoice(array('model' => 'IdsProveedor', 'required' => false)),
      'ca_transporte'     => new sfValidatorString(array('required' => false)),
      'ca_impoexpo'       => new sfValidatorString(array('required' => false)),
      'ca_frecuencia'     => new sfValidatorString(array('required' => false)),
      'ca_modalidad'      => new sfValidatorString(array('required' => false)),
      'ca_tiempotransito' => new sfValidatorString(array('required' => false)),
      'ca_observaciones'  => new sfValidatorString(array('required' => false)),
      'ca_idagente'       => new sfValidatorDoctrineChoice(array('model' => 'IdsAgente', 'required' => false)),
      'ca_activo'         => new sfValidatorBoolean(array('required' => false)),
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('trayecto[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Trayecto';
  }

}