<?php

/**
 * RepCosto form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseRepCostoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'oid'               => new sfWidgetFormInputHidden(),
      'ca_idreporte'      => new sfWidgetFormPropelChoice(array('model' => 'Reporte', 'add_empty' => false)),
      'ca_idcosto'        => new sfWidgetFormPropelChoice(array('model' => 'Costo', 'add_empty' => false)),
      'ca_tipo'           => new sfWidgetFormInput(),
      'ca_vlrcosto'       => new sfWidgetFormInput(),
      'ca_mincosto'       => new sfWidgetFormInput(),
      'ca_netcosto'       => new sfWidgetFormInput(),
      'ca_idmoneda'       => new sfWidgetFormInput(),
      'ca_detalles'       => new sfWidgetFormInput(),
      'ca_fchcreado'      => new sfWidgetFormDate(),
      'ca_usucreado'      => new sfWidgetFormInput(),
      'ca_fchactualizado' => new sfWidgetFormDate(),
      'ca_usuactualizado' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'oid'               => new sfValidatorPropelChoice(array('model' => 'RepCosto', 'column' => 'oid', 'required' => false)),
      'ca_idreporte'      => new sfValidatorPropelChoice(array('model' => 'Reporte', 'column' => 'ca_idreporte')),
      'ca_idcosto'        => new sfValidatorPropelChoice(array('model' => 'Costo', 'column' => 'ca_idcosto')),
      'ca_tipo'           => new sfValidatorString(),
      'ca_vlrcosto'       => new sfValidatorNumber(),
      'ca_mincosto'       => new sfValidatorNumber(array('required' => false)),
      'ca_netcosto'       => new sfValidatorNumber(array('required' => false)),
      'ca_idmoneda'       => new sfValidatorString(array('required' => false)),
      'ca_detalles'       => new sfValidatorString(array('required' => false)),
      'ca_fchcreado'      => new sfValidatorDate(array('required' => false)),
      'ca_usucreado'      => new sfValidatorString(array('required' => false)),
      'ca_fchactualizado' => new sfValidatorDate(array('required' => false)),
      'ca_usuactualizado' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rep_costo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'RepCosto';
  }


}
