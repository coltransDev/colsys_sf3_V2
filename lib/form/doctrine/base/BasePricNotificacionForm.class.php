<?php

/**
 * PricNotificacion form base class.
 *
 * @package    form
 * @subpackage pric_notificacion
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BasePricNotificacionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idnotificacion' => new sfWidgetFormInputHidden(),
      'ca_titulo'         => new sfWidgetFormInput(),
      'ca_mensaje'        => new sfWidgetFormInput(),
      'ca_caducidad'      => new sfWidgetFormInput(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usucreado'      => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idnotificacion' => new sfValidatorDoctrineChoice(array('model' => 'PricNotificacion', 'column' => 'ca_idnotificacion', 'required' => false)),
      'ca_titulo'         => new sfValidatorString(array('required' => false)),
      'ca_mensaje'        => new sfValidatorString(array('required' => false)),
      'ca_caducidad'      => new sfValidatorString(array('required' => false)),
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'      => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('pric_notificacion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PricNotificacion';
  }

}