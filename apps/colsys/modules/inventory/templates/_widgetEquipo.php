<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

//echo $trafico."widget";
?>

<script type="text/javascript">
    WidgetEquipo = function( config ){
        Ext.apply(this, config);
        this.resultTpl = new Ext.XTemplate(
            '<tpl for="."><div class="search-item"><b>{identificador}</b><br />{asignadoa} - {ubicacion}</div></tpl>'
        );
        
        this.store = new Ext.data.Store({				
				
            reader: new Ext.data.JsonReader({
                root: 'root',
                totalProperty: 'total',
                successProperty: 'success'
            }, [
                {name: 'idactivo', mapping: 'a_ca_idactivo'},
                {name: 'identificador', mapping: 'a_ca_identificador'},
                {name: 'ubicacion', mapping: 's_ca_nombre'},
                {name: 'asignadoa', mapping: 'u_ca_nombre'}
            ]), 
            proxy: new Ext.data.HttpProxy({
                url: '<?= url_for('inventory/datosWidgetEquipo') ?>'
            })
        });

        WidgetEquipo.superclass.constructor.call(this, {
            valueField: 'idactivo',
            displayField: 'identificador',        
            forceSelection: true,        
            emptyText:'',
            minChars: 2,
            triggerAction: 'all',
            selectOnFocus: true,
            lazyRender:true,       
            tpl: this.resultTpl,
            itemSelector: 'div.search-item',
            listClass: 'x-combo-list-small',
            submitValue: true        
        });
    };


    Ext.extend(WidgetEquipo, Ext.form.ComboBox, {
    
    });
</script>