/*
    * @autor    Nataly Puentes
    * @return   ComboBox Clientes según filtro ingresado
    * @param
    *           query : texto digitado para filtrar 
    * @date     2016-03-31
*/



Ext.define('Colsys.Widgets.wgCliente', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.Colsys.Widgets.wgCliente',
    store: new Ext.data.Store(
    {
       //model: 'ClientesModel',       
       fields: [
        {name: 'idcliente', mapping: 'ca_idcliente'},
        {name: 'compania', mapping: 'ca_compania'},
        {name: 'cargo', mapping: 'ca_cargo'},			
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
        {name: 'cuentapago', mapping: 'ca_cuentapago'}
     ],
       proxy: {
          url: '/widgets5/listaClientesJSON',
          type: 'ajax',
          autoLoad: true,
          reader: 
          {
             root: 'clientes',
             totalProperty: 'totalCount',
             id: 'id',
             type: 'json'
          }
       }
    }),
     displayField: 'compania',
     valueField: 'idcliente',
     typeAhead: false,
     loadingText: 'buscando...',
     triggerAction: 'all',
     hiddenName: 'idcliente',
     name: 'cliente',
     id: 'cliente',
     //fieldLabel: 'Cliente',
     selectOnFocus: true,     
     enableKeyEvents: true,
     minChars: 3,
     labelWidth: 50,
     alertaCliente: function( record ){
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
            if( fchcircular+(86400*365)<=time()){
                if( mensaje!=""){
                    mensaje+="<br />";
                }
                mensaje += "La circular 170 se encuentra vencida";
                
            }else{
                if( fchcircular+(86400*335)<=time()){
                    
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
    }
     
     
});