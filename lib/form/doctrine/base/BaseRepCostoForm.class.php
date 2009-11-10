<?php

/**
 * RepCosto form base class.
 *
 * @method RepCosto getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseRepCostoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idreporte' => new sfWidgetFormInputHidden(),
      'ca_idcosto'   => new sfWidgetFormInputHidden(),
      'ca_tipo'      => new sfWidgetFormTextarea(),
      'ca_vlrcosto'  => new sfWidgetFormInputText(),
      'ca_mincosto'  => new sfWidgetFormInputText(),
      'ca_netcosto'  => new sfWidgetFormInputText(),
      'ca_idmoneda'  => new sfWidgetFormTextarea(),
      'ca_detalles'  => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'ca_idreporte' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idreporte', 'required' => false)),
      'ca_idcosto'   => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idcosto', 'required' => false)),
      'ca_tipo'      => new sfValidatorString(array('required' => false)),
      'ca_vlrcosto'  => new sfValidatorNumber(array('required' => false)),
      'ca_mincosto'  => new sfValidatorNumber(array('required' => false)),
      'ca_netcosto'  => new sfValidatorNumber(array('required' => false)),
      'ca_idmoneda'  => new sfValidatorString(array('required' => false)),
      'ca_detalles'  => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rep_costo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RepCosto';
  }

}
