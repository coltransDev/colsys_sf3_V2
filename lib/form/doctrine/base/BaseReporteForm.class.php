<?php

/**
 * Reporte form base class.
 *
 * @package    form
 * @subpackage reporte
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseReporteForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idreporte'         => new sfWidgetFormInputHidden(),
      'ca_fchreporte'        => new sfWidgetFormDate(),
      'ca_consecutivo'       => new sfWidgetFormInput(),
      'ca_version'           => new sfWidgetFormInput(),
      'ca_idcotizacion'      => new sfWidgetFormInput(),
      'ca_origen'            => new sfWidgetFormDoctrineSelect(array('model' => 'Ciudad', 'add_empty' => true)),
      'ca_destino'           => new sfWidgetFormDoctrineSelect(array('model' => 'Ciudad', 'add_empty' => true)),
      'ca_impoexpo'          => new sfWidgetFormInput(),
      'ca_fchdespacho'       => new sfWidgetFormDate(),
      'ca_idagente'          => new sfWidgetFormDoctrineSelect(array('model' => 'IdsAgente', 'add_empty' => true)),
      'ca_incoterms'         => new sfWidgetFormInput(),
      'ca_mercancia_desc'    => new sfWidgetFormInput(),
      'ca_idproveedor'       => new sfWidgetFormDoctrineSelect(array('model' => 'Tercero', 'add_empty' => true)),
      'ca_orden_prov'        => new sfWidgetFormInput(),
      'ca_idconcliente'      => new sfWidgetFormDoctrineSelect(array('model' => 'Contacto', 'add_empty' => true)),
      'ca_orden_clie'        => new sfWidgetFormInput(),
      'ca_confirmar_clie'    => new sfWidgetFormInput(),
      'ca_idrepresentante'   => new sfWidgetFormInput(),
      'ca_informar_repr'     => new sfWidgetFormInput(),
      'ca_idconsignatario'   => new sfWidgetFormInput(),
      'ca_informar_cons'     => new sfWidgetFormInput(),
      'ca_idnotify'          => new sfWidgetFormInput(),
      'ca_informar_noti'     => new sfWidgetFormInput(),
      'ca_idmaster'          => new sfWidgetFormInput(),
      'ca_informar_mast'     => new sfWidgetFormInput(),
      'ca_notify'            => new sfWidgetFormInput(),
      'ca_transporte'        => new sfWidgetFormInput(),
      'ca_modalidad'         => new sfWidgetFormInput(),
      'ca_seguro'            => new sfWidgetFormInput(),
      'ca_liberacion'        => new sfWidgetFormInput(),
      'ca_tiempocredito'     => new sfWidgetFormInput(),
      'ca_preferencias_clie' => new sfWidgetFormInput(),
      'ca_instrucciones'     => new sfWidgetFormInput(),
      'ca_idlinea'           => new sfWidgetFormDoctrineSelect(array('model' => 'IdsProveedor', 'add_empty' => true)),
      'ca_idconsignar'       => new sfWidgetFormInput(),
      'ca_idconsignarmaster' => new sfWidgetFormInput(),
      'ca_idbodega'          => new sfWidgetFormDoctrineSelect(array('model' => 'Bodega', 'add_empty' => true)),
      'ca_mastersame'        => new sfWidgetFormInput(),
      'ca_continuacion'      => new sfWidgetFormInput(),
      'ca_continuacion_dest' => new sfWidgetFormDoctrineSelect(array('model' => 'Ciudad', 'add_empty' => true)),
      'ca_continuacion_conf' => new sfWidgetFormInput(),
      'ca_etapa_actual'      => new sfWidgetFormInput(),
      'ca_login'             => new sfWidgetFormDoctrineSelect(array('model' => 'Usuario', 'add_empty' => true)),
      'ca_colmas'            => new sfWidgetFormInput(),
      'ca_propiedades'       => new sfWidgetFormInput(),
      'ca_idetapa'           => new sfWidgetFormDoctrineSelect(array('model' => 'TrackingEtapa', 'add_empty' => true)),
      'ca_fchultstatus'      => new sfWidgetFormDateTime(),
      'ca_idtarea_rext'      => new sfWidgetFormInput(),
      'ca_idseguimiento'     => new sfWidgetFormDoctrineSelect(array('model' => 'NotTarea', 'add_empty' => true)),
      'ca_fchcreado'         => new sfWidgetFormDateTime(),
      'ca_usucreado'         => new sfWidgetFormInput(),
      'ca_fchactualizado'    => new sfWidgetFormDateTime(),
      'ca_usuactualizado'    => new sfWidgetFormInput(),
      'ca_fchanulado'        => new sfWidgetFormDateTime(),
      'ca_usuanulado'        => new sfWidgetFormInput(),
      'ca_fchcerrado'        => new sfWidgetFormDateTime(),
      'ca_usucerrado'        => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idreporte'         => new sfValidatorDoctrineChoice(array('model' => 'Reporte', 'column' => 'ca_idreporte', 'required' => false)),
      'ca_fchreporte'        => new sfValidatorDate(array('required' => false)),
      'ca_consecutivo'       => new sfValidatorString(array('required' => false)),
      'ca_version'           => new sfValidatorInteger(array('required' => false)),
      'ca_idcotizacion'      => new sfValidatorInteger(array('required' => false)),
      'ca_origen'            => new sfValidatorDoctrineChoice(array('model' => 'Ciudad', 'required' => false)),
      'ca_destino'           => new sfValidatorDoctrineChoice(array('model' => 'Ciudad', 'required' => false)),
      'ca_impoexpo'          => new sfValidatorString(array('required' => false)),
      'ca_fchdespacho'       => new sfValidatorDate(array('required' => false)),
      'ca_idagente'          => new sfValidatorDoctrineChoice(array('model' => 'IdsAgente', 'required' => false)),
      'ca_incoterms'         => new sfValidatorString(array('required' => false)),
      'ca_mercancia_desc'    => new sfValidatorString(array('required' => false)),
      'ca_idproveedor'       => new sfValidatorDoctrineChoice(array('model' => 'Tercero', 'required' => false)),
      'ca_orden_prov'        => new sfValidatorString(array('required' => false)),
      'ca_idconcliente'      => new sfValidatorDoctrineChoice(array('model' => 'Contacto', 'required' => false)),
      'ca_orden_clie'        => new sfValidatorString(array('required' => false)),
      'ca_confirmar_clie'    => new sfValidatorString(array('required' => false)),
      'ca_idrepresentante'   => new sfValidatorInteger(array('required' => false)),
      'ca_informar_repr'     => new sfValidatorString(array('required' => false)),
      'ca_idconsignatario'   => new sfValidatorInteger(array('required' => false)),
      'ca_informar_cons'     => new sfValidatorString(array('required' => false)),
      'ca_idnotify'          => new sfValidatorInteger(array('required' => false)),
      'ca_informar_noti'     => new sfValidatorString(array('required' => false)),
      'ca_idmaster'          => new sfValidatorInteger(array('required' => false)),
      'ca_informar_mast'     => new sfValidatorString(array('required' => false)),
      'ca_notify'            => new sfValidatorInteger(array('required' => false)),
      'ca_transporte'        => new sfValidatorString(array('required' => false)),
      'ca_modalidad'         => new sfValidatorString(array('required' => false)),
      'ca_seguro'            => new sfValidatorString(array('required' => false)),
      'ca_liberacion'        => new sfValidatorString(array('required' => false)),
      'ca_tiempocredito'     => new sfValidatorString(array('required' => false)),
      'ca_preferencias_clie' => new sfValidatorString(array('required' => false)),
      'ca_instrucciones'     => new sfValidatorString(array('required' => false)),
      'ca_idlinea'           => new sfValidatorDoctrineChoice(array('model' => 'IdsProveedor', 'required' => false)),
      'ca_idconsignar'       => new sfValidatorInteger(array('required' => false)),
      'ca_idconsignarmaster' => new sfValidatorInteger(array('required' => false)),
      'ca_idbodega'          => new sfValidatorDoctrineChoice(array('model' => 'Bodega', 'required' => false)),
      'ca_mastersame'        => new sfValidatorString(array('required' => false)),
      'ca_continuacion'      => new sfValidatorString(array('required' => false)),
      'ca_continuacion_dest' => new sfValidatorDoctrineChoice(array('model' => 'Ciudad', 'required' => false)),
      'ca_continuacion_conf' => new sfValidatorString(array('required' => false)),
      'ca_etapa_actual'      => new sfValidatorString(array('required' => false)),
      'ca_login'             => new sfValidatorDoctrineChoice(array('model' => 'Usuario', 'required' => false)),
      'ca_colmas'            => new sfValidatorString(array('required' => false)),
      'ca_propiedades'       => new sfValidatorString(array('required' => false)),
      'ca_idetapa'           => new sfValidatorDoctrineChoice(array('model' => 'TrackingEtapa', 'required' => false)),
      'ca_fchultstatus'      => new sfValidatorDateTime(array('required' => false)),
      'ca_idtarea_rext'      => new sfValidatorInteger(array('required' => false)),
      'ca_idseguimiento'     => new sfValidatorDoctrineChoice(array('model' => 'NotTarea', 'required' => false)),
      'ca_fchcreado'         => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'         => new sfValidatorString(array('required' => false)),
      'ca_fchactualizado'    => new sfValidatorDateTime(array('required' => false)),
      'ca_usuactualizado'    => new sfValidatorString(array('required' => false)),
      'ca_fchanulado'        => new sfValidatorDateTime(array('required' => false)),
      'ca_usuanulado'        => new sfValidatorString(array('required' => false)),
      'ca_fchcerrado'        => new sfValidatorDateTime(array('required' => false)),
      'ca_usucerrado'        => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('reporte[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Reporte';
  }

}