<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$xml = new DOMDocument();
$xml->loadXML(html_entity_decode($outXML));

foreach ($xml->childNodes as $mas) {
    if ($mas->nodeName == "mas") {
        foreach ($mas->childNodes as $Cab) {
            if ($Cab->nodeName == "Cab") {
                foreach ($Cab->childNodes as $element) {
                    if ($element->nodeName == "Ano") {
                        $xml_Ano = $element->nodeValue;
                    } else if ($element->nodeName == "CodCpt") {
                        $xml_CodCpt = $element->nodeValue;
                    } else if ($element->nodeName == "Formato") {
                        $xml_Formato = $element->nodeValue;
                    } else if ($element->nodeName == "Version") {
                        $xml_Version = $element->nodeValue;
                    } else if ($element->nodeName == "NumEnvio") {
                        $xml_NumEnvio = $element->nodeValue;
                    }
                }
            }
        }
    }
}

// Set the content type to be XML, so that the browser will   recognise it as XML.
header("content-type: application/xml; charset=ISO-8859-1");
$filename = "Dmuisca_" . substr($xml_CodCpt + 100, 1, 2) . substr($xml_Formato + 100000, 1, 5) . substr($xml_Version + 100, 1, 2) . $xml_Ano . substr($xml_NumEnvio + 100000000, 1, 8) . ".xml";
header("content-disposition: attachment; filename=" . $filename);
print $xml->saveXML();
exit;
