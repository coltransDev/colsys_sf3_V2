<?php

/**
 * NotListaTareas form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseNotListaTareasForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idlistatarea' => new sfWidgetFormInputHidden(),
      'ca_nombre'       => new sfWidgetFormInput(),
      'ca_descripcion'  => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idlistatarea' => new sfValidatorPropelChoice(array('model' => 'NotListaTareas', 'column' => 'ca_idlistatarea', 'required' => false)),
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
