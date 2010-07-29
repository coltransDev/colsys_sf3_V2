<?
/*
* Panel de administracion de archivos del cada trafico
*/


$deleteUrl = "gestDocumental/borrarArchivo";


include_component("widgets", "widgetUsuario");
?>

<script type="text/javascript">

PanelUsers = function( config ){
    Ext.apply(this, config);

    this.tplFileView = new Ext.XTemplate(
        '<tpl for=".">',

            '<div class="thumb-wrap" id="{login}">',
            '<div class="userthumb" align="center"><img src="{icon}" height="80" /></div>',
            '<span class="x-editable">{name}</span></div>',

        '</tpl>',
        '<div class="x-clear"></div>'
    );

    this.store = new Ext.data.JsonStore({
        autoload: false,
        root: 'root',
        fields: ['login','name', 'icon'],
        url: this.dataUrl
        
    });
    if( this.dataUrl ){       
        this.store.load();
    }

    this.dataView = new Ext.DataView({
			store: this.store,
			tpl: this.tplFileView,
			//id: 'file-view',
            cls: 'file-view',
			autoHeight:true,
			singleSelect : true,
			overClass:'x-view-over',
			itemSelector:'div.thumb-wrap',
			emptyText: 'No hay Usuarios',
            folder: this.folder,

			/*
			plugins: [
				new Ext.DataView.DragSelector(),
				new Ext.DataView.LabelEditor({dataIndex: 'name'})
			],
			*/
			prepareData: function(data){
				data.shortName = Ext.util.Format.ellipsis(data.name, 15);
				//data.sizeString = Ext.util.Format.fileSize(data.size);
				//data.dateString = data.lastmod.format("m/d/Y g:i a");
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
							//document.location.href = "?folder="+folder+"&idarchivo="+records[i].data.idarchivo;
						}
					}
				}
			}
		});

    this.wgUsuario = new WidgetUsuario({width:300});
    if( !this.readOnly ){
        this.tbar = [
               this.wgUsuario,
               {
                    text: 'Borrar',
                    tooltip: 'Elimina el usuario seleccionado',
                    iconCls:'delete',  // reference to our css
                    idcomponent: this.idcomponent, 
                    scope: this
                }
        ];
    }else{
        this.tbar = null;
    }

    PanelUsers.superclass.constructor.call(this, {
        //id: 'panel-archivos',
        loadingMask: "Cargando",
		frame:false,
		width:535,        
		collapsible:true,
        autoScroll: true,
		layout:'fit',	
		items: this.dataView,
        tbar: this.tbar
    });
}

Ext.extend(PanelUsers, Ext.Panel, {
    nuevoArchivo: function(){

        

    },

    abrirArchivo: function(){       
        var fv = this.dataView;
        records =  fv.getSelectedRecords();
        for( var i=0;i< records.length; i++){            
            //document.location.href = "?folder="+this.folder+"&idarchivo="+records[i].data.idarchivo;
        }
    },
   

    setDataUrl: function(url){
        this.dataUrl = url;
        this.store.proxy = new Ext.data.HttpProxy( {url: url});
    }

    
});

</script>