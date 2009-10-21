<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */




?>
<script>

ciudades = [];




</script>
<div align="center" class="content">
    <h1>Sistema Administrador de Referencias</h1>
    <br />
    <form action="<?=url_for("ino/formIno")?>" method="post">
        <?
        echo $form->renderHiddenFields();
        
        if( $referencia->getCaIdmaestra() ){
        ?>
        <input type="hidden" name="id" value="<?=$referencia->getCaIdmaestra()?>">
        <?
        }
        
        ?>
        <table class="tableList" width="80%">
            <tr>
                <th colspan="4">Datos para la referencia</th>
            </tr>
            <?
            if( $form->renderGlobalErrors() ){
            ?>
            <tr>
                <td colspan="4">
                 <div align="left"><?php echo $form->renderGlobalErrors() ?>		</div></td>
            </tr>
            <?
            }
            ?>
            <tr>                
                <td width="25%"><b>Mes de grabaci&oacute;n</b></td>
                <td width="25%">&nbsp;</td>
                <td width="25%"><b>A&ntilde;o de grabaci&oacute;n</b></td>
                <td width="25%">&nbsp;</td>
            </tr>
            <tr class="row0">
                <td colspan="4"><b>Datos del trayecto</b></td>
            </tr>
            <?
            $trayecto = $referencia->getTrayecto();
            ?>
            <tr>
                <td><b>Clase</b></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>                
            </tr>
            <tr>
                <td><b>Transporte</b></td>
                <td>&nbsp;</td>
                <td><b>Modalidad</b></td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><b>Origen</b></td>
                <td>
                    <?
                    echo $trayectoForm['ca_origen']->renderError();
                    if( $trayecto ){
                        $trayectoForm->setDefault('ca_origen', $trayecto->getCaOrigen() );
                    }
                    echo $trayectoForm['ca_origen']->render();
                    ?>
                </td>
                <td>
                    <b>Destino</b>
                </td>
                <td>
                    <?
                    echo $trayectoForm['ca_destino']->renderError();
                    if( $trayecto ){
                        $trayectoForm->setDefault('destino', $trayecto->getCaDestino() );
                    }
                    echo $trayectoForm['ca_destino']->render();
                    ?>
                </td>
              </tr>
              
             <tr>
                 <td><b>Linea</b></td>
                 <td colspan="3">
                    <?
                    echo $trayectoForm['ca_idlinea']->renderError();
                    if( $trayecto ){
                        $trayectoForm->setDefault('ca_idlinea', $trayecto->getCaIdlinea() );
                    }
                    echo $trayectoForm['ca_idlinea']->render();
                    ?>
                </td>
                
            </tr>
            <tr>
                 <td><b>Agente</b></td>
                 <td colspan="3">
                    <?
                    echo $trayectoForm['ca_idagente']->renderError();
                    if( $trayecto ){
                        $trayectoForm->setDefault('ca_idagente', $trayecto->getCaIdagente() );
                    }
                    echo $trayectoForm['ca_idagente']->render();
                    ?>
                </td>

            </tr>
           <tr class="row0">
                <td colspan="4"><b>Datos de la guia</b></td>
            </tr>
            <tr>
                <td><b>Master:</b></td>
                <td>
                    <?
                    echo $form['ca_master']->renderError();
                    if( $referencia ){
                        $form->setDefault('ca_fchreferencia', $referencia->getCaMaster() );
                    }
                    echo $form['ca_master']->render();
                    ?>
                </td>
                <td><b>Fch Master</b></td>
                <td>
                     <?
                    echo $form['ca_fchmaster']->renderError();
                    if( $referencia ){
                        $form->setDefault('ca_fchreferencia', $referencia->getCaFchreferencia() );
                    }
                    echo $form['ca_fchmaster']->render();
                    ?>

                </td>                
            </tr>
            <tr>
                <td colspan="4">
                    <div align="center">
                        <input type="submit" value="Guardar" class="button" />
                        <?
                        if( $referencia->isNew() ){
                            $url = "ino/index?modo=".$modo;
                        }else{
                            $url = "ino/verReferencia?id=".$referencia->getCaIdmaestra()."&modo=".$modo;
                        }
                        ?>
                        <input type="button" value="Cancelar" class="button" onClick="document.location='<?=url_for($url)?>'" />
                    </div>
                
                </td>

            </tr>
        </table>
    </form>



</div>