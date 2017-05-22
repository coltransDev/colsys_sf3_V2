<?php

/**
 * Servicio form base class.
 *
 * @method Servicio getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseServicioForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_id'     => new sfWidgetFormInputHidden(),
      'ca_nombre' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'ca_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_id', 'required' => false)),
      'ca_nombre' => new sfValidatorString(array('max_length' => 45, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('servicio[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Servicio';
  }

}
