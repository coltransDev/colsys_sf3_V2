<?php

/**
 * InoContratosSea form base class.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseInoContratosSeaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_referencia'     => new sfWidgetFormInputHidden(),
      'ca_idequipo'       => new sfWidgetFormInputHidden(),
      'ca_idcontrato'     => new sfWidgetFormTextarea(),
      'ca_fchcontrato'    => new sfWidgetFormDate(),
      'ca_inspeccion_nta' => new sfWidgetFormTextarea(),
      'ca_inspeccion_fch' => new sfWidgetFormDate(),
      'ca_observaciones'  => new sfWidgetFormTextarea(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usucreado'      => new sfWidgetFormTextarea(),
      'ca_fchactualizado' => new sfWidgetFormDateTime(),
      'ca_usuactualizado' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'ca_referencia'     => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_referencia', 'required' => false)),
      'ca_idequipo'       => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idequipo', 'required' => false)),
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

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'InoContratosSea';
  }

}
