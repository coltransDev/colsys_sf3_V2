<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>

<table class="tableList alignLeft" width="100%">
     <tr >
         <th colspan="3" ><b>Aduana</b></th>
     </tr>
     <tr>
         <td colspan="3">
            <?
            echo $form['ca_colmas']->renderError();
            if( $reporte && $reporte->getCaColmas() ){
                $form->setDefault('ca_colmas', $reporte->getCaColmas() );
            }else{
                $form->setDefault('ca_colmas', "No" );
            }
            echo $form['ca_colmas']->render();
            ?>
        </td>
    </tr>
    <tr id="aduana-row0">
        <td >
            <div id="titulo-aduana" >
                <b>Transporte Nacional</b>

            </div>
        </td>
        <td  rowspan="3" valign="top"><b>Instrucciones Especiales</b><br />
			<?
            echo $formAduana['ca_instrucciones']->renderError();
            if( $reporte ){
                $formAduana->setDefault('ca_instrucciones', $repaduana->getCaInstrucciones() );
            }
            echo $formAduana['ca_instrucciones']->render();
            ?>            
		</td>
	</tr>
	<tr id="aduana-row1">
		<td >
            <b>Con Coltrans:</b>
            <?
            echo $formAduana['ca_transnacarga']->renderError();
            if( $reporte ){
                $formAduana->setDefault('ca_transnacarga', $repaduana->getCaTransnacarga() );
            }
            echo $formAduana['ca_transnacarga']->render();
            ?>			
        </td>
	</tr>
	<tr id="aduana-row2">
		<td ><b>Tipo:</b>
            <?
            echo $formAduana['ca_transnatipo']->renderError();
            if( $reporte ){
                $formAduana->setDefault('ca_transnatipo', $repaduana->getCaTransnatipo() );
            }
            echo $formAduana['ca_transnatipo']->render();
            ?>
			</td>
	</tr>
    <tr id="aduana-row3">
		<td >
            <b>Coordinador:</b>
            <?
            echo $formAduana['ca_coordinador']->renderError();
            if( $reporte ){
                $formAduana->setDefault('ca_coordinador', $repaduana->getCaCoordinador() );
            }else{

            }
            echo $formAduana['ca_coordinador']->render();
            ?>
        </td>
	</tr>



</table>
