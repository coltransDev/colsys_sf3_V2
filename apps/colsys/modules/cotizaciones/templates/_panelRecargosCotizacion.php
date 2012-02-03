<?
/*
* Permite crear recargos locales
* @author: Andres Botero
*/
if($modo!="consulta"){
    include_component("pricing", "panelRecargosPorCiudad",array("ocultarConcepto"=>"false"));
}
?>
<script type="text/javascript">

var activeRecordRec = null;

PanelRecargosCotizacion = function( config ){

    Ext.apply(this, config);

    /*
    * Crea la columna de chequeo
    */
    this.checkColumn = new Ext.grid.CheckColumn({header:' ', dataIndex:'sel', width:30});

    this.resultTpl = new Ext.XTemplate(
            '<tpl for="."><div class="search-item"><b>{recargo}</b><br /><span>{aka}</span> </div></tpl>'
    );

    this.comboRecargos = new Ext.form.ComboBox({
        typeAhead: true,
        forceSelection: true,
        triggerAction: 'all',
        emptyText:'Seleccione',
        selectOnFocus: true,
        lazyRender:true,
        allowBlank: false,
        listClass: 'x-combo-list-small',
        valueField:'idrecargo',
        displayField:'recargo',
        mode: 'local',
        tpl: this.resultTpl,
        itemSelector: 'div.search-item',
        store :  new Ext.data.SimpleStore({
                    fields: ['idrecargo', 'recargo', 'aka'],
                    data : []
                })

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
    })



    this.columns = [
        <?
        if($modo=="consulta"){
        ?>
        this.checkColumn,
        <?
        }
        ?>
		{
			id: 'agrupamiento',
			header: "Recargos",
			width: 100,
			sortable: true,
			dataIndex: 'agrupamiento',
			hideable: false,
			hidden: true
		},
		{
			id: 'transporte',
			header: "transporte",
			width: 100,
			dataIndex: 'transporte',
			hideable: false,
			hidden: true
		},
		{
			id: 'recargo',
			header: "Recargo",
			width: 80,
			sortable: true,
			dataIndex: 'recargo',
			hideable: false,
			editor: this.comboRecargos
		},
        {
            id: 'equipo',
            header: "Equipo",
            width: 60,
            sortable: false,
            dataIndex: 'equipo',
            hideable: false,
            editor: this.editorEquipos
        },
		{
			id: 'valor_tar',
			header: "Valor Recargo",
			width: 30,
			sortable: true,
			renderer: Ext.util.Format.usMoney,
			dataIndex: 'valor_tar',
			hideable: false,
			editor: new Ext.form.NumberField({
						name: 'valor_tar',
						allowBlank:false,
						allowNegative: false,
						decimalPrecision :3
			})
		},
		{
			id: 'aplica_tar',
			header: "Aplicación Rec.",
			width: 35,
			sortable: true,
			dataIndex: 'aplica_tar',
			hideable: false,
			editor: <?=include_component("widgets", "emptyCombo" ,array("id"=>""))?>

		},
		{
			id: 'valor_min',
			header: "Mínimo",
			width: 30,
			sortable: true,
			renderer: Ext.util.Format.usMoney,
			dataIndex: 'valor_min',
			hideable: false,
			editor: new Ext.form.NumberField({
						name: 'valor_min',
						allowBlank:false,
						allowNegative: false,
						decimalPrecision :3
			})
		},
		{
			id: 'aplica_min',
			header: "Aplicación Min.",
			width: 35,
			sortable: true,
			dataIndex: 'aplica_min',
			hideable: false,
			editor: <?=include_component("widgets", "emptyCombo" ,array("id"=>""))?>

		},
		{
			id: 'idmoneda',
			header: "Moneda",
			width: 20,
			sortable: true,
			dataIndex: 'idmoneda',
			hideable: false,
			editor: <?=include_component("widgets", "monedas" ,array("id"=>""))?>
		},
		{
			id: 'detalles',
			header: "Observaciones",
			width: 100,
			sortable: true,
			dataIndex: 'detalles',
			//dataIndex: 'id',
			hideable: false,
			editor: new Ext.form.TextField({
						name: 'Detalles',
	                    allowBlank:true
			})
		}
	];


    
    
    /*
    * Crea el Record
    */    
    this.record = Ext.data.Record.create([
        {name: 'id', type: 'int'},
        {name: 'sel', type: 'bool'},
        {name: 'idcotizacion', type: 'string'},
        {name: 'idcotrecargo', type: 'string'},
        {name: 'idrecargo', type: 'string'},
        {name: 'agrupamiento', type: 'string'},
        {name: 'transporte', type: 'string'},
        {name: 'impoexpo', type: 'string'},
        {name: 'recargo', type: 'string'},
        {name: 'tipo', type: 'string'},
        {name: 'valor_tar', type: 'string'},
        {name: 'aplica_tar', type: 'string'},
        {name: 'valor_min', type: 'string'},
        {name: 'aplica_min', type: 'string'},
        {name: 'idmoneda', type: 'string'},
        {name: 'modalidad', type: 'string'},
        {name: 'detalles', type: 'string'},
        {name: 'orden', type: 'string'},
        {name: 'idequipo', type: 'string'}, //Concepto al cual pertenece el recargo
        {name: 'equipo', type: 'string'}, //Concepto al cual pertenece el recargo

    ]);

    <?
    $url = 'cotizaciones/datosGrillaRecargos?idcotizacion='.$cotizacion->getCaIdcotizacion();
    if($modo=="consulta"){
        $url.="&modo=consulta";
    }
    if( isset($producto) ){
        $url.="&idproducto=".$producto->getCaIdproducto();
    }

    ?>
    /*
    * Crea el store
    */
    this.store = new Ext.data.GroupingStore({
        url: '<?=url_for($url)?>',
        autoLoad : true,
        reader: new Ext.data.JsonReader(
            {
                id: 'id',
                root: 'recargos',
                totalProperty: 'total'
            },
            this.record
        ),
        sortInfo:{field: 'orden', direction: "ASC"},

        groupField: 'agrupamiento'
    });

    this.store.load();


    PanelRecargosCotizacion.superclass.constructor.call(this, {
        loadMask: {msg:'Cargando...'},
        clicksToEdit: 1,
        master_column_id : 'recargo',
        stripeRows: true,
        autoExpandColumn: 'recargo',
        title: 'Recargos Locales',


        // plugins: [checkColumn], //expander,
        closable: false,
        id: 'grid_recargos',
        height: 400,
        <?
        if( $modo!="consulta" ){
        ?>
        tbar: [
            
            {
                text: 'Guardar Cambios ',
                tooltip: 'Guarda los cambios realizados en Recargos',
                iconCls: 'disk',  // reference to our css
                id: 'guardarbtn-recargos',
                handler: function(){
                    Ext.getCmp("subpanel-cotizaciones").guardarDatosPaneles();
                }
            },
            
            {
                text: 'Recargar',
                tooltip: 'Recarga los datos de la base de datos',
                iconCls: 'refresh',  // reference to our css
                handler: function(){
                    if(Ext.getCmp("grid_recargos").store.getModifiedRecords().length>0){
                        if(!confirm("Se perderan los cambios no guardados en los recargos locales unicamente, desea continuar?")){
                            return 0;
                        }
                    }

                    Ext.getCmp("grid_recargos").store.reload();
                }
            }
        ],
        <?
        }
        ?>
        view: new Ext.grid.GroupingView({
            forceFit:true,
            enableRowBody:true
        }),
        <?
        if($modo!="consulta"){
        ?>
        listeners:{
            rowcontextmenu:this.onRowContextMenu,
            validateedit: this.onValidateEdit,
            beforeedit:this.onBeforeedit
        }
        <?
        }else{
        ?>
        boxMinHeight: 400,
        plugins: [this.checkColumn]
        <?
        }
        ?>

    });


    this.getColumnModel().isCellEditable = function(colIndex, rowIndex) {
        
        <?
        if($modo=="consulta"){
        ?>
        return false;
        <?
        }
        ?>

		var record = Ext.getCmp("grid_recargos").store.getAt(rowIndex);
		var field = this.getDataIndex(colIndex);

		if( !record.data.idrecargo && field!="recargo" ){
			return false;
		}

		if( record.data.idrecargo && field=="recargo" ){
			return false;
		}

		return Ext.grid.ColumnModel.prototype.isCellEditable.call(this, colIndex, rowIndex);
	}
    
}

