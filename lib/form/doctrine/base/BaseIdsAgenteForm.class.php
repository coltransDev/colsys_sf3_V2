<?php

/**
 * IdsAgente form base class.
 *
 * @package    form
 * @subpackage ids_agente
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseIdsAgenteForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idagente' => new sfWidgetFormInputHidden(),
      'ca_tipo'     => new sfWidgetFormDoctrineSelect(array('model' => 'IdsTipo', 'add_empty' => true)),
      'ca_activo'   => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'ca_idagente' => new sfValidatorDoctrineChoice(array('model' => 'IdsAgente', 'column' => 'ca_idagente', 'required' => false)),
      'ca_tipo'     => new sfValidatorDoctrineChoice(array('model' => 'IdsTipo', 'required' => false)),
      'ca_activo'   => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ids_agente[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'IdsAgente';
  }

}