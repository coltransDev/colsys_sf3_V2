<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */





?>

<script type="text/javascript">


PanelBusquedaTicket = function( config ){

    Ext.apply(this, config);

    /*
    * Crea el expander
    */
    /*
    * Crea el expander
    */
    this.expander = new Ext.grid.RowExpander({
        lazyRender : false,
        width: 15,
        tpl : new Ext.Template(
          '<p><div class=\'btnComentarios\' >&nbsp; {text}</div></p>'
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
            if( record.data.color ){
               color = "row_"+record.data.color;               
            }else{
               color = "";
            }

            if( record.data.text!=''){
                this.state[record.id]=true;
            }

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

        },
        {
            type: 'string',
            dataIndex: 'tipo'

        },
        {
            type: 'string',
            dataIndex: 'login'

        },
        {
            type: 'string',
            dataIndex: 'assignedto'

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
            dataIndex: 'fchevento'
        }
        ]
    });


    this.summary = new Ext.ux.grid.GroupSummary();

    this.columns = [
      this.expander,      
      {
        header: "Fecha",
        dataIndex: 'fchevento',
        hideable: false,
        width: 100,
        sortable: true,
        renderer: Ext.util.Format.dateRenderer('d/m/y H:i')             
      },
      {
        header: "Ticket #",
        dataIndex: 'idticket',
        //hideable: false,
        width: 63,
        sortable: false,
        renderer: this.formatItem 
        
      },
      {
        header: "Titulo",
        dataIndex: 'title',
        //hideable: false,
        sortable: false,
        width: 280,
        summaryType: 'count',
        summaryRenderer: function(v, params, data){
            return ((v === 0 || v > 1) ? '(' + v +' Tickets)' : '(1 Ticket)');
        }
        
      },
      {
        header: "Usuario",
        dataIndex: 'login',
        hideable: false,
        sortable: false,
        width: 80

      },
      {
        header: "Proyecto",
        dataIndex: 'project',
        //hideable: false,
        sortable: false,
        width: 80

      },
      {
        header: "Area",
        dataIndex: 'group',
        hideable: false,
        hidden: true,
        sortable: true,
        width: 80

      },
     ];


    this.record = Ext.data.Record.create([            
            {name: 'idticket', type: 'integer'},            
            {name: 'group', type: 'string'},
            {name: 'fchevento', type: 'date', dateFormat:'Y-m-d H:i:s'},
            {name: 'login', type: 'string'},            
            {name: 'title', type: 'string'},
            {name: 'text', type: 'string'},
            {name: 'color', type: 'string'},
            {name: 'department', type: 'string'}
    ]);

    this.store = new Ext.data.GroupingStore({

        autoLoad : this.autoload,
        url: '<?=url_for("pm/datosPanelBusquedaTicket")?>',
        baseParams : {
            
        },
        reader: new Ext.data.JsonReader(
            {
                root: 'root',
                totalProperty: 'total'
            },
            this.record
        ),
        sortInfo:{field: 'fchevento', direction: "DESC"},
        //groupOnSort: true,
        groupField: 'group',
        listeners: {            
            exception: this.onException
        }

        
        

    });


    

    
    PanelBusquedaTicket.superclass.constructor.call(this, {
       loadMask: {msg:'Cargando...'},       
       //boxMinHeight: 300,
       plugins: [
                    this.expander,
                    this.filters,                    
                    this.summary
                ],
       view: new Ext.grid.GroupingView({

            forceFit:true,
            enableRowBody:true,
            hideGroupedColumn: true,
            startCollapsed : true,
            emptyText: "No hay tickets con ese criterio o usted no posee permisos para verlo. Consulte el administrador."
            //showPreview:true,
            //hideGroupedColumn: true,
            
            
       }),
       listeners:{            
            //rowcontextmenu: this.onRowcontextMenu,
            rowdblclick : this.onRowDblclick
       }
       
    });
    //this.getView().getRowClass = this.getRowClass;

};

Ext.extend(PanelBusquedaTicket, Ext.grid.GridPanel, {

    
    recargar: function(){

        if(this.store.getModifiedRecords().length>0){
            if(!confirm("Se perderan los cambios no guardados, desea continuar?")){
                return 0;
            }
        }
        this.store.reload();
    },

    formatItem: function(value, p, record) {
        return String.format(
            '<b>{0}</b>',
            value
        );
    },

    onRowDblclick: function( grid , rowIndex, e ){
		record =  this.store.getAt( rowIndex );
		if( typeof(record)!="undefined" ){

            var idticket = record.data.idticket;
            var department = record.data.department;

            var newComponent = new PanelPreviewTicket({
                                                closable: true,
                                                title: 'Ticket # '+idticket,
                                                department: department,
                                                idticket: idticket
                                                //autoHeight: true,
                                                
                                              });
            Ext.getCmp('tab-panel').add(newComponent);
            Ext.getCmp('tab-panel').setActiveTab(newComponent);


            /*var win = Ext.getCmp('ticket-search-win');
            if( win ){
                win.close();
            }*/
		}
	},
    

    onException: function ( obj,  type,  action,  options,  response, arg  ) {
        var res = Ext.util.JSON.decode( response.responseText );
        if( res.errorInfo ){
            Ext.MessageBox.alert( "Error",  res.errorInfo );
        }
    }




});

</script>