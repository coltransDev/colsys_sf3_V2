<?php

/**
 * NotListaTareas form base class.
 *
 * @package    form
 * @subpackage not_lista_tareas
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseNotListaTareasForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idlistatarea' => new sfWidgetFormInputHidden(),
      'ca_nombre'       => new sfWidgetFormInput(),
      'ca_descripcion'  => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idlistatarea' => new sfValidatorDoctrineChoice(array('model' => 'NotListaTareas', 'column' => 'ca_idlistatarea', 'required' => false)),
      'ca_nombre'       => new sfValidatorString(array('required' => false)),
      'ca_descripcion'  => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('not_lista_tareas[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'NotListaTareas';
  }

}