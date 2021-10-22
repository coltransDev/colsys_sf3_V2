<?php

/**
 * RepAntecedentes form base class.
 *
 * @method RepAntecedentes getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseRepAntecedentesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idantecedente'  => new sfWidgetFormInputHidden(),
      'ca_idreporte'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Reporte'), 'add_empty' => true)),
      'ca_estado'         => new sfWidgetFormTextarea(),
      'ca_login'          => new sfWidgetFormTextarea(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usucreado'      => new sfWidgetFormTextarea(),
      'ca_fchactualizado' => new sfWidgetFormDateTime(),
      'ca_usuactualizado' => new sfWidgetFormTextarea(),
      'ca_fchaceptado'    => new sfWidgetFormDateTime(),
      'ca_usuaceptado'    => new sfWidgetFormTextarea(),
      'ca_responder'      => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'ca_idantecedente'  => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idantecedente', 'required' => false)),
      'ca_idreporte'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Reporte'), 'required' => false)),
      'ca_estado'         => new sfValidatorString(array('required' => false)),
      'ca_login'          => new sfValidatorString(array('required' => false)),
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'      => new sfValidatorString(array('required' => false)),
      'ca_fchactualizado' => new sfValidatorDateTime(array('required' => false)),
      'ca_usuactualizado' => new sfValidatorString(array('required' => false)),
      'ca_fchaceptado'    => new sfValidatorDateTime(array('required' => false)),
      'ca_usuaceptado'    => new sfValidatorString(array('required' => false)),
      'ca_responder'      => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rep_antecedentes[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RepAntecedentes';
  }

}
