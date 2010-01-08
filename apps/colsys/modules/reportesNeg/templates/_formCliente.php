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

