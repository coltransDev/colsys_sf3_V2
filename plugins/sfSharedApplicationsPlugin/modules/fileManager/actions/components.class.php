<?php

/**
 * gestDocumental components.
 *
 * @package    colsys
 * @subpackage gestDocumental
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class fileManagerComponents extends sfComponents
{

    public function executeFileBrowser(){
        $response = sfContext::getInstance()->getResponse();
		$response->addStylesheet("extExtras/filebrowser",'last');

	}
}
?>