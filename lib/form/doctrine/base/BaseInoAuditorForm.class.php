<?php

/**
 * InoAuditor form base class.
 *
 * @method InoAuditor getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseInoAuditorForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idevento'      => new sfWidgetFormInputHidden(),
      'ca_idmaster'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('InoMaster'), 'add_empty' => true)),
      'ca_tipo'          => new sfWidgetFormTextarea(),
      'ca_asunto'        => new sfWidgetFormTextarea(),
      'ca_detalle'       => new sfWidgetFormTextarea(),
      'ca_compromisos'   => new sfWidgetFormTextarea(),
      'ca_respuesta'     => new sfWidgetFormTextarea(),
      'ca_fchcompromiso' => new sfWidgetFormDate(),
      'ca_idantecedente' => new sfWidgetFormInputText(),
      'ca_estado'        => new sfWidgetFormInputText(),
      'ca_fchcreado'     => new sfWidgetFormDateTime(),
      'ca_usucreado'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UsuCreado'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'ca_idevento'      => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idevento', 'required' => false)),
      'ca_idmaster'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('InoMaster'), 'required' => false)),
      'ca_tipo'          => new sfValidatorString(array('required' => false)),
      'ca_asunto'        => new sfValidatorString(array('required' => false)),
      'ca_detalle'       => new sfValidatorString(array('required' => false)),
      'ca_compromisos'   => new sfValidatorString(array('required' => false)),
      'ca_respuesta'     => new sfValidatorString(array('required' => false)),
      'ca_fchcompromiso' => new sfValidatorDate(array('required' => false)),
      'ca_idantecedente' => new sfValidatorInteger(array('required' => false)),
      'ca_estado'        => new sfValidatorPass(array('required' => false)),
      'ca_fchcreado'     => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UsuCreado'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ino_auditor[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'InoAuditor';
  }

}
