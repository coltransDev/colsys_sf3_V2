<?php


abstract class BaseSdn extends BaseObject  implements Persistent {


  const PEER = 'SdnPeer';

	
	protected static $peer;

	
	protected $ca_uid;

	
	protected $ca_firstname;

	
	protected $ca_lastname;

	
	protected $ca_title;

	
	protected $ca_sdntype;

	
	protected $ca_remarks;

	
	protected $collSdnIds;

	
	private $lastSdnIdCriteria = null;

	
	protected $collSdnAkas;

	
	private $lastSdnAkaCriteria = null;

	
	protected $collSdnAddresss;

	
	private $lastSdnAddressCriteria = null;

	
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

	
	public function getCaFirstname()
	{
		return $this->ca_firstname;
	}

	
	public function getCaLastname()
	{
		return $this->ca_lastname;
	}

	
	public function getCaTitle()
	{
		return $this->ca_title;
	}

	
	public function getCaSdntype()
	{
		return $this->ca_sdntype;
	}

	
	public function getCaRemarks()
	{
		return $this->ca_remarks;
	}

	
	public function setCaUid($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_uid !== $v) {
			$this->ca_uid = $v;
			$this->modifiedColumns[] = SdnPeer::CA_UID;
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
			$this->modifiedColumns[] = SdnPeer::CA_FIRSTNAME;
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
			$this->modifiedColumns[] = SdnPeer::CA_LASTNAME;
		}

