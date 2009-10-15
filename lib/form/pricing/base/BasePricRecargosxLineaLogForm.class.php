<?php

/**
 * PricRecargosxLineaLog form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BasePricRecargosxLineaLogForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idtrafico'      => new sfWidgetFormInput(),
      'ca_idlinea'        => new sfWidgetFormPropelChoice(array('model' => 'Transportador', 'add_empty' => false)),
      'ca_idrecargo'      => new sfWidgetFormPropelChoice(array('model' => 'TipoRecargo', 'add_empty' => false)),
      'ca_idconcepto'     => new sfWidgetFormPropelChoice(array('model' => 'Concepto', 'add_empty' => false)),
      'ca_modalidad'      => new sfWidgetFormInput(),
      'ca_impoexpo'       => new sfWidgetFormInput(),
      'ca_vlrrecargo'     => new sfWidgetFormInput(),
      'ca_aplicacion'     => new sfWidgetFormInput(),
      'ca_vlrminimo'      => new sfWidgetFormInput(),
      'ca_aplicacion_min' => new sfWidgetFormInput(),
      'ca_observaciones'  => new sfWidgetFormInput(),
      'ca_fchinicio'      => new sfWidgetFormDate(),
      'ca_fchvencimiento' => new sfWidgetFormDate(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usucreado'      => new sfWidgetFormInput(),
      'ca_idmoneda'       => new sfWidgetFormInput(),
      'ca_consecutivo'    => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'ca_idtrafico'      => new sfValidatorString(),
      'ca_idlinea'        => new sfValidatorPropelChoice(array('model' => 'Transportador', 'column' => 'ca_idlinea')),
      'ca_idrecargo'      => new sfValidatorPropelChoice(array('model' => 'TipoRecargo', 'column' => 'ca_idrecargo')),
      'ca_idconcepto'     => new sfValidatorPropelChoice(array('model' => 'Concepto', 'column' => 'ca_idconcepto')),
      'ca_modalidad'      => new sfValidatorString(),
      'ca_impoexpo'       => new sfValidatorString(),
      'ca_vlrrecargo'     => new sfValidatorNumber(array('required' => false)),
      'ca_aplicacion'     => new sfValidatorString(array('required' => false)),
      'ca_vlrminimo'      => new sfValidatorNumber(array('required' => false)),
      'ca_aplicacion_min' => new sfValidatorString(array('required' => false)),
      'ca_observaciones'  => new sfValidatorString(array('required' => false)),
      'ca_fchinicio'      => new sfValidatorDate(array('required' => false)),
      'ca_fchvencimiento' => new sfValidatorDate(array('required' => false)),
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'      => new sfValidatorString(array('required' => false)),
      'ca_idmoneda'       => new sfValidatorString(array('max_length' => 3, 'required' => false)),
      'ca_consecutivo'    => new sfValidatorPropelChoice(array('model' => 'PricRecargosxLineaLog', 'column' => 'ca_consecutivo', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('pric_recargosx_linea_log[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PricRecargosxLineaLog';
  }


}
