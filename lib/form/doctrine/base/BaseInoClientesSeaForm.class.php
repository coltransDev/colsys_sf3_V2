<?php

/**
 * InoClientesSea form base class.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseInoClientesSeaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_referencia'        => new sfWidgetFormInputHidden(),
      'ca_idcliente'         => new sfWidgetFormInputHidden(),
      'ca_hbls'              => new sfWidgetFormInputHidden(),
      'oid'                  => new sfWidgetFormInputText(),
      'ca_idreporte'         => new sfWidgetFormDoctrineChoice(array('model' => 'Reporte', 'add_empty' => true)),
      'ca_idproveedor'       => new sfWidgetFormDoctrineChoice(array('model' => 'Tercero', 'add_empty' => true)),
      'ca_proveedor'         => new sfWidgetFormTextarea(),
      'ca_numpiezas'         => new sfWidgetFormInputText(),
      'ca_peso'              => new sfWidgetFormInputText(),
      'ca_volumen'           => new sfWidgetFormInputText(),
      'ca_numorden'          => new sfWidgetFormInputText(),
      'ca_confirmar'         => new sfWidgetFormTextarea(),
      'ca_login'             => new sfWidgetFormTextarea(),
      'ca_observaciones'     => new sfWidgetFormTextarea(),
      'ca_fchliberacion'     => new sfWidgetFormDate(),
      'ca_notaliberacion'    => new sfWidgetFormTextarea(),
      'ca_mensaje'           => new sfWidgetFormTextarea(),
      'ca_continuacion'      => new sfWidgetFormTextarea(),
      'ca_continuacion_dest' => new sfWidgetFormDoctrineChoice(array('model' => 'Ciudad', 'add_empty' => true)),
      'ca_idbodega'          => new sfWidgetFormInputText(),
      'ca_fchcreado'         => new sfWidgetFormDateTime(),
      'ca_usucreado'         => new sfWidgetFormTextarea(),
      'ca_fchactualizado'    => new sfWidgetFormDateTime(),
      'ca_usuactualizado'    => new sfWidgetFormTextarea(),
      'ca_fchliberado'       => new sfWidgetFormDateTime(),
      'ca_usuliberado'       => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'ca_referencia'        => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_referencia', 'required' => false)),
      'ca_idcliente'         => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idcliente', 'required' => false)),
      'ca_hbls'              => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_hbls', 'required' => false)),
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

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'InoClientesSea';
  }

}
