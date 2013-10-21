<?php
/*
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
?>
<script type="text/javascript">
    PanelPreliquidaForm = function( config ) {        
        Ext.apply(this,config);
        this.items=[{
                id: 'cotizacionId',
                xtype:'hidden',
                name: 'cotizacionId',
                value: '<?= $cotizacion->getCaIdcotizacion() ?>',
                allowBlank:false
            },{
                id: 'idproducto',
                xtype:'hidden',
                name: 'idproducto',
                value: '',
                allowBlank:false
            },{
                xtype:'textfield',
                fieldLabel: '# Piezas',
                id: 'piezas',
                name: 'piezas',
                value: '',
                allowBlank:true,
                width: 150
            },{
                xtype:'textfield',
                fieldLabel: '# Pallets',
                id: 'pallets',
                name: 'pallets',
                value: '',
                allowBlank:true,
                width: 150
            },{
                xtype:'textfield',
                fieldLabel: '# Docs.Transporte',
                id: 'documentos',
                name: 'documentos',
                value: '',
                allowBlank:true,
                width: 150
            },{
                xtype:'textfield',
                fieldLabel: '# Warehouse',
                id: 'warehouse',
                name: 'warehouse',
                value: '',
                allowBlank:true,
                width: 150
            },{
                xtype: 'textarea',
                width: 310,
                height: 40,
                fieldLabel: 'Observaciones',
                name: 'preliquida',
                value: '',
                allowBlank:true
            }
        ];

        PanelPreliquidaForm.superclass.constructor.call(this, {                
            layout: 'form',
            frame: true,
                
            autoHeight: true,
            bodyStyle: 'padding: 5px 5px 0 5px;',
            labelWidth: 100,
            items: this.items
        });

    }
    Ext.extend(PanelPreliquidaForm, Ext.FormPanel, {} );
</script>