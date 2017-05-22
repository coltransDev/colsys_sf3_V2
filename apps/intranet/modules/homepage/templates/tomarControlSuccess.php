<div align="center">
<form name="form1" action="<?=url_for("homepage/tomarControl")?>" method="post">
<br>
<h1>Tomar control de un usuario</h1>
<br>

<table width="50%" border="1" class="tableList">
	<tr>
		<th colspan="2">Por favor seleccione un usuario</th>
	</tr>
	<?=$form?>
	<tr>
		<th colspan="2"><div align="center"><input type="submit" value="Continuar" class="button"></div></th>
	</tr>
</table>
	
</form>
</div>