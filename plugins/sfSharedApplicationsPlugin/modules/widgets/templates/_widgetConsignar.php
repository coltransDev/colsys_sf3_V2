<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

$data = $sf_data->getRaw("data");

?>



<script type="text/javascript">


WidgetConsignar = function( config ){
    Ext.apply(this, config);
    this.data = <?=json_encode($data)?>;
    this.store = new Ext.data.Store({
				autoLoad : false,
				reader: new Ext.data.JsonReader(
					{
						root: 'root'                        
					},
					Ext.data.Record.create([
                        {name: 'b_ca_idbodega'},
                        {name: 'b_ca_tipo'},
                        {name: 'b_ca_transporte'},
						{name: 'b_ca_nombre'}
					])
				)				
			});

    WidgetConsignar.superclass.constructor.call(this, {
        valueField: 'b_ca_idbodega',
        displayField: 'b_ca_nombre',
        typeAhead: true,
        forceSelection: true,
        triggerAction: 'all',
        emptyText:'',
        selectOnFocus: true,        
        lazyRender:true,
        mode: 'local',
        listClass: 'x-combo-list-small',
        listeners: {
            focus: this.onFocusWdg
        }
    });
};


Ext.extend(WidgetConsignar, Ext.form.ComboBox, {
    onFocusWdg: function( field, newVal, oldVal ){
        
        var cmp = Ext.getCmp(this.linkTransporte);
        
        if( cmp ){
                     
            var list = new Array();
            var transporte = Ext.getCmp(this.linkTransporte).getValue();
            var i = 0;
            for( k in this.data ){
                var rec = this.data[k];

                if( transporte=='<?=Constantes::AEREO?>' && rec.b_ca_tipo=='Coordinador Logístico'){
                    list.push( rec );
                }
                
                if( transporte && rec.b_ca_transporte==transporte ){                
                    list.push( rec );
                }
            }
            
            var data = new Object();
            data.root = list;

            this.store.loadData(data);

        }else{
            alert( "arrrrg: No existe el componente id: "+e.combo.linkTransporte+"!");
        }
    }
});

	
</script>