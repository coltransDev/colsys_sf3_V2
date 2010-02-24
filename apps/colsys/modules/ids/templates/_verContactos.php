 <table class="tableList" width="100%">
     <tr class="row0">
         <td width="15%"><b>Nombre</b></td>
         <td width="10%"><b>C&oacute;digo &Aacute;rea</b></td>
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
                    echo link_to(image_tag("16x16/add_user.gif"), "ids/formContactosIds?idsucursal=".$sucursal->getCaIdsucursal()."&modo=".$modo, array("title"=>"Nuevo contacto"));
                }
                ?>
              </div>
          </td>
      </tr>
        <?
        $i=0;
        foreach( $contactos as $contacto ){
            if( $contacto->getCaVisibilidad()==3 &&
                ($user->getUserId()!= $contacto->getCaUsucreado() || $user->getUserId()!= $contacto->getCaUsuactualizado()) ){
                continue;
            }

            if( $contacto->getCaVisibilidad()==2 && $nivel<2 ){
                continue;
            }

            //TODO $contacto->getCavisibilidad()==2

            $i++;


      if( !$contacto->getCaActivo() ){
          $class = "";
      }elseif( $contacto->getCaSugerido() ){
          $class = "yellow";
      }else{
         $class = "";
      }
      ?>
      <tr class="<?=$class?>">
           <td><div align="left"><div class="qtip" title="<?=$contacto->getCaObservaciones()?>"><?=$contacto->getNombre()?> <?=!$contacto->getCaActivo()?"(INACTIVO)":""?></div></div></td>
           <td><div align="left" class="qtip" title="<?=$contacto->getCaObservaciones()?>">(<?=$sucursal->getCiudad()->getTrafico()->getCodigoarea()?>)(<?=$contacto->getCodigoarea()?>)</div></td>
           <td><div align="left" class="qtip" title="<?=$contacto->getCaObservaciones()?>"><?=$contacto->getCaTelefonos()?></div></td>
           <td><div align="left" class="qtip" title="<?=$contacto->getCaObservaciones()?>"><?=$contacto->getCaFax()?></div></td>
           <td><div align="left" class="qtip" title="<?=$contacto->getCaObservaciones()?>"><?=$contacto->getCaEmail()?></div></td>
           <td><div align="left" class="qtip" title="<?=$contacto->getCaObservaciones()?>"><?=$contacto->getCaCargo()?></div></td>
           <td><div align="left" class="qtip" title="<?=$contacto->getCaObservaciones()?>"><?=str_replace( "|", ",",$contacto->getCaImpoexpo())?></div></td>
           <td><div align="left" class="qtip" title="<?=$contacto->getCaObservaciones()?>"><?=str_replace( "|", ",", $contacto->getCaTransporte())?></div></td>
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
                echo link_to(image_tag("16x16/add_user.gif"), "ids/formContactosIds?idsucursal=".$sucursal->getCaIdsucursal()."&modo=".$modo, array("title"=>"Nuevo contacto"));
            }
            ?>
           
           </div></td>
       </tr>
      <?
      }
      ?>
  </table>