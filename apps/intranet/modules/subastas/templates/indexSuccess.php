


<table class="tableList" >
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
    </tr>
    <?
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
    </tr>
    <?
    }
    ?>
    
</table>