<?php

/**
 * Flete form base class.
 *
 * @package    form
 * @subpackage flete
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseFleteForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idtrayecto'      => new sfWidgetFormInputHidden(),
      'ca_idconcepto'      => new sfWidgetFormInputHidden(),
      'ca_vlrneto'         => new sfWidgetFormInput(),
      'ca_vlrminimo'       => new sfWidgetFormInput(),
      'ca_fchinicio'       => new sfWidgetFormDate(),
      'ca_fchvencimiento'  => new sfWidgetFormDate(),
      'ca_idmoneda'        => new sfWidgetFormInput(),
      'ca_observaciones'   => new sfWidgetFormInput(),
      'ca_fchcreado'       => new sfWidgetFormDateTime(),
      'recargo_flete_list' => new sfWidgetFormPropelSelectMany(array('model' => 'TipoRecargo')),
    ));

    $this->setValidators(array(
      'ca_idtrayecto'      => new sfValidatorPropelChoice(array('model' => 'Trayecto', 'column' => 'ca_idtrayecto', 'required' => false)),
      'ca_idconcepto'      => new sfValidatorPropelChoice(array('model' => 'Concepto', 'column' => 'ca_idconcepto', 'required' => false)),
      'ca_vlrneto'         => new sfValidatorNumber(),
      'ca_vlrminimo'       => new sfValidatorNumber(array('required' => false)),
      'ca_fchinicio'       => new sfValidatorDate(array('required' => false)),
      'ca_fchvencimiento'  => new sfValidatorDate(array('required' => false)),
      'ca_idmoneda'        => new sfValidatorString(array('max_length' => 3, 'required' => false)),
      'ca_observaciones'   => new sfValidatorString(array('required' => false)),
      'ca_fchcreado'       => new sfValidatorDateTime(array('required' => false)),
      'recargo_flete_list' => new sfValidatorPropelChoiceMany(array('model' => 'TipoRecargo', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('flete[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Flete';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['recargo_flete_list']))
    {
      $values = array();
      foreach ($this->object->getRecargoFletes() as $obj)
      {
        $values[] = $obj->getCaIdrecargo();
      }

      $this->setDefault('recargo_flete_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveRecargoFleteList($con);
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
    $c->add(RecargoFletePeer::CA_IDTRAYECTO, $this->object->getPrimaryKey());
    RecargoFletePeer::doDelete($c, $con);

    $values = $this->getValue('recargo_flete_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new RecargoFlete();
        $obj->setCaIdtrayecto($this->object->getPrimaryKey());
        $obj->setCaIdrecargo($value);
        $obj->save();
      }
    }
  }

}
