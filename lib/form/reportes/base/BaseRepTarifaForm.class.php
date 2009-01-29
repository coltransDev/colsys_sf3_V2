<?php

/**
 * RepTarifa form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseRepTarifaForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'oid'               => new sfWidgetFormInputHidden(),
      'ca_idreporte'      => new sfWidgetFormPropelChoice(array('model' => 'Reporte', 'add_empty' => false)),
      'ca_idconcepto'     => new sfWidgetFormPropelChoice(array('model' => 'Concepto', 'add_empty' => false)),
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
      'ca_fchcreado'      => new sfWidgetFormDate(),
      'ca_usucreado'      => new sfWidgetFormInput(),
      'ca_fchactualizado' => new sfWidgetFormDate(),
      'ca_usuactualizado' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'oid'               => new sfValidatorPropelChoice(array('model' => 'RepTarifa', 'column' => 'oid', 'required' => false)),
      'ca_idreporte'      => new sfValidatorPropelChoice(array('model' => 'Reporte', 'column' => 'ca_idreporte')),
      'ca_idconcepto'     => new sfValidatorPropelChoice(array('model' => 'Concepto', 'column' => 'ca_idconcepto')),
      'ca_cantidad'       => new sfValidatorNumber(),
      'ca_neta_tar'       => new sfValidatorNumber(),
      'ca_neta_min'       => new sfValidatorNumber(),
      'ca_neta_idm'       => new sfValidatorString(array('max_length' => 3)),
      'ca_reportar_tar'   => new sfValidatorNumber(),
      'ca_reportar_min'   => new sfValidatorNumber(),
      'ca_reportar_idm'   => new sfValidatorString(array('max_length' => 3)),
      'ca_cobrar_tar'     => new sfValidatorNumber(),
      'ca_cobrar_min'     => new sfValidatorNumber(),
      'ca_cobrar_idm'     => new sfValidatorString(array('max_length' => 3)),
      'ca_observaciones'  => new sfValidatorString(array('max_length' => 255)),
      'ca_fchcreado'      => new sfValidatorDate(array('required' => false)),
      'ca_usucreado'      => new sfValidatorString(array('required' => false)),
      'ca_fchactualizado' => new sfValidatorDate(array('required' => false)),
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
