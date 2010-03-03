<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>

<script type="text/javascript">


PanelTickets = function( config ){

    Ext.apply(this, config);

    /*
    * Crea el expander
    */
    this.expander = new Ext.grid.RowExpander({
        lazyRender : false,
        width: 15,
        tpl : new Ext.Template(
          '<p><div class=\'btnComentarios\' id=\'obs_{_id}\'>&nbsp; {text}</div></p>'

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
                switch( record.data.priority ){
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
        filters: [{
            type: 'numeric',
            dataIndex: 'idticket'
        }, {
            type: 'string',
            dataIndex: 'project'

        }, {
            type: 'string',
            dataIndex: 'title'

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
            dataIndex: 'opened'
        },
        {
            type: 'date',
            dataIndex: 'respuesta'
        },
        {
            type: 'date',
            dataIndex: 'ultseg'
        }
        ]
    });

    this.columns = [
      this.expander,
      {
        header: "Ticket #",
        dataIndex: 'idticket',
        //hideable: false,
        width: 43,
        sortable: true,
        renderer: this.formatItem 
        
      },
      {
        header: "Titulo",
        dataIndex: 'title',
        //hideable: false,
        sortable: true,
        width: 280
        
      },
      {
        header: "Usuario",
        dataIndex: 'login',
        hideable: false,
        sortable: true,
        width: 80

      },
      {
        header: "Proyecto",
        dataIndex: 'project',
        //hideable: false,
        sortable: true,
        width: 280

      },
      {
        header: "Prioridad",
        dataIndex: 'priority',
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
        header: "Abierto",
        dataIndex: 'opened',
        hideable: false,
        width: 100,
        sortable: true,
        renderer: Ext.util.Format.dateRenderer('d/m/y H:i')
      },
      {
        header: "Respuesta",
        dataIndex: 'respuesta',
        hideable: false,
        width: 100,
        sortable: true,
        renderer: Ext.util.Format.dateRenderer('d/m/y H:i')
      },
      {
        header: "Ult. Seguimiento",
        dataIndex: 'ultseg',
        hideable: false,
        width: 100,
        sortable: true,
        renderer: Ext.util.Format.dateRenderer('d/m/y H:i')
      },
      {
        header: "Milestone",
        dataIndex: 'milestone',
        hideable: false,
        width: 100,
        sortable: true        
      },
      {
        header: "Estimado",
        dataIndex: 'estimated',
        hideable: true,
        width: 100,
        sortable: true,
        renderer: Ext.util.Format.dateRenderer('d/m/y')
      }

      
     ];


    this.record = Ext.data.Record.create([
            {name: 'idticket', type: 'integer', mapping: 'h_ca_idticket'},
            {name: 'idproject', type: 'integer', mapping: 'h_ca_idproject'},
            {name: 'project', type: 'integer', mapping: 'p_ca_name'},
            {name: 'idgroup', type: 'integer', mapping: 'h_ca_idgroup'},
            {name: 'milestone', type: 'string'},
            {name: 'estimated', type: 'date', dateFormat:'Y-m-d', mapping: 'm_ca_due'},
            {name: 'login', type: 'string', mapping: 'h_ca_login'},
            {name: 'tipo', type: 'string', mapping: 'h_ca_type'},
            {name: 'title', type: 'string', mapping: 'h_ca_title'},
            {name: 'text', type: 'string', mapping: 'h_ca_text'},
            {name: 'priority', type: 'integer', mapping: 'h_ca_priority'},
            {name: 'assignedto', type: 'string', mapping: 'h_ca_assignedto'},
            {name: 'opened', type: 'date', mapping: 'h_ca_opened', dateFormat:'Y-m-d H:i:s'},
            {name: 'action', type: 'string', mapping: 'h_ca_action'},
            {name: 'ultseg', type: 'date', mapping: 'h_ultseg', dateFormat:'Y-m-d H:i:s'},
            {name: 'respuesta', type: 'date', mapping: 'tar_ca_fchterminada', dateFormat:'Y-m-d H:i:s'}
            
    ]);

    this.store = new Ext.data.GroupingStore({

        autoLoad : true,
        url: '<?=url_for("pm/datosPanelTickets")?>',
        baseParams : {

            idproject: this.idproject
        },
        reader: new Ext.data.JsonReader(
            {
                root: 'root',
                totalProperty: 'total'
            },
            this.record
        ),
        sortInfo:{field: 'project', direction: "ASC"},
        //groupOnSort: true,
        groupField: 'project'
        

    });

    this.tbar = [{
                text: 'Recargar',
                tooltip: 'Actualiza losdatos del panel',
                iconCls: 'refresh',  // reference to our css
                scope: this,
                handler: this.recargar
            },
            {
                text: 'Roadmap',
                tooltip: 'Permite ver el cronograma de entrega de los tickets',
                iconCls: 'calendar',  // reference to our css
                scope: this,
                handler: this.roadmap
            }

     ];

    
    PanelTickets.superclass.constructor.call(this, {
       loadMask: {msg:'Cargando...'},       
       boxMinHeight: 300,
       height: 200,
       plugins: [
                    this.expander,
                    this.filters
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

Ext.extend(PanelTickets, Ext.grid.GridPanel, {
    recargar: function(){

        if(this.store.getModifiedRecords().length>0){
            if(!confirm("Se perderan los cambios no guardados en los recargos locales unicamente, desea continuar?")){
                return 0;
            }
        }
        this.store.reload();
    },
    roadmap: function(){

        this.store.sort("estimated","ASC");
        this.store.groupBy("milestone");
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
		if( typeof(record)!="undefined" ){
			var url = "<?=url_for("pm/verTicket")?>/id/"+record.data.idticket;
			window.open( url );
		}
	}
    
    





});

</script>