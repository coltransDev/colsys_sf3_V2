<?
$data = $sf_data->getRaw('data');
include_component("pm", "editarTicketWindow", array("nivel"=>$nivelTickets));

?>
<script type="text/javascript">
/**
 * PanelNoticias object definition
 **/
PanelNoticias = function( config ){
    Ext.apply(this, config);


    this.data = <?=json_encode( array("data"=>$data, "total"=>count($data)) )?>;

    this.record = Ext.data.Record.create([
        {name: 'idnotificacion', type: 'string'},
        {name: 'titulo', type: 'string'},
        {name: 'mensaje', type: 'string'},
        {name: 'caducidad', type: 'string'},
        {name: 'usucreado', type: 'string'},
        {name: 'fchcreado', type: 'date', dateFormat:'Y-m-d h:i:s'}

    ]);


    this.store = new Ext.data.GroupingStore({
        autoLoad : true,
        //url: '<?=url_for("pricing/panelNoticiasData")?>',
        reader: new Ext.data.JsonReader(
            {
                id: 'idnotificacion',
                root: 'data',
                totalProperty: 'total',
                successProperty: 'success'
            },
            this.record
        ),
        proxy: new Ext.data.MemoryProxy( this.data )
        ,
        sortInfo:{field: 'fchcreado', direction: "DESC"}


    });

    /*
    * Crea las columnas que van en la grilla, nuevas columnas se añaden dinamicamente
    */

    this.formatTitle = function(value, p, record) {
            return String.format(
                '<div class="topic"><b>{0}</b><br /><span class="author">{1}</span></div>',
                value, record.data.usucreado
            );
    }
    
    this.columns = [
		{
			header: "Titulo",
			width: 220,
			sortable: true,
			renderer: this.formatTitle,
			dataIndex: 'titulo',
			id: 'titulo'
		},
		{
			header: "Fecha",
			width: 80,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d g:i a'),
			dataIndex: 'fchcreado'
		}


	];
    

    PanelNoticias.superclass.constructor.call(this, {        
        stripeRows: true,
        //autoExpandColumn: 'nconcepto',
        title: 'Notificaciones',

        closable: true,
        id: 'panel-noticias',
        height: 400,
        
        tbar: [
        <?
        if( $opcion!="consulta"){
        ?>
            {
                text: 'Agregar',
                tooltip: 'Crea un nueva notificación',
                iconCls:'add',  // reference to our css
                scope: this,
                handler: this.agregarNoticia
            },
        <?
        }
        ?>
            {
                text: 'Solicitar Tarifa',
                tooltip: 'Enviar ticket a Pricing',
                iconCls:'application_form',  // reference to our css
                scope: this,
                handler: this.crearTicket
            },
            {
                text: 'Tarifario ASW',
                tooltip: 'Ver Tarifas ASW',
                iconCls:'website',  // reference to our css
                scope: this,
                handler: this.verTarifario
            }
        ],
        
        viewConfig: {
            forceFit:true,
            enableRowBody:true,
            getRowClass : this.applyRowClass
        },        
        listeners:{
            rowcontextmenu: this.onRowContextMenu,
            click: this.onClickHandler
        }

    });
}

