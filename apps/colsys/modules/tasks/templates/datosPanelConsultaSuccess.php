[
    {
		text:'Todas las tareas',
		leaf:true,
        idlista: null
     },
     {
		text:'Listas de tareas',
		leaf:false,
		children:[
        <?
        $i=0;
        foreach($listasTareas as $lista){
            if($i++>0){
                echo ",";
            }
        ?>
        {
            text:'<?=($lista->getCaNombre())?>',
            leaf:true,
            idlista: '<?=$lista->getCaIdlistatarea()?>'
        }
        <?
        }
        ?>
        ]
     }
]

            				