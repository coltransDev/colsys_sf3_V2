<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>
<div class="content" align="center">
	<h3>Maestra de Proveedores - Transportistas</h3>
	<br />
	<form action="<?=url_for("ids/formTransportista?modo=".$modo."&id=".$ids->getCaId())?>" method="post">
	<?
    if( $transportista ){
    ?>
        <input type="hidden" name="idlinea" value="<?=$transportista->getCaIdlinea()?>">
    <?
    }
    ?>
	<table cellspacing="1" width="50%" class="tableList">
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
				<td width="22%"><b>Proveedor</b></td>
				<td colspan="3">
					<?                   
                    echo $ids->getcaNombre();
					?>
                </td>
			</tr>			
			<tr>
				<td><b>Nombre:</b></td>
				<td colspan="3">
				<?
				 echo $form['nombre']->renderError();
				 if( $transportista ){
					$form->setDefault('nombre', $transportista->getCaNombre() );
				 }
				 echo $form['nombre']->render();
				 ?>				</td>
			</tr>
			<tr>
				<td><b>Sigla:</b></td>
				<td colspan="3">
				<?
				 echo $form['sigla']->renderError();
				 if( $transportista ){
					$form->setDefault('sigla', $transportista->getCaSigla() );
				 }
				 echo $form['sigla']->render();
				 ?>				</td>
			</tr>            
			<tr>
                <td><b>Transporte:</b></td>
				<td colspan="3">
				<?
				 echo $form['transporte']->renderError();
				 if( $transportista ){
					$form->setDefault('transporte', $transportista->getCaTransporte() );
				 }
				 echo $form['transporte']->render();
				 ?>				</td>
			</tr>			
			<tr>
				<td><b>Activo: </b></td>
				<td colspan="3">
					<?
					 echo $form['activo']->renderError();
					 if( $transportista && $transportista->getCaIdlinea()){
						$form->setDefault('activo', $transportista->getCaActivo() );
					 }else{
                         $form->setDefault('activo', true );
                     }
					 echo $form['activo']->render();
					 ?>
					Activo<br /></td>
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

