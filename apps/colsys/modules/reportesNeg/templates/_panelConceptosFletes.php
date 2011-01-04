<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
$conceptos = $sf_data->getRaw("conceptos");
$recargos = $sf_data->getRaw("recargos");

//$aplicaciones = array("Valor Fijo","Sobre Flete","Sobre Flete + Recargos","Unitario x Peso/Volumen","Unitario x Pieza","Unitario x BLs/HAWBs");
$aplicaciones = array();
foreach( $aplicaciones1 as $aplicacion ){
    $aplicaciones[]=$aplicacion->getCaValor();
}


include_component("reportesNeg","cotizacionWindow", array("reporte"=>$reporte));
?>
<script type="text/javascript">
PanelConceptosFletes = function( config ){

    Ext.apply(this, config);

    this.storeConceptos = new Ext.data.Store({
        autoLoad : false,
        proxy: new Ext.data.MemoryProxy( [] ),
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

    this.editorAplicaciones = new Ext.form.ComboBox({

        typeAhead: true,
        forceSelection: true,
        triggerAction: 'all',
        selectOnFocus: true,
        mode: 'local',
        lazyRender:true,
        listClass: 'x-combo-list-small',
        store : [
                    <?
                    $i=0;
                    foreach( $aplicaciones as $aplicacion ){
                        if($i++!=0){
                            echo ",";
                        }

                    ?>
                    ['<?=$aplicacion?>','<?=$aplicacion?>']
                    <?
                    }
                    ?>
                ]
    });


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
        header: "Aplicacion",
        dataIndex: 'aplicacion',
        width: 80,
        hideable: false,
        sortable:false,
        editor: this.editorAplicaciones
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
        header: "Cantidad",
        dataIndex: 'cantidad',
        width: 50,
        hideable: false,
        sortable:false,
        editor: new Ext.form.NumberField({
				allowBlank: false ,
				allowNegative: false,
				style: 'text-align:left',
				decimalPrecision :2
			})
      },
      {
        header: "Neta",
        dataIndex: 'neta_tar',
        width: 50,
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
        header: "Minima",
        dataIndex: 'neta_min',
        width: 50,
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
        dataIndex: 'neta_idm',
        width: 50,
        hideable: false,
        sortable:false,
        editor: <?=include_component("widgets", "monedas" ,array("id"=>""))?>
      },
      {
        header: "Reportar",
        dataIndex: 'reportar_tar',
        width: 50,
        hideable: false,
        sortable:false,
        renderer: this.formatItem1,
        editor: new Ext.form.NumberField({
				allowBlank: false ,
				allowNegative: false,
				style: 'text-align:left',
				decimalPrecision :3
			})
      },
      {
        header: "Minima",
        dataIndex: 'reportar_min',
        width: 50,
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
        dataIndex: 'reportar_idm',
        width: 50,
        hideable: false,
        sortable:false,
        editor: <?=include_component("widgets", "monedas" ,array("id"=>""))?>
      },

      {
        header: "Cobrar",
        dataIndex: 'cobrar_tar',
        width: 50,
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
        header: "Minima",
        dataIndex: 'cobrar_min',
        width: 50,
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
        dataIndex: 'cobrar_idm',
        width: 50,
        hideable: false,
        sortable:false,
        editor: <?=include_component("widgets", "monedas" ,array("id"=>""))?>
      }
     ];


    this.record = Ext.data.Record.create([
            {name: 'idreporte', type: 'int'},
            {name: 'iditem', type: 'int'},
            {name: 'idconcepto', type: 'int'},
            {name: 'aplicacion', type: 'string'},
            {name: 'tipo_app', type: 'string'},
            {name: 'item', type: 'string'},
            {name: 'cantidad', type: 'int'},
            {name: 'neta_tar', type: 'float'},
            {name: 'neta_min', type: 'float'},
            {name: 'neta_idm', type: 'string'},
            {name: 'reportar_tar', type: 'float'},
            {name: 'reportar_min', type: 'float'},
            {name: 'reportar_idm', type: 'string'},
            {name: 'cobrar_tar', type: 'float'},
            {name: 'cobrar_min', type: 'float'},
            {name: 'cobrar_idm', type: 'string'},
            {name: 'observaciones', type: 'string'},
            {name: 'tipo', type: 'string'},
            {name: 'orden', type: 'string'}

        ]);

    this.store = new Ext.data.Store({
        autoLoad : true,
        url: '<?=url_for("reportesNeg/panelConceptosData?id=".$reporte->getCaIdreporte())?>',
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


    PanelConceptosFletes.superclass.constructor.call(this, {
       loadMask: {msg:'Cargando...'},
       clicksToEdit: 1,
       id: 'panel-conceptos-fletes',
       plugins: [this.expander],
       view: new Ext.grid.GridView({

            forceFit:true,
            enableRowBody:true,
            showPreview:true
       }),
       listeners:{
            validateedit: this.onValidateEdit,
            rowcontextmenu: this.onRowcontextMenu,
            beforeedit:this.onBeforeEdit,
            dblclick:this.onDblClickHandler
        },
        boxMinHeight: 400,
        tbar:[
            <?
            if($editable)
            {
            ?>
                    {
				text:'Guardar',
				iconCls:'disk',
				handler: this.guardarCambios
			},
                        {
				text:'Borrar Todo',
				iconCls:'delete',
				handler: this.borrarTodos
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
					Ext.getCmp('panel-conceptos-fletes').store.reload();
				}
            }
            <?            
            if($reporte->getCaIdproducto())
            {            
            ?>
            ,
            {
				text:'Importar',
				iconCls: 'import',
				handler: this.importarCotizacion
			}

            <?
            }
            ?>
            ]
    });

    var storePanelConceptosFletes = this.store;
    this.getColumnModel().isCellEditable = function(colIndex, rowIndex) {
        
        var record = storePanelConceptosFletes.getAt(rowIndex);
        var field = this.getDataIndex(colIndex);

        if( !record.data.iditem && field!="item" ){
            return false;
        }

        if( record.data.iditem && field=="item" ){
            return false;
        }

        if( record.data.iditem == 9999 && record.data.tipo=="concepto" ){
            return false;
        }

        if( record.data.tipo=="concepto" && (field=="tipo_app" || field=="aplicacion") ){
            return false;
        }

        if( record.data.tipo=="recargo" && (field=="cantidad" || field=="neta_idm" || field=="reportar_idm_idm") ){
            return false;
        }

        return Ext.grid.ColumnModel.prototype.isCellEditable.call(this, colIndex, rowIndex);
    }

    actualizarObservaciones = function( btn, text, obj ){
        if( btn=="ok" ){
            //var record = storePanelConceptosFletes.getAt(activeRow);
            activeRow.set("observaciones", text);
            //record.set("observaciones", text);
        }
    }
   


};
var activeRow;
Ext.extend(PanelConceptosFletes, Ext.grid.EditorGridPanel, {
    guardarCambios: function(a,b){
        
        var store = Ext.getCmp('panel-conceptos-fletes').store;
        var records = store.getModifiedRecords();
			
        var lenght = records.length;
        
        for( var i=0; i< lenght; i++){
            r = records[i];

            var changes = r.getChanges();
            changes['id']=r.id;
            changes['tipo']=r.data.tipo;
            changes['iditem']=r.data.iditem;
            changes['idconcepto']=r.data.idconcepto;
            changes['idreporte']=r.data.idreporte;
            changes['ca_recargoorigen']="true";            
            changes['reportar_tar']=r.data.reportar_tar;
            changes['neta_tar']=r.data.neta_tar;
            changes['neta_min']=r.data.neta_min;
            changes['reportar_min']=r.data.reportar_min;            
            changes['cobrar_min']=r.data.cobrar_min;
            changes['cobrar_tar']=r.data.cobrar_tar;


            if( r.data.iditem ){                
                Ext.Ajax.request(
                    {
                        waitMsg: 'Guardando cambios...',
                        url: '<?=url_for("reportesNeg/observePanelConceptoFletes")?>',
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
    }
    ,
    borrarTodos : function(a,b){
        if( confirm("Desea continuar?") ){
            Ext.Ajax.request(
            {
                waitMsg: 'Eliminando...',
                url: '<?=url_for("reportesNeg/eliminarPanelConceptosFletes")?>',
                params :
                {
                    idreporte: '<?=$reporte->getCaIdreporte()?>',
                    tipo:"All-conceptos"
                },

                failure:function(response,options){
                    alert( response.responseText );
                    success = false;
                },

                success:function(response,options){
                    Ext.getCmp('panel-conceptos-fletes').store.reload();
                }



            });
        }


    }
    ,
    formatItem: function(value, p, record) {

        if( record.data.tipo == "recargo" ){
            return String.format(
                '<div class="recargo">{0}</div>',
                value
            );
        }else{
            return String.format(
                '<b>{0}</b>',
                value
            );
        }
    },

    onBeforeEdit: function( e ){
        
        if(e.field=="item"){
           this.dataConceptos = <?=json_encode(array("root"=>$conceptos))?>;
           this.dataRecargos = <?=json_encode(array("root"=>$recargos))?>;


           var ed = this.colModel.getCellEditor(e.column, e.row);
            if( e.record.data.tipo=="concepto" ){
                ed.field.store.loadData( this.dataConceptos );
            }else{
                ed.field.store.loadData( this.dataRecargos );
            }

        }
    }
    ,
    onValidateEdit : function(e){
        if( e.field == "item"){
            
            var rec = e.record;
            var ed = this.colModel.getCellEditor(e.column, e.row);
            var store = ed.field.store;

            var recordConcepto = this.record;
            var storeGrid = this.store;

            store.each( function( r ){                   
                    if( r.data.idconcepto==e.value ){      
                        
                        var existe = false;
                        recordsConceptos = storeGrid.getRange();
                        for( var j=0; j< recordsConceptos.length&&!existe; j++){
                            if( recordsConceptos[j].data.tipo=="concepto" ){
                                if(recordsConceptos[j].data.tipo==r.data.tipo)
                                {
                                if( recordsConceptos[j].data.iditem==r.data.idconcepto){
                                    existe=true;                                    
                                }
                                }
                            }

                            if( recordsConceptos[j].data.tipo=="recargo" ){
                                if( recordsConceptos[j].data.iditem==r.data.idconcepto && recordsConceptos[j].data.idconcepto==rec.data.idconcepto ){
                                    existe=true;                                    
                                }
                            }
                        }

                        if( !existe ){
                            if( !rec.data.iditem && rec.data.tipo=="concepto" ){
                                var newRec = new recordConcepto({

                                   idreporte: '<?=$reporte->getCaIdreporte()?>',

                                   item: '+',
                                   iditem: '',
                                   tipo: 'concepto',
                                   cantidad: '',
                                   neta_tar: '',
                                   neta_min: '',
                                   neta_idm: '',
                                   reportar_tar: '',
                                   reportar_min: '',
                                   reportar_idm: '',
                                   cobrar_tar: '',
                                   cobrar_min: '',
                                   cobrar_idm: '',
                                   detalles: '',
                                   orden: 'Z' 
                                });


                                newRec.data.concepto = "";
                                if( r.data.idconcepto=="9999" ){
                                    rec.set("orden", "Y");
                                    rec.set("iditem", "9999");
                                    rec.commit();
                                }else{
                                    rec.set("iditem", r.data.idconcepto);
                                    rec.set("idconcepto", r.data.idconcepto);
                                    rec.set("neta_tar", 0);
                                    rec.set("neta_min", 0);
                                    rec.set("neta_idm", "USD");
                                    rec.set("reportar_tar", 0);
                                    rec.set("reportar_min", 0);
                                    rec.set("reportar_idm", "USD");
                                    rec.set("cobrar_tar", 0);
                                    rec.set("cobrar_min", 0);
                                    rec.set("cobrar_idm", "USD");
                                    rec.set("orden", r.data.concepto);                                    
                                }
                                storeGrid.addSorted(newRec);
                                storeGrid.sort("orden", "ASC");

                            }else{
                                rec.set("idmoneda", "USD");
                                rec.set("iditem", r.data.idconcepto);
                            }
                            e.value = r.data.concepto;
                        }else{
                            alert("Esta agregando un concepto que ya existe");
                            e.value = "+";
                            return false;
                        }
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
                        text: 'Nuevo recargo',
                        iconCls: 'textfield_add',
                        scope:this,
                        handler: this.nuevoRecargo
                    },
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
            if( this.ctxRecord.data.tipo=="concepto" ){
                var idconcepto = this.ctxRecord.data.iditem;
                var idrecargo = "";
            }else{
                var idconcepto = this.ctxRecord.data.idconcepto;
                var idrecargo = this.ctxRecord.data.iditem;
            }



            var id = this.ctxRecord.id;
            var tipo = this.ctxRecord.data.tipo;
            var idreporte = this.ctxRecord.data.idreporte;
            
            var storeConceptosFletes = this.store;
            Ext.Ajax.request(
            {
                waitMsg: 'Eliminando...',
                url: '<?=url_for("reportesNeg/eliminarPanelConceptosFletes?idreporte=".$reporte->getCaIdreporte())?>',
                params :	{
                    id: id,
                    idconcepto: idconcepto,
                    idrecargo: idrecargo,
                    tipo: tipo,
                    idreporte: idreporte
                    
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
                        if(record.data.tipo=="concepto"){
                            storeConceptosFletes.remove(record);

                            /*
                            * Se deben eliminar los recargos del concepto que se elimino ya que al enviar la
                            * petición son borrados de la base de datos.
                            */
                            storeConceptosFletes.each( function( r ){                                
                                if( r.data.tipo=="recargo" && r.data.idconcepto==record.data.iditem ){
                                    
                                    storeConceptosFletes.remove(r);
                                }
                            });
                        }
                    }
                }



            });
            
        }
    }
    ,
    nuevoRecargo: function(){
        rec = this.ctxRecord;
        if( rec.data.tipo=="recargo"){
            alert("Solo pueda agregar un recargo sobre un concepto de flete");
        }
        
        if( rec.data.tipo=="concepto"){

            var idconcepto = rec.data.iditem;
            
            
            if( idconcepto=="9999" ){
                var orden = "Y-Z";
            }
            else{
                var orden = rec.data.orden+"-Z";
            }
            var newRec = new this.record({

                                   idreporte: '<?=$reporte->getCaIdreporte()?>',
                                   item: '+',
                                   iditem: '',
                                   idconcepto: idconcepto,
                                   tipo: 'recargo',
                                   cantidad: '',
                                   neta_tar: '',
                                   neta_min: '',
                                   neta_idm: '',
                                   reportar_tar: '',
                                   reportar_min: '',
                                   reportar_idm: '',
                                   cobrar_tar: '',
                                   cobrar_min: '',
                                   cobrar_idm: '',
                                   detalles: '',
                                   orden: orden 
                                });

            this.store.addSorted(newRec);
            this.store.sort("orden", "ASC");

            newRec = this.store.getById( newRec.id );
            newRec.set("tipo_app", "$");
            newRec.set("neta_tar", 0);
            newRec.set("neta_min", 0);
            newRec.set("reportar_tar", 0);
            newRec.set("reportar_min", 0);
            newRec.set("cobrar_tar", 0);
            newRec.set("cobrar_min", 0);
            newRec.set("cobrar_idm", "USD");
            newRec.set("aplicacion", "<?=$aplicaciones[0]?>");


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
        
        var btn = e.getTarget('.btnComentarios');
        if (btn) {
            var t = e.getTarget();
            var v = this.view;
            var rowIdx = v.findRowIndex(t);
            var record = this.getStore().getAt(rowIdx);

            activeRow = record;
            this.ventanaObservaciones( record );
        }        
    },
    ventanaObservaciones : function( record ){
        activeRow = record;
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
            this.win = new CotizacionWindow();
        }
        this.win.show();
    },/*
    importarCotizacionOTM: function(){
        if( !this.win ){
            this.win1 = new CotizacionWindow({tipo:'OTM/DTA'});
        }
        this.win1.show();
    }
*/
   formatItem1: function(value, p, record) {

        return String.format(
            '<div style="background-color: #E9CCE9">{0}</div>',
            value
        );

    }

});

</script>
