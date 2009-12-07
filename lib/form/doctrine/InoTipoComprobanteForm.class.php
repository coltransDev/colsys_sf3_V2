<?php

/**
 * InoTipoComprobante form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class InoTipoComprobanteForm extends BaseInoTipoComprobanteForm
{
    public function configure()
    {
        $this->widgetSchema['ca_tipo']=new sfWidgetFormChoice( array( "choices" => array("F"=>"F- Factura"
                                                                                          ) ), array("onchange"=>"checkTipo()") );

        $this->widgetSchema['ca_comprobante']=new sfWidgetFormInputText(array(), array("maxlength"=>2,"onchange"=>"checkTipo()"));
        $this->widgetSchema['ca_titulo']=new sfWidgetFormInputText(array(), array("maxlength"=>50));

        $this->widgetSchema['ca_noautorizacion']=new sfWidgetFormInputText(array(), array("maxlength"=>20));
        $this->widgetSchema['ca_prefijo_aut']=new sfWidgetFormInputText(array(), array("maxlength"=>5));

        
    }

    public function bind(array $taintedValues = null, array $taintedFiles = null){
		$request = sfContext::getInstance()->getRequest();

		if( $taintedValues["ca_tipo"]=="F" ){
			$this->validatorSchema['ca_noautorizacion']->setOption('required', true);
            $this->validatorSchema['ca_inicial_aut']->setOption('required', true);
            $this->validatorSchema['ca_final_aut']->setOption('required', true);

		}
		parent::bind($taintedValues, $taintedFiles);
	}


}
