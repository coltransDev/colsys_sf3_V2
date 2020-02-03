[
    <?
    $i=0;
    foreach($categorias as $categoria){
        if($i++>0){
            echo ",";
        }

        $text = $categoria->getCaName();
        if( $categoria->getCaMain() ){
            $subcategorias = $categoria->getSubCategory();
            $text.=" (".count($subcategorias).")";
        }
        $activosxCategoria = $categoria->getActiveItemsByCategory($idsucursal);
        
        if(count($activosxCategoria)==0 && $categoria->getCaMain()!= 1){
            $text = '<span style="color:red">'.$text.'</span>';
        }
        ?>
        {
            text:'<?=$text?> ',
            leaf: <?=$categoria->getCaMain()?"false":"true"?>,
            name:'<?=$categoria->getCaName()?> ',
            id: '<?=$categoria->getCaIdcategory()?>',
            cant: '<?=count($activosxCategoria)?>',
            data: '<?=($parent?$parent->getCaName()." - ":"").$categoria->getCaName()?> ',
            idcategoria: '<?=$categoria->getCaIdcategory()?>',
            idsucursal: '<?=$idsucursal?>',
            parentNode: '<?=$categoria->getCaParent()?>',
            main: <?=$categoria->getCaMain()?"true":"false"?>,
            parameter: '<?=$categoria->getCaParameter()?>',
            autonumeric: <?=$prefijo&&$prefijo->getCaAutonumeric()?"true":"false"?>,
            prefix: '<?=$prefijo?$prefijo->getCaPrefix():""?>'
        }
    <?
    }
    ?>
]         				