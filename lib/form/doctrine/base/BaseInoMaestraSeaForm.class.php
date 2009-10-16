<?php

/**
 * InoMaestraSea form base class.
 *
 * @package    form
 * @subpackage ino_maestra_sea
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseInoMaestraSeaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_referencia'          => new sfWidgetFormInputHidden(),
      'ca_fchreferencia'       => new sfWidgetFormDate(),
      'ca_impoexpo'            => new sfWidgetFormInput(),
      'ca_origen'              => new sfWidgetFormDoctrineSelect(array('model' => 'Ciudad', 'add_empty' => true)),
      'ca_destino'             => new sfWidgetFormDoctrineSelect(array('model' => 'Ciudad', 'add_empty' => true)),
      'ca_fchembarque'         => new sfWidgetFormDate(),
      'ca_fcharribo'           => new sfWidgetFormDate(),
      'ca_modalidad'           => new sfWidgetFormInput(),
      'ca_idlinea'             => new sfWidgetFormDoctrineSelect(array('model' => 'IdsProveedor', 'add_empty' => true)),
      'ca_motonave'            => new sfWidgetFormInput(),
      'ca_ciclo'               => new sfWidgetFormInput(),
      'ca_mbls'                => new sfWidgetFormInput(),
      'ca_observaciones'       => new sfWidgetFormInput(),
      'ca_fchconfirmacion'     => new sfWidgetFormDate(),
      'ca_horaconfirmacion'    => new sfWidgetFormTime(),
      'ca_registroadu'         => new sfWidgetFormInput(),
      'ca_registrocap'         => new sfWidgetFormInput(),
      'ca_bandera'             => new sfWidgetFormInput(),
      'ca_fchliberacion'       => new sfWidgetFormDate(),
      'ca_nroliberacion'       => new sfWidgetFormInput(),
      'ca_anulado'             => new sfWidgetFormInput(),
      'ca_mensaje'             => new sfWidgetFormInput(),
      'ca_fchdesconsolidacion' => new sfWidgetFormDate(),
      'ca_mnllegada'           => new sfWidgetFormInput(),
      'ca_fchregistroadu'      => new sfWidgetFormDate(),
      'ca_asunto_otm'          => new sfWidgetFormInput(),
      'ca_mensaje_otm'         => new sfWidgetFormInput(),
      'ca_fchllegada_otm'      => new sfWidgetFormDate(),
      'ca_ciudad_otm'          => new sfWidgetFormInput(),
      'ca_provisional'         => new sfWidgetFormInputCheckbox(),
      'ca_sitiodevolucion'     => new sfWidgetFormInput(),
      'ca_fchcreado'           => new sfWidgetFormDateTime(),
      'ca_usucreado'           => new sfWidgetFormInput(),
      'ca_fchactualizado'      => new sfWidgetFormDateTime(),
      'ca_usuactualizado'      => new sfWidgetFormInput(),
      'ca_fchliquidado'        => new sfWidgetFormDateTime(),
      'ca_usuliquidado'        => new sfWidgetFormInput(),
      'ca_fchcerrado'          => new sfWidgetFormDateTime(),
      'ca_usucerrado'          => new sfWidgetFormInput(),
      'ca_fchconfirmado'       => new sfWidgetFormDateTime(),
      'ca_usuconfirmado'       => new sfWidgetFormInput(),
      'ca_fchconfirma_otm'     => new sfWidgetFormDateTime(),
      'ca_usuconfirma_otm'     => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_referencia'          => new sfValidatorDoctrineChoice(array('model' => 'InoMaestraSea', 'column' => 'ca_referencia', 'required' => false)),
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

    parent::setup();
  }

  public function getModelName()
  {
    return 'InoMaestraSea';
  }

}