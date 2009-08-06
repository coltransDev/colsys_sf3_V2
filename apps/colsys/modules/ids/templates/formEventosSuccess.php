<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>



<div class="content" align="center">
    <form action="<?=url_for("ids/formEventos?modo=".$modo)?>" method="post">
    <?
    if( !$modo ){
        ?>
        <input type="hidden" name="referencia" value="<?=$numreferencia?>" />
        <?
    }
    ?>
    <table class="tableList" width="50%">
        <tr>
            <th colspan="2">&nbsp;</th>
        </tr>
        <?
        if( $form->renderGlobalErrors() ){
        ?>
        <tr>
            <td colspan="2" >
             <div align="left"><?php echo $form->renderGlobalErrors() ?>		</div></td>
        </tr>
        <?
        }
        ?>
        <tr>
            <td width="25%">
                <b>Tipo de evento:</b><br />
                <?
                echo $form['tipo_evento']->renderError();
				echo $form['tipo_evento']->render();
                ?>

            </td>

            <td width="25%">
                <b>Proveedor:</b><br />
                <?
                if( $modo ){
                    echo $ids->getCaNombre();
                ?>
                <input type="hidden" name="id" value="<?=$ids->getCaId()?>">
                <?
                }else{
                    echo $form['id']->renderError();
                    echo $form['id']->render();
                }
                ?>

            </td>
        </tr>
        <tr>
            <td colspan="2">
                <b>Evento:</b><br />
                <?
                echo $form['evento']->renderError();
				echo $form['evento']->render();
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div align="center">
                    <input type="submit" value="Guardar" class="button" />
                    
                    <input type="button" value="Cancelar" class="button" onClick="document.location='<?=$url?>'" />
                </div>
            </td>
        </tr>
        
    </table>
    </form>

</div>


