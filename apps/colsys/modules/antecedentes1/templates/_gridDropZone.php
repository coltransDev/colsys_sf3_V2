
<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<script type="text/javascript">


    GridDropZone = function(grid, config) {
        this.grid = grid;
        GridDropZone.superclass.constructor.call(this, grid.view.scroller.dom, config);
    };
    Ext.extend(GridDropZone, Ext.dd.DropZone, {

        onContainerOver:function(dd, e, data) {
            return dd.grid !== this.grid ? this.dropAllowed : this.dropNotAllowed;
        } // eo function onContainerOver

        ,onContainerDrop:function(dd, e, data) {
            if(dd.grid !== this.grid) {
                if( dd.grid.id=="reportes-antecedentes" ){
                    var assign = true;
                }else{
                    var assign = false;
                }
                var grid = this.grid;
                var ddGrid = dd.grid;
                var sel = [];
                Ext.each(data.selections, function(r) {                    
                    sel.push( r.data.idreporte );
                });


                Ext.Ajax.request({

                    waitMsg: 'Eliminando...',
                    url: '<?=url_for("antecedentes/asignarMaster?master=".$master)?>',
                    //method: 'POST',
                    //Solamente se envian los cambios
                    params :	{
                        data: sel.join(","),
                        assign: assign
                    },

                    //Ejecuta esta accion en caso de fallo
                    //(404 error etc, ***NOT*** success=false)
                    failure:function(response,options){
                        var res = Ext.util.JSON.decode( response.responseText );
                        Ext.MessageBox.alert('Error Message', "Se ha presentado un error"+(res.errorInfo?": "+res.errorInfo:"")+" - "+(response.status?"\n Codigo HTTP "+response.status:""));
                    },

                    //Ejecuta esta accion cuando el resultado es exitoso
                    success:function(response,options){
                        var res = Ext.util.JSON.decode( response.responseText );
                        if( res.success ){
                            grid.store.add(data.selections);
                            Ext.each(data.selections, function(r) {
                                ddGrid.store.remove(r);
                            });
                            grid.onRecordsDrop(ddGrid, data.selections);
                        }else{
                            Ext.MessageBox.alert('Error Message', "Se ha presentado un error"+(res.errorInfo?": "+res.errorInfo:"")+" - "+(response.status?"\n Codigo HTTP "+response.status:""));
                        }
                    }


                });


                return true;
            }
            else {
                return false;
            }
        } // eo function onContainerDrop
        ,containerScroll:true

    });
</script>