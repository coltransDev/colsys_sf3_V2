<?php

/**
 * users actions.
 *
 * @package    symfony
 * @subpackage users
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class usersActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeUsersWS(sfWebRequest $request) {
        
        ProjectConfiguration::registerZend();   
        if(isset($_GET['wsdl'])) {
            //return the WSDL
            
            $autodiscover = new Zend_Soap_AutoDiscover();
            $autodiscover->setClass('UserSoap');
            $autodiscover->handle();
             
             
        } else {
            //handle SOAP request
            $wsdl_uri = "https://www.colsys.com.co/ws/users/usersWS?wsdl";
            //$wsdl_uri = "https://172.16.1.13/ws/users/usersWS?wsdl";
            $soap = new Zend_Soap_Server($wsdl_uri); 
            $options = array('encoding'=>'ISO-8859-1');
            $soap->setOptions($options);
            $soap->setClass('UserSoap');
            $soap->handle();
        }
        exit();
        return sfView::NONE;
    }
    
    
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */    
    public function executeUsersGoogle(sfWebRequest $request) {    
        
        ProjectConfiguration::registerZend();   
        Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
        Zend_Loader::loadClass('Zend_Gdata_Gapps');
        
        //$client = Zend_Gdata_ClientLogin::getHttpClient("maquinche", "80166236", Zend_Gdata_Gapps::AUTH_SERVICE_NAME);
        //$gdata = new Zend_Gdata_Gapps($client, 'coltrans.co');
        //$gdata->updateUser("colsys", "cglti$col9110");
        $email="maquinche";
        $password="80166236";
        $client = Zend_Gdata_ClientLogin::getHttpClient($email, $password, Zend_Gdata_Gapps::AUTH_SERVICE_NAME);
        $gdata = new Zend_Gdata_Gapps($client, 'coltrans.co');
        $data=$gdata->retrievePageOfUsers($startUsername=null);
        print_r($data);
        exit;
    }
    

}
