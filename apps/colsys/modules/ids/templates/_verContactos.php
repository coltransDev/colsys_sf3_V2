<td  colspan="4">
        <div align="left">
<?php

if( count( $contactos )==0){
?>
    
              No hay contactos creados para esta oficina
        
<?
}else{
?>
              <table class="tableList" width="100%">
                  <tr>
                      <th>Nombre</th>
                      <th>Extensión</th>
                      <th>Fax</th>
                      <th>e-mail</th>
                      <th>Cargo</th>
                      <th>Atiende</th>
                      <th>Transporte</th>
                  </tr>
                  <?
                  foreach( $contactos as $contacto ){
                  ?>
                   <tr>
                       <td><div align="left"><?=$contacto->getNombre()?></div></td>
                       <td><div align="left"><?=$contacto->getCaTelefonos()?></div></td>
                       <td><div align="left"><?=$contacto->getCaFax()?></div></td>
                       <td><div align="left"><?=$contacto->getCaEmail()?></div></td>
                       <td><div align="left"><?=$contacto->getCaCargo()?></div></td>
                       <td><div align="left"><?=$contacto->getCaImpoexpo()?></div></td>
                       <td><div align="left"><?=$contacto->getCaTransporte()?></div></td>
                   </tr>
                   <?
                  }
                   ?>
              </table>
<?
}
?>
         </div>
</td>
