<?php


?>
<html>
    <body>
<style type="text/css" >

        img.img{
            border: 0px;
        }



        a.link:link {
           text-decoration:none;
           color:#0000FF;
        }
        a.link:active {
           text-decoration:none;
           color:#0000FF;
        }
        a.link:visited {
           text-decoration: none;
           color: #062A7D;
        }

        .entry {
            border-bottom: 1px solid #DDDDDD;
            clear:both;
            padding: 0 0 10px;
        }


        .entry-even {
            background-color:#F6F6F6;
            border-color:#CCCCCC;
            border-style:dotted;
            border-width:1px ;
            margin:12px 0 0;
            padding:12px 12px 24px;
            font-size: 12px;
            font-family: arial, helvetica, sans-serif;

        }

        .entry-odd {
            background-color:#FFFFFF;
            border-color:#CCCCCC;
            border-style:dotted;
            border-width:1px ;
            margin:12px 0 0;
            padding:12px 12px 24px;
            font-size: 12px;
            font-family: arial, helvetica, sans-serif;

        }

        .entry-yellow {
            background-color:#FFFFCC;
            border-color:#CCCCCC;
            border-style:dotted;
            border-width:1px ;
            margin:12px 0 0;
            padding:12px 12px 24px;
            font-size: 12px;
            font-family: arial, helvetica, sans-serif;

        }
        .entry-date{
            float: right;
            color: #0464BB;
        }
    </style>

<div class="commentlist">
<?
    $seguimientos = $sf_data->getRaw("seguimientos");
    $mantenimientos = $sf_data->getRaw("mantenimientos");
    $i=0;
    foreach( $seguimientos as $seguimiento ){
        if($seguimiento&&$i==0){
        ?>
            <b><font color="blue">Seguimientos:</font></b>
        <?
        }
        ?>
        <div class="entry-<?=$i++%2==0?"even":"odd"?>">
            <div class="entry-date"><?=Utils::fechaMes($seguimiento->getCaFchcreado())?></div>
            <b><?=($seguimiento->getUsuario()?$seguimiento->getUsuario()->getCaNombre():$seguimiento->getCaUsucreado())?></b>
            <br /><br />
            <?=str_replace("\n","<br />",$seguimiento->getCaText())?>
        </div><br /><br />
    <?
    }
    $i=0;
    foreach( $mantenimientos as $mantenimiento ){
        if($mantenimiento&&$i==0){
    ?>
        <b><font color="blue">Mantenimientos:</font></b>
    <?
        }
        $activo = $mantenimiento->getInvActivo()->getCaIdentificador();
        $marca = $mantenimiento->getInvActivo()->getCaMarca();
        $modelo = $mantenimiento->getInvActivo()->getCaModelo();
        $asignacion = $mantenimiento->getInvActivo()->getUsuario()->getCaNombre();
        $fchmantenimiento = Utils::fechaLarga($mantenimiento->getCaFchmantenimiento());
        $observaciones = str_replace("\n","<br />",$mantenimiento->getCaObservaciones());
        $fchfirma = $mantenimiento->getCaFchfirma();
        $firma = $mantenimiento->getUsuFirma()->getCaNombre();
        $firmado = $mantenimiento->getCaFirmado();
        
    
    ?>
        <div class="entry-<?=$i++%2==0?"even":"odd"?>">
        <div class="entry-date"><?=Utils::fechaMes($mantenimiento->getCaFchcreado())?></div>
        <b><?=($mantenimiento->getUsuario()?$mantenimiento->getUsuario()->getCaNombre():$mantenimiento->getCaUsucreado())?></b><br /><br />
        
        El día <b><?=$fchmantenimiento?></b> se efectuó Mantenimiento Preventivo en el siguiente equipo: <br /><br />
        Activo: <b><?=$activo?> - <?=$marca?> - <?=$modelo?></b><br />
        Asignado a: <b><?=$asignacion?></b><br /><br />
    <? 
        $labores =$mantenimiento->getInvMantenimientoLabores();
        $j = 1;
        foreach($labores as $labor){
            if($labor &&$j==1){
    ?>
                Labores realizadas: <br />
    <?
            }
            $etapas = $labor->getInvMantenimientoEtapas()->getCaEtapa();
            echo '  '.$j.'.  '.$etapas.'<br />';
            $j++;
        }
        if($observaciones){
    ?>
        <br />Por favor tener en cuenta las siguientes observaciones:<br /><br />
    <?
        echo '-'.$observaciones;                  
        }
    ?>  
        <br /><br />
        
        <small><b>Firmado por: <?if($firmado=="firmado"){?><font color="blue"><?=$firma?></font><?}elseif($firmado=="noaceptado"){?><font color="red"><?=$firma.' (No aceptado)'?></font><?}else{echo "Este documento aún no se firmado";}?></b></small><br />
        <small><b><?if($firmado){?>Fecha: <?=$fchfirma?$fchfirma:""?><?}?></b></small>
        </div>
    <?

}
?>
</div>
    </body>
    </html    >