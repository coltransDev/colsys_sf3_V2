<?
/**
* Pantalla de bienvenida para el modulo de reportes 
* @author Andres Botero
*/
use_helper("Javascript");
use_helper("Object");
?>
<form action="<?=url_for( "cotizaciones/busquedaCotizacion" )?>" method="post" >
<script language="javascript">
	function cambiarVendedor( field ){
		if( field.value=="mis_cotizaciones" ){
			document.getElementById("visible").style.display="none";
		}else{		
			document.getElementById("visible").style.display="inline";
		}	
		
		switch( field.value ){
            case "vendedor":
                document.getElementById("cadena").style.display="none";
                document.getElementById("seguimiento").style.display="none";
                document.getElementById("login").style.display="inline";
                break;
            case "seguimiento":
                document.getElementById("cadena").style.display="none";
                document.getElementById("login").style.display="none";
                document.getElementById("seguimiento").style.display="inline";
                break;
            default:
                document.getElementById("login").style.display="none";
                document.getElementById("seguimiento").style.display="none";
                document.getElementById("cadena").style.display="inline";
                break;
		}
	}
</script>
<table class="tableList" width="550px" align="center" border="0" cellpadding="5px" cellspacing="1px" >		
	<tr>	
		<th colspan="3" style='font-size: 12px; font-weight:bold;'>Sistema de Cotizaciones</th>
    </tr>
	<tr>	
		<td colspan="3" style='font-size: 10px;'>Ingrese un criterio para realizar las busqueda</td>
    </tr>
	<tr>
		<td width="88" ><b>Buscar por:</b> <br />
			<?=select_tag("criterio", options_for_select( array("mis_cotizaciones"=>"Mis Cotizaciones", "consecutivo"=>"Consecutivo", "nombre_del_cliente"=>"Nombre del Cliente", "nombre_del_contacto"=>"Nombre del Contacto", "asunto"=>"Asunto", "vendedor"=>"Vendedor", "numero_de_cotizacion"=>"N&uacute;mero de Cotizaci&oacute;n", "sucursal"=>"Sucursal", "seguimiento"=>"Seguimientos"), "mis_cotizaciones" ), "size=7 onChange='cambiarVendedor(this)' " );?>	  </td>
		<td width="337" >&nbsp;
		  <div id="visible" style="display:none"><b>Que contenga la cadena:</b><br />
			<div id="cadena"><?=input_tag("cadena", "", "size=60 ")?></div>
			<div id="login" style="display:none">
			<?
			echo select_tag("login", objects_for_select($comerciales, "getCaLogin", "getCaNombre" ) );						
			?>
			</div>

            <div id="seguimiento" style="display:none">
                Mis cotizaciones en estado:<br />
                <?
                echo select_tag("seguimiento", objects_for_select($estados, "getCaValor", "getCaValor2" ) );
                ?>
			</div>
	  </div></td>
	  <td width="64"  ><input  type='submit' name='buscar' value=' Buscar' /></td>
	</tr>
</table>
</form>