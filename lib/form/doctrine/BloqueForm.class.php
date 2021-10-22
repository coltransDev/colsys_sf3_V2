<?php

/**
 * Bloque form.
 *
 * @package    colmob
 * @subpackage form
 * @author     Gabriel Martinez Rojas
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class BloqueForm extends BaseBloqueForm {

    public function configure() {

        $this->widgetSchema['ca_introduccion'] = new sfWidgetFormTextareaTinyMCE(array(
                    'width' => 550,
                    'height' => 350,
                    'config' => 'theme_advanced_disable: "anchor,image,help"',
                ));
        $this->widgetSchema->setHelp('ca_alias', 'Nombre abreviado del bloque');
        $this->widgetSchema->setHelp('ca_activo', 'Dentro de un formulario solo se muestran sus bloques activos');
        $this->widgetSchema->setHelp('ca_idformulario', 'IdFormulario. Formulario');


        $opciones = array(0 => 'normal', 1 => 'servicios');
                $this->widgetSchema['ca_tipo'] = new sfWidgetFormSelect(
                        array('choices' => $opciones,
                            'multiple' => false,
                            'default' => '0'));

        $this->widgetSchema->setLabels(array(
            'ca_alias' => 'Alias:',
            'ca_titulo' => 'Titulo del Bloque (<span class="pregunta-obligatoria-admin">*</span>):',
            'ca_introduccion' => 'Texto introductorio del bloque:',
            'ca_activo' => 'Activo:',
            'ca_estilo' => 'Estilo:',
            'ca_nombre_formato' => 'Nombre del formato:',
            'ca_color' => 'Color:',
            'ca_orden' => 'Orden:',
            'ca_tipo' => 'Tipo:',
            'ca_idformulario' => 'Formulario (<span class="pregunta-obligatoria-admin">*</span>):',
        ));
        $this->validatorSchema['ca_idformulario'] = new sfValidatorString(array(), array('required' => 'Seleccione el formulario', 'invalid' => 'Por favor un nombre de formulario m&aacute;s largo'));
        $this->validatorSchema['ca_titulo'] = new sfValidatorString(array(), array('required' => 'Falta el titulo', 'invalid' => 'Por favor inserte un t&iacute;tulo m&aacute;s largo'));
        $this->validatorSchema['ca_orden'] = new sfValidatorInteger(array('required' => false), array('invalid' => 'Por favor inserte un n&uacute;mero entero'));
        unset($this['ca_alias'], $this['ca_color'], $this['ca_estilo'],$this['ca_fchcreado'], $this['ca_usucreado'], $this['ca_fchactualizado'], $this['ca_usuactualizado']);
    }

}
