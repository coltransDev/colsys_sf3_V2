<?php

/**
 * Ciudad form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseCiudadForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idciudad'                => new sfWidgetFormInputHidden(),
      'ca_ciudad'                  => new sfWidgetFormInput(),
      'ca_idtrafico'               => new sfWidgetFormPropelChoice(array('model' => 'Trafico', 'add_empty' => true)),
      'ca_puerto'                  => new sfWidgetFormInput(),
      'pric_recargosx_ciudad_list' => new sfWidgetFormPropelChoiceMany(array('model' => 'TipoRecargo')),
    ));

    $this->setValidators(array(
      'ca_idciudad'                => new sfValidatorPropelChoice(array('model' => 'Ciudad', 'column' => 'ca_idciudad', 'required' => false)),
      'ca_ciudad'                  => new sfValidatorString(array('required' => false)),
      'ca_idtrafico'               => new sfValidatorPropelChoice(array('model' => 'Trafico', 'column' => 'ca_idtrafico', 'required' => false)),
      'ca_puerto'                  => new sfValidatorString(array('required' => false)),
      'pric_recargosx_ciudad_list' => new sfValidatorPropelChoiceMany(array('model' => 'TipoRecargo', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ciudad[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Ciudad';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['pric_recargosx_ciudad_list']))
    {
      $values = array();
      foreach ($this->object->getPricRecargosxCiudads() as $obj)
      {
        $values[] = $obj->getCaIdrecargo();
      }

      $this->setDefault('pric_recargosx_ciudad_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->savePricRecargosxCiudadList($con);
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
    $c->add(PricRecargosxCiudadPeer::CA_IDCIUDAD, $this->object->getPrimaryKey());
    PricRecargosxCiudadPeer::doDelete($c, $con);

    $values = $this->getValue('pric_recargosx_ciudad_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new PricRecargosxCiudad();
        $obj->setCaIdciudad($this->object->getPrimaryKey());
        $obj->setCaIdrecargo($value);
        $obj->save();
      }
    }
  }

}
