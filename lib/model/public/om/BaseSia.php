<?php


abstract class BaseSia extends BaseObject  implements Persistent {


  const PEER = 'SiaPeer';

	
	protected static $peer;

	
	protected $ca_idsia;

	
	protected $ca_nombre;

	
	protected $ca_tel;

	
	protected $ca_contacto;

	
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

	
	public function getCaIdsia()
	{
		return $this->ca_idsia;
	}

	
	public function getCaNombre()
	{
		return $this->ca_nombre;
	}

	
	public function getCaTel()
	{
		return $this->ca_tel;
	}

	
	public function getCaContacto()
	{
		return $this->ca_contacto;
	}

	
	public function setCaIdsia($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idsia !== $v) {
			$this->ca_idsia = $v;
			$this->modifiedColumns[] = SiaPeer::CA_IDSIA;
		}

		return $this;
	} 
	
	public function setCaNombre($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_nombre !== $v) {
			$this->ca_nombre = $v;
			$this->modifiedColumns[] = SiaPeer::CA_NOMBRE;
		}

		return $this;
	} 
	
	public function setCaTel($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_tel !== $v) {
			$this->ca_tel = $v;
			$this->modifiedColumns[] = SiaPeer::CA_TEL;
		}

		return $this;
	} 
	
	public function setCaContacto($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_contacto !== $v) {
			$this->ca_contacto = $v;
			$this->modifiedColumns[] = SiaPeer::CA_CONTACTO;
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

			$this->ca_idsia = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_nombre = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_tel = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_contacto = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Sia object", $e);
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
			$con = Propel::getConnection(SiaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = SiaPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
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

    foreach (sfMixer::getCallables('BaseSia:delete:pre') as $callable)
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
			$con = Propel::getConnection(SiaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			SiaPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseSia:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseSia:save:pre') as $callable)
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
			$con = Propel::getConnection(SiaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseSia:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			SiaPeer::addInstanceToPool($this);
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

			if ($this->isNew() ) {
				$this->modifiedColumns[] = SiaPeer::CA_IDSIA;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = SiaPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setCaIdsia($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += SiaPeer::doUpdate($this, $con);
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


			if (($retval = SiaPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SiaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdsia();
				break;
			case 1:
				return $this->getCaNombre();
				break;
			case 2:
				return $this->getCaTel();
				break;
			case 3:
				return $this->getCaContacto();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = SiaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdsia(),
			$keys[1] => $this->getCaNombre(),
			$keys[2] => $this->getCaTel(),
			$keys[3] => $this->getCaContacto(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SiaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdsia($value);
				break;
			case 1:
				$this->setCaNombre($value);
				break;
			case 2:
				$this->setCaTel($value);
				break;
			case 3:
				$this->setCaContacto($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SiaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdsia($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaNombre($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaTel($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaContacto($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(SiaPeer::DATABASE_NAME);

		if ($this->isColumnModified(SiaPeer::CA_IDSIA)) $criteria->add(SiaPeer::CA_IDSIA, $this->ca_idsia);
		if ($this->isColumnModified(SiaPeer::CA_NOMBRE)) $criteria->add(SiaPeer::CA_NOMBRE, $this->ca_nombre);
		if ($this->isColumnModified(SiaPeer::CA_TEL)) $criteria->add(SiaPeer::CA_TEL, $this->ca_tel);
		if ($this->isColumnModified(SiaPeer::CA_CONTACTO)) $criteria->add(SiaPeer::CA_CONTACTO, $this->ca_contacto);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(SiaPeer::DATABASE_NAME);

		$criteria->add(SiaPeer::CA_IDSIA, $this->ca_idsia);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaIdsia();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaIdsia($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaNombre($this->ca_nombre);

		$copyObj->setCaTel($this->ca_tel);

		$copyObj->setCaContacto($this->ca_contacto);


		$copyObj->setNew(true);

		$copyObj->setCaIdsia(NULL); 
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
			self::$peer = new SiaPeer();
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
    if (!$callable = sfMixer::getCallable('BaseSia:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseSia::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 