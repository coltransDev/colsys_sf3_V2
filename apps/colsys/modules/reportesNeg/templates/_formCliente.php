<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

$orden_prov = $sf_data->getRaw("orden_prov");
$incoterms = $sf_data->getRaw("incoterms");

if( $ca_notify ){
    $notify = $ca_notify;
}elseif( $reporte->getCaNotify() ){
    $notify = $reporte->getCaNotify();
}else{
    $notify = 0;
}
?>
<table class="tableList alignLeft" width="100%">
    <tr class="row0">
        <th colspan="4"><b>Datos del cliente</b></th>
    </tr>   
    <tr>
        <td><b>Nombre:</b></td>
        <td>
            <?
            echo $form['ca_idconcliente']->renderError();

            ?>
            <input type="hidden" name="ca_idconcliente" id="ca_idconcliente"  value="<?=$ca_idconcliente?$ca_idconcliente:$reporte->getCaIdconcliente()?>">
            <input type="text" name="idconcliente" id="idconcliente">
        </td>
        <td><b> Contacto: </b></td>
        <td>&nbsp;
            <div id="div_contacto" align="left">
                 <?
                if( $reporte->getCaIdconcliente() ){
                    echo $reporte->getContacto()->getNombre();
                }
                ?>
            </div>
        </td>
    </tr>
    <tr>
        <td><b>Orden del Cliente:</b></td>
        <td>
            <?
            echo $form['ca_orden_clie']->renderError();
            if( $reporte ){
                $form->setDefault('ca_orden_clie', $reporte->getCaOrdenClie() );
            }
            echo $form['ca_orden_clie']->render();
            ?>
        </td>
        <td><b> Reportar como Notify: </b></td>
        <td>
            <input type="radio" name="repnotify" value="0" <?=$notify==0?"checked='checked'":""?> />
        </td>
    </tr>
    <tr id="incoterms-expo">
        <td><b>Incoterms:</b></td>
        <td>
            <?
            echo $form['ca_incoterms']->renderError();
            if( $reporte ){
                $form->setDefault('ca_incoterms', $reporte->getCaIncoterms() );
            }
            echo $form['ca_incoterms']->render();
            ?>
        </td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>

</table>    
<?
if( $idproveedor ){
    $values = $idproveedor;
}else{
    $values = $reporte->getCaIdproveedor();
}
$idproveedores = explode("|", $values );


if( $orden_prov ){
    $values = $orden_prov;
}else{
    $values = $reporte->getCaOrdenProv();
}
$ordenes = explode("|", $values );


if( $incoterms ){
    $values = $incoterms;
}else{
    $values = $reporte->getCaIncoterms();
}
$incoterms = explode("|", $values );

?>
<br />
<table class="tableList alignLeft" width="100%"  id="combo-proveedor">
    <tr class="row0">
        <th colspan="3"><b>Proveedor</b></th>
    </tr>
    <?
    $i = 0;
    foreach( $idproveedores as $key=>$idproveedor ){

        if( $idproveedor ){
    ?>
    <tr>
        
        <td width="50%">
            <b>Nombre</b><br />
            <?
            include_component("widgets", "comboTercero", array( "tipo"=>"Proveedor", "id"=>"idproveedor_".$i, "name"=>"idproveedor[]", "value"=>$idproveedor));
            $i++;
            ?>
        </td>
        <td width="25%"><b>Orden:</b><br /> <input type="text" name="orden_prov[]" value="<?=$ordenes[$key]?>" /></td>
        <td width="25%"><b>Incoterms:</b><br />
            
            <select name="incoterms[]" >
                <?
                foreach( $incotermsVals as $incoterm ){
                ?>
                <option value="<?=$incoterm["ca_valor"]?>" <?=$incoterms[$key]==$incoterm["ca_valor"]?"selected='selected'":""?> ><?=$incoterm["ca_valor"]." - ".$incoterm["ca_valor2"]?></option>
                <?
                }
                ?>
            </select>
            </td>
    </tr>
    <?
        }
    }
    ?>
    <tr>
         <td>
              <b>Nombre</b><br />
              <?=$form['ca_idproveedor']->renderError() ?>
            <?
            include_component("widgets", "comboTercero", array( "tipo"=>"Proveedor", "id"=>"idproveedor_".$i, "name"=>"idproveedor[]", "value"=>""));
            ?>
         </td>
        <td><b>Orden:</b><br/>
            <?=$form['ca_orden_prov']->renderError() ?>
            <input type="text" name="orden_prov[]" value="" /></td>
        <td><b>Incoterms:</b><br /> 
            <select name="incoterms[]" >
                <?
                foreach( $incotermsVals as $incoterm ){
                ?>
                <option value="<?=$incoterm["ca_valor"]?>" ><?=$incoterm["ca_valor"]." - ".$incoterm["ca_valor2"]?></option>
                <?
                }
                ?>
            </select>
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
            <b> Reportar como Notify: </b><br />
            <input type="radio" name="repnotify" value="1" <?=$notify==1?"checked='checked'":""?> />

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
            <b> Reportar como Notify: </b><br />
            <input type="radio" name="repnotify" value="2" <?=$notify==2?"checked='checked'":""?> />
            
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
