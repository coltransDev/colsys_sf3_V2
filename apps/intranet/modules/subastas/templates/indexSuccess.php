<?

if( $nivel>=1 ){
    echo link_to(image_tag("16x16/edit_add.gif")." Nuevo", "subastas/formArticulo");
}

?>


<a href="http://www.coltrans.com.co/uploads/subastas/TERMINOS%20Y%20CONDICIONES%20DE%20LA%20SUBASTA%20v.2.pdf" target="_blank"><div class="maintitle">Terminos y Condiciones</div></a>
<br />

<div class="maintitle">Articulos en venta</div>
<br />

<table class="tableList alignLeft" width="100%">
    <tr>
        <th>
            Articulo
        </th>        
        <th>
            Valor
        </th>  
        <th>
            Inicia
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
            $sucArticulo = $articulo->getSucursal()?$articulo->getSucursal()->getCaNombre():"";            
            if($user->getSucursalNombre() == $sucArticulo || $articulo->getCaIdsucursal()==null || $user->getUserId()==$articulo->getCaUsucreado()){
                ?>
                <tr>
                    <td>
                        <?=link_to($articulo->getCaTitulo(), "subastas/verArticulo?idarticulo=".$articulo->getCaIdarticulo())?>
                    </td> 
                    <td>
                        <?=Utils::formatNumber($articulo->getCaValor(), "Y-m-d H:i:s")?>
                    </td> 
                    <td>
                        <?=Utils::fechaMes( Utils::parseDate($articulo->getCaFchinicio(), "Y-m-d") )." ".Utils::parseDate($articulo->getCaFchinicio(), "h:i A")?>
                    </td>
                    <td>
                        <?=Utils::fechaMes( Utils::parseDate($articulo->getCaFchvencimiento(), "Y-m-d") )." ".Utils::parseDate($articulo->getCaFchvencimiento(), "h:i A")?>
                    </td>
                    <td>
                        <?=$articulo->getCaDirecta()?"Compra directa":"Subasta normal"?>
                    </td>             
                </tr>
                <?
            }
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

<table class="tableList alignLeft" width="100%">
    <tr>
        <th>
            Articulo
        </th>        
        <th>
            Valor
        </th>  
        <th>
            Inicio
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
            <?=Utils::fechaMes( Utils::parseDate($articulo->getCaFchinicio(), "Y-m-d") )." ".Utils::parseDate($articulo->getCaFchinicio(), "h:i A")?>
        </td>
        <td>
            <?=Utils::fechaMes( Utils::parseDate($articulo->getCaFchvencimiento(), "Y-m-d") )." ".Utils::parseDate($articulo->getCaFchvencimiento(), "h:i A")?>
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



<?
if( count($articulosSinOfertas) ){
?>

<br />
<br />
<div class="maintitle">Articulos Sin ofertas</div>
<br />

<table class="tableList alignLeft" width="100%">
    <tr>
        <th>
            Articulo
        </th>        
        <th>
            Valor
        </th>  
        <th>
            Inicio
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
    
    foreach( $articulosSinOfertas as $articulo ){
    ?>
    <tr>
        <td>
            <?=link_to($articulo->getCaTitulo(), "subastas/verArticulo?idarticulo=".$articulo->getCaIdarticulo())?>
        </td> 
        <td>
            <?=Utils::formatNumber($articulo->getCaValor())?>
        </td> 
        <td>
            <?=Utils::fechaMes( Utils::parseDate($articulo->getCaFchinicio(), "Y-m-d") )." ".Utils::parseDate($articulo->getCaFchinicio(), "h:i A")?>
        </td>
        <td>
            <?=Utils::fechaMes( Utils::parseDate($articulo->getCaFchvencimiento(), "Y-m-d") )." ".Utils::parseDate($articulo->getCaFchvencimiento(), "h:i A")?>
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