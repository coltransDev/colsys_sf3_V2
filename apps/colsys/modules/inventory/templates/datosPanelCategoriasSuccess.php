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
        
        $prefijo = $categoria->getPrefijo( $idsucursal );
    ?>
    {
        text:'<?=$text?> ',
        leaf: <?=$categoria->getCaMain()?"false":"true"?>,
        name:'<?=$categoria->getCaName()?> ',
        id: '<?=$categoria->getCaIdcategory()?>',  
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

            				