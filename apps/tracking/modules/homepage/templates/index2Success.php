

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
				<div style="float:left;">
					<div class="icon">
						<a href="<?=url_for("maritimo/index")?>">
							<?=image_tag("48x48/mar_ico.jpg")?>
							<span>Importaciones Mar&iacute;timas</span>
						</a>
					</div>
				</div>

				<div style="float:left;">
					<div class="icon">
						<a href="<?=url_for("aereo/index")?>">
							<?=image_tag("48x48/aer_ico.jpg")?>				
							<span>Importaciones Aereas</span></a>
					</div>
				</div>
				<?
				/*
				?>
				<div style="float:left;">
					<div class="icon">
		
						<a href="<?=url_for("exportaciones/index")?>">
							<img src="/colmasweb/administrator/templates/khepri/images/header/icon-48-frontpage.png" alt="Administrador de la página principal"  />					<span>Exportaciones</span></a>
					</div>
				</div>
				<?
				*/
				?>
				<div style="float:left;">
					<div class="icon">
						<a href="<?=url_for("aduana/index")?>">
							<?=image_tag("48x48/icon-48-install.png")?>	
												<span>Aduana</span></a>
		
					</div>
				</div>
				<div style="float:left;">
					<div class="icon">
						<a href="<?=url_for("buscar/index")?>">
							<img src="/colmasweb/administrator/templates/khepri/images/header/icon-48-section.png" alt="Administrador de secciones"  />			
							<span>Busqueda</span></a>
					</div>
				</div>

				<div style="float:left;">
					<div class="icon">
						<a href="<?=url_for("cuenta/index")?>">
						
							<?=image_tag("48x48/icon-48-config.png")?>						<span>Configuraci&oacute;n de la cuenta</span></a>
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
			Bienvenido al sistema de Tracking &amp; Tracing de Coltrans S.A.
		</td>
	</tr>	
</table>
</div>