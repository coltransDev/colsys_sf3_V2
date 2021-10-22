<?php

/**
 * CotRecargosAduana1 form base class.
 *
 * @method CotRecargosAduana1 getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseCotRecargosAduana1Form extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_consecutivo'    => new sfWidgetFormInputHidden(),
      'ca_idpadre'        => new sfWidgetFormInputText(),
      'ca_idtrayecto'     => new sfWidgetFormInputText(),
      'ca_recargo'        => new sfWidgetFormTextarea(),
      'ca_contenedor'     => new sfWidgetFormTextarea(),
      'ca_valor'          => new sfWidgetFormInputText(),
      'ca_aplicacion'     => new sfWidgetFormTextarea(),
      'ca_detalles'       => new sfWidgetFormTextarea(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usucreado'      => new sfWidgetFormTextarea(),
      'ca_fchactualizado' => new sfWidgetFormDateTime(),
      'ca_usuactualizado' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'ca_consecutivo'    => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_consecutivo', 'required' => false)),
      'ca_idpadre'        => new sfValidatorInteger(),
      'ca_idtrayecto'     => new sfValidatorInteger(),
      'ca_recargo'        => new sfValidatorString(array('required' => false)),
      'ca_contenedor'     => new sfValidatorString(array('required' => false)),
      'ca_valor'          => new sfValidatorPass(array('required' => false)),
      'ca_aplicacion'     => new sfValidatorString(array('required' => false)),
      'ca_detalles'       => new sfValidatorString(array('required' => false)),
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'      => new sfValidatorString(array('required' => false)),
      'ca_fchactualizado' => new sfValidatorDateTime(array('required' => false)),
      'ca_usuactualizado' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cot_recargos_aduana1[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CotRecargosAduana1';
  }

}
