[
    {
	text:'Carga A�rea',
	leaf:true,
        opcion: 'depair',
        impoexpo: '<?=Constantes::DEPOSITOS?>',
        transporte: '<?=Constantes::AEREO?>',
        modalidad: '<?=Constantes::CONSOLIDADO?>',
        parametro: '<?=Constantes::CARGA_AEREA?>'
    }, {
	text:'Carga Mar�tima LCL',
	leaf:true,
        opcion: 'dep20p',
        impoexpo: '<?=Constantes::DEPOSITOS?>',
        transporte: '<?=Constantes::MARITIMO?>',
        modalidad: '<?=Constantes::LCL?>',
        parametro: '<?=Constantes::MARITIMA_LCL?>'
    }, {
	text:'Carga Mar�tima FCL',
	leaf:true,
        opcion: 'dep40p',
        impoexpo: '<?=Constantes::DEPOSITOS?>',
        transporte: '<?=Constantes::MARITIMO?>',
        modalidad: '<?=Constantes::FCL?>',
        parametro: '<?=Constantes::MARITIMA_FCL?>'
    }        
]
<?
exit;
?>
