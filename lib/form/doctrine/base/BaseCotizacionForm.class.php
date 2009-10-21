<?php

/**
 * Cotizacion form base class.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseCotizacionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idcotizacion'       => new sfWidgetFormInputHidden(),
      'ca_idcontacto'         => new sfWidgetFormDoctrineChoice(array('model' => 'Contacto', 'add_empty' => true)),
      'ca_consecutivo'        => new sfWidgetFormTextarea(),
      'ca_saludo'             => new sfWidgetFormTextarea(),
      'ca_asunto'             => new sfWidgetFormTextarea(),
      'ca_entrada'            => new sfWidgetFormTextarea(),
      'ca_despedida'          => new sfWidgetFormTextarea(),
      'ca_anexos'             => new sfWidgetFormTextarea(),
      'ca_usuario'            => new sfWidgetFormDoctrineChoice(array('model' => 'Usuario', 'add_empty' => true)),
      'ca_empresa'            => new sfWidgetFormTextarea(),
      'ca_fuente'             => new sfWidgetFormTextarea(),
      'ca_idg_envio_oportuno' => new sfWidgetFormDoctrineChoice(array('model' => 'NotTarea', 'add_empty' => true)),
      'ca_usucreado'          => new sfWidgetFormInputText(),
      'ca_fchcreado'          => new sfWidgetFormDateTime(),
      'ca_usuactualizado'     => new sfWidgetFormInputText(),
      'ca_fchactualizado'     => new sfWidgetFormDateTime(),
      'ca_usuanulado'         => new sfWidgetFormInputText(),
      'ca_fchanulado'         => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'ca_idcotizacion'       => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idcotizacion', 'required' => false)),
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

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Cotizacion';
  }

}
