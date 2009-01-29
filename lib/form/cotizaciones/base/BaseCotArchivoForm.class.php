<?php

/**
 * CotArchivo form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseCotArchivoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idarchivo'    => new sfWidgetFormInputHidden(),
      'ca_idcotizacion' => new sfWidgetFormPropelChoice(array('model' => 'Cotizacion', 'add_empty' => false)),
      'ca_nombre'       => new sfWidgetFormInput(),
      'ca_tamano'       => new sfWidgetFormInput(),
      'ca_tipo'         => new sfWidgetFormInput(),
      'ca_fchcreado'    => new sfWidgetFormDateTime(),
      'ca_usucreado'    => new sfWidgetFormInput(),
      'ca_datos'        => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idarchivo'    => new sfValidatorPropelChoice(array('model' => 'CotArchivo', 'column' => 'ca_idarchivo', 'required' => false)),
      'ca_idcotizacion' => new sfValidatorPropelChoice(array('model' => 'Cotizacion', 'column' => 'ca_idcotizacion')),
      'ca_nombre'       => new sfValidatorString(),
      'ca_tamano'       => new sfValidatorNumber(array('required' => false)),
      'ca_tipo'         => new sfValidatorString(array('required' => false)),
      'ca_fchcreado'    => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'    => new sfValidatorString(array('required' => false)),
      'ca_datos'        => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cot_archivo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'CotArchivo';
  }


}
