<?php

/**
 * Trafico form base class.
 *
 * @package    form
 * @subpackage trafico
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseTraficoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idtrafico' => new sfWidgetFormInputHidden(),
      'ca_nombre'    => new sfWidgetFormInput(),
      'ca_bandera'   => new sfWidgetFormInput(),
      'ca_idmoneda'  => new sfWidgetFormDoctrineSelect(array('model' => 'Moneda', 'add_empty' => false)),
      'ca_idgrupo'   => new sfWidgetFormDoctrineSelect(array('model' => 'TraficoGrupo', 'add_empty' => false)),
      'ca_link'      => new sfWidgetFormTextarea(),
      'ca_conceptos' => new sfWidgetFormInput(),
      'ca_recargos'  => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idtrafico' => new sfValidatorDoctrineChoice(array('model' => 'Trafico', 'column' => 'ca_idtrafico', 'required' => false)),
      'ca_nombre'    => new sfValidatorString(array('max_length' => 40)),
      'ca_bandera'   => new sfValidatorString(array('max_length' => 30)),
      'ca_idmoneda'  => new sfValidatorDoctrineChoice(array('model' => 'Moneda')),
      'ca_idgrupo'   => new sfValidatorDoctrineChoice(array('model' => 'TraficoGrupo')),
      'ca_link'      => new sfValidatorString(array('max_length' => 256, 'required' => false)),
      'ca_conceptos' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'ca_recargos'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('trafico[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Trafico';
  }

}