Ext.extend(PanelRecargosCotizacion, Ext.grid.EditorGridPanel, {
    /*
    * Determina que store se debe utilizar dependiendo si es un concepto o recargo
    */
    onBeforeedit: function( e ){

        if( e.field=="equipo" ){
            if(e.record.data.modalidad!="FCL")
                return false;

        }
        if( e.field=="recargo" ){
            var recargosMaritimo = [
                <?
                $i=0;
                foreach( $recargosMaritimo as $recargo ){
                    if( $i++!=0){
                        echo ",";
                    }
                ?>
                    ['<?=$recargo->getCaIdconcepto()?>','<?=$recargo->getCaConcepto()?>','<?=$recargo->getCaAka()?>']
                <?
                }
                ?>
            ];

            var recargosAereo = [
                <?
                $i=0;
                foreach( $recargosAereo as $recargo ){
                    if( $i++!=0){
                        echo ",";
                    }
                ?>
                    ['<?=$recargo->getCaIdconcepto()?>','<?=$recargo->getCaConcepto()?>','<?=$recargo->getCaAka()?>']
                <?
                }
                ?>
            ];

            var recargosTerrestreOTM = [
                <?
                $i=0;
                foreach( $recargosTerrestreOTM as $recargo ){
                    if( $i++!=0){
                        echo ",";
                    }
                ?>
                    ['<?=$recargo->getCaIdconcepto()?>','<?=$recargo->getCaConcepto()?>','<?=$recargo->getCaAka()?>']
                <?
                }
                ?>
            ];

            var ed = this.colModel.getCellEditor(e.column, e.row);
            if( e.record.data.transporte=="<?=Constantes::AEREO?>" ){
                ed.field.store.loadData( recargosAereo );
            }else{                
                if (e.record.data.transporte=="<?=constantes::OTMDTA?>" || ( e.record.data.transporte=="<?=Constantes::TERRESTRE?>" && ( e.record.data.modalidad=="OTM"||e.record.data.modalidad=="DTA") ) ){
                    ed.field.store.loadData( recargosTerrestreOTM );
                }else{
                    ed.field.store.loadData( recargosMaritimo );
                }
            }

        }

        if( e.field=="aplica_tar" || e.field=="aplica_min" ){
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


                <?
                $i=0;
                foreach( $parametros as $aplicacion ){
                ?>
                    if('<?=strtolower(trim($aplicacion->getCaValor()))?>'==e.record.data.recargo.replace(/^\s*|\s*$/g,"").toLowerCase())
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
            if(dataParametros.length>0)
            {
                ed.field.store.loadData( dataParametros );
            }
            else if( e.record.data.transporte=="<?=Constantes::AEREO?>" ){
                ed.field.store.loadData( dataAereo );
            }else{
                ed.field.store.loadData( dataMaritimo );
            }
        }

    },


    /*
    * Cambia el valor que se toma de los combobox y copia el valor em otra columna,
    * tambien inserta otra columna en blanco para que el usuario continue digitando
    */
    onValidateEdit: function(e){
        var storeRecargosCot = this.store;
        if( e.field == "recargo"){
            var rec = e.record;
            var ed = this.colModel.getCellEditor(e.column, e.row);
            var store = ed.field.store;
            var recordGrilla = this.record;
            store.each( function( r ){
                    if( r.data.idrecargo==e.value ){
                        if( !rec.data.idrecargo  ){
                            var newRec = new recordGrilla({
                               orden: 'Z',
                               idcotizacion: rec.data.idcotizacion,
                               agrupamiento: rec.data.agrupamiento,
                               transporte: rec.data.transporte,
                               modalidad: rec.data.modalidad,
                               idrecargo: '',
                               recargo: '+',
                               iditem: '',
                               valor_tar: '',
                               valor_min: '',
                               aplica_tar: '',
                               aplica_min: '',
                               idmoneda: '',
                               observaciones: ''
                            });

                            storeRecargosCot.addSorted(newRec);
                            rec.set("idmoneda", "USD" );

                        }
                        rec.set("idrecargo", r.data.idrecargo);
                        e.value = r.data.recargo;
                        return true;
                    }
                }
            )
        }
        else if( e.field == "equipo"){
            var rec = e.record;
            var ed = this.colModel.getCellEditor(e.column, e.row);
            var store = ed.field.store;
            var recordGrilla = this.record;
            store.each( function( r ){
                if( r.data.idconcepto==e.value ){
                    rec.set("idequipo", r.data.idconcepto );
                    e.value = r.data.concepto;
                    return true;
                 }
            });
        }
    },


    onContextHide: function(){
        if(this.ctxRow){
            Ext.fly(this.ctxRow).removeClass('x-node-ctx');
            this.ctxRow = null;
        }
    },

    /*
    * Menu contextual que se despliega sobre una fila con el boton derecho
    */

    onRowContextMenu: function(grid, index, e){
        rec = this.store.getAt(index);
        var storeRecargosCot = this.store;
        if(!this.menu){ // create context menu on first right click
            this.menu = new Ext.menu.Menu({
            id:'grid_recargos-ctx',
            enableScrolling : false,
            items: [

                    {
                        text: 'Importar del tarifario',
                        iconCls: 'import',
                        scope:this,
                        handler: function(){
                            if( this.ctxRecord ){
                                this.ventanaTarifarioRecargos( this.ctxRecord );
                            }
                        }
                    },
                    {
                        text: 'Eliminar item',
                        iconCls: 'delete',
                        scope:this,
                        handler: function(){
                            if( this.ctxRecord && confirm("Desea continuar?") ){



                                var idcotrecargo = this.ctxRecord.data.idcotrecargo;
                                var id= this.ctxRecord.id;
                                if( idcotrecargo ){
                                    Ext.Ajax.request(
                                    {
                                        waitMsg: 'Guardando cambios...',
                                        url: '<?=url_for("cotizaciones/eliminarItemsOpciones?tipo=recargo")?>',
                                        //method: 'POST',
                                        //Solamente se envian los cambios
                                        params :	{
                                            id: id,
                                            idcotrecargo: idcotrecargo
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
                                                var rec = storeRecargosCot.getById( res.id );
                                                storeRecargosCot.remove(rec);
                                            }

                                        }
                                    });
                                }else{ // No se ha guardado todavia luego la elimina
                                    var rec = this.store.getById( id );
                                    storeRecargosCot.remove(rec);
                                }
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
    },


    /*
    * Muestra una ventana con la informacion del tarifario y le permite al usuario
    * seleccionar las tarifas a importar
    */
    ventanaTarifarioRecargos: function( record ){
        

        activeRecordRec = record;
        var storeRecargosCot = this.store;
        var impoexpo = "<?=Constantes::IMPO?>"; //TODO Corregir para expo
        var transporte = record.data.transporte;
        var modalidad = record.data.modalidad;
        var recordCot = this.record;
        
        var newComponent = new PanelRecargosPorCiudad({
                                              impoexpo: impoexpo,
                                              idtrafico: '99-999',
                                              transporte:transporte,
                                              modalidad: modalidad,
                                              idcotizacion: '<?=$cotizacion->getCaIdcotizacion()?>',
                                              title: "Recargos Locales "+impoexpo.substring(0, 4)+"»"+transporte+"»"+modalidad,
                                              closable: false,
                                              readOnly: true
                                             });


        

            //Se crea la ventana

            win = new Ext.Window({
                width       : 800,
                height      : 460,
                closeAction :'close',
                plain       : true,

                items       : [newComponent],


                buttons: [
                    {
                        text     : 'Importar',
                        scope    : this,
                        handler  : function( ){
                            storePricing = newComponent.store;
                            
                            //

                            /*
                            * Busca el ultimo elemento para insertar al final del grupo
                            */
                            var flag = false;
                            storeRecargosCot.each( function( record ){
                                    if( record.data.id==activeRecordRec.id ){
                                        flag=true;
                                    }
                                    if(flag){
                                        if(!record.data.idrecargo){
                                            activeRecordRec = record;
                                            flag=false;
                                            return 0;
                                        }
                                    }
                            });

                            var id = activeRecordRec.data.id;
                            var j = 0;
                            storePricing.each( function(r){
                                if( r.data.sel==true ){
                                    j++;
                                    var newId = id+j;
                                    var newRec = new recordCot({
                                        id: newId,
                                        agrupamiento: activeRecordRec.data.agrupamiento,
                                        recargo: '',
                                        equipo: '',
                                        valor_tar: 0,
                                        valor_min: 0,
                                        aplica_tar: '',
                                        aplica_min: '',
                                        idmoneda: '',
                                        detalles: '',
                                        transporte: activeRecordRec.data.transporte,
                                        modalidad: activeRecordRec.data.modalidad
                                    });
                                    newRec.id = newId;
                                    //activeRecordRec.id=newId+1;
                                    //activeRecordRec.data.id=newId+1;
                                    storeRecargosCot.addSorted( newRec );

                                    //Es necesario buscar de nuevo el record dentro del store
                                    //para que se activen los eventos de edición del store
                                    var newRec = storeRecargosCot.getById( newId );
                                    //alert(r.data.observaciones)
                                    newRec.set("idrecargo", r.data.idrecargo );
                                    newRec.set("recargo", r.data.recargo );
                                    newRec.set("idequipo", r.data.idconcepto );
                                    newRec.set("equipo", r.data.concepto );
                                    newRec.set("valor_tar", r.data.vlrrecargo );
                                    newRec.set("valor_min", r.data.vlrminimo );
                                    newRec.set("aplica_tar", r.data.aplicacion );
                                    newRec.set("aplica_min", r.data.aplicacion_min );
                                    newRec.set("idmoneda", r.data.idmoneda );
                                    newRec.set("detalles", r.data.observaciones );
                                    //newRec.set("observaciones", r.data.observaciones ); //No se ha definido las observaciones para cliente

                                }
                            } );


                            win.close();
                        }
                    },
                    {
                        text     : 'Cancelar',
                        handler  : function(){
                            win.close();
                        }
                    }
                ]
            });
            win.show( );
            
    },


    /*
    * Lanza lan función de actualización de registros modificados
    */
    guardarItems: function(){
        var success = true;
        var storeRecargosCot = this.store;
        var records = storeRecargosCot.getModifiedRecords();

        var lenght = records.length;

        //Validacion
        for( var i=0; i< lenght; i++){
            r = records[i];
            if(!r.data.idmoneda&&r.data.idrecargo){
                Ext.Msg.alert( "","Por favor coloque la moneda en todos los items en la pestaña recargos locales" );
                return 0;
            }
        }

        Ext.getCmp('guardarbtn-recargos').disable();
        window.setTimeout(this.enableButton, 3000);

        for( var i=0; i< lenght; i++){
            r = records[i];
            if( r.data.idrecargo ){
                var changes = r.getChanges();
                changes['id']=r.id;
                changes['idcotrecargo']=r.data.idcotrecargo;
                changes['tipo']='recargo'
                changes['idproducto']='99'
                changes['idopcion']='999'
                changes['idconcepto']='9999'
                changes['iditem']=r.data.idrecargo
                changes['modalidad']=r.data.modalidad
                changes['aplica_tar']=r.data.aplica_tar;
                changes['aplica_min']=r.data.aplica_min;



                //envia los datos al servidor
                Ext.Ajax.request(
                    {
                        waitMsg: 'Guardando cambios...',
                        url: '<?=url_for("cotizaciones/observeItemsOpciones?idcotizacion=".$cotizacion->getCaIdcotizacion() )?>',
                        //Solamente se envian los cambios
                        params :	changes,

                        callback :function(options, success, response){

                            var res = Ext.util.JSON.decode( response.responseText );
                            if( res.id ){
                                var rec = storeRecargosCot.getById( res.id );
                                rec.set("idcotrecargo", res.idcotrecargo);
                                rec.commit();
                            }
                        }

                     }
                );
                r.set("sel", false);//Quita la seleccion de todas las columnas
            }
        }

    }
    ,
    enableButton: function(){
        Ext.getCmp('guardarbtn-recargos').enable();
    }




});

</script>