<?php

/**
 * CotOpcion form base class.
 *
 * @package    form
 * @subpackage cot_opcion
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseCotOpcionForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idopcion'       => new sfWidgetFormInputHidden(),
      'ca_idproducto'     => new sfWidgetFormPropelSelect(array('model' => 'CotProducto', 'add_empty' => false)),
      'ca_idconcepto'     => new sfWidgetFormPropelSelect(array('model' => 'Concepto', 'add_empty' => true)),
      'ca_idmoneda'       => new sfWidgetFormInput(),
      'ca_tarifa'         => new sfWidgetFormInput(),
      'ca_oferta'         => new sfWidgetFormInput(),
      'ca_recargos'       => new sfWidgetFormInput(),
      'ca_observaciones'  => new sfWidgetFormInput(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usucreado'      => new sfWidgetFormInput(),
      'ca_fchactualizado' => new sfWidgetFormDateTime(),
      'ca_usuactualizado' => new sfWidgetFormInput(),
      'cot_recargo_list'  => new sfWidgetFormPropelSelectMany(array('model' => 'TipoRecargo')),
    ));

    $this->setValidators(array(
      'ca_idopcion'       => new sfValidatorPropelChoice(array('model' => 'CotOpcion', 'column' => 'ca_idopcion', 'required' => false)),
      'ca_idproducto'     => new sfValidatorPropelChoice(array('model' => 'CotProducto', 'column' => 'ca_idcotizacion')),
      'ca_idconcepto'     => new sfValidatorPropelChoice(array('model' => 'Concepto', 'column' => 'ca_idconcepto', 'required' => false)),
      'ca_idmoneda'       => new sfValidatorString(array('required' => false)),
      'ca_tarifa'         => new sfValidatorString(array('required' => false)),
      'ca_oferta'         => new sfValidatorString(array('required' => false)),
      'ca_recargos'       => new sfValidatorString(array('required' => false)),
      'ca_observaciones'  => new sfValidatorString(array('required' => false)),
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'      => new sfValidatorString(array('required' => false)),
      'ca_fchactualizado' => new sfValidatorDateTime(array('required' => false)),
      'ca_usuactualizado' => new sfValidatorString(array('required' => false)),
      'cot_recargo_list'  => new sfValidatorPropelChoiceMany(array('model' => 'TipoRecargo', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cot_opcion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'CotOpcion';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['cot_recargo_list']))
    {
      $values = array();
      foreach ($this->object->getCotRecargos() as $obj)
      {
        $values[] = $obj->getCaIdrecargo();
      }

      $this->setDefault('cot_recargo_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveCotRecargoList($con);
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
    $c->add(CotRecargoPeer::CA_IDOPCION, $this->object->getPrimaryKey());
    CotRecargoPeer::doDelete($c, $con);

    $values = $this->getValue('cot_recargo_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new CotRecargo();
        $obj->setCaIdopcion($this->object->getPrimaryKey());
        $obj->setCaIdrecargo($value);
        $obj->save();
      }
    }
  }

}
