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
            {name: 'pubDate', type: 'date', dateFormat:'Y-m-d H:i:s'},
            {name: 'folder', type: 'string'}
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
       enableDragDrop   : true,
       ddGroup : 'TreeDD',
       
       view: new Ext.grid.GroupingView({
            emptyText: "No hay resultados",
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

                var items = [{
                            text: 'Editar',
                            iconCls: 'page_white_edit',
                            scope:this,
                            handler: function(){
                                if( this.ctxRecord.data.idissue  ){
                                    window.open( "<?=url_for("kbase/formIssue")?>?id="+this.ctxRecord.data.idissue );

                                }

                            }
                        }];

                if( this.idticket ){
                    items.push({
                            text: 'Solución ticket '+this.idticket,
                            iconCls: 'tick',
                            scope:this,
                            handler: this.solucionarTicket
                    });
                }

                this.menu = new Ext.menu.Menu({
                
                enableScrolling : false,
                items: [
                        items
                        
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
           
            var d = record.data;


            var tpl = Ext.Template.from('preview-tpl-kb', {
                compiled:true,
                getBody : function(v, all){
                    return Ext.util.Format.stripScripts(v || all.description);
                }
            });



            var panel = new Ext.Panel({
                cls:'preview single-preview',                                
                html: tpl.apply(d),
                closable:true,
                //listeners: FeedViewer.LinkInterceptor,
                autoScroll:true,
                border:true,
                y:20,
                height: 300
            });

            var win = new Ext.Window({
                items: panel,
                title: d.title,
                closeAction: 'close',
                
                width: 600
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
    },
    
    solucionarTicket: function(){
        
        var idissue = this.ctxRecord.data.idissue;
        var opener = this.opener;
        Ext.Ajax.request(
			{
				waitMsg: 'Cargando...',
				url: '<?=url_for("pm/guardarRespuestaTicket")?>',
                
				//Solamente se envian los cambios
				params :	{
                    idissue: idissue,
                    idticket: this.idticket
                },

				callback :function(options, success, response){

					var res = Ext.util.JSON.decode( response.responseText );


					if( res.success ){
                        if( opener ){
                            var cmp = Ext.getCmp(opener);
                            if( cmp ){
                                cmp.body.update(res.info);
                            }
                        }
					}
				}
			 }
		);


        var win = Ext.getCmp("kbase-search-win");
        if( win ){
            win.close();
        }
    }


    
    




});

</script>