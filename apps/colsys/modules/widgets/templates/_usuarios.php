new Ext.form.ComboBox({
        store:  new Ext.data.ArrayStore({
            fields: ['id<?=$name?>', '<?=$name?>' ],
            data : [
            <?
                $i=0;
                foreach( $usuarios as $usuario ){
                    if($i++!=0){
                        echo ",";
                    }
                    echo "['".$usuario->getCaLogin()."','".$usuario->getCaNombre()."']";
                }
            ?>
            ]
        }),
        hiddenName:'id<?=$name?>',
        mode: 'local',


        displayField: '<?=$name?>',
		valueField: 'id<?=$name?>',
        fieldLabel: '<?=$label?>',
        name: '<?=$name?>',
        typeAhead: true,
        forceSelection: true,
        triggerAction: 'all',
        emptyText:'Seleccione...',
        selectOnFocus:true,
        lazyRender:true
    })