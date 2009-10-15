<?php

/**
 * PricArchivo form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BasePricArchivoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idarchivo'   => new sfWidgetFormInputHidden(),
      'ca_idtrafico'   => new sfWidgetFormPropelChoice(array('model' => 'Trafico', 'add_empty' => false)),
      'ca_nombre'      => new sfWidgetFormInput(),
      'ca_descripcion' => new sfWidgetFormInput(),
      'ca_tamano'      => new sfWidgetFormInput(),
      'ca_tipo'        => new sfWidgetFormInput(),
      'ca_fchcreado'   => new sfWidgetFormDateTime(),
      'ca_usucreado'   => new sfWidgetFormInput(),
      'ca_datos'       => new sfWidgetFormInput(),
      'ca_impoexpo'    => new sfWidgetFormInput(),
      'ca_transporte'  => new sfWidgetFormInput(),
      'ca_modalidad'   => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idarchivo'   => new sfValidatorPropelChoice(array('model' => 'PricArchivo', 'column' => 'ca_idarchivo', 'required' => false)),
      'ca_idtrafico'   => new sfValidatorPropelChoice(array('model' => 'Trafico', 'column' => 'ca_idtrafico')),
      'ca_nombre'      => new sfValidatorString(),
      'ca_descripcion' => new sfValidatorString(),
      'ca_tamano'      => new sfValidatorNumber(array('required' => false)),
      'ca_tipo'        => new sfValidatorString(array('required' => false)),
      'ca_fchcreado'   => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'   => new sfValidatorString(array('required' => false)),
      'ca_datos'       => new sfValidatorPass(array('required' => false)),
      'ca_impoexpo'    => new sfValidatorString(array('required' => false)),
      'ca_transporte'  => new sfValidatorString(array('required' => false)),
      'ca_modalidad'   => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('pric_archivo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PricArchivo';
  }


}
