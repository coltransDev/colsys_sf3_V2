<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */


?>
<script type="text/javascript">


FormComprobanteSubpanel = function(){

    
    this.columns = [{
        
        header: "Concepto",
        dataIndex: 'idconcepto',
        sortable:true,
        width: 420

        
      },{
        header: "Valor",
        dataIndex: 'valor',
        width: 100,        
        sortable:true
      },{        
        header: "Cuenta",
        dataIndex: 'idcuenta',
        width: 150,        
        sortable:true
    }];

    
    this.record = Ext.data.Record.create([            
            {name: 'idmaestra', type: 'string'},
            {name: 'idconcepto', type: 'string'},
            {name: 'concepto', type: 'string'},
            {name: 'valor', type: 'float'},
            {name: 'idcuenta', type: 'int'}

        ]);

    this.store = new Ext.data.Store({       

        autoLoad : true,
        url: '<?=url_for("ino/formComprobanteData?id=".$referencia->getCaIdmaestra())?>',
        reader: new Ext.data.JsonReader(
            {

                root: 'items',
                totalProperty: 'total'
            },
            this.record
        )
    });

    
  

    FormComprobanteSubpanel.superclass.constructor.call(this, {
       loadMask: {msg:'Cargando...'},
       view: new Ext.grid.GridView({
       
            //forceFit:true,
            //enableRowBody:true,
            //showPreview:true//,
            //getRowClass : this.applyRowClass
        })


    });


};

Ext.extend(FormComprobanteSubpanel, Ext.grid.EditorGridPanel, {
    height: 300

});

</script>