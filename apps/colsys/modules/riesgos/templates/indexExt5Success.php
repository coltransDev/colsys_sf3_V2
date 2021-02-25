<link rel="stylesheet" type="text/css"  href="/js/ext6/build/packages/charts/classic/classic/resources/charts-all.css"/>
<script type="text/javascript" src="/js/ext6/build/packages/charts/classic/charts.js"></script>
<!--<script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js" integrity="sha384-kW+oWsYx3YpxvjtZjFXqazFpA7UP/MbiY4jvs+RWZo2+N94PFZ36T6TFkc9O3qoB" crossorigin="anonymous"></script>-->
<script src="https://kit.fontawesome.com/7b59b23bbf.js" crossorigin="anonymous"></script>
<?
$criterios = $sf_data->getRaw("criterios");
$headers = $sf_data->getRaw("headers");
$accesoAdmon = $sf_data->getRaw("accesoAdmon");

//echo "accesoadmin".$accesoAdmon;
//exit;
$criterios = json_encode($criterios);
$headers = json_encode($headers);
//exit();
?>
<style>
.x-grid-row {
    font: normal 11px/15px tahoma,arial,verdana,sans-serif;
}

.bluenode{
    color: blue;
}

.inactivenode{
    color: red;
}

.inapprovednode{
    color: orange;
}

.blue{
    background: silver;
}

.x-column-header {
    font-size: 11px;

}

.x-column-header-inner {    
    text-align:center;
}

.x-column-header-text-container, .x-column-header-text{
    white-space : normal !important;
}
/* wrap strings w/o spaces */  
.x-grid-cell-inner{
    white-space: normal;
    word-wrap: break-word;
    word-break: break-all;
}


</style>

<table align="center" width="98%" cellspacing="0" border="0" cellpading="0">
    <tr><td><div id="panel"></div></td></tr>
</table>


