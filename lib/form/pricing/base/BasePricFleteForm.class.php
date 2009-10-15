<?php

/**
 * PricFlete form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BasePricFleteForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idtrayecto'               => new sfWidgetFormInputHidden(),
      'ca_idconcepto'               => new sfWidgetFormInputHidden(),
      'ca_vlrneto'                  => new sfWidgetFormInput(),
      'ca_vlrsugerido'              => new sfWidgetFormInput(),
      'ca_fchinicio'                => new sfWidgetFormDate(),
      'ca_fchvencimiento'           => new sfWidgetFormDate(),
      'ca_idmoneda'                 => new sfWidgetFormInput(),
      'ca_fchcreado'                => new sfWidgetFormDateTime(),
      'ca_usucreado'                => new sfWidgetFormInput(),
      'ca_estado'                   => new sfWidgetFormInput(),
      'ca_aplicacion'               => new sfWidgetFormInput(),
      'ca_consecutivo'              => new sfWidgetFormInput(),
      'pric_recargox_concepto_list' => new sfWidgetFormPropelChoiceMany(array('model' => 'TipoRecargo')),
    ));

    $this->setValidators(array(
      'ca_idtrayecto'               => new sfValidatorPropelChoice(array('model' => 'Trayecto', 'column' => 'ca_idtrayecto', 'required' => false)),
      'ca_idconcepto'               => new sfValidatorPropelChoice(array('model' => 'Concepto', 'column' => 'ca_idconcepto', 'required' => false)),
      'ca_vlrneto'                  => new sfValidatorNumber(array('required' => false)),
      'ca_vlrsugerido'              => new sfValidatorNumber(array('required' => false)),
      'ca_fchinicio'                => new sfValidatorDate(array('required' => false)),
      'ca_fchvencimiento'           => new sfValidatorDate(array('required' => false)),
      'ca_idmoneda'                 => new sfValidatorString(array('max_length' => 3, 'required' => false)),
      'ca_fchcreado'                => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'                => new sfValidatorString(array('required' => false)),
      'ca_estado'                   => new sfValidatorInteger(array('required' => false)),
      'ca_aplicacion'               => new sfValidatorString(array('required' => false)),
      'ca_consecutivo'              => new sfValidatorInteger(array('required' => false)),
      'pric_recargox_concepto_list' => new sfValidatorPropelChoiceMany(array('model' => 'TipoRecargo', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('pric_flete[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PricFlete';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['pric_recargox_concepto_list']))
    {
      $values = array();
      foreach ($this->object->getPricRecargoxConceptos() as $obj)
      {
        $values[] = $obj->getCaIdrecargo();
      }

      $this->setDefault('pric_recargox_concepto_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->savePricRecargoxConceptoList($con);
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
        $obj->setCaIdrecargo($value);
        $obj->save();
      }
    }
  }

}
