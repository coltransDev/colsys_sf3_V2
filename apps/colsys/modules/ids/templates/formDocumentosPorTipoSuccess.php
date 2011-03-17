<?php

?>

<div class="content" align="center">
	<h3>Documentos por tipo de proveedor</h3>
	<br />
	<form action="<?=url_for("ids/formDocumentosPorTipo?modo=".$modo)?>" method="post">
	<?
	echo $form['tipo']->renderError();
	$form->setDefault('tipo', $tipo );
	echo $form['tipo']->render();
	
	echo $form['iddocumentosxtipo']->renderError();
	$form->setDefault('iddocumentosxtipo', $docPortipo->getCaIddocumentosxtipo() );
	echo $form['iddocumentosxtipo']->render();
	?>

	<table cellspacing="1" width="50%" class="tableList alignLeft">
		<tbody>
			<tr>
				<th >Datos del documento</th>
			</tr>
			<?
			if( $form->renderGlobalErrors() ){
			?>
			<tr>
				<td >
                    <div align="left"><?php echo $form->renderGlobalErrors() ?>		</div>
                </td>
			</tr>
			<?
			}
			?>
            <tr>
                <td>
                    <b>Tipo de Documento</b><br/>
                    <?
                    echo $form['idtipo']->renderError();
                    $form->setDefault('idtipo', $docPortipo->getCaIdtipo() );
                    echo $form['idtipo']->render();
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <b>Controlado Por SIG</b><br/>
                    <?
                    echo $form['controladoporsig']->renderError();
                    $form->setDefault('controladoporsig', $docPortipo->getCaControladoxsig() );
                    echo $form['controladoporsig']->render();
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <b>Impo/Expo</b><br/>
                    <?
                    echo $form['impoexpo']->renderError();
                    $form->setDefault('impoexpo', $docPortipo->getCaImpoexpo() );
                    echo $form['impoexpo']->render();
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <b>Transporte</b><br/>
                    <?
                    echo $form['transporte']->renderError();
                    $form->setDefault('transporte', $docPortipo->getCaTransporte() );
                    echo $form['transporte']->render();
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <div align="center">
                        <input type="submit" value="Guardar" class="button" />&nbsp;

                        <?
                        $url = "ids/documentosPorTipo?modo=".$modo;
                        ?>
                        <input type="button" value="Cancelar" class="button" onClick="document.location='<?=url_for($url)?>'" />
                    </div>
               </td>
           </tr>
    </table>
    </form>
</div>




