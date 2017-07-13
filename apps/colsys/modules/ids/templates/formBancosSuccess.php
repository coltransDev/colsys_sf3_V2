<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>
<div class="content" align="center">
    <form action="<?=url_for("ids/formBancos?modo=".$modo)?>" method="post">
    <input type="hidden" name="idbanco" value="<?=$Banco->getCaIdbanco()?>" />
    <input type="hidden" name="id" value="<?=$Banco->getCaId()?>" />
    <table class="tableList alignLeft">
        <tr>
            <th>&nbsp;</th>
        </tr>
        <?
        if( $form->renderGlobalErrors() ){
        ?>
        <tr>
            <td >
             <div align="left"><?php echo $form->renderGlobalErrors() ?>		</div></td>
        </tr>
        <?
        }
        ?>
        <tr>
            <td>
                <b>Tipo de Cuenta:</b><br />
                <?
                echo $form['tipo_cuenta']->renderError();
                $form->setDefault('tipo_cuenta', $Banco->getCaTipoCuenta() );
				echo $form['tipo_cuenta']->render();
                ?>

            </td>
        </tr>
        <tr>
            <td>
                <b>Entidad Bancaria:</b><br />
                <?
                echo $form['codigo_entidad']->renderError();
                $form->setDefault('codigo_entidad', $Banco->getCaCodigoEntidad() );
				echo $form['codigo_entidad']->render();
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <b>Número de Cuenta:</b><br />
                <?
                echo $form['numero_cuenta']->renderError();
                $form->setDefault('numero_cuenta', $Banco->getCaNumeroCuenta() );
                		echo $form['numero_cuenta']->render();
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <b>Observaciones:</b><br />
                <?
                echo $form['observaciones']->renderError();
                $form->setDefault('observaciones', $Banco->getCaObservaciones() );
                		echo $form['observaciones']->render();
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <div align="center">
                    <input type="submit" value="Guardar" class="button" />
                    
                    <input type="button" value="Cancelar" class="button" onClick="document.location='<?=$url?>'" />
                </div>
            </td>
        </tr>
        
    </table>
    </form>

</div>


