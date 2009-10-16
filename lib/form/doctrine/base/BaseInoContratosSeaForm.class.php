<?php

/**
 * InoContratosSea form base class.
 *
 * @package    form
 * @subpackage ino_contratos_sea
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseInoContratosSeaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_referencia'     => new sfWidgetFormInputHidden(),
      'ca_idequipo'       => new sfWidgetFormInputHidden(),
      'ca_idcontrato'     => new sfWidgetFormInput(),
      'ca_fchcontrato'    => new sfWidgetFormDate(),
      'ca_inspeccion_nta' => new sfWidgetFormInput(),
      'ca_inspeccion_fch' => new sfWidgetFormDate(),
      'ca_observaciones'  => new sfWidgetFormInput(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usucreado'      => new sfWidgetFormInput(),
      'ca_fchactualizado' => new sfWidgetFormDateTime(),
      'ca_usuactualizado' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_referencia'     => new sfValidatorDoctrineChoice(array('model' => 'InoContratosSea', 'column' => 'ca_referencia', 'required' => false)),
      'ca_idequipo'       => new sfValidatorDoctrineChoice(array('model' => 'InoContratosSea', 'column' => 'ca_idequipo', 'required' => false)),
      'ca_idcontrato'     => new sfValidatorString(array('required' => false)),
      'ca_fchcontrato'    => new sfValidatorDate(array('required' => false)),
      'ca_inspeccion_nta' => new sfValidatorString(array('required' => false)),
      'ca_inspeccion_fch' => new sfValidatorDate(array('required' => false)),
      'ca_observaciones'  => new sfValidatorString(array('required' => false)),
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'      => new sfValidatorString(array('required' => false)),
      'ca_fchactualizado' => new sfValidatorDateTime(array('required' => false)),
      'ca_usuactualizado' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ino_contratos_sea[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'InoContratosSea';
  }

}