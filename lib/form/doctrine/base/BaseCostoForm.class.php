<?php

/**
 * Costo form base class.
 *
 * @method Costo getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseCostoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idcosto'      => new sfWidgetFormInputHidden(),
      'ca_costo'        => new sfWidgetFormTextarea(),
      'ca_transporte'   => new sfWidgetFormTextarea(),
      'ca_impoexpo'     => new sfWidgetFormTextarea(),
      'ca_modalidad'    => new sfWidgetFormTextarea(),
      'ca_comisionable' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'ca_idcosto'      => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idcosto', 'required' => false)),
      'ca_costo'        => new sfValidatorString(array('required' => false)),
      'ca_transporte'   => new sfValidatorString(array('required' => false)),
      'ca_impoexpo'     => new sfValidatorString(array('required' => false)),
      'ca_modalidad'    => new sfValidatorString(array('required' => false)),
      'ca_comisionable' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('costo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Costo';
  }

}
