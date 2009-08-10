 <table class="tableList" width="100%">
     <tr class="row0">
          <td><b>Nombre</b></td>
          <td><b>Extensión</b></td>
          <td><b>Fax</b></td>
          <td><b>e-mail</b></td>
          <td><b>Cargo</b></td>
          <td><b>Impo/Expo</b></td>
          <td><b>Transporte</b></td>
          <td> 
              <div align="center">
                <?=link_to(image_tag("16x16/add_user.gif"), "ids/formContactosIds?idsucursal=".$sucursal->getCaidsucursal()."&modo=".$modo, array("title"=>"Nuevo contacto"))?>
              </div>
          </td>
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
           <td><div align="left"><?=str_replace( "|", ",",$contacto->getCaImpoexpo())?></div></td>
           <td><div align="left"><?=str_replace( "|", ",", $contacto->getCaTransporte())?></div></td>
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