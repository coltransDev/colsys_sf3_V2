<?php

/**
 * InoDeduccion form base class.
 *
 * @method InoDeduccion getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseInoDeduccionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_iddeduccion'    => new sfWidgetFormInputHidden(),
      'ca_idcomprobante'  => new sfWidgetFormInputHidden(),
      'ca_neto'           => new sfWidgetFormInputText(),
      'ca_tcambio'        => new sfWidgetFormInputText(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usucreado'      => new sfWidgetFormTextarea(),
      'ca_fchactualizado' => new sfWidgetFormDateTime(),
      'ca_usuactualizado' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'ca_iddeduccion'    => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_iddeduccion', 'required' => false)),
      'ca_idcomprobante'  => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idcomprobante', 'required' => false)),
      'ca_neto'           => new sfValidatorNumber(array('required' => false)),
      'ca_tcambio'        => new sfValidatorNumber(array('required' => false)),
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'      => new sfValidatorString(array('required' => false)),
      'ca_fchactualizado' => new sfValidatorDateTime(array('required' => false)),
      'ca_usuactualizado' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ino_deduccion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'InoDeduccion';
  }

}
