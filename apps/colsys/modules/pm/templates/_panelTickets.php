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

        )
        
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


    this.summary = new Ext.ux.grid.GroupSummary();

    this.checkColumn = new Ext.grid.CheckColumn({header:' ', dataIndex:'sel', width:30, hideable: false});

    this.columns = [
      //this.expander,
      this.checkColumn,
      {
        header: "Ticket #",
        dataIndex: 'idticket',
        //hideable: false,
        width: 63,
        sortable: true,
        renderer: this.formatItem 
        
      },
      {
        header: "Titulo",
        dataIndex: 'title',
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
        header: "Tipo",
        dataIndex: 'tipo',
        hideable: false,
        width: 100,
        sortable: true
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
        renderer: Ext.util.Format.dateRenderer('d/m/y')
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
            {name: 'idticket', type: 'integer', mapping: 'h_ca_idticket'},
            {name: 'idproject', type: 'integer', mapping: 'h_ca_idproject'},
            {name: 'project', type: 'string', mapping: 'p_ca_name'},
            {name: 'idgroup', type: 'integer', mapping: 'h_ca_idgroup'},
            {name: 'milestone', type: 'string'},
            {name: 'estimated', type: 'date', dateFormat:'Y-m-d', mapping: 'm_ca_due'},
            {name: 'login', type: 'string', mapping: 'h_ca_login'},
            {name: 'tipo', type: 'string', mapping: 'h_ca_type'},
            {name: 'title', type: 'string', mapping: 'h_ca_title'},
            {name: 'text', type: 'string', mapping: 'h_ca_text'},
            {name: 'priority', type: 'string', mapping: 'h_ca_priority'},
            {name: 'assignedto', type: 'string', mapping: 'h_ca_assignedto'},
            {name: 'opened', type: 'date', mapping: 'h_ca_opened', dateFormat:'Y-m-d H:i:s'},
            {name: 'action', type: 'string', mapping: 'h_ca_action'},
            {name: 'ultseg', type: 'date', mapping: 'h_ultseg', dateFormat:'Y-m-d H:i:s'},
            {name: 'respuesta', type: 'date', mapping: 'tar_ca_fchterminada', dateFormat:'Y-m-d H:i:s'},
            {name: 'percentage', type: 'integer', mapping: 'h_ca_percentage'},
            {name: 'folder', type: 'string'}
            
    ]);

    this.store = new Ext.data.GroupingStore({

        autoLoad : true,
        url: '<?=url_for("pm/datosPanelTickets")?>',
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
        sortInfo:{field: 'idticket', direction: "ASC"},
        //groupOnSort: true,
        groupField: 'action'
        

    });


    

    
    PanelTickets.superclass.constructor.call(this, {
       loadMask: {msg:'Cargando...'},       
       //boxMinHeight: 300,
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
       }
       
    });
    this.getView().getRowClass = this.getRowClass;

};

