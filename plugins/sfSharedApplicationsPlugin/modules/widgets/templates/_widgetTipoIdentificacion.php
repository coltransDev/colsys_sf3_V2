<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */


?>

<script type="text/javascript">
    WidgetTipoIdentificacion = function( config ){
        Ext.apply(this, config);
        this.resultTpl = new Ext.XTemplate(
                '<tpl for="."><div class="search-item"><b>{name}</b><br /><span>{trafico} </span> </div></tpl>'
        )
 
    

        WidgetTipoIdentificacion.superclass.constructor.call(this, {
            mode:           'local',
            triggerAction:  'all',
            forceSelection: true,
            editable:       false,
            displayField:   'name',
            valueField:     'value',
            tpl: this.resultTpl,
            itemSelector: 'div.search-item',    
            store:          new Ext.data.JsonStore({
                fields : [ 'name', 'value', 'idtrafico', 'trafico'],
                data   : [
                    <?
                    $i=0;
                    foreach( $tipos as $t ){
                        echo ($i++!=0)?",":"";
                        echo "{ value: '".$t->getCaTipoidentificacion()."', name: '".$t->getCaNombre()."', 'idtrafico': '".$t->getCaIdtrafico()."', 'trafico': '".($t->getTrafico()?$t->getTrafico()->getCaNombre():"")."' }";
                    }
                    ?>
                ]
            })
        });
    };


    Ext.extend(WidgetTipoIdentificacion, Ext.form.ComboBox, {
        getIdtrafico: function(){
            var idtrafico = null;
            var rec = this.getRecord();
            if( rec ){
                idtrafico = rec.data.idtrafico;
            }            
            return idtrafico;
        },      
    
        getRecord: function(){        
            if( this.hiddenField ){
                var val = this.hiddenField.value;
            }else{
                var val = this.getValue();
            }        
            if( val ){
                var record = this.findRecord(this.valueField, val);
                return record;
            }
            return null;
        }
    });
</script>