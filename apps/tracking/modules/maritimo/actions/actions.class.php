<?php 

/**
 * maritimo actions.
 *
 * @package    colsys
 * @subpackage maritimo
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class maritimoActions extends sfActions
{
	/**
	* Executes index action
	*
	*/
	public function executeIndex()
	{					
			
	}
	
	
	/*
	* Muestra detalles de la referencia
	*/
	
	public function executeDetailsRep(){
	
	
		/*$referencia =  $this->getRequestParameter("referencia");		
		$this->forward404Unless( $referencia );
		
		$c = new Criteria();
		$c->add( InoClientesSeaPeer::CA_REFERENCIA, $referencia );
		$c->add( InoClientesSeaPeer::CA_IDCLIENTE, $this->getUser()->getClienteActivo() );
		$this->referenciasCliente = InoClientesSeaPeer::doSelect( $c );		*/
		
		$this->user = $this->getUser();

	}
} 
?>