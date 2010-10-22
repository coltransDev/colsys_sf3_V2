<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
//$instrucciones = $sf_data->getRaw("instrucciones");
//echo json_encode(instrucciones);
//print_r($instrucciones);
//echo $modo;
?>

<script language="javascript">
gridPanelInstruccionesWindow = function( config ){
    Ext.apply(this, config);
    var sm = new Ext.grid.CheckboxSelectionModel();    

    gridPanelInstruccionesWindow.superclass.constructor.call(this, {
        clicksToEdit: 1,
        store: new Ext.data.Store({
            reader: new Ext.data.ArrayReader({}, [                
               {name: 'instruccion'}
            ]),
            data: [
                <?
                    $i=false;
                    foreach( $instrucciones as $instruccion ){
                        if($i==false)
                            $i=true;
                        else
                            echo ",";
                        ?>
                            ['<?=$instruccion->getCaValor()?>']
                        <?
                    }
                    ?>
                ]
        }),
       cm: new Ext.grid.ColumnModel({
            defaults: {                
                sortable: true
            },
            columns: [
                sm,
                {id:'instruccion',header: "instruccion",  dataIndex: 'instruccion',width:550,resizable: true}
            ]
        }),
        sm: sm,
        columnLines: true,
        width:480,
        height:300,
        title:'Instrucciones para Agentes',
        iconCls:'icon-grid',
        boxMinHeight: 400,
        id:'instructiones-grid'

    });
};

Ext.extend(gridPanelInstruccionesWindow, Ext.grid.EditorGridPanel, {

});




gridWindow = function( config ){
    Ext.apply(this, config);

    gridWindow.superclass.constructor.call(this, {
            width       : 500,
            id          :"gridWindow-instrucciones",
			closeAction :'close',
			plain       : true,
            height      : 460,
            resizable   : true,
			items       : new gridPanelInstruccionesWindow(),
            tbar:[{
                        text:'Importar',
                        tooltip:'Agregar instrucciones seleccionadas',
                        iconCls:'add',
                        handler: this.importar
                    }
            ]
    });
};

Ext.extend(gridWindow, Ext.Window, {
    importar: function( a,b ){
        
        grid=Ext.getCmp('instructiones-grid');

        m=grid.getSelectionModel().getSelections();

        text=Ext.getCmp("instrucciones").getValue();
        for(i=0;i<m.length;i++)
        {
            text+=(text!="")?'\n':'';
            text+=m[i].get('instruccion');
        }
        Ext.getCmp("instrucciones").setValue(text);
        Ext.getCmp('gridWindow-instrucciones').close();
    }
});

</script>