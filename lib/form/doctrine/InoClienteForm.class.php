<?php

/**
 * InoCliente form.
 *
 * @package    form
 * @subpackage InoCliente
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class InoClienteForm extends BaseInoClienteForm
{
  public function configure()
  {
      $this->widgetSchema['ca_fchhbls']=new sfWidgetFormExtDate();
      $this->widgetSchema['ca_idmaestra']=new sfWidgetFormInputHidden();
      $this->widgetSchema['ca_idproveedor']=new sfWidgetFormInputText();

      $this->useFields(array('ca_idinocliente', 'ca_idmaestra', 'ca_idproveedor', 'ca_idcliente',
                             'ca_hbls', 'ca_fchhbls', 'ca_idreporte', 'ca_idproveedor', 'ca_numpiezas',
                             'ca_peso', 'ca_volumen', 'ca_numorden', 'ca_vendedor', 'ca_idsubtrayecto',
                             'ca_idbodega', 'ca_observaciones' 
                            ));


       

  }
}