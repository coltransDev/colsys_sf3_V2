<?php


abstract class BaseTrackingUserLog extends BaseObject  implements Persistent {


  const PEER = 'TrackingUserLogPeer';

	
	protected static $peer;

	
	protected $ca_id;

	
	protected $ca_email;

	
	protected $ca_fchevento;

	
	protected $ca_url;

	
	protected $ca_evento;

	
	protected $ca_ipaddress;

	
	protected $ca_useragent;

	
	protected $aTrackingUser;

	
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

	
	public function getCaId()
	{
		return $this->ca_id;
	}

	
	public function getCaEmail()
	{
		return $this->ca_email;
	}

	
	public function getCaFchevento($format = 'Y-m-d H:i:s')
	{
		if ($this->ca_fchevento === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchevento);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchevento, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaUrl()
	{
		return $this->ca_url;
	}

	
	public function getCaEvento()
	{
		return $this->ca_evento;
	}

	
	public function getCaIpaddress()
	{
		return $this->ca_ipaddress;
	}

	
	public function getCaUseragent()
	{
		return $this->ca_useragent;
	}

	
	public function setCaId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_id !== $v) {
			$this->ca_id = $v;
			$this->modifiedColumns[] = TrackingUserLogPeer::CA_ID;
		}

		return $this;
	} 
	
	public function setCaEmail($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_email !== $v) {
			$this->ca_email = $v;
			$this->modifiedColumns[] = TrackingUserLogPeer::CA_EMAIL;
		}

		if ($this->aTrackingUser !== null && $this->aTrackingUser->getCaEmail() !== $v) {
			$this->aTrackingUser = null;
		}

		return $this;
	} 
	
	public function setCaFchevento($v)
	{
						if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
									try {
				if (is_numeric($v)) { 					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
															$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->ca_fchevento !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchevento !== null && $tmpDt = new DateTime($this->ca_fchevento)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchevento = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = TrackingUserLogPeer::CA_FCHEVENTO;
			}
		} 
		return $this;
	} 
	
	public function setCaUrl($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_url !== $v) {
			$this->ca_url = $v;
			$this->modifiedColumns[] = TrackingUserLogPeer::CA_URL;
		}

		return $this;
	} 
	
	public function setCaEvento($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_evento !== $v) {
			$this->ca_evento = $v;
			$this->modifiedColumns[] = TrackingUserLogPeer::CA_EVENTO;
		}

		return $this;
	} 
	
	public function setCaIpaddress($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_ipaddress !== $v) {
			$this->ca_ipaddress = $v;
			$this->modifiedColumns[] = TrackingUserLogPeer::CA_IPADDRESS;
		}

		return $this;
	} 
	
	public function setCaUseragent($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_useragent !== $v) {
			$this->ca_useragent = $v;
			$this->modifiedColumns[] = TrackingUserLogPeer::CA_USERAGENT;
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

			$this->ca_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_email = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_fchevento = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_url = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_evento = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_ipaddress = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_useragent = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 7; 
		} catch (Exception $e) {
			throw new PropelException("Error populating TrackingUserLog object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aTrackingUser !== null && $this->ca_email !== $this->aTrackingUser->getCaEmail()) {
			$this->aTrackingUser = null;
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
			$con = Propel::getConnection(TrackingUserLogPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = TrackingUserLogPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aTrackingUser = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseTrackingUserLog:delete:pre') as $callable)
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
			$con = Propel::getConnection(TrackingUserLogPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			TrackingUserLogPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseTrackingUserLog:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseTrackingUserLog:save:pre') as $callable)
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
			$con = Propel::getConnection(TrackingUserLogPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseTrackingUserLog:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			TrackingUserLogPeer::addInstanceToPool($this);
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

												
			if ($this->aTrackingUser !== null) {
				if ($this->aTrackingUser->isModified() || $this->aTrackingUser->isNew()) {
					$affectedRows += $this->aTrackingUser->save($con);
				}
				$this->setTrackingUser($this->aTrackingUser);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = TrackingUserLogPeer::CA_ID;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = TrackingUserLogPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setCaId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += TrackingUserLogPeer::doUpdate($this, $con);
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


												
			if ($this->aTrackingUser !== null) {
				if (!$this->aTrackingUser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTrackingUser->getValidationFailures());
				}
			}


			if (($retval = TrackingUserLogPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TrackingUserLogPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaId();
				break;
			case 1:
				return $this->getCaEmail();
				break;
			case 2:
				return $this->getCaFchevento();
				break;
			case 3:
				return $this->getCaUrl();
				break;
			case 4:
				return $this->getCaEvento();
				break;
			case 5:
				return $this->getCaIpaddress();
				break;
			case 6:
				return $this->getCaUseragent();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = TrackingUserLogPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaId(),
			$keys[1] => $this->getCaEmail(),
			$keys[2] => $this->getCaFchevento(),
			$keys[3] => $this->getCaUrl(),
			$keys[4] => $this->getCaEvento(),
			$keys[5] => $this->getCaIpaddress(),
			$keys[6] => $this->getCaUseragent(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TrackingUserLogPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaId($value);
				break;
			case 1:
				$this->setCaEmail($value);
				break;
			case 2:
				$this->setCaFchevento($value);
				break;
			case 3:
				$this->setCaUrl($value);
				break;
			case 4:
				$this->setCaEvento($value);
				break;
			case 5:
				$this->setCaIpaddress($value);
				break;
			case 6:
				$this->setCaUseragent($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TrackingUserLogPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaEmail($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaFchevento($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaUrl($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaEvento($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaIpaddress($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaUseragent($arr[$keys[6]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(TrackingUserLogPeer::DATABASE_NAME);

		if ($this->isColumnModified(TrackingUserLogPeer::CA_ID)) $criteria->add(TrackingUserLogPeer::CA_ID, $this->ca_id);
		if ($this->isColumnModified(TrackingUserLogPeer::CA_EMAIL)) $criteria->add(TrackingUserLogPeer::CA_EMAIL, $this->ca_email);
		if ($this->isColumnModified(TrackingUserLogPeer::CA_FCHEVENTO)) $criteria->add(TrackingUserLogPeer::CA_FCHEVENTO, $this->ca_fchevento);
		if ($this->isColumnModified(TrackingUserLogPeer::CA_URL)) $criteria->add(TrackingUserLogPeer::CA_URL, $this->ca_url);
		if ($this->isColumnModified(TrackingUserLogPeer::CA_EVENTO)) $criteria->add(TrackingUserLogPeer::CA_EVENTO, $this->ca_evento);
		if ($this->isColumnModified(TrackingUserLogPeer::CA_IPADDRESS)) $criteria->add(TrackingUserLogPeer::CA_IPADDRESS, $this->ca_ipaddress);
		if ($this->isColumnModified(TrackingUserLogPeer::CA_USERAGENT)) $criteria->add(TrackingUserLogPeer::CA_USERAGENT, $this->ca_useragent);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(TrackingUserLogPeer::DATABASE_NAME);

		$criteria->add(TrackingUserLogPeer::CA_ID, $this->ca_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaEmail($this->ca_email);

		$copyObj->setCaFchevento($this->ca_fchevento);

		$copyObj->setCaUrl($this->ca_url);

		$copyObj->setCaEvento($this->ca_evento);

		$copyObj->setCaIpaddress($this->ca_ipaddress);

		$copyObj->setCaUseragent($this->ca_useragent);


		$copyObj->setNew(true);

		$copyObj->setCaId(NULL); 
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
			self::$peer = new TrackingUserLogPeer();
		}
		return self::$peer;
	}

	
	public function setTrackingUser(TrackingUser $v = null)
	{
		if ($v === null) {
			$this->setCaEmail(NULL);
		} else {
			$this->setCaEmail($v->getCaEmail());
		}

		$this->aTrackingUser = $v;

						if ($v !== null) {
			$v->addTrackingUserLog($this);
		}

		return $this;
	}


	
	public function getTrackingUser(PropelPDO $con = null)
	{
		if ($this->aTrackingUser === null && (($this->ca_email !== "" && $this->ca_email !== null))) {
			$c = new Criteria(TrackingUserPeer::DATABASE_NAME);
			$c->add(TrackingUserPeer::CA_EMAIL, $this->ca_email);
			$this->aTrackingUser = TrackingUserPeer::doSelectOne($c, $con);
			
		}
		return $this->aTrackingUser;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
			$this->aTrackingUser = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseTrackingUserLog:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseTrackingUserLog::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 