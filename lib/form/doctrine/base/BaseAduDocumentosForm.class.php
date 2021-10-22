<?php

/**
 * AduDocumentos form base class.
 *
 * @method AduDocumentos getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseAduDocumentosForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_consecutivo'    => new sfWidgetFormInputHidden(),
      'ca_idmaestra'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('InoMaestra'), 'add_empty' => false)),
      'ca_documento'      => new sfWidgetFormTextarea(),
      'ca_fecha'          => new sfWidgetFormDate(),
      'ca_numero'         => new sfWidgetFormTextarea(),
      'ca_observaciones'  => new sfWidgetFormTextarea(),
      'ca_fecha_recibido' => new sfWidgetFormDate(),
      'ca_hora_recibido'  => new sfWidgetFormTime(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usucreado'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UsuCreado'), 'add_empty' => true)),
      'ca_fchactualizado' => new sfWidgetFormDateTime(),
      'ca_usuactualizado' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UsuActualizado'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'ca_consecutivo'    => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_consecutivo', 'required' => false)),
      'ca_idmaestra'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('InoMaestra'))),
      'ca_documento'      => new sfValidatorString(),
      'ca_fecha'          => new sfValidatorDate(array('required' => false)),
      'ca_numero'         => new sfValidatorString(array('required' => false)),
      'ca_observaciones'  => new sfValidatorString(array('required' => false)),
      'ca_fecha_recibido' => new sfValidatorDate(array('required' => false)),
      'ca_hora_recibido'  => new sfValidatorTime(array('required' => false)),
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UsuCreado'), 'required' => false)),
      'ca_fchactualizado' => new sfValidatorDateTime(array('required' => false)),
      'ca_usuactualizado' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UsuActualizado'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('adu_documentos[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AduDocumentos';
  }

}
