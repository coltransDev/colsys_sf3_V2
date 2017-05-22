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
        //print_r("#sdsdsdsdsglkdfjkljklñjlkjk#");
        
		//echo "sdfsd";
        //exit;
		if( $this->getUser()->hasCredential("colsys_user") ){
            //exit("1");
			$this->forward("homepage","indexColsys");
		}
		$cliente =$this->getRequestParameter( "cliente" );
		
		if( $cliente ){
			
			//Se verifica que el cliente activo este entre los clientes del usuario
			$clientes = $this->getUser()->getClientes();			
			foreach( $clientes  as $cl ){			
				if( $cl->getCaIdcliente()==$cliente ){
                    //exit("2");
					$this->getUser()->setClienteActivo( $cliente );		
					$this->redirect( "homepage/index2" );
				}
                //else
                    //exit("3");
			}									
		}else{
            
			$contacto = $this->getUser()->getContacto();	
			$clientes = $this->getUser()->getClientes();						
			
			if( count($clientes)==1 ){
                //exit("4");
				$this->getUser()->setClienteActivo( $clientes[0]->getCaIdcliente() );
				$this->redirect( "homepage/index2" );
			}
            //else
                //exit("5");
			$this->contacto = $contacto;
			$this->clientes = $clientes;
		}
        //print_r($this->clientes);
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
				
	}
	
}


?>