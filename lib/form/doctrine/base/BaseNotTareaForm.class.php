<?php

/**
 * NotTarea form base class.
 *
 * @method NotTarea getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseNotTareaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idtarea'        => new sfWidgetFormInputHidden(),
      'ca_idlistatarea'   => new sfWidgetFormDoctrineChoice(array('model' => 'NotListaTareas', 'add_empty' => true)),
      'ca_url'            => new sfWidgetFormTextarea(),
      'ca_titulo'         => new sfWidgetFormTextarea(),
      'ca_texto'          => new sfWidgetFormTextarea(),
      'ca_fchvisible'     => new sfWidgetFormDateTime(),
      'ca_fchvencimiento' => new sfWidgetFormDateTime(),
      'ca_fchterminada'   => new sfWidgetFormDateTime(),
      'ca_usuterminada'   => new sfWidgetFormTextarea(),
      'ca_prioridad'      => new sfWidgetFormInputText(),
      'ca_notificar'      => new sfWidgetFormTextarea(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usucreado'      => new sfWidgetFormTextarea(),
      'ca_observaciones'  => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'ca_idtarea'        => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idtarea', 'required' => false)),
      'ca_idlistatarea'   => new sfValidatorDoctrineChoice(array('model' => 'NotListaTareas', 'required' => false)),
      'ca_url'            => new sfValidatorString(array('required' => false)),
      'ca_titulo'         => new sfValidatorString(array('required' => false)),
      'ca_texto'          => new sfValidatorString(array('required' => false)),
      'ca_fchvisible'     => new sfValidatorDateTime(array('required' => false)),
      'ca_fchvencimiento' => new sfValidatorDateTime(array('required' => false)),
      'ca_fchterminada'   => new sfValidatorDateTime(array('required' => false)),
      'ca_usuterminada'   => new sfValidatorString(array('required' => false)),
      'ca_prioridad'      => new sfValidatorInteger(array('required' => false)),
      'ca_notificar'      => new sfValidatorString(array('required' => false)),
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'      => new sfValidatorString(array('required' => false)),
      'ca_observaciones'  => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('not_tarea[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'NotTarea';
  }

}
