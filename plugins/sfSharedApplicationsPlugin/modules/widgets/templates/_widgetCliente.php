<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>



<script type="text/javascript">


WidgetCliente = function( config ){
    Ext.apply(this, config);
    
    this.store = new Ext.data.Store({
        proxy: new Ext.data.HttpProxy({
            url: '<?=url_for('widgets/listaClientesJSON')?>'
        }),
        baseParams:{tipo:(config.tipo)?config.tipo:''},
        reader: new Ext.data.JsonReader({
            root: 'clientes',
            totalProperty: 'totalCount',
            id: 'id'
        }, [            
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
            {name: 'cupo', mapping: 'ca_cupo'}
        ])
    });
    
    WidgetCliente.superclass.constructor.call(this, {
        valueField: 'idcliente',
        displayField:'compania',
        loadingText: 'Buscando...',        
        forceSelection: true,
        minChars: 3,        
        triggerAction: 'all',
        emptyText:'',
        selectOnFocus: true,        
        lazyRender:true,  
        submitValue: true,
        emptyText: 'Escriba el nombre del cliente...'
    });
};


Ext.extend(WidgetCliente, Ext.form.ComboBox, {
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