		return $this;
	} 
	
	public function setCaTitle($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_title !== $v) {
			$this->ca_title = $v;
			$this->modifiedColumns[] = SdnPeer::CA_TITLE;
		}

		return $this;
	} 
	
	public function setCaSdntype($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_sdntype !== $v) {
			$this->ca_sdntype = $v;
			$this->modifiedColumns[] = SdnPeer::CA_SDNTYPE;
		}

		return $this;
	} 
	
	public function setCaRemarks($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_remarks !== $v) {
			$this->ca_remarks = $v;
			$this->modifiedColumns[] = SdnPeer::CA_REMARKS;
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
			$this->ca_firstname = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_lastname = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_title = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_sdntype = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_remarks = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Sdn object", $e);
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
			$con = Propel::getConnection(SdnPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = SdnPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->collSdnIds = null;
			$this->lastSdnIdCriteria = null;

			$this->collSdnAkas = null;
			$this->lastSdnAkaCriteria = null;

			$this->collSdnAddresss = null;
			$this->lastSdnAddressCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseSdn:delete:pre') as $callable)
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
			$con = Propel::getConnection(SdnPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			SdnPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseSdn:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseSdn:save:pre') as $callable)
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
			$con = Propel::getConnection(SdnPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseSdn:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			SdnPeer::addInstanceToPool($this);
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
					$pk = SdnPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += SdnPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collSdnIds !== null) {
				foreach ($this->collSdnIds as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSdnAkas !== null) {
				foreach ($this->collSdnAkas as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSdnAddresss !== null) {
				foreach ($this->collSdnAddresss as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

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


			if (($retval = SdnPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collSdnIds !== null) {
					foreach ($this->collSdnIds as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSdnAkas !== null) {
					foreach ($this->collSdnAkas as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSdnAddresss !== null) {
					foreach ($this->collSdnAddresss as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SdnPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaFirstname();
				break;
			case 2:
				return $this->getCaLastname();
				break;
			case 3:
				return $this->getCaTitle();
				break;
			case 4:
				return $this->getCaSdntype();
				break;
			case 5:
				return $this->getCaRemarks();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = SdnPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaUid(),
			$keys[1] => $this->getCaFirstname(),
			$keys[2] => $this->getCaLastname(),
			$keys[3] => $this->getCaTitle(),
			$keys[4] => $this->getCaSdntype(),
			$keys[5] => $this->getCaRemarks(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SdnPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaUid($value);
				break;
			case 1:
				$this->setCaFirstname($value);
				break;
			case 2:
				$this->setCaLastname($value);
				break;
			case 3:
				$this->setCaTitle($value);
				break;
			case 4:
				$this->setCaSdntype($value);
				break;
			case 5:
				$this->setCaRemarks($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SdnPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaUid($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaFirstname($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaLastname($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaTitle($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaSdntype($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaRemarks($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(SdnPeer::DATABASE_NAME);

		if ($this->isColumnModified(SdnPeer::CA_UID)) $criteria->add(SdnPeer::CA_UID, $this->ca_uid);
		if ($this->isColumnModified(SdnPeer::CA_FIRSTNAME)) $criteria->add(SdnPeer::CA_FIRSTNAME, $this->ca_firstname);
		if ($this->isColumnModified(SdnPeer::CA_LASTNAME)) $criteria->add(SdnPeer::CA_LASTNAME, $this->ca_lastname);
		if ($this->isColumnModified(SdnPeer::CA_TITLE)) $criteria->add(SdnPeer::CA_TITLE, $this->ca_title);
		if ($this->isColumnModified(SdnPeer::CA_SDNTYPE)) $criteria->add(SdnPeer::CA_SDNTYPE, $this->ca_sdntype);
		if ($this->isColumnModified(SdnPeer::CA_REMARKS)) $criteria->add(SdnPeer::CA_REMARKS, $this->ca_remarks);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(SdnPeer::DATABASE_NAME);

		$criteria->add(SdnPeer::CA_UID, $this->ca_uid);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaUid();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaUid($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaUid($this->ca_uid);

		$copyObj->setCaFirstname($this->ca_firstname);

		$copyObj->setCaLastname($this->ca_lastname);

		$copyObj->setCaTitle($this->ca_title);

		$copyObj->setCaSdntype($this->ca_sdntype);

		$copyObj->setCaRemarks($this->ca_remarks);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getSdnIds() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addSdnId($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getSdnAkas() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addSdnAka($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getSdnAddresss() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addSdnAddress($relObj->copy($deepCopy));
				}
			}

		} 

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
			self::$peer = new SdnPeer();
		}
		return self::$peer;
	}

	
	public function clearSdnIds()
	{
		$this->collSdnIds = null; 	}

	
	public function initSdnIds()
	{
		$this->collSdnIds = array();
	}

	
	public function getSdnIds($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(SdnPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSdnIds === null) {
			if ($this->isNew()) {
			   $this->collSdnIds = array();
			} else {

				$criteria->add(SdnIdPeer::CA_UID, $this->ca_uid);

				SdnIdPeer::addSelectColumns($criteria);
				$this->collSdnIds = SdnIdPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(SdnIdPeer::CA_UID, $this->ca_uid);

				SdnIdPeer::addSelectColumns($criteria);
				if (!isset($this->lastSdnIdCriteria) || !$this->lastSdnIdCriteria->equals($criteria)) {
					$this->collSdnIds = SdnIdPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSdnIdCriteria = $criteria;
		return $this->collSdnIds;
	}

	
	public function countSdnIds(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(SdnPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collSdnIds === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(SdnIdPeer::CA_UID, $this->ca_uid);

				$count = SdnIdPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(SdnIdPeer::CA_UID, $this->ca_uid);

				if (!isset($this->lastSdnIdCriteria) || !$this->lastSdnIdCriteria->equals($criteria)) {
					$count = SdnIdPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collSdnIds);
				}
			} else {
				$count = count($this->collSdnIds);
			}
		}
		return $count;
	}

	
	public function addSdnId(SdnId $l)
	{
		if ($this->collSdnIds === null) {
			$this->initSdnIds();
		}
		if (!in_array($l, $this->collSdnIds, true)) { 			array_push($this->collSdnIds, $l);
			$l->setSdn($this);
		}
	}

	
	public function clearSdnAkas()
	{
		$this->collSdnAkas = null; 	}

	
	public function initSdnAkas()
	{
		$this->collSdnAkas = array();
	}

	
	public function getSdnAkas($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(SdnPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSdnAkas === null) {
			if ($this->isNew()) {
			   $this->collSdnAkas = array();
			} else {

				$criteria->add(SdnAkaPeer::CA_UID, $this->ca_uid);

				SdnAkaPeer::addSelectColumns($criteria);
				$this->collSdnAkas = SdnAkaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(SdnAkaPeer::CA_UID, $this->ca_uid);

				SdnAkaPeer::addSelectColumns($criteria);
				if (!isset($this->lastSdnAkaCriteria) || !$this->lastSdnAkaCriteria->equals($criteria)) {
					$this->collSdnAkas = SdnAkaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSdnAkaCriteria = $criteria;
		return $this->collSdnAkas;
	}

	
	public function countSdnAkas(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(SdnPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collSdnAkas === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(SdnAkaPeer::CA_UID, $this->ca_uid);

				$count = SdnAkaPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(SdnAkaPeer::CA_UID, $this->ca_uid);

				if (!isset($this->lastSdnAkaCriteria) || !$this->lastSdnAkaCriteria->equals($criteria)) {
					$count = SdnAkaPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collSdnAkas);
				}
			} else {
				$count = count($this->collSdnAkas);
			}
		}
		return $count;
	}

	
	public function addSdnAka(SdnAka $l)
	{
		if ($this->collSdnAkas === null) {
			$this->initSdnAkas();
		}
		if (!in_array($l, $this->collSdnAkas, true)) { 			array_push($this->collSdnAkas, $l);
			$l->setSdn($this);
		}
	}

	
	public function clearSdnAddresss()
	{
		$this->collSdnAddresss = null; 	}

	
	public function initSdnAddresss()
	{
		$this->collSdnAddresss = array();
	}

	
	public function getSdnAddresss($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(SdnPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSdnAddresss === null) {
			if ($this->isNew()) {
			   $this->collSdnAddresss = array();
			} else {

				$criteria->add(SdnAddressPeer::CA_UID, $this->ca_uid);

				SdnAddressPeer::addSelectColumns($criteria);
				$this->collSdnAddresss = SdnAddressPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(SdnAddressPeer::CA_UID, $this->ca_uid);

				SdnAddressPeer::addSelectColumns($criteria);
				if (!isset($this->lastSdnAddressCriteria) || !$this->lastSdnAddressCriteria->equals($criteria)) {
					$this->collSdnAddresss = SdnAddressPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSdnAddressCriteria = $criteria;
		return $this->collSdnAddresss;
	}

	
	public function countSdnAddresss(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(SdnPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collSdnAddresss === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(SdnAddressPeer::CA_UID, $this->ca_uid);

				$count = SdnAddressPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(SdnAddressPeer::CA_UID, $this->ca_uid);

				if (!isset($this->lastSdnAddressCriteria) || !$this->lastSdnAddressCriteria->equals($criteria)) {
					$count = SdnAddressPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collSdnAddresss);
				}
			} else {
				$count = count($this->collSdnAddresss);
			}
		}
		return $count;
	}

	
	public function addSdnAddress(SdnAddress $l)
	{
		if ($this->collSdnAddresss === null) {
			$this->initSdnAddresss();
		}
		if (!in_array($l, $this->collSdnAddresss, true)) { 			array_push($this->collSdnAddresss, $l);
			$l->setSdn($this);
		}
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collSdnIds) {
				foreach ((array) $this->collSdnIds as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collSdnAkas) {
				foreach ((array) $this->collSdnAkas as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collSdnAddresss) {
				foreach ((array) $this->collSdnAddresss as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collSdnIds = null;
		$this->collSdnAkas = null;
		$this->collSdnAddresss = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseSdn:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseSdn::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 