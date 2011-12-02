<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<script type="text/javascript">
$(document).ready(function() {
	//$('#star1').rating('www.url.php', {maxvalue: 1});
    $('#star1').rating('#', {maxvalue:5, curvalue:0});
    $('#star2').rating('#', {maxvalue:5, curvalue:0});
	$('#star3').rating('#', {maxvalue:5, curvalue:0});
    $('#star4').rating('#', {maxvalue:5, curvalue:0});
    $('#star5').rating('#', {maxvalue:5, curvalue:0});
	$('#star6').rating('#', {maxvalue:5, curvalue:0});
    $('#star7').rating('#', {maxvalue:5, curvalue:0});
    $('#star8').rating('#', {maxvalue:5, curvalue:0});
	$('#star9').rating('#', {maxvalue:5, curvalue:0});
    $('#star10').rating('#', {maxvalue:5, curvalue:0});
    $('#star11').rating('#', {maxvalue:5, curvalue:0});
	$('#star12').rating('#', {maxvalue:5, curvalue:0});
    $('#star13').rating('#', {maxvalue:5, curvalue:0});
    $('#star14').rating('#', {maxvalue:5, curvalue:0});
	$('#star15').rating('#', {maxvalue:5, curvalue:0});
	//$('#star2').rating('www.url.php', {maxvalue:5});
	//$('#rate2').rating('www.url.php', {maxvalue:5, curvalue:3});
});
</script>
<table class="tableList alignCenter" width="60%" align="center">
    <tr><td><b>ENCUESTA DE EVALUACIÓN DEL SERVICIO</b></td></tr>
    <tr><td>Con el fin de lograr la mejora continua de nuestros procesos y el servicio que prestamos, agradecemos dedicar unos minutos para diligenciar la siguiente encuesta para que nos evalúe de manera objetiva. </td></tr>
    
</table>
<br><br>
 <table class="tableList alignCenter" width="60%" align="center">
         <tr>
             <th colspan="4">
                 <b>1. ¿Cuál es el nivel de satisfacción percibido con cada Área?</b>
             </th>
         </tr>
         <tr>
             <th>DEPARTAMENTO</th>
             <th>Oportunidad entrega de documentos </th>
             <th>Oportunidad entrega de información</th>
             <th>Facturación correcta y oportuna</th>             
         </tr>
         <tr>
             <th>SERVICIO AL CLIENTE</th>
             <td><div id="star1" class="rating">&nbsp;</div></td>
             <td><div id="star2" class="rating">&nbsp;</div></td>
             <td></td>
         </tr>
         <tr>
             <th>COMERCIAL</th>
             <td><div id="star3" class="rating">&nbsp;</div></td>
             <td><div id="star4" class="rating">&nbsp;</div></td>
             <td></td>
         </tr>
         <tr>
             <th>AEREO</th>
             <td><div id="star5" class="rating">&nbsp;</div></td>
             <td><div id="star6" class="rating">&nbsp;</div></td>
             <td><div id="star7" class="rating">&nbsp;</div></td>
         </tr>
         <tr>
             <th>MARITIMO</th>
             <td><div id="star8" class="rating">&nbsp;</div></td>
             <td><div id="star9" class="rating">&nbsp;</div></td>
             <td><div id="star10" class="rating">&nbsp;</div></td>
         </tr>
         <tr>
             <th>EXPORTACIONES</th>
             <td><div id="star11" class="rating">&nbsp;</div></td>
             <td><div id="star12" class="rating">&nbsp;</div></td>
             <td><div id="star13" class="rating">&nbsp;</div></td>
         </tr>
         <tr>
             <th>SEGUROS Y RECLAMOS</th>
             <td><div id="star14" class="rating">&nbsp;</div></td>
             <td><div id="star15" class="rating">&nbsp;</div></td>
             <td></td>
         </tr>
</table>
<br><br>
<table class="tableList alignCenter" width="60%" align="center">
     <tr>
         <th colspan="4">
             <b>2. Asesoría Comercial</b>
         </th>
     </tr>
     <tr>
         <th><b>a. ¿Encuentra en nuestros comerciales disposición y conocimiento para atender sus necesidades?</b></th>
         <tr>             
             <td>Si <input type="radio" >  No <input type="radio" > </td>             
             <td></td>
         </tr>
     </tr>
     <tr>
         <th><b>b. ¿ Con qué frecuencia es visitado por nuestro Representante de Ventas?</b></th>
         <tr>             
             <td>
                 <input type="radio" >Mensual   <br><input type="radio" >Bimestral <br>
                 <input type="radio" >Trimestral   <br><input type="radio" >Cuando tiene un embarque 
             </td>
             <td></td>
         </tr>
     </tr>
     
          <tr>
         <th><b>c. Cómo evalúa Usted nuestra capacidad de reacción ante observaciones, incidencias, inconvenientes o cambios.</b></th>
         <tr>             
             <td>
                 <input type="radio" >Rápida   <br><input type="radio" >Lenta <br>
                 <input type="radio" >No existe
             </td>
             <td></td>
         </tr>
     </tr>     
     <tr>
         <td colspan="3" align="center"><input type="button" value="Enviar" onclick="ver()"></td>
     </tr>     
</table>

<script>
    function ver()
    {
         alert(star1.getResult());
    }
</script>
