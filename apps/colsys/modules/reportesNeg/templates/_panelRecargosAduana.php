<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */



$recargos = $sf_data->getRaw("recargos");
//print_r($sf_data);
//exit;
//$aplicaciones = array("Valor Fijo","Sobre Flete","Sobre Flete + Recargos","Unitario x Peso/Volumen","Unitario x Pieza","Unitario x BLs/HAWBs");

include_component("reportesNeg","cotizacionRecargosAduanasWindow", array("reporte"=>$reporte));

?>
<script type="text/javascript">


PanelRecargosAduana = function( config ){

    Ext.apply(this, config);

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
                {name: 'idconcepto',  mapping: 'ca_idconcepto'},
                {name: 'concepto',  mapping: 'ca_concepto'}
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


    this.storeRecargos = new Ext.data.Store({
        autoLoad : true,
        url: '<?=url_for("conceptos/datosConceptos")?>',
        baseParams : {
            impoexpo: 'Aduanas',
            modo: "costos"
        },
        reader: new Ext.data.JsonReader(
            {
                root: 'root',
                totalProperty: 'total',
                successProperty: 'success'
            },
            Ext.data.Record.create([
                {name: 'idconcepto'},
                {name: 'concepto'}
            ])
        )
    });

    this.editorRecargos = new Ext.form.ComboBox({
        typeAhead: true,
        forceSelection: true,
        triggerAction: 'all',
        selectOnFocus: true,
        mode: 'local',
        displayField: 'concepto',
        valueField: 'idconcepto',
        lazyRender:true,
        listClass: 'x-combo-list-small',
        store : this.storeRecargos
    });

    this.storeParametros = new Ext.data.Store({
        autoLoad : false,
        url: '<?=url_for("cotizaciones/datosParametros")?>',
        reader: new Ext.data.JsonReader(
            {
                root: 'root',
                totalProperty: 'total',
                successProperty: 'success'
            },
            Ext.data.Record.create([
                {name: 'parametro'}
            ])
        )
    });
    this.editorParametros = new Ext.form.ComboBox({
        typeAhead: true,
        forceSelection: true,
        triggerAction: 'all',
        selectOnFocus: true,
        mode: 'local',
        displayField: 'parametro',
        valueField: 'parametro',
        lazyRender:true,
        listClass: 'x-combo-list-small',
        store : this.storeParametros
    });

    this.editorTipoAplicaciones = new Ext.form.ComboBox({

        typeAhead: true,
        forceSelection: true,
        triggerAction: 'all',
        selectOnFocus: true,
        mode: 'local',
        lazyRender:true,
        listClass: 'x-combo-list-small',
        store : [["$","$"],["%","%"]]
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

    this.columns = [
       this.expander,
       {
        header: "Concepto",
        dataIndex: 'item',
        hideable: false,
        sortable:false,
        width: 170,
        renderer: this.formatItem,
        editor: this.editorConceptos
      },
      {
        header: "Parametro",
        dataIndex: 'parametro',
        hideable: false,
        width: 170,
        renderer: this.formatItem,
        sortable: this.readOnly,
        editor: this.editorParametros
      },
        {
            header: "Tipo",
            dataIndex: 'tipo_app',
            width: 35,
            hideable: false,
            sortable:false,
            editor: this.editorTipoAplicaciones
        },
        {
        header: "Neto",
        dataIndex: 'netcosto',
        width: 80,
        hideable: false,
        sortable:false,
        editor: new Ext.form.NumberField({
				allowBlank: false ,
				allowNegative: false,
				style: 'text-align:left',
				decimalPrecision :3
			})
      }
        ,
      {
        header: "Valor",
        dataIndex: 'vlrcosto',
        width: 80,
        hideable: false,
        sortable:false,
        editor: new Ext.form.NumberField({
				allowBlank: false ,
				allowNegative: false,
				style: 'text-align:left',
				decimalPrecision :3
			})
      },
      {
        header: "Minimo",
        dataIndex: 'mincosto',
        width: 80,
        hideable: false,
        sortable:false,
        editor: new Ext.form.NumberField({
				allowBlank: false ,
				allowNegative: false,
				style: 'text-align:left',
				decimalPrecision :3
			})
      },

        {
            header: "Moneda",
            dataIndex: 'idmoneda',
            width: 90,
            hideable: false,
            sortable:false,
            editor: <?=include_component("widgets", "monedas" ,array("id"=>""))?>
        }

     ];


    this.record = Ext.data.Record.create([
            {name: 'idreporte', type: 'int'},
            {name: 'iditem', type: 'int'},
            {name: 'idconcepto', type: 'int'},
            {name: 'parametro', type: 'string'},
            {name: 'tipo', type: 'string'},
            {name: 'tipo_app', type: 'string'},
            {name: 'item', type: 'string'},
            {name: 'idmoneda', type: 'string'},
            {name: 'vlrcosto', type: 'float'},
            {name: 'mincosto', type: 'float'},            
            {name: 'observaciones', type: 'string'},
            {name: 'orden', type: 'string'}
        ]);

    this.store = new Ext.data.Store({

        autoLoad : true,
        url: '<?=url_for("reportesNeg/panelRecargosAduanaData?id=".$reporte->getCaIdreporte())?>',
        reader: new Ext.data.JsonReader(
            {

                root: 'items',
                totalProperty: 'total'
            },
            this.record
        ),
        sortInfo: {
            field: 'orden',
            direction: 'ASC' 
        }
    });

    


    PanelRecargosAduana.superclass.constructor.call(this, {
       loadMask: {msg:'Cargando...'},
       clicksToEdit: 1,
       id: 'idPanelRecargosAduana',

       plugins: [this.expander],
       view: new Ext.grid.GridView({

            forceFit:true,
            enableRowBody:true,
            showPreview:true
       }),
       listeners:{
            validateedit: this.onValidateEdit,
            beforeedit: this.onBeforeEdit,
            rowcontextmenu: this.onRowcontextMenu,           
            dblclick:this.onDblClickHandler
        },
        boxMinHeight: 400,
        tbar:[
            <?
            //if($editable)
            {
            ?>
            {
				text:'Guardar',
				iconCls:'disk',
				handler: this.guardarCambios
			},
            <?
            }
            ?>
            {
                text: 'Recargar',
                tooltip: 'Recarga los datos de la base de datos',
                iconCls: 'refresh',  
                scope: this,
                handler: function(){
					Ext.getCmp('idPanelRecargosAduana').store.reload();
				}
            }
            ]
    });

    var storePanelRecargosAduana = this.store;
    this.getColumnModel().isCellEditable = function(colIndex, rowIndex) {
        
        var record = storePanelRecargosAduana.getAt(rowIndex);
        var field = this.getDataIndex(colIndex);

        if( !record.data.iditem && field!="item" ){
            return false;
        }

        if( record.data.iditem && field=="item" ){
            return false;
        }
        
        return Ext.grid.ColumnModel.prototype.isCellEditable.call(this, colIndex, rowIndex);
    }

    actualizarObservaciones = function( btn, text, obj ){
        if( btn=="ok" ){
            var record = activeRow;
            record.set("observaciones", text);
        }
    }

};

Ext.extend(PanelRecargosAduana, Ext.grid.EditorGridPanel, {
    guardarCambios: function(){
        var store = Ext.getCmp('idPanelRecargosAduana').store;

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

            changes['id']=r.id;
            changes['tipo']='costo';
            changes['iditem']=r.data.iditem;
            changes['idconcepto']=r.data.idconcepto;
            changes['idreporte']=r.data.idreporte;
            changes['tipo_app']=r.data.tipo_app;

            
            if( r.data.iditem ){
                Ext.Ajax.request(
                    {
                        waitMsg: 'Guardando cambios...',
                        url: '<?=url_for("reportesNeg/observePanelRecargosAduana")?>',
                        params :	changes,

                        callback :function(options, success, response){

                            var res = Ext.util.JSON.decode( response.responseText );
                            if( res.id && res.success){
                                var rec = store.getById( res.id );
                                rec.commit();
                            }
                        }
                     }
                );
            }
        }
    },
    onBeforeEdit: function(e){

        /*if( e.field=="aplicacion" || e.field=="aplicacionminimo" ){
            var data = [
                <?
                $i=0;
                foreach( $aplicaciones as $aplicacion ){
                    if( $i++!=0){
                        echo ",";
                    }
                ?>
                    ['<?=$aplicacion?>']
                <?
                }
                ?>
            ];

            var ed = this.colModel.getCellEditor(e.column, e.row);
            ed.field.store.loadData( data );
        }
        else */if( e.field == "parametro" ){
            this.storeParametros.removeAll();
            this.storeParametros.setBaseParam("idconcepto",e.record.data.iditem);
            this.storeParametros.load();
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
        if( e.field == "parametro" ){
            var rec = e.record;
            var recordConcepto = this.record;
            var storeConcepto = this.store;
            var store = this.store;
            var lenght = this.store.data.length;
            var records = store.getRange();
        }
        else if( e.field == "item"){

            var rec = e.record;
            var ed = this.colModel.getCellEditor(e.column, e.row);
            var store = ed.field.store;

            var recordConcepto = this.record;
            var storeGrid = this.store;


            var lenght = storeGrid.data.length;
            var records = storeGrid.getRange();

            store.each( function( r ){
                   
                    if( r.data.idconcepto==e.value ){                        
                        if( !rec.data.iditem ){
                            var newRec = new recordConcepto({

                               idreporte: '<?=$reporte->getCaIdreporte()?>',

                                item: '+',
                                iditem: '',
                                tipo: 'costo',
                                parametro: '',
                                vlrcosto: '',
                                mincosto: '',
                                orden: 'Z' 
                            });           
                            rec.set("iditem", r.data.idconcepto);
                            rec.set("idconcepto", r.data.idconcepto);
                            rec.set("item", r.data.concepto);
                            rec.set("parametro", '');
                            rec.set("tipo", "costo");

                            rec.set("vlrcosto", '');
                            rec.set("idmoneda", '');
                            rec.set("mincosto", '');
                            storeGrid.addSorted(newRec);
                            storeGrid.sort("orden", "ASC");

                        }else{                            
                            rec.set("iditem", r.data.idconcepto);
                        }
                        e.value = r.data.concepto;

                        return true;
                    }
                }
            )
        }
    }
    ,

    onRowcontextMenu: function(grid, index, e){
        rec = this.store.getAt(index);

        if(!this.menu){

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
        if( this.ctxRecord && this.ctxRecord.data.iditem && confirm("Desea continuar?") ){
           
            var iditem = this.ctxRecord.data.iditem;
                        var id = this.ctxRecord.id;
            var tipo = this.ctxRecord.data.tipo;
            
            var storeConceptosFletes = this.store;
            Ext.Ajax.request(
            {
                waitMsg: 'Eliminando...',
                url: '<?=url_for("reportesNeg/eliminarRecargosAduana?idreporte=".$reporte->getCaIdreporte())?>',
                params :	{
                    id: id,                    
                    iditem: iditem,
                    tipo: tipo
                    
                    
                },
                failure:function(response,options){
                    alert( response.responseText );
                    success = false;
                },
                success:function(response,options){
                    var res = Ext.util.JSON.decode( response.responseText );
                    if( res.success ){
                        record = storeConceptosFletes.getById( res.id );
                        storeConceptosFletes.remove(record);                        
                    }
                }
            });
            
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
    },
    importarCotizacion: function(){
        if( !this.win ){
            this.win = new CotizacionRecargosAduanasWindow();
        }
        this.win.show();
    }
});
</script>