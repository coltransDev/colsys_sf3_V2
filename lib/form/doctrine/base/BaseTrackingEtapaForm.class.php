<?php

/**
 * TrackingEtapa form base class.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseTrackingEtapaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idetapa'         => new sfWidgetFormInputHidden(),
      'ca_impoexpo'        => new sfWidgetFormTextarea(),
      'ca_transporte'      => new sfWidgetFormTextarea(),
      'ca_departamento'    => new sfWidgetFormTextarea(),
      'ca_etapa'           => new sfWidgetFormTextarea(),
      'ca_orden'           => new sfWidgetFormInputText(),
      'ca_ttl'             => new sfWidgetFormInputText(),
      'ca_class'           => new sfWidgetFormTextarea(),
      'ca_template'        => new sfWidgetFormTextarea(),
      'ca_message'         => new sfWidgetFormTextarea(),
      'ca_message_default' => new sfWidgetFormTextarea(),
      'ca_intro'           => new sfWidgetFormTextarea(),
      'ca_title'           => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'ca_idetapa'         => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idetapa', 'required' => false)),
      'ca_impoexpo'        => new sfValidatorString(array('required' => false)),
      'ca_transporte'      => new sfValidatorString(array('required' => false)),
      'ca_departamento'    => new sfValidatorString(array('required' => false)),
      'ca_etapa'           => new sfValidatorString(array('required' => false)),
      'ca_orden'           => new sfValidatorInteger(array('required' => false)),
      'ca_ttl'             => new sfValidatorInteger(array('required' => false)),
      'ca_class'           => new sfValidatorString(array('required' => false)),
      'ca_template'        => new sfValidatorString(array('required' => false)),
      'ca_message'         => new sfValidatorString(array('required' => false)),
      'ca_message_default' => new sfValidatorString(array('required' => false)),
      'ca_intro'           => new sfValidatorString(array('required' => false)),
      'ca_title'           => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tracking_etapa[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TrackingEtapa';
  }

}
