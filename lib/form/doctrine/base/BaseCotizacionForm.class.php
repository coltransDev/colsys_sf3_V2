<?php

/**
 * Cotizacion form base class.
 *
 * @package    form
 * @subpackage cotizacion
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseCotizacionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idcotizacion'       => new sfWidgetFormInputHidden(),
      'ca_idcontacto'         => new sfWidgetFormDoctrineSelect(array('model' => 'Contacto', 'add_empty' => true)),
      'ca_consecutivo'        => new sfWidgetFormInput(),
      'ca_saludo'             => new sfWidgetFormInput(),
      'ca_asunto'             => new sfWidgetFormInput(),
      'ca_entrada'            => new sfWidgetFormInput(),
      'ca_despedida'          => new sfWidgetFormInput(),
      'ca_anexos'             => new sfWidgetFormInput(),
      'ca_usuario'            => new sfWidgetFormDoctrineSelect(array('model' => 'Usuario', 'add_empty' => true)),
      'ca_empresa'            => new sfWidgetFormInput(),
      'ca_fuente'             => new sfWidgetFormInput(),
      'ca_idg_envio_oportuno' => new sfWidgetFormDoctrineSelect(array('model' => 'NotTarea', 'add_empty' => true)),
      'ca_usucreado'          => new sfWidgetFormInput(),
      'ca_fchcreado'          => new sfWidgetFormDateTime(),
      'ca_usuactualizado'     => new sfWidgetFormInput(),
      'ca_fchactualizado'     => new sfWidgetFormDateTime(),
      'ca_usuanulado'         => new sfWidgetFormInput(),
      'ca_fchanulado'         => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'ca_idcotizacion'       => new sfValidatorDoctrineChoice(array('model' => 'Cotizacion', 'column' => 'ca_idcotizacion', 'required' => false)),
      'ca_idcontacto'         => new sfValidatorDoctrineChoice(array('model' => 'Contacto', 'required' => false)),
      'ca_consecutivo'        => new sfValidatorString(array('required' => false)),
      'ca_saludo'             => new sfValidatorString(array('required' => false)),
      'ca_asunto'             => new sfValidatorString(array('required' => false)),
      'ca_entrada'            => new sfValidatorString(array('required' => false)),
      'ca_despedida'          => new sfValidatorString(array('required' => false)),
      'ca_anexos'             => new sfValidatorString(array('required' => false)),
      'ca_usuario'            => new sfValidatorDoctrineChoice(array('model' => 'Usuario', 'required' => false)),
      'ca_empresa'            => new sfValidatorString(array('required' => false)),
      'ca_fuente'             => new sfValidatorString(array('required' => false)),
      'ca_idg_envio_oportuno' => new sfValidatorDoctrineChoice(array('model' => 'NotTarea', 'required' => false)),
      'ca_usucreado'          => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'ca_fchcreado'          => new sfValidatorDateTime(array('required' => false)),
      'ca_usuactualizado'     => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'ca_fchactualizado'     => new sfValidatorDateTime(array('required' => false)),
      'ca_usuanulado'         => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'ca_fchanulado'         => new sfValidatorDateTime(array('required' => false)),
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