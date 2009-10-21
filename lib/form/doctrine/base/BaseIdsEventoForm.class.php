<?php

/**
 * IdsEvento form base class.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseIdsEventoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idevento'   => new sfWidgetFormInputHidden(),
      'ca_id'         => new sfWidgetFormDoctrineChoice(array('model' => 'Ids', 'add_empty' => true)),
      'ca_evento'     => new sfWidgetFormTextarea(),
      'ca_referencia' => new sfWidgetFormInputText(),
      'ca_idcriterio' => new sfWidgetFormDoctrineChoice(array('model' => 'IdsCriterio', 'add_empty' => true)),
      'ca_usucreado'  => new sfWidgetFormInputText(),
      'ca_fchcreado'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'ca_idevento'   => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idevento', 'required' => false)),
      'ca_id'         => new sfValidatorDoctrineChoice(array('model' => 'Ids', 'required' => false)),
      'ca_evento'     => new sfValidatorString(array('required' => false)),
      'ca_referencia' => new sfValidatorString(array('max_length' => 16, 'required' => false)),
      'ca_idcriterio' => new sfValidatorDoctrineChoice(array('model' => 'IdsCriterio', 'required' => false)),
      'ca_usucreado'  => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'ca_fchcreado'  => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ids_evento[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'IdsEvento';
  }

}