<script>
    winRiesgo = null;
    
    var indice;
    Ext.Loader.setConfig({
        enabled: true,
        paths: {
            'Chart':'../js/ext5/src/',
            'Ext.ux': '/js/ext5/examples/ux/',
            'Colsys':'/js/Colsys',
            'Ext.grid.plugin.Exporter':'../js/ext6/classic/classic/src/grid/plugin/Exporter.js',
            'Ext.grid.plugin':'../js/ext6/classic/classic/src/grid/plugin/',            
            'Ext.exporter':'../js/ext6/classic/classic/src/exporter/',
            'Ext.view.grid':'../js/ext6/classic/classic/src/view/grid/',
            'Ext.overrides':'../js/ext6/classic/classic/src/overrides/',                             
        }
    });
    
    Ext.require([        
        'Ext.ux.IFrame',
        'Ext.ux.form.MultiSelect'
    ]);

    Ext.onReady(function() {
        Ext.tip.QuickTipManager.init();

        var msg = function(title, msg) {
            Ext.Msg.show({
                title: title,
                msg: msg,
                minWidth: 200,
                modal: true,
                icon: Ext.Msg.INFO,
                buttons: Ext.Msg.OK
            });
        };
        
        

        var required = '<span style="color:red;font-weight:bold" data-qtip="Required">*</span>';
        var store = Ext.create('Ext.data.TreeStore', {
            root: {
                expanded: false
            },
            proxy: {
                type: 'ajax',
                url: '<?=url_for("riesgos/datosProcesosPorEmpresa")?>'
            }
        });

        Ext.create("Ext.container.Viewport",{
            renderTo: 'panel',
            layout:'border',            
            id: 'view-Riesgos',
            name: 'view-Riesgos',
            scope:this,
            items:[{
                region: 'west',
                title: 'Riesgos',
                width: 300,
                collapsible: true,
                scrollable: true,
                split: true,
                items:[{
                    xtype:'treepanel',
                    id:'tree-id',
                    rootVisible: false,
                    border:false,                    
                    store: store,
                    cls : 'rednode',                    
                    dockedItems: [{
                        xtype: 'toolbar',
                        dock: 'top',
                        items: [{ 
                            xtype: 'button',                                 
                            iconCls: 'fa fa-cog',
                            disabled: !<?=$accesoAdmon?"true":"false"?>,
                            id: 'button-administrator',
                            menu: {
                                items: [{
                                    text: 'Maestra de Procesos',
                                    iconCls: 'fa fa-clipboard-list',
                                    id: 'button-grid-procesos',
                                    handler: function (t, eOpts) {                                                

                                        var vport = t.up("treepanel").up('viewport');
                                        tabpanel = vport.down('tabpanel');

                                        if(!tabpanel.getChildByElement('tab-maestra-procesos')){
                                            tabpanel.add({
                                                    title: "Maestra de Procesos",
                                                    id:'tab-maestra-procesos',  
                                                    scrollable: true,
                                                    closable: true,
                                                    layout: {
                                                        type: 'vbox', // Arrange child items vertically
                                                        align: 'stretch',    // Each takes up full width ,
                                                        pack: 'start'
                                                    },
                                                    //bodyPadding: 5,                                                                    
                                                    items:[{
                                                        xtype:'Colsys.Riesgos.PanelMaestraProcesos',                                                    
                                                        id:"panel-maestra-procesos",
                                                        border: true,
                                                        idgrid: 1
                                                    }]
                                                }).show();                                            
                                        }
                                        tabpanel.setActiveTab('tab-maestra-procesos');
                                    }
                                },{
                                    text: 'Maestra de Riesgos',
                                    iconCls: 'fa fa-list-alt',
                                    id: 'button-grid-riesgos',
                                    handler: function (t, eOpts) {                                                

                                        var vport = t.up("treepanel").up('viewport');
                                        tabpanel = vport.down('tabpanel');

                                        if(!tabpanel.getChildByElement('tab-admin-riesgos')){
                                            tabpanel.add({
                                                title: "Maestra de Riesgos",
                                                id:'tab-admin-riesgos',                                                      
                                                closable: true,
                                                items:[{
                                                    flex: 1,
                                                    xtype: 'panel',                                    
                                                    titleAlign: 'center',
                                                    fullscreen: true,
                                                    id:'admin-riesgos-panel', 
                                                    layout: {
                                                        type: 'vbox', // Arrange child items vertically
                                                        align: 'stretch',    // Each takes up full width ,
                                                        pack: 'start'
                                                    },
                                                    bodyPadding: 5,
                                                    defaults: {
                                                        frame: true,                                    
                                                    },
                                                    scrollable: true,
                                                    items:[{                                                        
                                                        xtype:'Colsys.Riesgos.GridMaestraRiesgos',                                                    
                                                        id:"grid-maestra-riesgos",
                                                        flex:1,
                                                        margin: '0 0 5 0',                                                                    
                                                        indexId: 2,
                                                        border: true,
                                                        idgrid: 2
                                                    }],
                                                    listeners:{
                                                        beforerender: function (ct, position) {                                        
                                                            this.setHeight(this.up('tabpanel').getHeight() - 50);
                                                        }
                                                    }
                                                }]
                                            }).show();                                            
                                        }
                                        tabpanel.setActiveTab('tab-admin-riesgos');
                                    }
                                }]
                            }
                        },
                        {   
                            xtype: 'button', 
                            text: 'Cargos Críticos',
                            iconCls: 'fa fa-user-friends',
                            handler: function(t, eOpts){
                                var vport = t.up("treepanel").up('viewport');
                                tabpanel = vport.down('tabpanel');

                                if(!tabpanel.getChildByElement('tab-criticos')){
                                    tabpanel.add({
                                            title: "Cargos Criticos",
                                            id:'tab-criticos',  
                                            scrollable: true,
                                            closable: true,
                                            layout: {
                                                type: 'vbox', // Arrange child items vertically
                                                align: 'stretch',    // Each takes up full width ,
                                                pack: 'start'
                                            },
                                            bodyPadding: 10,                                                                    
                                            items:[{
                                                xtype:'Colsys.Riesgos.GridCriticos',                                                    
                                                id:"grid-criticos",
                                                criterios: '<?=$criterios?>',
                                                headers: '<?=$headers?>'                                                    
                                            }/*,{
                                                xtype:'Colsys.Users.GridCargosIso',                                                    
                                                id:"grid-criticos",
                                                idgrid: 'grid-criticos',
                                                criterios: '<?=$criterios?>',
                                                headers: '<?=$headers?>'                                                    
                                            }*/]
                                        }).show();
                                    tabpanel.setActiveTab('tab-criticos');
                                }

                            }
                        }]
                    }],                  
                    listeners:{
                        itemclick: function(t,record,item,index){                            
                        
                        var recordParentNode = record.parentNode;
                        
                        console.log("precviosppal",t.previousSibling());
                        console.log("precviosnodeppal",t.previousNode());
                        console.log("precviosnodeppal",t.previousNode());
                        console.log("recordppal",record);
                        console.log("itemppal",item);
                        console.log("indexppal",index);
                        switch(record.data.depth){ 
                            case 4: //Riesgo            
                                //if(record.data.text != "Versiones"){
                                    var vport = t.up('viewport');
                                    tabpanel = vport.down('tabpanel');
                                    if(recordParentNode.data.permisos){
                                        if(!tabpanel.getChildByElement('tab-'+record.data.id)){
                                            indice=record.data.id;
                                            tabpanel.add({
                                                title: record.data.text,
                                                id:'tab-'+record.data.id,
                                                itemId:'tab-'+record.data.id,                                        
                                                closable: true,
                                                items:[{
                                                    xtype:'Colsys.Riesgos.PanelGeneral',                                                    
                                                    id:"general"+record.data.id,
                                                    indexId: "general" + record.data.id,                                                
                                                    idriesgo: record.data.id,                                                
                                                    idproceso: record.data.idproceso,
                                                    text: record.data.text,
                                                    ano: record.data.ano,
                                                    idempresa: record.data.idempresa,
                                                    permisos: recordParentNode.data.permisos,
                                                    aprobado: record.data.aprobado,
                                                    tipo: "riesgo"
                                                }]
                                            }).show();
                                        }
                                        tabpanel.setActiveTab('tab-'+record.data.id);
                                    }else{
                                        Ext.Msg.alert("Permisos", "No tiene permisos para visualizar riesgos de este proceso. Favor consulte con el Administrador de Riesgos.");
                                    }
                                //}
                                break;
//                                case 3: // Versiones
//                                    //console.log(utf8Decode(record.data.text));
//                                    var idarchivo = utf8Decode(record.data.text)+".pdf";
//                                    var archivo = Base64.encode("Procesos/"+record.data.idproceso+"/versiones/"+idarchivo);
//                                    //console.log(archivo);
//                                    window.open("/gestDocumental/verArchivo?idarchivo="+archivo);
//                                    break;
                            }
                        },
                        itemmouseenter: function( t, record, item, index, e, eOpts ){
                            if(record.data.depth==4){
                                view=t;
                                var tip = Ext.create('Ext.tip.ToolTip', {
                                    target: item,                                 
                                    delegate: view.itemSelector,                                 
                                    trackMouse: true,                                 
                                    renderTo: Ext.getBody(),
                                    listeners: {                                     
                                         beforeshow: function updateTipBody(tip) {                                         
                                            tip.update(record.data.descripcion);                                         
                                        }

                                    }
                                });                            
                            }
                        },
                        itemcontextmenu: function ( t, record, item, index, e, eOpts ){
                            e.stopEvent();                            
                            var idproceso = record.data.idproceso;
                            var proceso = record.data.text;
                            var idempresa = record.data.idempresa;
                            var empresa = record.data.empresa;
                            var permisos = record.data.permisos;
                            var data = record.data;
                            console.log("data",data);
                            
//                            $.each(data, function( index, value ) {                                
//                                if(index==="children"){                                    
//                                    $.each(value, function( index1, value1 ) {
//                                        $.each(value1, function( index2, value2 ) {                                            
//                                            if(index2==="permisos"){
//                                                permisos = value2;
//                                            }
//                                        });
//                                    });
//                                }
//                            });
                            switch(record.data.depth){
                                case 1:
                                    if(permisos){
                                        var menu = new Ext.menu.Menu({
                                            id: 'menuContextual-riesgos-'+idproceso,
                                            items: [{
                                                text: 'Mostrar Inactivos',
                                                iconCls: 'fa fa-eye',
                                                ui: 'footer',
                                                id: 'button-mostrar-inactivos-',
                                                //disabled: !permisos.riesgos.crear,
                                                handler: function() {
                                                    Ext.getCmp('tree-id').getStore().reload({
                                                        params:{
                                                            inactivos:true
                                                        }
                                                    });           
                                                }
                                            },
                                            {
                                                    text: 'Informe General',
                                                    iconCls: 'fa fa-file-pdf',
                                                    id: 'button-general',
                                                    disabled: !permisos.informes.ver,
                                                    handler: function() {

                                                        var vport = t.up('viewport');
                                                        tabpanel = vport.down('tabpanel');


                                                        if(!tabpanel.getChildByElement('tab-informe-general')){                                                    
                                                            tabpanel.add({                                                        
                                                                title: this.text,
                                                                id:'tab-informe-general',
                                                                itemId:'tab-informe-general',
                                                                closable: true,
                                                                items:[{
                                                                    xtype:'Colsys.Riesgos.PanelInformes',                                                                
                                                                    id:"panel-informes-general",                                                                                                                        
                                                                    indexId: "indexid-general",
                                                                    permisos: data.permisos,
                                                                    ano: data.ano,
                                                                    tipo: "general"
                                                                }]
                                                            }).show();
                                                        }
                                                        tabpanel.setActiveTab('tab-informe-general');
                                                    }
                                                }]
                                        }).showAt(e.getXY());
                                    }
                                    break;
                                case 2://Empresa
                                    if(permisos){
                                        console.log("case 2");
                                            var menu = new Ext.menu.Menu({
                                                id: 'menuContextual-idempresa-'+idempresa,
                                                items: [{
                                                    text: 'Informes ' + empresa,
                                                    iconCls: 'fa fa-file-pdf',
                                                    id: 'button-idempresa-'+idempresa,
                                                    disabled: !permisos.informes.ver,
                                                    handler: function() {

                                                        var vport = t.up('viewport');
                                                        tabpanel = vport.down('tabpanel');

                                                        if(!tabpanel.getChildByElement('tab-informe-idempresa-'+idempresa)){                                                    
                                                            tabpanel.add({                                                        
                                                                title: "Informe " + empresa,
                                                                id:'tab-informe-idempresa-'+idempresa,
                                                                itemId:'tab-informe-idempresa'+idempresa,
                                                                closable: true,
                                                                items:[{
                                                                    xtype:'Colsys.Riesgos.PanelInformes',                                                    
                                                                    id:"panel-informes-idempresa-"+record.data.id,                                                                                                                        
                                                                    indexId: "indexid-idempresa-" + idempresa,
                                                                    idproceso: idproceso,
                                                                    idempresa: idempresa,
                                                                    empresa: data.empresa,
                                                                    proceso: proceso,
                                                                    permisos: data.permisos,
                                                                    ano: data.ano,
                                                                    tipo: "empresa"
                                                                }]
                                                            }).show();
                                                        }
                                                        tabpanel.setActiveTab('tab-informe-'+idproceso);
                                                    }
                                                }]
                                            }).showAt(e.getXY());                                        
                                    }
                                    break;
                                case 3:                                                                    
                                    if(permisos){
                                        var menu = new Ext.menu.Menu({
                                        id: 'menuContextual-idproceso-'+idproceso,
                                        items: [
                                            {
                                                text: 'Nuevo Riesgo',
                                                iconCls: 'fa fa-plus-circle',
                                                id: 'button-nuevo-riesgo-'+idproceso,
                                                disabled: !permisos.riesgos.crear,
                                                handler: function() {                                                
                                                    var text = 'Nuevo Riesgo: '+ data.text;                                                
                                                    var vport = t.up('viewport');
                                                    tabpanel = vport.down('tabpanel');

                                                    if(!tabpanel.getChildByElement('tab-nuevo-riesgo-'+idproceso)){
                                                        tabpanel.add({
                                                            title: text,
                                                            id:'tab-nuevo-riesgo-'+idproceso,
                                                            itemId:'tab-nuevo-riesgo-'+idproceso,
                                                            closable: true,
                                                            fullscreen: true,
                                                            layout: {
                                                                type: 'vbox', // Arrange child items vertically
                                                                align: 'stretch',    // Each takes up full width ,
                                                                pack: 'start'
                                                            },
                                                            bodyPadding: 5,
                                                            defaults: {
                                                                frame: true,                                    
                                                            },
                                                            scrollable: true,
                                                            items:[
                                                                Ext.create('Colsys.Riesgos.FormRiesgo', {                                                                
                                                                    id: 'form-riesgo-' + idproceso,
                                                                    //name: 'form-riesgo-' + idproceso,
                                                                    flex: 1,
                                                                    border: false,                                        
                                                                    layout: 'anchor',
                                                                    anchor: '100% 100%',
                                                                    idriesgo: null,
                                                                    idproceso: idproceso,
                                                                    nuevo: true,
                                                                    permisos: data.permisos
                                                                })
                                                            ]
                                                        }).show();
                                                    }
                                                    tabpanel.setActiveTab('tab-nuevo-riesgo-' + idproceso);
                                                }
                                            },
                                            {
                                                text: 'Informes '+proceso,
                                                iconCls: 'fa fa-file-pdf',
                                                id: 'button-idproceso-'+idproceso,
                                                disabled: !permisos.informes.ver,
                                                handler: function() {

                                                    var vport = t.up('viewport');
                                                    tabpanel = vport.down('tabpanel');

                                                    if(!tabpanel.getChildByElement('tab-informe-idproceso-'+idproceso)){                                                    
                                                        tabpanel.add({                                                        
                                                            title: proceso,
                                                            id:'tab-informe-idproceso-'+idproceso,
                                                            itemId:'tab-informe-idproceso-'+idproceso,
                                                            closable: true,
                                                            items:[{
                                                                xtype:'Colsys.Riesgos.PanelInformes',                                                    
                                                                id:"panel-informes-idproceso-"+record.data.id,
                                                                indexId: "indexid-idproceso-" + idproceso,
                                                                idproceso: idproceso,                                                                
                                                                proceso: proceso,
                                                                permisos: data.permisos,
                                                                ano: data.ano,
                                                                tipo: "proceso"
                                                            }]
                                                        }).show();
                                                    }
                                                    tabpanel.setActiveTab('tab-informe-idproceso-'+idproceso);
                                                }
                                            }
    //                                        ,                                        
    //                                        {
    //                                            text: 'Informe de Riesgos LAFT '+ proceso,
    //                                            iconCls: 'pdf',
    //                                            id: 'button3-'+idproceso,
    //                                            handler: function () {                                                
    //                                                var windowpdf = Ext.create('Colsys.Widgets.WgVerPdf', {
    //                                                    title: 'Informe de Riesgos LAFT',
    //                                                    id:'window-pdf-'+idproceso,
    //                                                    sorc: "/riesgos/pdfProceso?idproceso=" + idproceso + "&laft=si"
    //                                                });
    //                                                windowpdf.show();
    //                                            }
    //                                        },
    //                                        {
    //                                            text: 'Informe de Riesgos '+ proceso,
    //                                            iconCls: 'pdf',
    //                                            id: 'button3-'+idproceso,
    //                                            handler: function () {                                                
    //                                                var windowpdf = Ext.create('Colsys.Widgets.WgVerPdf', {
    //                                                    id: 'window-pdf-'+idproceso,
    //                                                    title: 'Informe de Riesgos '+ proceso,
    //                                                    sorc: "/riesgos/pdfProceso/idproceso/" + idproceso
    //                                                });
    //                                                
    //                                                if(permisos){
    //                                                    windowpdf.insertDocked(0, {
    //                                                        xtype: 'toolbar',
    //                                                        dock: 'top',
    //                                                        items: [{ 
    //                                                            xtype: 'button', 
    //                                                            text: 'Guardar Versión',
    //                                                            iconCls: 'disk',
    //                                                            handler: function(){
    //                                                                Ext.create('Colsys.Riesgos.WindowVersion',{
    //                                                                    title: 'Guardar ésta versión como:',
    //                                                                    id: 'winversion-'+idproceso,
    //                                                                    width: 500,
    //                                                                    heigth: 500,
    //                                                                    idproceso: idproceso
    //                                                                }).show();
    //                                                            }
    //                                                        }]
    //                                                    });
    //                                                }                                                
    //                                                windowpdf.show();
    //                                            }
    //                                        },
    //                                        {
    //                                            text: 'Mapa de Riesgos '+ proceso,
    //                                            iconCls: 'map',
    //                                            id: 'button5-'+idproceso,
    //                                            handler: function() {                                                
    //                                                Ext.getCmp("tree-id").mapaRiesgos(idproceso,proceso);
    //                                            }
    //                                        }
                                        ]
                                    }).showAt(e.getXY());
                                    }else{
                                        Ext.Msg.alert("Permisos", "No están definidos los permisos para ingresar a ésta opción.");
                                    }
                                    break;
                            }
                        },                        
                        load: function ( t, records, successful, operation, node, eOpts ){                            
                            Ext.getBody().unmask();
                            if(!successful){
                                var res = Ext.util.JSON.decode(operation._response.responseText);                                                        
                                Ext.Msg.alert('Error', res.errorInfo);
                            }                            
                        }
                    }
                }]
            },{
                region: 'center',
                xtype: 'tabpanel',
                id:'tabpanel1',
                name:'tabpanel1',
                activeTab: 0,
                items: []
            },
            {
                region: 'north',
                html: '',
                border: false,
                height: 30,
                style: {
                    display: 'none'
                }            
            }],
            listeners:{
                beforerender: function(t, eOpts){                    
                    t.mask("Cargando los procesos asociados a su perfil. Por favor espere...");                        
                }
            }
        });
    });    
    
    function utf8Encode(unicodeString) {
        if (typeof unicodeString != 'string') throw new TypeError('parameter ‘unicodeString’ is not a string');
        const utf8String = unicodeString.replace(
            /[\u0080-\u07ff]/g,  // U+0080 - U+07FF => 2 bytes 110yyyyy, 10zzzzzz
            function(c) {
                var cc = c.charCodeAt(0);
                return String.fromCharCode(0xc0 | cc>>6, 0x80 | cc&0x3f); }
        ).replace(
            /[\u0800-\uffff]/g,  // U+0800 - U+FFFF => 3 bytes 1110xxxx, 10yyyyyy, 10zzzzzz
            function(c) {
                var cc = c.charCodeAt(0);
                return String.fromCharCode(0xe0 | cc>>12, 0x80 | cc>>6&0x3F, 0x80 | cc&0x3f); }
        );
        return utf8String;
    }

    /**
     * Decodes utf-8 encoded string back into multi-byte Unicode characters.
     *
     * Can be achieved JavaScript by decodeURIComponent(escape(str)),
     * but this approach may be useful in other languages.
     *
     * @param   {string} utf8String - UTF-8 string to be decoded back to Unicode.
     * @returns {string} Decoded Unicode string.
     */
    function utf8Decode(utf8String) {
        if (typeof utf8String != 'string') throw new TypeError('parameter ‘utf8String’ is not a string');
        // note: decode 3-byte chars first as decoded 2-byte strings could appear to be 3-byte char!
        const unicodeString = utf8String.replace(
            /[\u00e0-\u00ef][\u0080-\u00bf][\u0080-\u00bf]/g,  // 3-byte chars
            function(c) {  // (note parentheses for precedence)
                var cc = ((c.charCodeAt(0)&0x0f)<<12) | ((c.charCodeAt(1)&0x3f)<<6) | ( c.charCodeAt(2)&0x3f);
                return String.fromCharCode(cc); }
        ).replace(
            /[\u00c0-\u00df][\u0080-\u00bf]/g,                 // 2-byte chars
            function(c) {  // (note parentheses for precedence)
                var cc = (c.charCodeAt(0)&0x1f)<<6 | c.charCodeAt(1)&0x3f;
                return String.fromCharCode(cc); }
        );
        return unicodeString;
    }
</script>