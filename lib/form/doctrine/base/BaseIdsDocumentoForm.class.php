<?php

/**
 * IdsDocumento form base class.
 *
 * @method IdsDocumento getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseIdsDocumentoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_iddocumento'    => new sfWidgetFormInputHidden(),
      'ca_id'             => new sfWidgetFormDoctrineChoice(array('model' => 'Ids', 'add_empty' => true)),
      'ca_idtipo'         => new sfWidgetFormDoctrineChoice(array('model' => 'IdsTipoDocumento', 'add_empty' => true)),
      'ca_ubicacion'      => new sfWidgetFormInputText(),
      'ca_observaciones'  => new sfWidgetFormInputText(),
      'ca_fchinicio'      => new sfWidgetFormDate(),
      'ca_fchvencimiento' => new sfWidgetFormDate(),
      'ca_usucreado'      => new sfWidgetFormInputText(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'ca_iddocumento'    => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_iddocumento', 'required' => false)),
      'ca_id'             => new sfValidatorDoctrineChoice(array('model' => 'Ids', 'required' => false)),
      'ca_idtipo'         => new sfValidatorDoctrineChoice(array('model' => 'IdsTipoDocumento', 'required' => false)),
      'ca_ubicacion'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'ca_observaciones'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'ca_fchinicio'      => new sfValidatorDate(array('required' => false)),
      'ca_fchvencimiento' => new sfValidatorDate(array('required' => false)),
      'ca_usucreado'      => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ids_documento[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'IdsDocumento';
  }

}
