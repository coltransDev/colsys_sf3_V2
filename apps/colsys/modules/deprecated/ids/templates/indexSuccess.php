
<script type="text/javascript">
	var ciudades = <?=$ciudades?>;
	function llenarCiudades(){
		var idtrafico = document.getElementById("idtrafico").value;


		var fldCiudades = document.form1.idciudad;

		fldCiudades.length=0;
   		fldCiudades[fldCiudades.length] = new Option('','',false,false);

		var ciudadesTrafico = ciudades[idtrafico];
		for( i in ciudadesTrafico ){
			if( typeof(ciudadesTrafico[i]['idciudad'])!="undefined" ){
				fldCiudades[fldCiudades.length] = new Option(ciudadesTrafico[i]['ciudad'],ciudadesTrafico[i]['idciudad'],false,false);
			}
		}

	}

    function ocultarCadena(){
       var criterio = document.form1.criterio.value;
       if( criterio == "ciudad" ){
           document.getElementById("cadena").style.display="none";
           document.getElementById("ciudad").style.display="";
       }else{
           document.getElementById("cadena").style.display="";
           document.getElementById("ciudad").style.display="none";          
       }       
    }
</script>

<div class="content" align="center">
<h3>Maestra de
<?
if( $modo=="prov" ){
    echo "Proveedores";
}

if(  $modo=="agentes" ){
    echo "Agentes";
}
?>
</h3>
<br />

<form action="<?=url_for( "ids/busqueda?modo=".$modo )?>" method="post" name="form1" >
<script language="javascript">
	
</script>
<table class="tableList" width="550px" align="center" border="0" cellpadding="5px" cellspacing="1px" >		
	<tr>	
		<th colspan="3" style='font-size: 12px; font-weight:bold;'><span style="font-size: 10px;">Ingrese un criterio para realizar las busqueda</span></th>
    </tr>
	
	<tr>
		<td width="88" ><b>Buscar por:</b> <br />
            <select name="criterio" size="7" onchange="ocultarCadena()">
                <option value="nombre" selected="selected">Nombre</option>
                <option value="ciudad" >Ciudad</option>
                <option value="id" >Identificaci&oacute;n</option>
			</select>
		</td>
		<td width="337" >&nbsp;
            <div id="cadena" ><b>Que contenga la cadena:</b><br />
                <input  type='text' name='cadena' value='' size="60" />
            </div>
            <div id="ciudad" >
                <table >
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
                </tr>
                </table>
            </div>
	  </td>
	  <td width="64"  ><input  type='submit' name='buscar' value=' Buscar' /></td>
	</tr>
</table>
</form>



</div>

<script type="text/javascript">
ocultarCadena();
</script>