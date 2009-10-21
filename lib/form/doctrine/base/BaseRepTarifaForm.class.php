<?php

/**
 * RepTarifa form base class.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseRepTarifaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'oid'               => new sfWidgetFormInputHidden(),
      'ca_idreporte'      => new sfWidgetFormDoctrineChoice(array('model' => 'Reporte', 'add_empty' => true)),
      'ca_idconcepto'     => new sfWidgetFormDoctrineChoice(array('model' => 'Concepto', 'add_empty' => true)),
      'ca_cantidad'       => new sfWidgetFormInputText(),
      'ca_neta_tar'       => new sfWidgetFormInputText(),
      'ca_neta_min'       => new sfWidgetFormInputText(),
      'ca_neta_idm'       => new sfWidgetFormTextarea(),
      'ca_reportar_tar'   => new sfWidgetFormInputText(),
      'ca_reportar_min'   => new sfWidgetFormInputText(),
      'ca_reportar_idm'   => new sfWidgetFormTextarea(),
      'ca_cobrar_tar'     => new sfWidgetFormInputText(),
      'ca_cobrar_min'     => new sfWidgetFormInputText(),
      'ca_cobrar_idm'     => new sfWidgetFormTextarea(),
      'ca_observaciones'  => new sfWidgetFormTextarea(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usucreado'      => new sfWidgetFormTextarea(),
      'ca_fchactualizado' => new sfWidgetFormDateTime(),
      'ca_usuactualizado' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'oid'               => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'oid', 'required' => false)),
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

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RepTarifa';
  }

}