Ext.extend(PanelTickets, Ext.grid.GridPanel, {

    crearTicket: function(){
        this.win = new EditarTicketWindow();
        this.win.show();
    },
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

    agruparPor: function( a ){
        this.store.groupBy( a );
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
                            text: 'Editar',
                            iconCls: 'page_white_edit',
                            scope:this,
                            handler: function(){
                                if( this.ctxRecord.data.idticket  ){
                                    
                                    var win = new EditarTicketWindow({idticket: this.ctxRecord.data.idticket
                                                                });
                                    win.show();
                                }

                            }
                        },
                        {
                            text: 'Porcentaje',
                            iconCls: 'shape_align_left',
                            scope:this,
                            handler: this.actualizarPorcentaje
                        },
                        {
                            text: 'Tomar Asignaci�n',
                            iconCls: 'tux',
                            scope:this,
                            handler: this.tomarAsignacion
                        },
                        {
                            text: 'Cerrar',
                            iconCls: 'tick',
                            scope:this,
                            handler: this.cerrarTicket
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
            this.ctxGridId = this.id;
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
            this.ctxGridId = null;
        }
    },

    onRowDblclick: function( grid , rowIndex, e ){
		record =  this.store.getAt( rowIndex );        
		if( typeof(record)!="undefined" ){
            var win = Ext.getCmp("editar-ticket-win");
            if( win ){
                win.close();
            }
            var win = new EditarTicketWindow({idticket: record.data.idticket
                                        });
            win.show();
		}
	}
    ,
    getRowClass : function(record, rowIndex, p, ds){
        p.cols = p.cols-1;

        var color;
        if( record.data.action=="Cerrado" ){
            color = "blue";
        }else{
            if( record.data.tipo=="Defecto" ){
                color = "pink";
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
        }
        color = "row_"+color;
        return this.state[record.id] ? 'x-grid3-row-expanded '+color : 'x-grid3-row-collapsed '+color;
    },

    cerrarTicket: function(){
        if( this.ctxRecord.data.idticket  ){
            if( !this.ctxRecord.data.project || !this.ctxRecord.data.tipo ){
                var win = new EditarTicketWindow({idticket: this.ctxRecord.data.idticket
                                            });
                win.show();
            }else{

                var idticket = this.ctxRecord.data.idticket;
                var gridId = this.ctxGridId;

                
                Ext.Ajax.request({
                    url: "<?=url_for("pm/cerrarTicket")?>",
                    params: {                        
                        idticket: idticket
                    },

                    callback :function(options, success, response){
                        var res = Ext.util.JSON.decode( response.responseText );
                        var store = Ext.getCmp(gridId).store;
                        store.each(function(r){
                            if(r.data.idticket==res.idticket){
                                //storeView.remove(r);
                                r.set("action", "Cerrado");
                                r.set("percentage", 100);
                                r.commit();
                                Ext.Msg.alert("Success", "Se ha cerrado el ticket");
                            }
                        });

                    }
                });
            }
        }

    }
    
    ,

    tomarAsignacion: function(){
        if( this.ctxRecord.data.idticket  ){

            var idticket = this.ctxRecord.data.idticket;
            var gridId = this.ctxGridId;


            Ext.Ajax.request({
                url: "<?=url_for("pm/tomarAsignacion")?>",
                params: {
                    idticket: idticket
                },

                callback :function(options, success, response){
                    var res = Ext.util.JSON.decode( response.responseText );
                    var store = Ext.getCmp(gridId).store;
                    store.each(function(r){
                        if(r.data.idticket==res.idticket){
                            //storeView.remove(r);
                            r.set("assignedto", res.assignedto);

                            r.commit();
                            Ext.Msg.alert("Success", "Se le ha asignado el ticket a usted");
                        }
                    });

                }
            });

        }

    },
    actualizarPorcentaje: function(){
        if( this.ctxRecord.data.idticket  ){

            var idticket = this.ctxRecord.data.idticket;
            var percentage = this.ctxRecord.data.percentage;

            var rec = this.store.getById( this.ctxRecord.id );

           
            var updatePercent = function(   slider,  newValue ){

                Ext.Ajax.request({
                    url: '<?=url_for("pm/actualizarPorcentajeTicket")?>',
                    method: 'POST',
                    //Solamente se envian los cambios
                    params :	{
                        idticket: idticket,
                        percentage: newValue
                    },

                    failure :function(options, success, response){

                        alert("Ha ocurrido un error");
                    },
                    
                    success :function(options, success, response){
                        rec.set("percentage", newValue);
                    }


                 }
                );
            }

            var slider = new Ext.Slider({
                width: 214,
                increment: 1,
                value: percentage,
                minValue: 0,
                maxValue: 100,
                plugins: new Ext.slider.Tip(),
                listeners: {
                    changecomplete: updatePercent
                }
            });

            win = new Ext.Window({
                modal: true,
                title: "Actualizar Porcentaje Ticket #"+idticket,
                items:[
                    new Ext.FormPanel({
                        items: [
                            slider
                        ]
                    })
                ]
            });
            win.show();
        }
    }

});

</script>