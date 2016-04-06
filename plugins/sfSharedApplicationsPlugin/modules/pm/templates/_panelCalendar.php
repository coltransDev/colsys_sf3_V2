<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */





?>

<script type="text/javascript">


PanelCalendar = function( config ){

    Ext.apply(this, config);

    

    this.columns = [
      
        {
            header: "Milestone",
            dataIndex: 'milestone',
            //hideable: false,
            width: 200,
            sortable: true,
            renderer: this.formatItem
        }
    ];

    this.recs = [
        {name: 'idmilestone', type: 'integer'},
        {name: 'title', type: 'string'}
    ]

    for( var j=1; j<=31; j++ ){
        this.columns.push(
            {
                header: j,
                dataIndex: 'day_'+j,
                //hideable: false,
                width: 20,
                sortable: true,
                renderer: this.formatItem

            }
        );
        
        this.recs.push(
            {name: 'day_'+j, type: 'string'}
        );

    }


    this.record = Ext.data.Record.create( this.recs );
    

    this.store = new Ext.data.GroupingStore({

        autoLoad : true,
        url: '<?=url_for("pm/datosPanelCalendar")?>',
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
        sortInfo:{field: 'title', direction: "ASC"}
        //groupOnSort: true,
        


    });





    PanelCalendar.superclass.constructor.call(this, {
       loadMask: {msg:'Cargando...'},
       //boxMinHeight: 300,
       
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

Ext.extend(PanelCalendar, Ext.grid.GridPanel, {

    crearTicket: function(){
        this.win = new EditarTicketWindow();
        this.win.show();
    },
    recargar: function(){

        if(this.store.getModifiedRecords().length>0){
            if(!confirm("Se perderan los cambios no guardados, desea continuar?")){
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
    }






});

</script>