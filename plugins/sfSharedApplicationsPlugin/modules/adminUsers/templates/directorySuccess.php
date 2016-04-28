<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//phpinfo();
$sucursales = $sf_data->getRaw("sucursales");
$departamentos = $sf_data->getRaw("departamentos");

?>
<script language="javascript" type="text/javascript">
var buscar=function(){
    Ext.Ajax.request(
    {
        waitMsg: 'Buscando...',
        url: '<?=url_for("adminUsers/doSearch")?>',
        
        //Solamente se envian los cambios
        params :	{
            criterio: document.getElementById("criterio").value,
            opcion: document.getElementById("opcion").value,
            departamento: document.getElementById("departamento").value,
            sucursal: document.getElementById("idsucursal").value,
            empresa: document.getElementById("empresa").value
            
        },

        callback :function(options, success, response){
            document.getElementById("resultados").innerHTML = response.responseText;
        }
    }
);
}

function cambiarValores(){
        //Actualizamos sucursales
        var idempresa = document.getElementById("empresa").value;       

        var sucursales = <?=json_encode($sucursales)?>;
        var sucursalesFld = document.getElementById("idsucursal");
        sucursalesFld.length=0;
		sucursalesFld[sucursalesFld.length] = new Option("Todas las Sucursales","",false);
        for( i in sucursales ){
            
            if( typeof(sucursales[i]['ca_idsucursal'])!="undefined" ){
                if( idempresa == sucursales[i]['ca_idempresa'] ){                   
                   sucursalesFld[sucursalesFld.length] = new Option(sucursales[i]['ca_nombre'],sucursales[i]['ca_idsucursal'],false);
                }
            }
        }

        var departamentos = <?=json_encode($departamentos)?>;
        var departamentosFld = document.getElementById("departamento");
        departamentosFld.length=0;
		departamentosFld[departamentosFld.length] = new Option("Todos los Departamentos","",false);
        for( i in departamentos ){

            if( typeof(departamentos[i]['ca_nombre'])!="undefined" ){
                if( idempresa == departamentos[i]['ca_idempresa'] ){
                   departamentosFld[departamentosFld.length] = new Option(departamentos[i]['ca_nombre'],departamentos[i]['ca_nombre'],false);
                }
            }
        }
	}


</script>
<div class="content" align="center">
    <table width="100%" border="1" class="tableList">
        <th colspan="3" style="border-bottom: none"><b>Buscar Personas</b></th>
        <tr>
            <td>
                <select size="6%" name="opcion" id="opcion">
                    <option value="nombre" selected="selected">Nombre</option>
                    <option value="apellido">Apellido</option>
                    <option value="login">Login</option>
                    <option value="correo">Correo Electr&oacute;nico</option>
                    <option value="tiposangre">Tipo de Sangre</option>
                    <option value="cargo">Cargo</option>
                </select>
            </td>
            <td colspan="2">
                Ingrese un criterio para realizar la consulta<br />
                <input size="30" type="text" name="criterio" id="criterio"/>
            </td>
        </tr>
        <tr>
            <td>
                <select name="empresa" id="empresa" onChange="cambiarValores()">
                    <option value="" selected="selected">Todas las Empresas</option>
                    <?
                    foreach( $empresas as $empresa ){
                        ?>
                        <option value="<?=$empresa->getCaIdempresa()?>"><?=$empresa->getCaNombre()?>
                        </option>
                        <?
                    }
                    ?>
                </select>
            </td>
            <td>
                <select name="idsucursal" id="idsucursal"></select>
            </td>
            <td>
                <select name="departamento" id="departamento"></select>
            </td>
        </tr>
        <tr>
            <td colspan="3"><input type="button" value="Buscar" OnClick="buscar()"></td>
        </tr>
    </table><br />
    <div align="center">
        <div id="resultados"></div>
    </div>
</div>
<script language="javascript" type="text/javascript">
	cambiarValores();
</script>