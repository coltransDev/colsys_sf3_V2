<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
$data = $sf_data->getRaw("data");
//echo $trafico."widget";
?>

<script type="text/javascript">
    WidgetProducto = function( config ){
        Ext.apply(this, config);
                
        this.store = new Ext.data.Store({				
			autoload: true,	
            reader: new Ext.data.JsonReader({
                root: 'root',
                totalProperty: 'total',
                successProperty: 'success'
            }, [                
                {name: 'nombre', mapping: 'p_ca_nombre'}
                
            ]), 
            proxy: new Ext.data.HttpProxy({
                url: '<?= url_for('inventory/datosWidgetProducto') ?>'
            }),
            baseParams: {
                idcategory: this.idcategory
            }
        });
        
        
        WidgetProducto.superclass.constructor.call(this, {
            valueField: 'nombre',
            displayField: 'nombre',        
            forceSelection: true,        
            emptyText:'',            
            triggerAction: 'all',
            selectOnFocus: true,
            lazyRender:true,                               
            listClass: 'x-combo-list-small',
            submitValue: true,
            mode: 'local',
            listeners: {
                afterrender : this.onAfterRender
            }
        });
    };


    Ext.extend(WidgetProducto, Ext.form.ComboBox, {
        onAfterRender: function(){
            this.store.load();
        }
    });
</script>