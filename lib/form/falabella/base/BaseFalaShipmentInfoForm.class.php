<?php

/**
 * FalaShipmentInfo form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseFalaShipmentInfoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_iddoc'              => new sfWidgetFormInputHidden(),
      'ca_begin_window'       => new sfWidgetFormDate(),
      'ca_end_window'         => new sfWidgetFormDate(),
      'ca_commodities'        => new sfWidgetFormInput(),
      'ca_partial'            => new sfWidgetFormInput(),
      'ca_payment_terms'      => new sfWidgetFormInput(),
      'ca_incoterms'          => new sfWidgetFormInput(),
      'ca_container_type'     => new sfWidgetFormInput(),
      'ca_utv'                => new sfWidgetFormInput(),
      'ca_etv'                => new sfWidgetFormInput(),
      'ca_line'               => new sfWidgetFormInput(),
      'ca_contact_line'       => new sfWidgetFormInput(),
      'ca_contact_importer'   => new sfWidgetFormInput(),
      'ca_uppo'               => new sfWidgetFormInput(),
      'ca_eb'                 => new sfWidgetFormInput(),
      'ca_edd'                => new sfWidgetFormInput(),
      'ca_port'               => new sfWidgetFormInput(),
      'ca_transshipment'      => new sfWidgetFormInput(),
      'ca_transshipment_port' => new sfWidgetFormInput(),
      'ca_shipping_org'       => new sfWidgetFormInput(),
      'ca_original_org'       => new sfWidgetFormInput(),
      'ca_fwd_copy_org'       => new sfWidgetFormInput(),
      'ca_fcr_org'            => new sfWidgetFormInput(),
      'ca_shipping_dst'       => new sfWidgetFormInput(),
      'ca_original_dst'       => new sfWidgetFormInput(),
      'ca_fwd_copy_dst'       => new sfWidgetFormInput(),
      'ca_fcr_dst'            => new sfWidgetFormInput(),
      'ca_transport_via'      => new sfWidgetFormInput(),
      'ca_invoice_org'        => new sfWidgetFormInput(),
      'ca_packing_list_org'   => new sfWidgetFormInput(),
      'ca_document_org'       => new sfWidgetFormInput(),
      'ca_oc_org'             => new sfWidgetFormInput(),
      'ca_others_docs_org'    => new sfWidgetFormInput(),
      'ca_invoice_cps'        => new sfWidgetFormInput(),
      'ca_packing_list_cps'   => new sfWidgetFormInput(),
      'ca_document_cps'       => new sfWidgetFormInput(),
      'ca_oc_cps'             => new sfWidgetFormInput(),
      'ca_others_docs_cps'    => new sfWidgetFormInput(),
      'ca_final_port'         => new sfWidgetFormInput(),
      'ca_alter_port'         => new sfWidgetFormInput(),
      'ca_limit_date'         => new sfWidgetFormDate(),
    ));

    $this->setValidators(array(
      'ca_iddoc'              => new sfValidatorPropelChoice(array('model' => 'FalaHeader', 'column' => 'ca_iddoc', 'required' => false)),
      'ca_begin_window'       => new sfValidatorDate(array('required' => false)),
      'ca_end_window'         => new sfValidatorDate(array('required' => false)),
      'ca_commodities'        => new sfValidatorString(array('required' => false)),
      'ca_partial'            => new sfValidatorString(array('required' => false)),
      'ca_payment_terms'      => new sfValidatorString(array('required' => false)),
      'ca_incoterms'          => new sfValidatorString(array('required' => false)),
      'ca_container_type'     => new sfValidatorString(array('required' => false)),
      'ca_utv'                => new sfValidatorString(array('required' => false)),
      'ca_etv'                => new sfValidatorString(array('required' => false)),
      'ca_line'               => new sfValidatorString(array('required' => false)),
      'ca_contact_line'       => new sfValidatorString(array('required' => false)),
      'ca_contact_importer'   => new sfValidatorString(array('required' => false)),
      'ca_uppo'               => new sfValidatorNumber(array('required' => false)),
      'ca_eb'                 => new sfValidatorString(array('required' => false)),
      'ca_edd'                => new sfValidatorString(array('required' => false)),
      'ca_port'               => new sfValidatorString(array('required' => false)),
      'ca_transshipment'      => new sfValidatorString(array('required' => false)),
      'ca_transshipment_port' => new sfValidatorString(array('required' => false)),
      'ca_shipping_org'       => new sfValidatorString(array('required' => false)),
      'ca_original_org'       => new sfValidatorString(array('required' => false)),
      'ca_fwd_copy_org'       => new sfValidatorString(array('required' => false)),
      'ca_fcr_org'            => new sfValidatorString(array('required' => false)),
      'ca_shipping_dst'       => new sfValidatorString(array('required' => false)),
      'ca_original_dst'       => new sfValidatorString(array('required' => false)),
      'ca_fwd_copy_dst'       => new sfValidatorString(array('required' => false)),
      'ca_fcr_dst'            => new sfValidatorString(array('required' => false)),
      'ca_transport_via'      => new sfValidatorString(array('required' => false)),
      'ca_invoice_org'        => new sfValidatorString(array('required' => false)),
      'ca_packing_list_org'   => new sfValidatorString(array('required' => false)),
      'ca_document_org'       => new sfValidatorString(array('required' => false)),
      'ca_oc_org'             => new sfValidatorString(array('required' => false)),
      'ca_others_docs_org'    => new sfValidatorString(array('required' => false)),
      'ca_invoice_cps'        => new sfValidatorString(array('required' => false)),
      'ca_packing_list_cps'   => new sfValidatorString(array('required' => false)),
      'ca_document_cps'       => new sfValidatorString(array('required' => false)),
      'ca_oc_cps'             => new sfValidatorString(array('required' => false)),
      'ca_others_docs_cps'    => new sfValidatorString(array('required' => false)),
      'ca_final_port'         => new sfValidatorString(array('required' => false)),
      'ca_alter_port'         => new sfValidatorString(array('required' => false)),
      'ca_limit_date'         => new sfValidatorDate(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('fala_shipment_info[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'FalaShipmentInfo';
  }


}
