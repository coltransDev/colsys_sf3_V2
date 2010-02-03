<?
/*
* Panel de administracion de archivos del cada trafico
*/

$viewUrl = "gestDocumental/verArchivo";
$deleteUrl = "gestDocumental/borrarArchivo";
$uploadUrl = "gestDocumental/subirArchivo";
$dataUrl = "gestDocumental/dataArchivos";


?>

<script type="text/javascript">

PanelArchivos = function( config ){
    Ext.apply(this, config);

    this.tplFileView = new Ext.XTemplate(
        '<tpl for=".">',

            '<div class="thumb-wrap" id="{name}">',
            '<div class="thumb">{icon}</div>',
            '<span class="x-editable">{name}</span></div>',

        '</tpl>',
        '<div class="x-clear"></div>'
    );

    this.store = new Ext.data.JsonStore({
        autoload: false,
        root: 'files',
        fields: ['idarchivo','name', 'descripcion', 'icon',{name:'size', type: 'float'}, {name:'lastmod', type:'date', dateFormat:'timestamp'}],
        url: '<?=url_for($dataUrl)?>'
        
    });

    this.store.setBaseParam('folder', this.folder );
    this.store.load();

    this.dataView = new Ext.DataView({
			store: this.store,
			tpl: this.tplFileView,
			//id: 'file-view',
            cls: 'file-view',
			autoHeight:true,
			singleSelect : true,
			overClass:'x-view-over',
			itemSelector:'div.thumb-wrap',
			emptyText: 'No hay archivos',
            folder: this.folder,

			/*
			plugins: [
				new Ext.DataView.DragSelector(),
				new Ext.DataView.LabelEditor({dataIndex: 'name'})
			],
			*/
			prepareData: function(data){
				data.shortName = Ext.util.Format.ellipsis(data.name, 15);
				data.sizeString = Ext.util.Format.fileSize(data.size);
				data.dateString = data.lastmod.format("m/d/Y g:i a");
				return data;
			},

			listeners: {
				selectionchange: {
					fn: function(dv,nodes){
						/*var l = nodes.length;
						var s = l != 1 ? 's' : '';
						panel.setTitle('Simple DataView ('+l+' item'+s+' selected)');*/
					}
				}
                ,
				dblclick : {
					fn: function(dv,nodes){

                        //var panel = Ext.getCmp("panel-archivos");
                        //var fv = panel.dataView;
                        var fv = this;
                        var folder = this.folder;
						records =  fv.getSelectedRecords();
						for( var i=0;i< records.length; i++){							
							document.location.href = "<?=url_for($viewUrl)?>?folder="+folder+"&idarchivo="+records[i].data.idarchivo;
						}
					}
				}
			}
		});


    PanelArchivos.superclass.constructor.call(this, {
        //id: 'panel-archivos',
		frame:false,
		width:535,        
		collapsible:true,
        autoScroll: true,
		layout:'fit',	
		items: this.dataView,
        tbar: [
            <?
            if( !$readOnly ){
            ?>

            {
                text: 'Nuevo',
                tooltip: 'Sube un nuevo archivo',
                iconCls:'add',
                scope: this,
                handler: this.nuevoArchivo

                /*handler: function(){
                    Ext.getCmp("panel-archivos").nuevoArchivo();
                }*/
            },
            <?
            }
            ?>
            {
                text: 'Abrir',
                tooltip: 'Abre el archivo seleccionado',
                iconCls:'folder',  // reference to our css
                scope: this,
                handler: this.abrirArchivo
                /*handler: function(){
                    Ext.getCmp("panel-archivos").abrirArchivo();
                }*/
            }
            <?
            if( !$readOnly ){
            ?>            
            ,{
                text: 'Borrar',
                tooltip: 'Elimina el archivo seleccionado',
                iconCls:'delete',  // reference to our css
                scope: this,
                handler: this.eliminarArchivo
                /*handler: function(){
                    Ext.getCmp("panel-archivos").eliminarArchivo();

                }*/
            }
            <?
            }
            ?>
		]
    });
}

Ext.extend(PanelArchivos, Ext.Panel, {
    nuevoArchivo: function(){

        var panel = this;
        var storeFileView = panel.store;
        var folder = panel.folder;
        
        win = new Ext.Window({
            //applyTo     : 'hello-win',
            //layout      : 'fit',
            width       : 400,
            height      : 200,
            closeAction :'close',
            plain       : true,

            items       : new Ext.FormPanel({
            fileUpload: true,
            frame: true,
            title: 'Por favor seleccione un archivo',
            autoHeight: true,
            bodyStyle: 'padding: 10px 10px 0 10px;',
            labelWidth: 50,
            id: 'file-panel-form',
            defaults: {
                anchor: '95%',
                allowBlank: false

            },
            items: [{
                    xtype: 'fileuploadfield',
                    id: 'file',
                    name: 'file',
                    width: 250,
                    fieldLabel: 'Archivo',
                    emptyText: 'Seleccione un archivo',
                    buttonCfg: {
                        text: '',
                        iconCls: 'upload-icon'
                    }
                }]

            }),

            buttons: [{
                text     : 'Guardar',

                handler: function(){                    
                    var fp = Ext.getCmp("file-panel-form");

                    if(fp.getForm().isValid()){

                        fp.getForm().submit({
                            url: '<?=url_for( $uploadUrl ) ?>',
                            params: {folder:folder},
                            //waitMsg: 'Cargando el archivo...',
                            success: function(fp, o){
                                <?
                                //FIX-ME: En caso que la carga de archivos sea local no va a recargarse
                                ?>
                                storeFileView.reload();
                                win.close();
                                Ext.Msg.alert('Success', 'El archivo "'+o.result.filename+'" se ha guardado en el servidor');

                            },
                            failure: function(xhr){
                                Ext.Msg.alert('Error', 'Ha ocurrido un error al guardar el archivo');
                            }
                        });
                    }
                }
            },{
                text     : 'Cancelar',
                handler: function(){
                    win.close();
                }
            }]
        });
        
        
        win.show( );

    },

    abrirArchivo: function(){       
        var fv = this.dataView;
        records =  fv.getSelectedRecords();
        for( var i=0;i< records.length; i++){            
            document.location.href = "<?=url_for($viewUrl)?>?folder="+this.folder+"&idarchivo="+records[i].data.idarchivo;
        }
    },
    eliminarArchivo: function(){
        var fv = this.dataView;
        records =  fv.getSelectedRecords();
        var storeFileView = this.store;
        for( var i=0;i< records.length; i++){
            if( confirm( 'Esta seguro que desea borrar el archivo seleccionado?') ){

                Ext.Ajax.request({
                    url: '<?=url_for($deleteUrl)?>',
                    params: {
                        idarchivo: records[i].data.idarchivo,
                        id: records[i].id,
                        folder: this.folder
                    },

                    callback :function(options, success, response){
                        var res = Ext.util.JSON.decode( response.responseText );
                        storeFileView.each(function(r){
                            if(r.id==res.id){
                                storeFileView.remove(r);
                                Ext.Msg.alert("Success", "Se ha eliminado el archivo");
                            }
                        });

                    }
                });
            }
        }
    }
});

</script>