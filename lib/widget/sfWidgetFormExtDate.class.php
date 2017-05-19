<?php


/**
 * sfWidgetFormExtDate represents a date widget rendered by ExtJs.
 *
 * This widget needs ExtJs to work.
 *
 * @package    colsys
 * @subpackage widget
 * @author     Andres Botero
 * @version    SVN: $Id$
 */
class sfWidgetFormExtDate extends sfWidgetFormDate
{
  /**
   * Configures the current widget.
   *
   * Available options:
   *
   *  * image:   The image path to represent the widget (false by default)
   *  * config:  A JavaScript array that configures the JQuery date widget
   *  * culture: The user culture
   *
   * @param array $options     An array of options
   * @param array $attributes  An array of default HTML attributes
   *
   * @see sfWidgetForm
   */
  protected function configure($options = array(), $attributes = array())
  {
    $this->addOption('image', false);
    $this->addOption('config', '{}');
    $this->addOption('culture', '');

    parent::configure($options, $attributes);

    if ('en' == $this->getOption('culture'))
    {
      $this->setOption('culture', 'en');
    }
  }

  /**
   * @param  string $name        The element name
   * @param  string $value       The date displayed in this widget
   * @param  array  $attributes  An array of HTML attributes to be merged with the default HTML attributes
   * @param  array  $errors      An array of errors for the field
   *
   * @return string An HTML tag string
   *
   * @see sfWidgetForm
   */
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    $prefix = $this->generateId($name);
    $disabled = $attributes["disabled"]?$attributes["disabled"]:"false";
    
    return $this->renderTag('input', array('type' => 'text', 'size' => 10, 'id' => $id = $this->generateId($name).'_ext_control', 'name'=>$name )).
           sprintf(<<<EOF
<script type="text/javascript">
  
 		 new Ext.form.DateField({
				 applyTo: '%s',
				 value: '%s',
                 width: 100,
                 format: 'Y-m-d',
                 disabled: %s
			});
			
			/*
			*
			*/
  	
 
</script>
EOF
      ,
      $id,
      $value,
      $disabled
    );
  }
}
