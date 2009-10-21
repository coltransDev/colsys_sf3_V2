<?php

/**
 * InoMaestra form.
 *
 * @package    form
 * @subpackage InoMaestra
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class InoMaestraForm extends BaseInoMaestraForm
{
    public function configure()
    {
        $this->widgetSchema['ca_fchreferencia']=new sfWidgetFormExtDate();
        $this->widgetSchema['ca_fchmaster']=new sfWidgetFormExtDate();

       /* $this->widgetSchema['ca_fchcreado']=new sfWidgetFormInputHidden();
        $this->widgetSchema['ca_usucreado']=new sfWidgetFormInputHidden();
        $this->widgetSchema['ca_fchactualizado']=new sfWidgetFormInputHidden();
        $this->widgetSchema['ca_usuactualizado']=new sfWidgetFormInputHidden();
        $this->widgetSchema['ca_fchliquidado']=new sfWidgetFormInputHidden();
        $this->widgetSchema['ca_usuliquidado']=new sfWidgetFormInputHidden();
        $this->widgetSchema['ca_fchcerrado']=new sfWidgetFormInputHidden();
        $this->widgetSchema['ca_usucerrado']=new sfWidgetFormInputHidden();
        $this->widgetSchema['ca_fchanulado']=new sfWidgetFormInputHidden();
        $this->widgetSchema['ca_usuanulado']=new sfWidgetFormInputHidden();*/

        $this->useFields(array('ca_idmaestra', 'ca_referencia', 'ca_fchreferencia', 'ca_fchmaster', 'ca_idtrayecto',
                               'ca_master', 'ca_fchmaster', 'ca_piezas', 'ca_peso', 'ca_volumen', 'ca_observaciones'  
                              ));





    }
}