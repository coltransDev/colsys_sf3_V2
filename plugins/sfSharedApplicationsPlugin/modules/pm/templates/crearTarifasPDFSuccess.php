<?
$ticket = $sf_data->getRaw("ticket");
$tarifas = $sf_data->getRaw("tarifas");
$tipo = $sf_data->getRaw("tipo");

$data = json_decode($ticket->getCaDatos());
        
for($i=0;$i<$data->norigen;$i++){                        
    $trayectos.=$data->origen->ciudad[$i]." - ".$data->destino->ciudad[$i]." | ";            
}

if($tipo=="interno"){
    $image = "https://www.colsys.com.co/images/logo_colsys.gif";
    $titulo = "Solicitud Tarifas Transporte Internacional: Ticket # ".$ticket->getCaIdticket();
}else{
    $image = "http://www.coltrans.com.co/logosoficiales/coltrans/ColtransSmall.png";
    $titulo = "Solicitud Tarifas Transporte Internacional: Ticket # ".$ticket->getCaIdticket()."<br/>".substr($trayectos,0,-3);
}

//$json = '{"success":true,"idticket":37200,"change":false,"txt":"","tarifas":{"idticket":37200,"origen":{"ciudad":["Alejandr\u00eda","Bogot\u00e1 D.C."],"transporte":["cy","cy"]},"destino":{"ciudad":["Cartagena","Lyttelton"],"transporte":["cy","sd"]},"nproducto":"999996","producto":"non-US Flag US Agricultural Cargoes","panel-carga-checkbox":"on","fcl-checkbox":null,"lcl-checkbox":"on","nimo":["5.1"],"imo":["(5.1) Sustancias oxidantes"],"unname":["444"],"lcl":"puntual","peso-lcl":"456","dimensiones-lcl":"45x456x55454","valor":"3265","moneda":"COP","fchembarque":"2017-02-14","compania":{"tipo":"antiguo","id":"800019615","nombre":"SYMRISE LTDA","antiguo":""},"observaciones":"fasdfasdfasdf","norigen":2,"ndestino":2,"nimos":1,"ncontenedores":null}}';
/*$json = '{"success":true,"idticket":37200,"change":false,"txt":"","tarifas":{"imo": ["(5.2) Peroxidos Organicos."], "lcl": "puntual", "cant": ["5"], "nimo": ["5.2"], "peso": ["5"], "gauge": ["in"], "nimos": 1, "patio": "Buenaventura", "valor": "45", "equipo": ["40 Dry Freight (STD)"], "moneda": "USD", "origen": {"ciudad": ["Bogota D.C.", "Chichina"], "transporte": ["cy", "cy"]}, "unname": ["456"], "destino": {"ciudad": ["San Andres Islas", "Urena"], "transporte": ["cy", "cy"]}, "norigen": 2, "compania": {"id": "800019615", "tipo": "antiguo", "nombre": "SYMRISE LTDA", "antiguo": ""}, "idequipo": ["15"], "idticket": 37210, "ndestino": 2, "peso-lcl": "45", "producto": "Freight All Kind", "frecuencia": ["semanal"], "piezas-lcl": "45", "dimensiones": ["N/A"], "fchembarque": "2017-02-15", "temperatura": [""], "fcl-checkbox": "on", "lcl-checkbox": "on"}}';
$arreglo = json_decode($json,1);
$tarifas = $arreglo["tarifas"];*/

//echo "<pre>";print_r($tarifas);echo "</pre>";

?>
<!--<html>
    <head>
<style>
    table#tarifa{
        width:90%; 
        background-color: #FFFFFF; 
        border: 1px solid #D0D0D0;  
        border-spacing: 1px; 
        border-collapse: separate; 
        padding:2px;                 
    }
    table#tarifa th { 
        margin: 0px;
        padding: 6px 4px 2px 4px; 
        background-color: #E3E3E3;
        text-align: center;        
    }
    
    table#tarifa td { 
        text-align: left;        
    }
    
    th.subtitulo{
        font-size: 10px;
        font-family: verdana,arial,helvetica,serif;
    }
    
