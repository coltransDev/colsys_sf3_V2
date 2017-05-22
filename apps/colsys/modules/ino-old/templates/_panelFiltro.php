<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_component("widgets", "widgetCiudad");
?>
<script>
    function cambiarCriterio()
    {
        valor=($("#criterio").val())?$("#criterio").val():'<?=$criterio?>';
        switch(valor)
        {
            case "ca_fchsalida":
            case "ca_fchllegada":
                fech1= new Ext.form.DateField(
                    {
                        fieldLabel: 'Fecha Inicial',
                        name : 'cadena',
                        id   : 'cadena',
                        format: 'Y-m-d',
                        value: '<?=$cadena?>',
                        width : 120
                    }
                );
                $("#div_cadena").html("");
                fech1.render("div_cadena");

                break;
            case "ca_origen":
            case "ca_destino":
                field=new WidgetCiudad({
                                      name: 'field',
                                      hiddenName: 'cadena',
                                      id: 'field',
                                      value : '<?=$field?>',
                                      hiddenValue : '<?=$cadena?>'
                                    })
                $("#div_cadena").html("");
                field.render("div_cadena");
                break;
            default:
                $("#div_cadena").html('<input type="text" name="cadena" id="cadena" size="60" value="<?=$cadena?>"  />');
                break;
        }
    }
    Ext.onReady(function(){
        cambiarCriterio();
    });
</script>
<form action="<?=url_for( "ino/busqueda?modo=".$modo->getCaIdmodo() )?>" method="post" >
<table class="tableList" width="550px" align="center" border="0" cellpadding="5px" cellspacing="1px" >
	<tr>
		<th colspan="3" style='font-size: 12px; font-weight:bold;'>Sistema INO <?=$modo->getCaImpoexpo()?> <?=$modo->getCaTransporte()?></th>
    </tr>
	<tr>
		<td colspan="3" style='font-size: 10px;'>Ingrese un criterio para realizar las busqueda</td>
    </tr>
	<tr>
		<td width="88" ><b>Buscar por:</b> <br />
            <select name="criterio" id="criterio" size="7" onChange='cambiarCriterio(this)'>
                <option value="ca_referencia" <?=($criterio=="ca_referencia"||!$criterio)?"selected":""?>>N&uacute;mero de referencia</option>
                <option value="cliente" <?=($criterio=="cliente")?"selected":""?>>Cliente</option>
                <option value="ca_master" <?=($criterio=="ca_master")?"selected":""?>>Guia Master</option>
                <option value="ca_house" <?=($criterio=="ca_house")?"selected":""?>>Guia Hija</option>
                <option value="proveedor" <?=($criterio=="ca_nombre_pro")?"selected":""?>>Nombre del Proveedor </option>
                <option value="linea" <?=($criterio=="linea")?"selected":""?>>Linea</option>
                <option value="ca_doctransporte" <?=($criterio=="ca_doctransporte")?"selected":""?>>Documento de Transporte</option>
                <option value="ca_numorden" <?=($criterio=="ca_numorden")?"selected":""?>>No.Orden Cliente </option>
                <option value="reporte" <?=($criterio=="reporte")?"selected":""?>>No. Reporte </option>
                <option value="ca_origen" <?=($criterio=="ca_origen")?"selected":""?>>Ciudad Origen  </option>
                <option value="ca_destino" <?=($criterio=="ca_destino")?"selected":""?>>Ciudad Destino</option>
                <option value="ca_motonave" <?=($criterio=="ca_motonave")?"selected":""?>>Motonave</option>
                <option value="ca_fchsalida" <?=($criterio=="ca_fchsalida")?"selected":""?>>fecha de Salida</option>
                <option value="ca_fchllegada" <?=($criterio=="ca_fchllegada")?"selected":""?>>fecha de Llegada</option>
                <option value="factura_clie" <?=($criterio=="factura_clie")?"selected":""?>>Factura Cliente</option>
                <option value="factura_prov" <?=($criterio=="factura_prov")?"selected":""?>>Factura Proveedor</option>
                <option value="ca_idnave" <?=($criterio=="ca_idnave")?"selected":""?>>Motonave</option>
                <option value="ca_observaciones" <?=($criterio=="ca_observaciones")?"selected":""?>>Observaciones</option>
		<option value="ca_contenedor" <?=($criterio=="ca_contenedor")?"selected":""?>>Contenedor</option>
            </select>
	    </td>
		<td width="337" >&nbsp;
		  <div id="visible" ><b>Que contenga la cadena:</b><br />
			<div id="div_cadena"></div>
            <table>
                <tr>
                    <td>
                        <div><b>Cerrados</b> <br>
                            <select id="cerrados" name="cerrados">
                                <option value="">Todos</option>
                                <option value="Si">Si</option>
                                <option value="No">No</option>
                            </select>                            
                        </div>
                    </td>
                    <td>
                        <div><b>Liquidados</b> <br>                            
                            <select id="liquidados" name="liquidados">
                                <option value="">Todos</option>
                                <option value="Si">Si</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </td>
                </tr>
            </table>
	  </div></td>
	  <td width="64"  ><input  type='submit' name='buscar' value=' Buscar' /></td>
	</tr>
</table>
</form>
