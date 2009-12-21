<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

$recargos = $sf_data->getRaw( "recargos" );

?>
<script type="text/javascript">


FormComprobanteSubpanelDeducciones = function(){

    
    this.dataRecargos = <?=json_encode(array("root"=>$recargos))?>;

    this.storeConceptos = new Ext.data.Store({
        autoLoad : true,
        proxy: new Ext.data.MemoryProxy( this.dataRecargos ),
        reader: new Ext.data.JsonReader(
            {
                id: 'idconcepto',
                root: 'root',
                totalProperty: 'total',
                successProperty: 'success'
            },
            Ext.data.Record.create([
                {name: 'idconcepto',  mapping: 'c_ca_idconcepto'},
                {name: 'concepto'},
                {name: 'centro'},
                {name: 'idccosto',  mapping: 'cc_ca_idccosto'},
                {name: 'codigo'}
            ])
        )
    });

    this.editorConceptos = new Ext.form.ComboBox({
        
        typeAhead: true,
        forceSelection: true,
        triggerAction: 'all',
        selectOnFocus: true,        
        mode: 'local',
        displayField: 'concepto',
        valueField: 'idconcepto',
        lazyRender:true,
        listClass: 'x-combo-list-small',
        store : this.storeConceptos
    });

    this.storeReferencias = new Ext.data.Store({
        autoLoad : true,
        url: '<?=url_for("widgets/datosComboReferencias")?>',
        reader: new Ext.data.JsonReader(
            {                
                root: 'root',
                totalProperty: 'total',
                successProperty: 'success'
            },
            Ext.data.Record.create([
                {name: 'idmaestra', mapping:'ca_idmaestra'},
                {name: 'referencia', mapping:'ca_referencia'}
                
            ])
        )
    });

    this.editorReferencias = new Ext.form.ComboBox({
        typeAhead: true,
        forceSelection: true,
        triggerAction: 'all',
        selectOnFocus: true,
        minChars: 9,
        displayField: 'referencia',
        valueField: 'idmaestra',
        lazyRender:true,        
        store : this.storeReferencias
    });

    this.columns = [       
      
      {
        header: "Código",
        dataIndex: 'codigo',
        sortable:false,
        width: 60,
        editor: new Ext.form.TextField({
				allowBlank: false 				
			})        
      },
      {
        header: "C. de Costos",
        dataIndex: 'centro',
        sortable:false,
        width: 50
      }     
      ,{
        header: "DB/CR",
        dataIndex: 'db',
        width: 100,
        sortable:false,
        editor: new Ext.form.TextField({
				allowBlank: false ,				
				style: 'text-align:left'				
			})
      },{
        header: "Valor",
        dataIndex: 'valor',
        width: 100,        
        sortable:false,
        editor: new Ext.form.NumberField({
				allowBlank: false ,
				allowNegative: false,
				style: 'text-align:left',
				decimalPrecision :3
			})
      }
    ];

    
    this.record = Ext.data.Record.create([            
            {name: 'idmaestra', type: 'int'},
            {name: 'referencia', type: 'string'},
            {name: 'idcomprobante', type: 'int'},
            {name: 'idtransaccion', type: 'int'},
            {name: 'idconcepto', type: 'int'},
            {name: 'codigo', type: 'string'},
            {name: 'idccosto', type: 'int'},
            {name: 'centro', type: 'string'},
            {name: 'idccosto', type: 'string'},
            {name: 'concepto', type: 'string'},
            {name: 'db', type: 'string'},
            {name: 'valor', type: 'float'},
            
        ]);

    this.store = new Ext.data.Store({       

        autoLoad : true,
        url: '<?=url_for("inocomprobantes/formComprobanteData?idcomprobante=".$comprobante->getCaIdcomprobante())?>',
        reader: new Ext.data.JsonReader(
            {
                root: 'items',
                totalProperty: 'total'
            },
            this.record
        )
    });

    
  

    FormComprobanteSubpanelDeducciones.superclass.constructor.call(this, {
       loadMask: {msg:'Cargando...'},
       clicksToEdit: 1,
       view: new Ext.grid.GridView({
       
            forceFit:true
            //enableRowBody:true,
            //showPreview:true//,
            //getRowClass : this.applyRowClass
        }),
        listeners:{
            validateedit: this.onValidateEdit,
            rowcontextmenu: this.onRowcontextMenu
            //dblclick:this.onDblClickHandler
        },
        tbar: [{
            text:'Guardar',
            iconCls: 'disk',
            scope:this,
            handler: this.guardarCambios
        },
        '-'
        /*,
        {
            text:'Importar Cotizacion',
            iconCls: 'import',
            scope:this,
            handler: guardarCambios
        },
        {
            text:'Importar del tarifario',
            iconCls: 'import',
            scope:this,
            handler: guardarCambios
        }*/

      ]


    });


};

