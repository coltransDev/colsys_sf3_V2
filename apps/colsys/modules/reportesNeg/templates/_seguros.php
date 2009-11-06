<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
$usuarios = $sf_data->getRaw("usuarios");

?>
<table class="tableList" width="100%">
     <tr >
         <th colspan="3" ><b>Seguros</b></th>
     </tr>
     <tr>
         <td colspan="3">
           <?
            echo $form['ca_seguro']->renderError();
            if( $reporte ){
                $form->setDefault('ca_seguro', $reporte->getCaSeguro() );
            }
            echo $form['ca_seguro']->render();
            ?>
        </td>
    </tr>
    <tr id="seguros-row0">
         <td colspan="4">
             <b>Notificar Seguro:</b>
             <table class="tableList" width="100%">
                <?
                $count = count( $usuarios );
                $k = 0;
                for($i=0; $i<round($count-(round($count%3))/3)/3; $i++) {
                    ?>
                <tr>
                    <?
                    for($j=0; $j<3; $j++) {
                        if( isset($usuarios[$k]) ){
                            $usuario = $usuarios[$k];
                            
                            $checked = false;
                            if( $seguro_conf==$usuario->getCaLogin() ){
                                $checked = true;
                            }elseif( (!$repseguro->getCaSeguroConf()&&$usuario->getCaEmail()=="seguros@coltrans.com.co") ||  $repseguro->getCaSeguroConf()==$usuario->getCaLogin() ){
                                $checked = true;
                            }

                            ?>
                            <td>
                                <input type="radio" name="seguro_conf" value="<?=$usuario->getCaLogin()?>"  <?=$checked?"checked='checked'":""?> />
                                <?                                
                                echo $usuario->getCaNombre();
                                ?>
                            </td>
                        <?
                        }else{
                        ?>
                            <td>&nbsp;</td>
                        <?
                        }
                        $k++;

                    }
                    ?>
                </tr>
                <?
                }
                ?>
                </table>
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
                echo $formSeguro['ca_idmoneda_vlr']->renderError();
                if( $repseguro ){
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
            if( $repseguro ){
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
            if( $repseguro ){
                $formSeguro->setDefault('ca_idmoneda_vta', $repseguro->getCaIdmonedaVta() );
            }else{
                $formSeguro->setDefault('ca_idmoneda_vta', "USD");
            }
            echo $formSeguro['ca_idmoneda_vta']->render();
            ?>
				</td>
	</tr>



</table>
