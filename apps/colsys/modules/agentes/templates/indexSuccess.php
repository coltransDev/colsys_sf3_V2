<div class="content" align="center">
<h3>Maestra de Agentes</h3><br />
<form action="<?=url_for("agentes/consultarAgentes")?>" method="post" >
<table width="50%" border="0" class="tableList">
	<tr>
		<th scope="col" colspan="2">&nbsp;</th>
	</tr>
	<tr>
		<td width="50%"><div align="left"><b>Pais: </b>
						<select name="idtrafico" >
							<option value="" selected="selected">Todos los Paises</option>
							<?
							foreach( $traficos as $trafico ){
							?>
							<option value="<?=$trafico->getCaIdtrafico()?>" ><?=$trafico->getCaNombre()?></option>
							<?
							}
							?>
						</select>
						</div>
						
		</td>
		<td width="50%"><div align="left"><b>Buscar: </b> <input type="text" name="buscar" value="" size="45" /></div></td>
	</tr>
	<tr>
		<td colspan="2"><div align="center"><input type="submit" value="Consultar" class="button" /></div></td>
	</tr>
</table>
</form>

</div>

