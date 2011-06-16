<?
$user = $sf_data->getRaw("user");
$status = $sf_data->getRaw("status");
$etapa = $sf_data->getRaw("etapa");
?>

<div class="htmlContent">
<?
$reporte = $status->getReporte();
$cliente = $reporte->getCliente();

?>

<div align="center"><h3><?=($etapa&&$etapa->getCaTitle())?$etapa->getCaTitle():"SEGUIMIENTO DE CARGA"?></h3></div>

<div align="left">
	

	Señores:<br />
	<b>
	<?=strtoupper($cliente->getCaCompania())?>
	</b><br />
	<br />
	
	<br />
	<?=$status->getCaIntroduccion()?>
	<br />
	<br />
	<table width="100%" cellspacing="0" border="1" class="tableList">
	<tr>
		<td width="13%"><b>Orden:</b></td>
		<td ><?=$reporte->getCaOrdenClie()?></td>
		<td><b>T&eacute;rmino de Negociaci&oacute;n:</b></td>
		<td>
		<?
		$array = explode("|",$reporte->getCaIncoterms());
		$array = array_unique( $array );
		$incoterms = implode(" ", $array );
		echo $incoterms;
		?>
		</td>
        <?
        //Ticket # 938
        ?>
        <td><b>Cotizaci&oacute;n:</b></td>
		<td>
		<?=$reporte->getCaIdcotizacion()?$reporte->getCaIdcotizacion():"&nbsp;"?>
		</td>
	</tr>
	<tr>
		<td><b>Proveedor:</b></td>
		<td colspan="3"><?=$reporte->getProveedoresStr()?></td>
		<td width="20%"><b><?=$reporte->getCaOrdenProv()?"Orden Proveedor":"&nbsp;"?></b></td>
		<td width="22%"><?=$reporte->getCaOrdenProv()?$reporte->getCaOrdenProv():"&nbsp;"?></td>
	</tr>
	
	<tr>
		<td><b>Origen:</b></td>
		<td width="13%"><?=$reporte->getOrigen()->getCaCiudad()?></td>
		<td width="15%"><b>Fch.Salida:</b></td>
		<td width="17%"><?=$status->getCaFchsalida()?$status->getCaFchsalida()." ".$status->getCaHorasalida():"&nbsp;"?></td>
		<td><b><?=$reporte->getCaTransporte()==Constantes::MARITIMO?"Motonave:":"Vuelo:"?></b></td>
		<td><?=$status->getCaIdnave()?></td>
	</tr>
	<tr>
		<td><b>Destino:</b></td>
		<td><?=$reporte->getDestino()->getCaCiudad()?></td>
		<td><b><?=$etapa->getCaDepartamento()=="Tráficos"?"Fch. Estimada de Llegada:":"Fch.Llegada:" //ticket #4032?></b></td>
		<td><?=$status->getCaFchllegada()?$status->getCaFchllegada():"&nbsp;"?></td>		
		<td>&nbsp;</td>		
		<td>&nbsp;</td>
	</tr>
	<?				
	if( $reporte->getCaContinuacion()!="N/A" && $reporte->getCaImpoexpo()!=Constantes::EXPO ){
	?>
	<tr>
		<td><b>Destino:</b></td>
		<td><?=$reporte->getCaContinuacion()." -> ".$reporte->getDestinoCont()?>	</td>
		<td><b><?=$etapa->getCaDepartamento()=="Tráficos"?"Fch. Estimada de Llegada:":"Fch.Llegada:"?></b></td>
		<td><?=$status->getCaFchcontinuacion()?$status->getCaFchcontinuacion():"&nbsp;"?></td>		
		<td>&nbsp;</td>		
		<td>&nbsp;</td>
	</tr>
	<?
	}
	?>	
	<tr>
		<td><b>No.Piezas:</b></td>
		<td><?=$status->getCaPiezas()?str_replace("|", " ", $status->getCaPiezas()):"&nbsp;"?></td>
		<td><b>Peso:</b></td>
		<td><?=$status->getCaPeso()?str_replace("|", " ",$status->getCaPeso()):"&nbsp;"?></td>
		<td><b>Volumen:</b></td>
		<td><?=$status->getCaVolumen()?str_replace("|", " ",$status->getCaVolumen()):"&nbsp;"?></td>
	</tr>
	<tr>
		<td><b><?=$reporte->getCaTransporte()==Constantes::MARITIMO?"HBL:":"HAWB:"?></b></td>
		<td><?=$status->getCaDoctransporte()?$status->getCaDoctransporte():"&nbsp;"?></td>
		<td><?=$reporte->getCaModalidad()=="FCL"&&$status->getCaDocmaster()?"<b>Master:</b>":"&nbsp;"?></td>
		<td><?=$reporte->getCaModalidad()=="FCL"&&$status->getCaDocmaster()?$status->getCaDocmaster():"&nbsp;"?></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
    <?
    if($reporte->getCaTransporte()==Constantes::AEREO && ($reporte->getCaImpoexpo()==Constantes::IMPO||$reporte->getCaImpoexpo()==Constantes::TRIANGULACION)){
        //Ticket # 1921
        $bodega2 = Doctrine::getTable("Bodega")->find( $reporte->getCaIdbodega() );
        if(!$bodega2)
            $bodega2 = new Bodega();
    ?>
    <tr>
		<td><b>Trasladar a:</b></td>
		<td colspan="5"><?=$bodega2->getCaTipo()!=$bodega2->getCaNombre()?$bodega2->getCaTipo()." ".$bodega2->getCaNombre():$bodega2->getCaTipo()?></td>
	</tr>
    <?
    }
    ?>
	<tr>
		<td><b>Mercanc&iacute;a</b></td>
		<td colspan="5"><?=$reporte->getCaMercanciaDesc()?> <?=($reporte->getCaMciaPeligrosa())?"<br><b>Mercacia Peligrosa</b>":""?></td>
	</tr>
	<?
	$inoCliente = $reporte->getInoClientesSea();
	if( $inoCliente ){		
        $fchfinmuisca=$inoCliente->getInoMaestraSea()->getCaFchfinmuisca();
	?>
	<tr>
		<td><b>Referencia</b></td>
		<td colspan="<?=((!$fchfinmuisca)?"5":"") ?>"><?=$inoCliente->getCaReferencia()?></td>
        <?
        if($fchfinmuisca)
        {
        ?>
        <td>Fecha Finalizaci&oacute;n MUISCA</td>
        <td colspan="3"><?=$fchfinmuisca?></td>
        <?
        }
        ?>
	</tr>
    <?
    }
    if($reporte->getCaImpoexpo()==Constantes::EXPO){
        $repexpo = $reporte->getRepexpo();
        if( $repexpo->getCaInspeccionFisica()!==null ){
    ?>
    <tr>
		<td><b>Inspección Fisica</b></td>
		<td colspan="5"><?=$repexpo->getCaInspeccionFisica()?"Sí":"No"?></td>
	</tr>    

	<?
        }

        if( $reporte->getCaTransporte()==Constantes::MARITIMO && $status->getCaIdetapa()=="EEETD" ) {
        ?>
        <tr>
            <td><b>Emisi&oacute;n BLs:</b></td>
            <td colspan="5"><?=$repexpo->getCaEmisionbl()?></td>
        </tr>
        <?
        }

        if( $reporte->getCaTransporte()==Constantes::MARITIMO && $status->getCaIdetapa()=="EEETD" ) {
        ?>
        <tr>
            <td><b>DATOS EN DESTINO PARA RECLAMAR BLs:</b></td>
            <td colspan="5"><?=nl2br($repexpo->getCaDatosbl())?></td>
        </tr>
        <?
        }

	}
	$bodega =  $status->getBodega();
	if($bodega){
	?>
	<tr>
		<td><b>Bodega</b></td>
		<td colspan="5"><?=$bodega->getCaNombre()?></td>
	</tr>
	<?	
	}
	
	if( $reporte->getCaSeguro()== "Sí"){
	?>
		<tr>
			<td><strong>Carga Asegurada:</strong></td>
			<td colspan="5"><?=Utils::replace($reporte->getCaSeguro())?></td>	
		</tr>
	<?	
	}
	
	if ( $reporte->getCaColmas()== "Sí" && $reporte->getCaImpoexpo()!=Constantes::EXPO) {
	?>
		<tr>
			<td><strong>Nacionalización Colmas Ltda:</strong></td>
			<td colspan="5"><?=Utils::replace($reporte->getCaColmas())?></td>
		</tr> 
	<?	
	}
		
	
	if( $reporte->getCaModalidad()=="FCL" ){
		if( $inoCliente ){		
			$referencia = $inoCliente->getInoMaestraSea();
			$equipos = $referencia->getInoEquiposSea();
			?>
			<tr>
				<td colspan="6">
					<table width="100%" cellspacing="0" border="1" class="tableList">
						<tr>
							<th colspan="4">Relación de Contenedores</th>
						</tr>
						<tr>
							<th>Concepto</th>
							<th>Cantidad</th>
							<th>ID Equipo</th>
							<th>Observaciones</th>
						</tr>
						<?				
						foreach( $equipos as $equipo ){
						?>
						<tr>
							<td><?=$equipo->getConcepto()->getCaConcepto()?></td>
							<td><?=$equipo->getCaCantidad()?></td>
							<td><?=$equipo->getCaIdequipo()?></td>
							<td><?=$equipo->getCaObservaciones()?$equipo->getCaObservaciones():"&nbsp;"?></td>
						</tr>
						<?
						}
						?>
					</table></td>
			</tr>
			<?
		}else{
	
			$equipos = $reporte->getRepEquipos();
			
			if (count($equipos)> 0){
			?>
			<tr>
				<td colspan="6">
					<table width="100%" cellspacing="0" border="1" class="tableList">
						<tr>
							<th colspan="4">Relación de Contenedores</th>
						</tr>
						<tr>
							<th>Concepto</th>
							<th>Cantidad</th>
							<?
							if( $reporte->getCaImpoexpo()==Constantes::EXPO ){
							?>
							<th>Serial</th>
							<?
							}
							?>
							<th>Observaciones</th>
						</tr>
						<?				
						foreach( $equipos as $equipo ){
						?>
						<tr>
							<td><?=$equipo->getConcepto()->getCaConcepto()?></td>
							<td><?=$equipo->getCaCantidad()?></td>
							<?
							if( $reporte->getCaImpoexpo()==Constantes::EXPO ){
							?>
							<td><?=$equipo->getCaIdequipo()?></td>
							<?
							}
							?>
							<td><?=$equipo->getCaObservaciones()?$equipo->getCaObservaciones():"&nbsp;"?></td>
						</tr>
						<?
						}
						?>
					</table></td>
			</tr>
			<?
			}
		}
	}
		
	$statusList = $reporte->getRepStatus( );
	if( count( $statusList)>0 ){
	?>
	<tr>
		<td colspan="6">
			<?
			include_component("traficos", "listaStatus", array("reporte"=>$reporte, "endDate"=>$status->getCaFchenvio()));
			?>		</td>
	</tr>
	<?
	}

