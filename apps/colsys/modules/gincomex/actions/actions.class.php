<?php

/**
 * gincomex actions.
 *
 * @package    symfony
 * @subpackage gincomex
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class gincomexActions extends sfActions {

   


    /***********************************
     *
     * 
     **********************************/
    public function executeIndex(sfWebRequest $request) {

        try{
            $client = new SoapClient(null, array('location' => "http://www.gincomex.biz/pruebas/webservices/servicio.php",
                                     'uri'      => "http://tempuri.org",
                                     'trace'=>1,
                                     'exceptions'=>0,
                                ));
        
            $client->__soapCall( "nuevasOrdenes", array('clave' => 'HJDSJHSDUU3313JKIAASSJU12'));
            
            $response = $client->__getLastResponse();

            /*$start=strpos($response,'<return>');
            $end=strrpos($response,'</return>');
            $response=substr($response,$start,$end-$start+9);*/


            $start=strpos($response,'<?xml');
            $end=strrpos($response,'>');
            $response=substr($response,$start,$end-$start+1);

            //$response = str_replace( "xsi:", "",$response);

            echo htmlspecialchars($response)."<br /><br />";


            $feed = SimpleXML_Load_String($response);
            $feed->registerXPathNamespace("xsi", "http://tempuri.org");

            print_r( $feed );

            $result = $feed->xpath("ns1:nuevasOrdenesResponse");

            /*$obj = SimpleXML_Load_String($response);
            print_r($obj);*/


            /*$sxe = new SimpleXMLElement($response);

            $sxe->registerXPathNamespace('xsd', 'http://www.w3.org/2001/XMLSchema');
            $resultado = $sxe->xpath('//xsi:titulo');

            foreach ($resultado as $titulo) {
              echo $titulo . "\n";
            }*/


            //$this->arrObjData = get_object_vars($obj);

            

            /*$xml = simplexml_load_string($response);
            //print_r( $xml );*/

            /*
            $doc = new DOMDocument();
            $doc->createElementNS( 'http://www.w3.org/2001/XMLSchema', 'xsi:type' );
            $doc->loadXML($response);

            echo "----------------------------------------<br />";
            //print_r( $doc );
            foreach ($doc->childNodes as $tag) {
                print_r( $tag );

                echo "<br />";
                echo "<br />";

            }*/
            //echo $response;


        }catch (SoapFault $soapFault) {
            var_dump($soapFault);
            //echo "Exception: ".$e->getMessage();
        }catch (Exception $soapFault) {            
            echo "Exception: ".$soapFault->getMessage();
        }



        
        

        exit();
    }
}





