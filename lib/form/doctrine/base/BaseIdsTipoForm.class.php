<?php

/**
 * IdsTipo form base class.
 *
 * @package    form
 * @subpackage ids_tipo
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseIdsTipoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_tipo'       => new sfWidgetFormInputHidden(),
      'ca_nombre'     => new sfWidgetFormInput(),
      'ca_aplicacion' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_tipo'       => new sfValidatorDoctrineChoice(array('model' => 'IdsTipo', 'column' => 'ca_tipo', 'required' => false)),
      'ca_nombre'     => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'ca_aplicacion' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ids_tipo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'IdsTipo';
  }

}