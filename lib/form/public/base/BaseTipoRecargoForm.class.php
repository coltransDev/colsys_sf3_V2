<?php

/**
 * TipoRecargo form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseTipoRecargoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idrecargo'                => new sfWidgetFormInputHidden(),
      'ca_recargo'                  => new sfWidgetFormInput(),
      'ca_tipo'                     => new sfWidgetFormInput(),
      'ca_transporte'               => new sfWidgetFormInput(),
      'ca_incoterms'                => new sfWidgetFormInput(),
      'ca_reporte'                  => new sfWidgetFormInput(),
      'ca_impoexpo'                 => new sfWidgetFormInput(),
      'ca_aplicacion'               => new sfWidgetFormInput(),
      'cot_recargo_list'            => new sfWidgetFormPropelChoiceMany(array('model' => 'CotOpcion')),
      'pric_recargosx_ciudad_list'  => new sfWidgetFormPropelChoiceMany(array('model' => 'Ciudad')),
      'pric_recargox_concepto_list' => new sfWidgetFormPropelChoiceMany(array('model' => 'PricFlete')),
      'pric_recargosx_linea_list'   => new sfWidgetFormPropelChoiceMany(array('model' => 'Transportador')),
      'recargo_flete_list'          => new sfWidgetFormPropelChoiceMany(array('model' => 'Flete')),
    ));

    $this->setValidators(array(
      'ca_idrecargo'                => new sfValidatorPropelChoice(array('model' => 'TipoRecargo', 'column' => 'ca_idrecargo', 'required' => false)),
      'ca_recargo'                  => new sfValidatorString(),
      'ca_tipo'                     => new sfValidatorString(),
      'ca_transporte'               => new sfValidatorString(),
      'ca_incoterms'                => new sfValidatorString(array('required' => false)),
      'ca_reporte'                  => new sfValidatorString(array('required' => false)),
      'ca_impoexpo'                 => new sfValidatorString(array('required' => false)),
      'ca_aplicacion'               => new sfValidatorString(array('required' => false)),
      'cot_recargo_list'            => new sfValidatorPropelChoiceMany(array('model' => 'CotOpcion', 'required' => false)),
      'pric_recargosx_ciudad_list'  => new sfValidatorPropelChoiceMany(array('model' => 'Ciudad', 'required' => false)),
      'pric_recargox_concepto_list' => new sfValidatorPropelChoiceMany(array('model' => 'PricFlete', 'required' => false)),
      'pric_recargosx_linea_list'   => new sfValidatorPropelChoiceMany(array('model' => 'Transportador', 'required' => false)),
      'recargo_flete_list'          => new sfValidatorPropelChoiceMany(array('model' => 'Flete', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tipo_recargo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TipoRecargo';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['cot_recargo_list']))
    {
      $values = array();
      foreach ($this->object->getCotRecargos() as $obj)
      {
        $values[] = $obj->getCaIdopcion();
      }

      $this->setDefault('cot_recargo_list', $values);
    }

    if (isset($this->widgetSchema['pric_recargosx_ciudad_list']))
    {
      $values = array();
      foreach ($this->object->getPricRecargosxCiudads() as $obj)
      {
        $values[] = $obj->getCaIdciudad();
      }

      $this->setDefault('pric_recargosx_ciudad_list', $values);
    }

    if (isset($this->widgetSchema['pric_recargox_concepto_list']))
    {
      $values = array();
      foreach ($this->object->getPricRecargoxConceptos() as $obj)
      {
        $values[] = $obj->getCaIdtrayecto();
      }

      $this->setDefault('pric_recargox_concepto_list', $values);
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

    if (isset($this->widgetSchema['recargo_flete_list']))
    {
      $values = array();
      foreach ($this->object->getRecargoFletes() as $obj)
      {
        $values[] = $obj->getCaIdtrayecto();
      }

      $this->setDefault('recargo_flete_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveCotRecargoList($con);
    $this->savePricRecargosxCiudadList($con);
    $this->savePricRecargoxConceptoList($con);
    $this->savePricRecargosxLineaList($con);
    $this->saveRecargoFleteList($con);
  }

  public function saveCotRecargoList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['cot_recargo_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(CotRecargoPeer::CA_IDRECARGO, $this->object->getPrimaryKey());
    CotRecargoPeer::doDelete($c, $con);

    $values = $this->getValue('cot_recargo_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new CotRecargo();
        $obj->setCaIdrecargo($this->object->getPrimaryKey());
        $obj->setCaIdopcion($value);
        $obj->save();
      }
    }
  }

  public function savePricRecargosxCiudadList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['pric_recargosx_ciudad_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(PricRecargosxCiudadPeer::CA_IDRECARGO, $this->object->getPrimaryKey());
    PricRecargosxCiudadPeer::doDelete($c, $con);

    $values = $this->getValue('pric_recargosx_ciudad_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new PricRecargosxCiudad();
        $obj->setCaIdrecargo($this->object->getPrimaryKey());
        $obj->setCaIdciudad($value);
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
    $c->add(PricRecargoxConceptoPeer::CA_IDRECARGO, $this->object->getPrimaryKey());
    PricRecargoxConceptoPeer::doDelete($c, $con);

    $values = $this->getValue('pric_recargox_concepto_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new PricRecargoxConcepto();
        $obj->setCaIdrecargo($this->object->getPrimaryKey());
        $obj->setCaIdtrayecto($value);
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
    $c->add(PricRecargosxLineaPeer::CA_IDRECARGO, $this->object->getPrimaryKey());
    PricRecargosxLineaPeer::doDelete($c, $con);

    $values = $this->getValue('pric_recargosx_linea_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new PricRecargosxLinea();
        $obj->setCaIdrecargo($this->object->getPrimaryKey());
        $obj->setCaIdlinea($value);
        $obj->save();
      }
    }
  }

  public function saveRecargoFleteList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['recargo_flete_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(RecargoFletePeer::CA_IDRECARGO, $this->object->getPrimaryKey());
    RecargoFletePeer::doDelete($c, $con);

    $values = $this->getValue('recargo_flete_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new RecargoFlete();
        $obj->setCaIdrecargo($this->object->getPrimaryKey());
        $obj->setCaIdtrayecto($value);
        $obj->save();
      }
    }
  }

}
