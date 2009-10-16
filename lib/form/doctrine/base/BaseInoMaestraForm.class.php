<?php

/**
 * InoMaestra form base class.
 *
 * @package    form
 * @subpackage ino_maestra
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseInoMaestraForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idmaestra'      => new sfWidgetFormInputHidden(),
      'ca_fchreferencia'  => new sfWidgetFormDate(),
      'ca_referencia'     => new sfWidgetFormInput(),
      'ca_idtrayecto'     => new sfWidgetFormInput(),
      'ca_master'         => new sfWidgetFormInput(),
      'ca_fchmaster'      => new sfWidgetFormDate(),
      'ca_piezas'         => new sfWidgetFormInput(),
      'ca_peso'           => new sfWidgetFormInput(),
      'ca_volumen'        => new sfWidgetFormInput(),
      'ca_observaciones'  => new sfWidgetFormInput(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usucreado'      => new sfWidgetFormInput(),
      'ca_fchactualizado' => new sfWidgetFormDateTime(),
      'ca_usuactualizado' => new sfWidgetFormInput(),
      'ca_fchliquidado'   => new sfWidgetFormDateTime(),
      'ca_usuliquidado'   => new sfWidgetFormInput(),
      'ca_fchcerrado'     => new sfWidgetFormDateTime(),
      'ca_usucerrado'     => new sfWidgetFormInput(),
      'ca_fchanulado'     => new sfWidgetFormDateTime(),
      'ca_usuanulado'     => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idmaestra'      => new sfValidatorDoctrineChoice(array('model' => 'InoMaestra', 'column' => 'ca_idmaestra', 'required' => false)),
      'ca_fchreferencia'  => new sfValidatorDate(array('required' => false)),
      'ca_referencia'     => new sfValidatorString(array('required' => false)),
      'ca_idtrayecto'     => new sfValidatorInteger(array('required' => false)),
      'ca_master'         => new sfValidatorString(array('required' => false)),
      'ca_fchmaster'      => new sfValidatorDate(array('required' => false)),
      'ca_piezas'         => new sfValidatorNumber(array('required' => false)),
      'ca_peso'           => new sfValidatorNumber(array('required' => false)),
      'ca_volumen'        => new sfValidatorNumber(array('required' => false)),
      'ca_observaciones'  => new sfValidatorString(array('required' => false)),
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'      => new sfValidatorString(array('required' => false)),
      'ca_fchactualizado' => new sfValidatorDateTime(array('required' => false)),
      'ca_usuactualizado' => new sfValidatorString(array('required' => false)),
      'ca_fchliquidado'   => new sfValidatorDateTime(array('required' => false)),
      'ca_usuliquidado'   => new sfValidatorString(array('required' => false)),
      'ca_fchcerrado'     => new sfValidatorDateTime(array('required' => false)),
      'ca_usucerrado'     => new sfValidatorString(array('required' => false)),
      'ca_fchanulado'     => new sfValidatorDateTime(array('required' => false)),
      'ca_usuanulado'     => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ino_maestra[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'InoMaestra';
  }

}