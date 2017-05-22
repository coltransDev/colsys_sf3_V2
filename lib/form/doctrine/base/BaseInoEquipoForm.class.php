<?php

/**
 * InoEquipo form base class.
 *
 * @method InoEquipo getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseInoEquipoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idequipo'       => new sfWidgetFormInputHidden(),
      'ca_idconcepto'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Concepto'), 'add_empty' => true)),
      'ca_idmaster'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('InoMaster'), 'add_empty' => true)),
      'ca_cantidad'       => new sfWidgetFormInputText(),
      'ca_serial'         => new sfWidgetFormTextarea(),
      'ca_numprecinto'    => new sfWidgetFormTextarea(),
      'ca_observaciones'  => new sfWidgetFormTextarea(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usucreado'      => new sfWidgetFormTextarea(),
      'ca_fchactualizado' => new sfWidgetFormDateTime(),
      'ca_usuactualizado' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'ca_idequipo'       => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idequipo', 'required' => false)),
      'ca_idconcepto'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Concepto'), 'required' => false)),
      'ca_idmaster'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('InoMaster'), 'required' => false)),
      'ca_cantidad'       => new sfValidatorNumber(array('required' => false)),
      'ca_serial'         => new sfValidatorString(array('required' => false)),
      'ca_numprecinto'    => new sfValidatorString(array('required' => false)),
      'ca_observaciones'  => new sfValidatorString(array('required' => false)),
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'      => new sfValidatorString(array('required' => false)),
      'ca_fchactualizado' => new sfValidatorDateTime(array('required' => false)),
      'ca_usuactualizado' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ino_equipo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'InoEquipo';
  }

}
