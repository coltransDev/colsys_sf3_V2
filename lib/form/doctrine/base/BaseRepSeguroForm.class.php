<?php

/**
 * RepSeguro form base class.
 *
 * @method RepSeguro getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseRepSeguroForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idreporte'       => new sfWidgetFormInputHidden(),
      'ca_vlrasegurado'    => new sfWidgetFormInputText(),
      'ca_idmoneda_vlr'    => new sfWidgetFormTextarea(),
      'ca_primaventa'      => new sfWidgetFormInputText(),
      'ca_minimaventa'     => new sfWidgetFormInputText(),
      'ca_idmoneda_vta'    => new sfWidgetFormTextarea(),
      'ca_obtencionpoliza' => new sfWidgetFormInputText(),
      'ca_idmoneda_pol'    => new sfWidgetFormTextarea(),
      'ca_seguro_conf'     => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'ca_idreporte'       => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idreporte', 'required' => false)),
      'ca_vlrasegurado'    => new sfValidatorNumber(),
      'ca_idmoneda_vlr'    => new sfValidatorString(array('required' => false)),
      'ca_primaventa'      => new sfValidatorNumber(),
      'ca_minimaventa'     => new sfValidatorNumber(),
      'ca_idmoneda_vta'    => new sfValidatorString(array('required' => false)),
      'ca_obtencionpoliza' => new sfValidatorNumber(),
      'ca_idmoneda_pol'    => new sfValidatorString(array('required' => false)),
      'ca_seguro_conf'     => new sfValidatorString(),
    ));

    $this->widgetSchema->setNameFormat('rep_seguro[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RepSeguro';
  }

}
