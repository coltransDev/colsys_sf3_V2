<?php

/**
 * PricPatio form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BasePricPatioForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idpatio'            => new sfWidgetFormInputHidden(),
      'ca_nombre'             => new sfWidgetFormInput(),
      'ca_idciudad'           => new sfWidgetFormPropelChoice(array('model' => 'Ciudad', 'add_empty' => true)),
      'ca_direccion'          => new sfWidgetFormInput(),
      'pric_patio_linea_list' => new sfWidgetFormPropelChoiceMany(array('model' => 'Transportador')),
    ));

    $this->setValidators(array(
      'ca_idpatio'            => new sfValidatorPropelChoice(array('model' => 'PricPatio', 'column' => 'ca_idpatio', 'required' => false)),
      'ca_nombre'             => new sfValidatorString(array('required' => false)),
      'ca_idciudad'           => new sfValidatorPropelChoice(array('model' => 'Ciudad', 'column' => 'ca_idciudad', 'required' => false)),
      'ca_direccion'          => new sfValidatorString(array('required' => false)),
      'pric_patio_linea_list' => new sfValidatorPropelChoiceMany(array('model' => 'Transportador', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('pric_patio[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PricPatio';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['pric_patio_linea_list']))
    {
      $values = array();
      foreach ($this->object->getPricPatioLineas() as $obj)
      {
        $values[] = $obj->getCaIdlinea();
      }

      $this->setDefault('pric_patio_linea_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->savePricPatioLineaList($con);
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
    $c->add(PricPatioLineaPeer::CA_IDPATIO, $this->object->getPrimaryKey());
    PricPatioLineaPeer::doDelete($c, $con);

    $values = $this->getValue('pric_patio_linea_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new PricPatioLinea();
        $obj->setCaIdpatio($this->object->getPrimaryKey());
        $obj->setCaIdlinea($value);
        $obj->save();
      }
    }
  }

}
