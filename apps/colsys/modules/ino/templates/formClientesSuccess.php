<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>


<div class="content" align="center">

    <h1>Sistema Administrador de Referencias</h1>
    <br />
    <form action="<?=url_for("ino/formClientes")?>" method="post">
        <?
        echo $form->renderHiddenFields();

        if( $referencia->getCaIdmaestra() ){
        ?>
        <input type="hidden" name="id" value="<?=$referencia->getCaIdmaestra()?>">
        <?
        }

        if( $inoCliente && $inoCliente->getCaIdinocliente() ){
        ?>
        <input type="hidden" name="idinocliente" value="<?=$inoCliente->getCaIdinocliente()?>">
        <?
        }

        ?>
        <table class="tableList" width="80%">
            <tr>
                <th colspan="6">Datos para la referencia</th>
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
                <td width="17%"><b>Reporte</b></td>
                <td width="17%">
                    <?
                    echo $form['ca_idreporte']->renderError();
                    if( $inoCliente ){
                        $form->setDefault('ca_idreporte', $inoCliente->getCaIdreporte() );
                    }
                    echo $form['ca_idreporte']->render();
                    ?>

                </td>
                <td width="16%"><b>Vendedor</b></td>
                <td width="16%">
                    <?
                    echo $form['ca_vendedor']->renderError();
                    if( $inoCliente ){
                        $form->setDefault('ca_vendedor', $inoCliente->getCaVendedor() );
                    }
                    echo $form['ca_vendedor']->render();
                    ?>
                </td>
                <td width="17%"><b>&nbsp;</b></td>
                <td width="17%">&nbsp;</td>
            </tr>
            <tr class="row0">
                <td colspan="6"><b>Datos del cliente</b></td>
            </tr>
            
             <tr>
                <td><b>Cliente</b></td>
                <td colspan="3">
                    <?
                    echo $form['ca_idcliente']->renderError();
                    if( $inoCliente ){
                        $form->setDefault('ca_idcliente', $inoCliente->getCaIdcliente() );
                    }
                    echo $form['ca_idcliente']->render();
                    ?>                    
                </td>
                <td><b>&nbsp;</b></td>
                <td>&nbsp;</td>
                        
            </tr>
            <tr>
                <td><b>Orden del Cliente</b></td>
                <td>
                    <?
                    echo $form['ca_numorden']->renderError();
                    if( $inoCliente ){
                        $form->setDefault('ca_numorden', $inoCliente->getCaNumorden() );
                    }
                    echo $form['ca_numorden']->render();
                    ?>
                </td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><b>&nbsp;</b></td>
                <td>&nbsp;</td>
            </tr>

            <tr>
                <td><b>Proveedor</b></td>
                <td>
                    <?
                    echo $form['ca_idproveedor']->renderError();
                    if( $inoCliente ){
                        $form->setDefault('ca_idproveedor', $inoCliente->getCaIdproveedor() );
                    }
                    echo $form['ca_idproveedor']->render();
                    ?>
                </td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><b>&nbsp;</b></td>
                <td>&nbsp;</td>
            </tr>

            <tr class="row0">
                <td colspan="6"><b>Datos de la carga</b></td>
            </tr>
            <tr>
                <td><b>HBL</b></td>
                <td>
                    <?
                    echo $form['ca_hbls']->renderError();
                    if( $inoCliente ){
                        $form->setDefault('ca_hbls', $inoCliente->getCaHbls() );
                    }
                    echo $form['ca_hbls']->render();
                    ?>
                </td>
                <td><b>Fecha HBL</b></td>
                <td>
                    <?
                    echo $form['ca_fchhbls']->renderError();
                    if( $inoCliente ){
                        $form->setDefault('ca_fchhbls', Utils::parseDate($inoCliente->getCaFchhbls(), "Y-m-d") );
                    }
                    echo $form['ca_fchhbls']->render();
                    ?>
                </td>
                <td><b>&nbsp;</b></td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><b>Piezas</b></td>
                <td>
                    <?
                    echo $form['ca_numpiezas']->renderError();
                    if( $inoCliente ){
                        $form->setDefault('ca_numpiezas', $inoCliente->getCaNumpiezas() );
                    }
                    echo $form['ca_numpiezas']->render();
                    ?>
                </td>
                <td><b>Peso</b></td>
                <td>
                    <?
                    echo $form['ca_peso']->renderError();
                    if( $inoCliente ){
                        $form->setDefault('ca_peso', $inoCliente->getCaPeso() );
                    }
                    echo $form['ca_peso']->render();
                    ?>
                </td>
                 <td><b>Volumen</b></td>
                <td>
                    <?
                    echo $form['ca_volumen']->renderError();
                    if( $inoCliente ){
                        $form->setDefault('ca_volumen', $inoCliente->getCaVolumen() );
                    }
                    echo $form['ca_volumen']->render();
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <div align="center">
                        <input type="submit" value="Guardar" class="button" />

                        <?

                        $url = "ino/verReferencia?id=".$referencia->getCaIdmaestra()."&modo=".$modo;

                        ?>
                        <input type="button" value="Cancelar" class="button" onClick="document.location='<?=url_for($url)?>'" />
                    </div>
                </td>
            </tr>
        </table>
    </form>




</div>