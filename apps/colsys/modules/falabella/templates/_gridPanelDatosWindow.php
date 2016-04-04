<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>
<script type="text/javascript">

Ext.define('GridPanelDatosWindow', {

    extend : 'Ext.window.Window',

    constructor: function(config) {
        this.initConfig(config);
        this.callParent(arguments);
    },
    
    initComponent : function() {
    
        Ext.define('Graficas', {
            extend: 'Ext.data.Model',
            idProperty: 'id',
            fields: [
                {name: 'cofa', type: 'string'},
                {name: 'origen', type: 'string'},
                {name: 'destino', type: 'string'},                
                {name: 'modalidad', type: 'string'},
                {name: 'rn', type: 'string'},
                {name: 'fchsalida', type: 'date', dateFormat:'Y-m-d'},
                {name: 'fchllegada', type: 'date', dateFormat:'Y-m-d'},
                {name: 'fchdocorig', type: 'date', dateFormat:'Y-m-d'},
                {name: 'fchingresoasn', type: 'date', dateFormat:'Y-m-d'},
                {name: 'beginw', type: 'date', dateFormat:'Y-m-d'},
                {name: 'endw', type: 'date', dateFormat:'Y-m-d'}
            ]
        });
        
        var storeGraph = Ext.create('Ext.data.Store', {
            model: 'Graficas',
            data: this.datos
        });

        Ext.apply(this, {
            width: 800,
            id: "nuevo-seguimiento",
            layout: 'fit',
            closeAction: 'destroy',            
            items: [
                {
                    xtype: 'grid',
                    store: storeGraph,
                    id: 'grid-idg',
                    autoScroll: true,
                    resizable: true,
                    border: false,
                    columns: [                                                        
                        {
                            text: 'Cofa',                    
                            sortable: true,
                            dataIndex: 'cofa',
                            hideable: true
                        },
                        {
                            text: 'Origen',
                            sortable: true,
                            dataIndex: 'origen',
                            hideable: true
                        },
                        {
                            text: 'Destino',                    
                            sortable: true,
                            dataIndex: 'destino',
                            hideable: true
                        },                            
                        {
                            text: 'Mod.',                    
                            sortable: true,
                            dataIndex: 'modalidad',
                            hideable: true
                        },
                            {
                            text: 'RN',                    
                            sortable: true,
                            dataIndex: 'rn',
                            hideable: true
                        },                            
                        {
                            text: 'Fch. Salida',                    
                            sortable: true,
                            dataIndex: 'fchsalida',
                            hideable: false,
                            format: 'Y-m-d',
                            renderer: function(value){
                                return Ext.util.Format.date(value, 'Y-m-d');
                            }
                        },
                        {
                            text: 'Fch. Llegada',                    
                            sortable: true,
                            dataIndex: 'fchllegada',
                            hideable: false,
                            format: 'Y-m-d',
                            renderer: function(value){
                                return Ext.util.Format.date(value, 'Y-m-d');
                            }

                        },
                        {
                            text: 'Fch. IngAsn',                    
                            sortable: true,
                            dataIndex: 'fchingresoasn',
                            hideable: false,
                            format: 'Y-m-d',
                            renderer: function(value){
                                return Ext.util.Format.date(value, 'Y-m-d');
                            }
                        },
                        {
                            text: 'Fch. EnvDoc.',                    
                            sortable: true,
                            dataIndex: 'fchdocorig',
                            hideable: false,
                            format: 'Y-m-d',
                            renderer: function(value){
                                return Ext.util.Format.date(value, 'Y-m-d');
                            }
                        },
                        {
                            text: 'Fch. IniVen',                    
                            sortable: true,
                            dataIndex: 'beginw',
                            hideable: false,
                            format: 'Y-m-d',
                            renderer: function(value){
                                return Ext.util.Format.date(value, 'Y-m-d');
                            }
                        },
                        {
                            text: 'Fch. FinVen.',                    
                            sortable: true,
                            dataIndex: 'endw',
                            hideable: false,
                            format: 'Y-m-d',
                            renderer: function(value){
                                return Ext.util.Format.date(value, 'Y-m-d');
                            }
                        },
                        {
                            text: 'Fch. FinVen.',                    
                            sortable: true,
                            dataIndex: 'endw',
                            hideable: false,
                            format: 'Y-m-d',
                            renderer: function(value){
                                return Ext.util.Format.date(value, 'Y-m-d');
                            }
                        } 
                    ]
                }]
        });


        this.callParent(arguments);
    }// initComponent
});

</script>