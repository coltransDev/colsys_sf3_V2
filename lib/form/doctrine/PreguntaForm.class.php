<?php

/**
 * Pregunta form.
 *
 * @package    colmob
 * @subpackage form
 * @author     Gabriel Martinez Rojas
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PreguntaForm extends BasePreguntaForm {

    public function configure() {

        $this->widgetSchema['ca_orden'] = new sfWidgetFormInput(array('type' => 'number'), array('width' => 4));
        $this->widgetSchema['ca_texto'] = new sfWidgetFormTextareaTinyMCE(array(
                    'width' => 590,
                    'height' => 350,
                    'config' => 'theme_advanced_disable: "anchor,image,help"',
                ));
        $this->widgetSchema->setDefault('ca_activo', 1);
        $this->setDefault("is_tested", false);

        $this->widgetSchema->setHelp('ca_alias', 'Nombre abreviado de la pregunta');
        $this->widgetSchema->setHelp('ca_ayuda', 'Texto de ayuda que podr&Aacute; visualizar el usuario para contestar la pregunta');
        $this->widgetSchema->setHelp('ca_idbloque', 'IdFormulario.Formulario - IdBloque.Bloque');
        $this->widgetSchema->setHelp('ca_orden', 'Ingrese un n&uacute;mero entero. Se ordena menor a mayor');
        $this->widgetSchema->setHelp('ca_numero_columnas', 'Ingrese el n&uacute;mero de columnas');
        $this->widgetSchema->setHelp('ca_etiquetas_columnas', 'Ingrese las etiquetas de cada columna separadas por por comas ej:1,2,..,5');
        $this->widgetSchema->setHelp('ca_etiquetas_filas', 'Ingrese las etiquetas para cada fila separadas por comas ej:elemento1,elemento2,..,elemento5');
        $this->widgetSchema->setHelp('ca_intervalo_inicial', 'Ingrese un n&uacute;mero entero para definir el intervalo inicial ej:1');
        $this->widgetSchema->setHelp('ca_intervalo_final', 'Ingrese un n&uacute;mero entero definir para el intervalo final ej:5');
        $this->widgetSchema->setHelp('ca_etiqueta_intervalo_inicial', 'Ingrese la etiqueta para el intervalo inicial ej:bajo');
        $this->widgetSchema->setHelp('ca_etiqueta_intervalo_final', 'Ingrese la etiqueta para el intervalo final ej:alto' );
        $this->widgetSchema->setHelp('ca_activo', 'Dentro de un bloque de preguntas de un formulario solo se muestran sus preguntas activas');
        /* $this->widgetSchema->setHelp('ca_idbloque', 'Servicio que va a estar relacionado la pregunta. Este dato es importante para la generaci&oacute;n de reportes'); */

        $opciones = array(0 => 'n&uacute;mero', 1 => 'texto', 2 => 'email', 3 => 'p&aacute;rrafo', 4 => 'test', 5 => 'casillas de verificaci&oacute;n', 6 => 'lista desplegable', 7 => 'escala', 8 => 'escala con estrellas', 9 => 'cuadr&iacute;cula');

        /* $textoOpciones_tipo = array("texto", 'email', 'párrafo', 'test', 'casillas verificaciOn', 'lista desplegable', 'escala', 'cuadrIcula');
          $valoresOpciones_tipo = array('0', '1', '2', '3', '4', '5', '6'); */

        //escala necesita recibir los dos valores fronteras y las etiquetas para esos extremos
        //cuadricula necesita una lista de parametros y los dos valores extremos

        $this->widgetSchema['ca_tipo'] = new sfWidgetFormSelect(
                        array('choices' => $opciones,
                            'multiple' => false,
                            'default' => '0'));

        /* $this->widgetSchema['ca_activo'] = new sfWidgetFormSelectCheckbox(
          array('default' => '1')); */

        $this->widgetSchema->setLabels(array(
            'ca_alias' => 'Alias:',
            'ca_titulo' => 'Titulo de la Pregunta:',
            'ca_texto' => 'Texto de la pregunta (<span class="pregunta-obligatoria-admin">*</span>):',
            'ca_activo' => 'Activo:',
            'ca_estilo' => 'Estilo:',
            'ca_error' => 'Mensaje de Error:',
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
            'ca_idbloque' => 'Bloque de preguntas (<span class="pregunta-obligatoria-admin">*</span>):',
            'ca_comentarios' => 'Incluir comentarios:',
                /* 'ca_idbloque' => 'Tipo de servicio:', */
        ));
        $this->validatorSchema['ca_idbloque'] = new sfValidatorString(array(), array('required' => 'Seleccione el bloque', 'invalid' => 'Por favor un nombre de bloque m&aacute;s largo'));
        $this->validatorSchema['ca_texto'] = new sfValidatorString(array(), array('required' => 'Falta el texto de la pregunta', 'invalid' => 'Por favor inserte un t&iacute;tulo m&aacute;s largo'));
        $this->validatorSchema['ca_orden'] = new sfValidatorInteger(array('required' => false), array('invalid' => 'Por favor inserte un n&uacute;mero entero'));

        unset(
                $this['ca_estilo'], $this['ca_color'], $this['ca_numeracion'], $this['ca_nombre_formato'], $this['ca_alias'], $this['ca_fchcreado'], $this['ca_usucreado'], $this['ca_fchactualizado'], $this['ca_usuactualizado']);

        /*
          $subForm = new sfForm();
          $opcion = new Opcion();
          //$opcion = $this->getObject();
          for ($i = 0; $i < 1; $i++) {
          $form = new OpcionForm($opcion);
          $subForm->embedForm($i, $form);
          }
          $this->embedForm('nueva Opcion:', $subForm); */
    }

    public function getActivoValue($id) {
        if ($this->getCaActivo() == 1) {
            echo 'Si';
        } else {
            echo 'No';
        }
    }

}