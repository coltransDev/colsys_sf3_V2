<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
$usuarios = $sf_data->getRaw("usuarios");

?>
<table class="tableList alignLeft" width="100%">
     <tr >
         <th colspan="3" ><b>Seguros</b></th>
     </tr>
     <tr>
         <td colspan="3">
           <?
            echo $form['ca_seguro']->renderError();
            if( $reporte && $reporte->getCaSeguro() ){
                $form->setDefault('ca_seguro', $reporte->getCaSeguro() );
            }else{
                $form->setDefault('ca_seguro', "No" );
            }
            echo $form['ca_seguro']->render();
            ?>
        </td>
    </tr>
    <tr id="seguros-row0">
         <td colspan="4">
             <b>Notificar Seguro:</b><br />

             <?
            echo $formSeguro['ca_seguro_conf']->renderError();
            if( $repseguro ){
                $formSeguro->setDefault('ca_seguro_conf', $repseguro->getCaSeguroConf() );
            }
            echo $formSeguro['ca_seguro_conf']->render();
            ?>
             
            </td>
    </tr>

	<tr id="seguros-row1">
        <td width="33%" ><b>Valor Asegurado:</b><br />
                <?
                echo $formSeguro['ca_vlrasegurado']->renderError();
                if( $repseguro ){
                    $formSeguro->setDefault('ca_vlrasegurado', $repseguro->getCaVlrasegurado() );
                }
                echo $formSeguro['ca_vlrasegurado']->render();
                ?>
                &nbsp;
                <?
                echo $repseguro->getCaIdmonedaVlr();
                echo $formSeguro['ca_idmoneda_vlr']->renderError();
                if( $repseguro && $repseguro->getCaIdmonedaVlr()){
                    $formSeguro->setDefault('ca_idmoneda_vlr', $repseguro->getCaIdmonedaVlr() );
                }else{
                    $formSeguro->setDefault('ca_idmoneda_vlr', "USD");
                }
                echo $formSeguro['ca_idmoneda_vlr']->render();
                ?>
				</td>
		<td width="33%" ><b>Obtenci&oacute;n P&oacute;liza:</b><br />
			<?
            echo $formSeguro['ca_obtencionpoliza']->renderError();
            if( $repseguro ){
                $formSeguro->setDefault('ca_obtencionpoliza', $repseguro->getCaObtencionpoliza() );
            }
            echo $formSeguro['ca_obtencionpoliza']->render();
            ?>
            &nbsp;
            <?
            echo $formSeguro['ca_idmoneda_pol']->renderError();
            if( $repseguro && $repseguro->getCaIdmonedaPol() ){
                $formSeguro->setDefault('ca_idmoneda_pol', $repseguro->getCaIdmonedaPol() );
            }else{
                $formSeguro->setDefault('ca_idmoneda_pol', "USD");
            }
            echo $formSeguro['ca_idmoneda_pol']->render();
            ?>
        </td>
		<td width="33%"><b>Prima Venta:</b>
            <?
            echo $formSeguro['ca_primaventa']->renderError();
            if( $repseguro ){
                $formSeguro->setDefault('ca_primaventa', $repseguro->getCaPrimaventa() );
            }
            echo $formSeguro['ca_primaventa']->render();
            ?>
            Min:
			<?			
            echo $formSeguro['ca_minimaventa']->renderError();
            if( $repseguro ){
                $formSeguro->setDefault('ca_minimaventa', $repseguro->getCaMinimaventa() );
            }
            echo $formSeguro['ca_minimaventa']->render();
            ?>
            &nbsp;
            <?
            echo $formSeguro['ca_idmoneda_vta']->renderError();
            if( $repseguro && $repseguro->getCaIdmonedaVta() ){
                $formSeguro->setDefault('ca_idmoneda_vta', $repseguro->getCaIdmonedaVta() );
            }else{
                $formSeguro->setDefault('ca_idmoneda_vta', "USD");
            }
            echo $formSeguro['ca_idmoneda_vta']->render();
            ?>
				</td>
	</tr>



</table>
