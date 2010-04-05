<?php

/**
 * Reporte form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ReporteForm extends BaseReporteForm
{
    const NUM_CC = 10;

    

    public function configure(){
        

        $q = Doctrine_Query::create()->select("p.*, i.ca_nombre")->from("IdsProveedor p")->innerJoin("p.Ids i")->addOrderBy("i.ca_nombre");
        $this->widgetSchema['ca_idlinea']=new sfWidgetFormDoctrineChoice(array("model"=>"IdsProveedor",
                                                                            'add_empty' => false,
                                                                            'query' => $q
                                                                      ));
        
        $this->widgetSchema['ca_idagente']=new sfWidgetFormChoice(array("choices" => array()));
        

        $this->widgetSchema['ca_idconcliente']=new sfWidgetFormInputHidden();
        $this->widgetSchema['ca_fchreporte']=new sfWidgetFormInputHidden();

        $this->widgetSchema['ca_fchdespacho']=new sfWidgetFormExtDate();
        $this->widgetSchema['ca_orden_clie']=new sfWidgetFormInputText();
        $this->widgetSchema['ca_impoexpo']=new sfWidgetFormChoice( array( "choices" => array(
                                                                                              Constantes::IMPO=>Constantes::IMPO,
                                                                                              Constantes::TRIANGULACION=>Constantes::TRIANGULACION,
                                                                                              Constantes::EXPO=>Constantes::EXPO,
                                                                                             // Constantes::OTMDTA=>Constantes::OTMDTA,
                                                                                          ) ), array("onChange"=>"cambiarImpoexpo()") );

        $this->widgetSchema['ca_transporte']=new sfWidgetFormChoice( array( "choices" => array(Constantes::AEREO=>Constantes::AEREO,
                                                                                               Constantes::MARITIMO=>Constantes::MARITIMO,
                                                                                               Constantes::TERRESTRE=>Constantes::TERRESTRE
                                                                                               
                                                                                              ) ), array("onChange" => "cambiarTransporte()")  );


        $this->widgetSchema['ca_modalidad']=new sfWidgetFormChoice( array( "choices" => array() ), array("onChange" => "cambiarModalidad()"));


       
        $this->widgetSchema['ca_origen']=new sfWidgetFormCity();
        $this->widgetSchema['ca_destino']=new sfWidgetFormCity();
         /*
        Se debe incluir esto en la accion
        $country_reporte = $request->getParameter("country_reporte");
        $this->ca_traorigen = $country_reporte["ca_origen"];
        $this->ca_tradestino = $country_reporte["ca_destino"];

        $bindValues = $request->getParameter("reporte");
        $this->ca_origen = $bindValues["ca_origen"];
        $this->ca_destino = $bindValues["ca_destino"];
        */


        $this->widgetSchema['ca_continuacion']=new sfWidgetFormChoice( array( "choices" => array() ), array("onChange" => "cambiarContinuacion()"));

        $q = Doctrine::getTable("Ciudad")->createQuery("c")->select("c.*")->where("c.ca_idtrafico = ?", "CO-057")->addOrderBy("c.ca_ciudad");
        $this->widgetSchema['ca_continuacion_dest']=new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DestinoCont'), 'add_empty' => false, "query"=>$q, "method"=>"getCaCiudad"));

        $q = Doctrine::getTable("Usuario")->createQuery("u")->select("u.*")->where("u.ca_cargo LIKE ?", "%Operaciones Maritimas%")->addOrderBy("u.ca_nombre");
        $this->widgetSchema['ca_continuacion_conf']=new sfWidgetFormDoctrineChoice(array('model' => "Usuario", 'add_empty' => false, "query"=>$q, "method"=>"getCaNombre", "expanded"=>true, "multiple"=>false));

       //[TODO] Volver Booleano
        $this->widgetSchema['ca_colmas']=new sfWidgetFormChoice( array( "choices" => array("Sí"=>"Sí", "No"=>"No" )), array("onChange"=>"cambiarAduana()"));
        $this->widgetSchema['ca_seguro']=new sfWidgetFormChoice( array( "choices" => array("Sí"=>"Sí", "No"=>"No" )), array("onChange"=>"cambiarSeguros()"));

        $this->widgetSchema['ca_preferencias_clie']=new sfWidgetFormTextarea(array(), array("rows"=>10, "cols"=>90 ) );


        $this->widgetSchema['ca_instrucciones']=new sfWidgetFormTextarea(array(), array("rows"=>10, "cols"=>90 ) );

        for( $i=0; $i< self::NUM_CC ; $i++ ){
			$this->widgetSchema["contactos_".$i] = new sfWidgetFormInputText(array(), array("size"=>40, "style"=>"margin-bottom:3px", "maxlength"=>50));
            $this->widgetSchema["confirmar_".$i] = new sfWidgetFormInputCheckbox();
		}


        //Corte de guias
        $consignarMaster = ParametroTable::retrieveByCaso( "CU048" );
        $choices = array();
        foreach( $consignarMaster as $consignar){
            $choices[$consignar->getCaIdentificacion()] = $consignar->getCaValor();
        }
        $this->widgetSchema['ca_idconsignarmaster']=new sfWidgetFormChoice( array( "choices" => $choices) );


        $consignarHija = ParametroTable::retrieveByCaso( "CU055" );
        $choices = array();
        foreach( $consignarHija as $consignar){
            $choices[$consignar->getCaIdentificacion()] = $consignar->getCaValor();
        }
        $this->widgetSchema['ca_idconsignar_expo']=new sfWidgetFormChoice( array( "choices" => $choices) );

        $this->widgetSchema['ca_idconsignar_impo']=new sfWidgetFormChoice( array( "choices" => array()) );
        $this->widgetSchema['tipo']=new sfWidgetFormChoice( array( "choices" => array()),array("onchange"=>"llenarBodegas()") );
        $this->widgetSchema['ca_idbodega']=new sfWidgetFormChoice( array( "choices" => array()) );


        //$this->widgetSchema['ca_idconsignar_impo']=new sfWidgetFormChoice( array( "choices" => $choices) );
        $this->widgetSchema['ca_mastersame']=new sfWidgetFormChoice( array( "choices" => array("Sí"=>"Sí", "No"=>"No" ) ) );


        $this->widgetSchema['ca_login']=new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'), 'add_empty' => false, 'table_method'=>"getComerciales"));

        $this->widgetSchema['ca_informar_repr']=new sfWidgetFormChoice( array( "choices" => array("Sí"=>"Sí", "No"=>"No" ), "expanded"=>true ) );
        $this->widgetSchema['ca_informar_cons']=new sfWidgetFormChoice( array( "choices" => array("Sí"=>"Sí", "No"=>"No" ), "expanded"=>true ) );
        $this->widgetSchema['ca_informar_noti']=new sfWidgetFormChoice( array( "choices" => array("Sí"=>"Sí", "No"=>"No" ), "expanded"=>true ) );
        $this->widgetSchema['ca_informar_mast']=new sfWidgetFormChoice( array( "choices" => array("Sí"=>"Sí", "No"=>"No" ), "expanded"=>true ) );
       
        $q = Doctrine::getTable("Parametro")->createQuery("p")->where("ca_casouso = ?", "CU021");
        $this->widgetSchema['ca_incoterms']=new sfWidgetFormDoctrineChoice(array('model' => "Parametro", 'add_empty' => false, "query"=>$q, "method"=>"getValIncoterm"));

        $this->widgetSchema['ca_idcotizacion']=new sfWidgetFormInputText();
        $this->widgetSchema['ca_idproducto']=new sfWidgetFormInputText();

        $this->widgetSchema['ca_comodato']=new sfWidgetFormChoice( array( "choices" => array("Sí"=>"Sí", "No"=>"No" ) ) );

        //Expo
        //$consignar = ParametroPeer::retrieveByCaso( "CU055" );


        $this->validatorSchema['ca_origen'] = new sfValidatorString(array('required'=>true));
        $this->validatorSchema['ca_destino'] = new sfValidatorString(array('required'=>true));
        $this->validatorSchema['ca_idlinea'] = new sfValidatorString(array('required'=>true));
        $this->validatorSchema['ca_idagente'] = new sfValidatorString(array('required'=>false));

        $this->validatorSchema['ca_idconcliente'] = new sfValidatorDoctrineChoice(array('model' => 'Contacto', 'required' => true));

        for( $i=0; $i< self::NUM_CC ; $i++ ){
			$this->validatorSchema["contactos_".$i] =new sfValidatorEmail( array('required' => false ),
														array('invalid' => 'La dirección es invalida'));
            $this->validatorSchema["confirmar_".$i] =new sfValidatorString( array('required' => false ));
		}

        $this->validatorSchema['ca_idconsignar_impo'] = new sfValidatorString(array('required'=>false));
        $this->validatorSchema['ca_idconsignar_expo'] = new sfValidatorString(array('required'=>false));

        $this->validatorSchema['ca_idproveedor'] = new sfValidatorString(array('required'=>false));


        $this->validatorSchema['tipo'] = new sfValidatorString(array('required'=>false));
        /*
        $this->useFields(array('ca_origen', 'ca_destino', 'ca_idlinea', 'ca_idagente','ca_colmas',
                               'ca_fchdespacho', 'ca_impoexpo', 'ca_transporte', 'ca_modalidad',
                               'ca_mercancia_desc', 'ca_mcia_peligrosa', 'ca_login', 'ca_consecutivo', 'ca_version', 'ca_orden_clie'
                              ));*/
    }

   public function bind(array $taintedValues = null, array $taintedFiles = null){
		//$request = sfContext::getInstance()->getRequest();

		if( $taintedValues["ca_impoexpo"]==Constantes::EXPO ){
            $this->validatorSchema['ca_idconsignatario']->setOption('required', true);
        }else{
			$this->validatorSchema['ca_idproveedor']->setOption('required', true);
            $this->validatorSchema['ca_orden_prov']->setOption('required', true);
		}

        
        if( $taintedValues["ca_continuacion"]!="N/A" && $taintedValues["ca_impoexpo"]==Constantes::IMPO && $taintedValues["ca_transporte"]==Constantes::MARITIMO ){
            $this->validatorSchema['ca_continuacion_conf']->setOption('required', true);
        }

        //varia si es AG
        $this->validatorSchema['ca_modalidad']->setOption('required', true);
        
		parent::bind($taintedValues, $taintedFiles);

    }
}
