<?php

/**
 * Pregunta filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BasePreguntaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idbloque'                   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Bloque'), 'add_empty' => true)),
      'ca_texto'                      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ca_error'                      => new sfWidgetFormFilterInput(),
      'ca_ayuda'                      => new sfWidgetFormFilterInput(),
      'ca_obligatoria'                => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'ca_comentarios'                => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'ca_tipo'                       => new sfWidgetFormFilterInput(),
      'ca_orden'                      => new sfWidgetFormFilterInput(),
      'ca_activo'                     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'ca_numeracion'                 => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'ca_intervalo_inicial'          => new sfWidgetFormFilterInput(),
      'ca_intervalo_final'            => new sfWidgetFormFilterInput(),
      'ca_etiqueta_intervalo_inicial' => new sfWidgetFormFilterInput(),
      'ca_etiqueta_intervalo_final'   => new sfWidgetFormFilterInput(),
      'ca_etiquetas_columnas'         => new sfWidgetFormFilterInput(),
      'ca_etiquetas_filas'            => new sfWidgetFormFilterInput(),
      'ca_fchcreado'                  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'ca_usucreado'                  => new sfWidgetFormFilterInput(),
      'ca_fchactualizado'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'ca_usuactualizado'             => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'ca_idbloque'                   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Bloque'), 'column' => 'ca_id')),
      'ca_texto'                      => new sfValidatorPass(array('required' => false)),
      'ca_error'                      => new sfValidatorPass(array('required' => false)),
      'ca_ayuda'                      => new sfValidatorPass(array('required' => false)),
      'ca_obligatoria'                => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'ca_comentarios'                => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'ca_tipo'                       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ca_orden'                      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ca_activo'                     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'ca_numeracion'                 => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'ca_intervalo_inicial'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ca_intervalo_final'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ca_etiqueta_intervalo_inicial' => new sfValidatorPass(array('required' => false)),
      'ca_etiqueta_intervalo_final'   => new sfValidatorPass(array('required' => false)),
      'ca_etiquetas_columnas'         => new sfValidatorPass(array('required' => false)),
      'ca_etiquetas_filas'            => new sfValidatorPass(array('required' => false)),
      'ca_fchcreado'                  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'ca_usucreado'                  => new sfValidatorPass(array('required' => false)),
      'ca_fchactualizado'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'ca_usuactualizado'             => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('pregunta_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Pregunta';
  }

  public function getFields()
  {
    return array(
      'ca_id'                         => 'Number',
      'ca_idbloque'                   => 'ForeignKey',
      'ca_texto'                      => 'Text',
      'ca_error'                      => 'Text',
      'ca_ayuda'                      => 'Text',
      'ca_obligatoria'                => 'Boolean',
      'ca_comentarios'                => 'Boolean',
      'ca_tipo'                       => 'Number',
      'ca_orden'                      => 'Number',
      'ca_activo'                     => 'Boolean',
      'ca_numeracion'                 => 'Boolean',
      'ca_intervalo_inicial'          => 'Number',
      'ca_intervalo_final'            => 'Number',
      'ca_etiqueta_intervalo_inicial' => 'Text',
      'ca_etiqueta_intervalo_final'   => 'Text',
      'ca_etiquetas_columnas'         => 'Text',
      'ca_etiquetas_filas'            => 'Text',
      'ca_fchcreado'                  => 'Date',
      'ca_usucreado'                  => 'Text',
      'ca_fchactualizado'             => 'Date',
      'ca_usuactualizado'             => 'Text',
    );
  }
}
