<?php
$url = "traficos/formParametros?&idreporte=".$reporte->getCaIdreporte();
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="content" align="center">

<form action="<?=url_for( $url )?>" method="post" name="form1" >

<table width="15%" border="0" class="tableList">
<?
$widgets = $form->getWidgetsClientes();
if( count($widgets)>0 ){
    foreach( $widgets as $name=>$val ){									
?>
        <tr>
            <td colspan="3">

                <div align="left">
                    <?
                 echo "<b>".$val["label"].":</b><br />"; 
                 echo $form[$name]->renderError(); 
                 if( $reporte ){	
                   $form->setDefault($name, $reporte->getProperty($name) ); 
                 }
                 echo $form[$name]->render();
                 ?>
                    </div></td>
        </tr>						
<?
    }
}

?>
        <tr>
		<td ><div align="center">
            <input type="submit" value="Guardar" class="button" />&nbsp;
            
            <input type="button" value="Cancelar" class="button" onClick="document.location='<?=url_for("traficos/listaStatus?&reporte=".$reporte->getCaConsecutivo())?>'" />&nbsp;
			
		</div></td>
		</tr>

</table>
</form>
</div>