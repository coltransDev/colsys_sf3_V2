<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_component("widgets4","wgUsuario");
?>

<table  align="left" width="60px">
    <tr>
        <td id="busqueda">                
        </td>
    </tr>
    <tr>
        <td style="text-align: right;">
            <a href="<?=url_for("adminUsers/directory")?>">B&uacute;squeda Personalizada</a>
        </td>
    </tr>
</table>

<script>
Ext.onReady(function(){
     
    var ejemplo = new Ext.colsys.wgUsuario({
        xtype: 'wUsuario',
        fieldLabel: "Buscar",
        name: "login",
        id: "nombre",
        renderTo: busqueda,
        emptyText: 'Digite su criterio de búsqueda',
        submitEmptyText: false,
        width:500,
        listeners: {           
            select: {
                fn: function() {
                    Ext.Ajax.request({
                        url: '<?=url_for("adminUsers/viewUser")?>',
                        params: {
                            login: this.getValue()                                
                        },
                        failure:function(response,options){
                            var res = Ext.util.JSON.decode( response.responseText );
                            if(res.err)
                                Ext.MessageBox.alert("Mensaje",'Se presento un error mostrando el usuario<br>'+res.err);
                            else
                                Ext.MessageBox.alert("Mensaje",'Se produjo un error, vuelva a intentar o informe al Depto. de Sistema<br>'+res.texto);
                        },
                        success:function(response,options){
                            $("#resultado").html(response.responseText);                            
                        }
                   })
               }
           }
       }
   });  
});
</script> 