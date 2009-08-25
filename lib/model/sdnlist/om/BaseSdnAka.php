<?php


abstract class BaseSdnAka extends BaseObject  implements Persistent {


  const PEER = 'SdnAkaPeer';

	
	protected static $peer;

	
	protected $ca_uid;

	
	protected $ca_uid_aka;

	
	protected $ca_type;

	
	protected $ca_category;

	
	protected $ca_firstname;

	
	protected $ca_lastname;

	
	protected $aSdn;

	
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

	
	public function getCaUid()
	{
		return $this->ca_uid;
	}

	
	public function getCaUidAka()
	{
		return $this->ca_uid_aka;
	}

	
	public function getCaType()
	{
		return $this->ca_type;
	}

	
	public function getCaCategory()
	{
		return $this->ca_category;
	}

	
	public function getCaFirstname()
	{
		return $this->ca_firstname;
	}

	
	public function getCaLastname()
	{
		return $this->ca_lastname;
	}

	
	public function setCaUid($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_uid !== $v) {
			$this->ca_uid = $v;
			$this->modifiedColumns[] = SdnAkaPeer::CA_UID;
		}

		if ($this->aSdn !== null && $this->aSdn->getCaUid() !== $v) {
			$this->aSdn = null;
		}

		return $this;
	} 
	
	public function setCaUidAka($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_uid_aka !== $v) {
			$this->ca_uid_aka = $v;
			$this->modifiedColumns[] = SdnAkaPeer::CA_UID_AKA;
		}

		return $this;
	} 
	
	public function setCaType($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_type !== $v) {
			$this->ca_type = $v;
			$this->modifiedColumns[] = SdnAkaPeer::CA_TYPE;
		}

		return $this;
	} 
	
	public function setCaCategory($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_category !== $v) {
			$this->ca_category = $v;
			$this->modifiedColumns[] = SdnAkaPeer::CA_CATEGORY;
		}

		return $this;
	} 
	
	public function setCaFirstname($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_firstname !== $v) {
			$this->ca_firstname = $v;
			$this->modifiedColumns[] = SdnAkaPeer::CA_FIRSTNAME;
		}

		return $this;
	} 
	
	public function setCaLastname($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_lastname !== $v) {
			$this->ca_lastname = $v;
			$this->modifiedColumns[] = SdnAkaPeer::CA_LASTNAME;
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

			$this->ca_uid = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->ca_uid_aka = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_type = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_category = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_firstname = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_lastname = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating SdnAka object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aSdn !== null && $this->ca_uid !== $this->aSdn->getCaUid()) {
			$this->aSdn = null;
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
			$con = Propel::getConnection(SdnAkaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = SdnAkaPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aSdn = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseSdnAka:delete:pre') as $callable)
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
			$con = Propel::getConnection(SdnAkaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			SdnAkaPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseSdnAka:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseSdnAka:save:pre') as $callable)
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
			$con = Propel::getConnection(SdnAkaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseSdnAka:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			SdnAkaPeer::addInstanceToPool($this);
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

												
			if ($this->aSdn !== null) {
				if ($this->aSdn->isModified() || $this->aSdn->isNew()) {
					$affectedRows += $this->aSdn->save($con);
				}
				$this->setSdn($this->aSdn);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = SdnAkaPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += SdnAkaPeer::doUpdate($this, $con);
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


												
			if ($this->aSdn !== null) {
				if (!$this->aSdn->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSdn->getValidationFailures());
				}
			}


			if (($retval = SdnAkaPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SdnAkaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaUid();
				break;
			case 1:
				return $this->getCaUidAka();
				break;
			case 2:
				return $this->getCaType();
				break;
			case 3:
				return $this->getCaCategory();
				break;
			case 4:
				return $this->getCaFirstname();
				break;
			case 5:
				return $this->getCaLastname();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = SdnAkaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaUid(),
			$keys[1] => $this->getCaUidAka(),
			$keys[2] => $this->getCaType(),
			$keys[3] => $this->getCaCategory(),
			$keys[4] => $this->getCaFirstname(),
			$keys[5] => $this->getCaLastname(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SdnAkaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaUid($value);
				break;
			case 1:
				$this->setCaUidAka($value);
				break;
			case 2:
				$this->setCaType($value);
				break;
			case 3:
				$this->setCaCategory($value);
				break;
			case 4:
				$this->setCaFirstname($value);
				break;
			case 5:
				$this->setCaLastname($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SdnAkaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaUid($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaUidAka($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaType($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaCategory($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaFirstname($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaLastname($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(SdnAkaPeer::DATABASE_NAME);

		if ($this->isColumnModified(SdnAkaPeer::CA_UID)) $criteria->add(SdnAkaPeer::CA_UID, $this->ca_uid);
		if ($this->isColumnModified(SdnAkaPeer::CA_UID_AKA)) $criteria->add(SdnAkaPeer::CA_UID_AKA, $this->ca_uid_aka);
		if ($this->isColumnModified(SdnAkaPeer::CA_TYPE)) $criteria->add(SdnAkaPeer::CA_TYPE, $this->ca_type);
		if ($this->isColumnModified(SdnAkaPeer::CA_CATEGORY)) $criteria->add(SdnAkaPeer::CA_CATEGORY, $this->ca_category);
		if ($this->isColumnModified(SdnAkaPeer::CA_FIRSTNAME)) $criteria->add(SdnAkaPeer::CA_FIRSTNAME, $this->ca_firstname);
		if ($this->isColumnModified(SdnAkaPeer::CA_LASTNAME)) $criteria->add(SdnAkaPeer::CA_LASTNAME, $this->ca_lastname);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(SdnAkaPeer::DATABASE_NAME);

		$criteria->add(SdnAkaPeer::CA_UID, $this->ca_uid);
		$criteria->add(SdnAkaPeer::CA_UID_AKA, $this->ca_uid_aka);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getCaUid();

		$pks[1] = $this->getCaUidAka();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setCaUid($keys[0]);

		$this->setCaUidAka($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaUid($this->ca_uid);

		$copyObj->setCaUidAka($this->ca_uid_aka);

		$copyObj->setCaType($this->ca_type);

		$copyObj->setCaCategory($this->ca_category);

		$copyObj->setCaFirstname($this->ca_firstname);

		$copyObj->setCaLastname($this->ca_lastname);


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
			self::$peer = new SdnAkaPeer();
		}
		return self::$peer;
	}

	
	public function setSdn(Sdn $v = null)
	{
		if ($v === null) {
			$this->setCaUid(NULL);
		} else {
			$this->setCaUid($v->getCaUid());
		}

		$this->aSdn = $v;

						if ($v !== null) {
			$v->addSdnAka($this);
		}

		return $this;
	}


	
	public function getSdn(PropelPDO $con = null)
	{
		if ($this->aSdn === null && (($this->ca_uid !== "" && $this->ca_uid !== null))) {
			$c = new Criteria(SdnPeer::DATABASE_NAME);
			$c->add(SdnPeer::CA_UID, $this->ca_uid);
			$this->aSdn = SdnPeer::doSelectOne($c, $con);
			
		}
		return $this->aSdn;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
			$this->aSdn = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseSdnAka:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseSdnAka::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 