<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$logs = $sf_data->getRaw("logs");
?>
<style>
.row_yellow{
    background-color: #FFFFCC !important;
}
.row_pink{
    background-color: #FFCCCC !important;
}
.row_blue{
    background-color: #F4F8FF !important;
}

.row_green{
    background-color: #CEFFCE !important;
}

.row_purple{
    background-color: #9999CC !important;	
}

.row_orange{
    background-color: #FFCC66 !important;	
}
.row_gray{
    background-color: #E6E6E6 !important;	
}

    
</style>
<link type="text/css" rel="stylesheet" href="/js/ext-6.5.0/build/classic/theme-crisp/resources/theme-crisp-all-debug.css">
<script type="text/javascript" src="/js/ext6/ext-all.js"></script>
<script type="text/javascript" src="/js/jquery/jquery.js"></script>

<table class="tableList" width="100%">
     <tr >
         <th> </th>
         <th><b>Nit</b></th>
         <th><b>Compa&ntilde;&iacute;a</b></th>
         <th><b>No Comp</b></th>
         <th><b>Fecha</b></th>         
         <th><b>Moneda</b></th>
         <th><b>Valor</b></th>
         <th><b>Impuestos</b></th>         
         <th><b>Usuario</b></th>
         <th><b>Estado</b></th>
         <th><b>DocTransporte</b></th>
         <th><b>NumInterno</b></th>
     </tr>
<?
//echo "<pre>";print_r($logs);echo "</pre>";
//exit;

$comprobantes = array();

$tipos["V"]  = "1. Ingresos";
$tipos["RV"] = "Nota Crédito Venta";
$tipos["C"]  = "Costos";
$tipos["RC"] = "Nota Crédito Proveedores";
$tipos["R"]  = "Pagos Recibidos";
$tipos["RA"] = "Anticipos";


foreach ($logs as $log){
    $tipo = $tipos[$log->TipoDoc];
    if($log->TipoDoc == "C" && $log->User == "manager"){
        $tipo = "Costos Internacionales";
    }else if($log->TipoDoc == "C" && $log->User != "manager"){
        $tipo = "Costos Nacionales";
    }    
    $comprobantes[$tipo][] = $log;
}

ksort($comprobantes);

$lastType = null;
foreach($comprobantes as $tipo=>$logs){
    if( $lastType!=$tipo ){
        ?>
        <tr><th style="background-color: #1112 !important;" colspan="12"><?=$tipo?></th></tr>
        <?
    }
    
    $lastType=$tipo;    
    foreach($logs as $k=>$l){
        if($l->TipoDoc != "PR"){
            $ids = $class = "";
            $noexiste = false;

            if($l->NumeroInterno){
                $comprobante = Doctrine::getTable("InoComprobante")->findBy("ca_idcomprobante",$l->NumeroInterno)->getFirst();
                if(is_object($comprobante)){
                    $cliente = $comprobante->getIds();
                    $ids = $comprobante->getIds()->getCaNombre();
                    if($comprobante->getCaFchanulado() != null || $comprobante->getCaFchanulado() != ""){
                        $class="row_purple";
                    }                
                }else{
                    $ids = "COMPROBANTE NO EXISTE EN COLSYS. FAVOR REPORTAR";
                    $class = "row_pink";
                    $noexiste = true;
                }
            }else{
                if($l->TipoDoc != "PC" ){                    
                    
                    $idalterno = substr($l->CardCode, 1);
                    
                    if(substr($idalterno, 0, 4) != "4444"){
                        $cliente = Doctrine::getTable("Ids")->findBy("ca_idalterno",substr($l->CardCode, 1))->getFirst();
                        $ids = $cliente->getCaNombre();        
                    }else{                        
                        $comprobante = Doctrine::getTable("InoComprobante")->findBySql("ca_consecutivo = ? AND ca_docentry = ?", array($l->NumAtCard, $l->DocEntry))->getFirst();                        
                        if($comprobante){
                            $cliente =  Doctrine::getTable("Ids")->findBy("ca_id",$comprobante->getCaId())->getFirst();
                            $ids = $cliente->getCaNombre();
                        }else{
                            $ids = "COMPROBANTE NO EXISTE EN COLSYS. FAVOR REPORTAR";
                            $class = "row_pink";
                            $noexiste = true;
                        }
                    }
                }
            }


            if($l->TipoDoc == "C" || $l->TipoDoc=="RC"){

                if(substr($l->CardCode, 1) == "C"){
                    //$cliente = Doctrine::getTable("Ids")->findBy("ca_idalterno",substr($l->CardCode, 1))->getFirst();
                    $q = Doctrine::getTable("InoComprobante")
                        ->createQuery("c")
                        ->select("ca_consecutivo,ca_fchanulado")
                        ->where("ca_consecutivo = ? AND ca_id = ?", array($l->NumAtCard, $cliente->getCaId()))
                        ->fetchOne();
                    
                    if(is_object($q)){                        
                        if($q->getCaFchanulado() != null || $q->getCaFchanulado() != ""){
                            $class="row_purple";
                        }
                    }
                }
                
            }elseif($l->TipoDoc == "V" || $l->TipoDoc=="RV"){
                $q = Doctrine::getTable("InoComprobante")
                        ->createQuery("c")
                        ->innerJoin("c.InoTipoComprobante tc")
                        ->select("ca_consecutivo,ca_fchanulado")
                        ->where("ca_consecutivo = ? and tc.ca_prefijo_sap in ('V','RV') AND ca_aplicacion >=1", intval($l->CodigoDoc))
                        ->fetchOne();

                if(is_object($q)){
                    if($q->getCaFchanulado() != null || $q->getCaFchanulado() != ""){
                        $class="row_purple";
                    }
                }else{
                    if(!$noexiste)
                        $class="row_orange";
                }
            }

            $numFact=($l->TipoDoc=="C" || $l->TipoDoc=="RC")?$l->NumAtCard:($l->TipoDoc.$l->SerieCode."-".$l->CodigoDoc);
    ?>
         <tr class="<?=$class?>">
            <td><a href="javascript:m('tr<?=$k?>')">+</a></td>
            <td><?=$l->CardCode?></td>
                <td><?=$ids?></td>
            <td><?=$numFact?></td>
                <td><?=$l->TaxDate?></td>
            <td><?=$l->DocCur?></td>
            <td><?=$l->VlrNeto?></td>
            <td><?=$l->VlrImpuestos?></td>
            <td><?=$l->User?></td>
            <td><?=$l->Estado?></td>
            <td><?=$l->DocTransporte?></td>
            <td><?=$l->NumeroInterno?></td>
         </tr>
         <tr id="tr<?=$k?>" style="display: none" >
             <td colspan="11" width="100%">
                <table width="100%">
                    <tr>
                        <th>ItemCode</th>
                        <th>VlrArticulo</th>
                        <th>PrjCode</th>
                        <th>TaxCode</th>
                        <th>AcctCode</th>
                    </tr>
    <?
                        foreach($l->Lineas as $ln){
    ?>
                    <tr>
                        <td><?=$ln->ItemCode?></td>
                        <td><?=$ln->VlrArticulo?></td>
                        <td><?=$ln->PrjCode?></td>
                        <td><?=$ln->TaxCode?></td>
                        <td><?=$ln->AcctCode?></td>
                    </tr>
    <?
                    }
    ?>
                </table>
            </td>
         </tr>
<?
}
    }
    }
