[
    {
        text:'Tabajos en Cola',
        leaf:true
    },
    <?
    $i=0;
    foreach( $informes as $categoria=>$informe ){
        if( $i++>0 ){
            echo ",";
        }

    ?>
    {
        text:'<?=$categoria?>',
        leaf:false,
        children: [
            <?
            $j=0;
            foreach( $informe as $inf){
                if( $j++>0 ){
                    echo ",";
                }
            ?>
            {
                text:'<?=$inf->getCaTitulo()?>',
                idinforme: '<?=$inf->getCaIdinforme()?>',
                leaf:true
            }
            <?
            }
            ?>
        ]
    }
    <?
    }
    ?>
    

]

<?
/*


 */
?>

