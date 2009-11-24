<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>
<script language="javascript" type="text/javascript">
    var checkTipo = function(){
        Ext.Ajax.request(
        {
            waitMsg: 'Comprobando ID...',
            url: '<?=url_for("inotipocomprobante/comprobarTipo")?>',
            //Solamente se envian los cambios
            params :	{tipo:document.getElementById("ino_tipo_comprobante_ca_tipo").value,
                         comprobante:document.getElementById("ino_tipo_comprobante_ca_comprobante").value
                        },

            callback :function(options, success, response){

                var res = Ext.util.JSON.decode( response.responseText );
                //alert(res.id);
                if(res.id){
                    if( confirm("Ya existe un comprobante con este numero, ¿Desea editar este comprobante?") ){
                        document.location = '<?=url_for("inotipocomprobante/formTipo")?>?id='+res.id
                    }else{
                        comprobante:document.getElementById("ino_tipo_comprobante_ca_comprobante").value="";
                    }
                }
            }
         }
        );

    }


</script>
<div align="center" class="content">
    <h1>Parametrizaci&oacute;m de tipos de comprobante</h1>
    <br />
    <br />
    <form action="<?=url_for("inotipocomprobante/formTipo")?>" method="post">
        <input type="hidden" name="id" value="<?=$tipo->getCaIdtipo()?>">
    <table class="tableList" width="80%">
        <tr>
            <th colspan="4">
                Tipos de comprobante
            </th>
        </tr>
         <?
            if( $form->hasErrors() ){
            ?>
            <tr>
                <td colspan="4">
                    <ul class="error_list">
                        <li><div align="center">Hay un error, por favor verifique los datos digitados.</div></li>
                    </ul>
                </td>
            </tr>
            <?
            }
            ?>
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
            <td>
                <b>Tipo</b>
            </td>
            <td>
                <?
                echo $form['ca_tipo']->renderError();
                if( $tipo ){
                    $form->setDefault('ca_tipo', $tipo->getCaTipo() );
                }
                echo $form['ca_tipo']->render();
                ?>
                
            </td>
            <td>
                <b>Comprobante</b>
            </td>
            <td>
                <?
                echo $form['ca_comprobante']->renderError();
                if( $tipo ){
                    $form->setDefault('ca_comprobante', $tipo->getCaComprobante() );
                }
                echo $form['ca_comprobante']->render();
                ?>

            </td>
        </tr>

        <tr>
            <td>
                <b>Numeraci&oacute;n inicial</b>
            </td>
            <td>
                <?
                echo $form['ca_numeracion_inicial']->renderError();
                if( $tipo ){
                    $form->setDefault('ca_numeracion_inicial', $tipo->getCaNumeracionInicial() );
                }
                echo $form['ca_numeracion_inicial']->render();
                ?>

            </td>
            <td>
                <b>Activo</b>
            </td>
            <td>
                <?
                echo $form['ca_activo']->renderError();
                if( $tipo ){
                    $form->setDefault('ca_activo', $tipo->getCaActivo() );
                }else{
                    $form->setDefault('ca_activo', true );
                }
                echo $form['ca_activo']->render();
                ?>
            </td>
        </tr>
       
        <tr>
            <td>
                <b>Titulo</b>
            </td>
            <td colspan="3">
                <?
                echo $form['ca_titulo']->renderError();
                if( $tipo ){
                    $form->setDefault('ca_titulo', $tipo->getCaTitulo() );
                }
                echo $form['ca_titulo']->render();
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <b>Descripci&oacute;n</b>
            </td>
            <td colspan="3">
                <?
                echo $form['ca_descripcion']->renderError();
                if( $tipo ){
                    $form->setDefault('ca_descripcion', $tipo->getCaDescripcion() );
                }
                echo $form['ca_descripcion']->render();
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <b>Mensaje</b>
            </td>
            <td colspan="3">
                <?
                echo $form['ca_mensaje']->renderError();
                if( $tipo ){
                    $form->setDefault('ca_mensaje', $tipo->getCaDescripcion() );
                }
                echo $form['ca_mensaje']->render();
                ?>
            </td>
        </tr>
        <tr class="row0">
            <td colspan="4">
                <b>Resoluci&oacute;n DIAN</b>
            </td>
        </tr>

        <tr>
            <td>
                <b>Numero de autorizaci&oacute;n DIAN</b>
            </td>
            <td >
                <?
                echo $form['ca_noautorizacion']->renderError();
                if( $tipo ){
                    $form->setDefault('ca_noautorizacion', $tipo->getCaNoautorizacion() );
                }
                echo $form['ca_noautorizacion']->render();
                ?>
            </td>
            <td>
                <b>Prefijo</b>
            </td>
            <td >
                <?
                echo $form['ca_prefijo_aut']->renderError();
                if( $tipo ){
                    $form->setDefault('ca_prefijo_aut', $tipo->getCaPrefijoAut() );
                }
                echo $form['ca_prefijo_aut']->render();
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <b>Numero Inicial autorizado</b>
            </td>
            <td >
                <?
                echo $form['ca_inicial_aut']->renderError();
                if( $tipo ){
                    $form->setDefault('ca_inicial_aut', $tipo->getCaInicialAut() );
                }
                echo $form['ca_inicial_aut']->render();
                ?>
            </td>
            <td>
                <b>Numero Final autorizado</b>
            </td>
            <td >
                <?
                echo $form['ca_final_aut']->renderError();
                if( $tipo ){
                    $form->setDefault('ca_final_aut', $tipo->getCaFinalAut() );
                }
                echo $form['ca_final_aut']->render();
                ?>
            </td>
        </tr>
        <tr >
            <td colspan="4">
                <div align="center">
                    <input type="submit" value="Guardar" class="button" />
                    &nbsp;
                    <input type="button" value="Cancelar" class="button" onclick="document.location='<?=url_for("inotipocomprobante/index")?>'"/>
                </div>
            </td>
        </tr>
</table>
</form>
</div>