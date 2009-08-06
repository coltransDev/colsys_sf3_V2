<?php

/**
 * PricNotificacion form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BasePricNotificacionForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idnotificacion' => new sfWidgetFormInputHidden(),
      'ca_titulo'         => new sfWidgetFormInput(),
      'ca_mensaje'        => new sfWidgetFormInput(),
      'ca_caducidad'      => new sfWidgetFormDate(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usucreado'      => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idnotificacion' => new sfValidatorPropelChoice(array('model' => 'PricNotificacion', 'column' => 'ca_idnotificacion', 'required' => false)),
      'ca_titulo'         => new sfValidatorString(),
      'ca_mensaje'        => new sfValidatorString(),
      'ca_caducidad'      => new sfValidatorDate(array('required' => false)),
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'      => new sfValidatorString(array('max_length' => 15, 'required' => false)),
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
