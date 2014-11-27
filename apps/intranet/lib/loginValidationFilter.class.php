<?php

class loginValidationFilter extends sfFilter {

    public function execute($filterChain) {

        $module = sfContext::getInstance()->getModuleName();
        $action = sfContext::getInstance()->getActionName();
        if ($module == "adminUsers" && $action == "login") {
            $ip = Utils::getRealIpAddr();

            $ldap_server = sfConfig::get("app_ldap_host");
            // $auth_user = "cn=" . sfConfig::get("app_ldap_user") . ",o=coltrans_bog";
            $auth_user = sfConfig::get("app_ldap_user") . "@COLTRANS.LOCAL";
            $passwd = sfConfig::get("app_ldap_passwd");

            if ($connect = ldap_connect($ldap_server)) {

                if ($bind = ldap_bind($connect, $auth_user, $passwd)) {
                    //Determina la pertenecia a los grupos en el serv. LDAP
                    //echo $ip;
                    $netaddress = "9#";
                    $octets = explode(".", $ip);
                    $netaddress .= sprintf("%c%c", 0, 0);
                    foreach ($octets as $octet) {
                        $octets = explode(".", $ip);

                        $netaddress = $netaddress . sprintf("%c", $octet);
                    }

                    $netaddress = Utils::ldap_escape($netaddress);

                    $searchString = "(&(objectclass=user)(networkAddress=$netaddress))";

                    $sr = ldap_search($connect, "o=coltrans_bog", $searchString, array("cn"));
                    // $sr = ldap_search($connect, "DC=COLTRANS,DC=LOCAL", $searchString, array("cn"));
                    $entry = ldap_first_entry($connect, $sr);
                    if ($entry) {
                        $attrs = ldap_get_attributes($connect, $entry);
                        $login = $attrs["cn"][0];

                        if ($login) {
                            sfContext::getInstance()->getUser()->signIn($login);
                        }
                    }
                }
            }
        }
        if ($module == "gestDocumental" && $action == "verArchivo") {

            $folders = explode(",", sfConfig::get('app_gestDocumental_noAuth'));
            $folder = base64_decode(sfContext::getInstance()->getRequest()->getParameter("folder"));

            if (in_array($folder, $folders)) {
                $filterChain->execute();
            }
        }
        if ($module == "gestDocumental" && $action == "verArchivoLibreClave") {
            $filterChain->execute();
        }


        //$filterChain->execute();	
        if (($module == "adminUsers" && $action == "login") || sfContext::getInstance()->getConfiguration()->getEnvironment() == "cli") {
            $filterChain->execute();
        } else {
            if (sfContext::getInstance()->getUser()->isAuthenticated()) {
                $module = sfContext::getInstance()->getModuleName();
                $action = sfContext::getInstance()->getActionName();

                if (sfContext::getInstance()->getUser()->getAttribute("forcechange") && !($module == "adminUsers" && $action == "changePasswd")) {
                    sfContext::getInstance()->getController()->redirect("adminUsers/changePasswd");
                }
                $filterChain->execute();
            } else {
                sfContext::getInstance()->getController()->forward("adminUsers", "login");
                //header("Location: /adminUsers/login");
                exit();
            }
        }
    }

}

?>