Ext.extend(PanelNoticias, Ext.grid.GridPanel, {
    applyRowClass: function(record, rowIndex, p, ds) {

        var xf = Ext.util.Format;
        p.body = xf.stripTags(record.data.mensaje) ;
        return 'x-grid3-row-expanded';
    },

    /*
    * Coloca las observaciones en pantalla y actualiza el datastore
    */
    actualizarObservaciones: function( btn, text ){
        if( btn=="ok" ){
            var record = store.getAt(activeRow);
            record.set("observaciones", text);

            document.getElementById("obs_"+record.get("_id")).innerHTML  = "<b>Observaciones:</b> "+text;
        }
    },

    /**
    * Muestra una ventana donde se pueden editar las observaciones
    **/
    onClickHandler: function(e) {
        var btn = e.getTarget('.btnComentarios');
        if (btn) {
            var t = e.getTarget();
            var v = this.view;
            var rowIdx = v.findRowIndex(t);
            var record = this.getStore().getAt(rowIdx);

            activeRow = rowIdx;
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
    },
    /*
    * Menu contextual que se despliega sobre una fila con el boton derecho
    */
    onContextHide: function(){
        if(this.ctxRow){
            Ext.fly(this.ctxRow).removeClass('x-node-ctx');
            this.ctxRow = null;
        }
    },
    
    onRowContextMenu: function(grid, index, e){
        <?
        if( $opcion!="consulta" ){
        ?>
        var r = grid.store.getAt(index);
        e.stopEvent(); //Evita que se despliegue el menu con el boton izquierdo
        if( typeof(this.menu) !="undefined" ){
            this.menu.removeAll( true );
        }
        this.menu = new Ext.menu.Menu({
            id:'grid-ctx',
            items: [
                    {
                        text: 'Editar',
                        iconCls: 'page_white_edit',
                        scope:this,
                        handler: function(){
                            this.editarNoticia( r );
                        }
                    },
                    {
                    text: 'Eliminar',
                    iconCls: 'delete',
                    scope:this,
                    handler: function(){
                        this.eliminarNoticia( r );
                    }
                }
            ]
        });
        this.menu.on('hide', this.onContextHide, this);

        if(this.ctxRow){
            Ext.fly(this.ctxRow).removeClass('x-node-ctx');
            this.ctxRow = null;
        }
        this.ctxRecord = r;
        this.ctxRow = this.view.getRow(index);
        Ext.fly(this.ctxRow).addClass('x-node-ctx');
        this.menu.showAt(e.getXY());
        <?
        }
        ?>

    },

    agregarNoticia: function(){
        //crea una ventana
        this.ventanaEdicion( );
    },

    editarNoticia: function( rec ){
        //crea una ventana
        this.ventanaEdicion( rec );
    },

    eliminarNoticia: function( r ){
        //envia los datos al servidor
        var panel = Ext.getCmp("panel-noticias");
        var storeNoticias = panel.store;
        if( confirm("Desea continuar?") ){
            Ext.Ajax.request(
                {
                    waitMsg: 'Eliminando...',
                    url: '<?=url_for("pricing/eliminarNotificacion")?>', 						//method: 'POST',
                    //Solamente se envian los cambios
                    params :	{
                        idnotificacion:r.data.idnotificacion,
                        id:r.id
                    },

                    callback :function(options, success, response){

                        var res = Ext.util.JSON.decode( response.responseText );
                        if( res.success ){
                            r = storeNoticias.getById( res.id );
                            storeNoticias.remove( r );
                        }
                    }
                }
            );
        }
    },

    crearTicket: function(){
        var win = new EditarTicketWindow();
        win.show();
    },
    
    verTarifario: function(){
        window.open('http://apps.aswgroup.com.hk/en/scripts/adm/login.php');
    },

    ventanaEdicion: function( record ){
        win = new Ext.Window({
            width       : 400,
            height      : 250,
            closeAction :'hide',
            plain       : true,

            items       : new Ext.FormPanel({
                id: 'noticias-form',
                frame: true,
                title: 'Notificación',
                autoHeight: true,
                bodyStyle: 'padding: 10px 10px 0 10px;',
                labelWidth: 55,
                items: [
                    {
                        xtype: 'hidden',
                        name: 'idnotificacion'
                    },
                    {
                        xtype: 'textfield',
                        fieldLabel: 'Titulo',
                        name: 'titulo',
                        allowBlank:false,
                        width: 270
                    },
                    new Ext.form.TextArea({
                        fieldLabel: 'Mensaje',
                        name: 'mensaje',
                        allowBlank:false,
                        width: 270
                    }),
                    new Ext.form.DateField({
                        fieldLabel: 'Caducidad',
                        name: 'caducidad',
                        allowBlank:false

                    })
                ]

            }),

            buttons: [{
                text     : 'Guardar',
                handler: function(){

                    var panel = Ext.getCmp("panel-noticias");
                    var fp = Ext.getCmp("noticias-form");
                    var idnotificacion = fp.getForm().findField("idnotificacion").getValue();
                    var titulo = fp.getForm().findField("titulo").getValue();
                    var mensaje = fp.getForm().findField("mensaje").getValue();
                    var caducidad = Ext.util.Format.date( fp.getForm().findField("caducidad").getValue(), 'Y-m-d');

                    if(fp.getForm().isValid()){

                        var recordNoticias = panel.record;
                        var storeNoticias = panel.store;

                        //envia los datos al servidor
                        Ext.Ajax.request(
                            {
                                waitMsg: 'Guardando cambios...',
                                url: '<?=url_for("pricing/guardarNotificacion")?>', 						//method: 'POST',
                                //Solamente se envian los cambios
                                params :	{ idnotificacion:idnotificacion,
                                              titulo:titulo,
                                              mensaje:mensaje,
                                              caducidad:caducidad},

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

                                        var fchcreado = new Date();

                                        var rec = new recordNoticias(
                                            {titulo:res.titulo, mensaje:res.mensaje, caducidad:caducidad, idnotificacion:res.idnotificacion, fchcreado:fchcreado, usucreado:res.usucreado}
                                        );



                                        rec = storeNoticias.getById(res.idnotificacion);
                                        if( !rec ){
                                            var rec = new recordNoticias(
                                                {titulo:res.titulo, mensaje:res.mensaje, caducidad:caducidad, idnotificacion:res.idnotificacion, fchcreado:fchcreado, usucreado:res.usucreado}
                                            );
                                            rec.id = res.idnotificacion;
                                            records = [];
                                            records.push( rec );
                                            storeNoticias.insert( 0, records );

                                        }else{

                                            rec.set("titulo" , res.titulo);
                                            rec.set("mensaje" , res.mensaje);
                                            rec.set("caducidad" , caducidad);
                                            rec.set("titulo" , res.titulo);
                                            //rec.set("fchcreado" , res.fchcreado);
                                            rec.set("usucreado" , res.usucreado);
                                            rec.commit();
                                        }
                                        win.close();
                                    }else{
                                        Ext.MessageBox.alert('Warning','Ha ocurrido un error al guardar');
                                    }
                                }
                             }
                        );




                    }
                }
            },{
                text     : 'Cancelar',
                handler  : function(){
                    win.close();
                }
            }]
        });

        win.show( );

        if(typeof(record)!='undefined'){
            var fp = Ext.getCmp("noticias-form");
            fp.getForm().findField("idnotificacion").setValue(record.data.idnotificacion);
            fp.getForm().findField("titulo").setValue(record.data.titulo);
            fp.getForm().findField("mensaje").setValue(record.data.mensaje);
            fp.getForm().findField("caducidad").setValue(record.data.caducidad);

        }


    }

});

</script>





	

















