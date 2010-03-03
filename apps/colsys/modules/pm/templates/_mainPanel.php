<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */


$departamentos = $sf_data->getRaw("departamentos");
?>
<script type="text/javascript">


MainPanel = function( config ){

    Ext.apply(this, config);


    this.dataDepartamentos = <?=json_encode(array("departamentos"=>$departamentos))?>;

    this.departamentos = new Ext.form.ComboBox({
        fieldLabel: 'Departamento',
        typeAhead: true,
        forceSelection: true,
        triggerAction: 'all',
        emptyText:'',
        selectOnFocus: true,
        value: '',
        hiddenName: 'departamento',
        id: 'departamento_id',
        lazyRender:true,
        allowBlank: true,
        listClass: 'x-combo-list-small',
        displayField: 'nombre',
        valueField: 'iddepartamento',
        width: 150,

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
                    {name: 'nombre'}
                ])
            )
        }),
        listeners:{select:function( field, record, index ){


                            area = Ext.getCmp('area_id');

                            area.store.baseParams = {
                                departamento: record.data.iddepartamento
                            };
                            area.store.reload();

                      }
        }
    });



    this.areas = new Ext.form.ComboBox({
        fieldLabel: 'Área',
        typeAhead: true,
        forceSelection: true,
        triggerAction: 'all',
        emptyText:'',
        selectOnFocus: true,
        value: '',
        id: 'area_id',
        lazyRender:true,
        allowBlank: true,
        displayField: 'nombre',
        valueField: 'idgrupo',
        hiddenName: 'area',
        listClass: 'x-combo-list-small',
        width: 150,
        mode : 'local',
        store : new Ext.data.Store({
            autoLoad : true ,
            url: '<?=url_for("helpdesk/datosAreas")?>',
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
        listeners:{select:function( field, record, index ){
                            proyecto = Ext.getCmp('proyecto_id');
                            proyecto.store.baseParams = {
                                idgrupo: record.data.idgrupo
                            };
                            proyecto.store.reload();


                            assignedto = Ext.getCmp('assignedto_id');
                            assignedto.store.baseParams = {
                                idgrupo: record.data.idgrupo
                            };
                            assignedto.store.reload();
                      }
        }

    });


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
        mode : 'local',
        width: 150,
        store : new Ext.data.Store({
            autoLoad : true ,
            url: '<?=url_for("helpdesk/datosProyectos")?>',
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




    this.prioridades = new Ext.form.ComboBox({
        fieldLabel: 'Prioridad',
        typeAhead: true,
        forceSelection: true,
        triggerAction: 'all',
        emptyText:'',
        selectOnFocus: true,
        value: '',
        hiddenName: 'priority',
        id: 'priority_id',
        lazyRender:true,
        allowBlank: true,
        listClass: 'x-combo-list-small',
        width: 150,
        store : [
                    ["", ""],
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
        value: '',
        hiddenName: 'type',
        id: 'type_id',
        lazyRender:true,
        allowBlank: true,
        listClass: 'x-combo-list-small',
        width: 150,
        store : [
                    ["", ""],
                    ["Tarea", "Tarea"],
                    ["Mejora", "Mejora"],
                    ["Defecto", "Defecto"],
                    ["Control", "Control"],
                    ["Sugerencia", "Sugerencia"],
                    ["Invalido", "Invalido"]
                ]
    });


    this.acciones = new Ext.form.ComboBox({
        fieldLabel: 'Marca',
        typeAhead: true,
        forceSelection: true,
        triggerAction: 'all',
        emptyText:'',
        selectOnFocus: true,
        value: '',
        hiddenName: 'actionTicket',
        id: 'actionTicket_id',
        lazyRender:true,
        allowBlank: true,
        listClass: 'x-combo-list-small',
        width: 150,
        store : [
                    ["", ""],
                    ["Abierto", "Abierto"],
                    ["Cerrado", "Cerrado"]
                ]
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
        width: 150,
        mode : 'local',
        store : new Ext.data.Store({
            autoLoad : true ,
            url: '<?=url_for("helpdesk/datosAsignaciones")?>',
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

    this.panelTickets = new PanelTickets();
    this.preview = [{
            xtype:'tabpanel',
            buttonAlign: 'left',
            activeTab: 0,
            defaults:{autoHeight:true, bodyStyle:'padding:10px'},
            deferredRender:false,            
            items:[
                {
                    title:'Busquedas Predefinidas',
                    layout:'form',
                    //defaults: {width: 470},

                    items: [{
                        layout:'table',
                        border: false,
                        defaults: {
                            // applied to each contained panel
                            bodyStyle:'padding-right:20px',
                            border: false
                        },
                        layoutConfig: {
                            // The total column count must be specified here
                            columns: 3
                        },
                        items: [{
                            layout: 'form',
                            items: [ {
                                xtype:'textfield',
                                fieldLabel: 'Criterio2',
                                name: 'criterio',
                                value: '',
                                width: 120
                            }  ]
                        }


                        ]
                    }],
                    fbar: [new Ext.Button({text: "Buscar"})]
                },
                {
                title:'Busqueda Por Palabra',
                layout:'form',
                //defaults: {width: 470},

                items: [{
				    layout:'table',
				    border: false,
				    defaults: {
				        // applied to each contained panel
				        bodyStyle:'padding-right:20px',
				        border: false
				    },
				    layoutConfig: {
				        // The total column count must be specified here
				        columns: 3
				    },
				    items: [{
		                layout: 'form',
		                items: [ {
							xtype:'textfield',
							fieldLabel: 'Criterio',
							name: 'criterio',
							value: '',
							width: 120
		                }  ]
                    }


                    ]
                }],
                fbar: [new Ext.Button({text: "Buscar"})]
            },
            {

                title:'Busqueda Personalizada',
                layout:'form',
                //defaults: {width: 470},

                items: [{
				    layout:'table',
				    border: false,
				    defaults: {
				        // applied to each contained panel
				        bodyStyle:'padding-right:20px',
				        border: false
				    },
				    layoutConfig: {
				        // The total column count must be specified here
				        columns: 3
				    },
				    items: [{
		                layout: 'form',
                        width: 280,
		                items: [ this.departamentos, this.areas, this.projectos  ]
                    },
                    {
		                layout: 'form',
                        width: 280,
		                items: [ this.acciones, this.prioridades, this.tipos ]
                    },
                    {
		                layout: 'form',
                        width: 280,
		                items: [ this.asignaciones ]
                    }

                    ]
                }],
                fbar: [new Ext.Button({text: "Buscar"})]
            }]
        },
        this.panelTickets
    ];


    MainPanel.superclass.constructor.call(this, {
        id:'main-tabs',
        labelAlign: 'top',
        title: 'Sistema de Administración de Proyectos',
        bodyStyle:'padding:1px',
		//fileUpload: true,
        items: [
            this.preview
        ]

    });

    

};

Ext.extend(MainPanel, Ext.Panel, {        


});

</script>