<?php

/**
 * Cliente form base class.
 *
 * @package    form
 * @subpackage cliente
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseClienteForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idcliente'    => new sfWidgetFormInputHidden(),
      'ca_digito'       => new sfWidgetFormInput(),
      'ca_compania'     => new sfWidgetFormInput(),
      'ca_papellido'    => new sfWidgetFormInput(),
      'ca_sapellido'    => new sfWidgetFormInput(),
      'ca_nombres'      => new sfWidgetFormInput(),
      'ca_saludo'       => new sfWidgetFormInput(),
      'ca_sexo'         => new sfWidgetFormInput(),
      'ca_cumpleanos'   => new sfWidgetFormInput(),
      'ca_oficina'      => new sfWidgetFormInput(),
      'ca_email'        => new sfWidgetFormInput(),
      'ca_vendedor'     => new sfWidgetFormDoctrineSelect(array('model' => 'Usuario', 'add_empty' => true)),
      'ca_coordinador'  => new sfWidgetFormInput(),
      'ca_direccion'    => new sfWidgetFormInput(),
      'ca_torre'        => new sfWidgetFormInput(),
      'ca_bloque'       => new sfWidgetFormInput(),
      'ca_interior'     => new sfWidgetFormInput(),
      'ca_localidad'    => new sfWidgetFormInput(),
      'ca_complemento'  => new sfWidgetFormInput(),
      'ca_telefonos'    => new sfWidgetFormInput(),
      'ca_fax'          => new sfWidgetFormInput(),
      'ca_preferencias' => new sfWidgetFormInput(),
      'ca_confirmar'    => new sfWidgetFormInput(),
      'ca_idciudad'     => new sfWidgetFormDoctrineSelect(array('model' => 'Ciudad', 'add_empty' => true)),
      'ca_idgrupo'      => new sfWidgetFormInput(),
      'ca_listaclinton' => new sfWidgetFormInput(),
      'ca_fchcircular'  => new sfWidgetFormDate(),
      'ca_status'       => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idcliente'    => new sfValidatorDoctrineChoice(array('model' => 'Cliente', 'column' => 'ca_idcliente', 'required' => false)),
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

    parent::setup();
  }

  public function getModelName()
  {
    return 'Cliente';
  }

}