<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//$data = $sf_data->getRaw("data");
?>
<script type="text/javascript">


Ext.define('mdCliente',{
    extend: 'Ext.data.Model',
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
    ]
});
Ext.define('Ext.colsys.wgCliente', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.wCliente',
    triggerTip: 'Click para limpiar',    
    store: {
        model: 'mdCliente',
        proxy: {
        type: 'ajax',
        url: '<?=url_for("/widgets/listaClientesJSON")?>',
         reader: {
             type: 'json',
             rootProperty: 'clientes'
         }
        },
        autoLoad: false
    },
    qtip:'Listado ',
    queryMode: 'remote',
    displayField: 'compania',
    valueField: 'idcliente',
    listConfig: {
        loadingText: 'buscando...',
        emptyText: 'No existen registros',
        getInnerTpl: function() {
            return '<tpl for="."><div class="search-item"><strong>{compania}</strong><br /><span><br />{nombre_ven}</span> </div></tpl>';
        }
    },
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
    }
});
</script>