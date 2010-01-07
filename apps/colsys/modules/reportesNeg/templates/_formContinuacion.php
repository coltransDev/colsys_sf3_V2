<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
//$usuarios = $sf_data->getRaw("usuarios");

?>
<table class="tableList alignLeft" width="100%">
     <tr >
         <th colspan="4" ><b>Continuaci&oacute;n de viaje</b></th>
     </tr>
     <tr>
         <td colspan="4">
           <?
            echo $form['ca_continuacion']->renderError();
            if( $reporte ){
                $form->setDefault('ca_continuacion', $reporte->getCaContinuacion() );
            }
            echo $form['ca_continuacion']->render();
            ?>
        </td>
    </tr>
    <tr id="continuacion-row0">
        <td width="33%" valign="top" ><b>Destino Final:</b><br />
                <?
                echo $form['ca_continuacion_dest']->renderError();
                if( $reporte ){
                    $form->setDefault('ca_continuacion_dest', $reporte->getCaContinuacionDest() );
                }
                echo $form['ca_continuacion_dest']->render();
                ?>
                
                
				</td>
                <td width="67%" valign="top" >
                <b>Notificar a:</b><br />

                <?
                echo $form['ca_continuacion_conf']->renderError();
                if( $reporte ){
                    $form->setDefault('ca_continuacion_conf', $reporte->getCaContinuacionConf() );
                }
                echo $form['ca_continuacion_conf']->render();
                ?>
        </td>
    </tr>
</table>
