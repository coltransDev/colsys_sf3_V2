<?php

/**
 * IdsEvento form base class.
 *
 * @package    form
 * @subpackage ids_evento
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseIdsEventoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idevento'   => new sfWidgetFormInputHidden(),
      'ca_id'         => new sfWidgetFormDoctrineSelect(array('model' => 'Ids', 'add_empty' => true)),
      'ca_evento'     => new sfWidgetFormInput(),
      'ca_referencia' => new sfWidgetFormInput(),
      'ca_idcriterio' => new sfWidgetFormDoctrineSelect(array('model' => 'IdsCriterio', 'add_empty' => true)),
      'ca_usucreado'  => new sfWidgetFormInput(),
      'ca_fchcreado'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'ca_idevento'   => new sfValidatorDoctrineChoice(array('model' => 'IdsEvento', 'column' => 'ca_idevento', 'required' => false)),
      'ca_id'         => new sfValidatorDoctrineChoice(array('model' => 'Ids', 'required' => false)),
      'ca_evento'     => new sfValidatorString(array('required' => false)),
      'ca_referencia' => new sfValidatorString(array('max_length' => 16, 'required' => false)),
      'ca_idcriterio' => new sfValidatorDoctrineChoice(array('model' => 'IdsCriterio', 'required' => false)),
      'ca_usucreado'  => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'ca_fchcreado'  => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ids_evento[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'IdsEvento';
  }

}