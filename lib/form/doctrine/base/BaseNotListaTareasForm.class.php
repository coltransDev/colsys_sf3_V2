<?php

/**
 * NotListaTareas form base class.
 *
 * @method NotListaTareas getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseNotListaTareasForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idlistatarea' => new sfWidgetFormInputHidden(),
      'ca_nombre'       => new sfWidgetFormTextarea(),
      'ca_descripcion'  => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'ca_idlistatarea' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idlistatarea', 'required' => false)),
      'ca_nombre'       => new sfValidatorString(array('required' => false)),
      'ca_descripcion'  => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('not_lista_tareas[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'NotListaTareas';
  }

}
