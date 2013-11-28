<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


?>


<script type="text/javascript">

Ext.define('Ext.colsys.wgCliente', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.wCliente',
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
        {name: 'cupo', mapping: 'ca_cupo'}
     ],
       proxy: {
          url: '/widgets/listaClientesJSON',        
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
     fieldLabel: 'Cliente',
     selectOnFocus: true,
     allowBlank: false,
     anchor: '98%',
     width: 500,
     enableKeyEvents: true,
     //pageSize: true,
     //minListWidth: 220,
     minChars: 3,     
     labelWidth: 60
});
</script>