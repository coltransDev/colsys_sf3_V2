<div align="center">
	
	<table width="90%" border="0">
	<tr>
		<td width="50%"><?=image_tag("layout/homepage/colsys_homepage.png")?></td>
		<td width="50%">&nbsp;</td>
	</tr>
	<tr>
		<td valign="top">
			<table width="100%" border="0" >
				<tr>
					<td ><div align="left"><?=image_tag("layout/homepage/directorio.jpg")?></div></td>
				</tr>				
				<tr>
					<td>
						<div class="homePanel">
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

									<li><b>Bogotá:</b> 804 11 + Ext.</li>
									<li><b>Medellín:</b> 804 44 + Ext.</li>
									<li><b>B/quilla.:</b> 804 55 + Ext.</li>
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
					
						</div>
					</td>
				</tr>
				<tr>
					
				</tr>

				
			</table>

		</td>
		<td valign="top">
			<table width="100%" border="0" >
				<tr>
					<td ><div align="left"><?=image_tag("layout/homepage/novedades.jpg")?></div></td>
				</tr>
				<tr>
					<td colspan="2">
						<div class="homePanel" style="max-height:100px; overflow:auto;">
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
						</div>
					</td>
				</tr>							
			</table>
		
		</td>
	</tr>
</table>

</div>