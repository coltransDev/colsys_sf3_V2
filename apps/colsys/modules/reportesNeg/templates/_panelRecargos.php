<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
$recargos = $sf_data->getRaw("recargos");

$aplicaciones = array("Valor Fijo","Sobre Flete","Sobre Flete + Recargos","Unitario x Peso/Volumen","Unitario x Pieza","Unitario x BLs/HAWBs","TM3");

include_component("reportesNeg","cotizacionRecargosWindow", array("reporte"=>$reporte));
?>
<script type="text/javascript">


PanelRecargos = function( config ){

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

    this.storeEquipos = new Ext.data.Store({
        autoLoad : true,
        url: '<?=url_for("conceptos/datosConceptos")?>',
        baseParams:{
               transporte:"<?=Constantes::MARITIMO?>",
               modalidad:"<?=Constantes::FCL?>",
               impoexpo:"<?=Constantes::IMPO?>"
        },
        reader: new Ext.data.JsonReader({
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
    this.editorEquipos = new Ext.form.ComboBox({
        fieldLabel: 'Equipo',
        typeAhead: true,
        forceSelection: true,
        triggerAction: 'all',
        selectOnFocus: true,
        name: 'equipo',
        id: 'idequipo',
        mode: 'local',
        displayField: 'concepto',
        valueField: 'idconcepto',
        lazyRender:true,
        listClass: 'x-combo-list-small',
        store : this.storeEquipos
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
            header: "Concepto ",
            dataIndex: 'item',
            hideable: false,
            sortable:false,
            width: 120,
            renderer: this.formatItem,
            editor: this.editorConceptos
        },
        {
            id: 'equipo',
            header: "Equipo",
            width: 120,
            sortable: false,
            dataIndex: 'equipo',
            hideable: false,
            editor: this.editorEquipos
        },
        {
            header: "Aplicacion",
            dataIndex: 'aplicacion',
            width: 80,
            hideable: false,
            sortable:false,
            editor: <?=include_component("widgets", "emptyCombo" ,array("id"=>""))?>
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
            {name: 'idequipo', type: 'string'},
            {name: 'equipo', type: 'string'},
            {name: 'aplicacion', type: 'string'},
            {name: 'tipo_app', type: 'string'},
            {name: 'item', type: 'string'},
            {name: 'cantidad', type: 'int'},            
            {name: 'cobrar_tar', type: 'float'},
            {name: 'cobrar_min', type: 'float'},
            {name: 'cobrar_idm', type: 'string'},
            {name: 'observaciones', type: 'string'},
            {name: 'tipo', type: 'string'},
            {name: 'orden', type: 'string'}
        ]);

    this.store = new Ext.data.Store({

        autoLoad : true,
        url: '<?=url_for("reportesNeg/panelRecargosData?id=".$reporte->getCaIdreporte())?>',
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

    


    PanelRecargos.superclass.constructor.call(this, {
       loadMask: {msg:'Cargando...'},
       clicksToEdit: 1,
       id: 'panel-recargos',
       plugins: [this.expander],
       view: new Ext.grid.GridView({

            forceFit:true,
            enableRowBody:true,
            showPreview:true
       }),
       listeners:{
            validateedit: this.onValidateEdit,
            rowcontextmenu: this.onRowcontextMenu,           
            dblclick:this.onDblClickHandler,
            beforeedit: this.onBeforeEdit,
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
					Ext.getCmp('panel-recargos').store.reload();
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

    var storePanelRecargos = this.store;
    this.getColumnModel().isCellEditable = function(colIndex, rowIndex) {
        
        var record = storePanelRecargos.getAt(rowIndex);
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

Ext.extend(PanelRecargos, Ext.grid.EditorGridPanel, {
    guardarCambios: function(){

        var store = Ext.getCmp('panel-recargos').store;

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
            changes['tipo']=r.data.tipo;
            changes['iditem']=r.data.iditem;
            changes['idconcepto']=r.data.idconcepto;
            changes['idreporte']=r.data.idreporte;
            changes['ca_recargoorigen']="false";
            changes['idequipo']=r.data.idequipo;

            
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
                    tipo:"All-recargos"
                },

                failure:function(response,options){
                    alert( response.responseText );
                    success = false;
                },

                success:function(response,options){
                    Ext.getCmp('panel-recargos').store.reload();
                }



            });
        }


    }
    ,
    formatItem: function(value, p, record) {
        
        return String.format(
            '<b>{0}</b>',
            value
        );
        
    },

    onBeforeEdit: function(e){
        


        if( e.field=="aplicacion" || e.field=="aplicacion_min" ){
            var dataAereo = [
                <?
                $i=0;
                foreach( $aplicacionesAereo as $aplicacion ){
                    if( $i++!=0){
                        echo ",";
                    }
                ?>
                    ['<?=$aplicacion->getCaValor()?>']
                <?
                }
                ?>
            ];

            var dataMaritimo = [
                <?
                $i=0;
                foreach( $aplicacionesMaritimo as $aplicacion ){
                    if( $i++!=0){
                        echo ",";
                    }
                ?>
                    ['<?=$aplicacion->getCaValor()?>']
                <?
                }
                ?>
            ];

            var dataParametros = new Array();
            //alert(e.record.data.toSource());
                <?
                $i=0;
                foreach( $parametros as $aplicacion ){
                ?>
                    if('<?=strtolower(trim($aplicacion->getCaValor()))?>'==e.record.data.item.replace(/^\s*|\s*$/g,"").toLowerCase())
                    {
                        <?
                        $rangos = explode("|", $aplicacion->getcaValor2() );
                        foreach( $rangos as $rango ){
                        ?>
                        dataParametros.push('<?=$rango?>');
                        <?
                        }
                        //break;
                        ?>

                    }
                <?
                }
                ?>


            var ed = this.colModel.getCellEditor(e.column, e.row);
            //alert(e.record.data.toSource());
            //alert(e.record.data.recargo);
            if(dataParametros.length>0)
            {
                ed.field.store.loadData( dataParametros );
            }
            else if( this.transporte=="<?=Constantes::AEREO?>" ){
                ed.field.store.loadData( dataAereo );
            }else{
                ed.field.store.loadData( dataMaritimo );
            }
        }
    },

    
    onValidateEdit : function(e){
        var rec = e.record;
        var ed = this.colModel.getCellEditor(e.column, e.row);
        var store = ed.field.store;

        var recordConcepto = this.record;
        var storeGrid = this.store;
        if( e.field == "item"){            
            store.each( function( r ){
                    var existe = false;
                    if( r.data.idconcepto==e.value ){

                        recordsConceptos = storeGrid.getRange();
                        for( var j=0; j< recordsConceptos.length&&!existe; j++){

                            if( recordsConceptos[j].data.iditem==r.data.idconcepto && recordsConceptos[j].data.idequipo==r.data.idequipo){
                                existe=true;
                            }

                        }
                        if( !existe ){

                            if( !rec.data.iditem ){
                                var newRec = new recordConcepto({

                                   idreporte: '<?=$reporte->getCaIdreporte()?>',

                                   item: '+',
                                   iditem: '',
                                   idconcepto: '9999',
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
                                   orden: 'Z' 
                                });



                                rec.set("iditem", r.data.idconcepto);
                                rec.set("idconcepto", r.data.idconcepto);
                                rec.set("tipo_app", "$");
                                rec.set("aplicacion", "");
                                rec.set("cobrar_tar", 0);
                                rec.set("cobrar_min", 0);
                                rec.set("cobrar_idm", "USD");
                                rec.set("orden", "Y-Z");
                                storeGrid.addSorted(newRec);
                                storeGrid.sort("orden", "ASC");

                            }
                            else if( e.field == "equipo"){
                               store.each( function( r ){
                                       if( r.data.idconcepto==e.value ){
                                           rec.set("idequipo", r.data.idconcepto );
                                           e.value = r.data.concepto;
                                           return true;
                                       }
                                   });
                            }
                            else{
                                rec.set("idmoneda", "USD");
                                rec.set("iditem", r.data.idconcepto);
                            }
                            e.value = r.data.concepto;

                            return true;
                        }else{
                            alert("Esta tratando de agregar un concepto que ya existe");
                            e.value = "+";
                            return false;
                        }
                    }
                }
            )
        }
        else if( e.field == "equipo"){

            store.each( function( r ){
                    if( r.data.idconcepto==e.value ){
                        rec.set("idequipo", r.data.idconcepto );
                        e.value = r.data.concepto;
                        return true;
                    }
                });
         }
    }
    ,

    onRowcontextMenu: function(grid, index, e){
        rec = this.store.getAt(index);

        if(!this.menu){
            this.menu = new Ext.menu.Menu({
            id:'grid-recargos-ctx',
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
                            * petici�n son borrados de la base de datos.
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
            this.win = new CotizacionRecargosWindow();
        }
        this.win.show();
    }
});
</script>