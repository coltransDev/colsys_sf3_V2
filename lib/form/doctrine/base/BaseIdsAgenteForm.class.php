<?php

/**
 * IdsAgente form base class.
 *
 * @method IdsAgente getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseIdsAgenteForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idagente' => new sfWidgetFormInputHidden(),
      'ca_tipo'     => new sfWidgetFormDoctrineChoice(array('model' => 'IdsTipo', 'add_empty' => true)),
      'ca_activo'   => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'ca_idagente' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idagente', 'required' => false)),
      'ca_tipo'     => new sfValidatorDoctrineChoice(array('model' => 'IdsTipo', 'required' => false)),
      'ca_activo'   => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ids_agente[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'IdsAgente';
  }

}
