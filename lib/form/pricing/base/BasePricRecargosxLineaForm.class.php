<?php

/**
 * PricRecargosxLinea form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BasePricRecargosxLineaForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idtrafico'      => new sfWidgetFormInputHidden(),
      'ca_idlinea'        => new sfWidgetFormInputHidden(),
      'ca_idrecargo'      => new sfWidgetFormInputHidden(),
      'ca_idconcepto'     => new sfWidgetFormInputHidden(),
      'ca_modalidad'      => new sfWidgetFormInputHidden(),
      'ca_impoexpo'       => new sfWidgetFormInputHidden(),
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
      'ca_consecutivo'    => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idtrafico'      => new sfValidatorPropelChoice(array('model' => 'PricRecargosxLinea', 'column' => 'ca_idtrafico', 'required' => false)),
      'ca_idlinea'        => new sfValidatorPropelChoice(array('model' => 'Transportador', 'column' => 'ca_idlinea', 'required' => false)),
      'ca_idrecargo'      => new sfValidatorPropelChoice(array('model' => 'TipoRecargo', 'column' => 'ca_idrecargo', 'required' => false)),
      'ca_idconcepto'     => new sfValidatorPropelChoice(array('model' => 'Concepto', 'column' => 'ca_idconcepto', 'required' => false)),
      'ca_modalidad'      => new sfValidatorPropelChoice(array('model' => 'PricRecargosxLinea', 'column' => 'ca_modalidad', 'required' => false)),
      'ca_impoexpo'       => new sfValidatorPropelChoice(array('model' => 'PricRecargosxLinea', 'column' => 'ca_impoexpo', 'required' => false)),
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
      'ca_consecutivo'    => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('pric_recargosx_linea[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PricRecargosxLinea';
  }


}
