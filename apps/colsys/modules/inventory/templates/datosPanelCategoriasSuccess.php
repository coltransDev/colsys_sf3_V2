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
    ?>
    {
        text:'<?=$text?> ',
        leaf: <?=$categoria->getCaMain()?"false":"true"?>,
        name:'<?=$categoria->getCaName()?> ',
        id: '<?=$categoria->getCaIdcategory()?>',
        idcategoria: '<?=$categoria->getCaIdcategory()?>',
        parentNode: '<?=$categoria->getCaParent()?>',
        main: <?=$categoria->getCaMain()?"true":"false"?>
    }
    <?
    }
    ?>
]

            				