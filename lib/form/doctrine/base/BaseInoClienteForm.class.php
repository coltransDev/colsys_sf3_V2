<?php

/**
 * InoCliente form base class.
 *
 * @method InoCliente getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseInoClienteForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idinocliente'     => new sfWidgetFormInputHidden(),
      'ca_idmaestra'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('InoMaestra'), 'add_empty' => false)),
      'ca_idcliente'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ids'), 'add_empty' => false)),
      'ca_doctransporte'    => new sfWidgetFormTextarea(),
      'ca_fchdoctransporte' => new sfWidgetFormDate(),
      'ca_idreporte'        => new sfWidgetFormInputText(),
      'ca_idproveedor'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Proveedor'), 'add_empty' => false)),
      'ca_proveedor'        => new sfWidgetFormTextarea(),
      'ca_numpiezas'        => new sfWidgetFormInputText(),
      'ca_peso'             => new sfWidgetFormInputText(),
      'ca_volumen'          => new sfWidgetFormInputText(),
      'ca_numorden'         => new sfWidgetFormTextarea(),
      'ca_vendedor'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Vendedor'), 'add_empty' => false)),
      'ca_idsubtrayecto'    => new sfWidgetFormInputText(),
      'ca_idbodega'         => new sfWidgetFormInputText(),
      'ca_observaciones'    => new sfWidgetFormTextarea(),
      'ca_fchcreado'        => new sfWidgetFormDateTime(),
      'ca_usucreado'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UsuCreado'), 'add_empty' => true)),
      'ca_fchactualizado'   => new sfWidgetFormDateTime(),
      'ca_usuactualizado'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UsuActualizado'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'ca_idinocliente'     => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idinocliente', 'required' => false)),
      'ca_idmaestra'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('InoMaestra'))),
      'ca_idcliente'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Ids'))),
      'ca_doctransporte'    => new sfValidatorString(),
      'ca_fchdoctransporte' => new sfValidatorDate(),
      'ca_idreporte'        => new sfValidatorInteger(),
      'ca_idproveedor'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Proveedor'))),
      'ca_proveedor'        => new sfValidatorString(array('required' => false)),
      'ca_numpiezas'        => new sfValidatorNumber(),
      'ca_peso'             => new sfValidatorNumber(),
      'ca_volumen'          => new sfValidatorNumber(),
      'ca_numorden'         => new sfValidatorString(),
      'ca_vendedor'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Vendedor'))),
      'ca_idsubtrayecto'    => new sfValidatorInteger(array('required' => false)),
      'ca_idbodega'         => new sfValidatorInteger(array('required' => false)),
      'ca_observaciones'    => new sfValidatorString(array('required' => false)),
      'ca_fchcreado'        => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UsuCreado'), 'required' => false)),
      'ca_fchactualizado'   => new sfValidatorDateTime(array('required' => false)),
      'ca_usuactualizado'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UsuActualizado'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ino_cliente[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'InoCliente';
  }

}
