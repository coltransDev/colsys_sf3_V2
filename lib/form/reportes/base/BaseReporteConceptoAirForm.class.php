<?php

/**
 * ReporteConceptoAir form base class.
 *
 * @package    form
 * @subpackage reporte_concepto_air
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseReporteConceptoAirForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'oid'             => new sfWidgetFormInputHidden(),
      'ca_idreporte'    => new sfWidgetFormPropelSelect(array('model' => 'Reporte', 'add_empty' => false)),
      'ca_idconcepto'   => new sfWidgetFormPropelSelect(array('model' => 'Concepto', 'add_empty' => false)),
      'ca_reportar_tar' => new sfWidgetFormInput(),
      'ca_reportar_min' => new sfWidgetFormInput(),
      'ca_reportar_idm' => new sfWidgetFormInput(),
      'ca_cobrar_tar'   => new sfWidgetFormInput(),
      'ca_cobrar_min'   => new sfWidgetFormInput(),
      'ca_cobrar_idm'   => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'oid'             => new sfValidatorPropelChoice(array('model' => 'ReporteConceptoAir', 'column' => 'oid', 'required' => false)),
      'ca_idreporte'    => new sfValidatorPropelChoice(array('model' => 'Reporte', 'column' => 'ca_idreporte')),
      'ca_idconcepto'   => new sfValidatorPropelChoice(array('model' => 'Concepto', 'column' => 'ca_idconcepto')),
      'ca_reportar_tar' => new sfValidatorNumber(),
      'ca_reportar_min' => new sfValidatorNumber(),
      'ca_reportar_idm' => new sfValidatorString(array('max_length' => 3)),
      'ca_cobrar_tar'   => new sfValidatorNumber(),
      'ca_cobrar_min'   => new sfValidatorNumber(),
      'ca_cobrar_idm'   => new sfValidatorString(array('max_length' => 3)),
    ));

    $this->widgetSchema->setNameFormat('reporte_concepto_air[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ReporteConceptoAir';
  }


}
