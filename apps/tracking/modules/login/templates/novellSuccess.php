<div align="center">
<form action="<?=url_for("login/novell")?>" method="post">

<h3> Bienvenido a nuestro sistema de Tracking </h3>
<br />		
	<div class="box1" style="width:550px" align="center">
		<table width="550px" border="0">
		<tr>
			<td width="21">
			<?=image_tag("logo_colsys.gif")?>			</td>
			<td width="21">
				<div align="right">
				<table >
					<?
					echo $form;
					?>
				</table>
				</div>
			</td>
			
		</tr>
	
		<tr>	
			<td colspan="2"><div align="center"><input type="submit" value="Entrar" class="button" /></div></td>
		</tr>
	</table>
	</div>
		

</form>

</div>
