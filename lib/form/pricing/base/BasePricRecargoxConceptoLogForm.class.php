<?php

/**
 * PricRecargoxConceptoLog form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BasePricRecargoxConceptoLogForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idtrayecto'     => new sfWidgetFormPropelChoice(array('model' => 'PricFlete', 'add_empty' => false)),
      'ca_idconcepto'     => new sfWidgetFormPropelChoice(array('model' => 'PricFlete', 'add_empty' => false)),
      'ca_idrecargo'      => new sfWidgetFormPropelChoice(array('model' => 'TipoRecargo', 'add_empty' => false)),
      'ca_vlrrecargo'     => new sfWidgetFormInput(),
      'ca_aplicacion'     => new sfWidgetFormInput(),
      'ca_vlrminimo'      => new sfWidgetFormInput(),
      'ca_aplicacion_min' => new sfWidgetFormInput(),
      'ca_observaciones'  => new sfWidgetFormInput(),
      'ca_idmoneda'       => new sfWidgetFormInput(),
      'ca_fchinicio'      => new sfWidgetFormDate(),
      'ca_fchvencimiento' => new sfWidgetFormDate(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usucreado'      => new sfWidgetFormInput(),
      'ca_consecutivo'    => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'ca_idtrayecto'     => new sfValidatorPropelChoice(array('model' => 'PricFlete', 'column' => 'ca_idtrayecto')),
      'ca_idconcepto'     => new sfValidatorPropelChoice(array('model' => 'PricFlete', 'column' => 'ca_idconcepto')),
      'ca_idrecargo'      => new sfValidatorPropelChoice(array('model' => 'TipoRecargo', 'column' => 'ca_idrecargo')),
      'ca_vlrrecargo'     => new sfValidatorNumber(),
      'ca_aplicacion'     => new sfValidatorString(array('required' => false)),
      'ca_vlrminimo'      => new sfValidatorNumber(array('required' => false)),
      'ca_aplicacion_min' => new sfValidatorString(array('required' => false)),
      'ca_observaciones'  => new sfValidatorString(array('required' => false)),
      'ca_idmoneda'       => new sfValidatorString(array('max_length' => 3, 'required' => false)),
      'ca_fchinicio'      => new sfValidatorDate(array('required' => false)),
      'ca_fchvencimiento' => new sfValidatorDate(array('required' => false)),
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'      => new sfValidatorString(array('required' => false)),
      'ca_consecutivo'    => new sfValidatorPropelChoice(array('model' => 'PricRecargoxConceptoLog', 'column' => 'ca_consecutivo', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('pric_recargox_concepto_log[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PricRecargoxConceptoLog';
  }


}
