<?php

/**
 * Transportador form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseTransportadorForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idlinea'                => new sfWidgetFormInputHidden(),
      'ca_idtransportista'        => new sfWidgetFormPropelChoice(array('model' => 'Transportista', 'add_empty' => true)),
      'ca_nombre'                 => new sfWidgetFormInput(),
      'ca_sigla'                  => new sfWidgetFormInput(),
      'ca_transporte'             => new sfWidgetFormInput(),
      'pric_patio_linea_list'     => new sfWidgetFormPropelChoiceMany(array('model' => 'PricPatio')),
      'pric_recargosx_linea_list' => new sfWidgetFormPropelChoiceMany(array('model' => 'TipoRecargo')),
    ));

    $this->setValidators(array(
      'ca_idlinea'                => new sfValidatorPropelChoice(array('model' => 'Transportador', 'column' => 'ca_idlinea', 'required' => false)),
      'ca_idtransportista'        => new sfValidatorPropelChoice(array('model' => 'Transportista', 'column' => 'ca_idtransportista', 'required' => false)),
      'ca_nombre'                 => new sfValidatorString(array('required' => false)),
      'ca_sigla'                  => new sfValidatorString(array('required' => false)),
      'ca_transporte'             => new sfValidatorString(array('required' => false)),
      'pric_patio_linea_list'     => new sfValidatorPropelChoiceMany(array('model' => 'PricPatio', 'required' => false)),
      'pric_recargosx_linea_list' => new sfValidatorPropelChoiceMany(array('model' => 'TipoRecargo', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('transportador[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Transportador';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['pric_patio_linea_list']))
    {
      $values = array();
      foreach ($this->object->getPricPatioLineas() as $obj)
      {
        $values[] = $obj->getCaIdpatio();
      }

      $this->setDefault('pric_patio_linea_list', $values);
    }

    if (isset($this->widgetSchema['pric_recargosx_linea_list']))
    {
      $values = array();
      foreach ($this->object->getPricRecargosxLineas() as $obj)
      {
        $values[] = $obj->getCaIdrecargo();
      }

      $this->setDefault('pric_recargosx_linea_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->savePricPatioLineaList($con);
    $this->savePricRecargosxLineaList($con);
  }

  public function savePricPatioLineaList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['pric_patio_linea_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(PricPatioLineaPeer::CA_IDLINEA, $this->object->getPrimaryKey());
    PricPatioLineaPeer::doDelete($c, $con);

    $values = $this->getValue('pric_patio_linea_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new PricPatioLinea();
        $obj->setCaIdlinea($this->object->getPrimaryKey());
        $obj->setCaIdpatio($value);
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
    $c->add(PricRecargosxLineaPeer::CA_IDLINEA, $this->object->getPrimaryKey());
    PricRecargosxLineaPeer::doDelete($c, $con);

    $values = $this->getValue('pric_recargosx_linea_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new PricRecargosxLinea();
        $obj->setCaIdlinea($this->object->getPrimaryKey());
        $obj->setCaIdrecargo($value);
        $obj->save();
      }
    }
  }

}
