<?
/**
* Pantalla de bienvenida para el modulo de reportes 
* @author Andres Botero
*/

include_component("widgets", "widgetCiudad");
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
            <select name="criterio" size="7" onChange='cambiarVendedor(this)'>
                <option value="mis_cotizaciones" selected="selected">Mis Cotizaciones</option>
                <option value="consecutivo">Consecutivo</option>
                <option value="seguimiento">Seguimientos</option>
                <option value="nombre_del_cliente">Nombre del Cliente</option>
                <option value="nombre_del_contacto">Nombre del Contacto</option>
                <option value="asunto">Asunto</option>
                <option value="vendedor">Vendedor</option>                
                <option value="sucursal">Sucursal</option>
                <option value="numero_de_cotizacion">Id</option>
            </select>
	    </td>
		<td width="337" >&nbsp;
		  <div id="visible" style="display:none"><b>Que contenga la cadena:</b><br />
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
	  </div>
            <table>
                <tr>
                    <td>
                        <div><b>Transporte</b> <br><span id="div_filtros"></span></div>
                    </td>
                    <td>
                        <div><b>Origen</b> <br><span id="div_filtros1"></span></div>
                    </td>
                   <td>
                        <div><b>Destino</b> <br><span id="div_filtros2"></span></div>
                    </td>
                </tr>
            </table>
            
            
            <script>
                 field=new Ext.form.ComboBox({
                        id: "transporte",
                        name:"transporte",
                        mode:'local',
                        width:100,
                        store : [
                            ['','...'],
                            ['A�reo','A�reo'],
                            ['Mar�timo','Mar�timo'],
                            ['Terrestre','Terrestre'],
                            ['OTM-DTA','OTM-DTA']
                        ],
                        forceSelection: true,
                        triggerAction: 'all',
                        selectOnFocus:true,
                        lazyRender:true
                });
                field.render("div_filtros");

                field=new WidgetCiudad({
                                      name: 'origen',
                                      hiddenName: 'idorigen',
                                      id: 'origen',
                                      width:100
                                    })

                field.render("div_filtros1");

                field=new WidgetCiudad({
                                      name: 'destino',
                                      hiddenName: 'iddestino',
                                      id: 'destino',
                                      width:100
                                    })

                field.render("div_filtros2");

            </script>
        </td>
	  <td width="64"  ><input  type='submit' name='buscar' value=' Buscar' /></td>
	</tr>
</table>
</form>