<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//phpinfo();
?>
<script language="javascript" type="text/javascript">
var buscar=function(){
    Ext.Ajax.request(
    {
        waitMsg: 'Buscando...',
        url: '<?=url_for("adminUsers/doSearch")?>',
        method: 'POST',
        //Solamente se envian los cambios
        params :	{
            criterio: document.getElementById("criterio").value,
            opcion: document.getElementById("opcion").value,
            
        },

        callback :function(options, success, response){
            document.getElementById("resultados").innerHTML = response.responseText;
        }
    }
);

}


</script>

<tr>Buscar Personas</tr><br />
<tr>
            <select name="opcion" id="opcion">
                <option value="nombre" selected="selected">Nombre</option>
                <option value="apellido">Apellido</option>
                <option value="correo">Correo</option>
                <option value="tiposangre">Tipo de Sangre</option>
            </select>
    
        <input type="text" name="criterio" id="criterio"/>
        <input type="button" value="Buscar" OnClick="buscar()">
 </tr>

        <div id="resultados"></div>

