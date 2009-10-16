<?php

/**
 * RepTarifa form base class.
 *
 * @package    form
 * @subpackage rep_tarifa
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseRepTarifaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'oid'               => new sfWidgetFormInputHidden(),
      'ca_idreporte'      => new sfWidgetFormDoctrineSelect(array('model' => 'Reporte', 'add_empty' => true)),
      'ca_idconcepto'     => new sfWidgetFormDoctrineSelect(array('model' => 'Concepto', 'add_empty' => true)),
      'ca_cantidad'       => new sfWidgetFormInput(),
      'ca_neta_tar'       => new sfWidgetFormInput(),
      'ca_neta_min'       => new sfWidgetFormInput(),
      'ca_neta_idm'       => new sfWidgetFormInput(),
      'ca_reportar_tar'   => new sfWidgetFormInput(),
      'ca_reportar_min'   => new sfWidgetFormInput(),
      'ca_reportar_idm'   => new sfWidgetFormInput(),
      'ca_cobrar_tar'     => new sfWidgetFormInput(),
      'ca_cobrar_min'     => new sfWidgetFormInput(),
      'ca_cobrar_idm'     => new sfWidgetFormInput(),
      'ca_observaciones'  => new sfWidgetFormInput(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usucreado'      => new sfWidgetFormInput(),
      'ca_fchactualizado' => new sfWidgetFormDateTime(),
      'ca_usuactualizado' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'oid'               => new sfValidatorDoctrineChoice(array('model' => 'RepTarifa', 'column' => 'oid', 'required' => false)),
      'ca_idreporte'      => new sfValidatorDoctrineChoice(array('model' => 'Reporte', 'required' => false)),
      'ca_idconcepto'     => new sfValidatorDoctrineChoice(array('model' => 'Concepto', 'required' => false)),
      'ca_cantidad'       => new sfValidatorNumber(array('required' => false)),
      'ca_neta_tar'       => new sfValidatorNumber(array('required' => false)),
      'ca_neta_min'       => new sfValidatorNumber(array('required' => false)),
      'ca_neta_idm'       => new sfValidatorString(array('required' => false)),
      'ca_reportar_tar'   => new sfValidatorNumber(array('required' => false)),
      'ca_reportar_min'   => new sfValidatorNumber(array('required' => false)),
      'ca_reportar_idm'   => new sfValidatorString(array('required' => false)),
      'ca_cobrar_tar'     => new sfValidatorNumber(array('required' => false)),
      'ca_cobrar_min'     => new sfValidatorNumber(array('required' => false)),
      'ca_cobrar_idm'     => new sfValidatorString(array('required' => false)),
      'ca_observaciones'  => new sfValidatorString(array('required' => false)),
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'      => new sfValidatorString(array('required' => false)),
      'ca_fchactualizado' => new sfValidatorDateTime(array('required' => false)),
      'ca_usuactualizado' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rep_tarifa[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'RepTarifa';
  }

}