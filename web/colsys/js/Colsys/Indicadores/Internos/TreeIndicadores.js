Ext.define('Colsys.Indicadores.Internos.TreeIndicadores', {
    extend: 'Ext.tree.Panel',
    alias: 'widget.Colsys.Indicadores.Internos.TreeIndicadores',
    checkPropagation: 'both',
    controller: 'check-tree',    
    store: {        
        type: 'tree',
        proxy: {
            type: 'ajax',
            url: '/indicadores/datosTreeIndicadores',
            autoLoad: true
        },
        root: { 
            text: "Procesos",
            id: 'src1',
            expanded: true
        },
        folderSort: true,
        sorters: [{
            property: 'text',
            direction: 'ASC'
        }]
    },
    useArrows: true,
    frame: true,
    title: 'Procesos',
    bufferedRenderer: false,
    animate: true,
    listeners: {
        beforecheckchange: 'onBeforeCheckChange'
    },
    tbar: [{
        text: 'Generar Indicador',
        handler: 'onCheckedNodesClick'
    }]
});



Ext.define('Colsys.view.tree.CheckTreeController', {
    extend: 'Ext.app.ViewController',
    alias: 'controller.check-tree',

    onBeforeCheckChange: function(record, checkedState, e) {
        if (record.get('text') === 'Take a nap' && !checkedState) {
            Ext.toast('No rest for the weary!', null, 't');
            return false;
        }
    },

    onCheckedNodesClick: function() {
        var records = this.getView().getChecked(),
            names = [];
            titles = [];
            idgs = [];
            impoexpos = [];
            transportes = [];
            datos = [];
        
        console.log(records);
        
        Ext.Array.each(records, function(rec){
            names.push(rec.get('text'));
            titles.push(rec.get('title'));
            idgs.push(rec.get('idg'));
            impoexpos.push(rec.get('impoexpo'));
            transportes.push(rec.get('transporte'));
            datos.push(rec.get('datos'));            
        });
        
        var panelBusqueda = Ext.getCmp("panel-busqueda");        
        var comboAno = panelBusqueda.child('fieldset[id=fieldset-principal]').child('container[id=container-1]').child('combo[id=ano]');        
        var ano = comboAno.getValue();
        
        var comboMes = panelBusqueda.child('fieldset[id=fieldset-principal]').child('container[id=container-1]').child('combo[id=mes]');        
        var mes = comboMes.getValue();
        
        var comboSucursal = panelBusqueda.child('fieldset[id=fieldset-principal]').child('container[id=container-2]').child('combo[id=sucursal]');        
        var sucursal = comboSucursal.getValue();
        
        var comboTraorigen = panelBusqueda.child('fieldset[id=fieldset-principal]').child('container[id=container-2]').child('combo[id=traorigen]');        
        var traorigen = comboTraorigen.getValue();
        
        var comboCliente = panelBusqueda.child('fieldset[id=fieldset-principal]').child('container[id=container-3]').child('combo[id=cliente]');        
        var cliente = comboCliente.getValue(); 
        
        var comboUsuario = panelBusqueda.child('fieldset[id=fieldset-principal]').child('container[id=container-4]').child('combo[id=login_usuario]');        
        var usuario = comboUsuario.getValue(); 
        
        indicadores = idgs.join();
        anos = ano.join();
        meses = mes.join();
        sucursales = sucursal?sucursal.join():null;
        origenes = traorigen?traorigen.join():null;        
        
        anosId = anos.replace(/,/gi,"");
        mesId = meses.replace(/,/gi,"");
        sucursalId = sucursales?sucursales.length:null;
        origenId = origenes?origenes.length+origenes.substr(0, 2)+origenes.substr(origenes.length-1, 1):null;
        clienteId = cliente;
        usuarioId = usuario;
        
        if(!anos || !mes || !sucursal){
            Ext.MessageBox.show({
                title: 'Error',
                msg: 'El a\u00f1o, mes y sucursal son campos obligatorios!',
                icon: Ext.MessageBox.INFO
            });
        }else{
            
            var vport = panelBusqueda.up('viewport');
            tabpanel = vport.down('tabpanel');
            
            Ext.Array.each(idgs, function(id,key){                
                idg = idgs[key];
                transporte = transportes[key];
                impoexpo = impoexpos[key];
                indice= id+idg+anosId+mesId+sucursalId+origenId+clienteId+usuarioId;
                console.log('indice'+indice);
                if(!tabpanel.getChildByElement('tab-'+indice)){
                    var title = titles[key]+"<br/>"+meses+" / "+anos;
                    title = sucursales?title+"<br/>"+sucursales:title;
                    title = origenes?title+"<br/>"+origenes:title;
                    title = cliente?title+"<br/>"+cliente:title;
                    title = usuario?title+"<br/>"+usuario:title;
                    
                    tabpanel.add({
                        title: '<div style="text-align: center;">'+title+'</div>',
                        titleAlign: 'center',
                        id:'tab-'+indice,
                        itemId:'tab-'+indice,
                        closable: true,
                        //scrollable: true,
                        items:[{
                            xtype: 'tabpanel',
                            id: 'tabpanel-periodo-'+indice,
                            activeTab: 0,
                            //scrollable: true,
                            items: [{
                                title: "Datos",
                                layout: {
                                    type: 'vbox', // Arrange child items vertically
                                    align: 'stretch',    // Each takes up full width ,
                                    pack: 'start'                                
                                },
                                items:[{
                                    flex: 1,
                                    xtype: 'panel',                                    
                                    titleAlign: 'center',
                                    fullscreen: true,
                                    id:'tabdatos-'+indice, 
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
                                        Ext.create('Colsys.Indicadores.Internos.GridIndicadores',{
                                            flex:6/8,
                                            margin: '0 0 5 0',
                                            id: 'grid-indicadores-'+indice,
                                            indice: indice,
                                            datos: datos[key],
                                            mes: meses,
                                            ano: anos,
                                            sucursal: sucursales,
                                            origen: origenes,
                                            cliente: cliente,
                                            usuario: usuario,
                                            idg: idg,
                                            transporte: transporte,
                                            impoexpo: impoexpo
                                        })                                    
                                    ],
                                    listeners:{
                                        beforerender: function (ct, position) {                                        
                                            this.setHeight(this.up('tabpanel').up("tabpanel").getHeight() - 130);
                                        }
                                    }
                                }]
                            },
                            {
                                title: "Repositorio",
                                layout: {
                                    type: 'vbox', // Arrange child items vertically
                                    align: 'stretch',    // Each takes up full width ,
                                    pack: 'start'                                
                                },
                                items:[{
                                        xtype: 'panel',
                                        flex: 1,

                                        titleAlign: 'center',
                                        id:'tabrepos-'+indice, 
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
                                            Ext.create('Colsys.Indicadores.Internos.TreeGridArchivos',{
                                                flex:1,
                                                margin: '0 0 5 0',
                                                id: 'grid-archivos-'+indice,
                                                indice: indice,                                        
                                                url: '/indicadores/datosTreeGridArchivos',
                                                idg: idg
                                            })                                    
                                        ],
                                        listeners:{
                                            beforerender: function (ct, position) {                                        
                                                this.setHeight(this.up('tabpanel').up("tabpanel").getHeight() - 130);
                                            }
                                        }
                                    }]
                            }]
                        }]
                    }).show();
                }
                tabpanel.setActiveTab('tab-'+indice);
            });
        }        
    }
});