Ext.extend(FormComprobanteSubpanelDeducciones, Ext.grid.EditorGridPanel, {
    height: 300,
    title: 'Deducciones',
    onValidateEdit : function(e){
        if( e.field == "db"){
            if( e.value=="d" || e.value=="D" ){
                e.value="D";
                return true;
            }

            if( e.value=="c" || e.value=="C" ){
                e.value="C";
                return true;
            }
            return false;
        }
        
        if( e.field == "concepto"){            
            var rec = e.record;
            var ed = this.colModel.getCellEditor(e.column, e.row);
            var store = ed.field.store;

            var recordConcepto = this.record;
            var storeGrid = this.store;
            store.each( function( r ){

                    if( r.data.idconcepto==e.value ){


                        if( !rec.data.idconcepto ){
                            var newRec = new recordConcepto({

                               idmaestra: '<? //=$comprobante->getCaIdmaestra()?>',
                               idcomprobante: '<?=$comprobante->getCaIdcomprobante()?>',
                               concepto: '+',
                               idconcepto: '',
                               idtransaccion: '',
                               valor: '',
                               orden: 'Z' // Se utiliza Z por que el orden es alfabetico
                            });

                            rec.set("idconcepto", r.data.idconcepto);
                            rec.set("valor", 0);
                            rec.set("db", "C");
                            
                            rec.set("orden", "Y-Z");
                                //guardarGridProductosRec( rec );


                            //Inserta una columna en blanco al final
                            storeGrid.addSorted(newRec);
                            storeGrid.sort("orden", "ASC");

                        }else{
                            rec.set("idconcepto", r.data.idconcepto);
                        }

                        e.value = r.data.concepto;
                        rec.set("centro", r.data.centro);
                        rec.set("idccosto", r.data.idccosto);
                        rec.set("codigo", r.data.codigo);

                        return true;
                    }
                }
            )
        }

        if( e.field == "codigo"){
            var rec = e.record;
            var ed = this.colModel.getCellEditor(2 , e.row);
            var store = ed.field.store;

            var recordConcepto = this.record;
            var storeGrid = this.store;
            var valido = false;
            store.each( function( r ){

                    if( r.data.codigo==e.value ){
                       
                        if( !rec.data.idconcepto ){
                            var newRec = new recordConcepto({                               
                               idcomprobante: '<?=$comprobante->getCaIdcomprobante()?>',
                               concepto: '+',
                               idconcepto: '',
                               idtransaccion: '',
                               valor: '',
                               orden: 'Z' // Se utiliza Z por que el orden es alfabetico
                            });

                            rec.set("idconcepto", r.data.idconcepto);
                            rec.set("valor", 0);

                            rec.set("orden", "Y-Z");
                                //guardarGridProductosRec( rec );


                            //Inserta una columna en blanco al final
                            storeGrid.addSorted(newRec);
                            storeGrid.sort("orden", "ASC");

                        }else{
                            rec.set("idconcepto", r.data.idconcepto);
                        }

                       
                        rec.set("concepto", r.data.concepto);
                        rec.set("centro", r.data.centro);
                        rec.set("idccosto", r.data.idccosto);
                        
                        valido = true;
                        return true;
                    }
                }
            );
            return valido;
        }

        if( e.field == "referencia"){
            var rec = e.record;
            var ed = this.colModel.getCellEditor(e.column , e.row);
            var store = ed.field.store;
            
            store.each( function( r ){
                if( r.data.idmaestra==e.value ){

                    rec.set("idmaestra", r.data.idmaestra);
                    e.value = r.data.referencia;
                    return true;
                }
            });
        }


        
    }
    ,
    guardarCambios: function(){
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
            changes['idconcepto']=r.data.idconcepto;
            changes['valor']=r.data.valor;
            changes['idtransaccion']=r.data.idtransaccion;
            changes['idccosto']=r.data.idccosto ;

            if( r.data.idconcepto ){
                //envia los datos al servidor
                Ext.Ajax.request(
                    {
                        waitMsg: 'Guardando cambios...',
                        url: '<?=url_for("inocomprobantes/observeFormComprobanteSubpanelDeducciones?idcomprobante=".$comprobante->getCaIdcomprobante())?>',
						//method: 'POST',
                        //Solamente se envian los cambios
                        params :	changes,

                        callback :function(options, success, response){

                            var res = Ext.util.JSON.decode( response.responseText );
                            if( res.id && res.success){
                                var rec = store.getById( res.id );
                                rec.set("idtransaccion", res.idtransaccion);
                                //rec.set("sel", false); //Quita la seleccion de todas las columnas
                                rec.commit();
                            }
                        }
                     }
                );
            }
        }
    }
    ,
    onRowcontextMenu: function(grid, index, e){
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
    ,
    onContextHide: function(){
        if(this.ctxRow){
            Ext.fly(this.ctxRow).removeClass('x-node-ctx');
            this.ctxRow = null;
        }
    }
    ,

    eliminarItem : function(){
        var storeTransacciones = this.store;
        
        if( this.ctxRecord && this.ctxRecord.data.idtransaccion && confirm("Desea continuar?") ){

            var id = this.ctxRecord.id;

            
            Ext.Ajax.request(
            {
                waitMsg: 'Eliminando...',
                url: '<?=url_for("inocomprobantes/eliminarFormComprobanteSubpanelDeducciones?idcomprobante=".$comprobante->getCaIdcomprobante())?>',
                //method: 'POST',
                //Solamente se envian los cambios
                params :	{
                    id: id,
                    idtransaccion: this.ctxRecord.data.idtransaccion
                },

                //Ejecuta esta accion en caso de fallo
                //(404 error etc, ***NOT*** success=false)
                failure:function(response,options){
                    alert( response.responseText );
                    success = false;
                },



                //Ejecuta esta accion cuando el resultado es exitoso
                success:function(response,options){
                    var res = Ext.util.JSON.decode( response.responseText );
                    if( res.success ){
                        record = storeTransacciones.getById( res.id );
                        storeTransacciones.remove(record);
                    }
                }
            });

        }else{
            storeTransacciones.remove(this.ctxRecord);
        }
    }

    ,
    formatItem: function(value, p, record) {

        return String.format(
            '<b>{0}</b>',
            value
        );

    }

});

</script>