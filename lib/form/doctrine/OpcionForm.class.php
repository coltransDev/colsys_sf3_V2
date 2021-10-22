<?php

/**
 * Opcion form.
 *
 * @package    colmob
 * @subpackage form
 * @author     Gabriel Martinez Rojas
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class OpcionForm extends BaseOpcionForm
{
  public function configure()
  {
      /*$this->widgetSchema['ca_texto'] = new sfWidgetFormTextareaTinyMCE(array(
                    'width' => 55,
                    'height' => 10,
                    'config' => 'theme_advanced_disable: "anchor,image,help"',
                ));*/
        $this->widgetSchema->setHelp('ca_alias', 'Nombre abreviado de la pregunta');
        $this->widgetSchema->setHelp('ca_idpregunta', 'IdFormulario.Formulario - IdBloque.Bloque - IdPregunta.Pregunta');
        $this->widgetSchema->setLabels(array(
            'ca_alias' => 'alias:',
            'ca_texto' => 'Texto (<span class="pregunta-obligatoria-admin">*</span>):',
            'ca_default' => 'Valor por defecto:',
            'ca_color' => 'Color:',
            'ca_orden' => 'Orden:',
            'ca_idpregunta' => 'Pregunta (<span class="pregunta-obligatoria-admin">*</span>):',
        ));
        $this->validatorSchema['ca_idpregunta'] = new sfValidatorString(array(), array('required' => 'Seleccione la pregunta', 'invalid' => 'Por favor un nombre de pregunta m&aacute;s largo'));
        $this->validatorSchema['ca_texto'] = new sfValidatorString(array('required' => true), array('required' => 'Falta el texto de la opci&oacute;n', 'invalid' => 'Por favor inserte un texto m&aacute;s largo'));
        $this->validatorSchema['ca_orden'] = new sfValidatorInteger(array('required' => false), array('invalid' => 'Por favor inserte un n&uacute;mero entero'));
        unset($this['ca_alias'], $this['ca_default'], $this['ca_color'],$this['ca_fchcreado'], $this['ca_usucreado'], $this['ca_fchactualizado'], $this['ca_usuactualizado']);


  }
}
