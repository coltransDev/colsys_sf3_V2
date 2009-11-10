<?php

/**
 * RepGasto form base class.
 *
 * @method RepGasto getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseRepGastoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'oid'               => new sfWidgetFormInputText(),
      'ca_idreporte'      => new sfWidgetFormInputHidden(),
      'ca_idconcepto'     => new sfWidgetFormInputHidden(),
      'ca_idrecargo'      => new sfWidgetFormInputHidden(),
      'ca_aplicacion'     => new sfWidgetFormTextarea(),
      'ca_tipo'           => new sfWidgetFormTextarea(),
      'ca_neta_tar'       => new sfWidgetFormInputText(),
      'ca_neta_min'       => new sfWidgetFormInputText(),
      'ca_reportar_tar'   => new sfWidgetFormInputText(),
      'ca_reportar_min'   => new sfWidgetFormInputText(),
      'ca_cobrar_tar'     => new sfWidgetFormInputText(),
      'ca_cobrar_min'     => new sfWidgetFormInputText(),
      'ca_idmoneda'       => new sfWidgetFormTextarea(),
      'ca_detalles'       => new sfWidgetFormTextarea(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usucreado'      => new sfWidgetFormTextarea(),
      'ca_fchactualizado' => new sfWidgetFormDateTime(),
      'ca_usuactualizado' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'oid'               => new sfValidatorInteger(array('required' => false)),
      'ca_idreporte'      => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idreporte', 'required' => false)),
      'ca_idconcepto'     => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idconcepto', 'required' => false)),
      'ca_idrecargo'      => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idrecargo', 'required' => false)),
      'ca_aplicacion'     => new sfValidatorString(array('required' => false)),
      'ca_tipo'           => new sfValidatorString(array('required' => false)),
      'ca_neta_tar'       => new sfValidatorNumber(array('required' => false)),
      'ca_neta_min'       => new sfValidatorNumber(array('required' => false)),
      'ca_reportar_tar'   => new sfValidatorNumber(array('required' => false)),
      'ca_reportar_min'   => new sfValidatorNumber(array('required' => false)),
      'ca_cobrar_tar'     => new sfValidatorNumber(array('required' => false)),
      'ca_cobrar_min'     => new sfValidatorNumber(array('required' => false)),
      'ca_idmoneda'       => new sfValidatorString(array('required' => false)),
      'ca_detalles'       => new sfValidatorString(array('required' => false)),
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'      => new sfValidatorString(array('required' => false)),
      'ca_fchactualizado' => new sfValidatorDateTime(array('required' => false)),
      'ca_usuactualizado' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rep_gasto[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RepGasto';
  }

}
