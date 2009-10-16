<?php

/**
 * PricRecargoxConceptoBs form base class.
 *
 * @package    form
 * @subpackage pric_recargox_concepto_bs
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BasePricRecargoxConceptoBsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idtrayecto'     => new sfWidgetFormInput(),
      'ca_idconcepto'     => new sfWidgetFormDoctrineSelect(array('model' => 'Concepto', 'add_empty' => true)),
      'ca_idrecargo'      => new sfWidgetFormDoctrineSelect(array('model' => 'TipoRecargo', 'add_empty' => true)),
      'ca_vlrrecargo'     => new sfWidgetFormInput(),
      'ca_aplicacion'     => new sfWidgetFormInput(),
      'ca_vlrminimo'      => new sfWidgetFormInput(),
      'ca_aplicacion_min' => new sfWidgetFormInput(),
      'ca_observaciones'  => new sfWidgetFormInput(),
      'ca_fchinicio'      => new sfWidgetFormDate(),
      'ca_fchvencimiento' => new sfWidgetFormDate(),
      'ca_idmoneda'       => new sfWidgetFormInput(),
      'ca_consecutivo'    => new sfWidgetFormInputHidden(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usucreado'      => new sfWidgetFormInput(),
      'ca_fcheliminado'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'ca_idtrayecto'     => new sfValidatorInteger(array('required' => false)),
      'ca_idconcepto'     => new sfValidatorDoctrineChoice(array('model' => 'Concepto', 'required' => false)),
      'ca_idrecargo'      => new sfValidatorDoctrineChoice(array('model' => 'TipoRecargo', 'required' => false)),
      'ca_vlrrecargo'     => new sfValidatorNumber(array('required' => false)),
      'ca_aplicacion'     => new sfValidatorString(array('required' => false)),
      'ca_vlrminimo'      => new sfValidatorNumber(array('required' => false)),
      'ca_aplicacion_min' => new sfValidatorString(array('required' => false)),
      'ca_observaciones'  => new sfValidatorString(array('required' => false)),
      'ca_fchinicio'      => new sfValidatorDate(array('required' => false)),
      'ca_fchvencimiento' => new sfValidatorDate(array('required' => false)),
      'ca_idmoneda'       => new sfValidatorString(array('required' => false)),
      'ca_consecutivo'    => new sfValidatorDoctrineChoice(array('model' => 'PricRecargoxConceptoBs', 'column' => 'ca_consecutivo', 'required' => false)),
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'      => new sfValidatorString(array('required' => false)),
      'ca_fcheliminado'   => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('pric_recargox_concepto_bs[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PricRecargoxConceptoBs';
  }

}