<?php

/**
 * Sucursal form base class.
 *
 * @method Sucursal getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseSucursalForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idsucursal' => new sfWidgetFormInputHidden(),
      'ca_nombre'     => new sfWidgetFormInputText(),
      'ca_telefono'   => new sfWidgetFormTextarea(),
      'ca_fax'        => new sfWidgetFormTextarea(),
      'ca_direccion'  => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'ca_idsucursal' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idsucursal', 'required' => false)),
      'ca_nombre'     => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'ca_telefono'   => new sfValidatorString(array('required' => false)),
      'ca_fax'        => new sfValidatorString(array('required' => false)),
      'ca_direccion'  => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sucursal[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Sucursal';
  }

}
