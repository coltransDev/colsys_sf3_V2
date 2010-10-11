<?php
class loginValidationFilter extends sfFilter
{
	public function execute($filterChain)
	{

        $ip = Utils::getRealIpAddr();
        echo $ip;


        $ldap_server = sfConfig::get("app_ldap_host");
        $auth_user = "cn=" . sfConfig::get("app_ldap_user") . ",o=coltrans_bog";
        $passwd = sfConfig::get("app_ldap_passwd");

        if ($connect = ldap_connect($ldap_server)) {


            if ($bind = ldap_bind($connect, $auth_user, $passwd)) {
                //Determina la pertenecia a los grupos en el serv. LDAP
                //$netaddress = $ip;

                $netaddress = "9\#";
                $octets = explode(".", $ip);
                $netaddress .= chr(0).chr(0);
                foreach( $octets as $octet ) {


                #      if (($octet >= 40) && ($octet <= 42)) {
                # The IP address is stored in eDirectory as four unsigned chars. ASCII 40, 41, 42 and # 92 are characters ( ) *\ which are known tokens in LDAP search filters If you don?t # escape these with a backslash they will cause LDAP errors and he script will fail.

                       $netaddress= $netaddress.chr($octet);
                }
                
                $group_filter_string = "(groupMembership=cn=quality,o=coltrans_bog)";
                //$searchString = "(&(objectclass=user)(networkAddress=$netaddress))";
                $searchString = "(&(objectclass=user)(|(groupMembership=cn=quality,o=coltrans_bog))(networkAddress=9#
?\\))";
                echo "--->".$searchString."<br />";
                $sr = ldap_search($connect, "o=coltrans_bog", $searchString );
                //$info = ldap_get_entries($connect, $sr);

                $entry = ldap_first_entry($connect, $sr);

                $attrs = ldap_get_attributes($connect, $entry);

                //echo $attrs["count"] . " attributes held for this entry:<p>";

                for ($i=0; $i < $attrs["count"]; $i++) {
                    echo "<b>".$attrs[$i] . "</b><br />";

                    $values = ldap_get_values_len($connect, $entry, $attrs[$i]);

                    //echo $values["count"] . " entry.<br />";

                    for ($j=0; $j < $values["count"]; $j++) {
                        echo $values[$j] . "<br />";

                    }
                }
            }
        }
        exit();
		$module = sfContext::getInstance()->getModuleName ();				
		$action = sfContext::getInstance()->getActionName ();
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