<?php
 
/**
 * users components.
 *
 * @package    colsys
 * @subpackage users
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class usersComponents extends sfComponents
{
	/**
	* 
	*
	*/
	public function executeGrillaRutinaGrupos()
	{	
		
		$c = new Criteria();
		$c->add( AccesoGrupoPeer::CA_RUTINA, $this->rutina->getCaRutina() );
		$accesoGrupos = AccesoGrupoPeer::doSelect( $c );
		$accesos =array();
		foreach( $accesoGrupos as $accesoGrupo ){
			$accesos[$accesoGrupo->getCaGrupo()]=$accesoGrupo->getCaAcceso();
		}
				
		$this->accesos = RutinaPeer::getAccesos();	
			
		$username = sfConfig::get("app_ldap_user");
		$passwd = sfConfig::get("app_ldap_passwd");
		$grupos=array();
				
		if( $username && $passwd ){
			// $auth_user="cn=".$username.",o=coltrans_bog";			
                        $auth_user = $username . "@COLTRANS.LOCAL";
			$ldap_server=sfConfig::get("app_ldap_host");
			
			if($connect=ldap_connect($ldap_server)){
				
				if(@$bind=ldap_bind($connect, $auth_user, $passwd)){
									
					$sr = ldap_search($connect,"o=coltrans_bog" , "(&(objectclass=group)(!(equivalentToMe=cn=admin,o=coltrans_bog)))" );
 					$grupos = ldap_get_entries($connect, $sr);							
				}else{					
				 	echo "No se puede conectar al servidor";					
				}
				ldap_close($connect);           
			}else{
				echo "sin conexion";
			}
		}
		
		$this->data=array();		
		
		$c = new Criteria();
		$gruposGrp = GrupoPeer::doSelect( $c );
		
		$gruposLdap = array();
		foreach( $gruposGrp as $grp ){
			$gruposLdap[]=$grp->getCanombre();
		}
				
		for($i=0; $i<$grupos['count'] ;$i++){
			$grupo = $grupos[$i]["cn"][0];			
			if( in_array($grupo, $gruposLdap )!==false ){				
				if( isset( $accesos[$grupo] ) ){
					$sel = true;
					$nivel = $accesos[$grupo];
					$nivel_val = $this->accesos[$nivel];				
				}else{
					$sel = false;
					$nivel = "";
					$nivel_val = "";
				}						
										
				$this->data[]=array('grupo'=>$grupo,
									'sel'=>$sel,
									'nivel'=>$nivel,
									'nivel_val'=>utf8_encode($nivel_val)
								);	
			}
		}			
	}
	
	/**
	* 
	*
	*/
	public function executeGrillaRutinaUsuarios()
	{	
		
		$c = new Criteria();
		$c->add( AccesoUsuarioPeer::CA_RUTINA, $this->rutina->getCaRutina() );
		$accesoUsuarios = AccesoUsuarioPeer::doSelect( $c );
		$accesos =array();
		foreach( $accesoUsuarios as $accesoUsuario ){
			$accesos[$accesoUsuario->getCaLogin()]=$accesoUsuario->getCaAcceso();
		}
		
						
		$this->accesos = RutinaPeer::getAccesos();	
		/*	
		$username = sfConfig::get("app_ldap_user");
		$passwd = sfConfig::get("app_ldap_passwd");
		$grupos=array();
				
		if( $username && $passwd ){
			$auth_user="cn=".$username.",o=coltrans_bog";			
			$ldap_server=sfConfig::get("app_ldap_host");
			
			if($connect=ldap_connect($ldap_server)){
				
				if(@$bind=ldap_bind($connect, $auth_user, $passwd)){
									
					$sr = ldap_search($connect,"o=coltrans_bog" , "(objectClass=person)" );
 					$usuarios = ldap_get_entries($connect, $sr);							
				}else{					
				 	echo "No se puede conectar al servidor";					
				}
				ldap_close($connect);           
			}else{
				echo "sin conexion";
			}
		}*/
		
		$this->data=array();		
		
		
		$c = new Criteria();
		$c->add( UsuarioPeer::CA_ACTIVO, true );
		$c->addAscendingOrderByColumn( UsuarioPeer::CA_LOGIN );
		$usuarios = UsuarioPeer::doSelect( $c );
		
		foreach( $usuarios as $usuario ){
			if( isset( $accesos[$usuario->getCaLogin()] ) ){
				$sel = true;
				$nivel = $accesos[$usuario->getCaLogin()];
				$nivel_val = $this->accesos[$nivel];				
			}else{
				$sel = false;
				$nivel = "";
				$nivel_val = "";
			}		
			
			$this->data[]=array('login'=>utf8_encode($usuario->getCaLogin()),
								'sel'=>$sel,
								'nivel'=>$nivel,
								'nivel_val'=>utf8_encode($nivel_val)
								);	
		}
		
		
		
		/*
		//print_r( $usuarios );
		for($i=0; $i<$usuarios['count'] ;$i++){
			$usuario = $usuarios[$i]["cn"][0];
			//$nombre = $usuarios[$i]["2"]["fullname"];//["0"];
			//print_r( $nombre  );
			//print_r( $usuarios[$i] );
			if( isset( $accesos[$usuario] ) ){
				$sel = true;
				$nivel = $accesos[$usuario];
				$nivel_val = $this->accesos[$nivel];				
			}else{
				$sel = false;
				$nivel = "";
				$nivel_val = "";
			}						
			
						
			$this->data[]=array('login'=>$usuario,
								'sel'=>$sel,
								'nivel'=>$nivel,
								'nivel_val'=>utf8_encode($nivel_val)
								);			
		}		*/
		
		
		
	}


    public function executePanelUsers(){
        
    }

	
    public function executeGridParamUsuariosExt4(){
        
    }
    
    
  
}
?>