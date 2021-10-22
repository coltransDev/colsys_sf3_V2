<?php

/**
 * Pregunta form base class.
 *
 * @method Pregunta getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BasePreguntaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_id'                         => new sfWidgetFormInputHidden(),
      'ca_idbloque'                   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Bloque'), 'add_empty' => false)),
      'ca_texto'                      => new sfWidgetFormTextarea(),
      'ca_error'                      => new sfWidgetFormInputText(),
      'ca_ayuda'                      => new sfWidgetFormInputText(),
      'ca_obligatoria'                => new sfWidgetFormInputCheckbox(),
      'ca_comentarios'                => new sfWidgetFormInputCheckbox(),
      'ca_tipo'                       => new sfWidgetFormInputText(),
      'ca_orden'                      => new sfWidgetFormInputText(),
      'ca_activo'                     => new sfWidgetFormInputCheckbox(),
      'ca_numeracion'                 => new sfWidgetFormInputCheckbox(),
      'ca_intervalo_inicial'          => new sfWidgetFormInputText(),
      'ca_intervalo_final'            => new sfWidgetFormInputText(),
      'ca_etiqueta_intervalo_inicial' => new sfWidgetFormInputText(),
      'ca_etiqueta_intervalo_final'   => new sfWidgetFormInputText(),
      'ca_etiquetas_columnas'         => new sfWidgetFormTextarea(),
      'ca_etiquetas_filas'            => new sfWidgetFormTextarea(),
      'ca_fchcreado'                  => new sfWidgetFormDateTime(),
      'ca_usucreado'                  => new sfWidgetFormInputText(),
      'ca_fchactualizado'             => new sfWidgetFormDateTime(),
      'ca_usuactualizado'             => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'ca_id'                         => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_id', 'required' => false)),
      'ca_idbloque'                   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Bloque'))),
      'ca_texto'                      => new sfValidatorString(array('max_length' => 10000)),
      'ca_error'                      => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'ca_ayuda'                      => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'ca_obligatoria'                => new sfValidatorBoolean(array('required' => false)),
      'ca_comentarios'                => new sfValidatorBoolean(array('required' => false)),
      'ca_tipo'                       => new sfValidatorInteger(array('required' => false)),
      'ca_orden'                      => new sfValidatorInteger(array('required' => false)),
      'ca_activo'                     => new sfValidatorBoolean(array('required' => false)),
      'ca_numeracion'                 => new sfValidatorBoolean(array('required' => false)),
      'ca_intervalo_inicial'          => new sfValidatorInteger(array('required' => false)),
      'ca_intervalo_final'            => new sfValidatorInteger(array('required' => false)),
      'ca_etiqueta_intervalo_inicial' => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'ca_etiqueta_intervalo_final'   => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'ca_etiquetas_columnas'         => new sfValidatorString(array('max_length' => 10000, 'required' => false)),
      'ca_etiquetas_filas'            => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'ca_fchcreado'                  => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'                  => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'ca_fchactualizado'             => new sfValidatorDateTime(array('required' => false)),
      'ca_usuactualizado'             => new sfValidatorString(array('max_length' => 20, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('pregunta[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Pregunta';
  }

}
