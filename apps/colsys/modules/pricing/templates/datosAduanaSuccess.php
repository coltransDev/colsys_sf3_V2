[
    {
		text:'Tarifario de aduana',
		leaf:true,
        opcion: 'tarifario-aduana'
	},
    {
		text:'Tarifario de aduana x cliente',
		leaf:true,
        opcion: 'tarifario-aduana-cliente'
	},
	{
		text:'Transporte ',
		leaf:false,
        id: 'traf_<?="impo_".Constantes::TERRESTRE."_".Constantes::ADUANA."_CO-057"?>',
        impoexpo: '<?=Constantes::IMPO?>',
        transporte: '<?=Constantes::TERRESTRE?>',
        modalidad: '<?=Constantes::ADUANA?>',
        idtrafico: 'CO-057',
        trafico: 'Aduana'


	}
]
<?
exit;

?>
					