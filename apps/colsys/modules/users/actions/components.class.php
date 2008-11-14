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
	* Executes index action
	*
	*/
	public function executeGrillaRutinaGrupos()
	{	
		$username = sfConfig::get("app_ldap_user");
		$passwd = sfConfig::get("app_ldap_passwd");
		$grupos=array();
				
		if( $username && $passwd ){
			$auth_user="cn=".$username.",o=coltrans_bog";			
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
		for($i=0; $i<$grupos['count'] ;$i++){
			$this->data[]=array('grupo'=>$grupos[$i]["cn"][0]);			
		}		
	}
  
}
?>