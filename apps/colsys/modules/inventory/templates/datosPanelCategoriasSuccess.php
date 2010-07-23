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
        id: '<?=$categoria->getCaIdcategory()?>',
        idcategoria: '<?=$categoria->getCaIdcategory()?>'
    }
    <?
    }
    ?>
]

            				