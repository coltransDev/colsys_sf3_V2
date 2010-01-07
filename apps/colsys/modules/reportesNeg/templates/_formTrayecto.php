<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>
<table class="tableList alignLeft" width="100%">
    <tr>
        <th colspan="4"><b>Datos del trayecto</b></th>
    </tr>
    <tr>
        <td><b>Transporte</b></td>
        <td>
             <?
            echo $form['ca_transporte']->renderError();
            if( $reporte ){
                $form->setDefault('ca_transporte', $reporte->getCaTransporte() );
            }
            echo $form['ca_transporte']->render();
            ?>
        </td>
        <td><b>Modalidad</b></td>
        <td>
            <?
            echo $form['ca_modalidad']->renderError();
            if( $reporte ){
                $form->setDefault('ca_modalidad', $reporte->getCaModalidad() );
            }
            echo $form['ca_modalidad']->render();
            ?>

        </td>
    </tr>
    <tr>
        <td><b>Origen</b></td>
        <td>
            <?
            echo $form['ca_origen']->renderError();
            if( $reporte ){
                $form->setDefault('ca_origen', $reporte->getCaOrigen() );
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
            if( $reporte ){
                $form->setDefault('destino', $reporte->getCaDestino() );
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
            if( $reporte ){
                $form->setDefault('ca_idlinea', $reporte->getCaIdlinea() );
            }
            echo $form['ca_idlinea']->render();
            ?>
        </td>

    </tr>
    <tr id="row-agente">
         <td><b>Agente</b></td>
         <td colspan="3">
            <?
            echo $form['ca_idagente']->renderError();
            if( $reporte ){
                $form->setDefault('ca_idagente', $reporte->getCaIdagente() );
            }
            echo $form['ca_idagente']->render();
            ?>
        </td>

    </tr>


    <tr>
         <td><b>Mercancia</b></td>
         <td colspan="3">
            <?
            echo $form['ca_mercancia_desc']->renderError();
            if( $reporte ){
                $form->setDefault('ca_mercancia_desc', $reporte->getCaMercanciaDesc() );
            }
            echo $form['ca_mercancia_desc']->render();
            ?>
            <br />
            <b>¿Es mercancia peligrosa?</b>
            <?
            echo $form['ca_mcia_peligrosa']->renderError();
            if( $reporte ){
                $form->setDefault('ca_mcia_peligrosa', $reporte->getCaMciaPeligrosa() );
            }
            echo $form['ca_mcia_peligrosa']->render();
            ?>
        </td>
    </tr>
</table>