?>
</table>
<br />
<br />
<?

if( $reporte->getCaTransporte()==Constantes::AEREO && ($status->getCaIdetapa()=="IACAD"
	|| $status->getCaIdetapa()=="IACCR"
	|| $status->getCaIdetapa()=="IACEM"
	|| $status->getCaIdetapa()=="IACDE"
	|| $status->getCaIdetapa()=="IACIM"
	|| $status->getCaIdetapa()=="IACMV"
	|| $status->getCaIdetapa()=="IACTD"	)
	){
	echo $textos['mensajeAereo']."<br />";
}
	

if( $status->getCaIdetapa()=="IMCCR" ){
	echo $textos['mensajeReservaMaritimo']."<br />";
}


if( $status->getCaIdetapa()=="IMETA" ){
	echo $textos['mensajeEmbarqueMaritimo'];
	
	if( $reporte->getCaContinuacion()=="OTM"  ){	
		echo $textos['mensajeEmbarqueOTM']."<br />";
	}
}
?>


<?
//Ticket # 1853
if($reporte->getCaTransporte()==Constantes::AEREO && ($status->getCaIdetapa()=="IACCR" || $status->getCaIdetapa()=="IACAD" || $status->getCaIdetapa()=="IACDE") ){
?>
<br />
La fecha de llegada de la mercancía es un estimado ya que puede variar por decisión de la aerolínea. 
<?
}


echo $status->getCaComentarios()?"<strong>NOTA</strong><br />".Utils::replace($status->getCaComentarios()):"";

if( $status->getCaIdetapa()=="EEETD" ) {
?>
Sr. Exportador, por favor pìdale a su cliente importador, que verifique que el peso y cantidad de piezas que se indican en el documento de transporte sean los mismos que usted envia. De no recibir ningùn comentario 24 horas despuès de retirada la carga, se entenderà por recibida a conformidad  por parte del importador.
<br />
<?
}


if( $status->getCaIdetapa()=="IMCPD" ) {
?>
IMPORTANTE: Favor tener en cuenta la entrada en vigencia de la Resolución No. 7408,  Declaracion  Anticipada. En caso de requerir certificación de fletes en forma anticipada informarnos por escrito y con el mayor gusto la suministraremos.
<br />
<?
}
?>




<br />
Cualquier información adicional que ustedes requieran, con gusto le será suministrada.<br />
<br />
Cordial Saludo.<br />
<br />
<br />
<?
echo $user->getFirmaHTML();
?>
	
	
</div>
</div>
