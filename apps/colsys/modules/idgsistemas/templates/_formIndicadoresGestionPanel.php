<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/
$narea = $sf_data->getRaw("narea");

if(is_array($narea)){
    foreach($narea as $area){
        if($area!=""){
            $areas = Doctrine::getTable("HdeskGroup")->find($area);
            $arrayAreas[] = $areas->getCaIdgroup();    
        }
    }
}


?>
<script type="text/javascript">
    FormIndicadoresGestionPanel = function( config ){
        Ext.apply(this, config);
        
        this.dataDepartamentos = <?=json_encode(array("departamentos" => $sf_data->getRaw("departamentos")))?>;
        
        this.departamentos = new Ext.form.ComboBox({
            fieldLabel: 'Departamento',
            typeAhead: true,
            forceSelection: true,
            triggerAction: 'all',
            emptyText:'',
            selectOnFocus: true,
            value: '<?=$departamento?$departamento->getCaNombre():""?>',
            hiddenValue: '<?=$departamento?$departamento->getCaIddepartamento():""?>',
            hiddenName: 'departamento',
            id: 'departamento_id',
            lazyRender:true,
            allowBlank: false,
            listClass: 'x-combo-list-small',
            displayField: 'nombre',
            valueField: 'iddepartamento',
            store : new Ext.data.Store({
                autoLoad : true ,
                proxy: new Ext.data.MemoryProxy( this.dataDepartamentos ),
                reader: new Ext.data.JsonReader(
                {
                    id: 'iddepartamento',
                    root: 'departamentos'
                },
                Ext.data.Record.create([
                    {name: 'iddepartamento'},
                    {name: 'nombre'}
                ])
            )
            })
        });

        this.departamentos.on("select", this.cargarDepartamentos, this );

        var tagStore = new Ext.data.JsonStore({        
                id:'idgrupo',
                root:'root',
                fields:[
                        {name:'idgrupo', type:'int'},
                        {name:'nombre', type:'string'}
                ],
                url: '<?=  url_for("idgsistemas/datosAreas")?>'
        });

        this.milestones1 = new Ext.form.ComboBox({
            alias: 'widget.wStatus',
            fieldLabel: 'Status Inicial',
            typeAhead: true,
            forceSelection: true,
            triggerAction: 'all',
            emptyText:'',
            selectOnFocus: true,
            value: '<?=$etapa1?$etapa1:''?>',
            hiddenValue: '<?=$idetapa1?$idetapa1:''?>',
            width: 150,
            id: 'milestone_id1',
            lazyRender:true,
            allowBlank: true,
            displayField: 'valor',
            valueField: 'status',
            hiddenName: 'status1',
            listClass: 'x-combo-list-small',
            mode: 'local',
            store : new Ext.data.Store({
                autoLoad : false ,
                url: '<?=url_for("pm/datosStatus")?>',
                reader: new Ext.data.JsonReader({                        
                        root: 'root',
                        totalProperty: 'total',
                        successProperty: 'success'
                    },
                    Ext.data.Record.create([
                        {name: 'status'},
                        {name: 'valor'}
                    ])
                )
            })
        });
        
        this.milestones2 = new Ext.form.ComboBox({
            alias: 'widget.wStatus',
            fieldLabel: 'Status Final',
            typeAhead: true,
            forceSelection: true,
            triggerAction: 'all',
            emptyText:'',
            selectOnFocus: true,
            value: '<?=$etapa2?$etapa2:''?>',
            hiddenValue: '<?=$idetapa2?$idetapa2:''?>',
            width: 150,
            id: 'milestone_id2',
            lazyRender:true,
            allowBlank: true,
            displayField: 'valor',
            valueField: 'status',
            hiddenName: 'status2',
            listClass: 'x-combo-list-small',
            mode: 'local',
            store : new Ext.data.Store({
                autoLoad : false ,
                url: '<?=url_for("pm/datosStatus")?>',
                reader: new Ext.data.JsonReader(
                    {                        
                        root: 'root',
                        totalProperty: 'total',
                        successProperty: 'success'
                    },
                    Ext.data.Record.create([
                        {name: 'status'},
                        {name: 'valor'}
                    ])
                )
            })
        });

        FormIndicadoresGestionPanel.superclass.constructor.call(this, {
            activeTab:0,
            title:'Estadísticas Help Desk',
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
                                            items: [{
                                                    boxLabel: 'Indicadores de Gestion', 
                                                    name: 'type_est', 
                                                    inputValue: 1,
                                                    listeners:{
                                                        "check": function(inCheckbox, inChecked){                                                            
                                                            var limites = Ext.getCmp("limites");
                                                            var lcs = Ext.getCmp("lcs");
                                                            if(inChecked){
                                                                limites.toggleCollapse(false);                                                                
                                                                lcs.allowBlank = false;
                                                            }else{
                                                                limites.toggleCollapse();
                                                                lcs.allowBlank = true;
                                                            }
                                                        }
                                                    },
                                                    <?= $type_est == 1 ? "checked:'true'" : "" ?>
                                                },
                                                {
                                                    boxLabel: 'Tickets Cerrados',
                                                    name: 'type_est',
                                                    inputValue: 2,
                                                    <?= $type_est == 2 ? "checked:'true'" : "" ?>
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
                                                    },
                                                    <?= $type_est == 3 ? "checked:'true'" : "" ?>
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
                                            value: '<?=$fechaInicial?$fechaInicial:date("Y-m-")."01"?>'
                                        },
                                        {
                                            xtype:'datefield',
                                            fieldLabel: 'Fecha final',
                                            name : 'fechaFinal',
                                            format: 'Y-m-d',
                                            value: '<?=$fechaFinal?$fechaFinal:date("Y-m-d")?>'
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
                    title: '',
                    autoHeight:true,
                    id: 'panel_departamento',                                        
                    items :[
                        this.departamentos
                    ]
                },
                {
                    xtype:'fieldset',                    
                    title: 'Filtrar por Areas (Opcional)',
                    autoHeight:true,
                    id: 'panel_area',
                    items :[
                        {
                            xtype:'superboxselect',
                            allowBlank:true,
                            msgTarget: 'under',
                            allowAddNewData: true,
                            value:'<?=$arrayAreas?implode(",", $arrayAreas):""?>',
                            id: 'area_id',
                            fieldLabel: '',
                            emptyText: '',
                            resizable: true,
                            name: 'area[]',
                            anchor:'100%',
                            store: tagStore,
                            mode: 'remote',
                            displayField: 'nombre',
                            valueField: 'idgrupo',
                            extraItemCls: 'x-tag',
                            queryDelay: 0,
                            triggerAction: 'all',
                            minChars: 1,
                            hiddenName: 'narea[]',
                            listeners:{
                                additem: function(t, newItem, filtered){
                                    /* Para habilitar el cálculo x Status sólo se puede elegir 1 área*/                                    
                                    var idgrupo = newItem;
                                    if(this.getCount()>1 || this.getCount()<0){           
                                        Ext.getCmp("fieldset-status").setDisabled(true); 
                                        Ext.getCmp("fieldset-status").collapse();
                                        Ext.getCmp("fieldset-status").hide();                                        
                                    }else{
                                        console.log("322");
                                        Ext.getCmp("fieldset-status").setDisabled(false);                                                                                
                                        Ext.getCmp("fieldset-status").show();
                                        Ext.getCmp("fieldset-status").idgrupo = idgrupo;
                                    }
                                }                        
                            }
                        }
                    ]
                },
                {
                    xtype:'fieldset',
                    checkboxToggle:true,
                    autoHeight:true,
                    id:"t_open",
                    title: 'Parametros',
                    bodyStyle: 'align: left',
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
                    title: 'Límites de Control',
                    autoHeight:true,
                    width: 630,
                    id:"limites",
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
                    items:[
                        {
                            items: [{
                                xtype:'timefield',
                                name: 'lcs',
                                id: 'lcs',
                                value: '<?=$lcs?$lcs:""?>',
                                width: 95,
                                format: 'H:i:s',
                                fieldLabel: "  LC Superior"
                            }]
                        },
                        {
                            items: [{
                                xtype:'timefield',
                                name: 'lc',
                                id: 'lc',
                                value: '',
                                width: 95,
                                format: 'H:i:s',
                                fieldLabel: " LC (Opcional)"
                            }]
                        },
                        {
                            items: [{
                                xtype:'timefield',
                                name: 'lci',
                                id: 'lci',
                                value: '',
                                width: 95,
                                format: 'H:i:s',
                                fieldLabel: "  LC (Opcional)"
                            }]
                        }]
                },
                {
                    xtype:'fieldset',
                    checkboxToggle:true,
                    title: 'x Status',
                    autoHeight:true,
                    width: 630,
                    idgrupo: '<?=$narea[0]?$narea[0]:""?>',
                    id:"fieldset-status",
                    layout:'column',
                    labelWidth: 0.1,
                    columns: 1,
                    collapsed: true,
                    checkboxName: "checkboxStatus",
                    defaults:{
                        xtype:'fieldset',
                        columnWidth:0.5,
                        layout:'form',
                        border:false
                    },
                    items:[{                        
                        items: [
                            this.milestones1
                        ]
                    },
                    {
                        items: [
                            this.milestones2
                        ]
                    }],
                    listeners:{
                        expand: function(p){
                            
                            Ext.getCmp('milestone_id1').allowBlank = false;
                            Ext.getCmp('milestone_id2').allowBlank = false;
                            
                            milestone = Ext.getCmp('milestone_id1');
                            milestone.store.baseParams = {
                                idgrupo: this.idgrupo
                            };
                            milestone.store.load();

                            milestone = Ext.getCmp('milestone_id2');
                            milestone.store.baseParams = {
                                idgrupo: this.idgrupo
                            };
                            milestone.store.load();                            
                        },
                        collapse: function(p){
                            Ext.getCmp('milestone_id1').allowBlank = true;
                            Ext.getCmp('milestone_id2').allowBlank = true;
                        },
                        render: function(){
                            if('<?=$checkboxStatus?>'=="on"){                                
                                this.toggleCollapse(false);
                            }                            
                        }
                    }
                }]
        });

    };

    Ext.extend(FormIndicadoresGestionPanel, Ext.Panel, {
    
        cargarDepartamentos: function(  ){           
            var iddepartamento =  Ext.getCmp('departamento_id').hiddenField.value;
            area = Ext.getCmp('area_id');
            area.store.setBaseParam( "departamento",iddepartamento );
            area.store.load();
            area.setValue("");
        }
        
    });
</script>