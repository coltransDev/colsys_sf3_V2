<?php

/**
 * FalaHeader form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseFalaHeaderForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_iddoc'                  => new sfWidgetFormInputHidden(),
      'ca_fecha_carpeta'          => new sfWidgetFormDate(),
      'ca_archivo_origen'         => new sfWidgetFormInput(),
      'ca_reporte'                => new sfWidgetFormInput(),
      'ca_num_viaje'              => new sfWidgetFormInput(),
      'ca_cod_carrier'            => new sfWidgetFormInput(),
      'ca_codigo_puerto_pickup'   => new sfWidgetFormInput(),
      'ca_codigo_puerto_descarga' => new sfWidgetFormInput(),
      'ca_container_mode'         => new sfWidgetFormInput(),
      'ca_nombre_proveedor'       => new sfWidgetFormInput(),
      'ca_campo_59'               => new sfWidgetFormInput(),
      'ca_codigo_proveedor'       => new sfWidgetFormInput(),
      'ca_campo_61'               => new sfWidgetFormInput(),
      'ca_monto_invoice_miles'    => new sfWidgetFormInput(),
      'ca_procesado'              => new sfWidgetFormInputCheckbox(),
      'ca_trader'                 => new sfWidgetFormInput(),
      'ca_vendor_id'              => new sfWidgetFormInput(),
      'ca_vendor_name'            => new sfWidgetFormInput(),
      'ca_vendor_addr1'           => new sfWidgetFormInput(),
      'ca_vendor_city'            => new sfWidgetFormInput(),
      'ca_vendor_country'         => new sfWidgetFormInput(),
      'ca_esd'                    => new sfWidgetFormDate(),
      'ca_lsd'                    => new sfWidgetFormDate(),
      'ca_incoterms'              => new sfWidgetFormInput(),
      'ca_payment_terms'          => new sfWidgetFormInput(),
      'ca_proforma_number'        => new sfWidgetFormInput(),
      'ca_origin'                 => new sfWidgetFormInput(),
      'ca_destination'            => new sfWidgetFormInput(),
      'ca_trans_ship_port'        => new sfWidgetFormInput(),
      'ca_reqd_delivery'          => new sfWidgetFormDate(),
      'ca_orden_comments'         => new sfWidgetFormInput(),
      'ca_manufacturer_contact'   => new sfWidgetFormInput(),
      'ca_manufacturer_phone'     => new sfWidgetFormInput(),
      'ca_manufacturer_fax'       => new sfWidgetFormInput(),
      'ca_fchanulado'             => new sfWidgetFormDateTime(),
      'ca_usuanulado'             => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_iddoc'                  => new sfValidatorPropelChoice(array('model' => 'FalaHeader', 'column' => 'ca_iddoc', 'required' => false)),
      'ca_fecha_carpeta'          => new sfValidatorDate(array('required' => false)),
      'ca_archivo_origen'         => new sfValidatorString(array('required' => false)),
      'ca_reporte'                => new sfValidatorString(array('required' => false)),
      'ca_num_viaje'              => new sfValidatorString(array('required' => false)),
      'ca_cod_carrier'            => new sfValidatorString(array('required' => false)),
      'ca_codigo_puerto_pickup'   => new sfValidatorString(array('required' => false)),
      'ca_codigo_puerto_descarga' => new sfValidatorString(array('required' => false)),
      'ca_container_mode'         => new sfValidatorString(array('required' => false)),
      'ca_nombre_proveedor'       => new sfValidatorString(array('required' => false)),
      'ca_campo_59'               => new sfValidatorString(array('required' => false)),
      'ca_codigo_proveedor'       => new sfValidatorString(array('required' => false)),
      'ca_campo_61'               => new sfValidatorString(array('required' => false)),
      'ca_monto_invoice_miles'    => new sfValidatorNumber(array('required' => false)),
      'ca_procesado'              => new sfValidatorBoolean(array('required' => false)),
      'ca_trader'                 => new sfValidatorString(array('required' => false)),
      'ca_vendor_id'              => new sfValidatorString(array('required' => false)),
      'ca_vendor_name'            => new sfValidatorString(array('required' => false)),
      'ca_vendor_addr1'           => new sfValidatorString(array('required' => false)),
      'ca_vendor_city'            => new sfValidatorString(array('required' => false)),
      'ca_vendor_country'         => new sfValidatorString(array('required' => false)),
      'ca_esd'                    => new sfValidatorDate(array('required' => false)),
      'ca_lsd'                    => new sfValidatorDate(array('required' => false)),
      'ca_incoterms'              => new sfValidatorString(array('required' => false)),
      'ca_payment_terms'          => new sfValidatorString(array('required' => false)),
      'ca_proforma_number'        => new sfValidatorString(array('required' => false)),
      'ca_origin'                 => new sfValidatorString(array('required' => false)),
      'ca_destination'            => new sfValidatorString(array('required' => false)),
      'ca_trans_ship_port'        => new sfValidatorString(array('required' => false)),
      'ca_reqd_delivery'          => new sfValidatorDate(array('required' => false)),
      'ca_orden_comments'         => new sfValidatorString(array('required' => false)),
      'ca_manufacturer_contact'   => new sfValidatorString(array('required' => false)),
      'ca_manufacturer_phone'     => new sfValidatorString(array('required' => false)),
      'ca_manufacturer_fax'       => new sfValidatorString(array('required' => false)),
      'ca_fchanulado'             => new sfValidatorDateTime(array('required' => false)),
      'ca_usuanulado'             => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('fala_header[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'FalaHeader';
  }


}
