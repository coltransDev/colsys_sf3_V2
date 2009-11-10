<?php

/**
 * PricRecargoxCiudad form base class.
 *
 * @method PricRecargoxCiudad getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BasePricRecargoxCiudadForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idtrafico'      => new sfWidgetFormInputHidden(),
      'ca_idciudad'       => new sfWidgetFormInputHidden(),
      'ca_idrecargo'      => new sfWidgetFormInputHidden(),
      'ca_modalidad'      => new sfWidgetFormInputHidden(),
      'ca_impoexpo'       => new sfWidgetFormInputHidden(),
      'ca_vlrrecargo'     => new sfWidgetFormInputText(),
      'ca_aplicacion'     => new sfWidgetFormTextarea(),
      'ca_vlrminimo'      => new sfWidgetFormInputText(),
      'ca_aplicacion_min' => new sfWidgetFormTextarea(),
      'ca_observaciones'  => new sfWidgetFormTextarea(),
      'ca_fchinicio'      => new sfWidgetFormDate(),
      'ca_fchvencimiento' => new sfWidgetFormDate(),
      'ca_idmoneda'       => new sfWidgetFormTextarea(),
      'ca_consecutivo'    => new sfWidgetFormInputText(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usucreado'      => new sfWidgetFormTextarea(),
      'ca_fcheliminado'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'ca_idtrafico'      => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idtrafico', 'required' => false)),
      'ca_idciudad'       => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idciudad', 'required' => false)),
      'ca_idrecargo'      => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idrecargo', 'required' => false)),
      'ca_modalidad'      => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_modalidad', 'required' => false)),
      'ca_impoexpo'       => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_impoexpo', 'required' => false)),
      'ca_vlrrecargo'     => new sfValidatorNumber(array('required' => false)),
      'ca_aplicacion'     => new sfValidatorString(array('required' => false)),
      'ca_vlrminimo'      => new sfValidatorNumber(array('required' => false)),
      'ca_aplicacion_min' => new sfValidatorString(array('required' => false)),
      'ca_observaciones'  => new sfValidatorString(array('required' => false)),
      'ca_fchinicio'      => new sfValidatorDate(array('required' => false)),
      'ca_fchvencimiento' => new sfValidatorDate(array('required' => false)),
      'ca_idmoneda'       => new sfValidatorString(array('required' => false)),
      'ca_consecutivo'    => new sfValidatorInteger(array('required' => false)),
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'      => new sfValidatorString(array('required' => false)),
      'ca_fcheliminado'   => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('pric_recargox_ciudad[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PricRecargoxCiudad';
  }

}
