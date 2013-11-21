<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

if(!isset($modo) || $modo!="consulta")
{
    include_component("pricing", "panelTarifarioAduanaCliente");
    $modo="";
}
?>

<script type="text/javascript">

PanelTarifarioAduana = function( config ){

    Ext.apply(this, config);

    /*
    * Crea el expander
    */
   this.checkColumn = new Ext.grid.CheckColumn({header:' ', dataIndex:'sel', width:30});
   
    this.expander = new Ext.grid.RowExpander({
        lazyRender : false,
        width: 15,
        tpl : new Ext.Template(
          '<p><div class=\'btnComentarios\' id=\'obs_{_id}\'>&nbsp; {observaciones}</div></p>'
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

            if( record.data.observaciones!='' ){
                this.state[record.id]=true;
            }

            return this.state[record.id] ? 'x-grid3-row-expanded '+color : 'x-grid3-row-collapsed '+color;
        },
        getBodyContent : function(record, index){

            if(!this.enableCaching){
                return this.tpl.apply(record.data);
            }
            var content = this.bodyContent[record.id];
            //if(!content){  //hace que los comentarios no se borren cuando se guarda
                content = this.tpl.apply(record.data);

                //alert( content.split("\n").join("<br />") );
                this.bodyContent[record.id] = content;
            //}
            return content;
        }
    });


    /*
    *Store que carga los conceptos
    */
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


    this.columns = [
       <?
        if($modo=="consulta"){
        ?>
        this.checkColumn,
        <?
        }
        ?>
      this.expander,
      {
        header: "Concepto",
        dataIndex: 'concepto',
        hideable: false,
        width: 170,
        renderer: this.formatItem,
        sortable: this.readOnly,
        editor: this.editorRecargos
      },
      {
        header: "Parámetro",
        dataIndex: 'parametro',
        hideable: false,
        width: 170,
        renderer: this.formatItem,
        sortable: this.readOnly,
        editor: this.editorParametros
      },
      {
        header: "Valor",
        dataIndex: 'valor',
        hideable: false,
        width: 170,
        sortable: this.readOnly,
        renderer: this.renderNumber,
        editor: new Ext.form.NumberField({
            allowBlank: false ,
            allowNegative: false,
            style: 'text-align:left',
            decimalPrecision :0
        })
      },
      {
        header: "Aplicación",
        dataIndex: 'aplicacion',
        hideable: false,
        width: 170,
        sortable: this.readOnly,
        editor: <?=include_component("widgets", "emptyCombo" ,array("id"=>""))?>
      },
      {
        header: "Valor Mínimo",
        dataIndex: 'valorminimo',
        hideable: false,
        width: 170,
        sortable: this.readOnly,
        renderer: this.renderNumber,
        editor: new Ext.form.NumberField({
            allowBlank: false ,
            allowNegative: false,
            style: 'text-align:left',
            decimalPrecision :0
        })
      },
      {
        header: "Aplicación Min",
        dataIndex: 'aplicacionminimo',
        hideable: false,
        width: 170,
        sortable: this.readOnly,
        editor: <?=include_component("widgets", "emptyCombo" ,array("id"=>""))?>
      }
      
      

     ];



    this.record = Ext.data.Record.create([
            {name: 'sel', type: 'bool'},
            {name: 'consecutivo', type: 'int'},
            {name: 'idconcepto', type: 'int'},
            {name: 'concepto', type: 'string'},
            {name: 'parametro', type: 'string'},
            {name: 'valor', type: 'float'},
            {name: 'aplicacion', type: 'string'},
            {name: 'valorminimo', type: 'float'},
            {name: 'aplicacionminimo', type: 'string'},
            {name: 'observaciones', type: 'string'},
            {name: 'idcotizacion', type: 'int'},
            {name: 'orden', type: 'string'}
    ]);

    this.store = new Ext.data.Store({
        id:'store-conceptos',
        autoLoad : true,
        url: '<?=url_for("cotizaciones/datosPanelTarifarioAduana")?>',
        baseParams : {
            readOnly: '<?=$modo?>' ,
            idcotizacion:'<?=$cotizacion->getCaIdcotizacion()?>'
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
    <?
        if( $modo!="consulta" ){
        ?>
        this.tbar = [{
                text:'Guardar',
                iconCls: 'disk',
                scope:this,
                handler: this.guardarCambios
              },
              {
                text: 'Importar del tarifario',
                tooltip: 'Opción para agregar opciones de Aduana',
                iconCls: 'import',  // reference to our css
                scope:this,
                handler: function(){
                    Ext.getCmp("panel-parametros").ventanaTarifarioAduana();
                }
               }
             ];
        <?
        }
        ?>
    }else{
        this.tbar = null;
    }
    PanelTarifarioAduana.superclass.constructor.call(this, {
       loadMask: {msg:'Cargando...'},
       clicksToEdit: 1,
       id: 'panel-parametros',
       plugins: [ this.expander],        
       title:'Conceptos Aduana',
       view: new Ext.grid.GridView({

            forceFit:true,
            enableRowBody:true,
            showPreview:true//,
            //getRowClass : this.applyRowClass
       }),
       <?
        if($modo!="consulta"){
        ?>
       listeners:{
            validateedit: this.onValidateEdit,
            beforeedit: this.onBeforeEdit,
            rowcontextmenu: this.onRowcontextMenu,
            dblclick:this.onDblClickHandler,
            celldblclick: this.onCelldblclick
       }
<?
        }else{
        ?>
        boxMinHeight: 400,
        plugins: [this.checkColumn]
        <?
        }
?>
       ,
       tbar: this.tbar
    });

    var storePanelTarifarioAduana = this.store;
    var readOnly = this.readOnly;
    this.getColumnModel().isCellEditable = function(colIndex, rowIndex) {
        if( readOnly ){
            return false;
        }else{
            var record = storePanelTarifarioAduana.getAt(rowIndex);
            var field = this.getDataIndex(colIndex);


            if( !record.data.idconcepto && field!="concepto" ){
                return false;
            }
            if( record.data.idconcepto && field=="concepto" ){
                return false;
            }

            return Ext.grid.ColumnModel.prototype.isCellEditable.call(this, colIndex, rowIndex);
        }
    }


};

Ext.extend(PanelTarifarioAduana, Ext.grid.EditorGridPanel, {
    guardarCambios: function(){

        if( !this.readOnly ){
            var store = this.store;
            var records = store.getModifiedRecords();

            var lenght = records.length;

            for( var i=0; i< lenght; i++){
                r = records[i];

                var changes = r.getChanges();

                //Da formato a las fechas antes de enviarlas
                changes['id']=r.id;
                changes['idconcepto']=r.data.idconcepto;
                changes['parametro']=r.data.parametro;
                changes['consecutivo']=r.data.consecutivo;
                changes['idcotizacion']='<?=$cotizacion->getCaIdcotizacion()?>';

                if( r.data.concepto ){
                    //envia los datos al servidor
                    Ext.Ajax.request(
                        {
                            waitMsg: 'Guardando cambios...',
                            url: '<?=url_for("cotizaciones/guardarPanelTarifarioAduana")?>', 						//method: 'POST',
                            //Solamente se envian los cambios
                            params :	changes,

                            callback :function(options, success, response){
                                var res = Ext.util.JSON.decode( response.responseText );
                                if( res.id && res.success){
                                    var rec = store.getById( res.id );
                                    rec.set("consecutivo",res.consecutivo);
                                    //rec.set("sel", false); //Quita la seleccion de todas las columnas
                                    rec.commit();
                                }
                            }
                         }
                    );
                }
            }
        }
    },
    onBeforeEdit: function(e){

        if( e.field=="aplicacion" || e.field=="aplicacionminimo" ){
            var data = [
                <?
                $i=0;
                foreach( $aplicaciones as $aplicacion ){
                    if( $i++!=0){
                        echo ",";
                    }
                ?>
                    ['<?=$aplicacion->getCaValor()?>']
                <?
                }
                ?>
            ];

            var ed = this.colModel.getCellEditor(e.column, e.row);
            ed.field.store.loadData( data );
        }
        else if( e.field == "parametro" ){
            this.storeParametros.removeAll();
            this.storeParametros.setBaseParam("idconcepto",e.record.data.idconcepto);
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
        if( e.field == "concepto" ){
            var rec = e.record;
            var recordConcepto = this.record;
            var storeConcepto = this.store;
            //alert(this.store.getCount()-1);
/*            var store = this.store;
            var lenght = this.store.data.length;
            var records = store.getRange();
//            alert(records.toSource());

            for( var i=0; i< lenght; i++){
                if(e.value==records[i].data.idconcepto)
                {
                    alert("Este concepto ya esta registrado,\n seleccione otro por favor");
                    return false;
                }
            }
            */
            if( rec.data.orden=="Z"){
                var rec = e.record;
                var ed = this.colModel.getCellEditor(e.column, e.row);
                var store = ed.field.store;

                store.each( function( r ){
                    if( r.data.idconcepto==e.value ){
                        var newRec = new recordConcepto({
                                       idconcepto: '',
                                       concepto: '',
                                       parametro: '',
                                       valor: '',
                                       valorminimo:'',
                                       aplicacion:'',
                                       aplicacionminimo:'',
                                       orden: 'Z' // Se utiliza Z por que el orden es alfabetico
                                    });

                        rec.set("orden", "Y");

                        rec.set("idconcepto", r.data.idconcepto);
                        e.value = r.data.concepto;

                        //guardarGridProductosRec( rec );

                        //Inserta una columna en blanco al final
                        storeConcepto.addSorted(newRec);
                        storeConcepto.sort("orden", "ASC");
                   }
                });
            }
        }
        else if( e.field == "parametro" ){
            var rec = e.record;
            var recordConcepto = this.record;
            var storeConcepto = this.store;
            var store = this.store;
            var lenght = this.store.data.length;
            var records = store.getRange();
//            alert(records.toSource());

            for( var i=0; i< (lenght); i++){
                if(e.record.data.idconcepto==records[i].data.idconcepto)
                {
                    if(e.value==records[i].data.parametro)
                    {
                        alert("Este concepto y parametro ya han asignados,\n seleccione otro por favor");
                        return false;
                    }
                }
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
                            text: 'Eliminar',
                            iconCls: 'delete',
                            scope:this,
                            handler: function(){
                                this.eliminarFila(this.ctxRecord, index);
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
    eliminarFila: function(ctxRecord, index){
        if( confirm("Esta seguro?") ){
            var store = this.store;
            var params = ctxRecord.getChanges();
            params['consecutivo'] = ctxRecord.data.consecutivo;
            params['id'] = ctxRecord.id;

            Ext.Ajax.request(
                {
                    waitMsg: 'Eliminando...',
                    url: '<?=url_for("cotizaciones/eliminarPanelTarifarioAduana")?>',
                    method: 'POST',
                    //Solamente se envian los cambios
                    params :	params,

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
    },
    ventanaObservaciones : function( record ){
        var activeRow = record;
        Ext.MessageBox.show({
               title: 'Observaciones',
               msg: 'Por favor coloque las observaciones:',
               width:300,
               buttons: Ext.MessageBox.OKCANCEL,
               multiline: true,
               fn: this.actualizarObservaciones,
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
                            readOnly: this.readOnly
                        });
            //this.win.on('validfeed', this.addFeed, this);
        }
        this.win.ctxRecord = record;
        this.win.show();
    },
    actualizarObservaciones: function( btn, text ){
        if( btn=="ok" ){
            //alert(activeRow +" : "+ text);
            //registro = stroreG.getAt(activeRow);
            activeRow.set("observaciones", text);
        }
    },

    ventanaTarifarioAduana: function( ){
        var recordGrilla = this.record;
        var storeTarifaCot = this.store;
        var records = storeTarifaCot.getRange();
        var length = storeTarifaCot.data.length;
        
      <?
    if($modo!="consulta"){
    ?>
        var newComponent = new PanelTarifarioAduanaCliente({readOnly:true,
                                                            idcliente: <?=$cotizacion->getCliente()->getCaIdcliente()?>,
                                                            height: 400
                                                           });
<?
    }
?>
            //Se crea la ventana


        winSeguros = new Ext.Window({
            width       : 800,
            height      : 460,
            closeAction :'close',
            plain       : true,

            items       : [newComponent],


            buttons: [
                {
                    text     : 'Importar',
                    handler  : function( ){
                        storeTarifaAduana = newComponent.store;
                        var index = 0;

                        msg="";
            //            alert(records.toSource());
                       recor=records;
                        storeTarifaAduana.each( function(r){
                            if( r.data.sel==true ){
                                encontro=false;
                                for(i=0; i< (length-1); i++)
                                {
                                    if(r.data.idconcepto==recor[i].data.idconcepto)
                                    {
                                        if(r.data.parametro==recor[i].data.parametro)
                                        {
                                            msg+=("Concepto:"+r.data.concepto+" - Parametro :"+r.data.parametro+"<br/> \n");
                                            encontro=true;
                                            break;
                                        }
                                    }
                                }
                                if(encontro==false)
                                {
                                   var rec = new recordGrilla({idcotizacion:'<?=$cotizacion->getCaIdcotizacion()?>',
                                                        idconcepto: '',
                                                        concepto: '',
                                                        parametro: '',
                                                        valor: '',
                                                        valorminimo:'',
                                                        aplicacion:'',
                                                        aplicacionminimo:'',
                                                        orden: 'Z' // Se utiliza Z por que el orden es alfabetico
                                                    });
                                   records = [];
                                   records.push( rec );
                                   storeTarifaCot.insert( 0, records );
                                   rec = storeTarifaCot.getAt(0);
                                   rec.set("idconcepto", r.data.idconcepto );
                                   rec.set("concepto", r.data.concepto );
                                   rec.set("parametro", r.data.parametro );
                                   rec.set("valor", r.data.valor );
                                   rec.set("valorminimo", r.data.valorminimo );
                                   rec.set("aplicacion", r.data.aplicacion );
                                   rec.set("aplicacionminimo", r.data.aplicacionminimo );
                                   index++;
                                }
                            }
                        } );
                        if(msg!="")
                        {
                          Ext.Msg.alert("Conceptos","No se ingresaron los siguientes conceptos porque ya se encuentran en la cotizacion <br/>"+msg);
                        }

                        winSeguros.close();
                    }
                },
                {
                    text     : 'Cancelar',
                    handler  : function(){
                        winSeguros.close();
                    }
                }
            ]
        });
        winSeguros.show( );
    }
            

});

</script>