<?php

/**
 * InoHouse form base class.
 *
 * @method InoHouse getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseInoHouseForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idhouse'          => new sfWidgetFormInputHidden(),
      'ca_idmaster'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('InoMaster'), 'add_empty' => false)),
      'ca_idcliente'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'), 'add_empty' => false)),
      'ca_doctransporte'    => new sfWidgetFormTextarea(),
      'ca_fchdoctransporte' => new sfWidgetFormDate(),
      'ca_idreporte'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Reporte'), 'add_empty' => false)),
      'ca_idtercero'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tercero'), 'add_empty' => false)),
      'ca_tercero'          => new sfWidgetFormTextarea(),
      'ca_producto'         => new sfWidgetFormTextarea(),
      'ca_numpiezas'        => new sfWidgetFormInputText(),
      'ca_peso'             => new sfWidgetFormInputText(),
      'ca_volumen'          => new sfWidgetFormInputText(),
      'ca_numorden'         => new sfWidgetFormTextarea(),
      'ca_vendedor'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Vendedor'), 'add_empty' => false)),
      'ca_idbodega'         => new sfWidgetFormInputText(),
      'ca_observaciones'    => new sfWidgetFormTextarea(),
      'ca_fchcreado'        => new sfWidgetFormDateTime(),
      'ca_usucreado'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UsuCreado'), 'add_empty' => true)),
      'ca_fchactualizado'   => new sfWidgetFormDateTime(),
      'ca_usuactualizado'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UsuActualizado'), 'add_empty' => true)),
      'ca_mpiezas'          => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'ca_idhouse'          => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idhouse', 'required' => false)),
      'ca_idmaster'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('InoMaster'))),
      'ca_idcliente'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Cliente'))),
      'ca_doctransporte'    => new sfValidatorString(),
      'ca_fchdoctransporte' => new sfValidatorDate(),
      'ca_idreporte'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Reporte'))),
      'ca_idtercero'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tercero'))),
      'ca_tercero'          => new sfValidatorString(array('required' => false)),
      'ca_producto'         => new sfValidatorString(array('required' => false)),
      'ca_numpiezas'        => new sfValidatorNumber(),
      'ca_peso'             => new sfValidatorNumber(),
      'ca_volumen'          => new sfValidatorNumber(),
      'ca_numorden'         => new sfValidatorString(),
      'ca_vendedor'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Vendedor'))),
      'ca_idbodega'         => new sfValidatorInteger(array('required' => false)),
      'ca_observaciones'    => new sfValidatorString(array('required' => false)),
      'ca_fchcreado'        => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UsuCreado'), 'required' => false)),
      'ca_fchactualizado'   => new sfValidatorDateTime(array('required' => false)),
      'ca_usuactualizado'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UsuActualizado'), 'required' => false)),
      'ca_mpiezas'          => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ino_house[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'InoHouse';
  }

}
