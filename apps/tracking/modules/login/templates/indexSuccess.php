<div align="center">
<form action="<?=url_for("login/index")?>" method="post">

<h3> Bienvenido a nuestro sistema de Tracking </h3>
<br />

	
<div class="box1" style="width:550px" align="center">
	<table width="550px" border="0">
	<?
	echo $form
	?>		
	<tr>	
		<td colspan="2" ><div align="center"><input type="submit" value="Continuar" class="button" /></div></td>
	</tr>
	
</table>
</div>
		

</form>
<br />

<br />
<div align="center">					
<?=link_to("&iquest;No tiene clave todavia?, haga click aca","login/getPasswd")?>
<br /><br />
<?=link_to("&iquest;Olvido su clave?, haga click aca","login/getPasswd")?> 	
<br /><br />
<?=link_to(" Usuarios de Colsys Click aca ", "login/novell")?> 			
</div>

</div>