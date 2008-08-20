<?php

/**
 * sfWidgetFormObjectSelect represents a select HTML tag for a model.
 *
 * @package    symfony
 * @subpackage widget
 * @author     Andres Botero <abotero@coltrans.com.co>
 * @version    SVN: $Id$
 */
class sfWidgetFormObjectSelect extends sfWidgetFormSelect
{
  /**
   * @see sfWidget
   */
  public function __construct($options = array(), $attributes = array())
  {
    $options['choices'] = new sfCallable(array($this, 'getChoices'));

    parent::__construct($options, $attributes);
  }

  /**
   * Constructor.
   *
   * Available options:
   *
   *  * objects:      Objects set 
   *  * add_empty:  Whether to add a first empty value or not (false by default)
   *                If the option is not a Boolean, the value will be used as the text value
   *  * method:     The method to use to display object values (__toString by default)
   *  * id:   An array composed of two fields:
   *                  * The column to order by the results (must be in the PhpName format)
   *                  * asc or desc
   *  * selected:   Selected object by default
   *  * multiple:   true if the select tag must allow multiple selections
   *
   * @see sfWidgetFormSelect
   */
  protected function configure($options = array(), $attributes = array())
  {
    $this->addRequiredOption('objects');
    $this->addOption('add_empty', false);
    $this->addOption('method', '__toString');
    $this->addOption('value', 'getPrimaryKey');
    $this->addOption('selected', null);    
    $this->addOption('multiple', false);

    parent::configure($options, $attributes);
  }

  /**
   * Returns the choices associated to the model.
   *
   * @return array An array of choices
   */
  public function getChoices()
  {
    $choices = array();
    if (false !== $this->getOption('add_empty'))
    {
      $choices[''] = true === $this->getOption('add_empty') ? '' : $this->getOption('add_empty');
    }

   

    $method = $this->getOption('method');
	$value = $this->getOption('value');
	
	$objects = $this->getOption('objects');
    foreach ($objects as $object)
    {
      $choices[$object->$value()] = $object->$method();
    }

    return $choices;
  }

  public function __clone()
  {
    $this->setOption('choices', new sfCallable(array($this, 'getChoices')));
  }
}
