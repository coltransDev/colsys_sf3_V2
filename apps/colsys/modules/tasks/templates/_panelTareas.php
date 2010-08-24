<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>

<script type="text/javascript">


PanelTareas = function( config ){

    Ext.apply(this, config);

    /*
    * Crea el expander
    */
    this.expander = new Ext.grid.RowExpander({
        lazyRender : false,
        width: 15,
        tpl : new Ext.Template(
          '<p><div class=\'btnComentarios\' id=\'obs_{_id}\'>&nbsp; {texto}</div></p>'

        ),
        getRowClass : function(record, rowIndex, p, ds){
            p.cols = p.cols-1;

            var content = this.bodyContent[record.id];

            //if(!content && !this.lazyRender){		//hace que los comentarios no se borren cuando se guarda
                content = this.getBodyContent(record, rowIndex);
            //}

            if(content){
               p.body = content;
            }

            var color;
            if( record.data.action=="Cerrado" ){                
                color = "blue";
            }else{                
                switch( record.data.prioridad ){
                    case "Media":
                        color = "yellow";
                        break;
                    case "Alta":
                        color = "pink";
                        break;
                    default:
                        color = "";
                        break;
                }
            }
            color = "row_"+color;
            return this.state[record.id] ? 'x-grid3-row-expanded '+color : 'x-grid3-row-collapsed '+color;
        }
    });


    this.filters = new Ext.ux.grid.GridFilters({
        // encode and local configuration options defined previously for easier reuse
        encode: false, // json encode the filter query
        local: true,   // defaults to false (remote filtering)
        filters: [ {
            type: 'string',
            dataIndex: 'titulo'

        },
        {
            type: 'string',
            dataIndex: 'lista'

        },
         {
            type: 'string',
            dataIndex: 'usucreado'

        }
        , {
            type: 'list',
            dataIndex: 'priority',
            options: ['Alta', 'Media', 'Baja']

        }, {
            type: 'list',
            dataIndex: 'action',
            options: ['Abierto', 'Cerrado']

        },
        {
            type: 'date',
            dataIndex: 'fchvencimiento'
        }
        
        ]
    });


    this.summary = new Ext.ux.grid.GroupSummary();

    this.checkColumn = new Ext.grid.CheckColumn({header:' ', dataIndex:'sel', width:30, hideable: false});

    this.columns = [
      this.expander,
      this.checkColumn,      
      {
        header: "Titulo",
        dataIndex: 'titulo',
        //hideable: false,
        sortable: true,
        width: 280,
        summaryType: 'count',
        summaryRenderer: function(v, params, data){
            return ((v === 0 || v > 1) ? '(' + v +' Tickets)' : '(1 Ticket)');
        }

        
      },
      {
        header: "Usuario",
        dataIndex: 'usucreado',
        hideable: false,
        sortable: true,
        width: 80

      },
      {
        header: "Lista",
        dataIndex: 'lista',
        //hideable: false,
        sortable: true,
        width: 280

      },
      {
        header: "Prioridad",
        dataIndex: 'prioridad',
        hideable: false,
        sortable: true,
        width: 80
        
      },
     
      {
        header: "Asignado a",
        dataIndex: 'assignedto',
        hideable: false,
        sortable: true,
        width: 80
      },
       {
        header: "Estado",
        dataIndex: 'action',
        hideable: false,
        sortable: true,
        width: 80
      },         
      {
        header: "Vencimiento",
        dataIndex: 'fchvencimiento',
        hideable: false,
        width: 100,
        sortable: true,
        renderer: Ext.util.Format.dateRenderer('d/m/y')
      },     
      {
        header: "%",
        dataIndex: 'percentage',
        hideable: true,
        width: 100,
        sortable: true,
        renderer: function(v){
            return (v?v:0)+"%";
        }
      }

      
     ];


    this.record = Ext.data.Record.create([
            {name: 'sel', type: 'bool'},
            {name: 'idtarea', type: 'integer', mapping: 't_ca_idtarea'},
            {name: 'titulo', type: 'string', mapping: 't_ca_titulo'},
            {name: 'texto', type: 'string', mapping: 't_ca_texto'},
            {name: 'usucreado', type: 'string', mapping: 't_ca_usucreado'},
            {name: 'lista', type: 'string', mapping: 'l_ca_nombre'},
            {name: 'idlista', type: 'string', mapping: 't_ca_idlistatarea'},
            {name: 'prioridad', type: 'string', mapping: 't_ca_prioridad'},
            {name: 'fchvencimiento', type: 'date', dateFormat:'Y-m-d H:i:s', mapping: 't_ca_fchvencimiento'},
            {name: 'percentage', type: 'integer', mapping: 'h_ca_percentage'}            
    ]);

    this.store = new Ext.data.GroupingStore({

        autoLoad : true,
        url: '<?=url_for("tasks/datosPanelTareas")?>',
        baseParams : {
            idproject: this.idproject,
            idgroup: this.idgroup,
            actionTicket: this.actionTicket,
            assignedTo: this.assignedTo,
            reportedBy: this.reportedBy
        },
        reader: new Ext.data.JsonReader(
            {
                root: 'root',
                totalProperty: 'total'
            },
            this.record
        ),
        sortInfo:{field: 'titulo', direction: "ASC"},
        //groupOnSort: true,
        //groupField: 'titulo'
        

    });


    this.tbar = [
                {
                    text: 'Nueva tarea',
                    tooltip: '',
                    iconCls: 'add',  // reference to our css
                    scope: this,
                    handler: this.crearTarea
                },
                {
                    text: 'Recargar',
                    tooltip: 'Actualiza losdatos del panel',
                    iconCls: 'refresh',  // reference to our css
                    scope: this,
                    handler: this.recargar
                }
         ];

    
    PanelTareas.superclass.constructor.call(this, {
       loadMask: {msg:'Cargando...'},       
       boxMinHeight: 300,       
       plugins: [
                    this.expander,
                    this.filters,
                    this.checkColumn,
                    this.summary
                ],
       view: new Ext.grid.GroupingView({

            forceFit:true,
            enableRowBody:true,
            hideGroupedColumn: true
            //showPreview:true,
            //hideGroupedColumn: true,
            
       }),
       listeners:{            
            rowcontextmenu: this.onRowcontextMenu,
            rowdblclick : this.onRowDblclick
       },
       tbar: this.tbar
    });

};

