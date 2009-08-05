<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>



<div class="content" align="center">
    <form action="<?=url_for("ids/formEventos")?>" method="post">
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
            <td>
                Tipo de evento:<br />
                <?
                echo $form['tipo_evento']->renderError();
				echo $form['tipo_evento']->render();
                ?>

            </td>

            <td>
                Proveedor:<br />
                <?
                //echo $form['id_proveedor']->renderError();
				//echo $form['id_proveedor']->render();
                ?>

            </td>
        </tr>
        <tr>
            <td colspan="2">
                Evento:<br />
                <?
                echo $form['evento']->renderError();
				echo $form['evento']->render();
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div align="center"><input type="submit" value="Guardar" class="button" /></div>
            </td>
        </tr>
        
    </table>
    </form>

</div>


