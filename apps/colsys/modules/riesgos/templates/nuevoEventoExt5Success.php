<link rel="stylesheet" type="text/css"  href="/js/ext6/build/packages/charts/classic/classic/resources/charts-all.css"/>
<table  align="center">
    <tr><td><div id="idPrincipal"></div></td></tr>    
</table>
<script>   
    Ext.Loader.setConfig({
        enabled: true,
        paths: {            
            'Colsys':'/js/Colsys'            
        }
    });

    Ext.onReady(function(){

        var idproceso = <?=$idproceso?>;
        var iddoc = <?=$idtipo?>;
        var documento = '<?=$consecutivo?>';
        var idcliente = <?=$idcliente?>;
        var idsucursal = '<?=$idsucursal?>';
        var descripcion = '<?=$descripcion?>';        
        
        var data = new Array;
        data['nuevo'] = true;
        data['iddoc'] = iddoc?iddoc:null;
        data['documento'] = documento?documento:null;
        data['idcliente'] = idcliente?idcliente:null;
        data['idsucursal'] = idsucursal?idsucursal:null;
        data['descripcion'] = descripcion?descripcion:null;
        
        Ext.create('Ext.panel.Panel', {
            title: 'Nuevo Evento '+'<?=$proceso->getCaNombre()?>',
            width: 700,
            height: 640,
            bodyPadding: 10,
            id:'panelEvento',                    
            name:'panelEvento',
            scrollable: true,            
            renderTo: 'idPrincipal',            
            layout: {
                type: 'vbox',
                pack: 'start',
                align: 'stretch'
            }, 
            items: [
                Ext.create('Ext.form.ComboBox', {
                    fieldLabel: 'Riesgos',
                    id: 'riesgo',
                    name: 'riesgo',                                    
                    store: Ext.create('Ext.data.Store', {
                            fields: ['idriesgo','codigo','riesgo'],
                            proxy: {
                                type: 'ajax',
                                url: '/riesgos/datosRiesgos',
                                extraParams:{
                                    idproceso: idproceso
                                },
                                reader: {
                                    type: 'json',
                                    rootProperty: 'root'
                                }
                             },
                             autoLoad: true
                        }),                    
                    displayField: 'riesgo',
                    valueField: 'idriesgo',                    
                    qtip:'Listado',
                    anchor: '90%',
                    queryMode: 'local',
                    forceSelection: true,                    
                    listConfig: {
                        loadingText: 'buscando...',
                        emptyText: 'No existen registros',
                        getInnerTpl: function() {
                            return '<tpl for="."><div class="search-item1">{riesgo}</div></tpl>';
                        }
                    },
                    listeners:{
                        select: function ( combo, record, eOpts ){
                            console.log(record);
                            var idriesgo = record.data.idriesgo       
                            if(combo.up("panel").down("form")){
                                combo.up("panel").doRemove(combo.up("panel").down("form"));
                            }
                            
                            combo.up("panel").add({
                                xtype:'Colsys.Riesgos.FormEvento',
                                title: 'Riesgo: '+record.data.codigo,
                                id: 'form-evento'+ idriesgo,
                                name: 'form-evento'+ idriesgo,                                
                                border: true,
                                height: 530,
                                idriesgo: idriesgo,                                
                                nuevo: true
                            });
                            Ext.getCmp("form-evento" +  idriesgo).llenarCampos(idriesgo, data);
                        }
                    }
                })
            ]
        });
    });
</script>