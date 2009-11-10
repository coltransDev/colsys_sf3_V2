<?php

/**
 * PricFleteBs form base class.
 *
 * @method PricFleteBs getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BasePricFleteBsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idtrayecto'     => new sfWidgetFormInputText(),
      'ca_idconcepto'     => new sfWidgetFormDoctrineChoice(array('model' => 'Concepto', 'add_empty' => true)),
      'ca_vlrneto'        => new sfWidgetFormInputText(),
      'ca_vlrsugerido'    => new sfWidgetFormInputText(),
      'ca_fchinicio'      => new sfWidgetFormDate(),
      'ca_fchvencimiento' => new sfWidgetFormDate(),
      'ca_idmoneda'       => new sfWidgetFormTextarea(),
      'ca_estado'         => new sfWidgetFormTextarea(),
      'ca_aplicacion'     => new sfWidgetFormTextarea(),
      'ca_consecutivo'    => new sfWidgetFormInputHidden(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usucreado'      => new sfWidgetFormTextarea(),
      'ca_fcheliminado'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'ca_idtrayecto'     => new sfValidatorInteger(array('required' => false)),
      'ca_idconcepto'     => new sfValidatorDoctrineChoice(array('model' => 'Concepto', 'required' => false)),
      'ca_vlrneto'        => new sfValidatorNumber(array('required' => false)),
      'ca_vlrsugerido'    => new sfValidatorNumber(array('required' => false)),
      'ca_fchinicio'      => new sfValidatorDate(array('required' => false)),
      'ca_fchvencimiento' => new sfValidatorDate(array('required' => false)),
      'ca_idmoneda'       => new sfValidatorString(array('required' => false)),
      'ca_estado'         => new sfValidatorString(array('required' => false)),
      'ca_aplicacion'     => new sfValidatorString(array('required' => false)),
      'ca_consecutivo'    => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_consecutivo', 'required' => false)),
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'      => new sfValidatorString(array('required' => false)),
      'ca_fcheliminado'   => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('pric_flete_bs[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PricFleteBs';
  }

}
