<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


// Set the content type to be XML, so that the browser will   recognise it as XML.
header("content-type: application/xml; charset=ISO-8859-1");

$filename = "Dmuisca_" . substr($xml_CodCpt->nodeValue + 100, 1, 2) . substr($xml_Formato->nodeValue + 100000, 1, 5) . substr($xml_Version->nodeValue + 100, 1, 2) . $xml_Ano->nodeValue . substr($xml_NumEnvio->nodeValue + 100000000, 1, 8) . ".xml";
header("content-disposition: attachment; filename=" . $filename);
print html_entity_decode($xml->saveXML());
exit;