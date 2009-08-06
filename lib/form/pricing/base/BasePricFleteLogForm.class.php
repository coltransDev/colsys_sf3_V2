<?php

/**
 * PricFleteLog form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BasePricFleteLogForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idtrayecto'     => new sfWidgetFormPropelChoice(array('model' => 'Trayecto', 'add_empty' => false)),
      'ca_idconcepto'     => new sfWidgetFormPropelChoice(array('model' => 'Concepto', 'add_empty' => false)),
      'ca_vlrneto'        => new sfWidgetFormInput(),
      'ca_vlrsugerido'    => new sfWidgetFormInput(),
      'ca_fchinicio'      => new sfWidgetFormDate(),
      'ca_fchvencimiento' => new sfWidgetFormDate(),
      'ca_idmoneda'       => new sfWidgetFormInput(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usucreado'      => new sfWidgetFormInput(),
      'ca_estado'         => new sfWidgetFormInput(),
      'ca_aplicacion'     => new sfWidgetFormInput(),
      'ca_consecutivo'    => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'ca_idtrayecto'     => new sfValidatorPropelChoice(array('model' => 'Trayecto', 'column' => 'ca_idtrayecto')),
      'ca_idconcepto'     => new sfValidatorPropelChoice(array('model' => 'Concepto', 'column' => 'ca_idconcepto')),
      'ca_vlrneto'        => new sfValidatorNumber(array('required' => false)),
      'ca_vlrsugerido'    => new sfValidatorNumber(array('required' => false)),
      'ca_fchinicio'      => new sfValidatorDate(array('required' => false)),
      'ca_fchvencimiento' => new sfValidatorDate(array('required' => false)),
      'ca_idmoneda'       => new sfValidatorString(array('max_length' => 3, 'required' => false)),
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'      => new sfValidatorString(array('required' => false)),
      'ca_estado'         => new sfValidatorInteger(array('required' => false)),
      'ca_aplicacion'     => new sfValidatorString(array('required' => false)),
      'ca_consecutivo'    => new sfValidatorPropelChoice(array('model' => 'PricFleteLog', 'column' => 'ca_consecutivo', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('pric_flete_log[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PricFleteLog';
  }


}
