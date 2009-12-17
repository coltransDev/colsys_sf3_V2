<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
$centros = $sf_data->getRaw("centros");
$cuentas = $sf_data->getRaw("cuentas");
?>

<script type="text/javascript">


PanelParametros = function( config ){

    Ext.apply(this, config);



    this.dataCuentas = <?=json_encode(array("root"=>$cuentas))?>;

    this.storeCuentas = new Ext.data.Store({
        autoLoad : true,
        proxy: new Ext.data.MemoryProxy( this.dataCuentas ),
        reader: new Ext.data.JsonReader(
            {
                root: 'root',
                totalProperty: 'total',
                successProperty: 'success'
            },
            Ext.data.Record.create([
                {name: 'idcuenta',  mapping: 'ca_idcuenta'},
                {name: 'cuenta',  mapping: 'ca_cuenta'}
            ])
        )
    });

    this.editorCuentas = new Ext.form.ComboBox({
        typeAhead: true,
        forceSelection: true,
        triggerAction: 'all',
        selectOnFocus: true,
        mode: 'local',
        displayField: 'cuenta',
        valueField: 'idcuenta',
        lazyRender:true,
        listClass: 'x-combo-list-small',
        store : this.storeCuentas
    });


    this.combo = new Ext.form.ComboBox({
        typeAhead: true,
        id: 'combo',
        mode: 'local',
        triggerAction: 'all',
        emptyText: 'Selecione un centro de Costos...',
        selectOnFocus: true,
        width: 285,
        displayField: "value",
        valueField: "id",
        store : new Ext.data.Store({
            autoLoad : true,
            proxy: new Ext.data.MemoryProxy( <?=json_encode($centros)?> ),
            reader: new Ext.data.JsonReader(
                {

                    successProperty: 'success'
                },
                Ext.data.Record.create([
                    {name: 'id' },
                    {name: 'value'}
                ])
            )
        }),
        iconCls: 'no-icon',
        onSelect: function(record, index){ // override default onSelect to do redirect
			if(this.fireEvent('beforeselect', this, record, index) !== false){
				this.setValue(record.data[this.valueField || this.displayField]);
				this.collapse();
				this.fireEvent('select', this, record, index);
			}

			/*
			document.getElementById("cliente").value=record.data.compania;
			document.getElementById("idcliente").value=record.data.id;	*/

            var grid = Ext.getCmp("panel-parametros");
            var records = grid.store.getModifiedRecords();
            if( records.length==0|| (records.length>0 && confirm("Perdera los cambios que no ha guardado")) ){

                var records = grid.store.getRange();
                var lenght = records.length;
                grid.store.commitChanges();

                grid.store.baseParams={ idccosto:record.data.id };
                grid.store.reload();
            }
        }

    });


    /*
    * Crea el expander
    */
    this.expander = new Ext.grid.RowExpander({
        lazyRender : false,
        width: 15,
        tpl : new Ext.Template(
          '<p><div class=\'btnComentarios\' id=\'obs_{_id}\'>&nbsp; {observaciones}</div></p>'

        )
    });

    this.checkColumn = new Ext.grid.CheckColumn({header:' ', dataIndex:'sel', width:25});
    <?
    if( $modo=="edicion" ){
    ?>
        this.fleteCheckColumn = new Ext.grid.CheckColumn({header:'Flete', dataIndex:'flete', width:25});
        this.recLocalCheckColumn = new Ext.grid.CheckColumn({header:'Rec. Local', dataIndex:'recargolocal', width:25});
        this.recOrigenCheckColumn = new Ext.grid.CheckColumn({header:'Rec. Origen', dataIndex:'recargoorigen', width:25});
        this.costoCheckColumn = new Ext.grid.CheckColumn({header:'Costo', dataIndex:'costo', width:25});

    <?
    }
    ?>
    this.ingresoPropioCheckColumn = new Ext.grid.CheckColumn({header:'Ing. Propio', dataIndex:'ingreso_propio', width:25});

    this.columns = [
       //this.expander,
       <?
       if( $modo=="fv" ){
       ?>
       this.checkColumn,
       <?
       }
       ?>

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
        renderer: this.formatItem
        <?
        if( $modo!="edicion" ){
        ?>
        ,sortable:true,
        <?
        }else{
        ?>
        ,sortable:false,
        editor: new Ext.form.TextField({
				allowBlank: false ,
				style: 'text-align:left'
			})
        <?
        }
        ?>

      }
      <?
      if( $modo=="edicion" ){
      ?>
      ,
      this.recLocalCheckColumn,
      this.recOrigenCheckColumn
      <?
      }
      if( $modo=="fv" ){
      ?>
      ,
      this.ingresoPropioCheckColumn
      ,
      {
        header: "Cuenta",
        dataIndex: 'cuenta',
        width: 50,
        hideable: false,
        sortable:true,
        editor: this.editorCuentas


      },

      {
        header: "% IVA",
        dataIndex: 'iva',
        width: 50,
        hideable: false,
        sortable:true,
        editor: new Ext.form.NumberField({
				allowBlank: false ,
				allowNegative: false,
				style: 'text-align:left',
				decimalPrecision :3
			})
      },
      {
        header: "Base retención",
        dataIndex: 'baseretencion',
        width: 50,
        hideable: false,
        sortable:true,
        editor: new Ext.form.NumberField({
				allowBlank: false ,
				allowNegative: false,
				style: 'text-align:left',
				decimalPrecision :3
			})
      },
      {
        header: "Cuenta Retencion",
        dataIndex: 'cuentaretencion',
        width: 50,
        hideable: false,
        sortable:true,
        editor: this.editorCuentas
      }
      /*,
      {
        header: "Valor",
        dataIndex: 'valor',
        width: 50,
        hideable: false,
        sortable:false,
        editor: new Ext.form.NumberField({
				allowBlank: false ,
				allowNegative: false,
				style: 'text-align:left',
				decimalPrecision :3
			})
      }*/

      /*,

      {
        header: "Convenios",
        dataIndex: 'cobrar_idm',
        width: 50,
        hideable: false,
        sortable:false,
        editor: <?=include_component("widgets", "monedas" ,array("id"=>""))?>
      },
      {
        header: "Autoretención",
        dataIndex: 'orden',
        width: 50
      },*/
      <?
      }
      if( $modo=="fc" ){
      ?>
      ,
      {
        header: "Cuenta",
        dataIndex: 'cuenta',
        width: 50,
        hideable: false,
        sortable:true,
        editor: this.editorCuentas


      }
      <?
      }
      ?>
      /*
      {
        header: "Tipo",
        dataIndex: 'orden',
        width: 50
      }
        ,
      {
        header: "Base",
        dataIndex: 'orden',
        width: 50
      }*/
     ];


    this.record = Ext.data.Record.create([
            {name: 'sel', type: 'bool'},
            {name: 'idconcepto', type: 'int', mapping: 'c_ca_idconcepto'},
            {name: 'concepto', type: 'string', mapping: 'c_ca_concepto'},
            {name: 'idccosto', type: 'string'},
            {name: 'modalidades', type: 'string'},
            {name: 'orden', type: 'string'},            
            {name: 'idcuenta', type: 'string', mapping: 'p_ca_idcuenta'},
            {name: 'cuenta', type: 'string', mapping: 'cu_ca_cuenta'},
            {name: 'ingreso_propio', type: 'bool', mapping: 'p_ca_ingreso_propio'},
            {name: 'iva', type: 'string', mapping: 'p_ca_iva'},
            {name: 'baseretencion', type: 'string', mapping: 'p_ca_baseretencion'},
            {name: 'cuentaretencion', type: 'string', mapping: 'cr_ca_cuentaretencion'},
            {name: 'idcuentaretencion', type: 'string', mapping: 'p_ca_idcuentaretencion'},
            {name: 'valor', type: 'float', mapping: 'p_ca_valor'},
            {name: 'recargolocal', type: 'bool', mapping: 'c_ca_recargolocal'},
            {name: 'recargoorigen', type: 'bool', mapping: 'c_ca_recargoorigen'},
            {name: 'flete', type: 'bool', mapping: 'c_ca_flete'},
            {name: 'costo', type: 'bool', mapping: 'c_ca_costo'}
        ]);

    this.store = new Ext.data.Store({

        autoLoad : false,
        url: '<?=url_for("parametros/datosPanelParametrosConceptos?modo=".$modo)?>',
        reader: new Ext.data.JsonReader(
            {
                root: 'root',
                totalProperty: 'totalCount'
            },
            this.record
        ),
        sortInfo:{field: 'orden', direction: "ASC"}
    });




    PanelParametros.superclass.constructor.call(this, {
       loadMask: {msg:'Cargando...'},
       clicksToEdit: 1,
       id: 'panel-parametros',
       plugins: [this.expander, this.checkColumn
              <?
              if( $modo=="edicion" ){
              ?>
              ,
              this.recLocalCheckColumn,
              this.recOrigenCheckColumn
              <?
              }
              if( $modo=="fv" ){
              ?>
                ,this.ingresoPropioCheckColumn
              <?
              }
              ?>
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
            celldblclick: this.onCelldblclick,
            afteredit: this.onAfteredit
       },
       tbar: [{
            text:'Guardar',
            iconCls: 'disk',
            scope:this,
            handler: this.guardarCambios
            }
            <?
            if( $modo!="edicion" ){
            ?>
            ,
            '-'
            ,this.combo

            <?
            }
            ?>

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

    var storePanelParametros = this.store;
    this.getColumnModel().isCellEditable = function(colIndex, rowIndex) {

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

    actualizarObservaciones = function( btn, text, obj ){
        if( btn=="ok" ){
            var record = activeRow;
            record.set("observaciones", text);
        }
    }



};

Ext.extend(PanelParametros, Ext.grid.EditorGridPanel, {
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
            changes['idccosto']=r.data.idccosto;
            changes['idconcepto']=r.data.idconcepto;


            if( r.data.concepto ){
                //envia los datos al servidor
                Ext.Ajax.request(
                    {
                        waitMsg: 'Guardando cambios...',
                        url: '<?=url_for("parametros/observePanelParametros?modo=".$modo)?>', 						//method: 'POST',
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
    ,
    formatItem: function(value, p, record) {

        return String.format(
            '<b>{0}</b>',
            value
        );

    },


    onValidateEdit : function(e){

        <?
        if( $modo=="fv" ){
        ?>
            var combo = Ext.getCmp("combo");
            var tipo = combo.getValue();
            if( tipo=="" ){
                alert("Por favor seleccione un Centro de costos");
                return false;
            }
        <?
        }
        ?>
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


        if( e.field == "cuenta" ){
            var rec = e.record;
            var ed = this.colModel.getCellEditor(e.column, e.row);
            var store = ed.field.store;

            store.each( function( r ){
                    if( r.data.idcuenta==e.value ){
                        e.record.set("idcuenta", r.data.idcuenta );
                        e.value = r.data.cuenta;
                        return true;
                    }
                }
            )
        }

        if( e.field == "cuentaretencion" ){
            var rec = e.record;
            var ed = this.colModel.getCellEditor(e.column, e.row);
            var store = ed.field.store;

            store.each( function( r ){
                    if( r.data.idcuenta==e.value ){
                        e.record.set("idcuentaretencion", r.data.idcuenta );
                        e.value = r.data.cuenta;
                        return true;
                    }
                }
            )
        }

        return true;
    }
    ,

    onRowcontextMenu: function(grid, index, e){
        rec = this.store.getAt(index);

        if(!this.menu){ // create context menu on first right click

            this.menu = new Ext.menu.Menu({
            id:'grid_productos-ctx',
            enableScrolling : false,
            items: [
                    /*{
                        text: 'Eliminar item',
                        iconCls: 'delete',
                        scope:this,
                        handler: this.eliminarItem
                    },*/
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

    eliminarItem : function(){
        if( this.ctxRecord  && this.ctxRecord.data.orden!="Z" && confirm("Desea continuar?") ){
            if( this.ctxRecord.data.idconcepto ){
                var idconcepto = this.ctxRecord.data.idconcepto;

                var id = this.ctxRecord.id;

                var storeConceptos = this.store;
                Ext.Ajax.request(
                {
                    waitMsg: 'Eliminando...',
                    url: '<?=url_for("parametros/eliminarPanelParametros?modo=".$modo)?>',
                    //method: 'POST',
                    //Solamente se envian los cambios
                    params :	{
                        id: id,
                        idconcepto: idconcepto
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
                            record = storeConceptos.getById( res.id );
                            storeConceptos.remove(record);
                        }
                    }


                });
            }else{ // No se ha guardado todavia
                record = this.store.getById( this.ctxRecord.id );
                this.store.remove(record);

            }
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
        <?
        //if($opcion!="consulta"){
        ?>
        var btn = e.getTarget('.btnComentarios');
        if (btn) {
            var t = e.getTarget();
            var v = this.view;
            var rowIdx = v.findRowIndex(t);
            var record = this.getStore().getAt(rowIdx);

            activeRow = record;
            this.ventanaObservaciones( record );
        }
        <?
        //}
        ?>
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
        if(!this.win){
            this.win = new ModalidadWindow({
                        });
            //this.win.on('validfeed', this.addFeed, this);
        }
        this.win.ctxRecord = record;
        this.win.show();
    },

    onAfteredit :  function(e) {

	/**
	* Copia los datos a las columnas seleccionadas
	**/
        if(e.record.data.sel){
            var records = this.store.getModifiedRecords();
            var lenght = records.length;
            var field = e.field;

            for( var i=0; i< lenght; i++){
                r = records[i];
                if(r.data.sel){
                    //alert( e.value );
                    if( field=="idconcepto"||field=="concepto"||field=="sel"  ){
                        continue;
                    }

                    r.set(field,e.value);


                    if(field == 'cuenta'){
                        r.set("idcuenta",e.record.data.idcuenta);
                    }

                    if(field == 'cuentaretencion'){
                        r.set("idcuentaretencion",e.record.data.idcuenta);
                    }
                }
            }
        }
    }




});

</script>