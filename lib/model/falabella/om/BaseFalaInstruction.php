<?php


abstract class BaseFalaInstruction extends BaseObject  implements Persistent {


  const PEER = 'FalaInstructionPeer';

	
	protected static $peer;

	
	protected $ca_iddoc;

	
	protected $ca_instructions;

	
	protected $ca_idfalainstructions;

	
	protected $aFalaHeader;

	
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

	
	public function getCaIddoc()
	{
		return $this->ca_iddoc;
	}

	
	public function getCaInstructions()
	{
		return $this->ca_instructions;
	}

	
	public function getCaIdfalainstructions()
	{
		return $this->ca_idfalainstructions;
	}

	
	public function setCaIddoc($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_iddoc !== $v) {
			$this->ca_iddoc = $v;
			$this->modifiedColumns[] = FalaInstructionPeer::CA_IDDOC;
		}

		if ($this->aFalaHeader !== null && $this->aFalaHeader->getCaIddoc() !== $v) {
			$this->aFalaHeader = null;
		}

		return $this;
	} 
	
	public function setCaInstructions($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_instructions !== $v) {
			$this->ca_instructions = $v;
			$this->modifiedColumns[] = FalaInstructionPeer::CA_INSTRUCTIONS;
		}

		return $this;
	} 
	
	public function setCaIdfalainstructions($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idfalainstructions !== $v) {
			$this->ca_idfalainstructions = $v;
			$this->modifiedColumns[] = FalaInstructionPeer::CA_IDFALAINSTRUCTIONS;
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

			$this->ca_iddoc = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->ca_instructions = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_idfalainstructions = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating FalaInstruction object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aFalaHeader !== null && $this->ca_iddoc !== $this->aFalaHeader->getCaIddoc()) {
			$this->aFalaHeader = null;
		}
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
			$con = Propel::getConnection(FalaInstructionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = FalaInstructionPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aFalaHeader = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseFalaInstruction:delete:pre') as $callable)
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
			$con = Propel::getConnection(FalaInstructionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			FalaInstructionPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseFalaInstruction:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseFalaInstruction:save:pre') as $callable)
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
			$con = Propel::getConnection(FalaInstructionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseFalaInstruction:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			FalaInstructionPeer::addInstanceToPool($this);
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

												
			if ($this->aFalaHeader !== null) {
				if ($this->aFalaHeader->isModified() || $this->aFalaHeader->isNew()) {
					$affectedRows += $this->aFalaHeader->save($con);
				}
				$this->setFalaHeader($this->aFalaHeader);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = FalaInstructionPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += FalaInstructionPeer::doUpdate($this, $con);
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


												
			if ($this->aFalaHeader !== null) {
				if (!$this->aFalaHeader->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aFalaHeader->getValidationFailures());
				}
			}


			if (($retval = FalaInstructionPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = FalaInstructionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIddoc();
				break;
			case 1:
				return $this->getCaInstructions();
				break;
			case 2:
				return $this->getCaIdfalainstructions();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = FalaInstructionPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIddoc(),
			$keys[1] => $this->getCaInstructions(),
			$keys[2] => $this->getCaIdfalainstructions(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = FalaInstructionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIddoc($value);
				break;
			case 1:
				$this->setCaInstructions($value);
				break;
			case 2:
				$this->setCaIdfalainstructions($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = FalaInstructionPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIddoc($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaInstructions($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaIdfalainstructions($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(FalaInstructionPeer::DATABASE_NAME);

		if ($this->isColumnModified(FalaInstructionPeer::CA_IDDOC)) $criteria->add(FalaInstructionPeer::CA_IDDOC, $this->ca_iddoc);
		if ($this->isColumnModified(FalaInstructionPeer::CA_INSTRUCTIONS)) $criteria->add(FalaInstructionPeer::CA_INSTRUCTIONS, $this->ca_instructions);
		if ($this->isColumnModified(FalaInstructionPeer::CA_IDFALAINSTRUCTIONS)) $criteria->add(FalaInstructionPeer::CA_IDFALAINSTRUCTIONS, $this->ca_idfalainstructions);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(FalaInstructionPeer::DATABASE_NAME);

		$criteria->add(FalaInstructionPeer::CA_IDFALAINSTRUCTIONS, $this->ca_idfalainstructions);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaIdfalainstructions();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaIdfalainstructions($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIddoc($this->ca_iddoc);

		$copyObj->setCaInstructions($this->ca_instructions);

		$copyObj->setCaIdfalainstructions($this->ca_idfalainstructions);


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
			self::$peer = new FalaInstructionPeer();
		}
		return self::$peer;
	}

	
	public function setFalaHeader(FalaHeader $v = null)
	{
		if ($v === null) {
			$this->setCaIddoc(NULL);
		} else {
			$this->setCaIddoc($v->getCaIddoc());
		}

		$this->aFalaHeader = $v;

						if ($v !== null) {
			$v->addFalaInstruction($this);
		}

		return $this;
	}


	
	public function getFalaHeader(PropelPDO $con = null)
	{
		if ($this->aFalaHeader === null && (($this->ca_iddoc !== "" && $this->ca_iddoc !== null))) {
			$c = new Criteria(FalaHeaderPeer::DATABASE_NAME);
			$c->add(FalaHeaderPeer::CA_IDDOC, $this->ca_iddoc);
			$this->aFalaHeader = FalaHeaderPeer::doSelectOne($c, $con);
			
		}
		return $this->aFalaHeader;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
			$this->aFalaHeader = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseFalaInstruction:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseFalaInstruction::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 