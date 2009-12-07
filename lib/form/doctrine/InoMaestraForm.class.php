<?php

/**
 * InoMaestra form.
 *
 * @package    form
 * @subpackage InoMaestra
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class InoMaestraForm extends BaseInoMaestraForm
{
    public function configure()
    {
        
        $this->widgetSchema['ca_fchreferencia']=new sfWidgetFormExtDate();
        $this->widgetSchema['ca_fchmaster']=new sfWidgetFormExtDate();

        $this->widgetSchema['ca_origen']=new sfWidgetFormCity( );
        $this->widgetSchema['ca_destino']=new sfWidgetFormCity();

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


        $this->widgetSchema['ca_idmodalidad']=new sfWidgetFormChoice( array( "choices" => array() ));


        $this->validatorSchema['ca_impoexpo'] = new sfValidatorString(array('required' => false));
        $this->validatorSchema['ca_transporte'] = new sfValidatorString(array('required' => false));

        /*$this->useFields(array('ca_idmaestra', 'ca_referencia', 'ca_fchreferencia', 'ca_fchmaster', 'ca_origen', 'ca_destino', 'ca_idlinea',
                               'ca_master', 'ca_fchmaster', 'ca_piezas', 'ca_peso', 'ca_volumen', 'ca_observaciones'  
                              ));*/





    }
}