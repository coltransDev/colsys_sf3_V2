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
    $image = "http://www.coltrans.com.co/logosoficiales/coltrans/ColtransSmall.png";
    $titulo = "Solicitud Tarifas Transporte Internacional: Ticket # ".$ticket->getCaIdticket()."<br/>".substr($trayectos,0,-3);
}

?>
<html>
    <body>
        <table class="tableList" border="1" align="center">
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
                <tr>
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
            <tr>
                <th colspan="10">DATOS DE LA SOLICITUD</th>
            </tr>
            <?
            if ($tipo=="interno"){?>
                <tr>
                    <th colspan="1" style="width:20%; text-align: center;">CLIENTE</th>
                    <th colspan="1" style="width:10%; text-align: center;">Tipo</th>
                    <td colspan="1" style="width:10%;"><?=$solicitud["compania"]["tipo"]?></td>
                    <th colspan="1" style="width:10%; text-align: center;">Nombre</th>
                    <td colspan="6" style="width:50%;"><?=$solicitud["compania"]["tipo"]=="antiguo"?strtoupper($solicitud["compania"]["nombre"]):strtoupper($solicitud["compania"]["antiguo"])?></td>
                </tr>
                <?
            }
            ?>
            <tr>
                <th colspan="1" style="width:20%; text-align: center;" rowspan="<?=$solicitud["norigen"]>1?$solicitud["norigen"]+1:2?>">TRAYECTO (S)</th>
                <th colspan="1" style="width:10%; text-align: center;">#</th>
                <th colspan="3" style="width:35%; text-align: center;">ORIGEN</th>
                <th colspan="5" style="width:35%; text-align: center;">DESTINO</th>
            </tr>
            <?
                $ntrayectos = $solicitud["norigen"];                
                for($m=0;$m<$ntrayectos;$m++){            
                    $origen = ($solicitud["trayecto"]["origen"]["ciudad"][$m]);
                    $exw = $solicitud["trayecto"]["origen"]["exw"][$m]?"<br/><br/> Dirección de Recogida: ".$solicitud["trayecto"]["origen"]["recogida"][$m]:"";
                    $traorigen = $solicitud["trayecto"]["origen"]["transporte"][$m]=="cy"?"Puerto (CY-Container Yard)".$exw:"Puerta (SD-Store Door)".$exw;
                    $destino = ($solicitud["trayecto"]["destino"]["ciudad"][$m]);
                    $tradestino = $solicitud["trayecto"]["destino"]["transporte"][$m]=="cy"?"Puerto (CY-Container Yard)":"Puerta (SD-Store Door)";
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
                <th colspan="1" style="width:20%; text-align: center;" rowspan="<?=$solicitud["checkbox"]["panel-carga-checkbox"]=="on"?$solicitud["nimos"]+2:1?>">PRODUCTO</th>
                <th colspan="1" style="width:10%; text-align: center;" class="subtitulo">Descripci&oacute;n</th>
                <td colspan="8" style="width:70%;"><?=$solicitud["producto"]["nombre"]?></td>
            </tr>
            <?
            if($solicitud["checkbox"]["panel-carga-checkbox"]=="on"){
                ?>
                <tr>
                    <th colspan="1" style="width:10%; text-align: center;" rowspan="<?=$solicitud["nimos"]+1?>">Carga <br/> Peligrosa</th>
                    <th colspan="7" style="width:60%;" class="subtitulo">Clase</th>
                    <th colspan="1" style="width:10%;" class="subtitulo">UN</th></tr>
                    <?
                    for($i=0;$i<$solicitud["nimos"];$i++){
                        ?>
                        <tr>
                            <td colspan="7" style="width:60%;"><?=$solicitud["producto"]["imo"][$i]?></td>
                            <td colspan="1" style="width:10%;"><?=$solicitud["producto"]["unname"][$i]?></td>
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
                <tr>
                    <th colspan="1" style="width:20%; text-align: center;" rowspan="<?=$rowspan?>">MODALIDAD</th>
                <?
                if($solicitud["checkbox"]["fcl-checkbox"]=="on"){
                    ?>            
                    <th colspan="1" style="width:10%; text-align: center;" rowspan="<?=$rowspan1?>">FCL</th>
                    <th colspan="1" style="width:5%; " class="subtitulo">Cant.</th>
                    <th colspan="2" style="width:20%;" class="subtitulo">Tipo</th>
                    <th colspan="1" style="width:8%; " class="subtitulo">Peso</th>
                    <th colspan="1" style="width:10%;" class="subtitulo">Frec.</th>
                    <th colspan="1" style="width:6%; " class="subtitulo">Temp.</th>
                    <th colspan="1" style="width:6%; " class="subtitulo">Gauge</th>
                    <th colspan="1" style="width:15%;" class="subtitulo">Dimensiones</th></tr>                                               
                    <?
                    for($n=0; $n<$solicitud["ncontenedores"]; $n++){
                        ?>
                        <tr>
                           <td colspan="1" style="width:5%; "><?=$solicitud["fcl"]["cant"][$n]?></td>
                           <td colspan="2" style="width:20%;"><?=$solicitud["fcl"]["equipo"][$n]?></td>
                           <td colspan="1" style="width:8%;"><?=number_format($solicitud["fcl"]["peso"][$n],2,",",".")." Kg"?></td>
                           <td colspan="1" style="width:10%;"><?=$solicitud["fcl"]["frecuencia"][$n]?></td>
                           <td colspan="1" style="width:6%; "><?=$solicitud["fcl"]["temperatura"][$n]!=null?$solicitud["fcl"]["temperatura"][$n]."&#176;C":"N/A"?></td>
                           <td colspan="1" style="width:6%; "><?=$solicitud["fcl"]["gauge"][$n]?></td>
                           <td colspan="1" style="width:15%;"><?=$solicitud["fcl"]["gauge"][$n]=="out"?$solicitud["fcl"]["dimensiones"][$n]:"N/A"?></td>
                        </tr>
                        <?
                    }
                }
                if($solicitud["checkbox"]["lcl-checkbox"]=="on"){
                    if($solicitud["checkbox"]["fcl-checkbox"]=="on"){
                        ?>
                        <tr>
                        <?
                    }
                    ?>
                        <th colspan="1" rowspan="<?=$rowspan2?>" style="width:10%; text-align: center;">LCL</th>
                        <th colspan="2" style="width:10%;" class="subtitulo">Tipo</th>
                        <th colspan="1" style="width:20%;" class="subtitulo">Piezas</th>
                        <th colspan="2" style="width:10%;" class="subtitulo">Peso</th>
                        <th colspan="2" style="width:20%;" class="subtitulo">Dimensiones</th>
                        <th colspan="1" style="width:10%;" class="subtitulo">Embalaje</th>
                    </tr>
                    <?
                    if($solicitud["lcl"]["tipo"]=="puntual"){
                        for($n=0; $n<$solicitud["npiezasLcl"]; $n++){
                            ?>
                            <tr>
                                <td colspan="2" style="width:10%;"><?=$solicitud["lcl"]["tipo"]?></td>
                                <td colspan="1" style="width:20%;"><?=$solicitud["lcl"]["piezas-lcl"][$n]?></td>
                                <td colspan="2" style="width:10%;"><?=number_format($solicitud["lcl"]["peso-lcl"][$n],2,",",".")." Kg"?></td>
                                <td colspan="2" style="width:20%;"><?=$solicitud["lcl"]["dimensiones-lcl"][$n]?></td>
                                <td colspan="1" style="width:10%;"><?=$solicitud["lcl"]["embalaje"][$n]?></td>
                            </tr>
                            <?
                        }
                    }else{
                        ?>
                        <tr>
                            <td colspan="2" style="width:10%;"><?=$solicitud["lcl"]["tipo"]?></td>
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
                <th colspan="1" style="width:20%; text-align: center;">ADICIONALES</th>
                <th colspan="2" style="width:10%; text-align: center;">Tarifa requerida</th>
                <td colspan="1" style="width:5%;"><?=$solicitud["generales"]["moneda"]?>&nbsp;<?=number_format($solicitud["generales"]["valor"],2,",",".")?></td>
                <th colspan="1" style="width:5%;">Fecha Embarque</th>
                <td colspan="1" style="width:10%;"><?=$solicitud["generales"]["fchembarque"]?></td>
                <th colspan="2" style="width:20%;">Devoluci&oacute;n del vac&iacute;o</th>
                <td colspan="2" style="width:30%;"><?=$solicitud["fcl"]["fcl-checkbox"]=="on"?$solicitud["generales"]["patio"]:"N/A"?></td>
            </tr>
            <?
            if ($tipo=="interno"){?>
                <tr>
                    <th colspan="1" style="width:20%; text-align: center;">OBSERVACIONES</th>
                    <td colspan="9" style="width:80%;"><?=$solicitud["generales"]["observaciones"]?></td>
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
                TEL:  57 1 4239300 Ext 148<br/>
                FAX:  57 1 4239323 Ext. 148<br/>
                Bogota, - Colombia.<br/>
                E-mail : pricing@coltrans.com.co<br/>
                www.coltrans.com.co<br/>
                <?
            }
        ?>
    </body>
</html>