?>

</table>
<h5>CONVENCIONES</h5>
<table class="tableList">        
    <tr class="row_orange"><td>COMPROBANTE CONTABLE. NO AFECTA LA REFERENCIA</td></tr>
    <tr class="row_pink"><td>COMPROBANTE NO EXISTE EN COLSYS. FAVOR REPORTAR</td></tr>
    <tr class="row_purple"><td>COMPROBANTE ANULADO</td></tr>
</table>
<br/>
<div id="b1"></div>
<script>
    function m (trid)
    {
        $("#"+trid).toggle();
    }
<? if($cierre=="Si"){ ?>
    Ext.create('Ext.Button', {
        renderTo: "b1",
        text: 'Cerrar',        
        width: 70,                                
        id: 'btnCerrar<?=$idmaster?>' ,
        handler: function () {
            var me = this;
            opcion = this.getText();
            idmaster = <?=$idmaster?>;
            me.setDisabled(true);

            Ext.Ajax.request({
                waitMsg: 'Guardando cambios...',
                url: '/inoF2/CerrarReferencia',
                params: {
                    idmaster: idmaster,
                    opcion: opcion
                },
                failure: function (response, options) {
                    var res = Ext.util.JSON.decode(response.responseText);
                    if (res.errorInfo)
                        Ext.MessageBox.alert("Mensaje", 'Error al Cerrar la Referencia');
                },
                success: function (response, options) {
                    var res = Ext.decode(response.responseText);                                        
                    if (res.success) {

                        var res = Ext.decode(response.responseText);                                        
                        if (res.success) {
                            Ext.MessageBox.alert("Mensaje", 'Datos Almacenados Correctamente<br>');

                            //var tabpanel = Ext.getCmp('tabpanel1');
                            var tabpanel = window.parent.tabpanel;
                            ref=idmaster;

                            tabpanel.getChildByElement('tab'+ref).close();                                            

                            if (!tabpanel.getChildByElement('tab' + ref) && ref != "")
                            {
                                res.datos.idmaster=ref;
                                datos={"title":res.datos.referencia,"id":'tab' + ref,'datos':res.datos};
                                tabpanel.agregar(datos);
                            }
                            tabpanel.setActiveTab('tab' + ref);
                            //me.setDisabled(false);
                            window.parent.windowpdf.close();
                        } else {
                            Ext.MessageBox.alert("Mensaje", 'Datos Incompletos<br>'+res.errorInfo);
                        }
                    } else {
                        Ext.MessageBox.alert("Mensaje", 'Datos Incompletos<br>'+res.errorInfo);
                    }
                }
            });
        }
    });
    <?
}
?>
</script>
