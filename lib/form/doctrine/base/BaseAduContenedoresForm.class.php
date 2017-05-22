<?php

/**
 * AduContenedores form base class.
 *
 * @method AduContenedores getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseAduContenedoresForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_consecutivo'    => new sfWidgetFormInputHidden(),
      'ca_idmaestra'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('InoMaestra'), 'add_empty' => false)),
      'ca_idproveedor'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('IdsProveedor'), 'add_empty' => false)),
      'ca_id_contenedor'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Equipo'), 'add_empty' => false)),
      'ca_no_contenedor'  => new sfWidgetFormTextarea(),
      'ca_cantidad'       => new sfWidgetFormInputText(),
      'ca_observaciones'  => new sfWidgetFormTextarea(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usucreado'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UsuCreado'), 'add_empty' => true)),
      'ca_fchactualizado' => new sfWidgetFormDateTime(),
      'ca_usuactualizado' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UsuActualizado'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'ca_consecutivo'    => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_consecutivo', 'required' => false)),
      'ca_idmaestra'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('InoMaestra'))),
      'ca_idproveedor'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('IdsProveedor'))),
      'ca_id_contenedor'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Equipo'))),
      'ca_no_contenedor'  => new sfValidatorString(array('required' => false)),
      'ca_cantidad'       => new sfValidatorInteger(array('required' => false)),
      'ca_observaciones'  => new sfValidatorString(array('required' => false)),
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UsuCreado'), 'required' => false)),
      'ca_fchactualizado' => new sfValidatorDateTime(array('required' => false)),
      'ca_usuactualizado' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UsuActualizado'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('adu_contenedores[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AduContenedores';
  }

}
