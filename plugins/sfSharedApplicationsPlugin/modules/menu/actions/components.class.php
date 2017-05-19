<?php

/*
 * 
 */

class menuComponents extends sfComponents {
    /*
     * 
     */

    public function executeSubmenubar() {
        $module = $this->getContext()->getModuleName();
        $action = $this->getContext()->getActionName();

        $button = array();
        //echo sfConfig::get("sf_plugins_dir");

        $user = $this->getUser();
        $filename = sfConfig::get("sf_app_module_dir") . DIRECTORY_SEPARATOR . $module . DIRECTORY_SEPARATOR . "templates" . DIRECTORY_SEPARATOR . "_submenuBar.php";
        if (file_exists($filename)) {
            include($filename);
        } else {
            $pluginDirs = array(sfConfig::get('sf_plugins_dir') . DIRECTORY_SEPARATOR . "sfSharedApplicationsPlugin" . DIRECTORY_SEPARATOR . "modules" . DIRECTORY_SEPARATOR . $module . DIRECTORY_SEPARATOR . "templates" . DIRECTORY_SEPARATOR);

            foreach ($pluginDirs as $dir) {
                $filename = $dir . "_submenuBar.php";
                if (file_exists($filename)) {
                    include($filename);
                }
            }
        }

        $this->buttons = $button;
        $this->buttonHelp = isset($buttonHelp) ? $buttonHelp : null;
    }
    /*
     * 
     */

    public function executeMenubar() {

        $this->grupos = $this->getUser()->getMenu();
        $this->userid = "Bienvenido <b>" . $this->getUser()->getNombre() . "</b>";
        $trm = Doctrine::getTable("Trms")->find(date("Y-m-d"));
        if ($trm)
            $this->trmHoy = "$" . round($trm->getCaPesos(), 2);
        else
            $this->trmHoy = "Sin Registrar";
    }

    public function executeLogoHeader() {

        $user = $this->getUser();
        $this->idempresa = $user->getIdempresa();
    }
}
?>