<?

if( $nivel>=1 ){
    echo link_to(image_tag("16x16/edit_add.gif")." Nuevo", "subastas/formArticulo");
}

?>
<div class="maintitle">Articulos en venta</div>
<br />

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


<?
if( count($articulosVendidos) ){
?>

<br />
<br />
<div class="maintitle">Articulos vendidos</div>
<br />

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
        <th>
            Vendido a 
        </th>
        <th>
            Valor
        </th>
    </tr>
    <?
    
    foreach( $articulosVendidos as $articulo ){
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
        <td>
            <?=$articulo->getUsuComprador()->getCaNombre()?>
        </td> 
         <td>
            <?=Utils::formatNumber($articulo->getCaValorventa())?>
        </td> 
    </tr>
    <?
        
    }?>
    
</table>
<?
}
?>