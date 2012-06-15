<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
$contactos = $sf_data->getRaw("contactos");
$reporte = $sf_data->getRaw("reporte");
?>
<table class="tableList" width="100%">
    <tr>
        <th colspan="2">Preferencias Cliente</th>
    </tr>
    <tr>
        <td  >Preferencias del cliente:<br />
                <?
                echo $form['ca_preferencias_clie']->renderError();
                if( $reporte ){
                    $form->setDefault('ca_preferencias_clie', $reporte->getCaPreferenciasClie() );
                }
                echo $form['ca_preferencias_clie']->render();
                ?>

        </td>
        <td  rowspan="2"  valign="top"><!--Informaciones a: -->

            Informaciones a:<br />
            <table cellspacing="1" cellpadding="0" width="150" border="0" >
                <tbody>
                    <?
                    if( $contactos ){
                        $confirmar = $contactos;
                    }else{
                        $confirmar = explode(",",$reporte->getCaConfirmarClie());
                    }

                    if( $reporte->getCliente() ){
                        $correos = explode(",", $reporte->getCliente()->getCaConfirmar());
                    }else{
                        $correos = array();
                    }

                    foreach( $correos as $key=>$val ){
                        $correos[$key] = trim($val);
                    }

                    for( $i=0; $i<NuevoReporteForm::NUM_CC; $i++ ){
                    ?>
                    <tr>
                        <td width="130">
                            <?
                            echo $form['contactos_'.$i]->renderError();
                            if( isset($correos[$i])&&$correos[$i] ){
                                $form->setDefault('contactos_'.$i, $correos[$i] );
                            }
                            echo $form['contactos_'.$i]->render();
                            // input_tag("contactos[]", ?:"", "size=40 maxlength=50 class=field id=contactos_{$i}");
                            ?>
                        </td>
                        <td width="20" >
                            <?                            
                            echo $form['confirmar_'.$i]->renderError();
                            if( isset($correos[$i])&&in_array($correos[$i], $confirmar )  ){
                                $form->setDefault('confirmar_'.$i, true );
                            }
                            echo $form['confirmar_'.$i]->render();                            
                            ?>
                        </td>
                    </tr>
                    <?
                    }
                    ?>
                </tbody>
            </table></td>
    </tr>
    <tr>
        <td  ><div>Instrucciones Especiales:</div>
        <br />                
        <?
        echo $form['ca_instrucciones']->renderError();
        if( $reporte ){
            $form->setDefault('ca_instrucciones', $reporte->getCaInstrucciones() );
        }
        echo $form['ca_instrucciones']->render();
        ?>

       </td>
    </tr>
</table>