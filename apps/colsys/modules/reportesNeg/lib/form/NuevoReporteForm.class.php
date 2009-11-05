<?php

/**
 * Reporte form base class.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class NuevoReporteForm extends BaseReporteForm
{

    public function configure(){
        $this->widgetSchema['ca_origen']=new sfWidgetFormCity( );

        //$this->widgetSchema['pais_destino']=new sfWidgetFormCountry(array("link"=>"ciudad_destino", 'add_empty'=>true), array("id"=>"pais_destino"));
        $this->widgetSchema['ca_destino']=new sfWidgetFormCity();

        $q = Doctrine_Query::create()->select("p.*, i.ca_nombre")->from("IdsProveedor p")->innerJoin("p.Ids i")->addOrderBy("i.ca_nombre");
        $this->widgetSchema['ca_idlinea']=new sfWidgetFormDoctrineChoice(array("model"=>"IdsProveedor",
                                                                            'add_empty' => false,
                                                                            'query' => $q
                                                                      ));
        $q = Doctrine_Query::create()->select("a.*, i.ca_nombre")->from("IdsAgente a")->innerJoin("a.Ids i")->addOrderBy("i.ca_nombre");
        $this->widgetSchema['ca_idagente']=new sfWidgetFormDoctrineChoice(array("model"=>"IdsAgente",
                                                                            'add_empty' => false,
                                                                            'query' => $q
                                                                      ));

        
        $this->widgetSchema['ca_idconcliente']=new sfWidgetFormInputHidden();
        $this->widgetSchema['ca_fchreporte']=new sfWidgetFormInputHidden();

        $this->widgetSchema['ca_fchdespacho']=new sfWidgetFormExtDate();
        $this->widgetSchema['ca_orden_clie']=new sfWidgetFormInputText(); 
        $this->widgetSchema['ca_impoexpo']=new sfWidgetFormChoice( array( "choices" => array(
                                                                                              Constantes::IMPO=>Constantes::IMPO,
                                                                                              //Constantes::TRIANGULACION=>Constantes::TRIANGULACION,
                                                                                              Constantes::EXPO=>Constantes::EXPO,
                                                                                             // Constantes::OTMDTA=>Constantes::OTMDTA,
                                                                                             //Constantes::NACIONALIZACION=>Constantes::NACIONALIZACION,

                                                                                             
                                                                                          ) ), array("onChange"=>"cambiarImpoexpo()") );
        $this->widgetSchema['ca_transporte']=new sfWidgetFormChoice( array( "choices" => array(Constantes::AEREO=>Constantes::AEREO,
                                                                                               Constantes::MARITIMO=>Constantes::MARITIMO,
                                                                                               Constantes::TERRESTRE=>Constantes::TERRESTRE,
                                                                                               Constantes::ADUANA=>Constantes::ADUANA
                                                                                              ) ), array("onChange" => "cambiarTransporte()")  );
        $this->widgetSchema['ca_modalidad']=new sfWidgetFormChoice( array( "choices" => array() ));
        //[TODO] Volver Booleano
        $this->widgetSchema['ca_colmas']=new sfWidgetFormChoice( array( "choices" => array("Sí"=>"Sí", "No"=>"No" )));
        $this->widgetSchema['ca_seguro']=new sfWidgetFormChoice( array( "choices" => array("Sí"=>"Sí", "No"=>"No" )));


        $this->validatorSchema['ca_origen'] = new sfValidatorString(array('required'=>true));
        $this->validatorSchema['ca_destino'] = new sfValidatorString(array('required'=>true));
        $this->validatorSchema['ca_idlinea'] = new sfValidatorString(array('required'=>true));
        $this->validatorSchema['ca_idagente'] = new sfValidatorString(array('required'=>false));

        $this->validatorSchema['ca_idconcliente'] = new sfValidatorDoctrineChoice(array('model' => 'Contacto', 'required' => true));


        /*
        $this->useFields(array('ca_origen', 'ca_destino', 'ca_idlinea', 'ca_idagente','ca_colmas',
                               'ca_fchdespacho', 'ca_impoexpo', 'ca_transporte', 'ca_modalidad',
                               'ca_mercancia_desc', 'ca_mcia_peligrosa', 'ca_login', 'ca_consecutivo', 'ca_version', 'ca_orden_clie'
                              ));*/
         
    }
  /*public function setup()
  {
    $this->setWidgets(array(
      'ca_idreporte'         => new sfWidgetFormInputHidden(),
      'ca_fchreporte'        => new sfWidgetFormDate(),
      'ca_consecutivo'       => new sfWidgetFormTextarea(),
      'ca_version'           => new sfWidgetFormInputText(),
      'ca_idcotizacion'      => new sfWidgetFormInputText(),
      'ca_origen'            => new sfWidgetFormDoctrineChoice(array('model' => 'Ciudad', 'add_empty' => true)),
      'ca_destino'           => new sfWidgetFormDoctrineChoice(array('model' => 'Ciudad', 'add_empty' => true)),
      'ca_impoexpo'          => new sfWidgetFormTextarea(),
      'ca_fchdespacho'       => new sfWidgetFormDate(),
      'ca_idagente'          => new sfWidgetFormDoctrineChoice(array('model' => 'IdsAgente', 'add_empty' => true)),
      'ca_incoterms'         => new sfWidgetFormTextarea(),
      'ca_mercancia_desc'    => new sfWidgetFormTextarea(),
      'ca_idproveedor'       => new sfWidgetFormDoctrineChoice(array('model' => 'Tercero', 'add_empty' => true)),
      'ca_orden_prov'        => new sfWidgetFormTextarea(),
      'ca_idconcliente'      => new sfWidgetFormDoctrineChoice(array('model' => 'Contacto', 'add_empty' => true)),
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
      'ca_preferencias_clie' => new sfWidgetFormTextarea(),
      'ca_instrucciones'     => new sfWidgetFormTextarea(),
      'ca_idlinea'           => new sfWidgetFormDoctrineChoice(array('model' => 'IdsProveedor', 'add_empty' => true)),
      'ca_idconsignar'       => new sfWidgetFormInputText(),
      'ca_idconsignarmaster' => new sfWidgetFormInputText(),
      'ca_idbodega'          => new sfWidgetFormDoctrineChoice(array('model' => 'Bodega', 'add_empty' => true)),
      'ca_mastersame'        => new sfWidgetFormTextarea(),
      'ca_continuacion'      => new sfWidgetFormTextarea(),
      'ca_continuacion_dest' => new sfWidgetFormDoctrineChoice(array('model' => 'Ciudad', 'add_empty' => true)),
      'ca_continuacion_conf' => new sfWidgetFormTextarea(),
      'ca_etapa_actual'      => new sfWidgetFormTextarea(),
      'ca_login'             => new sfWidgetFormDoctrineChoice(array('model' => 'Usuario', 'add_empty' => true)),
      'ca_colmas'            => new sfWidgetFormTextarea(),
      'ca_propiedades'       => new sfWidgetFormTextarea(),
      'ca_idetapa'           => new sfWidgetFormDoctrineChoice(array('model' => 'TrackingEtapa', 'add_empty' => true)),
      'ca_fchultstatus'      => new sfWidgetFormDateTime(),
      'ca_idtarea_rext'      => new sfWidgetFormInputText(),
      'ca_idseguimiento'     => new sfWidgetFormDoctrineChoice(array('model' => 'NotTarea', 'add_empty' => true)),
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

    $this->setupInheritance();

    parent::setup();
  }
  */
  public function getModelName()
  {
    return 'Reporte';
  }

}
