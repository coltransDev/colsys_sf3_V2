<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/
include_component("idgsistemas", "widgetMultiGrupos");
$grupos = $sf_data->getRaw("grupos");

?>
<script type="text/javascript">
    FormIndicadoresGestionPanel = function( config ){
        Ext.apply(this, config);



        FormIndicadoresGestionPanel.superclass.constructor.call(this, {
            activeTab:0,
            title:'Estadísticas Dpto. de Sistemas',
            layout:'form',
            id: 'estadisticas',
            labelWidth: 75,
            items:[
                {
                    layout:'table',
                    layoutConfig: {
                        // The total column count must be specified here
                        columns: 3
                    },
                    border: false,
                    defaults: {
                        // applied to each contained panel
                        bodyStyle:'padding-right:35px',
                        border: false
                    },
                    items:[
                        {
                            layout: 'form',
                            labelAlign: 'top',
                            items: [
                                {
                                    xtype: 'fieldset',
                                    title: 'Tipo de Estadística',
                                    width: 380,
                                    height: 140,
                                    bodyStyle:'padding-left:15px;',
                                    items: [
                                        {
                                            xtype: 'radiogroup',
                                            fieldLabel: 'Informe por',
                                            itemCls: 'x-check-group-alt',
                                            // Put all controls in a single column with width 100%
                                            columns: 1,
                                            items: [
                                                {boxLabel: 'Indicadores de Gestion', name: 'type_est', inputValue: 1,checked: true},
                                                {
                                                    boxLabel: 'Tickets Cerrados',
                                                    name: 'type_est',
                                                    inputValue: 2

                                                },
                                                {
                                                    boxLabel: 'Tickets Abiertos',
                                                    name: 'type_est',
                                                    inputValue: 3,
                                                    listeners:{
                                                        "check": function(inCheckbox, inChecked){
                                                            var ultseg = Ext.getCmp("ultimoseg");
                                                            var pje = Ext.getCmp("porcentaje");
                                                            var topen = Ext.getCmp("t_open");
                                                            var fchcorte = Ext.getCmp("fch_corte");
                                                            if(inChecked){
                                                                ultseg.enable();
                                                                pje.enable();
                                                                topen.toggleCollapse();
                                                                topen.enable();
                                                                fchcorte.disable();
                                                            }else{
                                                                ultseg.disable();
                                                                pje.disable();
                                                                topen.toggleCollapse(false);
                                                                topen.disable();
                                                                fchcorte.enable();
                                                            }
                                                        }
                                                    }
                                                }]
                                        }]
                                }]
                        },
                        {
                            layout: 'form',
                            labelAlign: 'top',
                            items: [
                                {
                                    xtype: 'fieldset',
                                    title: 'Fechas de Corte',
                                    id:"fch_corte",
                                    width: 210,
                                    height: 140,
                                    bodyStyle: 'padding-left:15px;',
                                    items: [
                                        {
                                            xtype:'datefield',
                                            fieldLabel: 'Fecha Inicial',
                                            name : 'fechaInicial',
                                            format: 'Y-m-d',
                                            value: '<?=date("Y-m-")."01"?>'
                                        },
                                        {
                                            xtype:'datefield',
                                            fieldLabel: 'Fecha final',
                                            name : 'fechaFinal',
                                            format: 'Y-m-d',
                                            value: '<?=date("Y-m-d")?>'
                                        }]
                                }]
                        },
                        {
                            xtype:'hidden',
                            name:"opcion",
                            value:"buscar"
                        }]
                },
                {
                    xtype:'fieldset',
                    checkboxToggle:true,
                    autoHeight:true,
                    id:"t_open",
                    title: 'Parametros',
                    collapsed: true,
                    checkboxName: "checkboxOpenTicket",
                    layout:"column",
                    layoutConfig:{
                        columns:2
                    },
                    items:[
                        {
                            layout:'table',
                            layoutConfig: {
                                columns: 2
                                },
                            border: false,
                            defaults: {
                                bodyStyle:'padding-right:20px;background-color:#EEEEEE',
                                border: false
                            },
                            autoHeight:true,
                            items:[
                                {
                                    layout: 'form',
                                    labelAlign: 'top',
                                    width: 300,
                                    items: [
                                        {
                                            xtype:'datefield',
                                            fieldLabel: 'Ultimo Seguimiento antes de',
                                            name : 'ultimoseg',
                                            id: 'ultimoseg',
                                            format: 'Y-m-d',
                                            value: '<?=date("Y-m-d")?>',
                                            disabled: true,
                                            width: 100,
                                            bodyStyle:'padding-left:15px;'
                                            //columnWidth: .6
                                        }]
                                },
                                {
                                    layout: 'form',
                                    labelAlign: 'top',
                                    width: 220,
                                    items: [
                                        {
                                            xtype: 'numberfield',
                                            fieldLabel: 'Porcentaje inferior a (%)',
                                            name: 'porcentaje',
                                            id: 'porcentaje',
                                            minValue: 0,
                                            maxValue: 100,
                                            disabled: true,
                                            width: 30,
                                            incrementValue: 10,
                                            accelerate: true,
                                            value: '100'
                                        }]
                                }]
                        }]
                },
                {
                    xtype:'fieldset',
                    checkboxToggle:true,
                    title: 'Filtrar por Grupo',
                    autoHeight:true,
                    id: 'gr',                    
                    defaultType: 'textfield',
                    collapsed: true,
                    checkboxName: "checkboxGrupo",
                    
                    items :[
                        /*new WidgetDepartamentos({
                            hiddenName: 'departamento',
                            id: 'departamento_id',
                            linkGrupos: "grupo",
                            linkAsignaciones: "usuario2",
                            width: 150                            
                        }),
                        new WidgetGrupos({
                            name: 'grupo',//
                            id:'grupo',//,
                            
                            linkAsignaciones: "usuario2",
                            width: 150
                            
                        }),
                        new WidgetAsignaciones({
                            id: 'usuario2',
                            name: 'usuario2'
                        })*/
                        new WidgetMultiGrupos({title: 'Grupos',
                            fieldLabel:"grupos",
                            id: 'grupos',
                            name: 'grupos[]',
                            width:230/*,
                            value:'<?//=implode(",", $grupos)?>'*/
                        })
                        
                    ]
                },
                
                {
                    xtype:'fieldset',
                    checkboxToggle:true,
                    title: 'Límites de Control',
                    autoHeight:true,
                    width: 630,
                    layout:'column',
                    labelWidth: 0.1,
                    columns: 1,
                    collapsed: true,
                    checkboxName: "checkboxLimite",
                    defaults:{
                        xtype:'fieldset',
                        columnWidth:0.33,
                        layout:'form',
                        border:false
                    },
                    items:[{
                            //columnWidth:.3,
                            items: [
                                {
                                    xtype:'timefield',
                                    name: 'lcs',
                                    id: 'lcs',
                                    value: '',
                                    width: 95,
                                    format: 'H:i:s',
                                    fieldLabel: "  LCs"
                                }]
                        },
                        {

                            items: [
                                {
                                    xtype:'timefield',
                                    name: 'lc',
                                    id: 'lc',
                                    value: '',
                                    width: 95,
                                    format: 'H:i:s',
                                    fieldLabel: " LC"
                                }]
                        },
                        {
                            items: [
                                {
                                    xtype:'timefield',
                                    name: 'lci',
                                    id: 'lci',
                                    value: '',
                                    width: 95,
                                    format: 'H:i:s',
                                    fieldLabel: "  LCi"
                                }]
                        }]
                }]
        });

    };

    Ext.extend(FormIndicadoresGestionPanel, Ext.Panel, {

    });
</script>