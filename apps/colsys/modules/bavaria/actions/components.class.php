<?php

/**
 * falabellaAdu actions.
 *
 * @package    colsys
 * @subpackage bavaria
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
 */
class bavariaComponents extends sfComponents {

    /*
    *
    */
    public function executeMainPanel()
    {
        $this->tipos = ParametroTable::retrieveByCaso("CU047");
        $this->navieras = ParametroTable::retrieveByCaso("CU082");
        $this->banderas = ParametroTable::retrieveByCaso("CU083");
    }

}
?>
