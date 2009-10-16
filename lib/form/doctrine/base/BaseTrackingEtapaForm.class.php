<?php

/**
 * TrackingEtapa form base class.
 *
 * @package    form
 * @subpackage tracking_etapa
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseTrackingEtapaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idetapa'         => new sfWidgetFormInputHidden(),
      'ca_impoexpo'        => new sfWidgetFormInput(),
      'ca_transporte'      => new sfWidgetFormInput(),
      'ca_departamento'    => new sfWidgetFormInput(),
      'ca_etapa'           => new sfWidgetFormInput(),
      'ca_orden'           => new sfWidgetFormInput(),
      'ca_ttl'             => new sfWidgetFormInput(),
      'ca_class'           => new sfWidgetFormInput(),
      'ca_template'        => new sfWidgetFormInput(),
      'ca_message'         => new sfWidgetFormInput(),
      'ca_message_default' => new sfWidgetFormInput(),
      'ca_intro'           => new sfWidgetFormInput(),
      'ca_title'           => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idetapa'         => new sfValidatorDoctrineChoice(array('model' => 'TrackingEtapa', 'column' => 'ca_idetapa', 'required' => false)),
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

    parent::setup();
  }

  public function getModelName()
  {
    return 'TrackingEtapa';
  }

}