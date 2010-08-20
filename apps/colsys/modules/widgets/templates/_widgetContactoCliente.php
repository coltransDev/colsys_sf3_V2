<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */


?>
<script type="text/javascript">


WidgetContactoCliente = function( config ){
    Ext.apply(this, config);
    
    this.store = new Ext.data.Store({
        proxy: new Ext.data.HttpProxy({
            url: '<?=url_for('widgets/listaContactosClientesJSON')?>'
        }),
        reader: new Ext.data.JsonReader({
            root: 'clientes',
            totalProperty: 'totalCount',
            id: 'id'
        }, [
            {name: 'idcontacto', mapping: 'ca_idcontacto'},
            {name: 'idcliente', mapping: 'ca_idcliente'},
            {name: 'compania', mapping: 'ca_compania'},
			{name: 'cargo', mapping: 'ca_cargo'},
			{name: 'nombre', mapping: 'ca_nombres'},
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

    this.resultTpl = new Ext.XTemplate(
            '<tpl for="."><div class="search-item"><b>{compania}</b><br /><span>{nombre} {papellido} {sapellido} <br />{cargo}</span> </div></tpl>'
    );
    WidgetContactoCliente.superclass.constructor.call(this, {
        valueField: 'idcontacto',
        displayField:'nombre',
        loadingText: 'Buscando...',
        typeAhead: true,
        forceSelection: true,
        minChars: 3,
        tpl: this.resultTpl,
        triggerAction: 'all',
        emptyText:'',
        selectOnFocus: true,        
        lazyRender:true,        
        itemSelector: 'div.search-item',
        emptyText: 'Escriba el nombre del cliente...',
        allowBlank:false

    });



}


Ext.extend(WidgetContactoCliente, Ext.form.ComboBox, {
    alertaCliente: function( record ){
        var mensaje = "";
        if( record.get("status")=="Vetado" ){
            if( mensaje!=""){
                mensaje+="<br />";
            }
            mensaje += "Este cliente se encuentra vetado";
        }

        if( record.get("listaclinton")=="S�" ){
            //Ext.MessageBox.alert("Alerta","Este cliente se encuentra en lista clinton");
            if( mensaje!=""){
                mensaje+="<br />";
            }
            mensaje += "Este cliente se encuentra en lista clinton";
        }



        var fchcircular = record.get("fchcircular");
        //alert( fchcircular);
        if( !fchcircular ){
            //Ext.MessageBox.alert("Alerta","El cliente no tiene circular 170");
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
                //Ext.MessageBox.alert("Alerta","La circular 170 se encuentra vencida");
            }else{
                if( fchcircular+(86400*335)<=<?=time()?> ){
                    //Ext.MessageBox.alert("Alerta","La circular 170 se vencera en menos de 30 dias");
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