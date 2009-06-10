<?php 
/*
* 
*/
class menuComponents extends sfComponents
{
	/*
	* 
	*/	
  	public function executeSubmenubar(){				
		$module = $this->getContext()->getModuleName ();
		$action = $this->getContext()->getActionName ();
				
		$button=array();			

		$filename=sfConfig::get("sf_app_module_dir").DIRECTORY_SEPARATOR.$module.DIRECTORY_SEPARATOR."templates".DIRECTORY_SEPARATOR."_submenuBar.php";
		if( file_exists($filename) ){
			include($filename);
		}			
		$this->buttons = $button;		   
					
		
	} 
	
	
	
	/*
	* 
	*/	
	public function executeMenubar(){				
	
		$usuario = UsuarioPeer::retrieveByPk( $this->getUser()->getUserId() );
			
		$this->grupos = array();
		
		if( $usuario->getCaAuthMethod()=="ldapP" ){
			$c = new Criteria();					
			$c->addJoin( RutinaPeer::CA_RUTINA, AccesoPerfilPeer::CA_RUTINA , Criteria::LEFT_JOIN );		
			$c->addJoin( AccesoPerfilPeer::CA_PERFIL, UsuarioPerfilPeer::CA_PERFIL , Criteria::LEFT_JOIN );	
			$c->addJoin( RutinaPeer::CA_RUTINA, AccesoUsuarioPeer::CA_RUTINA,  Criteria::LEFT_JOIN );
					
			$criterion = $c->getNewCriterion( UsuarioPerfilPeer::CA_LOGIN, $this->getUser()->getUserId() );								
			$criterion->addOr($c->getNewCriterion( AccesoUsuarioPeer::CA_LOGIN, $this->getUser()->getUserId() ));	
			$c->add($criterion);			
			
			$c->add(  AccesoUsuarioPeer::CA_ACCESO, 0 , Criteria::GREATER_EQUAL );
			$c->addOr(  AccesoUsuarioPeer::CA_ACCESO, null , Criteria::ISNULL );
			
			$c->add(  AccesoPerfilPeer::CA_ACCESO, 0 , Criteria::GREATER_EQUAL );
			$c->addOr(  AccesoPerfilPeer::CA_ACCESO, null , Criteria::ISNULL );
			
			$c->setDistinct();	
					
			$c->addAscendingOrderByColumn( RutinaPeer::CA_GRUPO );
			$c->addAscendingOrderByColumn( RutinaPeer::CA_OPCION );
			$rutinas = RutinaPeer::doSelect( $c );
			
			foreach( $rutinas as $rutina ){
				if( !isset( $this->grupos[$rutina->getCaGrupo()] )){
					$this->grupos[$rutina->getCaGrupo()]=array();
				}
				$this->grupos[$rutina->getCaGrupo()][]=$rutina;		
			}
		}else{				
			$c = new Criteria();					
			$c->addJoin( RutinaPeer::CA_RUTINA, AccesoGrupoPeer::CA_RUTINA , Criteria::LEFT_JOIN );		
			$c->addJoin( AccesoGrupoPeer::CA_GRUPO, UsuarioGrupoPeer::CA_GRUPO , Criteria::LEFT_JOIN );	
			$c->addJoin( RutinaPeer::CA_RUTINA, AccesoUsuarioPeer::CA_RUTINA,  Criteria::LEFT_JOIN );
					
			$criterion = $c->getNewCriterion( UsuarioGrupoPeer::CA_LOGIN, $this->getUser()->getUserId() );								
			$criterion->addOr($c->getNewCriterion( AccesoUsuarioPeer::CA_LOGIN, $this->getUser()->getUserId() ));	
			$c->add($criterion);			
			
			$c->add(  AccesoUsuarioPeer::CA_ACCESO, 0 , Criteria::GREATER_EQUAL );
			$c->addOr(  AccesoUsuarioPeer::CA_ACCESO, null , Criteria::ISNULL );
			
			$c->add(  AccesoGrupoPeer::CA_ACCESO, 0 , Criteria::GREATER_EQUAL );
			$c->addOr(  AccesoGrupoPeer::CA_ACCESO, null , Criteria::ISNULL );
			
			$c->setDistinct();	
					
			$c->addAscendingOrderByColumn( RutinaPeer::CA_GRUPO );
			$c->addAscendingOrderByColumn( RutinaPeer::CA_OPCION );
			$rutinas = RutinaPeer::doSelect( $c );
			
			foreach( $rutinas as $rutina ){
				if( !isset( $this->grupos[$rutina->getCaGrupo()] )){
					$this->grupos[$rutina->getCaGrupo()]=array();
				}
				$this->grupos[$rutina->getCaGrupo()][]=$rutina;		
			}
		}
		$this->userid = $this->getUser()->getUserId();		
	} 
	
	
	
}
?>