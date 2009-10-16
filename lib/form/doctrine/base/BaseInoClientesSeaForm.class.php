<?php

/**
 * InoClientesSea form base class.
 *
 * @package    form
 * @subpackage ino_clientes_sea
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseInoClientesSeaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_referencia'        => new sfWidgetFormInputHidden(),
      'ca_idcliente'         => new sfWidgetFormInputHidden(),
      'ca_hbls'              => new sfWidgetFormInputHidden(),
      'oid'                  => new sfWidgetFormInput(),
      'ca_idreporte'         => new sfWidgetFormDoctrineSelect(array('model' => 'Reporte', 'add_empty' => true)),
      'ca_idproveedor'       => new sfWidgetFormDoctrineSelect(array('model' => 'Tercero', 'add_empty' => true)),
      'ca_proveedor'         => new sfWidgetFormInput(),
      'ca_numpiezas'         => new sfWidgetFormInput(),
      'ca_peso'              => new sfWidgetFormInput(),
      'ca_volumen'           => new sfWidgetFormInput(),
      'ca_numorden'          => new sfWidgetFormInput(),
      'ca_confirmar'         => new sfWidgetFormInput(),
      'ca_login'             => new sfWidgetFormInput(),
      'ca_observaciones'     => new sfWidgetFormInput(),
      'ca_fchliberacion'     => new sfWidgetFormDate(),
      'ca_notaliberacion'    => new sfWidgetFormInput(),
      'ca_mensaje'           => new sfWidgetFormInput(),
      'ca_continuacion'      => new sfWidgetFormInput(),
      'ca_continuacion_dest' => new sfWidgetFormDoctrineSelect(array('model' => 'Ciudad', 'add_empty' => true)),
      'ca_idbodega'          => new sfWidgetFormInput(),
      'ca_fchcreado'         => new sfWidgetFormDateTime(),
      'ca_usucreado'         => new sfWidgetFormInput(),
      'ca_fchactualizado'    => new sfWidgetFormDateTime(),
      'ca_usuactualizado'    => new sfWidgetFormInput(),
      'ca_fchliberado'       => new sfWidgetFormDateTime(),
      'ca_usuliberado'       => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_referencia'        => new sfValidatorDoctrineChoice(array('model' => 'InoClientesSea', 'column' => 'ca_referencia', 'required' => false)),
      'ca_idcliente'         => new sfValidatorDoctrineChoice(array('model' => 'InoClientesSea', 'column' => 'ca_idcliente', 'required' => false)),
      'ca_hbls'              => new sfValidatorDoctrineChoice(array('model' => 'InoClientesSea', 'column' => 'ca_hbls', 'required' => false)),
      'oid'                  => new sfValidatorInteger(array('required' => false)),
      'ca_idreporte'         => new sfValidatorDoctrineChoice(array('model' => 'Reporte', 'required' => false)),
      'ca_idproveedor'       => new sfValidatorDoctrineChoice(array('model' => 'Tercero', 'required' => false)),
      'ca_proveedor'         => new sfValidatorString(array('required' => false)),
      'ca_numpiezas'         => new sfValidatorNumber(array('required' => false)),
      'ca_peso'              => new sfValidatorNumber(array('required' => false)),
      'ca_volumen'           => new sfValidatorNumber(array('required' => false)),
      'ca_numorden'          => new sfValidatorNumber(array('required' => false)),
      'ca_confirmar'         => new sfValidatorString(array('required' => false)),
      'ca_login'             => new sfValidatorString(array('required' => false)),
      'ca_observaciones'     => new sfValidatorString(array('required' => false)),
      'ca_fchliberacion'     => new sfValidatorDate(array('required' => false)),
      'ca_notaliberacion'    => new sfValidatorString(array('required' => false)),
      'ca_mensaje'           => new sfValidatorString(array('required' => false)),
      'ca_continuacion'      => new sfValidatorString(array('required' => false)),
      'ca_continuacion_dest' => new sfValidatorDoctrineChoice(array('model' => 'Ciudad', 'required' => false)),
      'ca_idbodega'          => new sfValidatorInteger(array('required' => false)),
      'ca_fchcreado'         => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'         => new sfValidatorString(array('required' => false)),
      'ca_fchactualizado'    => new sfValidatorDateTime(array('required' => false)),
      'ca_usuactualizado'    => new sfValidatorString(array('required' => false)),
      'ca_fchliberado'       => new sfValidatorDateTime(array('required' => false)),
      'ca_usuliberado'       => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ino_clientes_sea[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'InoClientesSea';
  }

}