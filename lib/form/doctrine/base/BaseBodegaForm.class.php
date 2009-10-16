<?php

/**
 * Bodega form base class.
 *
 * @package    form
 * @subpackage bodega
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseBodegaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idbodega'   => new sfWidgetFormInputHidden(),
      'ca_nombre'     => new sfWidgetFormInput(),
      'ca_tipo'       => new sfWidgetFormInput(),
      'ca_transporte' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idbodega'   => new sfValidatorDoctrineChoice(array('model' => 'Bodega', 'column' => 'ca_idbodega', 'required' => false)),
      'ca_nombre'     => new sfValidatorString(array('required' => false)),
      'ca_tipo'       => new sfValidatorString(array('required' => false)),
      'ca_transporte' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('bodega[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Bodega';
  }

}