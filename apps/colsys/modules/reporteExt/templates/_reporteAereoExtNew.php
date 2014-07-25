<?
$master = $sf_data->getRaw("master");
$notify_h = $sf_data->getRaw("notify_h");
$notify_m = $sf_data->getRaw("notify_m");
$hijo = $sf_data->getRaw("hijo");

$consignatario_h = $sf_data->getRaw("consignatario_h");
?>
<table width="100%" cellspacing="1" border="1" class="tableList">
<tr>
	<td colspan="4"><center>
			<b>AIRFREIGHT BUSINESS REPORT</b>
		</center></td>
</tr>
<?
$ordenes = array_combine(explode("|",$reporte->getCaIdproveedor()), explode("|",$reporte->getCaOrdenProv()) ); 
 
$proveedores = $reporte->getProveedores();

$i=1;
foreach( $proveedores as $proveedor ){
?>
<tr>
	<td width="24%"><b>SHIPPER
		<?=(count($proveedores)>1)?"# $i":""?>
		</b></td>
	<td width="76%" colspan="3"><?=$proveedor->getCaNombre()?></td>
</tr>
<tr>
	<td><b>ADDRESS :</b></td>
	<td colspan="3"><?=$proveedor->getCaDireccion()?></td>
</tr>
<tr>
	<td><b>PHONE :</b></td>
	<td colspan="3"><?=$proveedor->getCaTelefonos()?></td>
</tr>
<tr>
	<td><b>FAX :</b></td>
	<td colspan="3"><?=$proveedor->getCaFax()?></td>
</tr>
<tr>
	<td><b>CONTACT :</b></td>
	<td colspan="3"><?=$proveedor->getCaContacto()?></td>
</tr>
<tr>
	<td><b>E-MAIL :</b></td>
	<td colspan="3"><?=$proveedor->getCaEmail()?></td>
</tr>
<tr>
	<td><b>ORDER SUPPLIER :</b></td>
	<td colspan="3"><?=$ordenes[$proveedor->getCaIdtercero()]?></td>
</tr>
<tr>
	<td colspan="4">&nbsp;</td>
</tr>
<?  
$i++;              
}
?>
<tr>
	<td><b>ORDER CLIENT:</b></td>
	<td colspan="3"><?=$reporte->getCaOrdenClie()?></td>
</tr>
<tr>
	<td><b>INCOTERMS :</b></td>
	<td colspan="3"><?=$reporte->getCaIncoterms()?></td>
</tr>
<tr>
	<td><b>ORIGEN :</b></td>
	<td colspan="3"><?=$reporte->getOrigen()->getCaCiudad()?></td>
</tr>
<tr>
	<td><b>CARGO AVAILABLE :</b></td>
	<td colspan="3"><?=$reporte->getCaFchdespacho()?></td>
</tr>

<?			
if ( $reporte->getCaIdlinea() ){
?>
<tr>
	<td style="vertical-align:top"><b>AIRLINE:</b></td>
	<td colspan="3"><?=$reporte->getIdsProveedor()->getIds()->getCaNombre()?></td>
</tr>
<?	
}


?>
<tr>
	<td colspan="4">&nbsp;</td>
</tr>
<?
if($reporte->getCaModalidad()!="DIRECTO" && $master)
{
?>
<tr>
	<td colspan="4"><center><b>MAWB INSTRUCTIONS</b></center></td>
</tr>

<tr>
	<td><b>CONSIGNED TO:</b></td>
	<td colspan="3"><?=$master?></td>
</tr>

<tr>
	<td><b>FINAL DESTINATION:</b></td>
	<td colspan="3"><?=$reporte->getDestino()->__toString()?></td>
</tr>
<tr>
	<td><b>NATURE OF GOODS:</b></td>
	<td colspan="3">CONSOLIDATION AS PER ATTACHED CARGO MANIFEST.</td>
</tr>

<tr>
	<td colspan="4">&nbsp;</td>
</tr>
<?
}

if( $idtrafico=="PE-051" ){
?>
<tr>
	<td><b>NOTIFY:</b></td>
	<td colspan="3"><?=$notify_m?></td>
</tr>
<?
}

?>


<tr>
	<td colspan="4"><center><b>HAWB INSTRUCTIONS</b></center></td>
</tr>

