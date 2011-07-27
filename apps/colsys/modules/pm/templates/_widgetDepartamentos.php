<?php
/*
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
?>
<script type="text/javascript">
    WidgetDepartamentos = function( config ){
        Ext.apply(this, config);
    
        this.dataDepartamentos = <?= json_encode(array("departamentos" => $sf_data->getRaw("departamentos"))) ?>;

        WidgetDepartamentos.superclass.constructor.call(this, {
            fieldLabel: 'Departamento',
            typeAhead: true,
            forceSelection: true,
            triggerAction: 'all',
            emptyText:'',
            selectOnFocus: true,
            value: '',
            
            lazyRender:true,
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
            }),
            listeners:{
                select: this.onSelectCombo
            }
        
        });
    };
    Ext.extend(WidgetDepartamentos, Ext.form.ComboBox, {
        onSelectCombo: function(combo,record,index)
        {                

            var iddepartamento =  this.getValue();

            if( this.linkGrupos ){
                area = Ext.getCmp( this.linkGrupos  );                
                area.store.setBaseParam( "departamento",iddepartamento );
                area.store.load();
                area.setValue("");                
            }

            if( this.linkAsignaciones ){
                assignedto = Ext.getCmp( this.linkAsignaciones );
                assignedto.setValue("");
            }
            //alert( record.data.iddepartamento+" "+iddepartamento );
        }
    });

</script>