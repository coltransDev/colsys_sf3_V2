<?php
class loginValidationFilter extends sfFilter
{
	public function execute($filterChain)
	{

        $module = sfContext::getInstance()->getModuleName ();
		$action = sfContext::getInstance()->getActionName ();
        if( $module=="adminUsers" && $action=="login" ){
            $ip = Utils::getRealIpAddr();

            $ldap_server = sfConfig::get("app_ldap_host");
            $auth_user = "cn=" . sfConfig::get("app_ldap_user") . ",o=coltrans_bog";
            $passwd = sfConfig::get("app_ldap_passwd");

            if ($connect = ldap_connect($ldap_server)) {

                if ($bind = ldap_bind($connect, $auth_user, $passwd)) {
                    //Determina la pertenecia a los grupos en el serv. LDAP


                    $netaddress = "9#";
                    $octets = explode(".", $ip);
                    $netaddress .= sprintf("%c%c",0,0);
                    foreach( $octets as $octet ) {
                        $octets = explode(".", $ip);

                        $netaddress = $netaddress.sprintf("%c",$octet);
                    }

                    $netaddress = Utils::ldap_escape( $netaddress );

                    $searchString="(&(objectclass=user)(networkAddress=$netaddress))";

                    $sr = ldap_search($connect, "o=coltrans_bog", $searchString, array("cn") );
                    $entry = ldap_first_entry($connect, $sr);
                    if( $entry ){
                        $attrs = ldap_get_attributes($connect, $entry);
                        $login = $attrs["cn"][0];

                        if( $login ){
                            sfContext::getInstance()->getUser()->signIn( $login );
                        }
                    }

                }
            }
        }
        
		
				//$filterChain->execute();	
		if( ($module=="adminUsers" && $action=="login") || sfContext::getInstance()->getConfiguration()->getEnvironment()=="cli" ){
			$filterChain->execute();
            
		}else{
            if( sfContext::getInstance()->getUser()->isAuthenticated() ){
                $filterChain->execute();
            }else{
                sfContext::getInstance()->getController()->forward("adminUsers","login");
                //header("Location: /adminUsers/login");
                exit();
            }
		}
	}


}

?>
