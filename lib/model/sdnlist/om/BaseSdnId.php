<?php


abstract class BaseSdnId extends BaseObject  implements Persistent {


  const PEER = 'SdnIdPeer';

	
	protected static $peer;

	
	protected $ca_uid;

	
	protected $ca_uid_id;

	
	protected $ca_idtype;

	
	protected $ca_idnumber;

	
	protected $ca_idcountry;

	
	protected $ca_issuedate;

	
	protected $ca_expirationdate;

	
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

	
	public function getCaUidId()
	{
		return $this->ca_uid_id;
	}

	
	public function getCaIdtype()
	{
		return $this->ca_idtype;
	}

	
	public function getCaIdnumber()
	{
		return $this->ca_idnumber;
	}

	
	public function getCaIdcountry()
	{
		return $this->ca_idcountry;
	}

	
	public function getCaIssuedate()
	{
		return $this->ca_issuedate;
	}

	
	public function getCaExpirationdate()
	{
		return $this->ca_expirationdate;
	}

	
	public function setCaUid($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_uid !== $v) {
			$this->ca_uid = $v;
			$this->modifiedColumns[] = SdnIdPeer::CA_UID;
		}

		if ($this->aSdn !== null && $this->aSdn->getCaUid() !== $v) {
			$this->aSdn = null;
		}

		return $this;
	} 
	
	public function setCaUidId($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_uid_id !== $v) {
			$this->ca_uid_id = $v;
			$this->modifiedColumns[] = SdnIdPeer::CA_UID_ID;
		}

		return $this;
	} 
	
	public function setCaIdtype($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idtype !== $v) {
			$this->ca_idtype = $v;
			$this->modifiedColumns[] = SdnIdPeer::CA_IDTYPE;
		}

		return $this;
	} 
	
	public function setCaIdnumber($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idnumber !== $v) {
			$this->ca_idnumber = $v;
			$this->modifiedColumns[] = SdnIdPeer::CA_IDNUMBER;
		}

		return $this;
	} 
	
	public function setCaIdcountry($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idcountry !== $v) {
			$this->ca_idcountry = $v;
			$this->modifiedColumns[] = SdnIdPeer::CA_IDCOUNTRY;
		}

		return $this;
	} 
	
	public function setCaIssuedate($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_issuedate !== $v) {
			$this->ca_issuedate = $v;
			$this->modifiedColumns[] = SdnIdPeer::CA_ISSUEDATE;
		}

		return $this;
	} 
	
	public function setCaExpirationdate($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_expirationdate !== $v) {
			$this->ca_expirationdate = $v;
			$this->modifiedColumns[] = SdnIdPeer::CA_EXPIRATIONDATE;
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
			$this->ca_uid_id = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_idtype = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_idnumber = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_idcountry = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_issuedate = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_expirationdate = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 7; 
		} catch (Exception $e) {
			throw new PropelException("Error populating SdnId object", $e);
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
			$con = Propel::getConnection(SdnIdPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = SdnIdPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
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

    foreach (sfMixer::getCallables('BaseSdnId:delete:pre') as $callable)
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
			$con = Propel::getConnection(SdnIdPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			SdnIdPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseSdnId:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseSdnId:save:pre') as $callable)
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
			$con = Propel::getConnection(SdnIdPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseSdnId:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			SdnIdPeer::addInstanceToPool($this);
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
					$pk = SdnIdPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += SdnIdPeer::doUpdate($this, $con);
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


			if (($retval = SdnIdPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SdnIdPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaUidId();
				break;
			case 2:
				return $this->getCaIdtype();
				break;
			case 3:
				return $this->getCaIdnumber();
				break;
			case 4:
				return $this->getCaIdcountry();
				break;
			case 5:
				return $this->getCaIssuedate();
				break;
			case 6:
				return $this->getCaExpirationdate();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = SdnIdPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaUid(),
			$keys[1] => $this->getCaUidId(),
			$keys[2] => $this->getCaIdtype(),
			$keys[3] => $this->getCaIdnumber(),
			$keys[4] => $this->getCaIdcountry(),
			$keys[5] => $this->getCaIssuedate(),
			$keys[6] => $this->getCaExpirationdate(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SdnIdPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaUid($value);
				break;
			case 1:
				$this->setCaUidId($value);
				break;
			case 2:
				$this->setCaIdtype($value);
				break;
			case 3:
				$this->setCaIdnumber($value);
				break;
			case 4:
				$this->setCaIdcountry($value);
				break;
			case 5:
				$this->setCaIssuedate($value);
				break;
			case 6:
				$this->setCaExpirationdate($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SdnIdPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaUid($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaUidId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaIdtype($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaIdnumber($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaIdcountry($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaIssuedate($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaExpirationdate($arr[$keys[6]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(SdnIdPeer::DATABASE_NAME);

		if ($this->isColumnModified(SdnIdPeer::CA_UID)) $criteria->add(SdnIdPeer::CA_UID, $this->ca_uid);
		if ($this->isColumnModified(SdnIdPeer::CA_UID_ID)) $criteria->add(SdnIdPeer::CA_UID_ID, $this->ca_uid_id);
		if ($this->isColumnModified(SdnIdPeer::CA_IDTYPE)) $criteria->add(SdnIdPeer::CA_IDTYPE, $this->ca_idtype);
		if ($this->isColumnModified(SdnIdPeer::CA_IDNUMBER)) $criteria->add(SdnIdPeer::CA_IDNUMBER, $this->ca_idnumber);
		if ($this->isColumnModified(SdnIdPeer::CA_IDCOUNTRY)) $criteria->add(SdnIdPeer::CA_IDCOUNTRY, $this->ca_idcountry);
		if ($this->isColumnModified(SdnIdPeer::CA_ISSUEDATE)) $criteria->add(SdnIdPeer::CA_ISSUEDATE, $this->ca_issuedate);
		if ($this->isColumnModified(SdnIdPeer::CA_EXPIRATIONDATE)) $criteria->add(SdnIdPeer::CA_EXPIRATIONDATE, $this->ca_expirationdate);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(SdnIdPeer::DATABASE_NAME);

		$criteria->add(SdnIdPeer::CA_UID, $this->ca_uid);
		$criteria->add(SdnIdPeer::CA_UID_ID, $this->ca_uid_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getCaUid();

		$pks[1] = $this->getCaUidId();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setCaUid($keys[0]);

		$this->setCaUidId($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaUid($this->ca_uid);

		$copyObj->setCaUidId($this->ca_uid_id);

		$copyObj->setCaIdtype($this->ca_idtype);

		$copyObj->setCaIdnumber($this->ca_idnumber);

		$copyObj->setCaIdcountry($this->ca_idcountry);

		$copyObj->setCaIssuedate($this->ca_issuedate);

		$copyObj->setCaExpirationdate($this->ca_expirationdate);


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
			self::$peer = new SdnIdPeer();
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
			$v->addSdnId($this);
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
    if (!$callable = sfMixer::getCallable('BaseSdnId:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseSdnId::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 