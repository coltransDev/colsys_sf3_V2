<?php


abstract class BaseSdnAddress extends BaseObject  implements Persistent {


  const PEER = 'SdnAddressPeer';

	
	protected static $peer;

	
	protected $ca_uid;

	
	protected $ca_uid_address;

	
	protected $ca_address1;

	
	protected $ca_address2;

	
	protected $ca_address3;

	
	protected $ca_city;

	
	protected $ca_state;

	
	protected $ca_postal;

	
	protected $ca_country;

	
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

	
	public function getCaUidAddress()
	{
		return $this->ca_uid_address;
	}

	
	public function getCaAddress1()
	{
		return $this->ca_address1;
	}

	
	public function getCaAddress2()
	{
		return $this->ca_address2;
	}

	
	public function getCaAddress3()
	{
		return $this->ca_address3;
	}

	
	public function getCaCity()
	{
		return $this->ca_city;
	}

	
	public function getCaState()
	{
		return $this->ca_state;
	}

	
	public function getCaPostal()
	{
		return $this->ca_postal;
	}

	
	public function getCaCountry()
	{
		return $this->ca_country;
	}

	
	public function setCaUid($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_uid !== $v) {
			$this->ca_uid = $v;
			$this->modifiedColumns[] = SdnAddressPeer::CA_UID;
		}

		if ($this->aSdn !== null && $this->aSdn->getCaUid() !== $v) {
			$this->aSdn = null;
		}

