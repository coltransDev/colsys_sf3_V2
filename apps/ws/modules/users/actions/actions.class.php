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
            $wsdl_uri = "https://www.coltrans.com.co/ws/users/usersWS?wsdl";
            $soap = new Zend_Soap_Server($wsdl_uri); 
            $options = array('encoding'=>'ISO-8859-1');
            $soap->setOptions($options);
            $soap->setClass('UserSoap');
            $soap->handle();
        }
        exit();
        return sfView::NONE;
    }

}
