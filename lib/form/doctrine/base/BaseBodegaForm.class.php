<?php

/**
 * Bodega form base class.
 *
 * @method Bodega getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseBodegaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idbodega'   => new sfWidgetFormInputHidden(),
      'ca_nombre'     => new sfWidgetFormTextarea(),
      'ca_tipo'       => new sfWidgetFormTextarea(),
      'ca_transporte' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'ca_idbodega'   => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idbodega', 'required' => false)),
      'ca_nombre'     => new sfValidatorString(array('required' => false)),
      'ca_tipo'       => new sfValidatorString(array('required' => false)),
      'ca_transporte' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('bodega[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Bodega';
  }

}
