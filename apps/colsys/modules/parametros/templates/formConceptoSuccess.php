<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>
<div class="content" align="center" >
    <form action="<?=url_for("parametros/formConcepto")?>" method="post" >
        <input type="hidden" name="idconcepto" value="<?=$concepto->getCaIdconcepto()?>" />
        <table width="60%" class="tableList">
            <tr>
                <th colspan="4">
                    Datos del concepto
                </th>
            </tr>
            <tr>
                <td>
                    <b>Id:</b>
                </td>
                <td>
                    &nbsp;
                </td>
                <td>
                    <b>Tipo:</b>
                </td>
                <td >
                    <?
                    echo $form['ca_tipo']->renderError();
                    if( $concepto ){
                        $form->setDefault('ca_tipo', $concepto->getCaTipo() );
                    }
                    echo $form['ca_tipo']->render();
                    ?>
                </td>
            </tr>

             <tr>
                <td >
                    <b>Concepto:</b>
                </td>
                <td colspan="3">
                    <?
                    echo $form['ca_concepto']->renderError();
                    if( $concepto ){
                        $form->setDefault('ca_concepto', $concepto->getCaConcepto() );
                    }
                    echo $form['ca_concepto']->render();
                    ?>

                </td>
            </tr>

            <tr>
                <td colspan="4">
                    <table width="100%" class="tableList">
                        <tr>
                            <th>
                                <b>Clase:</b>
                            </th>                            
                             <th>
                                <b>Transporte:</b>
                            </th>                            
                            <th>
                                <b>Modalidad:</b>
                            </th>
                            <th>
                               &nbsp;
                            </th>
                        </tr>
                        <tr>
                            <td>

                            </td>
                            <td>

                            </td>
                            <td>

                            </td>
                            <td>

                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                &nbsp;
                            </td>
                            <td>
                                <div align="center"><?=image_tag("16x16/edit_add.gif")?></div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <?
            /*
            <tr>
                <td>
                    <b>Comisionable:</b>
                </td>
                <td>
                    <?
                    echo $form['ca_comisionable']->renderError();
                    if( $concepto ){
                        $form->setDefault('ca_comisionable', $concepto->getCaComisionable() );
                    }
                    echo $form['ca_comisionable']->render();
                    ?>
                </td>
                <td>
                    &nbsp;
                </td>
                <td>
                    &nbsp;
                </td>
            </tr>
             */
            ?>
            <tr>
                <td colspan="4">
                    <div align="center">
                        <input class="button" type="submit" value="Guardar" />
                        &nbsp;
                        <?                        
                        $url = "parametros/index";                        
                        ?>
                        <input class="button" type="button" value="Cancelar" onclick="document.location='<?=url_for($url)?>'" />
                    </div>
                </td>

            </tr>

        </table>

    </form>
</div>

<script type="text/javascript">
    llenarModalidades("ino_concepto_ca_transporte", "ino_concepto_ca_modalidad");
</script>