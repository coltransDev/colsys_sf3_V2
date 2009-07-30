<?php
 
/**
 *
 * @author  Andres Botero
 */
 
class sfPropelActAsTraceableBehaviorPlugin
{
	
	/**
	 * If set to true, the *_by columns will be set, even if they're already
	 * marked as modified.
	 * 
	 * @see sfPropelActAsTraceableBehaviorPlugin::$default_updateEmptyColumn
	 *
	 * @var boolean
	 */
	public static $default_updateModifiedColumn = false;
	
	/**
	 * If set to true, the *_by columns will be set if they're empty, even if
	 * they're marked as modified.
	 * 
	 * @see sfPropelActAsTraceableBehaviorPlugin::$default_updateModifiedColumn
	 * 
	 * @var boolean
	 */
	public static $default_updateEmptyColumn = true;
	
	/**
	 * If set to true, the behavior will be enabled, even in CLI context
	 */
	public static $enabledInCLI = false;
	
	/**
	 * Is behavior enabled ?
	 *
	 * @var boolean
	 */
	protected static $_enabled = true;
	
	
	
	/**
	 * Is behavior enabled ?
	 *
	 * @return boolean
	 */
	public static function enabled()
	{
	  if (0 == strncasecmp(PHP_SAPI, 'cli', 3)) {
      // CLI
      return self::$enabledInCLI;
	  }
	  
		return self::$_enabled;
	}
	
	/**
	 * Disable behavior for the next save()
	 *
	 */
	public static function disable()
	{
		self::$_enabled = false;
	}
	
	/**
	 * Enable behavior
	 *
	 */
	public static function enable()
	{
		self::$_enabled = true;
	}
	
	/**
	 * Called before node is saved
	 *
	 * @param   BaseObject  $object
	 */
	public function preSave(BaseObject $object)
	{       
		// Automaticaly re-enable behavior
		if (!self::enabled()) {
			self::enable();
			return false;
		}
		
		// Get user from context, if available
		$user = sfContext::getInstance()->getUser();
		
		// Created by...
		if ($object->isNew()) {
            if( method_exists(get_class($object), 'setCaUsucreado') ){
                $object->setCaUsucreado($user);
            }
            if( method_exists(get_class($object), 'setCaFchcreado') ){
                $object->setCaFchcreado(time());
            }
		}else{
            if( method_exists(get_class($object), 'setCaUsuactualizado') ){
                $object->setCaUsuactualizado($user);
            }
            if( method_exists(get_class($object), 'setCaFchactualizado') ){
                $object->setCaFchactualizado(time());
            }
		}
	}
	
	/**
	 * Called before node is deleted
	 *
	 * @param   BaseObject  $object
	 */
	public function preDelete(BaseObject $object)
	{
		// Automaticaly re-enable behavior
		if (!self::enabled()) {
			self::enable();
			return false;
		}
		
		// Get user from context
		$user = sfContext::getInstance()->getUser();
		
		if( method_exists(get_class($object), 'setCaUsueliminado') ){
            $object->setCaUsueliminado($user);
        }
        if( method_exists(get_class($object), 'setCaFcheliminado') ){
            $object->setCaFcheliminado(time());
        }
	}


    public function doSelectStmt($class, $criteria, $con = null)
    {
        $columnName = 'ca_fcheliminado';        
        if (self::enabled()){
            $criteria->add(call_user_func(array($class, 'translateFieldName'), $columnName, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME), null, Criteria::ISNULL);
        }
        else{
            self::enable();
        }


        return false;
    }

     public function forceDelete($object, $con = null)
     {       
        $object->delete($con);
     }
	
}
