<?
/**
* Pantalla de bienvenida para el modulo de reportes
* @author Andres Botero, Mauricio Quinche
*/

?>

<div class="content" align="center">
	<table width="50%" border="0" class="tableList">
	<tr>
        <th scope="col" colspan="<?=$maxSpan;?>" align="left"><b>Crear un nueva referencia, seleccione el servicio</b></th>
	</tr>
    <?
    foreach($modos as $impoexpo=>$val ){
    ?>
    <tr class="row0">
        <td colspan="<?=$maxSpan;?>">
            <b><?=$impoexpo?></b>
        </td>
    </tr>
    
    <tr>
        <?
        $i=0;
        foreach( $val as $transporte=>$id ){
            $i++;
        ?>    
        <td >
            <?=link_to($transporte, "ino/index?modo=".$id)?>
        </td>
        <?
        }
        
        for( $j=$i;$j<$maxSpan;$j++ ){
        ?>    
        <td >
            &nbsp;
        </td>
        <?    
        }
        ?>
    </tr>
    <?
    }
    ?>           

</table>

</div>
<br />
<br />

<?
//include_component("ino","panelFiltro");
?>