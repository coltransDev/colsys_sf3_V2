<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

include_component("widgets", "widgetIncoterms");
//include_component("widgets", "widgetPais");
//include_component("widgets", "widgetCiudad");

?>
<script type="text/javascript">
    PanelTrayectoForm = function( config ) {
        Ext.apply(this,config);
        this.items;        
        if(this.tipo=="Trayecto")
        {
            this.items=[{
                            id: 'cotizacionId',
                            xtype:'hidden',
                            name: 'cotizacionId',
                            value: '<?=$cotizacion->getCaIdcotizacion()?>',
                            allowBlank:false
                        },{
                            id: 'idproducto',
                            xtype:'hidden',
                            name: 'idproducto',
                            value: '',
                            allowBlank:false
                        },{
                            xtype:'textfield',
                            fieldLabel: 'Producto',
                            id: 'producto',
                            name: 'producto',
                            value: '',
                            allowBlank:false,
                            width: 300
                        }
                        ,<?=include_component("widgets", "impoexpo" ,array("id"=>"impoexpo", "label"=>"Impo/Expo"))?>
                        , new WidgetIncoterms({name:"incoterms"})
                        ,<?=include_component("widgets", "transportes" ,array("id"=>"transporte", "allowBlank"=>"false"))?>

                        ,<?=include_component("widgets", "modalidades" ,array("id"=>"modalidad", "label"=>"Modalidad", "allowBlank"=>"false", "transporte"=>"transporte", "impoexpo"=>"impoexpo"))?>
                        ,<?=include_component("widgets", "lineas" ,array("id"=>"idlinea", "label"=>"Linea", "allowBlank"=>"true", "link"=>"transporte" ))?>
                        ,{
                            xtype:'checkbox',
                            fieldLabel: 'Postular nombre de Linea',
                            id: 'postular_linea',
                            name: 'postular_linea',
                            value: false,
                            width: 300
                        }
                        ,<?=include_component("widgets", "paises" ,array("id"=>"tra_origen", "label"=>"Pais Origen","value"=>"CO-057", "allowBlank"=>"false"))?>
                        ,<?=include_component("widgets", "ciudades" ,array("id"=>"ciu_origen", "label"=>"Ciudad Origen", "link"=>"tra_origen", "allowBlank"=>"false"))?>
                        ,<?=include_component("widgets", "paises" ,array("id"=>"tra_destino", "label"=>" Pais Destino", "value"=>"CO-057", "allowBlank"=>"false"))?>
                        ,<?=include_component("widgets", "ciudades" ,array("id"=>"ciu_destino", "label"=>"Ciudad Destino", "link"=>"tra_destino", "allowBlank"=>"false"))?>
                        ,<?=include_component("widgets", "paises" ,array("id"=>"tra_escala", "label"=>"Pais Escala"))?>
                        ,<?=include_component("widgets", "ciudades" ,array("id"=>"ciu_escala", "label"=>"Ciudad Escala", "link"=>"tra_escala"))?>
                        ,{
                            xtype: 'textarea',
                            width: 310,
                            height: 40,
                            fieldLabel: 'Observaciones',
                            name: 'observaciones',
                            value: '',
                            allowBlank:true
                        }
                        ,{
                            xtype: 'textfield',
                            width: 100,
                            fieldLabel: 'Frecuencia',
                            name: 'frecuencia',
                            value: '',
                            allowBlank:true,
                            maxLength:40
                        }
                        ,{
                            xtype: 'textfield',
                            width: 100,
                            fieldLabel: 'T/Transito',
                            name: 'ttransito',
                            value: '',
                            allowBlank:true,
                            maxLength:25
                        }
                        ,
                        new Ext.form.ComboBox({
                            fieldLabel: 'Imprimir',
                            typeAhead: true,
                            forceSelection: true,
                            triggerAction: 'all',
                            emptyText:'',
                            selectOnFocus: true,
                            name: 'imprimir',
                            id: 'imprimir',
                            value: 'Por Item',
                            lazyRender:true,
                            listClass: 'x-combo-list-small',
                            store: [['Por Item', 'Por Item'],['Puerto', 'Puerto'],['Concepto', 'Concepto'],['Trayecto', 'Trayecto']]
                        }),
                        {
                            xtype: 'datefield',
                            width: 100,
                            fieldLabel: 'Vigencia',
                            name: 'vigencia',
                            format: 'Y-m-d',
                            value: '',
                            allowBlank:false
                        }
                    ];
        }
        else if(this.tipo=="OTM/DTA")
        {
            this.items=[{
                            id: 'cotizacionId',
                            xtype:'hidden',
                            name: 'cotizacionId',
                            value: '<?=$cotizacion->getCaIdcotizacion()?>',
                            allowBlank:false
                        },{
                            id: 'idproducto',
                            xtype:'hidden',
                            name: 'idproducto',
                            value: '',
                            allowBlank:false
                        },
                        new Ext.form.ComboBox({
                            fieldLabel: 'Tipo',
                            typeAhead: true,
                            forceSelection: true,
                            triggerAction: 'all',
                            emptyText:'',
                            selectOnFocus: true,
                            name: 'producto',
                            id: 'producto',
                            lazyRender:true,
                            listClass: 'x-combo-list-small',
                            store: [['OTM', 'OTM'],['DTA', 'DTA']]
                        })
                        ,
                        new Ext.form.ComboBox({
                            fieldLabel: 'Modalidad',
                            typeAhead: true,
                            forceSelection: true,
                            triggerAction: 'all',
                            emptyText:'',
                            selectOnFocus: true,
                            name: 'modalidad',
                            id: 'modalidad',
                            lazyRender:true,
                            listClass: 'x-combo-list-small',
                            store: [['FCL', 'FCL'],['LCL', 'LCL']]
                        })
                        ,{
                            xtype:'hidden',
                            id: 'impoexpo',
                            name: 'impoexpo',
                            value: '<?=Constantes::IMPO?>'
                        },
                        {
                            xtype:'hidden',
                            id: 'transporte',
                            name: 'transporte',
                            value: 'OTM-DTA'
                        },
                        {
                            xtype:'hidden',
                            id: 'incoterms',
                            name: 'incoterms',
                            value: ' '
                        },
                        {
                            xtype:'hidden',
                            id: 'imprimir',
                            name: 'imprimir',
                            value: ' '
                        }                        
                        ,<?=include_component("widgets", "ciudades" ,array("id"=>"ciu_origen", "label"=>"Ciudad Origen", "idpais"=>"CO-057", "allowBlank"=>"false"))?>
                        ,<?=include_component("widgets", "ciudades" ,array("id"=>"ciu_destino", "label"=>"Ciudad Destino", "idpais"=>"CO-057", "allowBlank"=>"false"))?>

                        ,{
                            xtype: 'textarea',
                            width: 310,
                            height: 40,
                            fieldLabel: 'Observaciones',
                            name: 'observaciones',
                            value: '',
                            allowBlank:true
                        }
                        ,{
                            xtype: 'textfield',
                            width: 100,
                            fieldLabel: 'Frecuencia',
                            name: 'frecuencia',
                            value: '',
                            allowBlank:true
                        }
                        ,{
                            xtype: 'textfield',
                            width: 100,
                            fieldLabel: 'T/Transito',
                            name: 'ttransito',
                            value: '',
                            allowBlank:true
                        }
                        ,
                        {
                            xtype: 'datefield',
                            width: 100,
                            fieldLabel: 'Vigencia',
                            name: 'vigencia',
                            format: 'Y-m-d',
                            value: '',
                            allowBlank:false
                        }
                    ];
        }


        PanelTrayectoForm.superclass.constructor.call(this, {                
                layout: 'form',
                frame: true,
                title: 'Ingrese los datos del '+this.tipo,
                autoHeight: true,
                bodyStyle: 'padding: 5px 5px 0 5px;',
                labelWidth: 100,
                items: this.items

        });

        
    }

    Ext.extend(PanelTrayectoForm, Ext.FormPanel, {} );

</script>