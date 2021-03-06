<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
//$modalidades = $sf_data->getRaw("modalidades");
$parametros = $sf_data->getRaw("parametros");
?>

<script type="text/javascript">
ParametroGrid = function( config ){

    Ext.apply(this, config);

    
    this.columns = [
      {
        header: "Parametro",
        dataIndex: 'parametro',
        hideable: false,
        sortable:false,
        width: 170,
        renderer: this.formatItem,
         editor: new Ext.form.TextField({
                    allowBlank: false ,
                    style: 'text-align:left'
                })

      }      
     ];


    this.record = Ext.data.Record.create([
            {name: 'idconcepto', type: 'int'},
            {name: 'idparametro', type: 'string'},
            {name: 'parametro', type: 'string'},
            {name: 'orden', type: 'string'}
           

        ]);
    
    this.store = new Ext.data.Store({

        autoLoad : false,
        url: '<?=url_for("pricing/datosParametros")?>',
        baseParams : {
            readOnly: this.readOnly,
            idconcepto: this.idconcepto
        },
        reader: new Ext.data.JsonReader(
            {
                root: 'root',
                totalProperty: 'totalCount'
            },
            this.record
        )
        //,sortInfo:{field: 'orden', direction: "ASC"}
    });




    ParametroGrid.superclass.constructor.call(this, {
       loadMask: {msg:'Cargando...'},
       clicksToEdit: 1,
       height: 250,
       width: 450,
       view: new Ext.grid.GridView({
            forceFit:true                        
       })      
       ,
       listeners:{
            validateedit: this.onValidateEdit,
            rowcontextmenu: this.onRowcontextMenu            
       }
       
    });

    var storeParametroGrid = this.store;
    this.getColumnModel().isCellEditable = function(colIndex, rowIndex) {
        if( this.readOnly ){
            return false
        }else{
            var record = storeParametroGrid.getAt(rowIndex);
            var field = this.getDataIndex(colIndex);
            if( record.data.orden!="Z"  ){
                return false;
            }
            return Ext.grid.ColumnModel.prototype.isCellEditable.call(this, colIndex, rowIndex);
        }
    }

};

Ext.extend(ParametroGrid, Ext.grid.EditorGridPanel, {
    
    
    formatItem: function(value, p, record) {

        return String.format(
            '<b>{0}</b>',
            value
        );

    },


    onValidateEdit : function(e){        
        if( e.field == "parametro"){
            var rec = e.record;
            var ed = this.colModel.getCellEditor(e.column, e.row);
            var store = ed.field.store;

            var recordParametro = this.record;
            var storeGrid = this.store;
            insertar=true;
            storeGrid.each( function( r ){
                //alert(r.data.parametro)
                if( r.data.parametro==e.value )
                {
                    alert("El parametro ya se encuentra en los datos");
                    insertar=false;
                }
            });
            if(insertar==true)
            {
                    //if( r.data.parametro==e.value )
                    {
                        
                            var newRec = new recordParametro({
                               parametro: '+',
                               idparametro: '',
                               orden: 'Z' // Se utiliza Z por que el orden es alfabetico
                            });

                            
                            rec.set("idparametro", e.value);
                            rec.set("parametro", e.value);
                            rec.set("orden", "X");
                            //guardarGridProductosRec( rec );

                            //Inserta una columna en blanco al final
                            storeGrid.addSorted(newRec);
                            storeGrid.sort("orden", "ASC");
                        
                        //e.value = r.data.value;
                        return true;
                    }
                }
                else
                    return false;

            //)
        }
    }
    ,

    onRowcontextMenu: function(grid, index, e){
        if( !this.readOnly ){
            rec = this.store.getAt(index);

            if(!this.menu){ // create context menu on first right click

                this.menu = new Ext.menu.Menu({
                enableScrolling : false,
                items: [
                        {
                            text: 'Eliminar item',
                            iconCls: 'delete',
                            scope:this,
                            handler: this.eliminarItem
                        }
                        ]
                });
                this.menu.on('hide', this.onContextHide , this);
            }
            e.stopEvent();
            if(this.ctxRow){
                Ext.fly(this.ctxRow).removeClass('x-node-ctx');
                this.ctxRow = null;
            }
            this.ctxRecord = rec;
            this.ctxRow = this.view.getRow(index);
            Ext.fly(this.ctxRow).addClass('x-node-ctx');
            this.menu.showAt(e.getXY());
        }

    }
    ,

    eliminarItem : function(){
        if( !this.readOnly && this.ctxRecord  && this.ctxRecord.data.orden!="Z" && confirm("Desea continuar?") ){
            if( this.ctxRecord.data.idconcepto ){
                var idconcepto = this.ctxRecord.data.idconcepto;

                var id = this.ctxRecord.id;
                record = this.store.getById( res.id );
                this.store.remove(record);
                /*var storeConceptos = this.store;
                Ext.Ajax.request(
                {
                    waitMsg: 'Eliminando...',
                    url: '<?=url_for("parametros/eliminarParametroGrid?modo=")?>',
                    //method: 'POST',
                    //Solamente se envian los cambios
                    params :	{
                        id: id,
                        idconcepto: idconcepto
                    },

                    //Ejecuta esta accion en caso de fallo
                    //(404 error etc, ***NOT*** success=false)
                    failure:function(response,options){
                        alert( response.responseText );
                        success = false;
                    },



                    //Ejecuta esta accion cuando el resultado es exitoso
                    success:function(response,options){
                        var res = Ext.util.JSON.decode( response.responseText );
                        if( res.success ){
                            record = storeConceptos.getById( res.id );
                            storeConceptos.remove(record);
                        }
                    }


                });*/
            }else{ // No se ha guardado todavia
                record = this.store.getById( this.ctxRecord.id );
                this.store.remove(record);
            }
        }
    }
    ,
    onContextHide: function(){
        if(this.ctxRow){
            Ext.fly(this.ctxRow).removeClass('x-node-ctx');
            this.ctxRow = null;
        }
    }
});
</script>