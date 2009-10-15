<?php

/**
 * Concepto form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseConceptoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idconcepto'             => new sfWidgetFormInputHidden(),
      'ca_concepto'               => new sfWidgetFormInput(),
      'ca_unidad'                 => new sfWidgetFormInput(),
      'ca_transporte'             => new sfWidgetFormInput(),
      'ca_modalidad'              => new sfWidgetFormInput(),
      'ca_liminferior'            => new sfWidgetFormInput(),
      'rep_equipo_list'           => new sfWidgetFormPropelChoiceMany(array('model' => 'Reporte')),
      'pric_recargosx_linea_list' => new sfWidgetFormPropelChoiceMany(array('model' => 'Transportador')),
      'flete_list'                => new sfWidgetFormPropelChoiceMany(array('model' => 'Trayecto')),
      'pric_flete_list'           => new sfWidgetFormPropelChoiceMany(array('model' => 'Trayecto')),
    ));

    $this->setValidators(array(
      'ca_idconcepto'             => new sfValidatorPropelChoice(array('model' => 'Concepto', 'column' => 'ca_idconcepto', 'required' => false)),
      'ca_concepto'               => new sfValidatorString(),
      'ca_unidad'                 => new sfValidatorString(),
      'ca_transporte'             => new sfValidatorString(),
      'ca_modalidad'              => new sfValidatorString(),
      'ca_liminferior'            => new sfValidatorInteger(array('required' => false)),
      'rep_equipo_list'           => new sfValidatorPropelChoiceMany(array('model' => 'Reporte', 'required' => false)),
      'pric_recargosx_linea_list' => new sfValidatorPropelChoiceMany(array('model' => 'Transportador', 'required' => false)),
      'flete_list'                => new sfValidatorPropelChoiceMany(array('model' => 'Trayecto', 'required' => false)),
      'pric_flete_list'           => new sfValidatorPropelChoiceMany(array('model' => 'Trayecto', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('concepto[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Concepto';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['rep_equipo_list']))
    {
      $values = array();
      foreach ($this->object->getRepEquipos() as $obj)
      {
        $values[] = $obj->getCaIdreporte();
      }

      $this->setDefault('rep_equipo_list', $values);
    }

    if (isset($this->widgetSchema['pric_recargosx_linea_list']))
    {
      $values = array();
      foreach ($this->object->getPricRecargosxLineas() as $obj)
      {
        $values[] = $obj->getCaIdlinea();
      }

      $this->setDefault('pric_recargosx_linea_list', $values);
    }

    if (isset($this->widgetSchema['flete_list']))
    {
      $values = array();
      foreach ($this->object->getFletes() as $obj)
      {
        $values[] = $obj->getCaIdtrayecto();
      }

      $this->setDefault('flete_list', $values);
    }

    if (isset($this->widgetSchema['pric_flete_list']))
    {
      $values = array();
      foreach ($this->object->getPricFletes() as $obj)
      {
        $values[] = $obj->getCaIdtrayecto();
      }

      $this->setDefault('pric_flete_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveRepEquipoList($con);
    $this->savePricRecargosxLineaList($con);
    $this->saveFleteList($con);
    $this->savePricFleteList($con);
  }

  public function saveRepEquipoList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['rep_equipo_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(RepEquipoPeer::CA_IDCONCEPTO, $this->object->getPrimaryKey());
    RepEquipoPeer::doDelete($c, $con);

    $values = $this->getValue('rep_equipo_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new RepEquipo();
        $obj->setCaIdconcepto($this->object->getPrimaryKey());
        $obj->setCaIdreporte($value);
        $obj->save();
      }
    }
  }

  public function savePricRecargosxLineaList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['pric_recargosx_linea_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(PricRecargosxLineaPeer::CA_IDCONCEPTO, $this->object->getPrimaryKey());
    PricRecargosxLineaPeer::doDelete($c, $con);

    $values = $this->getValue('pric_recargosx_linea_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new PricRecargosxLinea();
        $obj->setCaIdconcepto($this->object->getPrimaryKey());
        $obj->setCaIdlinea($value);
        $obj->save();
      }
    }
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
    $c->add(FletePeer::CA_IDCONCEPTO, $this->object->getPrimaryKey());
    FletePeer::doDelete($c, $con);

    $values = $this->getValue('flete_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new Flete();
        $obj->setCaIdconcepto($this->object->getPrimaryKey());
        $obj->setCaIdtrayecto($value);
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
    $c->add(PricFletePeer::CA_IDCONCEPTO, $this->object->getPrimaryKey());
    PricFletePeer::doDelete($c, $con);

    $values = $this->getValue('pric_flete_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new PricFlete();
        $obj->setCaIdconcepto($this->object->getPrimaryKey());
        $obj->setCaIdtrayecto($value);
        $obj->save();
      }
    }
  }

}
