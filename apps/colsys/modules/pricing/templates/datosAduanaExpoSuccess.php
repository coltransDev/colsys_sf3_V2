[
    {
		text:'Aduana Exportación Marítimo',
		leaf:true,
        opcion: 'aexsea',
        impoexpo: '<?=strtr(Constantes::EXPO, "áéíóú", "aeiou")?>',
        transporte: '<?=strtr(Constantes::MARITIMO, "áéíóú", "aeiou")?>',
        modalidad: '<?=Constantes::EXPO?>'
	},
    {
		text:'Aduana Exportación Aérea',
		leaf:true,
        opcion: 'aexair',
        impoexpo: '<?=strtr(Constantes::EXPO, "áéíóú", "aeiou")?>',
        transporte: '<?=strtr(Constantes::AEREO, "áéíóú", "aeiou")?>',
        modalidad: '<?=Constantes::EXPO?>'
	},
    {
		text:'Aduana Exportación Terrestre',
		leaf:true,
        opcion: 'aexter',
        impoexpo: '<?=strtr(Constantes::EXPO, "áéíóú", "aeiou")?>',
        transporte: '<?=strtr(Constantes::TERRESTRE, "áéíóú", "aeiou")?>',
        modalidad: '<?=Constantes::EXPO?>'
	}        
        
]
<?
exit;
?>