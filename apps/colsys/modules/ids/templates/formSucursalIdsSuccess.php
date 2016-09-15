<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
?>
<div class="content" align="center">
<form action="<?=url_for("ids/formSucursalIds?modo=".$modo."&id=".$ids->getCaId() )?>" method="post" name="form1" >
<?
echo $form['idsucursal']->renderError();
if( $sucursal ){
    $form->setDefault('idsucursal', $sucursal->getCaIdsucursal() );
}
echo $form['idsucursal']->render();
?>
<table class="tableList alignLeft">
    <tr>
		<th colspan="6"><div align="left"><b>Nueva sucursal:</b></div></th>
    </tr>
    <?
	if( $form->renderGlobalErrors() ){
	?>
	<tr>
		<td colspan="6">
		 <div align="left"><?php echo $form->renderGlobalErrors() ?>		</div></td>
	</tr>
	<?
	}
	?>        
                
        
        <tr>
		<td> <div align="left"><b>Nombre</b></div></td>
		<td><div align="left">
            <?
            

            echo $form['nombre']->renderError();
            if( $sucursal ){
                $form->setDefault('nombre', $sucursal->getCaNombre() );
            }
            echo $form['nombre']->render();
            ?>

            </div></td>
            <td><div align="left"><b>Ciudad</b></div></td>
		<td><div align="left">
            <?
            echo $form['idciudad']->renderError();
            if( $sucursal ){
                $form->setDefault('idciudad', $sucursal->getCaIdciudad() );
            }
            echo $form['idciudad']->render();
            ?>

            </div></td>
		<td><div align="left">&nbsp;</div></td>
		<td><div align="left">&nbsp;</div></td>
        </tr>
        
	<tr>
		<td> <div align="left"><b>Direcci&oacute;n</b></div></td>
		<td><div align="left">
            <?
            

            echo $form['direccion']->renderError();
            if( $sucursal ){
                $form->setDefault('direccion', $sucursal->getCaDireccion() );
            }
            echo $form['direccion']->render();
            ?>

            </div></td>
            <td><div align="left"><b>Ciudad Destino</b></div></td>
		<td><div align="left">
            <?
            echo $form['idciudaddes']->renderError();
            if( $sucursal ){
                $form->setDefault('idciudaddes', $sucursal->getCaIdciudaddes() );
            }
            echo $form['idciudaddes']->render();
            ?>

            </div></td>
		<td><div align="left">&nbsp;</div></td>
		<td><div align="left">&nbsp;</div></td>
	</tr>
	<tr>
        <td><b>Tel&eacute;fonos</b></td>
		<td><div align="left">
            <?
            echo $form['telefonos']->renderError();
            if( $sucursal ){
                $form->setDefault('telefonos', $sucursal->getCaTelefonos() );
            }
            echo $form['telefonos']->render();
            ?>
            </div>
        </td>
        <td><b>Fax</b></td>
		<td><div align="left">
            <?
            echo $form['fax']->renderError();
            if( $sucursal ){
                $form->setDefault('fax', $sucursal->getCaFax() );
            }
            echo $form['fax']->render();
            ?>
            </div>
        </td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>

     <tr>
		<td colspan="6">
            <div align="center">
                <input type="submit" value="Guardar" class="button" />&nbsp;

                 <?
                if( $ids->isNew() ){
                    $url = "ids/index?modo=".$modo;
                }else{
                    $url = "ids/verIds?id=".$ids->getCaId()."&modo=".$modo;
                }
                ?>
                <input type="button" value="Cancelar" class="button" onClick="document.location='<?=url_for($url)?>'" />
            </div>
       </td>
	</tr>
    <?
    if( $sucursal && $sucursal->getCaUsucreado()  ){
    ?>
    <tr>
        <td>
            <div align="left"><b>Creado:</b> <?=$sucursal->getCaUsucreado()." ".Utils::fechaMes($sucursal->getCaFchcreado())?></div>
       </td>
       <td>
           <div align="left"><?=$sucursal->getCaUsuactualizado()?"<b>Actualizado:</b>":"&nbsp;"?> <?=$sucursal->getCaUsuactualizado()." ".Utils::fechaMes($sucursal->getCaFchactualizado())?></div>
       </td>
       <td colspan="4">
           <div align="left">&nbsp;</div>
       </td>
    </tr>
    <?
    }
    ?>

</table>
</form>
</div>