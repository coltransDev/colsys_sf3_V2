<?php


abstract class BaseLogUsuario extends BaseObject  implements Persistent {


  const PEER = 'LogUsuarioPeer';

	
	protected static $peer;

	
	protected $ca_idlog;

	
	protected $ca_login;

	
	protected $ca_event;

	
	protected $ca_module;

	
	protected $ca_action;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	
	public function applyDefaultValues()
	{
	}

	
	public function getCaIdlog()
	{
		return $this->ca_idlog;
	}

	
	public function getCaLogin()
	{
		return $this->ca_login;
	}

	
	public function getCaEvent()
	{
		return $this->ca_event;
	}

	
	public function getCaModule()
	{
		return $this->ca_module;
	}

	
	public function getCaAction()
	{
		return $this->ca_action;
	}

	
	public function setCaIdlog($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idlog !== $v) {
			$this->ca_idlog = $v;
			$this->modifiedColumns[] = LogUsuarioPeer::CA_IDLOG;
		}

		return $this;
	} 
	
	public function setCaLogin($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_login !== $v) {
			$this->ca_login = $v;
			$this->modifiedColumns[] = LogUsuarioPeer::CA_LOGIN;
		}

		return $this;
	} 
	
	public function setCaEvent($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_event !== $v) {
			$this->ca_event = $v;
			$this->modifiedColumns[] = LogUsuarioPeer::CA_EVENT;
		}

		return $this;
	} 
	
	public function setCaModule($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_module !== $v) {
			$this->ca_module = $v;
			$this->modifiedColumns[] = LogUsuarioPeer::CA_MODULE;
		}

		return $this;
	} 
	
	public function setCaAction($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_action !== $v) {
			$this->ca_action = $v;
			$this->modifiedColumns[] = LogUsuarioPeer::CA_ACTION;
		}

		return $this;
	} 
	
	public function hasOnlyDefaultValues()
	{
						if (array_diff($this->modifiedColumns, array())) {
				return false;
			}

				return true;
	} 
	
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->ca_idlog = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_login = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_event = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_module = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_action = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating LogUsuario object", $e);
		}
	}

	
	public function ensureConsistency()
	{

	} 
	
	public function reload($deep = false, PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("Cannot reload a deleted object.");
		}

		if ($this->isNew()) {
			throw new PropelException("Cannot reload an unsaved object.");
		}

		if ($con === null) {
			$con = Propel::getConnection(LogUsuarioPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = LogUsuarioPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseLogUsuario:delete:pre') as $callable)
    {
      $ret = call_user_func($callable, $this, $con);
      if ($ret)
      {
        return;
      }
    }


		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(LogUsuarioPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			LogUsuarioPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseLogUsuario:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseLogUsuario:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(LogUsuarioPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseLogUsuario:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			LogUsuarioPeer::addInstanceToPool($this);
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	
	protected function doSave(PropelPDO $con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = LogUsuarioPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += LogUsuarioPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			$this->alreadyInSave = false;

		}
		return $affectedRows;
	} 
	
	protected $validationFailures = array();

	
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			if (($retval = LogUsuarioPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = LogUsuarioPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdlog();
				break;
			case 1:
				return $this->getCaLogin();
				break;
			case 2:
				return $this->getCaEvent();
				break;
			case 3:
				return $this->getCaModule();
				break;
			case 4:
				return $this->getCaAction();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = LogUsuarioPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdlog(),
			$keys[1] => $this->getCaLogin(),
			$keys[2] => $this->getCaEvent(),
			$keys[3] => $this->getCaModule(),
			$keys[4] => $this->getCaAction(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = LogUsuarioPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdlog($value);
				break;
			case 1:
				$this->setCaLogin($value);
				break;
			case 2:
				$this->setCaEvent($value);
				break;
			case 3:
				$this->setCaModule($value);
				break;
			case 4:
				$this->setCaAction($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = LogUsuarioPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdlog($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaLogin($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaEvent($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaModule($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaAction($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(LogUsuarioPeer::DATABASE_NAME);

		if ($this->isColumnModified(LogUsuarioPeer::CA_IDLOG)) $criteria->add(LogUsuarioPeer::CA_IDLOG, $this->ca_idlog);
		if ($this->isColumnModified(LogUsuarioPeer::CA_LOGIN)) $criteria->add(LogUsuarioPeer::CA_LOGIN, $this->ca_login);
		if ($this->isColumnModified(LogUsuarioPeer::CA_EVENT)) $criteria->add(LogUsuarioPeer::CA_EVENT, $this->ca_event);
		if ($this->isColumnModified(LogUsuarioPeer::CA_MODULE)) $criteria->add(LogUsuarioPeer::CA_MODULE, $this->ca_module);
		if ($this->isColumnModified(LogUsuarioPeer::CA_ACTION)) $criteria->add(LogUsuarioPeer::CA_ACTION, $this->ca_action);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(LogUsuarioPeer::DATABASE_NAME);

		$criteria->add(LogUsuarioPeer::CA_IDLOG, $this->ca_idlog);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaIdlog();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaIdlog($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdlog($this->ca_idlog);

		$copyObj->setCaLogin($this->ca_login);

		$copyObj->setCaEvent($this->ca_event);

		$copyObj->setCaModule($this->ca_module);

		$copyObj->setCaAction($this->ca_action);


		$copyObj->setNew(true);

	}

	
	public function copy($deepCopy = false)
	{
				$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new LogUsuarioPeer();
		}
		return self::$peer;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseLogUsuario:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseLogUsuario::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 