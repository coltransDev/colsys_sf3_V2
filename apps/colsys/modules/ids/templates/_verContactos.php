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
                      <th>Impo/Expo</th>
                      <th>Transporte</th>
                      <th>Opciones</th>
                  </tr>
                  <?
                  foreach( $contactos as $contacto ){
                  ?>
                  <tr class="<?=$contacto->getCaSugerido()?"yellow":""?>">
                       <td><div align="left"><?=$contacto->getNombre()?></div></td>
                       <td><div align="left"><?=$contacto->getCaTelefonos()?></div></td>
                       <td><div align="left"><?=$contacto->getCaFax()?></div></td>
                       <td><div align="left"><?=$contacto->getCaEmail()?></div></td>
                       <td><div align="left"><?=$contacto->getCaCargo()?></div></td>
                       <td><div align="left"><?=$contacto->getCaImpoexpo()?></div></td>
                       <td><div align="left"><?=$contacto->getCaTransporte()?></div></td>
                       <td><div align="center">
                        <?
                        echo link_to(image_tag("16x16/edit.gif"), "ids/formContactosIds?modo=".$modo."&idcontacto=".$contacto->getCaIdcontacto()."" );
                        echo link_to(image_tag("16x16/delete.gif"), "ids/eliminarContactoIds?modo=".$modo."&idcontacto=".$contacto->getCaIdcontacto()."", array("confirm"=>"Esta seguro?") );
                        ?>
                       </div></td>
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