</style>
</head>
<body>-->
<!--<table class="tableList" border="1" align="center">
    <tr>
        <th colspan="2" style="padding: 3px;background-color: #FFFFFF !important;">
            <table>
                <tr><td style="border-bottom: 0px;"><table><tr><td style="border-bottom: 0px;"><img src="<?=$image?>" alt="Logo Coltrans"/></td></tr></table></td></tr>
            </table>
        </th>
        <th colspan="8" style="color: #D99324; background: white; font-size: 18px;"><?=$titulo?></th>
    </tr>
    <tr>
        <th colspan="10">INFORMACION GENERAL</th>
    </tr>
    <?
    if ($tipo=="interno"){?>    
        <tr>
            <td colspan="10">
                <b>Reportado por:</b> <?= $ticket->getUsuario() ? $ticket->getUsuario()->getCaNombre() : $ticket->getCaLogin() ?> <?= $ticket->getCaReportedby() ? " por " . $ticket->getCaReportedby() : "" ?><br/>
                <b>Sucursal:</b> <?= utf8_encode($ticket->getUsuario()->getSucursal()->getCaNombre()) ?><br/>
                <b>Extensi&oacute;n:</b> <?= $ticket->getUsuario()->getCaExtension() ?><br/>
                <b>Fecha </b> <?= Utils::fechaMes($ticket->getCaOpened()) ?><br/>        
            </td>
        </tr>
        <?
    }else{
        ?>
        <tr>
            <td style="width:100%" colspan="10">
                Estimado Proveedor:<br/>
                Por favor su colaboración con tarifas para el siguiente embarque:<br/><br/> 
            </td>
        </tr>
        <?
    }
    ?>
    <tr>
        <th colspan="10">DATOS DE LA SOLICITUD</th>
    </tr>
    <?
    if ($tipo=="interno"){?>
        <tr>
            <th colspan="1" style="width:20%; text-align: left;">CLIENTE</th>
            <th colspan="1" style="width:10%; text-align: left;">Tipo</th>
            <td colspan="1" style="width:10%;"><?=$tarifas["compania"]["tipo"]?></td>
            <th colspan="1" style="width:10%; text-align: left;">Nombre</th>
            <td colspan="6" style="width:50%;"><?=$tarifas["compania"]["tipo"]=="antiguo"?strtoupper($tarifas["compania"]["nombre"]):strtoupper($tarifas["compania"]["antiguo"])?></td>
        </tr>
        <?
    }
    ?>
    <tr>
        <th colspan="1" style="width:20%; text-align: left;" rowspan="<?=$tarifas["norigen"]>1?$tarifas["norigen"]+1:2?>">TRAYECTO (S)</th>
        <th colspan="1" style="width:10%;">#</th>
        <th colspan="3" style="width:35%;">ORIGEN</th>
        <th colspan="5" style="width:35%;">DESTINO</th>
    </tr>
    <?
        $ntrayectos = $tarifas["norigen"];
        for($m=0;$m<$ntrayectos;$m++){
            $origen = ($tarifas["origen"]["ciudad"][$m]);
            $exw = $tarifas["origen"]["exw"][$m]?"<br/> Gastos EXW: ".$tarifas["origen"]["recogida"][$m]:"";
            $traorigen = $tarifas["origen"]["transporte"][$m]=="cy"?"Puerto (CY-Container Yard)".$exw:"Puerta (SD-Store Door)".$exw;
            $destino = ($tarifas["destino"]["ciudad"][$m]);
            $tradestino = $tarifas["destino"]["transporte"][$m]=="cy"?"Puerto (CY-Container Yard)":"Puerta (SD-Store Door)";
            ?>
            <tr>
                <td colspan="1" style="width:10%;"><?=$m+1?></td>
                <td colspan="3" style="width:35%;"><?=$origen." - ". $traorigen?></td>
                <td colspan="5" style="width:35%;"><?=$destino." - ". $tradestino?></td>
            </tr>
            <?
        }
    ?>
    <tr>
        <th colspan="1" style="width:20%; text-align: left;" rowspan="<?=$tarifas["panel-carga-checkbox"]=="on"?$tarifas["nimos"]+2:1?>">PRODUCTO</th>
        <th colspan="1" style="width:10%; text-align: left;" class="subtitulo">Descripci&oacute;n</th>
        <td colspan="8" style="width:70%;"><?=$tarifas["producto"]?></td>
    </tr>
    <?
    if($tarifas["panel-carga-checkbox"]=="on"){
        ?>
        <tr>
            <th colspan="1" style="width:10%; text-align: left;" rowspan="<?=$tarifas["nimos"]+1?>">Carga <br/> Peligrosa</th>
            <th colspan="7" style="width:60%;" class="subtitulo">Clase</th>
            <th colspan="1" style="width:10%;" class="subtitulo">UN</th></tr>
            <?
            for($i=0;$i<$tarifas["nimos"];$i++){
                ?>
                <tr>
                    <td colspan="7" style="width:60%;"><?=$tarifas["imo"][$i]?></td>
                    <td colspan="1" style="width:10%;"><?=$tarifas["unname"][$i]?></td>
                </tr>
                <?
            }
    }
    if($tarifas["fcl-checkbox"]=="on" || $tarifas["lcl-checkbox"]=="on"){
        $rowspan = $tarifas["fcl-checkbox"]=="on"?($tarifas["lcl-checkbox"]==on?$tarifas["ncontenedores"]+$tarifas["npiezasLcl"]+2:$tarifas["ncontenedores"]+1):($tarifas["npiezasLcl"]>0?$tarifas["npiezasLcl"]+1:2);        
        $rowspan1 = $tarifas["ncontenedores"]+1;
        $rowspan2 = $tarifas["npiezasLcl"]>0?$tarifas["npiezasLcl"]+1:2;
        //echo $tarifas["npiezasLcl"];
        ?>
        <tr>
            <th colspan="1" style="width:20%; text-align: left;" rowspan="<?=$rowspan?>">MODALIDAD</th>
        <?
        if($tarifas["fcl-checkbox"]=="on"){
            ?>            
            <th colspan="1" style="width:10%; text-align: left;" rowspan="<?=$rowspan1?>">FCL</th>
            <th colspan="1" style="width:5%; " class="subtitulo">Cant.</th>
            <th colspan="2" style="width:20%;" class="subtitulo">Tipo</th>
            <th colspan="1" style="width:8%; " class="subtitulo">Peso</th>
            <th colspan="1" style="width:10%;" class="subtitulo">Frec.</th>
            <th colspan="1" style="width:6%; " class="subtitulo">Temp.</th>
            <th colspan="1" style="width:6%; " class="subtitulo">Gauge</th>
            <th colspan="1" style="width:15%;" class="subtitulo">Dimensiones</th></tr>                                               
            <?
            for($n=0; $n<$tarifas["ncontenedores"]; $n++){
                ?>
                <tr>
                   <td colspan="1" style="width:5%; "><?=$tarifas["cant"][$n]?></td>
                   <td colspan="2" style="width:20%;"><?=$tarifas["equipo"][$n]?></td>
                   <td colspan="1" style="width:8%;"><?=$tarifas["peso"][$n]." Kg"?></td>
                   <td colspan="1" style="width:10%;"><?=$tarifas["frecuencia"][$n]?></td>
                   <td colspan="1" style="width:6%; "><?=$tarifas["temperatura"][$n]!=null?$tarifas["temperatura"][$n]."&#176;C":"N/A"?></td>
                   <td colspan="1" style="width:6%; "><?=$tarifas["gauge"][$n]?></td>
                   <td colspan="1" style="width:15%;"><?=$tarifas["gauge"][$n]=="out"?$tarifas["dimensiones"][$n]:"N/A"?></td>
                </tr>
                <?
            }
        }
        if($tarifas["lcl-checkbox"]=="on"){
            if($tarifas["fcl-checkbox"]=="on"){
                ?>
                <tr>
                <?
            }
            ?>
                <th colspan="1" rowspan="<?=$rowspan2?>" style="width:10%; text-align: left;">LCL</th>
                <th colspan="2" style="width:10%;" class="subtitulo">Tipo</th>
                <th colspan="1" style="width:20%;" class="subtitulo">Piezas</th>
                <th colspan="2" style="width:10%;" class="subtitulo">Peso</th>
                <th colspan="2" style="width:20%;" class="subtitulo">Dimensiones</th>
                <th colspan="1" style="width:10%;" class="subtitulo">Embalaje</th>
            </tr>
            <?
            if($tarifas["lcl"]=="puntual"){
                for($n=0; $n<$tarifas["npiezasLcl"]; $n++){
                    ?>
                    <tr>
                        <td colspan="2" style="width:10%;"><?=$tarifas["lcl"]?></td>
                        <td colspan="1" style="width:20%;"><?=$tarifas["piezas-lcl"][$n]?></td>
                        <td colspan="2" style="width:10%;"><?=$tarifas["peso-lcl"][$n]?></td>
                        <td colspan="2" style="width:20%;"><?=$tarifas["dimensiones-lcl"][$n]?></td>
                        <td colspan="1" style="width:10%;"><?=$tarifas["embalaje"][$n]?></td>
                    </tr>
                    <?
                }
            }else{
                ?>
                <tr>
                    <td colspan="2" style="width:10%;"><?=$tarifas["lcl"]?></td>
                    <td colspan="1" style="width:20%;">N/A</td>
                    <td colspan="2" style="width:10%;">N/A</td>
                    <td colspan="2" style="width:20%;">N/A</td>
                    <td colspan="1" style="width:10%;">N/A</td>
                </tr>
                <?
            }
        }
    }
    ?>                                    
    <tr>
        <th colspan="1" style="width:20%; text-align: left;">ADICIONALES</th>
        <th colspan="1" style="width:10%; text-align: left;">Tarifa requerida</th>
        <td colspan="1" style="width:5%;"><?=$tarifas["moneda"]?>&nbsp;<?=$tarifas["valor"]?></td>
        <th colspan="1" style="width:5%;">Fecha Embarque</th>
        <td colspan="1" style="width:10%;"><?=$tarifas["fchembarque"]?></td>
        <th colspan="2" style="width:20%;">Devoluci&oacute;n del vac&iacute;o</th>
        <td colspan="3" style="width:30%;"><?=$tarifas["fcl-checkbox"]=="on"?$tarifas["patio"]:"N/A"?></td>
    </tr>
    <?
    if ($tipo=="interno"){?>
        <tr>
            <th colspan="1" style="width:20%; text-align: left;">OBSERVACIONES</th>
            <td colspan="9" style="width:80%;"><?=$tarifas["observaciones"]?></td>
        </tr>
        <?
    }
    ?>
</table>
    <?
    if(!$tipo=="interno"){
        ?>
        <br/><br/>
        Cordialmente, <br/><br/>

        Pricing & Procurement<br/>
        <b>COLTRANS S.A.S</b><br/>
        Cra 98 No. 25G-10 Int 18<br/>
        Código postal: 110911<br/>
        TEL:  57 1 742 5880 Ext 1148<br/>        
        Bogota, - Colombia.<br/>
        E-mail : pricing@coltrans.com.co<br/>
        www.coltrans.com.co<br/>
        <?
    }
?>
<!--    </body>
</html>-->

