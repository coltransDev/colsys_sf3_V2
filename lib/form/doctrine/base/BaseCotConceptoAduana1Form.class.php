<?php

/**
 * CotConceptoAduana1 form base class.
 *
 * @method CotConceptoAduana1 getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseCotConceptoAduana1Form extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_consecutivo'      => new sfWidgetFormInputHidden(),
      'ca_idconcepto'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Costo'), 'add_empty' => false)),
      'ca_valor'            => new sfWidgetFormInputText(),
      'ca_aplicacion'       => new sfWidgetFormTextarea(),
      'ca_valorminimo'      => new sfWidgetFormInputText(),
      'ca_parametro'        => new sfWidgetFormTextarea(),
      'ca_aplicacionminimo' => new sfWidgetFormTextarea(),
      'ca_fchini'           => new sfWidgetFormDate(),
      'ca_fchfin'           => new sfWidgetFormDate(),
      'ca_fchcreado'        => new sfWidgetFormDateTime(),
      'ca_usucreado'        => new sfWidgetFormTextarea(),
      'ca_observaciones'    => new sfWidgetFormTextarea(),
      'ca_idcotizacion'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cotizacion'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'ca_consecutivo'      => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_consecutivo', 'required' => false)),
      'ca_idconcepto'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Costo'))),
      'ca_valor'            => new sfValidatorPass(),
      'ca_aplicacion'       => new sfValidatorString(),
      'ca_valorminimo'      => new sfValidatorPass(),
      'ca_parametro'        => new sfValidatorString(),
      'ca_aplicacionminimo' => new sfValidatorString(),
      'ca_fchini'           => new sfValidatorDate(array('required' => false)),
      'ca_fchfin'           => new sfValidatorDate(array('required' => false)),
      'ca_fchcreado'        => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'        => new sfValidatorString(array('required' => false)),
      'ca_observaciones'    => new sfValidatorString(),
      'ca_idcotizacion'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Cotizacion'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cot_concepto_aduana1[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CotConceptoAduana1';
  }

}