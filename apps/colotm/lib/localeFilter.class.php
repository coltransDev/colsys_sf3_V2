<?

class localeFilter extends sfFilter
{
	public function execute($filterChain)
	{
		setlocale(LC_CTYPE, $this->getParameter('culture'));//Conversi�n de caracteres especiales a mayuscula		
		$filterChain->execute();	
	}
}
?>