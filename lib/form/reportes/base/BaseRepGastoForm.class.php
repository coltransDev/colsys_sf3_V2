<?php

/**
 * RepGasto form base class.
 *
 * @package    form
 * @subpackage rep_gasto
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseRepGastoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'oid'             => new sfWidgetFormInputHidden(),
      'ca_idreporte'    => new sfWidgetFormPropelSelect(array('model' => 'Reporte', 'add_empty' => false)),
      'ca_idrecargo'    => new sfWidgetFormPropelSelect(array('model' => 'TipoRecargo', 'add_empty' => false)),
      'ca_aplicacion'   => new sfWidgetFormInput(),
      'ca_tipo'         => new sfWidgetFormInput(),
      'ca_neta_tar'     => new sfWidgetFormInput(),
      'ca_neta_min'     => new sfWidgetFormInput(),
      'ca_reportar_tar' => new sfWidgetFormInput(),
      'ca_reportar_min' => new sfWidgetFormInput(),
      'ca_cobrar_tar'   => new sfWidgetFormInput(),
      'ca_cobrar_min'   => new sfWidgetFormInput(),
      'ca_idmoneda'     => new sfWidgetFormInput(),
      'ca_detalles'     => new sfWidgetFormInput(),
      'ca_idconcepto'   => new sfWidgetFormPropelSelect(array('model' => 'Concepto', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'oid'             => new sfValidatorPropelChoice(array('model' => 'RepGasto', 'column' => 'oid', 'required' => false)),
      'ca_idreporte'    => new sfValidatorPropelChoice(array('model' => 'Reporte', 'column' => 'ca_idreporte')),
      'ca_idrecargo'    => new sfValidatorPropelChoice(array('model' => 'TipoRecargo', 'column' => 'ca_idrecargo')),
      'ca_aplicacion'   => new sfValidatorString(),
      'ca_tipo'         => new sfValidatorString(),
      'ca_neta_tar'     => new sfValidatorNumber(),
      'ca_neta_min'     => new sfValidatorNumber(),
      'ca_reportar_tar' => new sfValidatorNumber(),
      'ca_reportar_min' => new sfValidatorNumber(),
      'ca_cobrar_tar'   => new sfValidatorNumber(),
      'ca_cobrar_min'   => new sfValidatorNumber(),
      'ca_idmoneda'     => new sfValidatorString(array('max_length' => 3)),
      'ca_detalles'     => new sfValidatorString(array('max_length' => 3)),
      'ca_idconcepto'   => new sfValidatorPropelChoice(array('model' => 'Concepto', 'column' => 'ca_idconcepto')),
    ));

    $this->widgetSchema->setNameFormat('rep_gasto[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'RepGasto';
  }


}
