<div class="content" align="center">
    <h1>Por favor seleccione una categoria</h1>
    <br />
    <div  style="border: solid 1px #000000; width:800px" >
    <table width="100%" cellpadding="10">
<?
$i=0;
foreach( $categorias as $categoria ){
    if($i==0){
    ?>
        <tr>
    <?
    }

    if($i%2==0 && $i!=0){
    ?>
        </tr>
        <tr>
    <?
    }
    ?>
            <td valign="top" align="right" width="65px">
                <?=image_tag($categoria->getCaIcon()?$categoria->getCaIcon():"kb/bus_sol.png")?>


            </td>
            <td valign="top" width="335px" align="left">
                
                <b><?=$categoria->getCaName()?></b><br />
                <ul>
                <?
                
                $subcategorias = $categoria->getSubCategory();

                foreach( $subcategorias as $subcategoria ){
                    ?>
                    <li style="color:#07679A"><?=image_tag("kb/bullet.png")?>&nbsp; <?=link_to($subcategoria->getCaName(), "kbase/viewSubcategory?id=".$subcategoria->getCaIdcategory())?></li>
                    <?
                }
                ?>
                </ul>
            </td>
    <?
    $i++;
    
    

   
}

?>
         </tr>
    </table>
    </div>
</div>



