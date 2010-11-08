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
    const NUM_CC = 10;
    


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
                                                                                              Constantes::TRIANGULACION=>Constantes::TRIANGULACION,
                                                                                              Constantes::EXPO=>Constantes::EXPO,
                                                                                             // Constantes::OTMDTA=>Constantes::OTMDTA,                                                                                             
                                                                                          ) ), array("onChange"=>"cambiarImpoexpo()") );

        $this->widgetSchema['ca_transporte']=new sfWidgetFormChoice( array( "choices" => array(Constantes::AEREO=>Constantes::AEREO,
                                                                                               Constantes::MARITIMO=>Constantes::MARITIMO,
                                                                                               Constantes::TERRESTRE=>Constantes::TERRESTRE,
                                                                                               Constantes::ADUANA=>Constantes::ADUANA
                                                                                              ) ), array("onChange" => "cambiarTransporte()")  );


        $this->widgetSchema['ca_modalidad']=new sfWidgetFormChoice( array( "choices" => array() ));

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

        /*
        $this->useFields(array('ca_origen', 'ca_destino', 'ca_idlinea', 'ca_idagente','ca_colmas',
                               'ca_fchdespacho', 'ca_impoexpo', 'ca_transporte', 'ca_modalidad',
                               'ca_mercancia_desc', 'ca_mcia_peligrosa', 'ca_login', 'ca_consecutivo', 'ca_version', 'ca_orden_clie'
                              ));*/
         
    }
  


}
