<?php

/**
 * RepSeguro form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseRepSeguroForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idreporte'       => new sfWidgetFormInputHidden(),
      'ca_vlrasegurado'    => new sfWidgetFormInput(),
      'ca_idmoneda_vlr'    => new sfWidgetFormInput(),
      'ca_primaventa'      => new sfWidgetFormInput(),
      'ca_minimaventa'     => new sfWidgetFormInput(),
      'ca_idmoneda_vta'    => new sfWidgetFormInput(),
      'ca_obtencionpoliza' => new sfWidgetFormInput(),
      'ca_idmoneda_pol'    => new sfWidgetFormInput(),
      'ca_seguro_conf'     => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idreporte'       => new sfValidatorPropelChoice(array('model' => 'Reporte', 'column' => 'ca_idreporte', 'required' => false)),
      'ca_vlrasegurado'    => new sfValidatorNumber(),
      'ca_idmoneda_vlr'    => new sfValidatorString(),
      'ca_primaventa'      => new sfValidatorNumber(),
      'ca_minimaventa'     => new sfValidatorNumber(),
      'ca_idmoneda_vta'    => new sfValidatorString(),
      'ca_obtencionpoliza' => new sfValidatorNumber(),
      'ca_idmoneda_pol'    => new sfValidatorString(),
      'ca_seguro_conf'     => new sfValidatorString(),
    ));

    $this->widgetSchema->setNameFormat('rep_seguro[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'RepSeguro';
  }


}
