<script language="javascript">
	var ciudades = <?=$ciudades?>;
	function llenarCiudades(){		
		var idtrafico = document.getElementById("idtrafico").value;
		
		
		var fldCiudades = document.form1.idciudad;
		
		fldCiudades.length=0;
   		fldCiudades[fldCiudades.length] = new Option('Oficinas Principales','',false,false);
		
		var ciudadesTrafico = ciudades[idtrafico];		
		for( i in ciudadesTrafico ){
			if( typeof(ciudadesTrafico[i]['idciudad'])!="undefined" ){				
				fldCiudades[fldCiudades.length] = new Option(ciudadesTrafico[i]['ciudad'],ciudadesTrafico[i]['idciudad'],false,false);			
			}
		}
		
	}
</script>

<div class="content" align="center">
<h3>Maestra de Agentes</h3><br />
<form action="<?=url_for("agentes/consultarAgentes")?>" method="post" name="form1" >
<table width="50%" border="0" class="tableList">
	<tr>
		<th scope="col" colspan="3">&nbsp;</th>
	</tr>
	<tr>
		<td width="50%"><div align="left"><b>Pais: </b>
						<select name="idtrafico" id="idtrafico" onchange="llenarCiudades()" >
							<option value="" selected="selected">Todos los Paises</option>
							<?
							foreach( $traficos as $trafico ){
							?>
							<option value="<?=$trafico->getCaIdtrafico()?>" ><?=$trafico->getCaNombre()?></option>
							<?
							}
							?>
						</select>
						</div>		</td>
		<td width="50%"><b>Ciudad: </b>
			<select name="idciudad" id="idciudad">				
			</select>
		</td>
		<td width="50%"><div align="left"><b>Buscar: </b> <input type="text" name="buscar" value="" size="45" /></div></td>
	</tr>
	<tr>
		<td colspan="3"><div align="center"><input type="submit" value="Consultar" class="button" /></div></td>
	</tr>
</table>
</form>
<script language="javascript" type="text/javascript">
	llenarCiudades();
</script>
</div>