		return $this;
	} 
	
	public function setCaUidAddress($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_uid_address !== $v) {
			$this->ca_uid_address = $v;
			$this->modifiedColumns[] = SdnAddressPeer::CA_UID_ADDRESS;
		}

		return $this;
	} 
	
	public function setCaAddress1($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_address1 !== $v) {
			$this->ca_address1 = $v;
			$this->modifiedColumns[] = SdnAddressPeer::CA_ADDRESS1;
		}

		return $this;
	} 
	
	public function setCaAddress2($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_address2 !== $v) {
			$this->ca_address2 = $v;
			$this->modifiedColumns[] = SdnAddressPeer::CA_ADDRESS2;
		}

		return $this;
	} 
	
	public function setCaAddress3($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_address3 !== $v) {
			$this->ca_address3 = $v;
			$this->modifiedColumns[] = SdnAddressPeer::CA_ADDRESS3;
		}

		return $this;
	} 
	
	public function setCaCity($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_city !== $v) {
			$this->ca_city = $v;
			$this->modifiedColumns[] = SdnAddressPeer::CA_CITY;
		}

		return $this;
	} 
	
	public function setCaState($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_state !== $v) {
			$this->ca_state = $v;
			$this->modifiedColumns[] = SdnAddressPeer::CA_STATE;
		}

		return $this;
	} 
	
	public function setCaPostal($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_postal !== $v) {
			$this->ca_postal = $v;
			$this->modifiedColumns[] = SdnAddressPeer::CA_POSTAL;
		}

		return $this;
	} 
	
	public function setCaCountry($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_country !== $v) {
			$this->ca_country = $v;
			$this->modifiedColumns[] = SdnAddressPeer::CA_COUNTRY;
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
			$this->ca_uid_address = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_address1 = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_address2 = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_address3 = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_city = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_state = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_postal = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_country = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 9; 
		} catch (Exception $e) {
			throw new PropelException("Error populating SdnAddress object", $e);
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
			$con = Propel::getConnection(SdnAddressPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = SdnAddressPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
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

    foreach (sfMixer::getCallables('BaseSdnAddress:delete:pre') as $callable)
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
			$con = Propel::getConnection(SdnAddressPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			SdnAddressPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseSdnAddress:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseSdnAddress:save:pre') as $callable)
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
			$con = Propel::getConnection(SdnAddressPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseSdnAddress:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			SdnAddressPeer::addInstanceToPool($this);
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
					$pk = SdnAddressPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += SdnAddressPeer::doUpdate($this, $con);
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


			if (($retval = SdnAddressPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SdnAddressPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaUidAddress();
				break;
			case 2:
				return $this->getCaAddress1();
				break;
			case 3:
				return $this->getCaAddress2();
				break;
			case 4:
				return $this->getCaAddress3();
				break;
			case 5:
				return $this->getCaCity();
				break;
			case 6:
				return $this->getCaState();
				break;
			case 7:
				return $this->getCaPostal();
				break;
			case 8:
				return $this->getCaCountry();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = SdnAddressPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaUid(),
			$keys[1] => $this->getCaUidAddress(),
			$keys[2] => $this->getCaAddress1(),
			$keys[3] => $this->getCaAddress2(),
			$keys[4] => $this->getCaAddress3(),
			$keys[5] => $this->getCaCity(),
			$keys[6] => $this->getCaState(),
			$keys[7] => $this->getCaPostal(),
			$keys[8] => $this->getCaCountry(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SdnAddressPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaUid($value);
				break;
			case 1:
				$this->setCaUidAddress($value);
				break;
			case 2:
				$this->setCaAddress1($value);
				break;
			case 3:
				$this->setCaAddress2($value);
				break;
			case 4:
				$this->setCaAddress3($value);
				break;
			case 5:
				$this->setCaCity($value);
				break;
			case 6:
				$this->setCaState($value);
				break;
			case 7:
				$this->setCaPostal($value);
				break;
			case 8:
				$this->setCaCountry($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SdnAddressPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaUid($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaUidAddress($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaAddress1($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaAddress2($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaAddress3($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaCity($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaState($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaPostal($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaCountry($arr[$keys[8]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(SdnAddressPeer::DATABASE_NAME);

		if ($this->isColumnModified(SdnAddressPeer::CA_UID)) $criteria->add(SdnAddressPeer::CA_UID, $this->ca_uid);
		if ($this->isColumnModified(SdnAddressPeer::CA_UID_ADDRESS)) $criteria->add(SdnAddressPeer::CA_UID_ADDRESS, $this->ca_uid_address);
		if ($this->isColumnModified(SdnAddressPeer::CA_ADDRESS1)) $criteria->add(SdnAddressPeer::CA_ADDRESS1, $this->ca_address1);
		if ($this->isColumnModified(SdnAddressPeer::CA_ADDRESS2)) $criteria->add(SdnAddressPeer::CA_ADDRESS2, $this->ca_address2);
		if ($this->isColumnModified(SdnAddressPeer::CA_ADDRESS3)) $criteria->add(SdnAddressPeer::CA_ADDRESS3, $this->ca_address3);
		if ($this->isColumnModified(SdnAddressPeer::CA_CITY)) $criteria->add(SdnAddressPeer::CA_CITY, $this->ca_city);
		if ($this->isColumnModified(SdnAddressPeer::CA_STATE)) $criteria->add(SdnAddressPeer::CA_STATE, $this->ca_state);
		if ($this->isColumnModified(SdnAddressPeer::CA_POSTAL)) $criteria->add(SdnAddressPeer::CA_POSTAL, $this->ca_postal);
		if ($this->isColumnModified(SdnAddressPeer::CA_COUNTRY)) $criteria->add(SdnAddressPeer::CA_COUNTRY, $this->ca_country);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(SdnAddressPeer::DATABASE_NAME);

		$criteria->add(SdnAddressPeer::CA_UID, $this->ca_uid);
		$criteria->add(SdnAddressPeer::CA_UID_ADDRESS, $this->ca_uid_address);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getCaUid();

		$pks[1] = $this->getCaUidAddress();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setCaUid($keys[0]);

		$this->setCaUidAddress($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaUid($this->ca_uid);

		$copyObj->setCaUidAddress($this->ca_uid_address);

		$copyObj->setCaAddress1($this->ca_address1);

		$copyObj->setCaAddress2($this->ca_address2);

		$copyObj->setCaAddress3($this->ca_address3);

		$copyObj->setCaCity($this->ca_city);

		$copyObj->setCaState($this->ca_state);

		$copyObj->setCaPostal($this->ca_postal);

		$copyObj->setCaCountry($this->ca_country);


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
			self::$peer = new SdnAddressPeer();
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
			$v->addSdnAddress($this);
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
    if (!$callable = sfMixer::getCallable('BaseSdnAddress:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseSdnAddress::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 