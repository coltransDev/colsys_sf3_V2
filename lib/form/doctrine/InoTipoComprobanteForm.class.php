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
                                                                                          ) ) );
  }
}
