<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

include_component("pm", "widgetBusquedaTicket");

?>

<script type="text/javascript">
BusquedaTicketWindow = function( config ) {
    Ext.apply(this, config);
    this.ctxRecord = null;
    
    this.dataDepartamentos = <?=json_encode(array("departamentos" => $sf_data->getRaw("departamentos")))?>;
    
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
        })            
    });
    
    this.areas.on("select", this.cargarAreas, this );

    this.projectos = new Ext.form.ComboBox({
        fieldLabel: 'Proyecto',
        labelAlign: 'top',
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

    this.items = [
        new PanelBusquedaTicket({height:350,
            y:100,
            id: 'ticket-search-grid',
            opener: this.opener,
            autoload: false
            })
    ];
    
    this.searchFld = new widgetBusquedaTicket();
    this.optionsFld = new Ext.form.ComboBox({
        fieldLabel: 'Opcion',
        typeAhead: true,
        width: 140,
        forceSelection: true,
        triggerAction: 'all',
        emptyText:'Seleccione',
        selectOnFocus: true,
        id: 'search-ticket-option',
        lazyRender:true,
        listClass: 'x-combo-list-small',
        value: "idticket",
        store : [
            ["idticket","# ticket"],        
            ["titulo","Titulo del ticket"],
            ["texto","Entre los textos"],
            ["reportedBy","Reportado por"],
            ["documento","Documento"],
            ["index","Indexada"]
	 ]
    });
    
    this.criteriosIniciales = new Ext.Container({
        autoEl: 'div',  // This is the default
        layout: 'column',        
        columnWidth: 1,
        defaults: {
            // implicitly create Container by specifying xtype
            xtype: 'container',
            autoEl: 'div', // This is the default.
            layout: 'form',
        },
    //  The two items below will be Ext.Containers, each encapsulated by a <DIV> element.
        items: [this.searchFld, this.optionsFld]
    });
    
    this.busquedaAvanzada = new Ext.Container({
            autoEl: 'div',  // This is the default
            layout: 'column',            
            columnWidth: 1,            
            defaults: {
                // implicitly create Container by specifying xtype
                xtype: 'container',
                autoEl: 'div', // This is the default.                
                layout: 'form',
                columnWidth: 1                
            },        
            items: [{        
                xtype:'fieldset',
                checkboxToggle: true,
                collapsed: true, // fieldset initially collapsed
                title: 'Búsqueda avanzada',
                bodyStyle:'padding:10px',
                layout: 'column',                
                columns: 3,        
                defaults:{            
                    layout:'form',
                    border:false,                        
                    columnWidth:.33,
                    hideLabels: false,
                    labelAlign: 'top',
                    bodyStyle:'padding:5px;background-color:#EEEEEE'                    
                },
                items:[{                
                        items: this.departamentos                
                    },{                
                        items: this.areas
                    },{
                        items: this.projectos
                    }
                ]              
            }]
        });

    this.criteriosBusqueda = new Ext.Container({        
        layout:'column',
        autoWidth: true,         
        layoutConfig: {            
            columns: 1
        },
        items: [this.criteriosIniciales, this.busquedaAvanzada]
    });
    
    this.tbar = [this.criteriosBusqueda]
    this.buttons = [        
        {
            text: 'Cancelar',
            handler: this.close.createDelegate(this, [])
        }
     ];

    

    BusquedaTicketWindow.superclass.constructor.call(this, {
        title: "Busqueda de Tickets",
        autoHeight: true,
        width: 800,
        //height: 400,
        resizable: false,
        plain:true,
        modal: true,        
        y: 100,
        autoScroll: true,
        closeAction: 'close',
        id: 'ticket-search-win',
        buttons: this.buttons,
        items: this.items,
        tbar: this.tbar
    });

    //this.addEvents({add:true});
}

Ext.extend(BusquedaTicketWindow, Ext.Window, {


    show : function(){
        if(this.rendered){
            //this.feedUrl.setValue('');
        }

        //this.grid.store.setBaseParam( "idproject", this.idproject);
        //this.grid.store.load();

        BusquedaTicketWindow.superclass.show.apply(this, arguments);
    },
    cargarDepartamentos: function(  ){            
        var iddepartamento =  Ext.getCmp('departamento_id').hiddenField.value;
        area = Ext.getCmp('area_id');
        area.store.setBaseParam( "departamento",iddepartamento );
        area.store.load();
        area.setValue("");
    },
    cargarAreas: function(   ){
        var idgrupo = Ext.getCmp('area_id').hiddenField.value;
        proyecto = Ext.getCmp('proyecto_id');
        proyecto.store.baseParams = {
            idgrupo: idgrupo
        };
        proyecto.store.load();
    }

});

</script>