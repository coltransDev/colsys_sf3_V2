

<div align="center">
<h3>Pagina Principal</h3>
<br />

<table width="539" border="1" class="table1">
	<tr>
		<th width="529"  colspan="2"></th>
	</tr>
	<tr>
		<td>
		<div id="cpanel">
				

				
				<?
				
				?>
				<div style="float:left;">
					<div class="icon">
		
						<a href="<?=url_for("ordenes/index")?>">
							<?=image_tag("48x48/icon-48-install.png")?><span>Crear orden</span></a>
					</div>
				</div>
				<?
				
				?>				
				<div style="float:left;">
					<div class="icon">
						<a href="<?=url_for("buscar/index")?>">							
							<?=image_tag("48x48/icon-48-section.png")?>			
							<span>Busqueda</span></a>
					</div>
				</div>

				<div style="float:left;">
					<div class="icon">
						<a href="<?=url_for("cuenta/index")?>">
						
							<?=image_tag("48x48/icon-48-config.png")?><span>Configuraci&oacute;n de la cuenta</span></a>
					</div>
				</div>
				<div style="float:left;">
					<div class="icon">
		
						<a href="<?=url_for("login/signout")?>">
							<?=image_tag("48x48/icon-48-menumgr.png")?>			
							<span>Salir</span></a>
					</div>
				</div>
				
			</div>

		</td>
		<td >
			Bienvenido al sistema de Tracking &amp; Tracing de <?=sfConfig::get("app_branding_name")?>.
		</td>
	</tr>	
</table>
</div>