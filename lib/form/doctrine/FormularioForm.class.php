<?php

/**
 * Formulario form
 * @package    colmob
 * @subpackage form
 * @author     Gabriel Martinez Rojas
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class FormularioForm extends BaseFormularioForm {

    public function configure() {

        /* $opciones_activo = array("No", 'Si');
          $valores_activo = array(0, 1);
          $this->widgetSchema['ca_activo'] = new sfWidgetFormSelect(
          array('choices' => array_combine($valores_activo, $opciones_activo),
          'multiple' => false,
          'default' => 1)); */


        $this->widgetSchema['ca_introduccion'] = new sfWidgetFormTextareaTinyMCE(array(
                    'width' => 550,
                    'height' => 350,
                    'config' => 'theme_advanced_disable: "anchor,image,help"',
                ));


        $months = array(
            '01' => 'Enero',
            '02' => 'Febrero',
            '03' => 'Marzo',
            '04' => 'Abril',
            '05' => 'Mayo',
            '06' => 'Junio',
            '07' => 'Julio',
            '08' => 'Agosto',
            '09' => 'Septiembre',
            '10' => 'Octubre',
            '11' => 'Noviembre',
            '12' => 'Diciembre',
        );

        $post_months = array(
            'Enero' => '01',
            'Febrero' => '02',
            'Marzo' => '03',
            'Abril' => '04',
            'Mayo' => '05',
            'Junio' => '06',
            'Julio' => '07',
            'Agosto' => '08',
            'Septiembre' => '09',
            'Octubre' => '10',
            'Noviembre' => '11',
            'Diciembre' => '12',
        );


        $today = array('year' => date('Y'), 'month' => date('n'), 'day' => date('j'));
        $hoy = '01/01/2012';
        $years = array(2012, 2013, 2014, 2015, 2016, 2017, 2018, 2019, 2020);
        $format = '%day% - %month% - %year%';

        /*
          $this->widgetSchema['ca_vigencia_inicial'] = new sfWidgetFormDate(array('label' => 'Vigencia inicial:', 'format' => $format, 'default' => $today,
          'months' => $months, 'years' => $years
          ));

          $this->widgetSchema['ca_vigencia_final'] = new sfWidgetFormDate(array('label' => 'Vigencia final:', 'format' => $format,
          'months' => $months, 'years' => $years
          )); */

        $this->widgetSchema['ca_vigencia_inicial'] = new sfWidgetFormI18nDate(array('label' => 'Vigencia inicial:', 'format' => $format, 'month_format' => 'name', 'culture' => 'es'
                ));

        $this->widgetSchema['ca_vigencia_final'] = new sfWidgetFormI18nDate(array('label' => 'Vigencia final:', 'format' => $format, 'month_format' => 'name', 'culture' => 'es'
                ));



        $this->widgetSchema->setLabels(array(
            /* 'ca_alias' => 'Alias:', */
            'ca_titulo' => 'Nombre del Formulario (<span class="pregunta-obligatoria-admin">*</span>):',
            'ca_introduccion' => 'Texto introductorio del formulario:',
            'ca_activo' => 'Activo:',
            'ca_alias' => 'Nombre para el cliente:',
            /* 'ca_estilo' => 'Estilo:', */
            'ca_nombre_formato' => 'Nombre del formato:',            
            'ca_empresa' => 'Empresa:',
            'ca_vigencia_inicial' => 'Vigencia inicial:',
            'ca_vigencia_final' => 'Vigencia final:',
        ));

        $this->widgetSchema->setHelp('ca_alias', 'Nombre abreviado del formulario');
        $this->widgetSchema->setHelp('ca_activo', 'Solo se muestran los formularios activos');
        $this->widgetSchema->setHelp('ca_vigencia_inicial', 'd&iacute;a - mes - a&ntilde;o');
        $this->widgetSchema->setHelp('ca_vigencia_final', 'd&iacute;a - mes - a&ntilde;o');

        $this->validatorSchema['ca_titulo'] = new sfValidatorString(array(), array('required' => 'Falta el titulo', 'invalid' => 'Por favor inserte un título más largo'));
        /* $this->widgetSchema['created_at'] = new sfWidgetFormJQueryDate(array(
          'config' => '{}',
          )); */


        $this->validatorSchema->setPostValidator(
                new sfValidatorSchemaCompare('ca_vigencia_inicial', sfValidatorSchemaCompare::LESS_THAN_EQUAL, 'ca_vigencia_final',
                        array(),
                        array('invalid' => 'La fecha de la vigencia inicial debe ser anterior a la fecha de la vigencia final'))
        );

        /* $this->validatorSchema->setPostValidator(
          new sfValidatorCallback(array('callback' => array($this, 'checkDate')))
          ); */

        /* $this->validatorSchema->setPostValidator(
          new sfValidatorSchemaCompare('ca_vigencia_inicial', sfValidatorSchemaCompare::LESS_THAN_EQUAL, 'ca_vigencia_final',
          array(),
          array('invalid' => 'La fecha de la vigencia inicial debe ser anterior a la fecha de la vigencia final')
          )
          ); */

        $opciones = array(1 => 'Colmas', 2 => 'Coltrans', 99 => 'No aplica');

        /* $textoOpciones_tipo = array("texto", 'email', 'pÃ¡rrafo', 'test', 'casillas verificaciOn', 'lista desplegable', 'escala', 'cuadrIcula');
          $valoresOpciones_tipo = array('0', '1', '2', '3', '4', '5', '6'); */

        //escala necesita recibir los dos valores fronteras y las etiquetas para esos extremos
        //cuadricula necesita una lista de parametros y los dos valores extremos

        $this->widgetSchema['ca_empresa'] = new sfWidgetFormSelect(
                        array('choices' => $opciones,
                            'multiple' => false,
                            'default' => '0',
                            'label' => 'Empresa:'));



        unset($this['ca_activo'], $this['ca_nombre_formato'], $this['ca_fchcreado'], $this['ca_usucreado'], $this['ca_fchactualizado'], $this['ca_usuactualizado'], $this['ca_token'], $this['ca_bold'], $this['ca_strong'], $this['ca_vigencia_inicial'], $this['ca_vigencia_final']);
    }

    /**
     * Devuelve la fecha en un formato valido
     * @param type $validator
     * @param type $values
     * @return type
     * @throws sfValidatorError 
     */
    public function checkDate($validator, $values) {
        if ($values['ca_vigencia_inicial'] != $values['ca_vigencia_final']) {
            // password is not correct, throw an error
            throw new sfValidatorError($validator, 'Fechas invalidas');
        }


        $post_months = array(
            'Enero' => '01',
            'Febrero' => '02',
            'Marzo' => '03',
            'Abril' => '04',
            'Mayo' => '05',
            'Junio' => '06',
            'Julio' => '07',
            'Agosto' => '08',
            'Septiembre' => '09',
            'Octubre' => '10',
            'Noviembre' => '11',
            'Diciembre' => '12',
        );

        switch ($x) {
            case 1:
                echo "Number 1";
                break;
            case 2:
                echo "Number 2";
                break;
            case 3:
                echo "Number 3";
                break;
            default:
                echo "No number between 1 and 3";
        }


        $values['ca_vigencia_final'] = "";

        // password is correct, return the clean values
        return $values;
    }

}
