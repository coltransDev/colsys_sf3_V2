<?php

/**
 * Pregunta filter form.
 *
 * @package    colmob
 * @subpackage filter
 * @author     Gabriel Martinez Rojas
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PreguntaFormFilter extends BasePreguntaFormFilter {

    public function configure() {
        $this->setWidget('ca_id', new sfWidgetFormFilterInput(array('with_empty' => false)));
        $this->setValidator('ca_id', new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))));
        $this->setWidget('ca_tipo', new sfWidgetFormFilterInput(array('with_empty' => false, 'template' => '%input% %empty_checkbox% %empty_label%')));
        $this->setWidget('ca_orden', new sfWidgetFormFilterInput(array('empty_label' => '<span class="filter-auxiliar">esta vac&iacute;o</span>')));

        //$this->widgetSchema['ca_tipo'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ca_idbloque'), 'add_empty' => true),array('readonly'=>'readonly','disabled'=>'disable'));

        $opciones = array(0 => 'n&uacute;mero', 1 => 'texto', 2 => 'email', 3 => 'parrafo', 4 => 'test', 5 => 'casillas de verificaci&oacute;n', 6 => 'lista desplegable', 7 => 'escala', 8 => 'cuadr&iacute;cula');



        $this->widgetSchema['ca_tipo'] = new sfWidgetFormSelect(
                        array('choices' => $opciones,
                            'multiple' => false,
                            'default' => '0'));


        $this->widgetSchema->setHelp('ca_idbloque', '<span class="filter-help">Formulario - Bloque</span>');
        $this->widgetSchema->setLabels(array(
            'ca_id' => 'Id:',
            'ca_alias' => 'Alias:',
            'ca_titulo' => 'Titulo de la Pregunta:',
            'ca_texto' => 'Texto de la pregunta:',
            'ca_activo' => 'Activo:',
            'ca_estilo' => 'Estilo:',
            'ca_nombre_formato' => 'Nombre del formato:',
            'ca_color' => 'Color:',
            'ca_orden' => 'Orden:',
            'ca_tipo' => 'Tipo:',
            'ca_obligatoria' => 'Obligatoria:',
            'ca_numeracion' => 'Aumentar Numeraci&oacute;n',
            'ca_intervalo_inicial' => 'Intervalo inicial:',
            'ca_intervalo_final' => 'Intervalo final:',
            'ca_etiqueta_intervalo_inicial' => 'Etiquetas Intervalo inicial:',
            'ca_etiqueta_intervalo_final' => 'Etiquetas Intervalo final:',
            'ca_etiquetas_columnas' => 'Etiquetas de Columnas:',
            'ca_etiquetas_filas' => 'Etiquetas de Filas',
            'ca_ayuda' => 'Texto de ayuda:',
            'ca_idbloque' => 'Bloque de preguntas:',
                /* 'ca_idbloque' => 'Tipo de servicio:', */
        ));

        //escala necesita recibir los dos valores fronteras y las etiquetas para esos extremos
        //cuadricula necesita una lista de parametros y los dos valores extremos

        $this->widgetSchema->setHelp('ca_tipo', '<span class="filter-help">Inserte un valor entre 0 y 6</span>');

        //$this['ca_tipo']
        $this->useFields(array(
            'ca_idbloque',
            /*'ca_tipo',*/
            'ca_activo',
            'ca_obligatoria',
            'ca_texto',
            'ca_orden',
            'ca_id'
        ));
    }

   


}
