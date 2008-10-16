<?php

/**
 * widgets actions.
 *
 * @package    colsys
 * @subpackage widgets
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class widgetsActions extends sfActions
{
	/**
	* Retorna un objeto JSON con la información de todos los paises
	*
	* @param sfRequest $request A request object
	*/
	public function executeDatosPaises($request)
	{		
		$c=new Criteria();
		$c->add( TraficoPeer::CA_IDTRAFICO, '99-999', Criteria::NOT_EQUAL );			
		$c->addAscendingOrderByColumn( TraficoPeer::CA_NOMBRE );
		$traficos_rs = TraficoPeer::doSelect( $c );
		
		$this->traficos = array();
		
		foreach($traficos_rs as $trafico){
			$row = array("idtrafico"=>$trafico->getCaIdTrafico(),"trafico"=>utf8_encode($trafico->getCaNombre()));
			$this->traficos[]=$row;
		}
		$this->setLayout("ajax");
	}
	
	/**
	* Retorna un objeto JSON con la información de todas las ciudades
	*
	* @param sfRequest $request A request object
	*/
	public function executeDatosCiudades($request)
	{		
		$idpais = utf8_decode($this->getRequestParameter("idpais"));
	
		$c=new Criteria();
		$c->add( CiudadPeer::CA_IDTRAFICO, $idpais );
		$c->addAscendingOrderByColumn( CiudadPeer::CA_CIUDAD );
		$ciudades_rs = CiudadPeer::doSelect( $c );
		
		$this->ciudades = array();		
		foreach($ciudades_rs as $ciudad){
			$row = array('idciudad'=>$ciudad->getCaIdCiudad(),"ciudad"=>utf8_encode($ciudad->getCaCiudad()));
			$this->ciudades[]=$row;
		}
		$this->setLayout("ajax");		
	}
}
