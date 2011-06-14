<?

if( $nivel>=1 ){
    echo link_to(image_tag("16x16/edit_add.gif")." Nuevo", "subastas/formArticulo");
}

?>


<table class="tableList" width="100%">
    <tr>
        <th>
            Articulo
        </th>        
        <th>
            Valor
        </th>        
        <th>
            Vence
        </th>
        <th>
            Tipo de Subasta
        </th>
    </tr>
    <?
    if( count($articulos)>0 ){
        foreach( $articulos as $articulo ){
        ?>
        <tr>
            <td>
                <?=link_to($articulo->getCaTitulo(), "subastas/verArticulo?idarticulo=".$articulo->getCaIdarticulo())?>
            </td> 
            <td>
                <?=Utils::formatNumber($articulo->getCaValor())?>
            </td> 
            <td>
                <?=Utils::fechaMes($articulo->getCaFchvencimiento())?>
            </td>
            <td>
                <?=$articulo->getCaDirecta()?"Compra directa":"Subasta normal"?>
            </td>
        </tr>
        <?
        }
    }else{        
    ?>
        <tr>
            <td colspan="4">
                <div align="center">No hay articulos en este momento</div>
            </td>
        </tr>
    <?
    }
    ?>    
    
</table>