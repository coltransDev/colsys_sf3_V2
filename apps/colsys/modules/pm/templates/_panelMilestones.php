<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>

<script type="text/javascript">


PanelMilestones = function( config ){

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

           
            if( record.data.end ){
                color = "row_blue";
            }else{
                if( record.data.due){
                    var date = new Date();
                    date.setHours(0);
                    date.setMinutes(0);
                    date.setSeconds(0);
                    var date = new Date(date.getTime()+(86400000*2));
                    
                    if( record.data.due<=date){
                        color = "row_yellow";
                    }

                    var date = new Date();                    
                    date.setHours(0);
                    date.setMinutes(0);
                    date.setSeconds(0);
                    var date = new Date(date.getTime()-86400000);
                    if( record.data.due<date ){
                        color = "row_pink";
                    }
                }                
            }


            /*
            if( record.data.due<= ){
                color = "row_pink";
            }*/
            
            return this.state[record.id] ? 'x-grid3-row-expanded '+color : 'x-grid3-row-collapsed '+color;
        }
    });


    this.filters = new Ext.ux.grid.GridFilters({
        // encode and local configuration options defined previously for easier reuse
        encode: false, // json encode the filter query
        local: true,   // defaults to false (remote filtering)
        filters: [
            {
                type: 'string',
                dataIndex: 'title'
            },
            {
                type: 'date',
                dataIndex: 'due'
            },
            {
                type: 'date',
                dataIndex: 'end'
            }
        
        ]
    });

    this.columns = [
      this.expander,
      {
        header: "Id",
        dataIndex: 'idmilestone',
        //hideable: false,
        width: 43,
        sortable: false,
        renderer: this.formatItem 
        
      },
      {
        header: "Titulo",
        dataIndex: 'title',
        //hideable: false,
        sortable: false,
        width: 280,
        editor: new Ext.form.TextField({allowBlank: false,
                                        maxLength: 25
                                        })
        
      },
      {
        header: "Vencimiento",
        dataIndex: 'due',
        hideable: false,
        width: 100,
        sortable: false,
        renderer: Ext.util.Format.dateRenderer('Y-m-d'),
        editor: new Ext.form.DateField({
				format: 'Y-m-d'
			})
      },
      {
        header: "Entrega",
        dataIndex: 'end',
        hideable: false,
        width: 100,
        sortable: false,
        renderer: Ext.util.Format.dateRenderer('Y-m-d'),
        editor: new Ext.form.DateField({
				format: 'Y-m-d'
			})
      }
      /*,
      {
        header: "Orden",
        dataIndex: 'orden',
        hideable: false,
        width: 100
      }*/
     

      
     ];


    this.record = Ext.data.Record.create([
            {name: 'idmilestone', type: 'integer', mapping: 'h_ca_idmilestone'},
            {name: 'idproject', type: 'integer', mapping: 'h_ca_idproject'},            
            {name: 'title', type: 'string', mapping: 'h_ca_title'},
            {name: 'text', type: 'string', mapping: 'h_ca_text'},            
            {name: 'due', type: 'date', mapping: 'h_ca_due', dateFormat:'Y-m-d'},
            {name: 'end', type: 'date', mapping: 'h_ca_end', dateFormat:'Y-m-d'},
            {name: 'orden', type: 'string'},
            
    ]);

    this.store = new Ext.data.Store({

        autoLoad : true,
        url: '<?=url_for("pm/datosPanelMilestones")?>',
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
        sortInfo:{field: 'orden', direction: "ASC"}
        //groupOnSort: true,
        
        

    });

    if( !this.readOnly ){
        this.tbar = [{
                text:'Guardar',
                iconCls: 'disk',
                scope:this,
                handler: this.guardarCambios
              }
             ];
    }else{
        this.tbar = null;
    }
    
    PanelMilestones.superclass.constructor.call(this, {
       loadMask: {msg:'Cargando...'},       
       boxMinHeight: 400,
       height: 400,
      
       plugins: [
                    this.expander,
                    this.filters
                ],
       view: new Ext.grid.GridView({

            forceFit:true,
            enableRowBody:true,
            hideGroupedColumn: true
            //showPreview:true,
            //hideGroupedColumn: true,
            
       }),
       listeners:{            
            rowcontextmenu: this.onRowcontextMenu,
            validateedit: this.onValidateEdit
       },
       tbar: this.tbar
    });

};

