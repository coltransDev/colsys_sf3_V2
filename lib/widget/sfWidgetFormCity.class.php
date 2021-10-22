<?php


/**
 *
 *
 * @package    colsys
 * @subpackage widget
 * @author     Andres Botero
 * @version    SVN: $Id$
 */
class sfWidgetFormCity extends sfWidgetFormSelect
{
  /**
   * Constructor.
   *
   * Available options:
   *
   *  * choices:          An array of possible choices (required)
   *  * multiple:         true if the select tag must allow multiple selections
   *  * expanded:         true to display an expanded widget
   *                        if expanded is false, then the widget will be a select
   *                        if expanded is true and multiple is false, then the widget will be a list of radio
   *                        if expanded is true and multiple is true, then the widget will be a list of checkbox
   *  * renderer_class:   The class to use instead of the default ones
   *  * renderer_options: The options to pass to the renderer constructor
   *  * renderer:         A renderer widget (overrides the expanded and renderer_options options)
   *                      The choices option must be: new sfCallable($thisWidgetInstance, 'getChoices')
   * @param array $options     An array of options
   * @param array $attributes  An array of default HTML attributes
   *
   * @see sfWidgetForm
   */
    protected function configure($options = array(), $attributes = array())
    {
        //$this->addRequiredOption('link');
        
        $choices = array();
        $this->addOption('choices', $choices);
        parent::configure($options, $attributes );


        $traficos = Doctrine::getTable('Trafico')->createQuery('t')
                            ->where('t.ca_idtrafico != ?', '99-999')
                            ->addOrderBy('t.ca_nombre ASC')
                            ->execute();

        $choices = array();
        foreach( $traficos as $trafico ){
           $choices[$trafico->getCaIdtrafico()] = utf8_encode($trafico->getCaNombre());
        }

        $this->addOption('choicesCountry', $choices);
    }


  
    public function render($name, $value = null, $attributes = array(), $errors = array()){

        $country_name = "country_".$name;
        $country_id = $this->generateId($country_name);
        $id = $this->generateId($name);
        $choices = $this->getOption("choicesCountry");
        $html=  $this->renderContentTag('select', "\n".implode("\n", $this->getOptionsForSelect($value, $choices))."\n", array_merge(array('name' => $country_name, "id"=>$country_id, "onChange"=>"llenarCiudades('".$country_id."', '".$id."',false)" ), $attributes));
        
        
        $js2 ="";
        $js3 ="";
        if( $value ){
           

            $ciudad = Doctrine::getTable('Ciudad')->find($value);

            $ciudades = Doctrine::getTable('Ciudad')->createQuery('c')
                            ->where('c.ca_idtrafico = ?', $ciudad->getCaIdtrafico())
                            ->addOrderBy('c.ca_ciudad ASC')
                            ->execute();
            $choices = array();
            foreach( $ciudades as $ciudad ){
                $choices[$ciudad->getCaIdciudad()]=$ciudad->getCaCiudad();
            }
            $this->setOption('choices', $choices);


            $link = $this->getOption('link');
            $idtrafico = $ciudad->getCaIdtrafico();

            if( $value ){     
                $js2 = sprintf(<<<EOF
                            document.getElementById('$country_id').value = '$idtrafico';
EOF
);
            }
        }else{
            $js3 = sprintf(<<<EOF
                       llenarCiudades('$country_id', '$id',false);                                        
EOF
);           
        }


        $js = sprintf(<<<EOF
        <script type="text/javascript">
            $js2
            $js3
         </script>
EOF
);


        $html .= "<br /><br />".parent::render($name, $value, $attributes , $errors).$js;

        return $html;


    }





}
