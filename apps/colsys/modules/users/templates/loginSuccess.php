
<form action="<?=url_for("users/login")?>" method="post" autocomplete="off">
<br />
<br />


<h3> Bienvenido a Colsys</h3>
<br />		
	<div class="box1" style="width:550px" align="center">
		<table width="550px" border="0">
		<tr>
		  <td colspan="2">&nbsp;</td>
		  </tr>
		<tr>
			<td width="169">
			<?=image_tag("logo_colsys.gif")?>			</td>
			<td width="371">
				<div align="left">
				<table >
					<?
					echo $form;
					?>
				</table>
				</div>		  </td>
		</tr>
	
		<tr>	
			<td colspan="2"><div align="center"><input type="submit" value="Entrar" class="button" /></div></td>
		</tr>
	</table>
	</div>
		


</form>
<br />
<br />
<br />
