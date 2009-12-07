<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */




?>
<script type="text/javascript">

ciudades = [];

function cambiarImpoexpo(){
    cambiarTransporte();
}

function cambiarTransporte(){
    llenarModalidades('ino_maestra_ca_impoexpo','ino_maestra_ca_transporte', 'ino_maestra_ca_idmodalidad', false, '');
    llenarLineas('ino_maestra_ca_transporte', 'ino_maestra_ca_idlinea', false, '');
    //llenarAgentes('reporte_ca_impoexpo','reporte_ca_transporte', 'reporte_ca_modalidad', null, '');

}



</script>
<div align="center" class="content">
    <h1>Sistema Administrador de Referencias</h1>
    <br />
    <form action="<?=url_for("ino/formIno?modo=".$modo)?>" method="post">
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
            $modalidad = $referencia->getModalidad();
            ?>
            <tr>
                <td><b>Clase</b></td>
                <td>
                    <?
                    echo $form['ca_impoexpo']->renderError();
                    if( $referencia ){
                        $form->setDefault('ca_impoexpo', $modalidad->getCaImpoexpo() );
                    }
                    echo $form['ca_impoexpo']->render();
                    ?>
                </td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>                
            </tr>
            <tr>
                <td><b>Transporte</b></td>
                <td>
                    <?
                    echo $form['ca_transporte']->renderError();
                    if( $referencia ){
                        $form->setDefault('ca_transporte', $modalidad->getCaTransporte() );
                    }
                    echo $form['ca_transporte']->render();
                    ?>
                </td>
                <td><b>Modalidad</b></td>
                <td>
                    <?
                    echo $form['ca_idmodalidad']->renderError();
                    if( $referencia ){
                        $form->setDefault('ca_idmodalidad', $modalidad->getCaModalidad() );
                    }
                    echo $form['ca_idmodalidad']->render();
                    ?>
                </td>
            </tr>
            <tr>
                <td><b>Origen</b></td>
                <td>
                    <?
                    echo $form['ca_origen']->renderError();
                    if( $referencia ){
                        $form->setDefault('ca_origen', $referencia->getCaOrigen() );
                    }
                    echo $form['ca_origen']->render();
                    ?>
                </td>
                <td>
                    <b>Destino</b>
                </td>
                <td>
                    <?
                    echo $form['ca_destino']->renderError();
                    if( $referencia ){
                        $form->setDefault('ca_destino', $referencia->getCaDestino() );
                    }
                    echo $form['ca_destino']->render();
                    ?>
                </td>
              </tr>
              
             <tr>
                 <td><b>Linea</b></td>
                 <td colspan="3">
                    <?
                    echo $form['ca_idlinea']->renderError();
                    if( $referencia ){
                        $form->setDefault('ca_idlinea', $referencia->getCaIdlinea() );
                    }
                    echo $form['ca_idlinea']->render();
                    ?>
                </td>
                
            </tr>
            <tr>
                 <td><b>Agente</b></td>
                 <td colspan="3">
                    <?
                    echo $form['ca_idagente']->renderError();
                    if( $referencia ){
                        $form->setDefault('ca_idagente', $referencia->getCaIdagente() );
                    }
                    echo $form['ca_idagente']->render();
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
                        $form->setDefault('ca_master', $referencia->getCaMaster() );
                    }
                    echo $form['ca_master']->render();
                    ?>
                </td>
                <td><b>Fch Master</b></td>
                <td>
                     <?
                    echo $form['ca_fchmaster']->renderError();
                    if( $referencia ){
                        $form->setDefault('ca_fchmaster', $referencia->getCaFchmaster() );
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

<script type="text/javascript">

cambiarTransporte();

</script>


