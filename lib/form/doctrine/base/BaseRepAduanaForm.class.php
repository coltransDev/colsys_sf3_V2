<?php

/**
 * RepAduana form base class.
 *
 * @package    form
 * @subpackage rep_aduana
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseRepAduanaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idreporte'      => new sfWidgetFormInputHidden(),
      'ca_coordinador'    => new sfWidgetFormInput(),
      'ca_transnacarga'   => new sfWidgetFormInput(),
      'ca_transnatipo'    => new sfWidgetFormInput(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usucreado'      => new sfWidgetFormInput(),
      'ca_fchactualizado' => new sfWidgetFormDateTime(),
      'ca_usuactualizado' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idreporte'      => new sfValidatorDoctrineChoice(array('model' => 'RepAduana', 'column' => 'ca_idreporte', 'required' => false)),
      'ca_coordinador'    => new sfValidatorString(array('required' => false)),
      'ca_transnacarga'   => new sfValidatorString(array('required' => false)),
      'ca_transnatipo'    => new sfValidatorNumber(array('required' => false)),
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'      => new sfValidatorString(array('required' => false)),
      'ca_fchactualizado' => new sfValidatorDateTime(array('required' => false)),
      'ca_usuactualizado' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rep_aduana[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'RepAduana';
  }

}