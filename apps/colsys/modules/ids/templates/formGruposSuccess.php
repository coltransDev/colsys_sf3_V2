<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>
<div class="content" align="center">
    <h3>Maestra de Proveedores - Administraci&oacute;n de Grupos</h3>
	<br />
	<form action="<?=url_for("ids/formGrupos?modo=".$modo."&id=".$ids->getCaId())?>" method="post">
	
    <input type="hidden" name="id" value="<?=$ids->getCaId()?>">
    
	<table cellspacing="1" width="50%" class="tableList alignLeft">
		<tbody>
			<tr>
				<th colspan="4">Nuevos Datos para el Transportista</th>
			</tr>
			<?
			if( $form->renderGlobalErrors() ){
			?>
			<tr>
				<td colspan="4" >
				 <div align="left"><?php echo $form->renderGlobalErrors() ?>		</div></td>
			</tr>
			<?
			}
			?>
			<tr>
				<td width="22%"><b>Cabeza</b></td>
				<td colspan="3">
					<?                   
                    echo $ids->getCaNombre();
					?>
                </td>
			</tr>			
			<tr>
				<td><b>Nombre:</b></td>
				<td colspan="3">
				<?
				 echo $form['idgrupo']->renderError();
				 echo $form['idgrupo']->render();
				 ?>
                </td>
			</tr>
			

			<tr>
				<td colspan="4" ><div align="center">
			<input type="submit" value="Guardar" class="button" />&nbsp;

			<input type="button" value="Cancelar" class="button"
                   onClick="document.location='<?=url_for("ids/verIds?modo=".$modo."&id=".$ids->getCaId())?>'" />
		</div></td>
		</tr>
		</tbody>
	</table>
	</form>


</div>

