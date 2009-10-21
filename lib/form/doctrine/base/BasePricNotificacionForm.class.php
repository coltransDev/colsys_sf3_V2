<?php

/**
 * PricNotificacion form base class.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BasePricNotificacionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idnotificacion' => new sfWidgetFormInputHidden(),
      'ca_titulo'         => new sfWidgetFormTextarea(),
      'ca_mensaje'        => new sfWidgetFormTextarea(),
      'ca_caducidad'      => new sfWidgetFormTextarea(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usucreado'      => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'ca_idnotificacion' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idnotificacion', 'required' => false)),
      'ca_titulo'         => new sfValidatorString(array('required' => false)),
      'ca_mensaje'        => new sfValidatorString(array('required' => false)),
      'ca_caducidad'      => new sfValidatorString(array('required' => false)),
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'      => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('pric_notificacion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PricNotificacion';
  }

}