<tr>
	<td><b>CONSIGNED TO:</b></td>
	<td colspan="3"><?=$hijo?></td>
</tr>
<?

if ( $reporte->getCaContinuacion() != 'N/A' ){
?>
<tr>
	<td><b>FINAL DESTINATION:</b></td>
	<td colspan="3"><?=$reporte->getDestinoCont()->__toString()?></td>
</tr>
<?	
}
?>	

<tr>
	<td><b>NATURE GOODS :</b></td>
	<td colspan="3"><?=$reporte->getCaMciaPeligrosa()?"DANGEROUS GOODS. ":""?><?=$reporte->getCaMercanciaDesc()?></td>
</tr>
<tr>
	<td><b>FREIGHT:</b></td>
	<td colspan="3">AS AGREED</td>
</tr>
<tr>
	<td colspan="4">&nbsp;</td>
</tr>

<tr>
	<td bgcolor="#CCCCCC" colspan="4"><center>
			<b>SELLING RATES</b>
		</center></td>
</tr>
<tr>
	<td colspan="4">
		<table border="1" cellspacing="1" width="100%">
			<?		
		foreach( $tarifas as $tarifa ){
		?>
			<tr>
				<td style="vertical-align:bottom" bgcolor="#CCCCCC" width="30%"><b>Airfreight :</b><br />
					<?
				echo $tarifa->getConcepto()->getCaConcepto();
				
				if( $tarifa->getCaCantidad()>0 ){
					echo "[Cant.: ".Utils::formatNumber( $tarifa->getCaCantidad() ,3)."]";
				}
				?>				</td>
				<td style="vertical-align:bottom" bgcolor="#CCCCCC" width="70%">
                    <table border="1" cellspacing="0" width="100%">
                        <tr>
					<?
                    if( $reporte->getCaImpoexpo()==Constantes::EXPO && $reporte->getCaIncoterms()=="DDP - Delivered Duty Paid" )
                    {
                        if ($tarifa->getCaNetaTar() > 0){
                        ?>
                                <td bgcolor="#CCCCCC" width="25%">
                                    <b><?=($reporte->getCaImpoexpo()!=Constantes::EXPO)?"Selling Rate":"Buying Rate"?> :</b><br />
                                    <?=number_format($tarifa->getCaNetaTar(),2)." ".$tarifa->getCaNetaIdm()?>
                                </td>
                                <?							
                        }
                        if ($tarifa->getCaReportarMin() > 0){
                        ?>
                                <td bgcolor="#CCCCCC" width="25%">
                                    <b>Minimum :</b><br />
                                    <?=number_format($tarifa->getCaReportarMin(),2)." ".$tarifa->getCaReportarIdm()?>
                                </td>
                                <?							
                        }
                        
                    }else
                    {
                        if ($tarifa->getCaReportarTar() > 0){
                        ?>
                                <td bgcolor="#CCCCCC" width="25%">
                                    <b><?=($reporte->getCaImpoexpo()!=Constantes::EXPO)?"Selling Rate":"Buying Rate"?> :</b><br />
                                    <?=number_format($tarifa->getCaReportarTar(),2)." ".$tarifa->getCaReportarIdm()?>
                                </td>
                                <?							
                        }
                        if ($tarifa->getCaReportarMin() > 0){
                        ?>
                                <td bgcolor="#CCCCCC" width="25%">
                                    <b>Minimum :</b><br />
                                    <?=number_format($tarifa->getCaReportarMin(),2)." ".$tarifa->getCaReportarIdm()?>
                                </td>
                                <?							
                        }
                    }
					
                    
                    if($reporte->getCaImpoexpo()==Constantes::EXPO)
                    {
                        if($reporte->getCaIncoterms()!="DDP - Delivered Duty Paid" )
                        {
                            if ( $tarifa->getCaCobrarTar() > 0 )
                                $tar_sell=number_format($tarifa->getCaCobrarTar(),2)." ".$tarifa->getCaCobrarIdm();
                        }
                        else
                            if ( $tarifa->getCaNetaTar() > 0 )
                                $tar_sell=number_format($tarifa->getCaNetaTar(),2)." ".$tarifa->getCaNetaIdm();
                    
    					if ( $tar_sell!="" ){
					?>
							<td bgcolor="#CCCCCC" width="25%"><b>Selling Rate :</b><br />
								<?=$tar_sell?>							</td>
					<?
        				}
                    
                        if($reporte->getCaIncoterms()!="DDP - Delivered Duty Paid" )
                        {
                            if ( $tarifa->getCaCobrarMin() > 0 )
                                $tar_sell_min=number_format($tarifa->getCaCobrarMin(),2)." ".$tarifa->getCaCobrarTar();
                        }
                        else
                        {
                            if ( $tarifa->getCaNetaMin() > 0 )
                                $tar_sell_min=number_format($tarifa->getCaNetaMin(),2)." ".$tarifa->getCaNetaTar();
                        }

    					if ( $tar_sell_min!="" ){
					?>
							<td bgcolor="#CCCCCC" width="25%"><b>Selling Rate :</b><br />
								<?=$tar_sell_min?>							</td>
					<?
        				}
                    }
					?>      
						</tr>
					</table></td>
			</tr>
		<?		
        
        if($reporte->getCaImpoexpo()==Constantes::EXPO)
        {            
            foreach( $gastos as $gasto ){                
				if ($gasto->getCaIdconcepto() == $tarifa->getCaIdconcepto() ){
                    if ( $gasto->getCaCobrarTar()== 0 && $gasto->getCaReportarTar() == 0) {
                        continue;
                    }
                    //echo $gasto->getCaIdconcepto();
			?>
			<tr>
				<td style="vertical-align:bottom" width="30%"><b>
					<?=$gasto->getTipoRecargo()->getCaRecargo()?>
				</b></td>
				<td style="vertical-align:bottom" width="70%"><table border="1" cellspacing="0" width="100%">
						<tr>
							<?
                            if( $reporte->getCaIncoterms()=="DDP - Delivered Duty Paid" )
                                {
                                    if ($gasto->getCaNetaTar() != 0){
                                    ?>
                                    <td><b>Buying Rate :</b><br />
                                    <?=(($gasto->getCaTipo()=='$')?number_format($gasto->getCaNetaTar() ,2)." ".$gasto->getCaIdmoneda():number_format($gasto->getCaNetaTar(),2).$gasto->getCaTipo())?>
                                    </td>
                                    <?
                                    }
                                    if ($gasto->getCaReportarMin() != 0){
                                    ?>
                                    <td><b>Minimum :</b><br />
                                        <?=number_format($gasto->getCaReportarMin(),2)." ".$gasto->getCaIdmoneda()?>
                                    </td>
                                    <?
                                    }
                                    if ($gasto->getCaReportarTar() != 0){
                                    ?>
                                    <td><b>Selling Rate :</b><br />
                                        <?=(($gasto->getCaTipo()=='$')?number_format($gasto->getCaReportarTar() ,2)." ".$gasto->getCaIdmoneda():number_format($gasto->getCaReportarTar(),2).$gasto->getCaTipo())?>
                                    </td>
                                    <?
                                    }

                                    if ($gasto->getCaReportarMin() != 0){
                                    ?>
                                    <td><b>Minimum :</b><br />
                                        <?=number_format($gasto->getCaReportarMin(),2)." ".$gasto->getCaIdmoneda()?>
                                    </td>
                                    <?
                                    }
                                }
                                else
                                {
                            
                                    if ($gasto->getCaReportarTar() != 0){
                                    ?>
                                    <td><b>Buying Rate :</b><br />
                                    <?=(($gasto->getCaTipo()=='$')?number_format($gasto->getCaReportarTar() ,2)." ".$gasto->getCaIdmoneda():number_format($gasto->getCaReportarTar(),2).$gasto->getCaTipo())?>
                                    </td>
                                    <?
                                    }
                                    if ($gasto->getCaReportarMin() != 0){
                                    ?>
                                    <td><b>Minimum :</b><br />
                                        <?=number_format($gasto->getCaReportarMin(),2)." ".$gasto->getCaIdmoneda()?>
                                    </td>
                                    <?
                                    }
                                    if ($gasto->getCaCobrarTar() != 0){
                                    ?>
                                    <td><b>Selling Rate :</b><br />
                                        <?=(($gasto->getCaTipo()=='$')?number_format($gasto->getCaCobrarTar() ,2)." ".$gasto->getCaIdmoneda():number_format($gasto->getCaCobrarTar(),2).$gasto->getCaTipo())?>
                                    </td>
                                    <?
                                    }

                                    if ($gasto->getCaCobrarMin() != 0){
                                    ?>
                                    <td><b>Minimum :</b><br />
                                        <?=number_format($gasto->getCaCobrarMin(),2)." ".$gasto->getCaIdmoneda()?>
                                    </td>
                                    <?
                                    }
                                }
							?>
						</tr>
					</table></td>
			</tr>
			<?
				}
			}
        }
        }
        
        if($reporte->getCaImpoexpo()==Constantes::EXPO)
        {
		?>
            
            <tr>
				<td bgcolor="#CCCCCC" colspan="4"><center>
						<b>General Charges</b>
					</center></td>
			</tr>
			<?
		foreach( $gastos as $gasto ){
			if ( $gasto->getCaCobrarTar()== 0 && $gasto->getCaReportarTar() == 0) {
				continue;
			}
			if ($gasto->getCaIdconcepto() == '9999'){
		?>
			<tr>
				<td style="vertical-align:bottom" width="30%"><b>
					<?=$gasto->getTipoRecargo()->getCaRecargo()?>
				</b></td>
				<td style="vertical-align:bottom" width="70%"><table border="1" cellspacing="0" width="100%">
						<tr>
							<?
                        if ($gasto->getCaAplicacion()){
                        ?>
							<td><b>Application :</b><br />
								<?=utf8_decode($gasto->getCaAplicacion())?>
                            </td>
                        <?
                        }
						
						if ($gasto->getCaReportarTar() != 0){
						?>
							<td><b>Selling Rate :</b><br />
								<?=(($gasto->getCaTipo()=='$')?number_format($gasto->getCaReportarTar() ,2)." ".$gasto->getCaIdmoneda():number_format($gasto->getCaReportarTar(),2).$gasto->getCaTipo())?>							</td>
							<?
						}
						if ($gasto->getCaReportarMin() != 0){
						?>
							<td><b>Minimum :</b><br />
								<?=number_format($gasto->getCaReportarMin(),2)." ".$gasto->getCaIdmoneda()?>							</td>
							<?
						}
                        if ($gasto->getCaCobrarTar() != 0){
						?>
							<td><b>Buying Rate :</b><br />
								<?=(($gasto->getCaTipo()=='$')?number_format($gasto->getCaCobrarTar() ,2)." ".$gasto->getCaIdmoneda():number_format($gasto->getCaCobrarTar(),2).$gasto->getCaTipo())?>
                            </td>
							<?
						}
						if ($gasto->getCaCobrarMin() != 0){
						?>
							<td><b>Minimum :</b><br />
								<?=number_format($gasto->getCaCobrarMin() ,2)." ".$gasto->getCaIdmoneda()?>							
                            </td>
							<?
						}
						?>
						</tr>
					</table></td>
			</tr>
			<?
			}
		}
        
?>
            <tr>
				<td bgcolor="#CCCCCC" colspan="4"><center>
						<b>Others Costs</b>
					</center></td>
			</tr>
			<?
            //$reporte = new Reporte();
            $costos = $reporte->getCostos();
            
		foreach ($costos as $c) {

		?>
			<tr>
				<td style="vertical-align:bottom" width="30%"><b>
					<?=$c->getCosto()->getCaCosto()?>
				</b></td>
				<td style="vertical-align:bottom" width="70%"><table border="1" cellspacing="0" width="100%">
						<tr>
							<?
                        
						
						//if ($gasto->getCaVlrcosto() != 0)
                        {
						?>
							<td width="50%"><b>Cost :</b><br />
                                <?=(($c->getCaTipo()=='%')?number_format($c->getCaVlrcosto(),2).$c->getCaTipo():number_format($c->getCaVlrcosto() ,2)." ".$c->getCaIdmoneda())?>
							</td>
							<?
						}
						//if ($gasto->getCaReportarMin() != 0)
                        {
						?>
							<td width="50%"><b>Minimum :</b><br />
								<?=number_format($c->getCaMincosto(),2)." ".$c->getCaIdmoneda()?>							</td>
							<?
						}
                        
						?>
						</tr>
					</table></td>
			</tr>
			<?
			
		}
        
        
        
        
        }
        
        
		?>
            
		</table>
</td>
</tr>
</table>
