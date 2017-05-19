<?php

/**
 * homepage actions.
 *
 * @package    colsys
 * @subpackage homepage
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class homepageActions extends sfActions
{
    /**
    * Muestra un formulario para seleccionar el usuario en caso de que haya 
	* un solo cliente es seleccionado automaticamente y enviado a index2
    *
    */
	public function executeIndex()
	{
		
		if( $this->getUser()->hasCredential("colsys_user") ){
			$this->forward("homepage","indexColsys");
		}
		$cliente =$this->getRequestParameter( "cliente" );
		
		if( $cliente ){
			
			//Se verifica que el cliente activo este entre los clientes del usuario
			$clientes = $this->getUser()->getClientes();			
			foreach( $clientes  as $cl ){			
				if( $cl->getCaIdcliente()==$cliente ){
					$this->getUser()->setClienteActivo( $cliente );		
					$this->redirect( "homepage/index2" );
				}
			}
									
		}else{
			$contacto = $this->getUser()->getContacto();	
			$clientes = $this->getUser()->getClientes();						
			
			if( count($clientes)==1 ){
				$this->getUser()->setClienteActivo( $clientes[0]->getCaIdcliente() );
				$this->redirect( "homepage/index2" );
			}
			
			$this->contacto = $contacto;
			$this->clientes = $clientes;
		}		
	}
	
	/*
	* Muestra el componente ListaClientes
	*/
	public function executeListaClientes(){
		$this->filtro = $this->getRequestParameter("filtro");		
		$this->setLayout("ajax");
	}
	
	/*
	* Muestra la pagina de index para usuarios de colsys donde 
	* pueden escoger cualquier cliente
	*/	
	public function executeIndexColsys(){
		if( $this->getRequestParameter( "idcliente" ) ){
			$cliente = Doctrine::getTable("Cliente")->find( $this->getRequestParameter( "idcliente" ) );
			if( $cliente ){
				$this->getUser()->setClienteActivo( $cliente->getCaIdcliente() );
				$this->redirect( "homepage/index2" );						
			}	
		}
	}
		
	/*
	* Muestra un informe con los ultimos despachos (por zarpar, en transito, los que ya llegaron)  
	*/
	
	public function executeIndex2(){
		if( !$this->getUser()->getClienteActivo() ){			
			$this->redirect( "homepage/index");
		}
                        $this->idcliente=$this->getUser()->getClienteActivo();
				
	}
	
}


?>