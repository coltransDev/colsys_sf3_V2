[
    {
		text:'Aduana Exportaci�n Mar�timo',
		leaf:true,
        opcion: 'aexsea',
        impoexpo: '<?=strtr(Constantes::EXPO, "�����", "aeiou")?>',
        transporte: '<?=strtr(Constantes::MARITIMO, "�����", "aeiou")?>',
        modalidad: '<?=Constantes::EXPO?>'
	},
    {
		text:'Aduana Exportaci�n A�rea',
		leaf:true,
        opcion: 'aexair',
        impoexpo: '<?=strtr(Constantes::EXPO, "�����", "aeiou")?>',
        transporte: '<?=strtr(Constantes::AEREO, "�����", "aeiou")?>',
        modalidad: '<?=Constantes::EXPO?>'
	},
    {
		text:'Aduana Exportaci�n Terrestre',
		leaf:true,
        opcion: 'aexter',
        impoexpo: '<?=strtr(Constantes::EXPO, "�����", "aeiou")?>',
        transporte: '<?=strtr(Constantes::TERRESTRE, "�����", "aeiou")?>',
        modalidad: '<?=Constantes::EXPO?>'
	}        
        
]
<?
exit;
?>