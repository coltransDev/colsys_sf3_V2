<?php

/**
 * Reporte form base class.
 *
 * @method Reporte getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseReporteForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idreporte'         => new sfWidgetFormInputHidden(),
      'ca_fchreporte'        => new sfWidgetFormDate(),
      'ca_consecutivo'       => new sfWidgetFormTextarea(),
      'ca_version'           => new sfWidgetFormInputText(),
      'ca_idcotizacion'      => new sfWidgetFormTextarea(),
      'ca_idproducto'        => new sfWidgetFormInputText(),
      'ca_origen'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Origen'), 'add_empty' => true)),
      'ca_destino'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Destino'), 'add_empty' => true)),
      'ca_impoexpo'          => new sfWidgetFormTextarea(),
      'ca_fchdespacho'       => new sfWidgetFormDate(),
      'ca_idagente'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('IdsAgente'), 'add_empty' => true)),
      'ca_incoterms'         => new sfWidgetFormTextarea(),
      'ca_mercancia_desc'    => new sfWidgetFormTextarea(),
      'ca_idproveedor'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Proveedor'), 'add_empty' => true)),
      'ca_orden_prov'        => new sfWidgetFormTextarea(),
      'ca_idconcliente'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Contacto'), 'add_empty' => false)),
      'ca_orden_clie'        => new sfWidgetFormTextarea(),
      'ca_confirmar_clie'    => new sfWidgetFormTextarea(),
      'ca_idrepresentante'   => new sfWidgetFormInputText(),
      'ca_informar_repr'     => new sfWidgetFormTextarea(),
      'ca_idconsignatario'   => new sfWidgetFormInputText(),
      'ca_informar_cons'     => new sfWidgetFormTextarea(),
      'ca_idnotify'          => new sfWidgetFormInputText(),
      'ca_informar_noti'     => new sfWidgetFormTextarea(),
      'ca_idmaster'          => new sfWidgetFormInputText(),
      'ca_informar_mast'     => new sfWidgetFormTextarea(),
      'ca_notify'            => new sfWidgetFormInputText(),
      'ca_transporte'        => new sfWidgetFormTextarea(),
      'ca_modalidad'         => new sfWidgetFormTextarea(),
      'ca_seguro'            => new sfWidgetFormTextarea(),
      'ca_liberacion'        => new sfWidgetFormTextarea(),
      'ca_tiempocredito'     => new sfWidgetFormTextarea(),
      'ca_comodato'          => new sfWidgetFormTextarea(),
      'ca_preferencias_clie' => new sfWidgetFormTextarea(),
      'ca_instrucciones'     => new sfWidgetFormTextarea(),
      'ca_idlinea'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('IdsProveedor'), 'add_empty' => true)),
      'ca_idconsignar'       => new sfWidgetFormInputText(),
      'ca_idconsignarmaster' => new sfWidgetFormInputText(),
      'ca_idbodega'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Bodega'), 'add_empty' => true)),
      'ca_mastersame'        => new sfWidgetFormTextarea(),
      'ca_continuacion'      => new sfWidgetFormTextarea(),
      'ca_continuacion_dest' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DestinoCont'), 'add_empty' => true)),
      'ca_continuacion_conf' => new sfWidgetFormTextarea(),
      'ca_etapa_actual'      => new sfWidgetFormTextarea(),
      'ca_login'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'), 'add_empty' => true)),
      'ca_colmas'            => new sfWidgetFormTextarea(),
      'ca_propiedades'       => new sfWidgetFormTextarea(),
      'ca_idetapa'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TrackingEtapa'), 'add_empty' => true)),
      'ca_fchultstatus'      => new sfWidgetFormDateTime(),
      'ca_idtarea_rext'      => new sfWidgetFormInputText(),
      'ca_idseguimiento'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('NotTarea'), 'add_empty' => true)),
      'ca_detanulado'        => new sfWidgetFormTextarea(),
      'ca_mcia_peligrosa'    => new sfWidgetFormInputCheckbox(),
      'ca_fchcreado'         => new sfWidgetFormDateTime(),
      'ca_usucreado'         => new sfWidgetFormTextarea(),
      'ca_fchactualizado'    => new sfWidgetFormDateTime(),
      'ca_usuactualizado'    => new sfWidgetFormTextarea(),
      'ca_fchanulado'        => new sfWidgetFormDateTime(),
      'ca_usuanulado'        => new sfWidgetFormTextarea(),
      'ca_fchcerrado'        => new sfWidgetFormDateTime(),
      'ca_usucerrado'        => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'ca_idreporte'         => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idreporte', 'required' => false)),
      'ca_fchreporte'        => new sfValidatorDate(array('required' => false)),
      'ca_consecutivo'       => new sfValidatorString(array('required' => false)),
      'ca_version'           => new sfValidatorInteger(array('required' => false)),
      'ca_idcotizacion'      => new sfValidatorString(array('required' => false)),
      'ca_idproducto'        => new sfValidatorInteger(array('required' => false)),
      'ca_origen'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Origen'), 'required' => false)),
      'ca_destino'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Destino'), 'required' => false)),
      'ca_impoexpo'          => new sfValidatorString(),
      'ca_fchdespacho'       => new sfValidatorDate(),
      'ca_idagente'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('IdsAgente'), 'required' => false)),
      'ca_incoterms'         => new sfValidatorString(array('required' => false)),
      'ca_mercancia_desc'    => new sfValidatorString(),
      'ca_idproveedor'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Proveedor'), 'required' => false)),
      'ca_orden_prov'        => new sfValidatorString(array('required' => false)),
      'ca_idconcliente'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Contacto'))),
      'ca_orden_clie'        => new sfValidatorString(),
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
      'ca_comodato'          => new sfValidatorString(array('required' => false)),
      'ca_preferencias_clie' => new sfValidatorString(array('required' => false)),
      'ca_instrucciones'     => new sfValidatorString(array('required' => false)),
      'ca_idlinea'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('IdsProveedor'), 'required' => false)),
      'ca_idconsignar'       => new sfValidatorInteger(array('required' => false)),
      'ca_idconsignarmaster' => new sfValidatorInteger(array('required' => false)),
      'ca_idbodega'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Bodega'), 'required' => false)),
      'ca_mastersame'        => new sfValidatorString(array('required' => false)),
      'ca_continuacion'      => new sfValidatorString(array('required' => false)),
      'ca_continuacion_dest' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('DestinoCont'), 'required' => false)),
      'ca_continuacion_conf' => new sfValidatorString(array('required' => false)),
      'ca_etapa_actual'      => new sfValidatorString(array('required' => false)),
      'ca_login'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'), 'required' => false)),
      'ca_colmas'            => new sfValidatorString(array('required' => false)),
      'ca_propiedades'       => new sfValidatorString(array('required' => false)),
      'ca_idetapa'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TrackingEtapa'), 'required' => false)),
      'ca_fchultstatus'      => new sfValidatorDateTime(array('required' => false)),
      'ca_idtarea_rext'      => new sfValidatorInteger(array('required' => false)),
      'ca_idseguimiento'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('NotTarea'), 'required' => false)),
      'ca_detanulado'        => new sfValidatorString(array('required' => false)),
      'ca_mcia_peligrosa'    => new sfValidatorBoolean(array('required' => false)),
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

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Reporte';
  }

}
