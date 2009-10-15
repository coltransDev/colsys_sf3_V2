<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>

<div class="content" align="center">
    <form action="<?=url_for("ids/formDocumentos?modo=".$modo."&id=".$ids->getCaId() )?>" method="post" name="form1" enctype="multipart/form-data" >
    <?
     echo $form['iddocumento']->renderError();
    if( $documento ){
        $form->setDefault('iddocumento', $documento->getCaIddocumento() );
    }
    echo $form['iddocumento']->render();
    ?>
<table class="tableList">
    <tr>
		<th colspan="6"><div align="left"><b>Nuevo Documento</b></div></th>
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
		<td> <div align="left"><b>Tipo:</b></div></td>
		<td><div align="left">
            <?

            if( $documento ){
                echo $documento->getIdsTipoDocumento() ;
                ?>
                <input type="hidden" name="idtipo" value="<?=$documento->getCaIdtipo()?>" />
                <?
            }else{
                echo $form['idtipo']->renderError();
                echo $form['idtipo']->render();
            }
            
            ?>

            </div></td>
        <td><div align="left"><b> Archivo: </b></div></td>
		<td><div align="left">
            <?
            echo $form['archivo']->renderError();
            echo $form['archivo']->render();
            ?>

            </div></td>
		<td><div align="left">&nbsp;</div></td>
		<td><div align="left">&nbsp;</div></td>
	</tr>

    <tr>
		<td> <div align="left"><b>Inicio:</b></div></td>
		<td><div align="left">
            <?
            /*if( $documento ){
                echo Utils::fechaMes($documento->getCaFchinicio()) ;
                 ?>
                <input type="hidden" name="inicio" value="<?=$documento->getCaFchinicio()?>" />
                <?
            }else{*/
                echo $form['inicio']->renderError();
                if( $documento ){
                    $form->setDefault('inicio', $documento->getCaFchinicio() );
                }
                echo $form['inicio']->render();
            //}
            ?>
            </div></td>
        <td><div align="left"><b> Vencimiento: </b></div></td>
		<td><div align="left">
            <?
            /*if( $documento ){
                echo Utils::fechaMes($documento->getCaFchvencimiento()) ;

            }else{*/
                echo $form['vencimiento']->renderError();
                if( $documento ){
                    $form->setDefault('vencimiento', $documento->getCaFchvencimiento() );
                }
                echo $form['vencimiento']->render();
            //}
            ?>
            </div></td>
		<td><div align="left">&nbsp;</div></td>
		<td><div align="left">&nbsp;</div></td>
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

</table>
</form>
</div>

