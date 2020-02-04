<?php
/*
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
$grupos = $sf_data->getRaw("grupos");
$status = $sf_data->getRaw("status");
$empresas = $sf_data->getRaw("empresas");
$unidades = $sf_data->getRaw("unidades");

include_component("widgets", "widgetEquipo");
include_component("pm", "widgetParams");
include_component("widgets", "widgetCiudad");
include_component("widgets", "widgetMoneda");
include_component("widgets", "widgetCliente");
include_component("widgets", "widgetUnidades");
include_component("widgets", "widgetParametros",array("caso_uso"=>"CU047"));

?>
<script type="text/javascript">
    EditarTicketPropiedadesPanel = function( config ) {
        Ext.apply(this, config);
        
        this.i = 0; 
        this.j = 0;
        this.k = 0;
        this.l = 0;
        
        this.dataDepartamentos = <?=json_encode(array("departamentos" => $sf_data->getRaw("departamentos")))?>;
        this.dataStatus = <?=json_encode(array("root" => $status))?>;
        this.dataEmpresas = <?=json_encode(array("root" => $empresas))?>;
        
        this.resultTpl = new Ext.XTemplate(
            '<tpl for=".">',
            '<tpl if="!this.idempresa(idempresa)">',
                '<div class="search-item">',
                '<span style="color:#F89253;"><b>{nombre}</b></span><br /><span style="font-size:9px;">{empresa}</span>',                
            '</tpl>',
            '<tpl if="this.idempresa(idempresa)">',
                '<div class="search-item">',
                '<span style="color:#33518C;"><b>{nombre}</b></span><br /><span style="font-size:9px;">{empresa}</span>',                
            '</tpl>',
            '</span></div></tpl>',
            {
                idempresa: function(val){                    
                    var grupo = "<?=json_encode($sf_data->getRaw("grupoEmp"))?>";
                    
                    grupo = grupo.replace('[','').replace(']','')+',';                    
                    if(grupo.indexOf(val) >= 0)
                        return true;
                    else
                        return false;                    
                }
            }
        );
    
        this.departamentos = new Ext.form.ComboBox({
            fieldLabel: 'Departamento',
            typeAhead: true,
            forceSelection: true,
            itemSelector: 'div.search-item',
            linkListarTodos: "listar_todos",
            triggerAction: 'all',
            emptyText:'',
            selectOnFocus: true,
            value: '',
            hiddenName: 'departamento',
            id: 'departamento_id',
            lazyRender:true,
            allowBlank: false,
            listClass: 'x-combo-list-small',
            tpl: this.resultTpl,
            displayField: 'nombre',
            valueField: 'iddepartamento',                       
            store : new Ext.data.Store({
                autoLoad : true ,
                proxy: new Ext.data.MemoryProxy( this.dataDepartamentos ),
                reader: new Ext.data.JsonReader(
                    {
                        id: 'iddepartamento',
                        root: 'departamentos'
                    },
                    Ext.data.Record.create([
                        {name: 'iddepartamento'},
                        {name: 'nombre'},
                        {name: 'idempresa'},
                        {name: 'empresa'}
                    ])
                )
            })
        });

        this.departamentos.on("select", this.cargarDepartamentos, this );
        
        this.departamentos.doQuery = function(q, forceAll){
            q = Ext.isEmpty(q) ? '' : q;
            var qe = {
                query: q,
                forceAll: forceAll,
                combo: this,
                cancel:false
            };            
            q = qe.query;
            forceAll = qe.forceAll;
            if(forceAll === true || (q.length >= this.minChars)){

                var listarTodos = (Ext.getCmp(this.linkListarTodos))?Ext.getCmp(this.linkListarTodos).getValue():this.linkListarTodos;
                var empresa = Ext.getCmp("grupoEmp").getValue();
                
                empresa = empresa.replace('[','').replace(']','')+',';
               
                if (!listarTodos){
                    this.store.filterBy(function (record, id) {
                        //alert(empresa.indexOf(record.get("idempresa")));
                        if(empresa.indexOf(record.get("idempresa")) >= 0){
                            var str = record.get("nombre");                            

                            var txt = new RegExp(q, "ig");
                            if (str.search(txt) == -1)
                                return false;
                            else
                                return true;
                        }
                        else
                            return false;                       
                    });                                        
                }else{
                    if (q != ""){
                        this.store.filterBy(function (record, id) {
                            var str = record.get("nombre");
                            var str1 = record.get("empresa");

                            var txt = new RegExp(q, "ig");
                            if (str.search(txt) == -1 && str1.search(txt) == -1)
                                return false;
                            else
                                return true;
                        });
                    }
                    else
                        this.store.filter("", "", true, true);
                }
                this.onLoad();
            }
        }
        
        this.storeEquipos = new Ext.data.Store({
            autoLoad : true,
            url: '<?= url_for("conceptos/datosConceptos") ?>',
            baseParams:{
                transporte:"<?= Constantes::MARITIMO ?>",
                modalidad:"<?= Constantes::FCL ?>",
                impoexpo:"<?= Constantes::IMPO ?>"
            },
            reader: new Ext.data.JsonReader({
                root: 'root',
                totalProperty: 'total',
                successProperty: 'success'
            },
            Ext.data.Record.create([
                {name: 'idconcepto'},
                {name: 'concepto'}
            ])
            )
        });
        
        /*this.storePatios = new Ext.data.Store({
            autoLoad : true,
            url: '<?= url_for("pricing/datosPanelParametrosPatios") ?>',
            baseParams:{
                readOnly: false
            },
            reader: new Ext.data.JsonReader({
                    root: 'root',
                    totalProperty: 'totalCount',
                    successProperty: 'success'
                },
                Ext.data.Record.create([
                    {name: 'idpatio', type: 'int', mapping: 'p_ca_idpatio'},
                    {name: 'nombre', type: 'string', mapping: 'p_ca_nombre'},           
                    {name: 'idciudad', type: 'string', mapping: 'p_ca_idciudad'},
                    {name: 'ciudad', type: 'string', mapping: 'c_ca_ciudad'},
                    {name: 'direccion', type: 'string', mapping: 'p_ca_direccion'}
                ])
            )
        });
        
        this.resultTplPatios = new Ext.XTemplate(
            '<tpl for="."><div class="search-item"><span style="color:#33518C;"><b>{nombre}</b></span><br /><span style="font-size:9px;">{direccion} - {ciudad}</span></div></tpl>'
        );*/
        
        this.areas =  new Ext.form.ComboBox({
            fieldLabel: 'Área',
            typeAhead: true,
            forceSelection: true,
            triggerAction: 'all',
            emptyText:'',
            selectOnFocus: true,
            value: '',
            id: 'area_id',
            lazyRender:true,
            allowBlank: false,
            displayField: 'nombre',
            valueField: 'idgrupo',
            hiddenName: 'area',
            listClass: 'x-combo-list-small',

            store : new Ext.data.Store({
                autoLoad : false ,
                url: '<?=url_for("pm/datosAreas")?>',
                reader: new Ext.data.JsonReader(
                    {
                        id: 'idgrupo',
                        root: 'grupos',
                        totalProperty: 'total',
                        successProperty: 'success'
                    },
                    Ext.data.Record.create([
                        {name: 'idgrupo'},
                        {name: 'nombre'}
                    ])
                )
            }),            
            listeners: {
                select: function(combo, record, index) {
                    // Verifica si la opción escogida es Tarifas Internacionales
                    if(combo.getValue()===25){
                        <?
                        $folder = "Tarifario/helpdesk";
                        $filename = "FORMATO_SOLICITUD_DE_TARIFAS.xls";                      
                        ?>                      
                        Ext.getCmp("title").setValue("Solicitud de Tarifas Transporte Internacional");                      
                        Ext.getCmp("text_id").setValue('<div>Adjunto al presente ticket encontrará el documento con las tarifas solicitadas</div>');
                        Ext.getCmp("tarifas").show();
                        Ext.getCmp("detalles").hide();
                        Ext.getCmp("fcl").toggleCollapse();
                        Ext.getCmp("panel-carga").toggleCollapse();                        
                    }else{
                        Ext.getCmp("tarifas").hide();
                        Ext.getCmp("detalles").show();                        
                        
                        Ext.getCmp("origen0").setDisabled(true);
                        Ext.getCmp("destino0").setDisabled(true);
                        Ext.getCmp("tarifareq").setDisabled(true);
                        Ext.getCmp("fchembarque").setDisabled(true);
                        Ext.getCmp("compania").setDisabled(true);                        
                        Ext.getCmp("patio").setDisabled(true);
                    }
                },
                afterrender: function(t) {
                    //console.log(t);
                    console.log(t);
                    /*if(t.getValue() !=25){
                        Ext.getCmp("origen0").setDisabled(true);
                        Ext.getCmp("destino0").setDisabled(true);
                        Ext.getCmp("tarifareq").setDisabled(true);
                        Ext.getCmp("fchembarque").setDisabled(true);
                        Ext.getCmp("compania").setDisabled(true);                        
                        Ext.getCmp("patio").setDisabled(true);
                    }*/
                }
            }
        });

        this.areas.on("select", this.cargarAreas, this );

        this.projectos = new Ext.form.ComboBox({
            fieldLabel: 'Proyecto',
            typeAhead: true,
            forceSelection: true,
            triggerAction: 'all',
            emptyText:'',
            selectOnFocus: true,
            value: '',
            id: 'proyecto_id',
            lazyRender:true,
            allowBlank: true,
            displayField: 'nombre',
            valueField: 'idproyecto',
            hiddenName: 'project',
            listClass: 'x-combo-list-small',
            mode: 'local',

            store : new Ext.data.Store({
                autoLoad : true ,
                url: '<?=url_for("pm/datosProyectos")?>',
                reader: new Ext.data.JsonReader(
                {
                    id: 'idproyecto',
                    root: 'proyectos',
                    totalProperty: 'total',
                    successProperty: 'success'
                },
                Ext.data.Record.create([
                    {name: 'idproyecto'},
                    {name: 'nombre'}
                ])
            )
            })
        });

        this.projectos.on("select", this.cargarProyectos, this );

        this.milestones = new Ext.form.ComboBox({
            fieldLabel: 'Status',
            typeAhead: true,
            forceSelection: true,
            triggerAction: 'all',
            emptyText:'',
            selectOnFocus: true,
            value: '',
            id: 'milestone_id',
            lazyRender:true,
            allowBlank: true,
            displayField: 'valor',
            valueField: 'status',
            hiddenName: 'status',
            listClass: 'x-combo-list-small',
            mode: 'local',
            store : new Ext.data.Store({
                autoLoad : false ,
                url: '<?=url_for("pm/datosStatus")?>',
                reader: new Ext.data.JsonReader({                    
                    root: 'root',
                    totalProperty: 'total',
                    successProperty: 'success'
                },
                Ext.data.Record.create([
                    {name: 'status'},
                    {name: 'valor'}
                ])
                )
            })
        });
        
        this.asignaciones = new Ext.form.ComboBox({
            fieldLabel: 'Asignado a',
            typeAhead: true,
            forceSelection: true,
            triggerAction: 'all',
            emptyText:'',
            selectOnFocus: true,
            value: '',
            id: 'assignedto_id',
            lazyRender:true,
            allowBlank: true,
            displayField: 'login',
            valueField: 'login',
            hiddenName: 'assignedto',
            listClass: 'x-combo-list-small',
            mode: 'local',
            store : new Ext.data.Store({
                autoLoad : true ,
                url: '<?=url_for("pm/datosAsignaciones")?>',
                reader: new Ext.data.JsonReader(
                {
                    id: 'login',
                    root: 'usuarios',
                    totalProperty: 'total',
                    successProperty: 'success'
                },
                Ext.data.Record.create([
                    {name: 'login'}

                ])
            )
            })
        });

        this.reportadoPor = new Ext.form.ComboBox({
            fieldLabel: 'Reportado por',
            typeAhead: true,
            forceSelection: true,
            triggerAction: 'all',
            emptyText:'',
            selectOnFocus: true,
            value: '',
            id: 'reportedby_id',
            name: 'login',
            lazyRender:true,
            allowBlank: true,
            displayField: 'nombre',
            valueField: 'login',
            hiddenName: 'reportedby',
            listClass: 'x-combo-list-small',
            mode: 'local',
            store : new Ext.data.Store({
                autoLoad : true ,
                url: '<?=url_for("pm/datosUsuarios")?>',
                reader: new Ext.data.JsonReader(
                {
                    root: 'usuarios',
                    totalProperty: 'total',
                    successProperty: 'success'
                },
                Ext.data.Record.create([
                    {name: 'login'},
                    {name: 'nombre'}

                ])
            )
            })
        });

        this.prioridades = new Ext.form.ComboBox({
            fieldLabel: 'Prioridad',
            typeAhead: true,
            forceSelection: true,
            triggerAction: 'all',
            emptyText:'',
            selectOnFocus: true,
            value: 'Baja',
            name: 'priority',
            id: 'priority_id',
            lazyRender:true,
            allowBlank: true,
            listClass: 'x-combo-list-small',
            store : [
                ["Baja", "Baja"],
                ["Media", "Media"],
                ["Alta", "Alta"]
            ]
        });

        this.tipos = new Ext.form.ComboBox({
            fieldLabel: 'Tipo',
            typeAhead: true,
            forceSelection: true,
            triggerAction: 'all',
            emptyText:'',
            selectOnFocus: true,
            value: 'Tarea',
            name: 'type',
            id: 'type_id',
            lazyRender:true,
            allowBlank: true,
            listClass: 'x-combo-list-small',
            displayField: 'clasification',
            valueField: 'clasification',
            store : new Ext.data.Store({
                autoLoad : false ,
                url: '<?=url_for("pm/datosClasificacion")?>',
                reader: new Ext.data.JsonReader(
                {
                    root: 'root',
                    totalProperty: 'total',
                    successProperty: 'success'
                },
                Ext.data.Record.create([
                    {name: 'iddepartamento'},
                    {name: 'clasification'}
                ])
            )
            })
        });

        this.acciones = new Ext.form.ComboBox({
            fieldLabel: 'Estado',
            typeAhead: true,
            forceSelection: true,
            triggerAction: 'all',
            emptyText:'',
            selectOnFocus: true,
            value: 'Abierto',
            name: 'actionTicket',
            id: 'actionTicket_id',
            lazyRender:true,
            allowBlank: true,
            listClass: 'x-combo-list-small',
            store : [
                ["Abierto", "Abierto"],
                ["Cerrado", "Cerrado"]
            ]
        });

        this.reportedoThrough = new Ext.form.ComboBox({
            fieldLabel: 'Medio reportado',
            typeAhead: true,
            forceSelection: true,
            triggerAction: 'all',
            emptyText:'',
            selectOnFocus: true,
            value: 'Web',
            name: 'reportedthrough',
            id: 'reportedthrough_id',
            lazyRender:true,
            allowBlank: true,
            listClass: 'x-combo-list-small',
            store : [
                <?
                $i = 0;
                foreach( $reportedThroughtParams as $param ){
                    if( $i++!=0){
                        echo ",";
                    }
                    ?>
                    ["<?=$param->getCaValor()?>", "<?=$param->getCaValor()?>"]
                    <?
                }
                ?>
                
            ]
        });

        this.activo = new WidgetEquipo({
            fieldLabel: 'Activo',
            name: 'activo',
            hiddenName: 'idactivo',
            id: 'activo_id'
        });

        this.empresas = new Ext.form.ComboBox({
            fieldLabel: 'Empresa',
            typeAhead: true,
            forceSelection: true,
            triggerAction: 'all',
            emptyText:'',
            selectOnFocus: true,
            value: '',
            id: 'empresa_id',
            lazyRender:true,
            allowBlank: true,
            displayField: 'nombre',
            valueField: 'idempresa',
            hiddenName: 'idempresa',
            listClass: 'x-combo-list-small',
            mode: 'local',

            store : new Ext.data.Store({                
                autoLoad : true ,
                proxy: new Ext.data.MemoryProxy( this.dataEmpresas ),
                reader: new Ext.data.JsonReader(
                {

                    root: 'root',
                    totalProperty: 'total',
                    successProperty: 'success'
                },
                Ext.data.Record.create([
                    {name: 'idempresa'},
                    {name: 'nombre'}
                ])
            )
            })
        });


        EditarTicketPropiedadesPanel.superclass.constructor.call(this, {            
            id: 'form-ticket-panel',
            autoHeight: true,            
            bodyStyle:'padding:5px 5px 0',
            url: '<?=url_for('pm/formTicketGuardar')?>',
            fileUpload : true,
            items: [
                {
                    xtype:'fieldset',
                    title: 'Clasificación',
                    autoHeight:true,
                    layout:'column',
                    columns: 3,
                    defaults:{
                        //columnWidth:0.5,
                        layout:'form',
                        border:false,
                        bodyStyle:'padding:4px'
                    },
                    items:[{
                            columnWidth:.44,
                            layout: 'form',
                            xtype:'fieldset',
                            items: [
                                this.departamentos,
                                this.projectos,
                                this.tipos,
                                this.asignaciones,
                                this.reportadoPor,
                                this.activo
                            ]
                        },{
                            columnWidth:.09 ,
                            layout: 'form',
                            xtype:'fieldset',
                            items: [
                                {
                                    xtype: "checkbox",
                                    hideLabel: "true",                                    
                                    id: "listar_todos",
                                    name:"listar_todos"                                  
                                },
                                {
                                    xtype:"hidden",
                                    id: 'grupoEmp',
                                    name: 'empresa',
                                    value:'<?=json_encode($sf_data->getRaw("grupoEmp"))?>'
                                }
                            ]
                        },{
                            columnWidth:.44,
                            layout: 'form',
                            xtype:'fieldset',
                            items: [
                                this.areas,
                                this.prioridades,
                                this.acciones,
                                this.milestones,
                                this.reportedoThrough,
                                this.empresas
                            ]
                        }]
                },
                {
                    xtype:'fieldset',
                    title: 'Detalles',
                    id: 'detalles',
                    autoHeight:true,                    
                    defaults:{
                        columnWidth:0.5,
                        layout:'form',
                        border:false,
                        bodyStyle:'padding:4px'
                    },
                    items:[

                        {
                            xtype:'textfield',
                            fieldLabel: 'Titulo',
                            name: 'title',
                            id: 'title',
                            anchor:'95%',
                            allowBlank: false
                        },

                        {
                            xtype:'htmleditor',
                            id:'text_id',
                            name:'text',
                            fieldLabel:'Descripción',
                            height:120,
                            anchor:'98%',
                            enableFont: false,
                            enableFontSize: false,
                            enableLinks:  false,
                            enableSourceEdit : false,
                            enableColors : false,
                            enableLists: false,
                            allowBlank: false

                        },
                        {
                            xtype: 'fileuploadfield',
                            id: 'archivo',
                            width: 250,
                            fieldLabel: 'Adjuntar',
                            emptyText: 'Seleccione un archivo',
                            buttonCfg: {
                                text: '',
                                iconCls: 'upload-icon'
                            }
                        },
                        {
                            xtype:'hidden',
                            name: 'idticket',
                            value: this.idticket,
                            anchor:'95%'
                        }
                    ]
                },
                {
                    xtype:'fieldset',
                    title: 'Tarifa Internacional',
                    id: "tarifas",
                    name: "tarifas",
                    height:400,                     
                    autoScroll: true,
                    layout : 'column',                    
                    columns : 1,
                    defaults:{                        
                        xtype:'fieldset', 
                        layout:'form',
                        border:false,
                        bodyStyle:'padding:4px'
                    },                    
                    items:[{
                        columnWidth:1,                                
                        border:false,                                
                        items:[{
                            xtype:'fieldset',
                            title:'Trayecto',
                            id: 'trayecto',
                            items:[{
                                xtype:'button',
                                text:"Agregar Trayecto",                                
                                handler: function() {
                                    var panel = Ext.getCmp("form-ticket-panel");                                    
                                    var k = panel.k;
                                    panel.agregarTrayecto(k);
                                },
                                style: {
                                    marginBottom: '10px'
                                }
                            },{
                                xtype:'fieldset',                                
                                border:true,                                
                                autoHeight:true,
                                id:'panel-trayecto0',
                                layout:'column',                                
                                columns : 2,
                                defaults:{                                    
                                    xtype:'fieldset',                                    
                                    layout:'form',
                                    labelAlign: 'top',
                                    border:false    
                                },                                
                                items:[{
                                    columnWidth:.5,                                
                                    border:false,                                
                                    items:[
                                    new WidgetCiudad({fieldLabel: 'Origen',                                                      
                                        id: 'origen0',
                                        idciudad:"origen0",
                                        hiddenName:"idorigen0",                            
                                        impoexpo:'<?=  Constantes::IMPO?>',
                                        allowBlank: false,
                                        width: 250
                                    }),
                                    {
                                        xtype: 'radiogroup',
                                        itemCls: 'x-check-group-alt',
                                        id: 'rtransori0',                                        
                                        columns: 1,
                                        items: [
                                            {boxLabel: 'Puerto (CY-Container Yard)', name: 'transori0', 'inputValue':'cy',checked: true}
                                        ]
                                    },
                                    {
                                        xtype: 'checkbox',                                        
                                        id: 'exw0',
                                        name: 'exw0',
                                        boxLabel: 'Gastos EXW',
                                        listeners:{
                                            check: function(t, checked){
                                                if(checked){
                                                    Ext.getCmp("recogida0").show();
                                                    Ext.getCmp("recogida0").allowBlank = false;
                                                }else{
                                                    Ext.getCmp("recogida0").hide();
                                                    Ext.getCmp("recogida0").allowBlank = true;
                                                }
                                            }
                                        }
                                    },
                                    {
                                        xtype: 'textfield',
                                        fieldLabel: 'Dirección de recogida',
                                        //emptyText: '',    
                                        hidden: true,
                                        name: 'recogida0',
                                        id: 'recogida0',  
                                        allowBlank: true,
                                        width: 200
                                    }]
                                },{
                                    columnWidth:.5,                                
                                    border:false,                                
                                    items:[
                                        new WidgetCiudad({fieldLabel: 'Destino',
                                            id: 'destino0',
                                            idciudad:"destino0",
                                            hiddenName:"iddestino0",                                
                                            impoexpo:'<?=  Constantes::IMPO?>',
                                            allowBlank: false,
                                            width: 250
                                        }),
                                        {
                                            xtype: 'radiogroup',
                                            itemCls: 'x-check-group-alt',
                                            id: 'rtransdest0',
                                            columns: 1,
                                            items: [
                                                {boxLabel: 'Puerto (CY-Container Yard)', name: 'transdest0', 'inputValue':'cy', checked: true},
                                                {boxLabel: 'Puerta (SD-Store Door)', name: 'transdest0', 'inputValue':'sd'}
                                            ]
                                        }]
                                }]
                            }]
                        }]
                    },
                    {
                        columnWidth:1,
                        border:false,                                
                        items:[{
                            xtype:'fieldset',
                            title:'Producto',
                            id: 'productos',
                            items: [{
                                xtype:'fieldset',                                
                                border:true,                                
                                autoHeight:true,
                                id:'panel-producto',
                                layout:'column',                                
                                columns : 1,
                                defaults:{                                    
                                    xtype:'fieldset',                                    
                                    layout:'form',
                                    labelAlign: 'top',
                                    border:false    
                                },                                
                                items:[{
                                    columnWidth:1,                                
                                    border:false,                                
                                    items:[/*
                                    new WidgetParams({
                                            id:'producto',
                                            name:'producto',
                                            hiddenName:'nproducto',
                                            //fieldLabel: "Producto",
                                            caso:"CU269",
                                            emptyText: 'Freight All Kind',
                                            allowBlank: false,
                                            width:650/*,
                                            idvalor:"name"*/
                                    /*})*/
                                        {
                                            xtype: 'textfield',
                                            fieldLabel: 'Producto',                                        
                                            id: 'producto',
                                            name: 'producto',
                                            hiddenName:'nproducto',
                                            emptyText: 'Freight All Kind',
                                            //allowBlank: false,
                                            width: 650
                                        }
                                    ]
                                }]
                            }]
                        }]
                    },//    Carga Peligrosa
                    {
                        columnWidth:1,                                
                        border:false,                                
                        items:[{
                            xtype:'fieldset',
                            title:'Carga Peligrosa',                            
                            id: 'panel-carga',
                            checkboxToggle:true,
                            items:[{
                                xtype:'button',
                                text:"Agregar IMO",
                                //handler:this.agregarImo                                
                                handler: function() {
                                    var panel = Ext.getCmp("form-ticket-panel");                                    
                                    var i = panel.i;
                                    panel.agregarImo(i);
                                }
                            },{
                                xtype:'fieldset',                                
                                border:false,                                
                                autoHeight:true,
                                id:'panel-imo0',
                                layout:'column',
                                columns : 1,
                                defaults:{                                    
                                    xtype:'fieldset',                                    
                                    layout:'form',
                                    border:false    
                                },                                
                                items:[{                                                                   
                                    columnWidth:0.7,                                    
                                    items:[{
                                        xtype:"hidden",
                                        id:"idimo0",
                                        name:"idimo0",
                                        hiddenName:'nIdimo0'
                                    },
                                    new WidgetParams({
                                            id:'claseimo0',
                                            name:'claseimo0',
                                            hiddenName:'nclaseimo0',
                                            fieldLabel: "Clase IMO",
                                            caso:"CU270",
                                            width:360/*,
                                            idvalor:"name2"*/
                                    })]
                                },{                                
                                    columnWidth:0.3,                                    
                                    items:[{
                                        xtype: 'textfield',
                                        fieldLabel: 'UN Number',
                                        name: 'unnumber0',
                                        id: 'idunnumber0',
                                        width: 50
                                    }]
                                }]
                            }],
                            listeners:{
                                expand: function( p ){                                    
                                    Ext.getCmp("claseimo0").allowBlank = false;
                                    Ext.getCmp("idunnumber0").allowBlank = false;
                                    Ext.getCmp("archivo_tarifas").allowBlank = false;
                                    Ext.MessageBox.alert('Recordatorio', "No olvide adjuntar la MSDS (Hoja de datos de seguridad de los materiales). Sin ese documento el ticket no podrá generarse y/0 será invalidado.");
                                },
                                collapse: function(p){                                      
                                    Ext.getCmp("claseimo0").allowBlank = true;
                                    Ext.getCmp("idunnumber0").allowBlank = true;
                                    Ext.getCmp("archivo_tarifas").allowBlank = true;
                                }
                            }
                        }]
                    },//    FCL
                    {
                        columnWidth:1,                                
                        border:false,                                
                        items:[{
                            xtype:'fieldset',
                            title:'FCL',
                            id: "fcl",                            
                            checkboxToggle:true,
                            items:[{
                                xtype:'button',
                                text:"Agregar Contenedor",
                                //handler:this.agregarContenedor,
                                handler: function() {
                                    var panel = Ext.getCmp("form-ticket-panel");                                    
                                    var j = panel.j;
                                    panel.agregarContenedor(j);
                                },
                                style: {
                                    marginBottom: '10px'
                                }
                            },{
                                xtype:'fieldset',                                
                                border:true,                                
                                autoHeight:true,
                                id:'panel-contenedor0',
                                layout:'column',
                                //title: 'Contenedor 1',
                                columns : 6,
                                defaults:{                                    
                                    xtype:'fieldset',                                    
                                    layout:'form',
                                    labelAlign: 'top',
                                    border:false    
                                },                                
                                items:[{                                                                   
                                    columnWidth:0.3,                                    
                                    items:[{
                                        xtype:"hidden",
                                        id:"idcont0",
                                        name:"idcont0"
                                    },
                                    new Ext.form.ComboBox({
                                            fieldLabel: 'Contenedor',
                                            typeAhead: true,
                                            forceSelection: true,
                                            triggerAction: 'all',
                                            selectOnFocus: true,
                                            name: 'idequipo0',
                                            id: 'idequipo0',
                                            hiddenName: 'nequipo0',
                                            mode: 'local',
                                            displayField: 'concepto',
                                            valueField: 'idconcepto',
                                            lazyRender:true,
                                            listClass: 'x-combo-list-small',
                                            store : this.storeEquipos,
                                            tpl: new Ext.XTemplate(
                                                '<tpl for="."><div class="search-item"><b>{concepto}</b><br /><span>{aka}</span> </div></tpl>'
                                            ),
                                            itemSelector: 'div.search-item',
                                            width: 180,
                                            listeners:{
                                                select:function(field, record, index){                                                                                       
                                                    var idconcepto = record.data.idconcepto;
                                                    var reefer = [13,20,17,54,55];
                                                    var flat = [11,12,14,16,18,132,253,254,314,315];

                                                    // Contenedor Reefer
                                                    if($.inArray( idconcepto, reefer )>=0){ 
                                                        Ext.getCmp("temperatura0").show();
                                                        Ext.getCmp('temperatura0').allowBlank = false;
                                                        Ext.getCmp("dimensiones0").hide();
                                                        Ext.getCmp('dimensiones0').allowBlank = true;
                                                        Ext.getCmp("rgauge0").hide();                        
                                                    }else if($.inArray( idconcepto, flat )>=0){
                                                        Ext.getCmp("temperatura0").hide();
                                                        Ext.getCmp('temperatura0').allowBlank = true;
                                                        Ext.getCmp("dimensiones0").hide();
                                                        Ext.getCmp('dimensiones0').allowBlank = true;
                                                        Ext.getCmp("unidimension0").hide();
                                                        Ext.getCmp('unidimension0').allowBlank = true;
                                                        Ext.getCmp("rgauge0").show();
                                                    }else{
                                                        Ext.getCmp("temperatura0").hide();
                                                        Ext.getCmp('temperatura0').allowBlank = true;
                                                        Ext.getCmp("dimensiones0").hide();
                                                        Ext.getCmp('dimensiones0').allowBlank = true;
                                                        Ext.getCmp("unidimension0").hide();
                                                        Ext.getCmp('unidimension0').allowBlank = true;
                                                        Ext.getCmp("rgauge0").hide();
                                                    } 
                                                }                
                                            }   
                                        })
                                    ]
                                },{                                
                                    columnWidth:0.1,                                    
                                    items:[{ 
                                        xtype: 'numberfield',
                                        fieldLabel: 'Cant.',
                                        name: 'cant0',
                                        id: 'cant0',
                                        minvalue: 0,
                                        thousandSeparator: '.',
                                        decimalSeparator: ',',                                        
                                        width: 30
                                    }]
                                },{                                
                                    columnWidth:0.1,                                    
                                    items:[{
                                        xtype: 'numberfield',
                                        fieldLabel: 'Peso (Kg)',
                                        minvalue: 0,
                                        name: 'peso0',
                                        id: 'peso0',
                                        thousandSeparator: '.',
                                        decimalSeparator: ',',                                        
                                        width: 40
                                    }]
                                },{                                
                                    columnWidth:0.15,                                    
                                    items:[{
                                        xtype: 'textfield',
                                        fieldLabel: 'Frecuencia',
                                        name: 'frec0',
                                        id: 'idfrec0',
                                        width: 80
                                    }]
                                },{                                
                                    columnWidth:0.15,                                    
                                    items:[{ 
                                        xtype: 'numberfield',
                                        fieldLabel: 'Temp.(°C)',
                                        name: 'temperatura0',
                                        id: 'temperatura0',
                                        minvalue: 0,                                        
                                        hidden: true,
                                        width: 30
                                    }]
                                },{                                
                                    columnWidth:0.15,                                    
                                    items:[{                                        
                                        xtype: 'radiogroup',
                                        itemCls: 'x-check-group-alt',
                                        id: 'rgauge0',
                                        hidden: true,
                                        columns: 1,
                                        fieldLabel: 'Capacidad',
                                        items: [
                                            {boxLabel: 'In Gauge', name: 'gauge0', 'inputValue': 'in', checked: true},
                                            {boxLabel: 'Out Gauge', name: 'gauge0', 'inputValue':'out'}
                                        ],
                                        listeners: {
                                            change: function(radiogroup, radio) {                                                                                            
                                                if(radio.inputValue==='out'){
                                                    Ext.getCmp("temperatura0").hide();
                                                    Ext.getCmp('temperatura0').allowBlank = true;
                                                    Ext.getCmp("dimensiones0").show();
                                                    Ext.getCmp('dimensiones0').allowBlank = false;
                                                    Ext.getCmp("unidimension0").show();
                                                    Ext.getCmp('unidimension0').allowBlank = false;
                                                }else{
                                                    Ext.getCmp("temperatura0").hide();
                                                    Ext.getCmp('temperatura0').allowBlank = true;
                                                    Ext.getCmp("dimensiones0").hide();
                                                    Ext.getCmp('dimensiones0').allowBlank = true;
                                                    Ext.getCmp("unidimension0").hide();
                                                    Ext.getCmp('unidimension0').allowBlank = true;
                                                }
                                            },
                                            show: function(t) {  
                                                if(t.getValue().inputValue=="out"){
                                                    Ext.getCmp("dimensiones0").show();
                                                    Ext.getCmp('dimensiones0').allowBlank = false;
                                                    Ext.getCmp("unidimension0").show();
                                                    Ext.getCmp('unidimension0').allowBlank = false;
                                                }
                                                
                                            }
                                        }
                                    }]
                                },{                                
                                    columnWidth:0.2,                                    
                                    items:[{
                                        xtype: 'textfield',
                                        fieldLabel: 'Dimensiones (LargoxAnchoxAlto)',
                                        emptyText: '',
                                        hidden: true,
                                        name: 'dimensiones0',
                                        id: 'dimensiones0',
                                        width: 130
                                    }]
                                },{                                
                                    columnWidth:0.2,                                    
                                    items:[
                                        new WidgetUnidades({
                                            fieldLabel: 'Unidad',
                                            hidden: true,
                                            id: 'unidimension0',
                                            name:"unidimension0",                                                                                        
                                            width: 130
                                        })                                        
                                    ]                                    
                                }]
                            }/*,
                            {
                                xtype:'fieldset',                                
                                border:true,                                
                                autoHeight:true,
                                id:'patios',
                                layout:'column',                                
                                columns : 1,
                                defaults:{                                    
                                    xtype:'fieldset',                                    
                                    layout:'form',
                                    labelAlign: 'top',
                                    border:false    
                                },                                
                                items:[{                                
                                    columnWidth:1, 
                                    items: [{/*new Ext.form.ComboBox({
                                                fieldLabel: 'Devolución del vacío',
                                                typeAhead: true,
                                                forceSelection: true,
                                                triggerAction: 'all',
                                                selectOnFocus: true,
                                                name: 'patio',
                                                id: 'patio',
                                                mode: 'local',
                                                displayField: 'nombre',
                                                valueField: 'idpatio',
                                                lazyRender:true,
                                                listClass: 'x-combo-list-small',
                                                store : this.storePatios,
                                                tpl: this.resultTplPatios,
                                                itemSelector: 'div.search-item',
                                                width: 300
                                            })*/
                                        /*xtype: 'textfield',
                                        fieldLabel: 'Devolución del vacío',
                                        emptyText: '',                                        
                                        name: 'patio',
                                        id: 'patio',
                                        hidden: true,
                                        width: 200
                                    }]
                                }]
                            }*/],
                            listeners:{
                                expand: function( p ){                                    
                                    Ext.getCmp("idequipo0").allowBlank = false;
                                    Ext.getCmp("cant0").allowBlank = false;
                                    Ext.getCmp("peso0").allowBlank = false;
                                    Ext.getCmp("idfrec0").allowBlank = false;
                                },
                                collapse: function(p){                                      
                                    Ext.getCmp("idequipo0").allowBlank = true;
                                    Ext.getCmp("cant0").allowBlank = true;
                                    Ext.getCmp("peso0").allowBlank = true;
                                    Ext.getCmp("idfrec0").allowBlank = true;
                                }
                            }
                        }]
                    },//   LCL 
                    {
                        columnWidth:1,                                
                        border:false,                                
                        items:[{
                            xtype:'fieldset',
                            title:'LCL',
                            id: "lcl",                            
                            checkboxToggle:true,
                            collapsed: true,                                                        
                            items:[{                                        
                                xtype: 'radiogroup',
                                itemCls: 'x-check-group-alt',
                                id: 'rlcl',                                        
                                //columns: 1,
                                fieldLabel: 'Tipo de Tarifa',
                                items: [
                                    {boxLabel: 'Tarifa TM3', name: 'tarifalcl', 'inputValue': 'tm3', checked: true},
                                    {boxLabel: 'Tarifa Puntual', name: 'tarifalcl', 'inputValue':'puntual'}
                                ],
                                listeners: {
                                    change: function(radiogroup, radio) {                                                                                            
                                        if(radio.inputValue==='tm3'){
                                            /*Ext.getCmp("pesoLcl0").hide();
                                            Ext.getCmp("dimensionesLcl0").hide();
                                            Ext.getCmp("piezasLcl0").hide();*/
                                            Ext.getCmp("buttonLcl").hide();
                                            Ext.getCmp("panel-lcl0").hide();
                                            Ext.getCmp('piezasLcl0').allowBlank = true;
                                            Ext.getCmp('pesoLcl0').allowBlank = true;                                                    
                                            Ext.getCmp('dimensionesLcl0').allowBlank = true;
                                            Ext.getCmp('unidimensionLcl0').allowBlank = true;
                                            Ext.getCmp('embalaje0').allowBlank = true;
                                        }else{
                                            /*Ext.getCmp("pesoLcl0").show();
                                            Ext.getCmp("dimensionesLcl0").show();
                                            Ext.getCmp("piezasLcl0").show();*/
                                            Ext.getCmp("buttonLcl").show();
                                            Ext.getCmp("panel-lcl0").show();
                                            Ext.getCmp('piezasLcl0').allowBlank = false;
                                            Ext.getCmp('pesoLcl0').allowBlank = false;                                                    
                                            Ext.getCmp('dimensionesLcl0').allowBlank = false;
                                            Ext.getCmp('unidimensionLcl0').allowBlank = false;
                                            Ext.getCmp('embalaje0').allowBlank = false;
                                        }
                                    },
                                    show: function(t) {  
                                        if(t.getValue().inputValue=="tm3"){
                                            /*Ext.getCmp("pesoLc0l").hide();
                                            Ext.getCmp("dimensionesLcl0").hide();
                                            Ext.getCmp("piezasLcl0").hide();*/
                                            Ext.getCmp("buttonLcl").hide();
                                            Ext.getCmp("panel-lcl0").hide();
                                            Ext.getCmp('piezasLcl0').allowBlank = true;
                                            Ext.getCmp('pesoLcl0').allowBlank = true;                                                    
                                            Ext.getCmp('dimensionesLcl0').allowBlank = true;
                                            Ext.getCmp('unidimensionLcl0').allowBlank = true;
                                            Ext.getCmp('embalaje0').allowBlank = true;
                                        }

                                    }
                                }
                            },{
                                xtype:'button',
                                text:"Agregar Piezas",
                                id: "buttonLcl",
                                hidden: true,
                                handler: function() {
                                    var panel = Ext.getCmp("form-ticket-panel");                                    
                                    var l = panel.l;
                                    panel.agregarPiezas(l);
                                },
                                style: {
                                    marginBottom: '10px'
                                }
                            },{
                                xtype:'fieldset',                                
                                border:true,                                
                                autoHeight:true,
                                id:'panel-lcl0',
                                layout:'column',
                                //title: 'Contenedor 1',
                                hidden: true,
                                columns : 4,
                                defaults:{                                    
                                    xtype:'fieldset',                                    
                                    layout:'form',
                                    labelAlign: 'top',
                                    border:false    
                                },
                                items:[{                                
                                    columnWidth:0.1,                                    
                                    items:[{
                                        xtype: 'numberfield',
                                        fieldLabel: 'Piezas',
                                        minvalue: 0,
                                        name: 'piezasLcl0',
                                        id: 'piezasLcl0',
                                        thousandSeparator: '.',
                                        decimalSeparator: ',', 
                                        width: 60
                                    }]
                                },{                                
                                    columnWidth:0.2,                                    
                                    items:[{
                                        xtype: 'numberfield',
                                        fieldLabel: 'Peso (Kg)',
                                        minvalue: 0,
                                        name: 'pesoLcl0',
                                        id: 'pesoLcl0',
                                        thousandSeparator: '.',
                                        decimalSeparator: ',', 
                                        width: 70
                                    }]
                                },{                                
                                    columnWidth:0.3,                                    
                                    items:[{
                                        xtype: 'textfield',
                                        fieldLabel: 'Dimensiones (LargoxAnchoxAlto)',
                                        emptyText: '',                                        
                                        name: 'dimensionesLcl0',
                                        id: 'dimensionesLcl0',
                                        width: 180
                                    }]
                                },
                                {                                
                                    columnWidth:0.2,                                    
                                    items:[
                                        new WidgetUnidades({
                                            fieldLabel: 'Unidad',                                            
                                            id: 'unidimensionLcl0',
                                            name:"unidimensionLcl0",                                                                                        
                                            width: 120
                                        })                                        
                                    ]                                    
                                },
                                {                                
                                    columnWidth:0.2,                                    
                                    items:[
                                        new WidgetParams({
                                            id:'embalaje0',
                                            name:'embalaje0',
                                            fieldLabel: "Embalaje",
                                            caso:"CU047",
                                            width:90
                                    })
                                    ]
                                }]
                            }],
                            listeners:{
                                expand: function( p ){                                    
                                    Ext.getCmp("patio").hide();
                                    Ext.getCmp("patio").allowBlank = true;
                                },
                                collapse: function(p){                                      
                                    Ext.getCmp("patio").show();
                                    Ext.getCmp("patio").allowBlank = false;
                                }
                            }
                        }]
                    },// Adicionales
                    {
                        columnWidth:1,                                
                        border:false,                                
                        items:[{
                            xtype:'fieldset',                                
                            border:true,                                
                            autoHeight:true,
                            title: 'Adicionales',
                            layout:'column',                            
                            columns : 4,
                            defaults:{                                    
                                xtype:'fieldset',                                    
                                layout:'form',
                                labelAlign: 'top',
                                border:false    
                            },                                
                            items:[{                                
                                columnWidth:0.2,                                    
                                items:[{
                                    xtype: 'numberfield',
                                    fieldLabel: 'Tarifa Requerida',                                    
                                    name: 'tarifareq',
                                    id: 'tarifareq',
                                    thousandSeparator: '.',
                                    decimalSeparator: ',', 
                                    allowBlank: false,
                                    width: 120
                                }]
                            },{                                
                                columnWidth:0.2,                                    
                                items:[ 
                                    new WidgetMoneda({
                                            id: "ca_idmoneda_vlr",
                                            width: 100,
                                            columnWidth: .25,
                                            value:"USD"

                                            })]
                            },{                                
                                columnWidth:0.3,                                    
                                items:[{
                                    xtype: 'datefield',
                                    fieldLabel: 'Fecha Estimada de Embarque',                                                                         
                                    name: 'fchembarque',
                                    id: 'fchembarque',
                                    allowBlank: false,
                                    format: 'Y-m-d',
                                    width: 180
                                }]
                            },{                                
                                columnWidth:0.3,                                    
                                items:[{
                                    xtype: 'textfield',
                                    fieldLabel: 'Devolución del vacío',                                    
                                    name: 'patio',
                                    id: 'patio',
                                    hidden: true,
                                    width: 200
                                }]
                            }]
                        }]
                    },//    Cliente
                    {
                        columnWidth:1,                                
                        border:false,                                
                        items:[{
                            xtype:'fieldset',                                
                            border:true,                                
                            autoHeight:true,
                            //id:'panel-lcl',
                            layout:'column',
                            title: 'Cliente',
                            columns : 2,
                            defaults:{                                    
                                xtype:'fieldset',                                    
                                layout:'form',
                                labelAlign: 'top',
                                border:false    
                            },                                
                            items:[{                                
                                columnWidth:0.3,                                    
                                items:[{                                    
                                    xtype: 'radiogroup',
                                    itemCls: 'x-check-group-alt',
                                    id: 'rcliente',                                        
                                    columns: 1,
                                    fieldLabel: 'Tipo',
                                    items: [
                                        {boxLabel: 'Nuevo', name: 'cliente', 'inputValue': 'nuevo'},
                                        {boxLabel: 'Antiguo', name: 'cliente', 'inputValue':'antiguo', checked: true}
                                    ],
                                    listeners: {
                                        change: function(radiogroup, radio) {                                            
                                            if(radio.inputValue==='nuevo'){
                                                Ext.getCmp("ccompania1").hide();
                                                Ext.getCmp('compania').allowBlank = true;
                                                Ext.getCmp("ccompania2").show();
                                                Ext.getCmp('compania2').allowBlank = false;
                                            }else{
                                                Ext.getCmp("ccompania1").show();
                                                Ext.getCmp('compania').allowBlank = false;
                                                Ext.getCmp("ccompania2").hide();
                                                Ext.getCmp('compania2').allowBlank = true;
                                            }
                                        },                                    
                                        afterrender: function(t) {                                        
                                            if(t.getValue().inputValue=="antiguo"){
                                                Ext.getCmp("ccompania1").show();
                                                Ext.getCmp('compania').allowBlank = false;
                                                Ext.getCmp("ccompania2").hide();
                                                Ext.getCmp('compania2').allowBlank = true;
                                            }
                                        }
                                    }
                                }]
                            },
                            {                                
                                columnWidth:0.7,                                
                                id: 'ccompania1',
                                items:[
                                    new WidgetCliente({
                                              fieldLabel: "Cliente",
                                              name: "compania",
                                              id: "compania",
                                              hiddenName: "idcliente",
                                              allowBlank: true,
                                              emptyText: '',
                                              width: 400,
                                              listeners: {
                                                  afterrender: function(t){
                                                      t.clearValue();
                                                      console.log(t.getValue());
                                                  }
                                              }
                                    })
                                ]
                            },
                            {                                
                                columnWidth:0.7,
                                hidden: true,
                                id: 'ccompania2',
                                items:[{
                                        xtype: 'textfield',
                                        fieldLabel: 'Razón Social Cliente Nuevo',
                                        emptyText: '',                                        
                                        name: 'compania2',
                                        id: 'compania2',
                                        allowBlank: true,
                                        width: 400
                                }]
                            }]
                        }]
                    },//    Observaciones
                    {
                        columnWidth:1,                                
                        border:false,                                
                        items:[{
                            xtype:'fieldset',                                
                            border:true,                                
                            autoHeight:true,                            
                            layout:'column',                            
                            columns : 1,
                            defaults:{                                    
                                xtype:'fieldset',                                    
                                layout:'form',
                                labelAlign: 'top',
                                border:false    
                            },                                
                            items:[{                                
                                columnWidth:1,                                    
                                items:[{
                                    xtype: 'textarea',
                                    fieldLabel: 'Observaciones',                                    
                                    name: 'observaciones',
                                    id: 'observaciones',
                                    allowBlank: true,
                                    width: 700
                                }]
                            }]
                        }]
                    },//
                    {
                        columnWidth:1,                                
                        border:false,                                
                        items:[{
                            xtype:'fieldset',                                
                            border:true,                                
                            autoHeight:true,                            
                            layout:'column',                            
                            columns : 1,
                            defaults:{                                    
                                xtype:'fieldset',                                    
                                layout:'form',
                                labelAlign: 'top',
                                border:false    
                            },                                
                            items:[{                                
                                columnWidth:0.3,                                    
                                items:[{
                                    xtype: 'fileuploadfield',
                                    id: 'archivo_tarifas',
                                    //width: 250,                                    
                                    fieldLabel: 'Adjuntar',
                                    emptyText: 'Seleccione un archivo',
                                    buttonCfg: {
                                        text: '',
                                        iconCls: 'upload-icon'
                                    },
                                    listeners:{
                                        onRender: function(ct, position){
                                            Ext.getCmp(archivo_tarifas).width = 250
                                        }
                                    }
                                }]
                            }]
                        }]
                    }]
                }
            ],
            listeners:{
                afterrender:this.onAfterload
            }
        });
        this.addEvents({add:true});
    }
    
    Ext.extend(EditarTicketPropiedadesPanel, Ext.FormPanel, {
    
        validarVigencia:function(){
            //alert( this.nivel );
            if( this.nivel===0 || !this.nivel  ){
                this.bloquearCampos();
            }
        },

        bloquearCampos: function(){
            Ext.getCmp('priority_id').setDisabled(true);
            Ext.getCmp('type_id').setDisabled(true);
            Ext.getCmp('assignedto_id').setDisabled(true);
            Ext.getCmp('type_id').setDisabled(true);
            Ext.getCmp('actionTicket_id').setDisabled(true);
            Ext.getCmp('proyecto_id').setDisabled(true);
            Ext.getCmp('milestone_id').setDisabled(true);
            Ext.getCmp('reportedby_id').setDisabled(true);
            Ext.getCmp('reportedthrough_id').setDisabled(true);
            Ext.getCmp('reportedthrough_id').setValue("Web");
            Ext.getCmp('reportedby_id').setValue("");
            Ext.getCmp('activo_id').setValue("");
            Ext.getCmp('activo_id').setDisabled(true);
            Ext.getCmp('empresa_id').setValue("");
            Ext.getCmp('empresa_id').setDisabled(true);
        },

        desbloquearCampos: function(){
            Ext.getCmp('priority_id').setDisabled(false);
            Ext.getCmp('type_id').setDisabled(false);
            Ext.getCmp('assignedto_id').setDisabled(false);
            Ext.getCmp('type_id').setDisabled(false);
            Ext.getCmp('actionTicket_id').setDisabled(false);
            Ext.getCmp('proyecto_id').setDisabled(false);
            Ext.getCmp('milestone_id').setDisabled(false);
            Ext.getCmp('reportedby_id').setDisabled(false);
            Ext.getCmp('reportedthrough_id').setDisabled(false);            
            Ext.getCmp('activo_id').setDisabled(false);
            Ext.getCmp('empresa_id').setDisabled(false);
        },

        renombrarCampos: function(){
            this.changeLabel( 'area_id', 'Procesos:');
            this.changeLabel( 'proyecto_id', 'Tema:');
            this.changeLabel( 'type_id', 'Hallazgo:');
            this.changeLabel( 'reportedby_id', 'Reportado a:');
        },
        
        desnombrarCampos: function(){
            this.changeLabel( 'area_id', 'Área:');
            this.changeLabel( 'proyecto_id', 'Proyecto:');
            this.changeLabel( 'type_id', 'Tipo:');
            this.changeLabel( 'reportedby_id', 'Reportado por:');
        },

        desbloquearAsignado: function(){
            Ext.getCmp('assignedto_id').setDisabled(false);
        },

        mostrarEmpresa: function(){
            Ext.getCmp('empresa_id').setDisabled(false);
            Ext.getCmp('empresa_id').setVisible(true);
        },

        ocultarEmpresa: function(){
            Ext.getCmp('empresa_id').setDisabled(true);
            Ext.getCmp('empresa_id').setVisible(false);
        },

        changeLabel: function(fieldId, newLabel){
            var label = Ext.DomQuery.select(String.format('label[for="{0}"]', fieldId));
            if (label){
                label[0].childNodes[0].nodeValue = newLabel;
            }
        },
            
        onRender: function(){
            // call parent
            EditarTicketPropiedadesPanel.superclass.onRender.apply(this, arguments);

            // set wait message target
            this.getForm().waitMsgTarget = this.getEl();
            this.validarVigencia();
            var actionTicket =  this.actionTicket;
            var panel = this;            
            if(typeof(this.idticket)!=="undefined" && this.idticket!=="" )
            {
                this.load({
                    url:'<?=url_for("pm/datosTicket")?>',
                    waitMsg:'Cargando...',
                    params:{idticket:this.idticket},

                    success:function(response,options){
                        this.res = Ext.util.JSON.decode( options.response.responseText );
                        Ext.getCmp("departamento_id").setRawValue(this.res.data.departamento);
                        Ext.getCmp("departamento_id").hiddenField.value = this.res.data.iddepartament;
                        panel.cargarDepartamentos();

                        area = Ext.getCmp("area_id");
                        area.setValue(this.res.data.group);
                        area.hiddenField.value = this.res.data.idgroup;
                        panel.cargarAreas();
                        
                        proyecto = Ext.getCmp('proyecto_id');
                        proyecto.setValue(this.res.data.project);
                        proyecto.hiddenField.value = this.res.data.idproject;
                        panel.cargarProyectos();

                        Ext.getCmp('assignedto_id').setValue( this.res.data.assignedto );
                        Ext.getCmp('reportedby_id').setValue( this.res.data.loginName );
                        Ext.getCmp('reportedby_id').hiddenField.value = this.res.data.login;
                        if( actionTicket ){
                            Ext.getCmp('actionTicket_id').setValue( actionTicket );
                        }else{
                            Ext.getCmp('actionTicket_id').setValue( this.res.data.action );
                        }
                        
                        Ext.getCmp('type_id').setValue( this.res.data.type );
                                                
                        Ext.getCmp("milestone_id").setRawValue(this.res.data.status_name);
                        Ext.getCmp("milestone_id").hiddenField.value = this.res.data.status;
                        
                        Ext.getCmp("activo_id").setRawValue(this.res.data.activo);
                        Ext.getCmp("activo_id").hiddenField.value = this.res.data.idactivo;
                        
                        //Campos solamente requeridos cuando se crea un ticket de Tarifas Transporte Terrestre Internacional
                        Ext.getCmp("origen0").setDisabled(true);
                        Ext.getCmp("destino0").setDisabled(true);
                        Ext.getCmp("tarifareq").setDisabled(true);
                        Ext.getCmp("fchembarque").setDisabled(true);
                        Ext.getCmp("compania").setDisabled(true);                        
                        Ext.getCmp("patio").setDisabled(true);
                        
                    }
                });
            }            
        },

        guardar: function(){
            var gridId = this.gridId;
            var panel = Ext.getCmp("form-ticket-panel");
            var form = panel.getForm();

            var idticket = this.idticket;
            
            if( form.isValid() ){
                if( (!Ext.getCmp('proyecto_id').getValue() || !Ext.getCmp('type_id').getValue()) && Ext.getCmp('actionTicket_id').getValue()=="Cerrado" ){
                    Ext.MessageBox.alert('Error Message', "Es necesario clasificar el ticket antes de cerrarlo");
                }else if(Ext.getCmp("area_id").getValue()==25 && Ext.getCmp("fcl").collapsed==true && Ext.getCmp("lcl").collapsed==true){
                    Ext.MessageBox.alert('Error Message', "Debe escoger al menos una modalidad!");
                }else{
                    form.submit({
                        success:function(form,action){
                            //Ext.Msg.alert( "Información" );
                            Ext.getCmp("editar-ticket-win").close();                            
                            if( !idticket ){
                                Ext.MessageBox.alert('Mensaje', 'El ticket se ha enviado al área correspondiente, el numero de ticket es: '+action.result.idticket);
                                location.href="<?=url_for('helpdesk/verTicket')?>"+"/id/"+action.result.idticket;
                            } else {
                                if(action.result.change){
                                    Ext.MessageBox.alert('Mensaje', action.result.txt);                                    
                                }
                                if(Ext.getCmp(gridId))
                                    Ext.getCmp(gridId).store.reload();
                            }
                        },
                        // standardSubmit: false,
                        failure:function(form,action){
                            console.log(action);
                            Ext.MessageBox.alert('Error Message', "Se ha presentado un error"+(action.result?": "+action.result.errorInfo:"")+" "+(action.response?"\n Codigo HTTP "+action.response.status:""));
                        }//end failure block
                    });
                }
            }else{
                var result = [], 
                it = form.items.items, 
                l = it.length, i, f;
                for (i = 0; i < l; i++) {
                    if(!(f = it[i]).disabled && f.el.hasClass(f.invalidClass)){
                        result.push(f);
                    }
                }
                //return result;
                console.log(form);
                console.log(result);
                
                Ext.MessageBox.alert('Sistema de Tickets:', '¡Por favor complete los campos subrayados!');
            }

        },

        cargarDepartamentos: function(  ){            
            var iddepartamento =  Ext.getCmp('departamento_id').hiddenField.value;
            area = Ext.getCmp('area_id');
            area.store.setBaseParam( "departamento",iddepartamento );
            area.store.load();
            area.setValue("");

            type = Ext.getCmp('type_id');
            type.store.setBaseParam( "departamento",iddepartamento );
            type.store.load();
            type.setValue("");

            proyecto = Ext.getCmp('proyecto_id');
            proyecto.setValue("");

            assignedto = Ext.getCmp('assignedto_id');
            assignedto.setValue("");
           
            if(iddepartamento==4){      // Si Departamento es Auditoría, renombra los campos
                this.renombrarCampos();
                this.mostrarEmpresa();
                this.desbloquearAsignado();
            }else{
                this.desnombrarCampos();
                this.ocultarEmpresa();
            }

            if( this.nivel==2 || this.nivel==3 ){
                if( iddepartamento!=<?=$iddepartamento?> ){
                    this.bloquearCampos();
                }else{
                    this.desbloquearCampos();
                }
            }

            if( this.nivel<2 ){
                this.bloquearCampos();
            }
        },

        cargarAreas: function(   ){
            var idgrupo = Ext.getCmp('area_id').hiddenField.value;
            proyecto = Ext.getCmp('proyecto_id');
            proyecto.store.baseParams = {
                idgrupo: idgrupo
            };
            proyecto.store.load();

            assignedto = Ext.getCmp('assignedto_id');
            assignedto.store.baseParams = {
                idgrupo: idgrupo
            };
            assignedto.store.load();
            
            milestone = Ext.getCmp('milestone_id');
            milestone.store.baseParams = {
                idgrupo: idgrupo
            };
            milestone.store.load();

            proyecto = Ext.getCmp('proyecto_id');
            proyecto.setValue("");

            assignedto = Ext.getCmp('assignedto_id');
            assignedto.setValue("");
            
            if( this.nivel==1 ){               

                var grupos = <?=json_encode($grupos)?>;
                var encontro = false;
                for(i in grupos ){                               
                    if( grupos[i] == idgrupo ){
                        encontro = true;                        
                    }
                }
                if( !encontro ){
                    this.bloquearCampos();
                }else{
                    this.desbloquearCampos();
                }

            }           
        },

        cargarProyectos: function( ){
            var idproyecto = Ext.getCmp('proyecto_id').hiddenField.value;
            milestone = Ext.getCmp('milestone_id');
            milestone.store.baseParams = {
                idproject: idproyecto
            };
            milestone.store.load();

        },
            
        agregarImo: function(i){
            i++;
            var tb = new Ext.form.FieldSet ({
                    border:false,                                
                    autoHeight:true,
                    id:'panel-imo'+i,
                    layout:'column',
                    columns : 1,
                    defaults:{                                    
                        xtype:'fieldset',                                    
                        layout:'form',
                        border:false    
                    },                                
                    items:[{                                                                   
                        columnWidth:0.7,                                    
                        items:[{
                            xtype:"hidden",
                            id:"idimo",
                            name:"idimo",
                            value: i
                        },
                        new WidgetParams({
                                id:'claseimo'+i,
                                name:'claseimo'+i,
                                hiddenName:'nclaseimo'+i,
                                fieldLabel: "Clase IMO",
                                caso:"CU270",
                                width:360,
                                idvalor:"name2",
                                listeners:{
                                    select:function(field, record, index){                                                        
                                        var imo = record.data.name;
                                        var y = Ext.getCmp("idimo").getValue();

                                        if(imo){
                                            Ext.getCmp("idunnumber"+y).allowBlank = false;
                                        }
                                    },
                                    change: function(t, newValue, oldValue){
                                        var y = Ext.getCmp("idimo").getValue();

                                        if(newValue==""){
                                            Ext.getCmp("idunnumber"+y).allowBlank = true;                                                    
                                        }
                                    }
                                }
                        })]
                    },{                                
                        columnWidth:0.3,                                    
                        items:[{
                            xtype: 'textfield',
                            fieldLabel: 'UN Number',
                            name: 'unnumber'+i,
                            id: 'idunnumber'+i,
                            width: 50
                        }]
                    }]
                });
                
            
            var panelCarga = Ext.getCmp("panel-carga");
            var panel = Ext.getCmp("form-ticket-panel");            
            var panelImo = Ext.getCmp("panel-imo"+i);
            
            panelImo.addButton('Eliminar', function(){
                alert('Se eliminará el item seleccionado');                        
                panel.i--;
                panelImo.removeAll();
                panelCarga.remove("panel-imo"+i, true);
                panelCarga.doLayout();
            });
            
            panelCarga.add(tb);            
            panelCarga.doLayout();
            panel.i++;
        },
            
        agregarContenedor: function(j){
            j++;
            storeEquipos = new Ext.data.Store({
                autoLoad : true,
                url: '<?= url_for("conceptos/datosConceptos") ?>',
                baseParams:{
                    transporte:"<?= Constantes::MARITIMO ?>",
                    modalidad:"<?= Constantes::FCL ?>",
                    impoexpo:"<?= Constantes::IMPO ?>"
                },
                reader: new Ext.data.JsonReader({
                    root: 'root',
                    totalProperty: 'total',
                    successProperty: 'success'
                },
                Ext.data.Record.create([
                    {name: 'idconcepto'},
                    {name: 'concepto'}
                ])
                )
            });
        
            var tb = new Ext.form.FieldSet ({                                
                border:true,                                
                autoHeight:true,
                id:'panel-contenedor'+j,
                layout:'column',                                
                columns : 6,                
                defaults:{                                    
                    xtype:'fieldset',                                    
                    layout:'form',
                    labelAlign: 'top',
                    border:false    
                },                                
                items:[{                                                                   
                    columnWidth:0.3,                                    
                    items:[{
                        xtype:"hidden",
                        id:"idcont",
                        name:"idcont",
                        value: j
                    },
                    new Ext.form.ComboBox({
                        fieldLabel: 'Contenedor',
                        typeAhead: true,
                        forceSelection: true,
                        triggerAction: 'all',
                        selectOnFocus: true,
                        name: 'idequipo'+j,
                        id: 'idequipo'+j,
                        hiddenName: 'nequipo'+j,
                        mode: 'local',
                        displayField: 'concepto',
                        valueField: 'idconcepto',
                        lazyRender:true,
                        listClass: 'x-combo-list-small',
                        store : storeEquipos,
                        tpl: new Ext.XTemplate(
                            '<tpl for="."><div class="search-item"><b>{concepto}</b><br /><span>{aka}</span> </div></tpl>'
                        ),
                        itemSelector: 'div.search-item',
                        width: 180,
                        listeners:{
                            select:function(field, record, index){                                                        
                                var idconcepto = record.data.idconcepto;
                                var reefer = [13,20,17,54,55];
                                var flat = [11,12,14,16,18,132,253,254,314,315];
                                
                                var y = Ext.getCmp("idcont").getValue();
                                
                                Ext.getCmp("cant"+y).allowBlank = false;
                                Ext.getCmp("peso"+y).allowBlank = false;
                                Ext.getCmp("idfrec"+y).allowBlank = false;
                                
                                // Contenedor Reefer
                                if($.inArray( idconcepto, reefer )>=0){ 
                                    //alert(j);
                                    Ext.getCmp("temperatura"+y).show();
                                    Ext.getCmp('temperatura'+y).allowBlank = false;
                                    Ext.getCmp("dimensiones"+y).hide();
                                    Ext.getCmp('dimensiones'+y).allowBlank = true;
                                    Ext.getCmp("unidimension"+y).hide();
                                    Ext.getCmp('unidimension'+y).allowBlank = true;
                                    Ext.getCmp("rgauge"+y).hide();                        
                                }else if($.inArray( idconcepto, flat )>=0){                                                            
                                    Ext.getCmp("temperatura"+y).hide();
                                    Ext.getCmp('temperatura'+y).allowBlank = true;
                                    Ext.getCmp("dimensiones"+y).hide();
                                    Ext.getCmp('dimensiones'+y).allowBlank = true;
                                    Ext.getCmp("unidimension"+y).hide();
                                    Ext.getCmp('unidimension'+y).allowBlank = true;
                                    Ext.getCmp("rgauge"+y).show();
                                }else{                                    
                                    Ext.getCmp("temperatura"+y).hide();
                                    Ext.getCmp('temperatura'+y).allowBlank = true;
                                    Ext.getCmp("dimensiones"+y).hide();
                                    Ext.getCmp('dimensiones'+y).allowBlank = true;
                                    Ext.getCmp("unidimension"+y).hide();
                                    Ext.getCmp('unidimension'+y).allowBlank = true;
                                    Ext.getCmp("rgauge"+y).hide();
                                } 
                            },
                            change: function(t, newValue, oldValue){
                                
                                var y = Ext.getCmp("idcont").getValue();
                                
                                if(newValue == ""){
                                    //Ext.getCmp("cant"+y).hide();
                                    Ext.getCmp('cant'+y).allowBlank = true;
                                    //Ext.getCmp("peso"+y).hide();
                                    Ext.getCmp('peso'+y).allowBlank = true;
                                    //Ext.getCmp("idfrec"+y).hide();                
                                    Ext.getCmp('idfrec'+y).allowBlank = true;
                                    Ext.getCmp("temperatura"+y).hide();
                                    Ext.getCmp('temperatura'+y).allowBlank = true;
                                    Ext.getCmp("dimensiones"+y).hide();
                                    Ext.getCmp('dimensiones'+y).allowBlank = true;
                                    Ext.getCmp("unidimension"+y).hide();
                                    Ext.getCmp('unidimension'+y).allowBlank = true;
                                    Ext.getCmp("rgauge"+y).hide();
                                }
                            }
                        }   
                    })]
                },{                                
                    columnWidth:0.1,                                    
                    items:[{ 
                        xtype: 'numberfield',
                        fieldLabel: 'Cant.',
                        name: 'cant'+j,
                        id: 'cant'+j,
                        minvalue: 0,
                        thousandSeparator: '.',
                        decimalSeparator: ',',                        
                        width: 30
                    }]
                },{                                
                    columnWidth:0.1,                                    
                    items:[{
                        xtype: 'numberfield',
                        fieldLabel: 'Peso (Kg)',
                        minvalue: 0,
                        name: 'peso'+j,
                        id: 'peso'+j,
                        thousandSeparator: '.',
                        decimalSeparator: ',',                        
                        width: 40
                    }]
                },{                                
                    columnWidth:0.15,                                    
                    items:[{
                        xtype: 'textfield',
                        fieldLabel: 'Frecuencia',
                        name: 'frec'+j,
                        id: 'idfrec'+j,
                        width: 80
                    }]
                },{                                
                    columnWidth:0.15,                                    
                    items:[{ 
                        xtype: 'numberfield',
                        fieldLabel: 'Temp.(°C)',
                        name: 'temperatura'+j,
                        id: 'temperatura'+j,
                        minvalue: 0,                        
                        width: 30
                    }]
                },{                                
                    columnWidth:0.15,                                    
                    items:[{                        
                        xtype: 'radiogroup',
                        itemCls: 'x-check-group-alt',
                        id: 'rgauge'+j,
                        hidden: true,
                        columns: 1,
                        fieldLabel: 'Capacidad',
                        items: [
                            {boxLabel: 'In Gauge', name: 'gauge'+j, 'inputValue': 'in', checked: true},
                            {boxLabel: 'Out Gauge', name: 'gauge'+j, 'inputValue':'out'}
                        ],
                        listeners: {
                            change: function(radiogroup, radio) {                                                                                            
                                if(radio.inputValue==='out'){
                                    Ext.getCmp("temperatura"+j).hide();
                                    Ext.getCmp('temperatura'+j).allowBlank = true;
                                    Ext.getCmp("dimensiones"+j).show();
                                    Ext.getCmp('dimensiones'+j).allowBlank = false;
                                    Ext.getCmp("unidimension"+j).show();
                                    Ext.getCmp('unidimension'+j).allowBlank = false;
                                }else{
                                    Ext.getCmp("temperatura"+j).hide();
                                    Ext.getCmp('temperatura'+j).allowBlank = true;
                                    Ext.getCmp("dimensiones"+j).hide();
                                    Ext.getCmp('dimensiones'+j).allowBlank = true;
                                    Ext.getCmp("unidimension"+j).hide();
                                    Ext.getCmp('unidimension'+j).allowBlank = true;
                                }
                            },
                            show: function(t) {  
                                if(t.getValue().inputValue=="out"){
                                    Ext.getCmp("dimensiones"+j).show();
                                    Ext.getCmp('dimensiones'+j).allowBlank = false;
                                    Ext.getCmp("unidimension"+j).show();
                                    Ext.getCmp('unidimension'+j).allowBlank = false;
                                }

                            }
                        }
                    }]
                },{                                
                    columnWidth:0.2,                                    
                    items:[{
                        xtype: 'textfield',
                        fieldLabel: 'Dimensiones (LargoxAnchoxAlto)',
                        emptyText: '',                        
                        name: 'dimensiones'+j,
                        id: 'dimensiones'+j,
                        width: 130
                    }]
                },{                                
                    columnWidth:0.2,                                    
                    items:[
                        new WidgetUnidades({
                            fieldLabel: 'Unidad',
                            hidden: true,
                            name: 'unidimension'+j,
                            id: 'unidimension'+j,
                            width: 130
                        })                                        
                    ]                                    
                }]
            });            
            
            Ext.getCmp("temperatura"+j).hide();
            Ext.getCmp("dimensiones"+j).hide();
            Ext.getCmp("unidimension"+j).hide();
            Ext.getCmp("rgauge"+j).hide();            
            
            var panel = Ext.getCmp("form-ticket-panel");
            var panelFcl = Ext.getCmp("fcl");
            var panelContenedor = Ext.getCmp("panel-contenedor"+j);
            
            panelContenedor.addButton('Eliminar', function(){
                alert('Se eliminará el contenedor seleccionado');                        
                panel.j--;
                panelContenedor.removeAll();
                panelFcl.remove("panel-contenedor"+j, true);
                panelFcl.doLayout();
            });
            panelFcl.add(tb);
            panelFcl.doLayout();
            panel.j++;
        },
        
        agregarTrayecto: function(k){
            k++;
            console.log(k);
            var tb = new Ext.form.FieldSet ({
                //xtype:'fieldset',                                
                border:true,                                
                autoHeight:true,
                id:'panel-trayecto'+k,
                layout:'column',                                
                columns : 2,
                defaults:{                                    
                    xtype:'fieldset',                                    
                    layout:'form',
                    labelAlign: 'top',
                    border:false    
                },                                
                items:[{
                    columnWidth:.5,                                
                    border:false,                                
                    items:[
                    new WidgetCiudad({fieldLabel: 'Origen',                                                      
                        id: 'origen'+k,
                        idciudad:"origen"+k,
                        hiddenName:"idorigen"+k,                            
                        impoexpo:'<?=  Constantes::IMPO?>',
                        allowBlank: false,
                        width: 250
                    }),
                    {
                        xtype: 'radiogroup',
                        itemCls: 'x-check-group-alt',
                        id: 'rtransori'+k,
                        columns: 1,
                        items: [
                            {boxLabel: 'Puerto (CY-Container Yard)', name: 'transori'+k, 'inputValue':'cy',checked: true}                            
                        ]
                    },
                    {
                        xtype: 'checkbox',                                        
                        id: 'exw'+k,
                        name: 'exw'+k,
                        boxLabel: 'Gastos EXW',
                        listeners:{
                            check: function(t, checked){
                                if(checked){
                                    Ext.getCmp("recogida"+k).show();
                                    Ext.getCmp("recogida"+k).allowBlank = false;
                                }else{
                                    Ext.getCmp("recogida"+k).hide();
                                    Ext.getCmp("recogida"+k).allowBlank = true;
                                }
                            }
                        }
                    },
                    {
                        xtype: 'textfield',
                        fieldLabel: 'Dirección de recogida',                        
                        hidden: true,
                        name: 'recogida'+k,
                        id: 'recogida'+k,  
                        allowBlank: true,
                        width: 200
                    }]
                },{
                    columnWidth:.5,                                
                    border:false,                                
                    items:[
                        new WidgetCiudad({fieldLabel: 'Destino',
                            id: 'destino'+k,
                            idciudad:"destino"+k,
                            hiddenName:"iddestino"+k,                                
                            impoexpo:'<?=  Constantes::IMPO?>',
                            width: 250
                        }),
                        {
                            xtype: 'radiogroup',
                            itemCls: 'x-check-group-alt',
                            id: 'rtransdest'+k,
                            columns: 1,
                            items: [
                                {boxLabel: 'Puerto (CY-Container Yard)', name: 'transdest'+k, 'inputValue':'cy', checked: true},
                                {boxLabel: 'Puerta (SD-Store Door)', name: 'transdest'+k, 'inputValue':'sd'}
                            ]
                        }]
                }]
            });
            
            var panelTrayecto = Ext.getCmp("trayecto");
            var panel = Ext.getCmp("form-ticket-panel");
            
            var panelTrayectoAdic = Ext.getCmp("panel-trayecto"+k);
            
            panelTrayectoAdic.addButton('Eliminar', function(){
                alert('Se eliminará el Trayecto seleccionado');                        
                panel.k--;
                panelTrayectoAdic.removeAll();
                panelTrayecto.remove("panel-trayecto"+k, true);
                panelTrayecto.doLayout();
            });
            
            panelTrayecto.add(tb);
            panelTrayecto.doLayout();
            panel.k++;
        },
        
        agregarPiezas: function(l){
            l++;
            console.log(l);
            var tb = new Ext.form.FieldSet ({                    
                        border:true,                                
                        autoHeight:true,
                        id:'panel-lcl'+l,
                        layout:'column',                        
                        columns : 4,
                        defaults:{                                    
                            xtype:'fieldset',                                    
                            layout:'form',
                            labelAlign: 'top',
                            border:false    
                        },
                        items:[{                                
                            columnWidth:0.1,                                    
                            items:[{
                                xtype: 'numberfield',
                                fieldLabel: 'Piezas',
                                minvalue: 0,
                                name: 'piezasLcl'+l,
                                id: 'piezasLcl'+l,
                                thousandSeparator: '.',
                                decimalSeparator: ',', 
                                width: 60
                            }]
                        },{                                
                            columnWidth:0.2,                                    
                            items:[{
                                xtype: 'numberfield',
                                fieldLabel: 'Peso (Kg)',
                                minvalue: 0,
                                name: 'pesoLcl'+l,
                                id: 'pesoLcl'+l,
                                thousandSeparator: '.',
                                decimalSeparator: ',', 
                                width: 70
                            }]
                        },{                                
                            columnWidth:0.3,                                    
                            items:[{
                                xtype: 'textfield',
                                fieldLabel: 'Dimensiones (LargoxAnchoxAlto)',
                                emptyText: '',                                        
                                name: 'dimensionesLcl'+l,
                                id: 'dimensionesLcl'+l,                                        
                                width: 180
                            }]
                        },
                        {                                
                            columnWidth:0.2,                                    
                            items:[
                                new WidgetUnidades({
                                    fieldLabel: 'Unidad',                                            
                                    name: 'unidimensionLcl'+l,
                                    id: 'unidimensionLcl'+l,                                                                                       
                                    width: 120
                                })                                        
                            ]                                    
                        },
                        {                                
                            columnWidth:0.2,                                    
                            items:[
                                new WidgetParams({
                                            id:'embalaje'+l,
                                            name:'embalaje'+l,
                                            //hiddenName:'nembalaje'+l,
                                            fieldLabel: "Embalaje",
                                            caso:"CU047",
                                    width:90/*,
                                            idvalor:"name2"*/
                                    })
                            ]
                        }]
                    });
            
            var panelPiezas = Ext.getCmp("lcl");
            var panel = Ext.getCmp("form-ticket-panel");
            
            var panelPiezasAdic = Ext.getCmp("panel-lcl"+l);
            
            panelPiezasAdic.addButton('Eliminar', function(){
                alert('Se eliminará el Item seleccionado');                        
                panel.l--;
                panelPiezasAdic.removeAll();
                panelPiezas.remove("panel-lcl"+l, true);
                panelPiezas.doLayout();
            });
            
            panelPiezas.add(tb);
            panelPiezas.doLayout();
            panel.l++;
        },
        
        onAfterload:function(){
            Ext.getCmp("tarifas").hide();
        }
    });
</script>