<?
$ticket = $sf_data->getRaw("ticket");
$tarifas = $sf_data->getRaw("tarifas");
$tipo = $sf_data->getRaw("tipo");

$solicitud = $tarifas["solicitud"];

$data = json_decode($ticket->getCaDatos());
        
for($i=0;$i<$data->solicitud->norigen;$i++){            
    $trayectos.=$data->solicitud->trayecto->origen->ciudad[$i]." - ".$data->solicitud->trayecto->destino->ciudad[$i]." | ";            
}

if($tipo=="interno"){
    $image = "https://www.colsys.com.co/images/logo_colsys.gif";
    $titulo = "Solicitud Tarifas Transporte Internacional: Ticket # ".$ticket->getCaIdticket();
}else{
    $image = "https://www.coltrans.com.co/logosoficiales/coltrans/ColtransSmall.png";
    $titulo = "Solicitud Tarifas Transporte Internacional: Ticket # ".$ticket->getCaIdticket()."<br/>".substr($trayectos,0,-3);
}

$background = $tipo==="interno"?null:'style="background-color:#E3E3E3;"';

?>
<html>
    <body>
        <table class="tableList" border="1" align="center" style="width: 100%" id="tarifa">
            <tr>
                <th colspan="2" style="padding: 3px;" align="center">
                    <table style="padding: 3px; width: 70%">
                        <tr><td><img src="<?=$image?>"/></td></tr>
                    </table>
                </th>
                <th colspan="8" style="color: #103383; font-weight: bold;" ><?=$titulo?></th>
            </tr>            
            <?
            if ($tipo=="interno"){?>    
                <tr >
                    <th colspan="10">INFORMACION GENERAL</th>
                </tr>
                <tr>
                    <td colspan="10">
                        <b>Reportado por:</b> <?= $ticket->getUsuario() ? $ticket->getUsuario()->getCaNombre() : $ticket->getCaLogin() ?> <?= $ticket->getCaReportedby() ? " por " . $ticket->getCaReportedby() : "" ?><br/>
                        <b>Sucursal:</b> <?= $ticket->getUsuario()->getSucursal()->getCaNombre() ?><br/>
                        <b>Extensi&oacute;n:</b> <?= $ticket->getUsuario()->getCaExtension() ?><br/>
                        <b>Fecha </b> <?= Utils::fechaMes($ticket->getCaOpened()) ?><br/>        
                    </td>
                </tr>
                <?
            }
            ?>
                <tr <?=$background?>>
                <th colspan="10">DATOS DE LA SOLICITUD</th>
            </tr>
            <?
            if ($tipo=="interno"){?>
                <tr><th colspan="10" style="width:100%; text-align: center;">CLIENTE</th></tr>                
                <tr>
                    <th colspan="2" style="width:10%; text-align: center;">Tipo</th>
                    <th colspan="8" style="width:90%; text-align: center;">Nombre</th>
                </tr>
                <tr>
                    <td colspan="2" style="width:10%; text-align: center;"><?=$solicitud["compania"]["tipo"]?></td>                    
                    <td colspan="8" style="width:90%; text-align: center;"><?=$solicitud["compania"]["tipo"]=="antiguo"?strtoupper(utf8_decode($solicitud["compania"]["nombre"])):strtoupper(utf8_decode($solicitud["compania"]["antiguo"]))?></td>
                </tr>
                <?
            }
            ?>
            <tr <?=$background?>>
                <th colspan="10" style="width:100%; text-align: center;" rowspan="<?//=$solicitud["norigen"]>1?$solicitud["norigen"]+1:2?>">TRAYECTO (S)</th></tr>
                <tr <?=$background?>><th colspan="2" style="width:10%; text-align: center;">#</th>
                <th colspan="4" style="width:45%; text-align: center;">ORIGEN</th>
                <th colspan="4" style="width:45%; text-align: center;">DESTINO</th>
            </tr>
            <?
                $ntrayectos = $solicitud["norigen"];                
                for($m=0;$m<$ntrayectos;$m++){            
                    $origen = utf8_decode($solicitud["trayecto"]["origen"]["ciudad"][$m]);
                    $exw = $solicitud["trayecto"]["origen"]["exw"][$m]?"<br/><br/> Dirección de Recogida: ".utf8_decode($solicitud["trayecto"]["origen"]["recogida"][$m]):"";
                    $traorigen = $solicitud["trayecto"]["origen"]["transporte"][$m]=="cy"?"Puerto (CY-Container Yard)".$exw:"Puerta (SD-Store Door)".$exw;
                    $destino = utf8_decode($solicitud["trayecto"]["destino"]["ciudad"][$m]);
                    $ent = $solicitud["trayecto"]["destino"]["ent"][$m]?"<br/><br/> Dirección de Entrega: ".utf8_decode($solicitud["trayecto"]["destino"]["entrega"][$m]):"";                    
                    $tradestino = $solicitud["trayecto"]["destino"]["transporte"][$m]=="cy"?"Puerto (CY-Container Yard)":"Puerta (SD-Store Door)".$ent;                    
                    ?>
                    <tr>
                        <td colspan="2" style="width:10%; text-align: center;"><?=$m+1?></td>
                        <td colspan="4" style="width:45%; text-align: center;"><?=$origen." - ". $traorigen?></td>
                        <td colspan="4" style="width:45%; text-align: center;"><?=$destino." - ". $tradestino?></td>
                    </tr>
                    <?
                }
            ?>
            <tr <?=$background?>>
                <th colspan="10" style="width:100%; text-align: center;">PRODUCTO</th>
            </tr>
            <tr>
                <td colspan="10" style="width:100%; text-align: center;"><?= utf8_decode($solicitud["producto"]["nombre"])?></td>
            </tr>
            <?
            if($solicitud["checkbox"]["panel-carga-checkbox"]=="on"){
                ?>
                <tr <?=$background?>>
                    <th colspan="1" style="width:10%; text-align: center;" rowspan="<?=$solicitud["nimos"]+1?>">Carga <br/> Peligrosa</th>
                    <th colspan="7" style="width:70%;" class="subtitulo">Clase</th>
                    <th colspan="2" style="width:20%;" class="subtitulo">UN</th>
                </tr>
                <?
                for($i=0;$i<$solicitud["nimos"];$i++){
                    ?>
                    <tr>
                        <td colspan="7" style="width:70%;"><?= utf8_decode($solicitud["producto"]["imo"][$i])?></td>
                        <td colspan="2" style="width:20%;"><?=$solicitud["producto"]["unname"][$i]?></td>
                    </tr>
                    <?
                }
            }
           if($solicitud["checkbox"]["fcl-checkbox"]=="on" || $solicitud["checkbox"]["lcl-checkbox"]=="on"){
                $rowspan = $solicitud["checkbox"]["fcl-checkbox"]=="on"?($solicitud["checkbox"]["lcl-checkbox"]==on?$solicitud["ncontenedores"]+$solicitud["npiezasLcl"]+2:$solicitud["ncontenedores"]+1):($solicitud["npiezasLcl"]>0?$solicitud["npiezasLcl"]+1:2);        
                $rowspan1 = $solicitud["ncontenedores"]+1;
                $rowspan2 = $solicitud["npiezasLcl"]>0?$solicitud["npiezasLcl"]+1:2;
                //echo $solicitud["npiezasLcl"];
                ?>
                <tr <?=$background?>>
                    <th colspan="10" style="width:100%; text-align: center;" rowspan="<?//=$rowspan?>">MODALIDAD</th></tr>
                <?
                if($solicitud["checkbox"]["fcl-checkbox"]=="on"){
                    ?>            
                    <tr <?=$background?>>
                        <th colspan="1" style="width:10%; text-align: center;" rowspan="<?=$rowspan1?>">FCL</th>
                        <th colspan="1" style="width:5%; " class="subtitulo">Cant.</th>
                        <th colspan="2" style="width:20%;" class="subtitulo">Tipo</th>
                        <th colspan="1" style="width:18%; " class="subtitulo">Peso</th>
                        <th colspan="1" style="width:10%;" class="subtitulo">Frec.</th>
                        <th colspan="1" style="width:6%; " class="subtitulo">Temp.</th>
                        <th colspan="1" style="width:6%; " class="subtitulo">Gauge</th>
                        <th colspan="2" style="width:25%;" class="subtitulo">Dimensiones</th>
                    </tr>                                               
                    <?
                    for($n=0; $n<$solicitud["ncontenedores"]; $n++){
                        ?>
                        <tr>
                           <td colspan="1" style="width:5%;  text-align: center;"><?=$solicitud["fcl"]["cant"][$n]?></td>
                           <td colspan="2" style="width:20%; text-align: center;"><?=$solicitud["fcl"]["equipo"][$n]?></td>
                           <td colspan="1" style="width:18%;  text-align: center;"><?=number_format($solicitud["fcl"]["peso"][$n],2,",",".")." Kg"?></td>
                           <td colspan="1" style="width:10%; text-align: center;"><?=$solicitud["fcl"]["frecuencia"][$n]?></td>
                           <td colspan="1" style="width:6%;  text-align: center;"><?=$solicitud["fcl"]["temperatura"][$n]!=null?$solicitud["fcl"]["temperatura"][$n]."&#176;C":"N/A"?></td>
                           <td colspan="1" style="width:6%;  text-align: center;"><?=$solicitud["fcl"]["gauge"][$n]?></td>
                           <td colspan="2" style="width:25%; text-align: center;"><?=$solicitud["fcl"]["gauge"][$n]=="out"?$solicitud["fcl"]["dimensiones"][$n]." ".utf8_decode($solicitud["fcl"]["unidades"][$n]):"N/A"?></td>
                        </tr>
                        <?
                    }
                }
                if($solicitud["checkbox"]["lcl-checkbox"]=="on"){
                    $tipocarga = $solicitud["tipocarga"]?$solicitud["tipocarga"]:"lcl";
//                    echo $tipocarga;
                    /*if($solicitud["checkbox"]["fcl-checkbox"]=="on"){
                        ?>
                        <tr>
                        <?
                    }*/
                    ?>
                    <tr <?=$background?>>
                        <th colspan="1" rowspan="<?=$rowspan2?>" style="width:10%; text-align: center;"><?=$tipocarga=="lcl"?"LCL":"BREAK BULK"?></th>
                        <th colspan="2" style="width:10%;" class="subtitulo">Tipo</th>
                        <th colspan="1" style="width:20%;" class="subtitulo">Piezas</th>
                        <th colspan="2" style="width:20%;" class="subtitulo">Peso</th>
                        <th colspan="2" style="width:20%;" class="subtitulo">Dimensiones</th>
                        <th colspan="2" style="width:20%;" class="subtitulo">Embalaje</th>
                    </tr>
                    <?
                    //if($solicitud["lcl"]["tipo"]=="puntual"){
                        for($n=0; $n<$solicitud["npiezasLcl"]; $n++){
                            ?>
                            <tr>
                                <td colspan="2" style="width:10%;"><?=$solicitud[$tipocarga]["tipo"]?></td>
                                <td colspan="1" style="width:20%;"><?=$solicitud[$tipocarga]["piezas-lcl"][$n]?></td>
                                <td colspan="2" style="width:20%;"><?=number_format($solicitud[$tipocarga]["peso-lcl"][$n],2,",",".")." Kg"?></td>
                                <td colspan="2" style="width:20%;"><?=$solicitud[$tipocarga]["dimensiones-lcl"][$n]." ".utf8_decode($solicitud[$tipocarga]["unidades-lcl"][$n])?></td>
                                <td colspan="2" style="width:20%;"><?=$solicitud[$tipocarga]["embalaje"][$n]?></td>
                            </tr>
                            <?
                        }
                    /*}else{
                        ?>
                        <tr>
                            <td colspan="2" style="width:10%;"><?=$solicitud["lcl"]["tipo"]?></td>
                            <td colspan="1" style="width:20%;">N/A</td>
                            <td colspan="2" style="width:20%;">N/A</td>
                            <td colspan="2" style="width:20%;">N/A</td>
                            <td colspan="2" style="width:20%;">N/A</td>
                        </tr>
                        <?
                    }*/
                    }
                }
            ?>                                    
            <tr <?=$background?>>
                <th colspan="10" style="width:100%; text-align: center;">ADICIONALES</th>
            </tr>
            <tr <?=$background?>>
                <th colspan="3" style="width:30%; text-align: center;">Tarifa requerida</th>
                <th colspan="3" style="width:30%;">Fecha Embarque</th>
                <th colspan="4" style="width:40%;">Devoluci&oacute;n del vac&iacute;o</th>
            </tr>
            <tr>
                <td colspan="3" style="width:30%;"><?=$solicitud["generales"]["moneda"]?>&nbsp;<?=number_format($solicitud["generales"]["valor"],2,",",".")?></td>                
                <td colspan="3" style="width:30%;"><?=$solicitud["generales"]["fchembarque"]?></td>                
                <td colspan="4" style="width:40%;"><?=$solicitud["fcl"]["fcl-checkbox"]=="on"?$solicitud["generales"]["patio"]:"N/A"?></td>
            </tr>
            <?
            if ($tipo=="interno"){?>
                <tr>
                    <th colspan="1" style="width:20%; text-align: center;">TIPO DE COTIZACI&Oacute;N</th>
                    <td colspan="9" style="width:80%;"><?= $solicitud["generales"]["tipocot"]=="velocidad"?"La mas rápida que se obtenga (velocidad)":"La mejor tarifa (después de recibir por lo menos dos opciones de naviera y/o coloader)"?></td>
                </tr>
                <tr>
                    <th colspan="1" style="width:20%; text-align: center;">OBSERVACIONES</th>
                    <td colspan="9" style="width:80%;"><?= utf8_decode($solicitud["generales"]["observaciones"])?></td>
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
    </body>
</html>