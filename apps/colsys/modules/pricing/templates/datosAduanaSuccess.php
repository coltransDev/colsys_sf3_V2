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
		text:'Transporte FCL',
		leaf:false,
        id: 'traf_<?="impo_".Constantes::TERRESTRE."_".Constantes::ADUANAFCL."_CO-057"?>',
        impoexpo: '<?=Constantes::IMPO?>',
        transporte: '<?=Constantes::TERRESTRE?>',
        modalidad: '<?=Constantes::ADUANAFCL?>',
        idtrafico: 'CO-057',
        trafico: 'Aduana'


	},
    {
		text:'Transporte LCL',
		leaf:false,
        id: 'traf_<?="impo_".Constantes::TERRESTRE."_".Constantes::ADUANALCL."_CO-057"?>',
        impoexpo: '<?=Constantes::IMPO?>',
        transporte: '<?=Constantes::TERRESTRE?>',
        modalidad: '<?=Constantes::ADUANALCL?>',
        idtrafico: 'CO-057',
        trafico: 'Aduana'


	}
]
<?
exit;

?>
					