<?php

/**
 * RepAduana form base class.
 *
 * @method RepAduana getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseRepAduanaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idreporte'      => new sfWidgetFormInputHidden(),
      'ca_instrucciones'  => new sfWidgetFormTextarea(),
      'ca_coordinador'    => new sfWidgetFormTextarea(),
      'ca_transnacarga'   => new sfWidgetFormTextarea(),
      'ca_transnatipo'    => new sfWidgetFormTextarea(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usucreado'      => new sfWidgetFormTextarea(),
      'ca_fchactualizado' => new sfWidgetFormDateTime(),
      'ca_usuactualizado' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'ca_idreporte'      => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idreporte', 'required' => false)),
      'ca_instrucciones'  => new sfValidatorString(array('required' => false)),
      'ca_coordinador'    => new sfValidatorString(array('required' => false)),
      'ca_transnacarga'   => new sfValidatorString(array('required' => false)),
      'ca_transnatipo'    => new sfValidatorString(array('required' => false)),
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'      => new sfValidatorString(array('required' => false)),
      'ca_fchactualizado' => new sfValidatorDateTime(array('required' => false)),
      'ca_usuactualizado' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rep_aduana[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RepAduana';
  }

}
