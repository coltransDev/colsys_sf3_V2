<?php

/**
 * Trayecto form base class.
 *
 * @package    form
 * @subpackage trayecto
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseTrayectoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'oid'                         => new sfWidgetFormInput(),
      'ca_idtrayecto'               => new sfWidgetFormInputHidden(),
      'ca_origen'                   => new sfWidgetFormInput(),
      'ca_destino'                  => new sfWidgetFormInput(),
      'ca_idlinea'                  => new sfWidgetFormPropelSelect(array('model' => 'Transportador', 'add_empty' => false)),
      'ca_transporte'               => new sfWidgetFormInput(),
      'ca_terminal'                 => new sfWidgetFormInput(),
      'ca_impoexpo'                 => new sfWidgetFormInput(),
      'ca_frecuencia'               => new sfWidgetFormInput(),
      'ca_tiempotransito'           => new sfWidgetFormInput(),
      'ca_modalidad'                => new sfWidgetFormInput(),
      'ca_fchcreado'                => new sfWidgetFormDate(),
      'ca_idtarifas'                => new sfWidgetFormInput(),
      'ca_observaciones'            => new sfWidgetFormInput(),
      'ca_idagente'                 => new sfWidgetFormPropelSelect(array('model' => 'Agente', 'add_empty' => true)),
      'ca_idmoneda'                 => new sfWidgetFormInput(),
      'ca_fchinicio'                => new sfWidgetFormDate(),
      'ca_fchvencimiento'           => new sfWidgetFormDate(),
      'ca_aplicacion'               => new sfWidgetFormInput(),
      'flete_list'                  => new sfWidgetFormPropelSelectMany(array('model' => 'Concepto')),
      'pric_flete_list'             => new sfWidgetFormPropelSelectMany(array('model' => 'Concepto')),
      'pric_recargox_concepto_list' => new sfWidgetFormPropelSelectMany(array('model' => 'Concepto')),
    ));

    $this->setValidators(array(
      'oid'                         => new sfValidatorInteger(),
      'ca_idtrayecto'               => new sfValidatorPropelChoice(array('model' => 'Trayecto', 'column' => 'ca_idtrayecto', 'required' => false)),
      'ca_origen'                   => new sfValidatorString(array('max_length' => 8)),
      'ca_destino'                  => new sfValidatorString(array('max_length' => 8)),
      'ca_idlinea'                  => new sfValidatorPropelChoice(array('model' => 'Transportador', 'column' => 'ca_idlinea')),
      'ca_transporte'               => new sfValidatorString(),
      'ca_terminal'                 => new sfValidatorString(array('required' => false)),
      'ca_impoexpo'                 => new sfValidatorString(array('required' => false)),
      'ca_frecuencia'               => new sfValidatorString(array('required' => false)),
      'ca_tiempotransito'           => new sfValidatorString(array('required' => false)),
      'ca_modalidad'                => new sfValidatorString(array('required' => false)),
      'ca_fchcreado'                => new sfValidatorDate(array('required' => false)),
      'ca_idtarifas'                => new sfValidatorInteger(array('required' => false)),
      'ca_observaciones'            => new sfValidatorString(array('required' => false)),
      'ca_idagente'                 => new sfValidatorPropelChoice(array('model' => 'Agente', 'column' => 'ca_idagente', 'required' => false)),
      'ca_idmoneda'                 => new sfValidatorString(array('max_length' => 3, 'required' => false)),
      'ca_fchinicio'                => new sfValidatorDate(array('required' => false)),
      'ca_fchvencimiento'           => new sfValidatorDate(array('required' => false)),
      'ca_aplicacion'               => new sfValidatorString(array('required' => false)),
      'flete_list'                  => new sfValidatorPropelChoiceMany(array('model' => 'Concepto', 'required' => false)),
      'pric_flete_list'             => new sfValidatorPropelChoiceMany(array('model' => 'Concepto', 'required' => false)),
      'pric_recargox_concepto_list' => new sfValidatorPropelChoiceMany(array('model' => 'Concepto', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('trayecto[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Trayecto';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['flete_list']))
    {
      $values = array();
      foreach ($this->object->getFletes() as $obj)
      {
        $values[] = $obj->getCaIdconcepto();
      }

      $this->setDefault('flete_list', $values);
    }

    if (isset($this->widgetSchema['pric_flete_list']))
    {
      $values = array();
      foreach ($this->object->getPricFletes() as $obj)
      {
        $values[] = $obj->getCaIdconcepto();
      }

      $this->setDefault('pric_flete_list', $values);
    }

    if (isset($this->widgetSchema['pric_recargox_concepto_list']))
    {
      $values = array();
      foreach ($this->object->getPricRecargoxConceptos() as $obj)
      {
        $values[] = $obj->getCaIdconcepto();
      }

      $this->setDefault('pric_recargox_concepto_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveFleteList($con);
    $this->savePricFleteList($con);
    $this->savePricRecargoxConceptoList($con);
  }

  public function saveFleteList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['flete_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(FletePeer::CA_IDTRAYECTO, $this->object->getPrimaryKey());
    FletePeer::doDelete($c, $con);

    $values = $this->getValue('flete_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new Flete();
        $obj->setCaIdtrayecto($this->object->getPrimaryKey());
        $obj->setCaIdconcepto($value);
        $obj->save();
      }
    }
  }

  public function savePricFleteList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['pric_flete_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(PricFletePeer::CA_IDTRAYECTO, $this->object->getPrimaryKey());
    PricFletePeer::doDelete($c, $con);

    $values = $this->getValue('pric_flete_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new PricFlete();
        $obj->setCaIdtrayecto($this->object->getPrimaryKey());
        $obj->setCaIdconcepto($value);
        $obj->save();
      }
    }
  }

  public function savePricRecargoxConceptoList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['pric_recargox_concepto_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(PricRecargoxConceptoPeer::CA_IDTRAYECTO, $this->object->getPrimaryKey());
    PricRecargoxConceptoPeer::doDelete($c, $con);

    $values = $this->getValue('pric_recargox_concepto_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new PricRecargoxConcepto();
        $obj->setCaIdtrayecto($this->object->getPrimaryKey());
        $obj->setCaIdconcepto($value);
        $obj->save();
      }
    }
  }

}
