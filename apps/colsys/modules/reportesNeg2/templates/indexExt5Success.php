<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<style>
.x-grid-cell-inner {
    white-space: pre-line !important;
}

.x-panel-header-title-default1
{
    color: #157fcc;
    font-family: helvetica,arial,verdana,sans-serif;
    font-weight: 300;
    line-height: 16px;
    font-size: 11px !important;
    margin: 15px;
}

.x-toolbar-spacer-default {
  width: 2px;
  height: 4px !important;
}

.x-panel-body-default {
    color: #3e4752;
    font-family: "Proxima Nova","Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 13px !important;
    font-weight: 300;
}



/*nuevo*/
.thumb {
    background-color: white;
    border-radius: 3px;
    box-shadow: 1px 2px 2px 3px rgba(0, 0, 0, 0.60);
    display: table-cell;
    padding: 12px;
    box-sizing: border-box;
}

.thumb-title {
    color: #3e4752;
    font-weight: 800;
}

.thumb-title-small {
    color: #878ea2;
    font-size: 10px;
    font-weight: 500;
}

.statement-type {
    color: #878ea2;
    float: left;
    font-size: 14px;
    font-weight: bold;
    margin: 20px 5px 0;
    width: 100%;
}

.x-panel-body-default {
    /*background: #ececec none repeat scroll 0 0;*/
    /*background: #fff none repeat scroll 0 0;*/
    border-color: #cecece;
    border-style: solid;
    border-width: 1px;
    color: #3e4752;
    font-family: "Proxima Nova","Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 15px;
    font-weight: 300;
}

.x-form-text-default.x-form-textarea {
    line-height: 12px;
    min-height: 40px;
}

</style>
<?
$permisos=$sf_data->getRaw("permisos");
?>

<script>

var permisosG= Ext.decode('<?=json_encode($permisos)?>');

Ext.Ajax.setTimeout(120000);
Ext.Loader.setConfig({
    enabled: true,
    paths: {
        //'Chart':'/js/ext5/src/',
        //'Ext.ux.exporter':'../js/ext5/examples/ux/exporter/',
        'Colsys':'/js/Colsys'
        ,'Ext.ux':'/js/ext5/examples/ux'
    }
});

Ext.require([
    'Ext.ux.exporter.Exporter',
    'Ext.ux.Explorer'    
]);



comboBoxRenderer = function (combo) {
    return function (value) {

        rec=null;        
        for(i=0;i<combo.store.data.items.length;i++)
        {
            if(combo.store.data.items[i].get(combo.valueField)==value)
            {
                rec=combo.store.data.items[i];                
                break;
            }
        }
        return (rec === null ? value : rec.get(combo.displayField));
    };
};

</script>
<?php
//$permisos = $sf_data->getRaw("permisos");
//$modo = $sf_data->getRaw("modo");
//$inoMaster = $sf_data->getRaw("inoMaster");
//$idmaster=12176;
include_component("reportesNeg2", "mainPanel");
?>
<table align="center" width="98%" cellspacing="0" border="0" cellpading="0"><tr><td>
<div id="panel"></div>
<div id="sub-panel"></div>
</td></tr></table>
<script>

