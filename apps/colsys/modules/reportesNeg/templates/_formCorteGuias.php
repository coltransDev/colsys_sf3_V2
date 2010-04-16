<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

if( $ca_notify ){
    $notify = $ca_notify;
}elseif( $reporte->getCaNotify() ){
    $notify = $reporte->getCaNotify();
}else{
    $notify = 0;
}

?>
<table class="tableList alignLeft" width="100%" id="consignar-expo">
     <tr >
         <th colspan="2" ><b>Instrucciones para el corte de guias</b></th>
     </tr>
     <tr>
         <td width="33%">
             <b>Consignar Master (MAWB/BL) a:</b>
         </td>
         <td width="67%">
            <?
            echo $form['ca_idconsignarmaster']->renderError();
            if( $reporte ){
                $form->setDefault('ca_idconsignarmaster', $reporte->getCaIdconsignarmaster() );
            }
            echo $form['ca_idconsignarmaster']->render();
            ?>
        </td>
    </tr>
     <tr>
         <td>
             <b>Consignar HAWB/HBL a :</b>
         </td>
         <td >

            <?
            echo $form['ca_idconsignar_expo']->renderError();
            if( $reporte ){
                $form->setDefault('ca_idconsignar_expo', $reporte->getCaIdconsignar() );
            }
            echo $form['ca_idconsignar_expo']->render();
            ?>
        </td>
    </tr>
</table>
<table class="tableList alignLeft" width="100%" id="consignar-impo">
     <tr >
         <th colspan="2" ><b>Instrucciones para el corte de guias</b></th>
     </tr>
     <tr>
        <td width="33%">
             <b>Consignar HAWB/HBL a:</b>
         </td>
         <td width="67%">
            <?
            echo $form['ca_idconsignar_impo']->renderError();
            if( $reporte ){
                $form->setDefault('ca_idconsignar_impo', $reporte->getCaIdconsignar() );
            }
            echo $form['ca_idconsignar_impo']->render();
            ?>
        </td>
    </tr>
    <tr>
        <td width="33%">
             <b>Transladar a:</b>
         </td>
         <td width="67%">
            <?
            echo $form['tipo']->renderError();
            echo $form['tipo']->render();
            ?>
        </td>
    </tr>
    <tr>
         <td>
             <b>&nbsp;</b>
         </td>
         <td >
             <?
            echo $form['ca_idbodega']->renderError();
            if( $reporte ){
                $form->setDefault('ca_idbodega', $reporte->getCaIdbodega() );
            }
            echo $form['ca_idbodega']->render();
            ?>
           
        </td>
    </tr>    
</table>

<br />

<table class="tableList alignLeft" width="100%">
    <tr class="row0">
        <th colspan="4"><b>Otros datos</b></th>
    </tr>
    <tr id="combo-consignatario">
        <td class="row0"><b>Consignatario:</b></td>
        <td valign="top">
            <?=$form['ca_idconsignatario']->renderError() ?>
            <?
            if( $idconsignatario ){
                $value = $idconsignatario;
            }else{
                $value = $reporte->getCaIdconsignatario();
            }
            include_component("widgets", "comboTercero", array( "tipo"=>"Consignatario", "id"=>"idconsignatario", "name"=>"idconsignatario", "value"=>$value));
            ?>
        </td>
        <td valign="top">
            <b> Enviar informaci&oacute;n:</b><br />
            <?
            echo $form['ca_informar_cons']->renderError();
            if( $reporte && $reporte->getCaInformarCons() ){
                $form->setDefault('ca_informar_cons', $reporte->getCaInformarCons() );
            }else{
                $form->setDefault('ca_informar_cons', "No");
            }
            echo $form['ca_informar_cons']->render();
            ?>
        </td>
        <td valign="top">
            <div id="repnotify_1">
                <b> Reportar como Notify: </b><br />
                <input type="radio" name="repnotify" value="1" <?=$notify==1?"checked='checked'":""?> />
            </div>
        </td>
    </tr>

    <tr id="combo-master">
        <td class="row0"><b>Consigna. Master:</b></td>
        <td valign="top">
            <?
            if( $idmaster ){
                $value = $idmaster;
            }else{
                $value = $reporte->getCaIdmaster();
            }
            include_component("widgets", "comboTercero", array( "tipo"=>"Master", "id"=>"idmaster", "name"=>"idmaster", "value"=>$value));
            ?>
        </td>
        <td valign="top">
            <b> Enviar informaci&oacute;n:</b><br />
            <?
            echo $form['ca_informar_mast']->renderError();
            if( $reporte && $reporte->getCaInformarMast() ){
                $form->setDefault('ca_informar_mast', $reporte->getCaInformarMast() );
            }else{
                $form->setDefault('ca_informar_mast', "No");
            }
            echo $form['ca_informar_mast']->render();
            ?>
        </td>
        <td valign="top"> &nbsp; </td>
    </tr>


    <tr id="combo-notify">
        <td class="row0"><b>Notify:</b></td>
        <td valign="top">
            <?
            if( $idnotify ){
                $value = $idnotify;
            }else{
                $value = $reporte->getCaIdnotify();
            }
            include_component("widgets", "comboTercero", array( "tipo"=>"Notify", "id"=>"idnotify", "name"=>"idnotify", "value"=>$value));
            ?>
        </td>
        <td valign="top">
            <b> Enviar informaci&oacute;n:</b><br />
            <?
            echo $form['ca_informar_noti']->renderError();
            if( $reporte && $reporte->getCaInformarNoti() ){
                $form->setDefault('ca_informar_noti', $reporte->getCaInformarNoti() );
            }else{
                $form->setDefault('ca_informar_noti', "No");
            }
            echo $form['ca_informar_noti']->render();
            ?>
        </td>
        <td valign="top">
            <div id="repnotify_2">
                <b> Reportar como Notify: </b><br />
                <input type="radio" name="repnotify" value="2" <?=$notify==2?"checked='checked'":""?> />
            </div>
        </td>
    </tr>

    <tr id="combo-representante">
        <td class="row0"><b>Representante:</b></td>
        <td valign="top">
            <?
            if( $idrepresentante ){
                $value = $idrepresentante;
            }else{
                $value = $reporte->getCaIdrepresentante();
            }
            include_component("widgets", "comboTercero", array( "tipo"=>"Representante", "id"=>"idrepresentante", "name"=>"idrepresentante", "value"=>$value));
            ?>
        </td>
        <td valign="top">
            <b> Enviar informaci&oacute;n:</b><br />
            <?
            echo $form['ca_informar_repr']->renderError();
            if( $reporte && $reporte->getCaInformarRepr() ){
                $form->setDefault('ca_informar_repr', $reporte->getCaInformarRepr() );
            }else{
                $form->setDefault('ca_informar_repr', "No" );
            }
            echo $form['ca_informar_repr']->render();
            ?>

        </td>
        <td valign="top"> &nbsp; </td>
    </tr>


</table>