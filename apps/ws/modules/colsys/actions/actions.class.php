<?php

/**
 * users actions.
 *
 * @package    symfony
 * @subpackage users
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class colsysActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeReportesNegWS(sfWebRequest $request) {
        
        //exit;
        try 
        {
        ProjectConfiguration::registerZend();   
        if(isset($_GET['wsdl'])) {
            //return the WSDL
//            echo "26";
//            exit;
            $autodiscover = new Zend_Soap_AutoDiscover();
            $autodiscover->setClass('ReporteSoap');
            $autodiscover->handle();
        } else {
            //handle SOAP request
            //$wsdl_uri = "https://www.coltrans.com.co/ws/users/usersWS?wsdl";
//            echo "34";
//            exit;
            $wsdl_uri = "https://www.colsys.com.co/ws/colsys/reportesNegWS?wsdl";
            $soap = new Zend_Soap_Server($wsdl_uri); 
            $options = array('encoding'=>'ISO-8859-1');
            $soap->setOptions($options);
            $soap->setClass('ReporteSoap');
            $soap->handle();
        }
        exit();
        return sfView::NONE;
        }
        catch (Exception $e)
        {
            print_r($e->getMessage());
            exit;
        }
    }
    
    /**
     * Executes ticketsWS action
     *
     * @param sfRequest $request A request object
     */
    public function executeTicketsWS(sfWebRequest $request) {
        
        //exit;
        try 
        {
        ProjectConfiguration::registerZend();   
        if(isset($_GET['wsdl'])) {
            //return the WSDL
//            echo "26";
//            exit;
            $autodiscover = new Zend_Soap_AutoDiscover();
            $autodiscover->setClass('TicketSoap');
            $autodiscover->handle();
        } else {
            $wsdl_uri = "https://www.colsys.com.co/ws/colsys/ticketsWS?wsdl";
            $soap = new Zend_Soap_Server($wsdl_uri); 
            $options = array('encoding'=>'ISO-8859-1');
            $soap->setOptions($options);
            $soap->setClass('TicketSoap');
            $soap->handle();
        }
        exit();
        return sfView::NONE;
        }
        catch (Exception $e)
        {
            print_r($e->getMessage());
            exit;
        }
    }
    
    
    /**
     * Executes Wse action
     *
     * @param sfRequest $request A request object
     */
    public function executeWse(sfWebRequest $request) {
        
        /*$wsdl_uri = "https://10.192.1.62/ws/users/usersWS?wsdl";
            $soap = new Zend_Soap_Server($wsdl_uri); 
            $options = array('encoding'=>'ISO-8859-1');
            $soap->setOptions($options);
            $soap->setClass('UserSoap');
            $soap->handle();
         * 
         */
        //ProjectConfiguration::registerZend();
        /*    $client = new Zend_Soap_Client( "https://10.192.1.62/ws/colsys/contactsWS?wsdl", array('encoding'=>'ISO-8859-1', 'soap_version'=>SOAP_1_2 ));        
            $result = $client->actualiza(
                array(
                    a=>"2014",
                    t=>$tipoComprobante->getCaTipo(),
                    nt=>$tipoComprobante->getCaComprobante(),
                    c=>$consecutivo,
                    d=>$tipoComprobante->getCaIdempresa()));
         * 
         */
        //error_reporting(E_ALL);
        echo "dddgfsdf";
       $client = new Zend_Soap_Client( "https://www.colsys.com.co/ws/colsys/contactsWS?wsdl", array('encoding'=>'ISO-8859-1', 'soap_version'=>SOAP_1_2));
       echo "123456789";
       //$result = $client->getContacts("fgfgdfgdfg");
        //print_r($result);
        /*$client = new Zend_Soap_Client( "https://www.colsys.com.co/ws/colsys/contactsWS?wsdl", array('encoding'=>'ISO-8859-1', 'soap_version'=>SOAP_1_2 ));
        $result = $client->viewReporte("415412");
         */
        



/*$response = $client->__soapCall('system_soap_connect', array());
echo '
'.print_r($response,true).'';
$session_id = $response->sessid;
$response = $client->__soapCall('user_soap_login', array('maquinche', 'xxxxxx'));
echo '
'.print_r($response,true).'';
$session_id = $response->sessid;
if ($session_id) {
$response = $client->__soapCall('system_soap_get_variable', array('site_info','x'));
echo '
'.print_r($response,true).'';
}
else {
 print 'Could not authenticate user';
}*/
print "\n";


        exit;
//        colsys/contactsWS
    }
    
    
    /**
     * Executes contactsWS action
     *
     * @param sfRequest $request A request object
     */
    public function executeContactsWS(sfWebRequest $request) {
        //echo "dsdsf asdsa d sadsa ";
        //return "dsdsfasdsa dsa dsad";
        
        
        try 
        {
        ProjectConfiguration::registerZend();   
        
        
        if(isset($_GET['wsdl'])) {
            
            //return the WSDL
//            echo "26";
//            exit;
            $autodiscover = new Zend_Soap_AutoDiscover();
            
            $autodiscover->setClass('ContactsSoap');
            //$autodiscover->setObject(new ContactsSoap());
            
            $autodiscover->handle();            
            
            $result=$autodiscover->getContacts("ddd");
            printr_r($result);
           // echo "1";
            //exit;
        } else {
            //echo "2";
            //exit;
            $wsdl_uri = "https://www.colsys.com.co/ws/colsys/contactsWS?wsdl";
            //$soap = new Zend_Soap_Server($wsdl_uri); 
            $options = array('encoding'=>'ISO-8859-1');
            $soap->setOptions($options);
            //$soap->setClass('ContactsSoap');
            /*$soap->handle();*/
            $server = new Zend_Soap_Server($wsdl_uri, $options);
            $server->setClass('ContactsSoap');
            //$server->setObject(new ContactsSoap());
// Bind Class to Soap Server
            //$server->setClass('MyClass');
            // Bind already initialized object to Soap Server
            //$server->setObject(new MyClass());
            
            $server->handle();
            
            $result=$server->getContacts("ddd");
            printr_r($result);
        }
        echo "ddd";
        //exit();
        return sfView::NONE;
        }
        catch (Exception $e)
        {
            print_r($e->getMessage());
            //exit;
        }
        exit();
    }
    
    
    
    /**
     * Executes documentossWS action
     *
     * @param sfRequest $request A request object
     */
    public function executeDocumentosWS(sfWebRequest $request) {
        
        //$file = "/home/maquinche/Desarrollo/digitalFile/Referencias/prueba.pdf";
        //print_r($_POST);
        //print_r($_FILES);
        
        //$asunto=$request->getParameter("asunto");
        $d=$request->getParameter("asunto");
        $asunto=substr($d,0,strlen($d)-21);
        $key_secret=$request->getParameter("key_secret");
        $from=$request->getParameter("from");
        
        $user = Doctrine::getTable("Usuario")
                            ->createQuery("u")
                            ->select("*")
                            ->where("u.ca_email = ? ", $from)
                            ->limit(1)
                            ->fetchOne(); 
        if($user)
            echo $user->getCaEmail();
        else
        {
            $user = Doctrine::getTable("Usuario")
                            ->createQuery("u")
                            ->select("*")
                            ->where("u.ca_login = ? ", "Administrador")
                            ->limit(1)
                            ->fetchOne(); 
        }
      
        //$ref= explode("-", $asunto);
        $ref=array();
        $ref[]=substr($ref[0], 0,10);
        $ref[]=substr($ref[0], 11,4);        
	
        $data=array();
        
        
        if(strlen($ref[0])<15)
        {
            $ref[0] =  str_replace(".", "", $ref[0]);
            $ref[0] =  substr($ref[0], 0,3).".".substr($ref[0], 3,2).".".substr($ref[0], 5,2).".".substr($ref[0], 7,3).".".substr($ref[0], 10,1);
        }
        $data["ref1"]=$ref[0];
            
        if(isset($ref[1]))
        {            
            $sql="select  ca_hbls from tb_inoclientes_sea 
            where ca_referencia='".$ref[0]."' and UPPER(substring(ca_hbls from (char_length(ca_hbls)-3) ))= UPPER('".$ref[1]."') limit 1";
            $con = Doctrine_Manager::getInstance()->connection();

            $st = $con->execute($sql);
            $resul = $st->fetchAll();            
            $data["ref2"]=$resul[0]["ca_hbls"];
        }
        $data["iddocumental"]="7";
        $data["user"]=$user->getCaLogin();

        $success=ArchivosTable::subirArchivos($_FILES, $data);
        
        $this->responseArray=array("success"=>$success );
        $this->setTemplate("responseTemplate");
        
        /*    foreach ($_FILES as $uploadedFile) {
                try {

                    //$fileNameMin = $tmp[0];
                    $name_tmp = $uploadedFile['tmp_name'];
                    $fileName = $uploadedFile['name'];
                    //$tmp = explode(".", $fileName);
                    //$fileNameMin = $tmp[0];
                    $name_tmp = $uploadedFile['tmp_name'];
                    if (move_uploaded_file($uploadedFile['tmp_name'],"/srv/www/digitalFile/".date("Y")."/$fileName" ))
                        echo $filename;
                    else
                        echo "error 1";
                } catch (Exception $e) {
                    echo "error 2";
                }
            }*/
        exit;
        
    }
    
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeInformeOpenWS(sfWebRequest $request) {
        
        //print_r($_REQUEST);
        try {
            ProjectConfiguration::registerZend();   
            if(isset($_GET['wsdl'])) {
                $autodiscover = new Zend_Soap_AutoDiscover();                
                $autodiscover->setClass('InformeOpenSoap');                
                $autodiscover->handle();
            } else {                
                $wsdl_uri = "https://www.colsys.com.co/ws/colsys/InformeOpenWS?wsdl";
                //$wsdl_uri = "https://10.192.1.70/ws/colsys/InformeOpenWS?wsdl";
                $soap = new Zend_Soap_Server($wsdl_uri);                 
                $options = array('encoding'=>'ISO-8859-1');
                $soap->setOptions($options);
                $soap->setClass('InformeOpenSoap');
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
