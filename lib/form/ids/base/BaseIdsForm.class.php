<?php

/**
 * Ids form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseIdsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_id'                 => new sfWidgetFormInputHidden(),
      'ca_dv'                 => new sfWidgetFormInput(),
      'ca_idalterno'          => new sfWidgetFormInput(),
      'ca_tipoidentificacion' => new sfWidgetFormInput(),
      'ca_idgrupo'            => new sfWidgetFormInput(),
      'ca_nombre'             => new sfWidgetFormInput(),
      'ca_website'            => new sfWidgetFormInput(),
      'ca_actividad'          => new sfWidgetFormInput(),
      'ca_sectoreco'          => new sfWidgetFormInput(),
      'ca_fchcreado'          => new sfWidgetFormDateTime(),
      'ca_usucreado'          => new sfWidgetFormInput(),
      'ca_fchactualizado'     => new sfWidgetFormDateTime(),
      'ca_usuactualizado'     => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_id'                 => new sfValidatorPropelChoice(array('model' => 'Ids', 'column' => 'ca_id', 'required' => false)),
      'ca_dv'                 => new sfValidatorInteger(array('required' => false)),
      'ca_idalterno'          => new sfValidatorString(array('required' => false)),
      'ca_tipoidentificacion' => new sfValidatorString(array('required' => false)),
      'ca_idgrupo'            => new sfValidatorInteger(array('required' => false)),
      'ca_nombre'             => new sfValidatorString(array('required' => false)),
      'ca_website'            => new sfValidatorString(array('required' => false)),
      'ca_actividad'          => new sfValidatorString(array('required' => false)),
      'ca_sectoreco'          => new sfValidatorString(array('required' => false)),
      'ca_fchcreado'          => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'          => new sfValidatorString(array('required' => false)),
      'ca_fchactualizado'     => new sfValidatorDateTime(array('required' => false)),
      'ca_usuactualizado'     => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ids[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Ids';
  }


}
