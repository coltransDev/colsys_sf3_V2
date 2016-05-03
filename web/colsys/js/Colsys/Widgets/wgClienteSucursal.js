Ext.define('Colsys.Widgets.wgClienteSucursal', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.Colsys.Widgets.wgClienteSucursal',
    store: new Ext.data.Store(
    {
       //model: 'ClientesModel',       
       fields: [
        {name: 'idsucursal'},
        {name: 'ciudad'},
        {name: 'direccion'},
        {name: 'idcliente'},
        {name: 'compania' },
        {name: 'cuentapago'}
        /*{name: 'cargo', mapping: 'ca_cargo'},			
        {name: 'vendedor', mapping: 'ca_vendedor'},
        {name: 'nombre_ven', mapping: 'ca_nombre'},
        {name: 'listaclinton', mapping: 'ca_listaclinton'},
        {name: 'fchcircular', mapping: 'ca_fchcircular', type:'int'},
        {name: 'status', mapping: 'ca_status'},
        {name: 'confirmar', mapping: 'ca_confirmar'},
        {name: 'preferencias', mapping: 'ca_preferencias'},
        {name: 'coordinador', mapping: 'ca_coordinador'},
        {name: 'diascredito', mapping: 'ca_diascredito'},
        {name: 'cupo', mapping: 'ca_cupo'},
        {name: 'cuentapago', mapping: 'ca_cuentapago'}*/
     ],
       proxy: {
          url: '/widgets4/datosClienteSucursal',
          type: 'ajax',
          autoLoad: true,
          reader: 
          {
             root: 'root',
             totalProperty: 'totalCount',
             id: 'id',
             type: 'json'
          }
       }
    }),
     displayField: 'compania',
     valueField: 'idsucursal',
     typeAhead: false,
     loadingText: 'buscando...',
     triggerAction: 'all',
     hiddenName: 'idcliente',
     name: 'idsucursal',
     id: 'idsucursal',
     //fieldLabel: 'Cliente',
     selectOnFocus: true,     
     enableKeyEvents: true,
     minChars: 3,
     //labelWidth: 50,
     initComponent: function() {
        var me = this; 
        Ext.applyIf(me, {
            emptyText: 'Seleccione un concepto',
            loadingText: 'Loading...',
            store: {type: 'roletemplateslocal'}
        });
        me.callParent(arguments);
        me.getStore().on('beforeload', this.beforeTemplateLoad, this);
    },
 
    beforeTemplateLoad: function(store) {
        if(this.idempresa!="")
        {
            store.proxy.extraParams = {
                idempresa: this.idempresa
            }
        }
    },
    setIdempresa: function(idempresa)
    {
        this.idempresa=idempresa;
    }
     ,
     listConfig: {
        loadingText: 'buscando...',
        emptyText: 'No existen registros',
        getInnerTpl: function() {
            return '<tpl for="."><div class="search-item1"><b>{compania}</b><br>{direccion}</div></tpl>';
        }
    },
     /*alertaCliente: function( record ){
        var mensaje = "";
        if( record.get("status")=="Vetado" ){
            if( mensaje!=""){
                mensaje+="<br />";
            }
            mensaje += "Este cliente se encuentra vetado";
        }

        if( record.get("listaclinton")=="Sí" ){            
            if( mensaje!=""){
                mensaje+="<br />";
            }
            mensaje += "Este cliente se encuentra en lista clinton";
        }



        var fchcircular = record.get("fchcircular");        
        if( !fchcircular ){            
            if( mensaje!=""){
                mensaje+="<br />";
            }
            mensaje += "El cliente no tiene circular 170";

        }else{
            if( fchcircular+(86400*365)<=<?=time()?> ){
                if( mensaje!=""){
                    mensaje+="<br />";
                }
                mensaje += "La circular 170 se encuentra vencida";
                
            }else{
                if( fchcircular+(86400*335)<=<?=time()?> ){
                    
                    if( mensaje!=""){
                        mensaje+="<br />";
                    }
                    mensaje += "La circular 170 se vencera en menos de 30 dias";
                }
            }
        }

        if( mensaje!=""){
            Ext.MessageBox.alert("Alerta", mensaje);
        }
    }*/
     
     
});