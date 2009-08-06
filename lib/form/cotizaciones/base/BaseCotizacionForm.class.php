<?php

/**
 * Cotizacion form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseCotizacionForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idcotizacion'       => new sfWidgetFormInputHidden(),
      'ca_idcontacto'         => new sfWidgetFormPropelChoice(array('model' => 'Contacto', 'add_empty' => false)),
      'ca_consecutivo'        => new sfWidgetFormInput(),
      'ca_asunto'             => new sfWidgetFormInput(),
      'ca_saludo'             => new sfWidgetFormInput(),
      'ca_entrada'            => new sfWidgetFormInput(),
      'ca_despedida'          => new sfWidgetFormInput(),
      'ca_usuario'            => new sfWidgetFormPropelChoice(array('model' => 'Usuario', 'add_empty' => true)),
      'ca_anexos'             => new sfWidgetFormInput(),
      'ca_fchcreado'          => new sfWidgetFormDateTime(),
      'ca_usucreado'          => new sfWidgetFormInput(),
      'ca_fchactualizado'     => new sfWidgetFormDateTime(),
      'ca_usuactualizado'     => new sfWidgetFormInput(),
      'ca_fchsolicitud'       => new sfWidgetFormDate(),
      'ca_horasolicitud'      => new sfWidgetFormTime(),
      'ca_fchpresentacion'    => new sfWidgetFormDateTime(),
      'ca_fchanulado'         => new sfWidgetFormDateTime(),
      'ca_usuanulado'         => new sfWidgetFormInput(),
      'ca_empresa'            => new sfWidgetFormInput(),
      'ca_datosag'            => new sfWidgetFormInput(),
      'ca_fuente'             => new sfWidgetFormInput(),
      'ca_idg_envio_oportuno' => new sfWidgetFormPropelChoice(array('model' => 'NotTarea', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'ca_idcotizacion'       => new sfValidatorPropelChoice(array('model' => 'Cotizacion', 'column' => 'ca_idcotizacion', 'required' => false)),
      'ca_idcontacto'         => new sfValidatorPropelChoice(array('model' => 'Contacto', 'column' => 'ca_idcontacto')),
      'ca_consecutivo'        => new sfValidatorString(array('required' => false)),
      'ca_asunto'             => new sfValidatorString(array('required' => false)),
      'ca_saludo'             => new sfValidatorString(array('required' => false)),
      'ca_entrada'            => new sfValidatorString(array('required' => false)),
      'ca_despedida'          => new sfValidatorString(array('required' => false)),
      'ca_usuario'            => new sfValidatorPropelChoice(array('model' => 'Usuario', 'column' => 'ca_login', 'required' => false)),
      'ca_anexos'             => new sfValidatorString(array('required' => false)),
      'ca_fchcreado'          => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'          => new sfValidatorString(array('required' => false)),
      'ca_fchactualizado'     => new sfValidatorDateTime(array('required' => false)),
      'ca_usuactualizado'     => new sfValidatorString(array('required' => false)),
      'ca_fchsolicitud'       => new sfValidatorDate(array('required' => false)),
      'ca_horasolicitud'      => new sfValidatorTime(array('required' => false)),
      'ca_fchpresentacion'    => new sfValidatorDateTime(array('required' => false)),
      'ca_fchanulado'         => new sfValidatorDateTime(array('required' => false)),
      'ca_usuanulado'         => new sfValidatorString(array('required' => false)),
      'ca_empresa'            => new sfValidatorString(array('required' => false)),
      'ca_datosag'            => new sfValidatorString(array('required' => false)),
      'ca_fuente'             => new sfValidatorString(array('required' => false)),
      'ca_idg_envio_oportuno' => new sfValidatorPropelChoice(array('model' => 'NotTarea', 'column' => 'ca_idtarea', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cotizacion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Cotizacion';
  }


}
