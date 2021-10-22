<?php

/**
 * sap actions.
 *
 * @package    symfony
 * @subpackage users
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sapActions extends sfActions {

    /**
     * Executes IntegracionSapWS action
     *
     * @param sfRequest $request A request object
     */
    public function executeIntegracionSapWS(sfWebRequest $request) {
        
        //print_r($_REQUEST);
        //print_r($options);
        $opts = array(
            'ssl' => array(
                'ciphers' => 'RC4-SHA',
                'verify_peer' => false,
                'verify_peer_name' => false
            )
        );
        
        try {
            ProjectConfiguration::registerZend();   
            if(isset($_GET['wsdl'])) {
                //die("werwerwerwe");
                $autodiscover = new Zend_Soap_AutoDiscover();                
                $autodiscover->setClass('IntegracionSoap');                
                $autodiscover->handle();
            } else {                
                //$wsdl_uri = "https://www.colsys.com.co/ws/colsys/IntegracionSapWS?wsdl";
                //$wsdl_uri = "http://190.25.189.212/ws/sap/IntegracionSapWS?wsdl"; /* Servidor de Replica*/
                $wsdl_uri = "http://172.16.1.13/ws/sap/IntegracionSapWS?wsdl";
                $soap = new Zend_Soap_Server($wsdl_uri);
                //echo "<pre>";print_r($soap);echo "<pre>";
                //die();
                $options = array('encoding'=>'ISO-8859-1', 'cache_wsdl' => 0,
                    'trace' => 1,
                    'stream_context' => stream_context_create(array(
                          'ssl' => array(
                               'verify_peer' => false,
                                'verify_peer_name' => false,
                                'allow_self_signed' => true
                          )
                    )));
//                $options = array('encoding'=>'ISO-8859-1');
                $soap->setOptions($options);
                $soap->setClass('IntegracionSoap');
                $soap->handle();
            }
            exit();
            return sfView::NONE;
        }catch (Exception $e){
            print_r($e->getMessage());
            exit;
        }
    }
}