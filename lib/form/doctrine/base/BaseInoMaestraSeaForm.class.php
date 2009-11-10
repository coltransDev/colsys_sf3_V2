<?php

/**
 * InoMaestraSea form base class.
 *
 * @method InoMaestraSea getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseInoMaestraSeaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_referencia'          => new sfWidgetFormInputHidden(),
      'ca_fchreferencia'       => new sfWidgetFormDate(),
      'ca_impoexpo'            => new sfWidgetFormTextarea(),
      'ca_origen'              => new sfWidgetFormDoctrineChoice(array('model' => 'Ciudad', 'add_empty' => true)),
      'ca_destino'             => new sfWidgetFormDoctrineChoice(array('model' => 'Ciudad', 'add_empty' => true)),
      'ca_fchembarque'         => new sfWidgetFormDate(),
      'ca_fcharribo'           => new sfWidgetFormDate(),
      'ca_modalidad'           => new sfWidgetFormTextarea(),
      'ca_idlinea'             => new sfWidgetFormDoctrineChoice(array('model' => 'IdsProveedor', 'add_empty' => true)),
      'ca_motonave'            => new sfWidgetFormTextarea(),
      'ca_ciclo'               => new sfWidgetFormTextarea(),
      'ca_mbls'                => new sfWidgetFormTextarea(),
      'ca_observaciones'       => new sfWidgetFormTextarea(),
      'ca_fchconfirmacion'     => new sfWidgetFormDate(),
      'ca_horaconfirmacion'    => new sfWidgetFormTime(),
      'ca_registroadu'         => new sfWidgetFormTextarea(),
      'ca_registrocap'         => new sfWidgetFormTextarea(),
      'ca_bandera'             => new sfWidgetFormTextarea(),
      'ca_fchliberacion'       => new sfWidgetFormDate(),
      'ca_nroliberacion'       => new sfWidgetFormTextarea(),
      'ca_anulado'             => new sfWidgetFormTextarea(),
      'ca_mensaje'             => new sfWidgetFormTextarea(),
      'ca_fchdesconsolidacion' => new sfWidgetFormDate(),
      'ca_mnllegada'           => new sfWidgetFormTextarea(),
      'ca_fchregistroadu'      => new sfWidgetFormDate(),
      'ca_asunto_otm'          => new sfWidgetFormTextarea(),
      'ca_mensaje_otm'         => new sfWidgetFormTextarea(),
      'ca_fchllegada_otm'      => new sfWidgetFormDate(),
      'ca_ciudad_otm'          => new sfWidgetFormTextarea(),
      'ca_provisional'         => new sfWidgetFormInputCheckbox(),
      'ca_sitiodevolucion'     => new sfWidgetFormTextarea(),
      'ca_fchcreado'           => new sfWidgetFormDateTime(),
      'ca_usucreado'           => new sfWidgetFormTextarea(),
      'ca_fchactualizado'      => new sfWidgetFormDateTime(),
      'ca_usuactualizado'      => new sfWidgetFormTextarea(),
      'ca_fchliquidado'        => new sfWidgetFormDateTime(),
      'ca_usuliquidado'        => new sfWidgetFormTextarea(),
      'ca_fchcerrado'          => new sfWidgetFormDateTime(),
      'ca_usucerrado'          => new sfWidgetFormTextarea(),
      'ca_fchconfirmado'       => new sfWidgetFormDateTime(),
      'ca_usuconfirmado'       => new sfWidgetFormTextarea(),
      'ca_fchconfirma_otm'     => new sfWidgetFormDateTime(),
      'ca_usuconfirma_otm'     => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'ca_referencia'          => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_referencia', 'required' => false)),
      'ca_fchreferencia'       => new sfValidatorDate(array('required' => false)),
      'ca_impoexpo'            => new sfValidatorString(array('required' => false)),
      'ca_origen'              => new sfValidatorDoctrineChoice(array('model' => 'Ciudad', 'required' => false)),
      'ca_destino'             => new sfValidatorDoctrineChoice(array('model' => 'Ciudad', 'required' => false)),
      'ca_fchembarque'         => new sfValidatorDate(array('required' => false)),
      'ca_fcharribo'           => new sfValidatorDate(array('required' => false)),
      'ca_modalidad'           => new sfValidatorString(array('required' => false)),
      'ca_idlinea'             => new sfValidatorDoctrineChoice(array('model' => 'IdsProveedor', 'required' => false)),
      'ca_motonave'            => new sfValidatorString(array('required' => false)),
      'ca_ciclo'               => new sfValidatorString(array('required' => false)),
      'ca_mbls'                => new sfValidatorString(array('required' => false)),
      'ca_observaciones'       => new sfValidatorString(array('required' => false)),
      'ca_fchconfirmacion'     => new sfValidatorDate(array('required' => false)),
      'ca_horaconfirmacion'    => new sfValidatorTime(array('required' => false)),
      'ca_registroadu'         => new sfValidatorString(array('required' => false)),
      'ca_registrocap'         => new sfValidatorString(array('required' => false)),
      'ca_bandera'             => new sfValidatorString(array('required' => false)),
      'ca_fchliberacion'       => new sfValidatorDate(array('required' => false)),
      'ca_nroliberacion'       => new sfValidatorString(array('required' => false)),
      'ca_anulado'             => new sfValidatorString(array('required' => false)),
      'ca_mensaje'             => new sfValidatorString(array('required' => false)),
      'ca_fchdesconsolidacion' => new sfValidatorDate(array('required' => false)),
      'ca_mnllegada'           => new sfValidatorString(array('required' => false)),
      'ca_fchregistroadu'      => new sfValidatorDate(array('required' => false)),
      'ca_asunto_otm'          => new sfValidatorString(array('required' => false)),
      'ca_mensaje_otm'         => new sfValidatorString(array('required' => false)),
      'ca_fchllegada_otm'      => new sfValidatorDate(array('required' => false)),
      'ca_ciudad_otm'          => new sfValidatorString(array('required' => false)),
      'ca_provisional'         => new sfValidatorBoolean(array('required' => false)),
      'ca_sitiodevolucion'     => new sfValidatorString(array('required' => false)),
      'ca_fchcreado'           => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'           => new sfValidatorString(array('required' => false)),
      'ca_fchactualizado'      => new sfValidatorDateTime(array('required' => false)),
      'ca_usuactualizado'      => new sfValidatorString(array('required' => false)),
      'ca_fchliquidado'        => new sfValidatorDateTime(array('required' => false)),
      'ca_usuliquidado'        => new sfValidatorString(array('required' => false)),
      'ca_fchcerrado'          => new sfValidatorDateTime(array('required' => false)),
      'ca_usucerrado'          => new sfValidatorString(array('required' => false)),
      'ca_fchconfirmado'       => new sfValidatorDateTime(array('required' => false)),
      'ca_usuconfirmado'       => new sfValidatorString(array('required' => false)),
      'ca_fchconfirma_otm'     => new sfValidatorDateTime(array('required' => false)),
      'ca_usuconfirma_otm'     => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ino_maestra_sea[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'InoMaestraSea';
  }

}
