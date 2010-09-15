<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
?>
<script type="text/javascript">

PanelParametros = function( config ){

    Ext.apply(this, config);

    

        
    //this.fleteCheckColumn = new Ext.grid.CheckColumn({header:'Flete', dataIndex:'flete', width:25});
    this.recLocalCheckColumn = new Ext.grid.CheckColumn({header:'Rec. Local', dataIndex:'recargolocal', width:25});
    this.recOrigenCheckColumn = new Ext.grid.CheckColumn({header:'Rec. Origen', dataIndex:'recargoorigen', width:25});
    //this.costoCheckColumn = new Ext.grid.CheckColumn({header:'Costo', dataIndex:'costo', width:25});
    
    this.columns = [
       
       
       {
        header: "Código",
        dataIndex: 'idconcepto',
        hideable: false,
        sortable:false,
        width: 30,
        renderer: this.formatItem

      },
      {
        header: "Concepto",
        dataIndex: 'concepto',
        hideable: false,
        width: 170,
        renderer: this.formatItem,
        sortable: this.readOnly,
        editor: new Ext.form.TextField({
                    allowBlank: false ,
                    style: 'text-align:left'
                })
      }      
      ,
      this.recLocalCheckColumn,
      this.recOrigenCheckColumn      
     ];


    this.record = Ext.data.Record.create([           
            {name: 'idconcepto', type: 'int', mapping: 'c_ca_idconcepto'},
            {name: 'concepto', type: 'string', mapping: 'c_ca_concepto'},           
            {name: 'modalidades', type: 'string'},
            {name: 'orden', type: 'string'},                        
            {name: 'recargolocal', type: 'bool', mapping: 'c_ca_recargolocal'},
            {name: 'recargoorigen', type: 'bool', mapping: 'c_ca_recargoorigen'},
            {name: 'flete', type: 'bool', mapping: 'c_ca_flete'},
            {name: 'costo', type: 'bool', mapping: 'c_ca_costo'},
            {name: 'aka', type: 'string', mapping: 'c_ca_aka'}
    ]);

    this.store = new Ext.data.Store({

        autoLoad : true,
        url: '<?=url_for("conceptos/datosPanelParametrosConceptos")?>',
        baseParams : {
            readOnly: this.readOnly
        },
        reader: new Ext.data.JsonReader(
            {
                root: 'root',
                totalProperty: 'totalCount'
            },
            this.record
        ),
        sortInfo:{field: 'orden', direction: "ASC"}
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
    PanelParametros.superclass.constructor.call(this, {
       loadMask: {msg:'Cargando...'},
       clicksToEdit: 2,
       id: 'panel-parametros',
       plugins: [                    
                    this.recLocalCheckColumn,
                    this.recOrigenCheckColumn
                ],
       view: new Ext.grid.GridView({

            forceFit:true,
            enableRowBody:true,
            showPreview:true//,
            //getRowClass : this.applyRowClass
       }),
       listeners:{
            validateedit: this.onValidateEdit,
            rowcontextmenu: this.onRowcontextMenu,
            dblclick:this.onDblClickHandler,
            celldblclick: this.onCelldblclick
            
       },
       tbar: this.tbar

    });

    var storePanelParametros = this.store;
    var readOnly = this.readOnly;
    this.getColumnModel().isCellEditable = function(colIndex, rowIndex) {
        if( readOnly ){
            return false;
        }else{
            var record = storePanelParametros.getAt(rowIndex);
            var field = this.getDataIndex(colIndex);


            if( !record.data.idconcepto && field!="concepto" ){
                return false;
            }
            /*
            if( record.data.idconcepto && field=="concepto" ){
                return false;
            }*/


            return Ext.grid.ColumnModel.prototype.isCellEditable.call(this, colIndex, rowIndex);
        }
    }

    actualizarObservaciones = function( btn, text, obj ){
        if( btn=="ok" ){
            var record = activeRow;
            record.set("observaciones", text);
        }
    }



};

Ext.extend(PanelParametros, Ext.grid.EditorGridPanel, {
    guardarCambios: function(){

        if( !this.readOnly ){
            var store = this.store;
            var records = store.getModifiedRecords();

            var lenght = records.length;

            /*
            for( var i=0; i< lenght; i++){
                r = records[i];
                if(!r.data.moneda && (r.data.tipo=="concepto"||r.data.recargo=="concepto") ){
                    if( r.data.iditem!=9999){
                        Ext.MessageBox.alert('Warning','Por favor coloque la moneda en todos los items');
                        return 0;
                    }
                }
            }	*/

            for( var i=0; i< lenght; i++){
                r = records[i];

                var changes = r.getChanges();

                //Da formato a las fechas antes de enviarlas


                changes['id']=r.id;
                changes['idccosto']=r.data.idccosto;
                changes['idconcepto']=r.data.idconcepto;


                if( r.data.concepto ){
                    //envia los datos al servidor
                    Ext.Ajax.request(
                        {
                            waitMsg: 'Guardando cambios...',
                            url: '<?=url_for("conceptos/guardarPanelParametros")?>', 						//method: 'POST',
                            //Solamente se envian los cambios
                            params :	changes,

                            callback :function(options, success, response){

                                var res = Ext.util.JSON.decode( response.responseText );
                                if( res.id && res.success){
                                    var rec = store.getById( res.id );
                                    rec.set("idconcepto",res.idconcepto);
                                    //rec.set("sel", false); //Quita la seleccion de todas las columnas
                                    rec.commit();
                                }
                            }
                         }
                    );
                }
            }
        }
    }
    ,
    formatItem: function(value, p, record) {

        return String.format(
            '<b>{0}</b>',
            value
        );

    },


    onValidateEdit : function(e){

        
        if( e.field == "concepto" ){

            var rec = e.record;
            var recordConcepto = this.record;

            if( rec.data.orden=="Z"){
                var newRec = new recordConcepto({
                               idconcepto: '',
                               concepto: '',
                               tipo: '',
                               modalidades: '',
                               orden: 'Z' // Se utiliza Z por que el orden es alfabetico
                            });

                rec.set("orden", "Y");

                //guardarGridProductosRec( rec );

                //Inserta una columna en blanco al final
                this.store.addSorted(newRec);
                this.store.sort("orden", "ASC");
            }
        }
        return true;
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
                            text: 'Eliminar item',
                            iconCls: 'delete',
                            scope:this,
                            handler: this.eliminarItem
                        },
                        {
                            text: 'Observaciones',
                            iconCls: 'page_white_edit',
                            scope:this,
                            handler: function(){
                                if( this.ctxRecord.data.iditem  ){
                                    activeRow = this.ctxRecord;
                                    this.ventanaObservaciones( this.ctxRecord );
                                }

                            }
                        },
                        {
                            text: 'Alias',
                            iconCls: 'page_white_params',
                            scope:this,
                            handler: function(){
                                
                                var record = this.ctxRecord;
                                var aka = record.get("aka");                                
                                               
                                
                                this.win = new AKAWindow({
                                                readOnly: this.readOnly,
                                                aka:aka
                                            });
                                
                                this.win.ctxRecord = record;
                                this.win.show();
                                
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
    ,
    onDblClickHandler: function(e) {
        
        if( !this.readOnly ){
            var btn = e.getTarget('.btnComentarios');
            if (btn) {
                var t = e.getTarget();
                var v = this.view;
                var rowIdx = v.findRowIndex(t);
                var record = this.getStore().getAt(rowIdx);

                activeRow = record;
                this.ventanaObservaciones( record );
            }
        }
    },
    ventanaObservaciones : function( record ){        
        var activeRow = record;
        Ext.MessageBox.show({
               title: 'Observaciones',
               msg: 'Por favor coloque las observaciones:',
               width:300,
               buttons: Ext.MessageBox.OKCANCEL,
               multiline: true,
               fn: actualizarObservaciones,
               animEl: 'mb3',
               value: record.get("observaciones")
           });
    }


    ,
    onCelldblclick : function( grid, rowIndex, columnIndex, e ){
        var record = grid.getStore().getAt(rowIndex);  // Get the Record

        var fieldName = grid.getColumnModel().getDataIndex(columnIndex); // Get field name

        var data = record.get(fieldName);

        if( fieldName=="idconcepto" && data ){
            this.showWindow( record );
        }
    },

    showWindow : function( record ){
        
        //if(!this.win)
        {
            this.win = new ModalidadWindow({
                            readOnly: this.readOnly
                        });
            //this.win.on('validfeed', this.addFeed, this);
        }
        this.win.ctxRecord = record;
        this.win.show();
    },

    eliminarItem: function(){
        if( !this.readOnly ){
            var record = this.ctxRecord;
            var store = this.store;
            if( confirm("Esta seguro que desea eliminar este item?") ){
                if( record.data.idconcepto ){
                    var idconcepto = record.data.idconcepto;

                    Ext.Ajax.request({

                        waitMsg: 'Eliminando...',
                        url: '<?=url_for("conceptos/eliminarPanelParametros")?>',
                        //method: 'POST',
                        //Solamente se envian los cambios
                        params :	{
                            idconcepto: idconcepto
                        },

                        //Ejecuta esta accion en caso de fallo
                        //(404 error etc, ***NOT*** success=false)
                        failure:function(response,options){
                            var res = Ext.util.JSON.decode( response.responseText );
                            Ext.MessageBox.alert('Error Message', "Se ha presentado un error"+(res.errorInfo?": "+res.errorInfo:"")+" - "+(response.status?"\n Codigo HTTP "+response.status:""));
                        },

                        //Ejecuta esta accion cuando el resultado es exitoso
                        success:function(response,options){
                            var res = Ext.util.JSON.decode( response.responseText );
                            if( res.success ){
                                r = store.getById( record.id );
                                store.remove( r );
                            }else{
                                Ext.MessageBox.alert('Error Message', "Se ha presentado un error"+(res.errorInfo?": "+res.errorInfo:"")+" - "+(response.status?"\n Codigo HTTP "+response.status:""));
                            }
                        }


                    });
                }
            }
        }

    }

    




});

</script>