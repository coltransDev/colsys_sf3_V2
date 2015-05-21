[
    {
	text:'Tarifario de aduana Puerto',
	leaf:true,
        opcion: 'adusea',
        impoexpo: '<?=Constantes::ADUANAS?>',
        transporte: '<?=Constantes::MARITIMO?>',
        modalidad: '<?=Constantes::IMPO?>'
    }, {
	text:'Tarifario de aduana Aereo/OTM',
	leaf:true,
        opcion: 'aduair',
        impoexpo: '<?=Constantes::ADUANAS?>',
        transporte: '<?=Constantes::AEREO?>',
        modalidad: '<?=Constantes::IMPO?>'
	}        
]
<?
exit;
?>
