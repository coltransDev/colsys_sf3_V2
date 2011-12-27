<?php

/*
 * (c) Coltrans S.A. - Colmas Ltda.
 * 
 */
$comps = $sf_data->getRaw("comps");
?>
<div class="content" align="center" >
    <table width="90%" class="tableList"  >
        <tr>
           <th>Referencia</th>
           <th>Comprobante</th>
           <th>Fch. Comprobante</th>           
           <th>Emitido a</th>   
           <th>Doc. Transporte</th>
         </tr>                  
         <?
         foreach( $comps as $c ){
         ?>
         <tr>
             <td><?=$c["InoHouse"]["InoMaster"]["ca_referencia"]?></td>       
             <td><?=$c["ca_consecutivo"]?></td>    
             <td><?=$c["ca_fchcomprobante"]?></td>             
             <td><?=$c["Ids"]["ca_nombre"]?></td>
             <td><?=$c["InoHouse"]["ca_doctransporte"]?></td> 
         </tr>
         <?
         }
         ?>
    </table>
</div>   
<?    


?>