 <table class="tableList" width="100%">
     <tr class="row0">
         <td width="15%"><b>Nombre</b></td>
         <td width="10%"><b>Tel&eacute;fono</b></td>
          <td width="10%"><b>Fax</b></td>
          <td width="20%"><b>e-mail</b></td>
          <td width="15%"><b>Cargo</b></td>
          <td width="15%"><b>Impo/Expo</b></td>
          <td width="10%"><b>Transporte</b></td>
          <td width="5%">
              <div align="center">
                <?
                if( $nivel>=3 ){
                    echo link_to(image_tag("16x16/add_user.gif"), "ids/formContactosIds?idsucursal=".$sucursal->getCaidsucursal()."&modo=".$modo, array("title"=>"Nuevo contacto"));
                }
                ?>
              </div>
          </td>
      </tr>
        <?
        $i=0;
        foreach( $contactos as $contacto ){
            if( $contacto->getCavisibilidad()==4 &&
                ($user->getUserId()!= $contacto->getCaUsucreado() || $user->getUserId()!= $contacto->getCaUsuactualizado()) ){
                continue;
            }

            if( $contacto->getCavisibilidad()==3 && $nivel<3 ){
                continue;
            }

            //TODO $contacto->getCavisibilidad()==2

            $i++;

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
            if( $nivel>=3 ){
                echo link_to(image_tag("16x16/edit.gif"), "ids/formContactosIds?modo=".$modo."&idcontacto=".$contacto->getCaIdcontacto()."" );
                echo link_to(image_tag("16x16/delete.gif"), "ids/eliminarContactoIds?modo=".$modo."&idcontacto=".$contacto->getCaIdcontacto()."", array("confirm"=>"Esta seguro?") );
            }
            
            ?>
           </div></td>
       </tr>
    <?
    }
    if( $i==0 ){
    ?>
      <tr >

          <td colspan="8">
           
            <div align="center">No hay contactos
            <?
            if( $nivel>=3 ){
                echo link_to(image_tag("16x16/add_user.gif"), "ids/formContactosIds?idsucursal=".$sucursal->getCaidsucursal()."&modo=".$modo, array("title"=>"Nuevo contacto"));
            }
            ?>
           
           </div></td>
       </tr>
      <?
      }
      ?>
  </table>