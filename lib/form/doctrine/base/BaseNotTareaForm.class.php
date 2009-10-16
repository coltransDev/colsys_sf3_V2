<?php

/**
 * NotTarea form base class.
 *
 * @package    form
 * @subpackage not_tarea
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseNotTareaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idtarea'        => new sfWidgetFormInputHidden(),
      'ca_idlistatarea'   => new sfWidgetFormDoctrineSelect(array('model' => 'NotListaTareas', 'add_empty' => true)),
      'ca_url'            => new sfWidgetFormInput(),
      'ca_titulo'         => new sfWidgetFormInput(),
      'ca_texto'          => new sfWidgetFormInput(),
      'ca_fchvisible'     => new sfWidgetFormDateTime(),
      'ca_fchvencimiento' => new sfWidgetFormDateTime(),
      'ca_fchterminada'   => new sfWidgetFormDateTime(),
      'ca_usuterminada'   => new sfWidgetFormInput(),
      'ca_prioridad'      => new sfWidgetFormInput(),
      'ca_notificar'      => new sfWidgetFormInput(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usucreado'      => new sfWidgetFormInput(),
      'ca_observaciones'  => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idtarea'        => new sfValidatorDoctrineChoice(array('model' => 'NotTarea', 'column' => 'ca_idtarea', 'required' => false)),
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

    parent::setup();
  }

  public function getModelName()
  {
    return 'NotTarea';
  }

}