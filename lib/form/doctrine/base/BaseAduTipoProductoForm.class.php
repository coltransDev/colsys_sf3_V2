<?php

/**
 * AduTipoProducto form base class.
 *
 * @method AduTipoProducto getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseAduTipoProductoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_consecutivo'     => new sfWidgetFormInputHidden(),
      'ca_idmaestra'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('InoMaestra'), 'add_empty' => false)),
      'ca_id_tipoproducto' => new sfWidgetFormInputText(),
      'ca_fchcreado'       => new sfWidgetFormDateTime(),
      'ca_usucreado'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UsuCreado'), 'add_empty' => true)),
      'ca_fchactualizado'  => new sfWidgetFormDateTime(),
      'ca_usuactualizado'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UsuActualizado'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'ca_consecutivo'     => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_consecutivo', 'required' => false)),
      'ca_idmaestra'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('InoMaestra'))),
      'ca_id_tipoproducto' => new sfValidatorPass(),
      'ca_fchcreado'       => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UsuCreado'), 'required' => false)),
      'ca_fchactualizado'  => new sfValidatorDateTime(array('required' => false)),
      'ca_usuactualizado'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UsuActualizado'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('adu_tipo_producto[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AduTipoProducto';
  }

}
