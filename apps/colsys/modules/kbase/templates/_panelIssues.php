<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */





?>

<script type="text/javascript">


PanelIssues = function( config ){

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


    this.filters = new Ext.ux.grid.GridFilters({
        // encode and local configuration options defined previously for easier reuse
        encode: false, // json encode the filter query
        local: true,   // defaults to false (remote filtering)
        filters: [{
            type: 'string',
            dataIndex: 'title'

        },
        {
            type: 'string',
            dataIndex: 'author'

        },
        {
            type: 'date',
            dataIndex: 'pubDate'
        }
        ]
    });

    

    this.columns = [      
      {
        header: "Titulo",
        dataIndex: 'title',
        //hideable: false,
        width: 420,
        sortable: true,
        renderer: this.formatTitle        
      },{
        header: "Autor",
        dataIndex: 'author',
        width: 100,
        hidden: true,
        sortable:true
      },{
        id: 'last',
        header: "Fecha",
        dataIndex: 'pubDate',
        renderer: Ext.util.Format.dateRenderer("M j, Y, g:i a"),
        width: 150,
        sortable:true
    }

      
     ];


    this.record = Ext.data.Record.create([
            {name: 'sel', type: 'bool'},
            {name: 'idissue', type: 'integer'},
            {name: 'idcategory', type: 'integer'},
            {name: 'summary', type: 'string'},
            {name: 'title', type: 'string'},
            {name: 'author', type: 'string'},
            {name: 'info', type: 'string'},
            {name: 'level', type: 'integer'},
            {name: 'pubDate', type: 'date', dateFormat:'Y-m-d H:i:s'}
    ]);
    
    this.store = new Ext.data.GroupingStore({
        autoLoad : true,
        url: '<?=url_for("kbase/datosPanelIssues")?>',
        baseParams : {
            idcategory: this.idcategory
            
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
        //groupField: 'noinventario'
        

    });

    PanelIssues.superclass.constructor.call(this, {
       loadMask: {msg:'Cargando...'},       
       boxMinHeight: 300,       
       plugins: this.filters,
       sm: new Ext.grid.RowSelectionModel({
            singleSelect:true
       }),
         
       view: new Ext.grid.GroupingView({
            forceFit:true,
            enableRowBody:true,
            showPreview:true,
            hideGroupedColumn: true,
            getRowClass : this.applyRowClass
            //showPreview:true,
            //hideGroupedColumn: true,            
       }),
       listeners:{            
            rowcontextmenu: this.onRowcontextMenu,
            rowdblclick : this.onRowDblclick
            
       }
    });

};

Ext.extend(PanelIssues, Ext.grid.GridPanel, {

    crearActivo: function(){        
        this.win = new EditarActivoWindow( {idcategory:this.idcategory,
                                            gridopener: this.id} );
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
    

    agruparPor: function( a ){
        this.store.groupBy( a );
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
                
                enableScrolling : false,
                items: [
                        
                        {
                            text: 'Editar',
                            iconCls: 'page_white_edit',
                            scope:this,
                            handler: function(){
                                if( this.ctxRecord.data.idissue  ){
                                    window.open( "<?=url_for("kbase/formIssue")?>?id="+this.ctxRecord.data.idissue );
                                    
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
    },
    
    onContextHide: function(){
        if(this.ctxRow){
            Ext.fly(this.ctxRow).removeClass('x-node-ctx');
            this.ctxRow = null;
        }
    },

    onRowDblclick: function( grid , rowIndex, e ){
		record =  this.store.getAt( rowIndex );
        
		if( typeof(record)!="undefined" ){			
            var win = new EditarActivoWindow({
                idactivo: record.data.idactivo,
                idcategory: record.data.idcategory,
                folder: record.data.folder,
                gridopener: grid.id
            });
            win.show();
            
		}
	},


    applyRowClass: function(record, rowIndex, p, ds) {
        
        var xf = Ext.util.Format;
        p.body = xf.stripTags(record.data.summary) ;
        return 'x-grid3-row-expanded';
    },


    formatTitle: function(value, p, record) {
        return String.format(
                '<div class="topic"><b>{0}</b><br /><span class="author">{1}</span></div>',
                value, record.data.author
                );
    }

    
    




});

</script>