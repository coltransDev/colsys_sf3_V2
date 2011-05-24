<?
/**
* Pantalla de bienvenida para el modulo de reportes
* @author Andres Botero
*/

?>
<form action="<?=url_for( "ino/busqueda?modo=".$modo )?>" method="post" >
<script language="javascript">
	function cambiarCriterio( field ){
		
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
		<th colspan="3" style='font-size: 12px; font-weight:bold;'>Sistema INO</th>
    </tr>
	<tr>
		<td colspan="3" style='font-size: 10px;'>Ingrese un criterio para realizar las busqueda</td>
    </tr>
	<tr>
		<td width="88" ><b>Buscar por:</b> <br />
            <select name="criterio" size="7" onChange='cambiarCriterio(this)'>
                <option value="referencia" selected="selected">N&uacute;mero de Referencia</option>
               
            </select>
	    </td>
		<td width="337" >&nbsp;
		  <div id="visible" ><b>Que contenga la cadena:</b><br />
			<div id="cadena"><input type="text" name="cadena" id="cadena" size="60" /></div>
			<div id="login" style="display:none">
                <select name="login">
                    <?
                    foreach($comerciales as $comercial ){
                    ?>
                    <option value="<?=$comercial->getCaLogin()?>"><?=$comercial->getCaNombre()?></option>
                    <?
                    }
                    ?>

                </select>
			</div>

            <div id="seguimiento" style="display:none">
                Mis cotizaciones en estado:<br />

                <select name="seguimiento">
                    <?
                    foreach($estados as $estado ){
                    ?>
                    <option value="<?=$estado->getCaValor()?>"><?=$estado->getCaValor2()?></option>
                    <?
                    }
                    ?>

                </select>
			</div>
	  </div></td>
	  <td width="64"  ><input  type='submit' name='buscar' value=' Buscar' /></td>
	</tr>
</table>
</form>