Ext.onReady(function() {
    Ext.tip.QuickTipManager.init();    
    

    Ext.create("Ext.container.Viewport",{
        renderTo: 'panel',
        layout:'border',
        scope:this,
        items:[
            {
                region: 'west',
                xtype: 'Colsys.ReportesNeg.FormBusqueda',
                'permisosG1':permisosG,
                autoScroll: true
            },
            {
                region: 'center',
                xtype: 'tabpanel',
                id:'tabpanel1',
                name:'tabpanel1',
                activeTab: 0,
                agregar: function (datos)
                {
                    res = new Object();
                    res.datos=datos.datos;
                    var data=JSON.stringify(permisosG);
                    var permisosG2 = Ext.decode(data);
                    
                    this.tmppermisos = new Object();
                    //console.log(datos);
                    if(res.datos.impoexpo=="INTERNO")
                    {                                    
                        this.tmppermisos=permisosG2.terrestre;                                    
                    }
                    else if(res.datos.impoexpo=="Exportaci\u00F3n")
                    {                                
                        this.tmppermisos=permisosG2.exportacion;                                    
                    }
                    else if(res.datos.impoexpo=="Importaci\u00F3n" || res.datos.impoexpo=="Triangulaci\u00F3n")
                    {
                        if(res.datos.transporte=="Mar\u00EDtimo")
                        {
                            this.tmppermisos=permisosG2.maritimo;                                        
                        }
                        if(res.datos.transporte=="A\u00E9reo")
                        {                                        
                            this.tmppermisos=permisosG2.aereo;                                        
                        }
                    }
                    else if(res.datos.impoexpo=="OTM-DTA")
                    {
                        if(res.datos.referencia.substr(0, 1)=="7")
                        {
                            this.tmppermisos=permisosG2.colotm;                            
                        }
                        else                        
                        {
                            this.tmppermisos=permisosG2.otm;
                        }
                    }
                    else{
                        this.tmppermisos=null;
                    }

                    if(res.datos.fchcerrado)
                    {
                        this.tmppermisos.Editar=false;
                        this.tmppermisos.Crear=false;
                        this.tmppermisos.Anular=false;                                    
                    }
                    if ((res.datos.fchanulado !="" && res.datos.fchanulado !="null" &&  res.datos.fchanulado !=null) || (res.datos.fchliquidado !="" && res.datos.fchliquidado !="null" &&  res.datos.fchliquidado !=null)) {
                        this.tmppermisos.Editar=false;
                        this.tmppermisos.Crear=false;
                        this.tmppermisos.Anular=false;                                    
                    }           
                    this.tmppermisos.Editable=res.datos.editable;
                    console.log(res.datos);
                    console.log(this.tmppermisos);

                    obj=[
                        new Colsys.ReportesNeg.Mainpanel(
                        {
                            "idreporte": res.datos.idreporte, "idtransporte": res.datos.transporte,
                            "idimpoexpo": res.datos.impoexpo, "idreferencia": res.datos.consecutivo,
                            'permisos': this.tmppermisos, "modalidad":res.datos.modalidad
                        })/*,
                        {
                            region: 'south',
                            xtype: 'Colsys.ReportesNeg.FormCierre',
                            id: 'formCierre' + res.datos.idmaster,
                            name: 'formCierre' + res.datos.idmaster,
                            idmaster: res.datos.idmaster,
                            'permisos': this.tmppermisos
                        }*/];
                    
                    this.add(
                    {
                        title: datos.title,
                        id: datos.id,
                        itemId: datos.id,
                        closable: true,
                        autoScroll: true,
                        items: obj
                    }).show();
                }
            },
            {
                region: 'north',
                html: '',
                border: false,
                height: 30,
                style: {
                    display: 'none'
                }
            }
        ]       
        
    });
    
    
            
    <?
    
    if($reporteM!="New"){
        
        foreach($reporteM as $m){
            
?>
        ref=<?=$m->getCaIdmaster()?>;
    
        numRef='<?=$m->getCaReferencia()?>';
        if(!tabpanel.getChildByElement('tab'+ref) && ref!=""){
        impoexpo='<?=$m->getCaImpoexpo()?>';
        transporte = '<?=$m->getCaTransporte()?>';
        fchcerrado = '<?=$m->getCaFchcerrado()?>';
        fchanulado = '<?=$m->getCaFchanulado()?>';
        fchliquidado = '<?=$m->getCaFchliquidado()?>';
        itr = '<?=$m->$reporte->getDatosJson("itr")?>';
        
        if(impoexpo=="INTERNO")
            tmppermisos=permisosG.terrestre;
        else if(impoexpo=="Exportaci\u00F3n")
            tmppermisos=permisosG.exportacion;
                else if(impoexpo=="Importaci\u00F3n"){
            if(transporte=="Mar\u00EDtimo")
                tmppermisos=permisosG.maritimo;
            if(transporte=="A\u00E9reo")
                tmppermisos=permisosG.aereo;
        }
        else if(impoexpo=="OTM-DTA")
            tmppermisos=permisosG.otm;

        if(fchcerrado!="" || fchanulado!="" || fchliquidado!=""){
            tmppermisos.Editar=false;
            tmppermisos.Crear=false;
            tmppermisos.Anular=false;
        }
        
        tabpanel.add({
            title: numRef,
            id:'tab'+ref,
            itemId:'tab'+ref,
            closable :true,
            autoScroll: true,
            items: [
                new Colsys.ReportesNeg.Mainpanel({                    
                    region: 'north',
                    "idmaster": ref, "idimpoexpo": impoexpo,
                    "idtransporte":transporte,
                    'idreferencia':numRef,
                    'permisos': tmppermisos, "itr":itr,
                    "modalidad":'<?=$m->getCaModalidad()?>'
                }),
               {
                    region: 'south',
                    xtype: 'Colsys.ReportesNeg.FormCierre',
                    id: 'formCierre'+ref,
                    name: 'formCierre'+ref,
                    "idmaster": ref, "idimpoexpo": impoexpo,
                    "idtransporte":transporte,
                    'idreferencia':numRef,
                    'permisos': tmppermisos,
                    alignTarget :'bottom'
                    
                }
            ]
        }).show();
    }
    tabpanel.setActiveTab('tab'+ref);
<?
    }
    }
    else if ($reporteM=="New")
    {
?>
        tabpanel = Ext.getCmp('tabpanel1');
        ref="0";
        tmppermisos=permisosG.terrestre;
        tmppermisos.Editable=true;
        conse='Nuevo';
        tabpanel.add(
        {
            title: conse,
            id:'tab'+ref,
            itemId:'tab'+ref,
            closable :true,
            autoScroll: true,
            items: [new Colsys.ReportesNeg.Mainpanel({"idreporte":ref,
                    idtransporte: "Terrestre",
                    idimpoexpo: "INTERNO",
                    permisos:tmppermisos,
                    consecutivo: conse,
                    idrepPrincipal:'<?=$idrepPrincipal?>'
                })]
        }).show();
        tabpanel.setActiveTab('tab'+ref);
<?        
    }else
    {
?>
        tabpanel = Ext.getCmp('tabpanel1');
        ref="595337";
        tmppermisos=permisosG.terrestre;
        conse='20515-2018';
        tabpanel.add(
        {
            title: conse,
            id:'tab'+ref,
            itemId:'tab'+ref,
            closable :true,
            autoScroll: true,
            items: [new Colsys.ReportesNeg.Mainpanel({"idreporte":ref,
                    idtransporte: "Terrestre",
                    idimpoexpo: "INTERNO",
                    permisos:tmppermisos,
                    consecutivo: conse
                })]
        }).show();
        tabpanel.setActiveTab('tab'+ref);
<?
    }
        
    ?>
});

function openFile(val){
    var windowpdf = Ext.create('Colsys.Widgets.WgVerPdf', {
        width: 1000,
        sorc: val
    });
    windowpdf.show();
}


</script>

<!--<div style="float:left;border:">-->