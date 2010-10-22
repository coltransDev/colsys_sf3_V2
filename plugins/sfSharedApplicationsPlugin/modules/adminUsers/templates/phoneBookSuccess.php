<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$sucursales = $sf_data->getRaw("sucursales");
$departamentos = $sf_data->getRaw("departamentos");
?>
<script language="javascript" type="text/javascript">
function cambiarValores(){
    //Actualizamos sucursales
    var idempresa = document.getElementById("empresa").value;

    var sucursales = <?=json_encode($sucursales)?>;
    var sucursalesFld = document.getElementById("idsucursal");
    sucursalesFld.length=0;
    <?if($criterio=='buttondep'){?>
    sucursalesFld[sucursalesFld.length] = new Option("Todas las Sucursales","",false);
    <?}?>
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
    for( i in departamentos ){
        if( typeof(departamentos[i]['ca_nombre'])!="undefined" ){
            if( idempresa == departamentos[i]['ca_idempresa'] ){
               departamentosFld[departamentosFld.length] = new Option(departamentos[i]['ca_nombre'],departamentos[i]['ca_nombre'],false);
            }
        }
    }
}
</script>
<div id="cpanel">

        <div style="float:left;">
            <div class="icon">
                <a href="<?=url_for("adminUsers/listaExtensiones?criterio=buttondirnal")?>">
                    <?=image_tag("64x64/phonebook.png")?>
                    <span>Directorio Corporativo</span>
                </a>
            </div>
        </div>
        <div style="float:left;">
            <div class="icon">
                <a href="<?=url_for("adminUsers/phoneBook?criterio=buttoncom")?>">
                    <?=image_tag("64x64/company.png")?>
                    <span>Por Empresa</span>
                </a>
            </div>
        </div>
        <div style="float:left;">
            <div class="icon">
                <a href="<?=url_for("adminUsers/phoneBook?criterio=buttonsuc")?>">
                    <?=image_tag("64x64/sucursal.png")?>
                    <span>Por Sucursal</span>
                </a>
            </div>
        </div>
        <div style="float:left;">
            <div class="icon">
                <a href="<?=url_for("adminUsers/phoneBook?criterio=buttondep")?>">
                    <?=image_tag("64x64/departamento.png")?>
                    <span>Por Departamento</span>
                </a>
            </div>
        </div>
</div>
<br />
<br />
<?
if($criterio=='buttoncom'){
?>
<form action="<?=url_for( "adminUsers/listaExtensiones?criterio=buttoncom" )?>">
    <table>
        <tr>
            <select name="empresa" id="empresa" >
                <?
                foreach( $empresas as $empresa ){
                ?>
                    <option value="<?=$empresa->getCaIdempresa()?>"><?=$empresa->getCaNombre()?></option>
                <?
                }
                ?>
            </select>
        </tr>
        <td><input class="submit" type='submit' name='buscar' value=' Buscar' /></td>
    </table>
</form>
<?
}
if($criterio=='buttonsuc'){
?>
<form action="<?=url_for( "adminUsers/listaExtensiones?criterio=buttonsuc" )?>">
    <table>
        <tr>
            <select name="empresa" id="empresa" onChange="cambiarValores()">
                <?
                foreach( $empresas as $empresa ){
                ?>
                    <option value="<?=$empresa->getCaIdempresa()?>"><?=$empresa->getCaNombre()?>
                    </option>
                <?
                }
                ?>
            </select>
        </tr>
		<tr>
            <select name="idsucursal" id="idsucursal">
            </select>
        <tr>
        <td><input class="submit" type='submit' name='buscar' value=' Buscar' /></td>
    </table>
</form>
<?
}
if($criterio=='buttondep'){
?>
<form action="<?=url_for( "adminUsers/listaExtensiones?criterio=buttondep" )?>">
    <table>
        <tr>
            <select name="empresa" id="empresa" onChange="cambiarValores()">
                <?
                foreach( $empresas as $empresa ){
                ?>
                    <option value="<?=$empresa->getCaIdempresa()?>"><?=$empresa->getCaNombre()?>
                    </option>
                <?
                }
                ?>
            </select>
        </tr>
        <tr>
            <select name="idsucursal" id="idsucursal">
            </select>
        <tr>
        <tr>
            <select name="departamento" id="departamento">
            </select>
        </tr>
        <td><input class="submit" type='submit' name='buscar' value=' Buscar' /></td>
    </table>
</form>
<?
}
?>
<script language="javascript" type="text/javascript">
    <?
    if($criterio  ){
    ?>
    cambiarValores();
    <?
    }
    ?>
</script>