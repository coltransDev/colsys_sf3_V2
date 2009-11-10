<?php

/**
 * CotOpcion form base class.
 *
 * @method CotOpcion getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseCotOpcionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idopcion'       => new sfWidgetFormInputHidden(),
      'ca_idproducto'     => new sfWidgetFormDoctrineChoice(array('model' => 'CotProducto', 'add_empty' => true)),
      'ca_idcotizacion'   => new sfWidgetFormInputText(),
      'ca_idconcepto'     => new sfWidgetFormDoctrineChoice(array('model' => 'Concepto', 'add_empty' => true)),
      'ca_valor_tar'      => new sfWidgetFormInputText(),
      'ca_aplica_tar'     => new sfWidgetFormTextarea(),
      'ca_valor_min'      => new sfWidgetFormInputText(),
      'ca_aplica_min'     => new sfWidgetFormTextarea(),
      'ca_idmoneda'       => new sfWidgetFormTextarea(),
      'ca_observaciones'  => new sfWidgetFormTextarea(),
      'ca_consecutivo'    => new sfWidgetFormInputText(),
      'ca_usucreado'      => new sfWidgetFormInputText(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usuactualizado' => new sfWidgetFormInputText(),
      'ca_fchactualizado' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'ca_idopcion'       => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idopcion', 'required' => false)),
      'ca_idproducto'     => new sfValidatorDoctrineChoice(array('model' => 'CotProducto', 'required' => false)),
      'ca_idcotizacion'   => new sfValidatorInteger(array('required' => false)),
      'ca_idconcepto'     => new sfValidatorDoctrineChoice(array('model' => 'Concepto', 'required' => false)),
      'ca_valor_tar'      => new sfValidatorNumber(array('required' => false)),
      'ca_aplica_tar'     => new sfValidatorString(array('required' => false)),
      'ca_valor_min'      => new sfValidatorNumber(array('required' => false)),
      'ca_aplica_min'     => new sfValidatorString(array('required' => false)),
      'ca_idmoneda'       => new sfValidatorString(array('required' => false)),
      'ca_observaciones'  => new sfValidatorString(array('required' => false)),
      'ca_consecutivo'    => new sfValidatorInteger(array('required' => false)),
      'ca_usucreado'      => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
      'ca_usuactualizado' => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'ca_fchactualizado' => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cot_opcion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CotOpcion';
  }

}
