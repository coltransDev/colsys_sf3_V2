<?php

/**
 * RepSeguro form base class.
 *
 * @package    form
 * @subpackage rep_seguro
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseRepSeguroForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idreporte'       => new sfWidgetFormInputHidden(),
      'ca_vlrasegurado'    => new sfWidgetFormInput(),
      'ca_idmoneda_vlr'    => new sfWidgetFormInput(),
      'ca_primaventa'      => new sfWidgetFormInput(),
      'ca_minimaventa'     => new sfWidgetFormInput(),
      'ca_idmoneda_vta'    => new sfWidgetFormInput(),
      'ca_obtencionpoliza' => new sfWidgetFormInput(),
      'ca_idmoneda_pol'    => new sfWidgetFormInput(),
      'ca_seguro_conf'     => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idreporte'       => new sfValidatorDoctrineChoice(array('model' => 'RepSeguro', 'column' => 'ca_idreporte', 'required' => false)),
      'ca_vlrasegurado'    => new sfValidatorNumber(array('required' => false)),
      'ca_idmoneda_vlr'    => new sfValidatorString(array('required' => false)),
      'ca_primaventa'      => new sfValidatorNumber(array('required' => false)),
      'ca_minimaventa'     => new sfValidatorNumber(array('required' => false)),
      'ca_idmoneda_vta'    => new sfValidatorString(array('required' => false)),
      'ca_obtencionpoliza' => new sfValidatorNumber(array('required' => false)),
      'ca_idmoneda_pol'    => new sfValidatorString(array('required' => false)),
      'ca_seguro_conf'     => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rep_seguro[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'RepSeguro';
  }

}