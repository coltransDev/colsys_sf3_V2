<?php

/**
 * Cliente form base class.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseClienteForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idcliente'    => new sfWidgetFormInputHidden(),
      'ca_digito'       => new sfWidgetFormInputText(),
      'ca_compania'     => new sfWidgetFormTextarea(),
      'ca_papellido'    => new sfWidgetFormTextarea(),
      'ca_sapellido'    => new sfWidgetFormTextarea(),
      'ca_nombres'      => new sfWidgetFormTextarea(),
      'ca_saludo'       => new sfWidgetFormTextarea(),
      'ca_sexo'         => new sfWidgetFormTextarea(),
      'ca_cumpleanos'   => new sfWidgetFormTextarea(),
      'ca_oficina'      => new sfWidgetFormTextarea(),
      'ca_email'        => new sfWidgetFormTextarea(),
      'ca_vendedor'     => new sfWidgetFormDoctrineChoice(array('model' => 'Usuario', 'add_empty' => true)),
      'ca_coordinador'  => new sfWidgetFormTextarea(),
      'ca_direccion'    => new sfWidgetFormTextarea(),
      'ca_torre'        => new sfWidgetFormTextarea(),
      'ca_bloque'       => new sfWidgetFormTextarea(),
      'ca_interior'     => new sfWidgetFormTextarea(),
      'ca_localidad'    => new sfWidgetFormTextarea(),
      'ca_complemento'  => new sfWidgetFormTextarea(),
      'ca_telefonos'    => new sfWidgetFormTextarea(),
      'ca_fax'          => new sfWidgetFormTextarea(),
      'ca_preferencias' => new sfWidgetFormTextarea(),
      'ca_confirmar'    => new sfWidgetFormTextarea(),
      'ca_idciudad'     => new sfWidgetFormDoctrineChoice(array('model' => 'Ciudad', 'add_empty' => true)),
      'ca_idgrupo'      => new sfWidgetFormTextarea(),
      'ca_listaclinton' => new sfWidgetFormTextarea(),
      'ca_fchcircular'  => new sfWidgetFormDate(),
      'ca_status'       => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'ca_idcliente'    => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idcliente', 'required' => false)),
      'ca_digito'       => new sfValidatorInteger(array('required' => false)),
      'ca_compania'     => new sfValidatorString(array('required' => false)),
      'ca_papellido'    => new sfValidatorString(array('required' => false)),
      'ca_sapellido'    => new sfValidatorString(array('required' => false)),
      'ca_nombres'      => new sfValidatorString(array('required' => false)),
      'ca_saludo'       => new sfValidatorString(array('required' => false)),
      'ca_sexo'         => new sfValidatorString(array('required' => false)),
      'ca_cumpleanos'   => new sfValidatorString(array('required' => false)),
      'ca_oficina'      => new sfValidatorString(array('required' => false)),
      'ca_email'        => new sfValidatorString(array('required' => false)),
      'ca_vendedor'     => new sfValidatorDoctrineChoice(array('model' => 'Usuario', 'required' => false)),
      'ca_coordinador'  => new sfValidatorString(array('required' => false)),
      'ca_direccion'    => new sfValidatorString(array('required' => false)),
      'ca_torre'        => new sfValidatorString(array('required' => false)),
      'ca_bloque'       => new sfValidatorString(array('required' => false)),
      'ca_interior'     => new sfValidatorString(array('required' => false)),
      'ca_localidad'    => new sfValidatorString(array('required' => false)),
      'ca_complemento'  => new sfValidatorString(array('required' => false)),
      'ca_telefonos'    => new sfValidatorString(array('required' => false)),
      'ca_fax'          => new sfValidatorString(array('required' => false)),
      'ca_preferencias' => new sfValidatorString(array('required' => false)),
      'ca_confirmar'    => new sfValidatorString(array('required' => false)),
      'ca_idciudad'     => new sfValidatorDoctrineChoice(array('model' => 'Ciudad', 'required' => false)),
      'ca_idgrupo'      => new sfValidatorString(array('required' => false)),
      'ca_listaclinton' => new sfValidatorString(array('required' => false)),
      'ca_fchcircular'  => new sfValidatorDate(array('required' => false)),
      'ca_status'       => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cliente[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Cliente';
  }

}
