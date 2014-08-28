new Ext.FormPanel({
    id: 'consultaparametros-form',
    layout: 'form',
    frame: true,
    title: 'Parametros',
    autoHeight: true,
    bodyStyle: 'padding: 5px 5px 0 5px;',
    labelWidth: 60,
    frame: false,
    items: [			
        new Ext.form.ComboBox({
            fieldLabel: 'Consulta',
            typeAhead: true,
            width: 120,
            forceSelection: true,
            triggerAction: 'all',
            emptyText:'Seleccione',
            selectOnFocus: true,
            name: 'consulta',            
            allowBlank: true,
            lazyRender:true,
            listClass: 'x-combo-list-small',
            store : [
                ['definicion-conceptos','Def. de conceptos'],
                ['definicion-patios','Def. de Patios']
            ]
        })
    ]
    ,
    buttons: [{
        text     : 'Consultar',
        handler: function(){
            var fp = Ext.getCmp("consultaparametros-form");
            if( fp.getForm().isValid() ){
                var consulta = fp.getForm().findField("consulta").getValue();
                
                if(consulta=="definicion-conceptos"){
                    var newComponent = new PanelParametros({
                        closable: true,
                        title: 'Def. de Conceptos',
                        readOnly: <?= $opcion == "consulta" ? "true" : "false" ?>
                    });
                }else{
                    var newComponent = new PanelPatios({
                        closable: true,
                        title: 'Def. de Patios',
                        readOnly: <?= $opcion == "consulta" ? "true" : "false" ?>
                    });
                }
                Ext.getCmp('tab-panel').add(newComponent);
                Ext.getCmp('tab-panel').setActiveTab(newComponent);
            }else{
                Ext.MessageBox.alert('Error', '¡Por favor coloque los valores requeridos!');
            }	            	
        }
    }]
})