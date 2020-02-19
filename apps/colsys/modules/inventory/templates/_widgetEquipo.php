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
        /*this.resultTpl = new Ext.XTemplate(
            '<tpl for="."><div class="search-item"><b>{identificador}</b><br />{asignadoa} - {ubicacion}</div></tpl>'
        );*/

        this.resultTpl = new Ext.XTemplate(
            '<tpl for=".">',
            '<tpl if="!this.idempresa(idempresa)">',
                '<div class="search-item">',
                '<span style="color:#F89253;"><b>{identificador}</b></span><br /><span style="font-size:9px;">{asignadoa} - {ubicacion}</span>',                
            '</tpl>',
            '<tpl if="this.idempresa(idempresa)">',
                '<div class="search-item">',
                '<span style="color:#33518C;"><b>{identificador}</b></span><br /><span style="font-size:9px;">{asignadoa} - {ubicacion}</span>',                
            '</tpl>',
            '</span></div></tpl>',
            {
                idempresa: function(val){                    
                    var grupo = "<?=json_encode($sf_data->getRaw("grupoEmp"))?>";
                    
                    grupo = grupo.replace('[','').replace(']','')+',';                    
                    if(grupo.indexOf(val) >= 0)
                        return true;
                    else
                        return false;                    
                }
            }
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
                {name: 'asignadoa', mapping: 'u_ca_nombre'},
                {name: 'idempresa', mapping: 'idempresa'}
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