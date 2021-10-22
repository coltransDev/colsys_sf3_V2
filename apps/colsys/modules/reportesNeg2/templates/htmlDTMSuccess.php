<?
$reporte = $sf_data->getRaw("reporte");
$agencia = $sf_data->getRaw("agencia");

$contacto = Doctrine::getTable("Contacto")->find($reporte->getCaIdconcliente());
$cliente = $contacto->getCliente();


$datos = array();

?>

<table width="100%" border="0" cellspacing="15" cellpadding="0" >
    <tr>
<!--    <td width="50%"><img src="/images/logos/coltrans.jpg11" width="200" height="69"></td>-->
    <td width="50%" style="font-size: 30px;color:#062A7D;text-align: right;font-size: 30px;">
        <b><?=$cliente->getCaCompania (). " (".$cliente->getCaIdalterno()."-".$cliente->getCaDigito().")" ?><br>
        <?=$reporte->getCaConsecutivo()?><br>
        <?=$reporte->getCaImpoexpo()?> - <?=$reporte->getCaTransporte()?><br>
        <?=$reporte->getOrigen()->getCaCiudad ()?> - <?=$reporte->getDestino()->getCaCiudad ()?>
        </b>        
    </td>
    </tr>
</table>

<div align="center" width="100%" style="font-size: 25px;"><b>INFORMACION GENERAL</b></div>
<br>
<table width="90%" border="1" cellspacing="0" cellpadding="0" align="center" >
    
    <tr style="font-size: 18px;background-color:#F0F0F0" >
        <td width="10%" >Modalidad</td>
        <td width="30%">Transportador</td>
        <td width="10%">Despacho</td>
        <td width="13%">Do</td>
        <td width="30%">Agencia Aduanas</td>
        <td width="10%">Comercial</td>        
    </tr>
    <tr style="font-size: 15px;">
        <td><?=$reporte->getCaModalidad()?></td>
        <td><?=($reporte->getIdsProveedor()->getIds()->getCaNombre())?></td>
        <td><?=$reporte->getCaFchdespacho()?></td>
        <td><?=$reporte->getDatosJson("do")?></td>
        <td><?=$agencia->getCaNombre()?></td>
        <td><?=$reporte->getUsuario()->getCaNombre()?></td>
    </tr>
</table>

<br>

<div align="center" width="100%" style="font-size: 25px;"><b>INFORMACION DE LA CARGA</b></div>
<br>
<table width="90%" border="1" cellspacing="0" cellpadding="0" align="center" >    
    <tr style="font-size: 18px;background-color:#F0F0F0" >
        <td width="18%" >Piezas</td>
        <td width="18%">Peso</td>
        <td width="18%">Volumen</td>
        <td width="18%">Valor</td>
        <td width="32%">Doc Transporte</td>
    </tr>
    <tr style="font-size: 15px;">
        <td><?=$reporte->getDatosJson("ca_piezas")?></td>
        <td><?=$reporte->getDatosJson("ca_peso")?></td>
        <td><?=$reporte->getDatosJson("ca_volumen")?></td>
        <td><?=$reporte->getDatosJson("ca_valor")?></td>
        <td><?=$reporte->getDatosJson("ca_doc_transporte")?></td>        
    </tr>
    <tr style="font-size: 18px;background-color:#F0F0F0" >
        <td width="54%">Direccion Recogida</td>
        <td width="53%">Direccion Entrega</td>
    </tr>
    <tr style="font-size: 15px;">        
        <td width="54%"><?=utf8_decode($reporte->getDatosJson("ca_direccion"))?></td>
        <td width="53%"><?=utf8_decode($reporte->getDatosJson("ca_direccion2"))?></td>
    </tr>
    <tr style="font-size: 15px;">        
        <td width="15%" style="font-size: 18px;background-color:#F0F0F0">Descripcion de la Mercancia</td>
        <td width="92%" rowsapn="4"><?=$reporte->getCaMercanciaDesc()?></td>        
    </tr>
    <tr style="font-size: 15px;">
        <td width="15%" style="font-size: 18px;background-color:#F0F0F0">Observaciones</td>
        <td width="92%" rowsapn="4"><?=utf8_decode($reporte->getDatosJson("ca_observaciones"))?></td>
    </tr>
</table>


<div align="center" width="100%" style="font-size: 25px;"><b>INFORMACION DE EQUIPOS</b></div>
<br>

<table width="90%" border="1" cellspacing="0" cellpadding="0" align="center" >    
    <tr style="font-size: 18px;background-color:#F0F0F0" >
        <td width="18%" >Vehiculo</td>
        <td width="18%">Concepto</td>
        <td width="18%">Cantidad</td>
        <td width="18%">Num Contenedor</td>
        <td width="32%">Observaciones</td>
    </tr>
    <?
    $equipos=$reporte->getRepEquipo();
    foreach($equipos as $e)
    {
    ?>
    <tr style="font-size:15px;">
        <td><?=$e->getCaIdvehiculo()?></td>
        <td><?=$e->getCaIdconcepto()?></td>
        <td><?=$e->getCaCantidad()?></td>
        <td><?=$e->getCaIdequipo()?></td>
        <td><?=$e->getCaObservaciones()?></td>
    </tr>
    <?
    }
    ?>
    
    
    
</table>


<div align="center" width="100%" style="font-size: 25px;"><b>TARIFAS</b></div>
<br>

<table width="90%" border="1" cellspacing="0" cellpadding="0" align="center" >    
    <tr style="font-size: 18px;background-color:#F0F0F0" >        
        <td width="39%">Concepto</td>
        <td width="18%">Neta</td>
        <td width="18%">Valor</td>
        <td width="30%">Observaciones</td>
    </tr>
    <?
    
    $tarifas = Doctrine::getTable("Reptarifa")
        ->createQuery("t")
        ->select("t.*")
        ->where("t.ca_idreporte = {$reporte->getCaIdreporte()}  ")
        ->execute();    

    
    foreach($tarifas as $t)
    {
    ?>
    <tr style="font-size:15px;">
        <td><?=$t->getInoConcepto()->getCaConcepto()?></td>
        <td><?=$t->getCaNetaTar()?></td>
        <td><?=$t->getCaCobrarTar()?></td>
        <td><?=$t->getCaObservaciones()?></td>        
    </tr>
    <?
    }
    ?>
    
    
    
</table>


