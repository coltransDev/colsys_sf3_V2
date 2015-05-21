[
    {
	text:'Carga Aérea y Carga LCL',
	leaf:true,
        opcion: 'depair',
        impoexpo: '<?=Constantes::DEPOSITOS?>',
        transporte: '<?=Constantes::AEREO?>',
        modalidad: '<?=Constantes::CONSOLIDADO?>',
        parametro: '<?=Constantes::AEREA_Y_LCL?>'
    }, {
	text:'Carga FCL - 20 Pies',
	leaf:true,
        opcion: 'dep20p',
        impoexpo: '<?=Constantes::DEPOSITOS?>',
        transporte: '<?=Constantes::MARITIMO?>',
        modalidad: '<?=Constantes::FCL?>',
        parametro: '<?=Constantes::VEINTE_PIES?>'
    }, {
	text:'Carga FCL - 40 Pies',
	leaf:true,
        opcion: 'dep40p',
        impoexpo: '<?=Constantes::DEPOSITOS?>',
        transporte: '<?=Constantes::MARITIMO?>',
        modalidad: '<?=Constantes::FCL?>',
        parametro: '<?=Constantes::CUARENTA_PIES?>'
    }        
]
<?
exit;
?>
