<?php

/**
 * kbase actions.
 *
 * @package    colsys
 * @subpackage kbase
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class kbaseActions extends sfActions
{
	const RUTINA = "38";
	/**
	* Muestra un listado de la base de datos
	*
	* @param sfRequest $request A request object
	*/
	public function executeIndex(sfWebRequest $request)
	{
	
		$this->nivel = $this->getUser()->getNivelAcceso( kbaseActions::RUTINA );				
		if( $this->nivel==-1 ){
			$this->forward404();
		}
		
		
		
		$c = new Criteria();
		$c->addAscendingOrderByColumn( HdeskKBaseCategoryPeer::CA_PARENT );
		$c->addAscendingOrderByColumn( HdeskKBaseCategoryPeer::CA_NAME );
					
	
		$this->categorias = HdeskKBaseCategoryPeer::doSelect( $c );
			
	}
	
	/**
	* Muestra el detalle de un item de la base de datos
	*
	* @param sfRequest $request A request object
	*/
	public function executeVerContenido(sfWebRequest $request)
	{
		$this->nivel = $this->getUser()->getNivelAcceso( kbaseActions::RUTINA );				
		if( $this->nivel==-1 ){
			$this->forward404();
		}
		
		$this->kbase = HdeskKBasePeer::retrieveByPk( $request->getParameter("id") );
		$this->forward404Unless( $this->kbase );
			
	}
	
	public function executeFormContenido( $request ){
		$this->nivel = $this->getUser()->getNivelAcceso( kbaseActions::RUTINA );				
		if( $this->nivel<1 ){
			$this->forward404();
		}
		
		$this->kbase = HdeskKBasePeer::retrieveByPk( $request->getParameter("id") );
		if( !$this->kbase ){
			$this->kbase = new HdeskKBase();
		}
		
	}
	
	
	/**
	* Guarda los datos de un contenido 
	*
	* @param sfRequest $request A request object
	*/
	public function executeFormContenidoGuardar(sfWebRequest $request){
		$update = false;
		$user = $this->getUser();
	
		if( $request->getParameter("idkbase") ){
			$kbase = HdeskKBasePeer::retrieveByPk( $request->getParameter("idkbase") );
			$update = true;
		}else{
			$kbase = new HdeskKBase();
			$kbase->setCaLogin( $user->getUserId() );
			$kbase->setCaCreatedat( time() );	
		}			
	
		$kbase->setCaTitle( utf8_decode($request->getParameter("title")) );
		$kbase->setCaText( utf8_decode($request->getParameter("text")) );
		//$kbase->setCaIdcategory( 8 );
		
		$kbase->save();
		
		
		
		
		
		
		
		
		$this->responseArray = array("idkbase"=>$kbase->getCaIdkbase(), "success"=>true);	
		$this->setTemplate("responseTemplate");		
		$this->setLayout("ajax");
	
	}
	
}
?>