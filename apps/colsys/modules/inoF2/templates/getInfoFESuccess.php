<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$comprobante = $sf_data->getRaw("comprobante");
$jsonFE=json_decode(utf8_encode($comprobante->getCaDatosfe()));
//print_r($jsonFE->envio);
//var_dump($jsonFE->envio);
//echo prettyPrint($comprobante->getCaDatosfe());
//$jsonEnvio=  prettyPrint($jsonFE->envio) ;
//echo $jsonEnvio;
function jsonFormat($s)
{
    $result="";
    
    $crl = 0;
    $ss = false;
    $result.= "<pre>";
    for($c=0; $c<strlen($s); $c++)
    {
        if ( $s[$c] == "}" || $s[$c] == "]" )
        {
            $crl--;
            $result.= "<br>";
            $result.= str_repeat(' ', ($crl*2));
        }
        if ( $s[$c] == '"' && ($s[$c-1] == ',' || $s[$c-2] == ',') )
        {
            $result.= "<br>";
            $result.= str_repeat(' ', ($crl*2));
        }
        if ( $s[$c] == '"' && !$ss )
        {
            if ( $s[$c-1] == ':' || $s[$c-2] == ':' )
                $result.= '<span style="color:#0000ff;">';
            else
                $result.= '<span style="color:#ff0000;">';
        }
        $result.= $s[$c];
        if ( $s[$c] == '"' && $ss )
            $result.= '</span>';
        if ( $s[$c] == '"' )
              $ss = !$ss;
        if ( $s[$c] == "{" || $s[$c] == "[" )
        {
            $crl++;
            $result.= "<br>";
            $result.= str_repeat(' ', ($crl*2));
        }
    }
    $result.=$s[$c];
    
    
    
    return $result;
}
//$jsonFE=json_encode($comprobante->getCaDatosfe());
//print_r($jsonFE);
//$s = $comprobante->getCaDatosfe();
//echo "<pre>";print_r($jsonFE->envio);echo "</pre>";
//exit;
$jsonEnvio= jsonFormat( json_encode($jsonFE->envio) );

$jsonRespuesta= jsonFormat( json_encode($jsonFE->respuesta) );

$jsonConsulta= jsonFormat( json_encode($jsonFE->consulta) );

//exit;
?>
<html>
    <head>
<style>
.json{
    background: url('../../../images/fam/json.png') no-repeat 0 0 !important;
}

</style>
<link type="text/css" rel="stylesheet" href="/js/ext-6.5.0/build/classic/theme-crisp/resources/theme-crisp-all-debug.css">
<script type="text/javascript" src="/js/ext6/ext-all.js"></script>

<script>
Ext.onReady(function () {
    Ext.create('Ext.TabPanel', {
        fullscreen: true,
        tabBarPosition: 'bottom',
        renderTo: Ext.getBody(),

        defaults: {
            styleHtmlContent: true
        },

        items: [
            {
                title: 'Json Envio',
                iconCls: 'json',
                html: '<div><?=$jsonEnvio?></div>'
            },
            {
                title: 'Respuesta FE',
                iconCls: 'json',
                html: '<div><?=$jsonRespuesta?></div>'
            },
            {
                title: 'Consulta',
                iconCls: 'json',
                html: '<div><?=$jsonConsulta?></div>'
            }
        ]
    });  
});
</script>

    </head>
    
    <body>
   </body>


</html>

