<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>
<table width="100%" cellspacing="0"  class="tableList alignLeft">
    <?
    $i=0;
    foreach( $sucursales as $sucursal){

        if( $i++!=0 ){
        ?>
       
        <?
        }
        ?>
        <tr class="row0">
            <td width="25%" >
                <div align="left">
                    <?
                    if($sucursal->getCaNombre()!="")
                    {
                    ?>
                    <div style="font-size:11px">
                        <b><?=$sucursal->getCaNombre() ?>  </b>
                    </div>
                    <? 
                    }
                    ?>
                    <div style="font-size:11px">
                        <b>  <?=$sucursal->getCiudad()->getCaCiudad() ?>
                            <?
                    if($sucursal->getCaIdciudaddes()!="")
                        echo "- ".$sucursal->getCiudadDestino()->getCaCiudad();
                    ?>
                        </b>
                    </div>
                    <?=$sucursal->getCiudad()->getTrafico()->getCaNombre() ?>
                    
                    <?=$sucursal->getCaPrincipal()?" (Oficina Principal)":""?>
                </div>
            </td>
             <td >
                <div align="left">                
                    <b>Dir:</b> <?=$sucursal->getCaDireccion()?>
                </div>
            </td>
             <td >
                <div align="left">
                    <b>Tel:</b> <?=$sucursal->getCaTelefonos()?>
                </div>
            </td>
            <td >
                <div align="left">
                    <b>Fax:</b> <?=$sucursal->getCaFax()?>
                </div>
            </td>
            <td valign="top">
                <div align="right">
                    <?
                    if( $nivel>=3 ){
                        echo link_to(image_tag("16x16/edit.gif"), "ids/formSucursalIds?idsucursal=".$sucursal->getCaIdsucursal()."&modo=".$modo,  array("title"=>"Editar sucursal"));
                        echo link_to(image_tag("16x16/delete.gif"), "ids/eliminarSucursalIds?modo=" . $modo . "&idsucursal=".$sucursal->getCaIdsucursal() . "", array("confirm" => "Esta seguro?"));
                    }
                    ?>
                    
                </div>
            </td>
        </tr>

        
        
        <?
        
        $contactos = $sucursal->getContactos( );
        ?>
        <tr>
        <td  colspan="5">
        <div align="left">
        <?
            include_partial("ids/verContactos", array("sucursal"=>$sucursal, "user"=>$user
                    ,"contactos"=>$contactos, "modo"=>$modo, "nivel"=>$nivel, "ids"=>$ids ));
        ?>
        </div>
        </td>
        </tr>
    <?


    }
    ?>
</table>