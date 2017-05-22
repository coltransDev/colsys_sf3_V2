<?php
/*
 * (c) Coltrans S.A. - Colmas Ltda.
 * 
 */

include_component("widgets", "widgetIds");
?>
<div class="content" align="center">

    <form action="<?= url_for("ino/formAuditoria?modo=" . $modo->getCaIdmodo() . "&idmaster=" . $idmaster) ?>" method="post">          

        <table class="tableList alignLeft" width="80%" border="0">
            <tr>
                <th colspan="6">
            <div align="center">
                Información del evento de Auditoría<br />
                <?= $referencia?>
            </div>
            </th>
            </tr>    

            <?
            if ($form->renderGlobalErrors()) {
                ?>
                <tr>
                    <td colspan="6">				
                        <div align="center"><?php echo $form->renderGlobalErrors() ?>		</div></td>	
                </tr>
                <?
            }
            ?>	
            <tr>
                <td >
                    <b>Asunto:</b>
                    <br />
                    <?
                    echo $form['ca_asunto']->renderError();
                    echo $form['ca_asunto']->render();
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <b>Detalle:</b><br />
                    <?
                    echo $form['ca_detalle']->renderError();
                    echo $form['ca_detalle']->render();
                    ?>
                </td>
            </tr>            
            <tr>
                <td colspan="6">
                    <div align="center">
                        <input type="submit" value="Guardar" class="button" />
                        &nbsp;
                        <input type="button" value="Cancelar" class="button" onclick="document.location='<?=url_for("ino/verReferencia?modo=".$modo->getCaIdmodo()."&idmaster=".$idmaster) ?>'" />
                    </div>
                </td>
            </tr>
        </table>
    </form>
</div>