Ext.extend(PanelMilestones, Ext.grid.EditorGridPanel, {
    
    formatItem: function(value, p, record) {

        return String.format(
            '<b>{0}</b>',
            value
        );
    },
    onRowcontextMenu: function(grid, index, e){
        if( !this.readOnly ){
            rec = this.store.getAt(index);

            if(!this.menu){ // create context menu on first right click

                this.menu = new Ext.menu.Menu({                
                enableScrolling : false,
                items: [
                        {
                            text: 'Eliminar item',
                            iconCls: 'delete',
                            scope:this,
                            handler: function(){
                                this.eliminarItem( this.ctxRecord );
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
    }


    ,onValidateEdit : function(e){


        if( e.field == "title" ){
            var rec = e.record;
            if( rec.data.orden=="Z"){
                var newRec = new this.record({
                               idmilestone: '',
                               title: '',
                               text: '',
                               end: '',
                               due: '',
                               orden: 'Z' // Se utiliza Z por que el orden es alfabetico
                            });

                rec.set("orden", "Y");
                rec.set("due", "");
                //Inserta una columna en blanco al final
                this.store.addSorted(newRec);
                this.store.sort("orden", "ASC");
            }
        }
        return true;
    },

    guardarCambios: function(){

        if( !this.readOnly ){
            var store = this.store;
            var records = store.getModifiedRecords();

            var lenght = records.length;

            var error = false;

            for( var i=0; i< lenght; i++){
                r = records[i];

                var changes = r.getChanges();

                //Da formato a las fechas antes de enviarlas


                changes['id']=r.id;
                changes['idmilestone']=r.data.idmilestone;
                changes['idproject']=this.idproject;


                if( r.data.title && r.data.due ){
                    //envia los datos al servidor
                    Ext.Ajax.request(
                        {
                            waitMsg: 'Guardando cambios...',
                            url: '<?=url_for("pm/guardarPanelMilestones")?>', 						//method: 'POST',
                            //Solamente se envian los cambios
                            params :	changes,

                            callback :function(options, success, response){

                                var res = Ext.util.JSON.decode( response.responseText );
                                if( res.id && res.success){
                                    var rec = store.getById( res.id );
                                    rec.set("idmilestone",res.idmilestone);
                                    //rec.set("sel", false); //Quita la seleccion de todas las columnas
                                    rec.commit();
                                }
                            }
                         }
                    );
                }

                if( r.data.title && !r.data.due ){
                    error = true;
                }
            }

            if( error ){
                Ext.MessageBox.alert("Error", "Algunos datos no se guardaron por que faltaba la fecha de vencimiento");
            }
        }
    },

    eliminarItem: function(ctxRecord, index){

        if( confirm("Esta seguro?") ){
            
            var store = this.store;
            Ext.Ajax.request(
                {
                    waitMsg: 'Eliminando...',
                    url: '<?=url_for("pm/eliminarPanelMilestones")?>',
                    method: 'POST',
                    //Solamente se envian los cambios
                    params :	{
                        idmilestone: ctxRecord.data.idmilestone,
                        id: ctxRecord.id
                    },

                    callback :function(options, success, response){

                        var res = Ext.util.JSON.decode( response.responseText );                        
                        if( res.success ){                            
                            r = store.getById( res.id );
                            store.remove( r );
                        }
                    }
                 }
            );

        }
    }
    





});

</script>