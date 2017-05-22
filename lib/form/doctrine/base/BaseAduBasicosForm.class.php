<?php

/**
 * AduBasicos form base class.
 *
 * @method AduBasicos getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseAduBasicosForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_consecutivo'    => new sfWidgetFormInputHidden(),
      'ca_idmaestra'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('InoMaestra'), 'add_empty' => false)),
      'ca_idanalista'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('IdAnalista'), 'add_empty' => true)),
      'ca_idcoordinador'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('IdCoordinador'), 'add_empty' => true)),
      'ca_observaciones'  => new sfWidgetFormTextarea(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usucreado'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UsuCreado'), 'add_empty' => true)),
      'ca_fchactualizado' => new sfWidgetFormDateTime(),
      'ca_usuactualizado' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UsuActualizado'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'ca_consecutivo'    => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_consecutivo', 'required' => false)),
      'ca_idmaestra'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('InoMaestra'))),
      'ca_idanalista'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('IdAnalista'), 'required' => false)),
      'ca_idcoordinador'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('IdCoordinador'), 'required' => false)),
      'ca_observaciones'  => new sfValidatorString(array('required' => false)),
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UsuCreado'), 'required' => false)),
      'ca_fchactualizado' => new sfValidatorDateTime(array('required' => false)),
      'ca_usuactualizado' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UsuActualizado'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('adu_basicos[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AduBasicos';
  }

}
