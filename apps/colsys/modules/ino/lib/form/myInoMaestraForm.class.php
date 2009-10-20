<?php

/**
 * InoMaestra form.
 *
 * @package    form
 * @subpackage InoMaestra
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class myInoMaestraForm extends BaseInoMaestraForm
{
    public function configure()
    {
        $this->widgetSchema['ca_fchreferencia']=new sfWidgetFormExtDate();
        $this->widgetSchema['ca_fchmaster']=new sfWidgetFormExtDate();       
    }

  

}