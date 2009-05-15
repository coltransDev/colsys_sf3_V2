<div align="center">

<table width="539" border="1" class="tableList">
	<tr>
		<th width="529"  >&nbsp;</th>
	</tr>
	<tr>
		
		<td class="mostrar"><div style="padding:25px" align="center"><?=image_tag("logo_colsys_big.gif"); ?></div>		</td>
	</tr>
	<tr>
		<th width="529"><div align="center"><b>Directorio</b></div></th>
	</tr>
	<tr>
		<td >
			<table width="100%" border="0" >
						<tr>
							<td colspan="2">
								<div align="center"><b>Para acceder al directorio haga <a href="#" onClick="window.open('http://correo.coltrans.com.co/eGuide')"> click aca</a>
									</b>
									</div></td>
							</tr>
						<td><div align="left">Para llamar desde <b>Bogotá</b> a <br>
								<ul>
									<li><b>Medellín:</b> 804 44 + Ext.</li>
									<li><b>Cali:</b> 804 22 + Ext.</li>
									<li><b>B/quilla.:</b> 804 55 + Ext.</li>
								</ul>
						</div></td>
						<td><div align="left">Para llamar desde <b>Medellín</b> a <br>
								<ul>
									<li><b>Bogotá:</b> 804 11 + Ext.</li>
									<li><b>Cali:</b> 804 22 + Ext.</li>

									<li><b>B/quilla.:</b> 804 55 + Ext.</li>
								</ul>
						</div></td>
					</tr>
					<tr>
						<td><div align="left">Para llamar desde <b>Cali</b> a <br>
								<ul>

									<li><b>Bogotá:</b> 84 11 + Ext.</li>
									<li><b>Medellín:</b> 84 44 + Ext.</li>
									<li><b>B/quilla.:</b> 84 55 + Ext.</li>
								</ul>

						</div></td>
						<td><div align="left">Para llamar desde <b>Barranquilla</b> a <br>
								<ul>
									<li><b>Bogotá:</b> 711 11 + Ext.</li>
									<li><b>Medellín:</b> 711 44 + Ext.</li>

									<li><b>Cali.:</b> 711 22 + Ext.</li>
								</ul>
						</div></td>
						</table>
		</td>
	</tr>
	<tr>
		<th width="529"><div align="center"><b>Novedades del sistema Colsys</b></div></th>
	</tr>
	<tr>
		<td >
		<?
		foreach( $novedades as $novedad ){
		?>			
			<br /><br />
			<?=image_tag("16x16/post.gif")?><b><?=$novedad->getCaFchpublicacion("Y-m-d")?> <?=$novedad->getCaAsunto()?></b>
			<br />
			<hr />
			<div class="story">
			<?=nl2br($novedad->getCaDetalle())?>
			</div>
		<?	
		}
		?>
		</td>
	</tr>	
</table>
</div>