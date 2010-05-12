<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<script type="text/javascript">
    var buscar=function(){
        Ext.Ajax.request(
        {
            waitMsg: 'Buscando...',
            url: '<?=url_for("users/doSearch")?>',
            method: 'POST',
            //Solamente se envian los cambios
            params :	{
                criterio: document.getElementById("criterio").value
            },

            callback :function(options, success, response){
                document.getElementById("resultados").innerHTML = response.responseText;
            }
        }
    );

    }
    </script>
Escriba la opcion de busqueda

<input type="text" name="criterio" id="criterio"/>
<input type="button" value="Buscar" OnClick="buscar()">

<div id="resultados"></div>