Ext.extend(PanelTareas, Ext.grid.GridPanel, {

    crearTarea: function(){
        window.open("<?=url_for("t/crearTicket")?>");
    },
    recargar: function(){

        if(this.store.getModifiedRecords().length>0){
            if(!confirm("Se perderan los cambios no guardados en los recargos locales unicamente, desea continuar?")){
                return 0;
            }
        }
        this.store.reload();
    },
   

    asignarMilestone: function(){

        if( !this.win ){
            this.win = new AsignarMilestoneWindow({idproject: this.idproject});
        }
        this.win.show();
        this.win.grid.addListener("celldblclick", this.onMilestoneGridCelldblclick, this );
    },


    onMilestoneGridCelldblclick : function( grid, rowIndex, columnIndex, e ){
        var record = grid.getStore().getAt(rowIndex);  // Get the Record
        var fieldName = grid.getColumnModel().getDataIndex(columnIndex); // Get field name
        var idmilestone = record.get(fieldName);

        var records = this.store.getModifiedRecords();
        var len = records.length;

        //alert(len+" "+rowIndex+"  "+columnIndex)
        var store = this.store;
        for( var i=0; i<len; i++ ){
            r = records[i];

            if(r.data.sel){
                Ext.Ajax.request({
                        url: '<?=url_for("pm/asignarMilestone")?>',
                        method: 'POST',
                        //Solamente se envian los cambios
                        params :	{
                            id:r.id,
                            idticket:r.data.idticket,
                            idmilestone: idmilestone
                        },

                        callback :function(options, success, response){

                            var res = Ext.util.JSON.decode( response.responseText );
                            if( res.success ){
                                var rec = store.getById(res.id);
                                rec.set("milestone", res.milestone);
                                rec.set("estimated", new Date(res.due_timestamp));
                                rec.set("sel", false);
                                rec.commit();                                
                            }
                        }
                     }
                );
             }
         }
         this.win.hide();

    },

    formatItem: function(value, p, record) {
        return String.format(
            '<b>{0}</b>',
            value
        );
    }
    ,

    onRowcontextMenu: function(grid, index, e){
        if( !this.readOnly ){
            rec = this.store.getAt(index);

            if(!this.menu){ // create context menu on first right click

                this.menu = new Ext.menu.Menu({
                id:'grid_productos-ctx',
                enableScrolling : false,
                items: [
                        
                        {
                            text: 'Ver Proyecto',
                            iconCls: 'page_white_edit',
                            scope:this,
                            handler: function(){
                                if( this.ctxRecord.data.iditem  ){
                                    activeRow = this.ctxRecord;
                                    this.ventanaObservaciones( this.ctxRecord );
                                }

                            }
                        }
                        ]
                });
                this.menu.on('hide', this.onContextHide , this);
            }
            e.stopEvent();
            if(this.ctxRow){
                Ext.fly(this.ctxRow).removeClass('x-node-ctx');
                this.ctxRow = null;
            }
            this.ctxRecord = rec;
            this.ctxRow = this.view.getRow(index);
            Ext.fly(this.ctxRow).addClass('x-node-ctx');
            this.menu.showAt(e.getXY());
        }
    }
    ,
    onContextHide: function(){
        if(this.ctxRow){
            Ext.fly(this.ctxRow).removeClass('x-node-ctx');
            this.ctxRow = null;
        }
    },

    onRowDblclick: function( grid , rowIndex, e ){
		record =  this.store.getAt( rowIndex );
        
        this.win = new EditarTareaWindow({idtarea: record.data.idtarea});        
        this.win.show();
	}
    
    





});

</script>