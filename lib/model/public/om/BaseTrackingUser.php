<?php


abstract class BaseTrackingUser extends BaseObject  implements Persistent {


  const PEER = 'TrackingUserPeer';

	
	protected static $peer;

	
	protected $ca_email;

	
	protected $ca_blocked;

	
	protected $ca_activation_code;

	
	protected $ca_passwd;

	
	protected $ca_password_expiry;

	
	protected $ca_activated;

	
	protected $ca_idcontacto;

	
	protected $aContacto;

	
	protected $collTrackingUserLogs;

	
	private $lastTrackingUserLogCriteria = null;

	
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

	
	public function getCaEmail()
	{
		return $this->ca_email;
	}

	
	public function getCaBlocked()
	{
		return $this->ca_blocked;
	}

	
	public function getCaActivationCode()
	{
		return $this->ca_activation_code;
	}

	
	public function getCaPasswd()
	{
		return $this->ca_passwd;
	}

	
	public function getCaPasswordExpiry($format = 'Y-m-d')
	{
		if ($this->ca_password_expiry === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_password_expiry);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_password_expiry, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaActivated()
	{
		return $this->ca_activated;
	}

	
	public function getCaIdcontacto()
	{
		return $this->ca_idcontacto;
	}

	
	public function setCaEmail($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_email !== $v) {
			$this->ca_email = $v;
			$this->modifiedColumns[] = TrackingUserPeer::CA_EMAIL;
		}

		return $this;
	} 
	
	public function setCaBlocked($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->ca_blocked !== $v) {
			$this->ca_blocked = $v;
			$this->modifiedColumns[] = TrackingUserPeer::CA_BLOCKED;
		}

		return $this;
	} 
	
	public function setCaActivationCode($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_activation_code !== $v) {
			$this->ca_activation_code = $v;
			$this->modifiedColumns[] = TrackingUserPeer::CA_ACTIVATION_CODE;
		}

		return $this;
	} 
	
	public function setCaPasswd($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_passwd !== $v) {
			$this->ca_passwd = $v;
			$this->modifiedColumns[] = TrackingUserPeer::CA_PASSWD;
		}

		return $this;
	} 
	
	public function setCaPasswordExpiry($v)
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

		if ( $this->ca_password_expiry !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_password_expiry !== null && $tmpDt = new DateTime($this->ca_password_expiry)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_password_expiry = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = TrackingUserPeer::CA_PASSWORD_EXPIRY;
			}
		} 
		return $this;
	} 
	
	public function setCaActivated($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->ca_activated !== $v) {
			$this->ca_activated = $v;
			$this->modifiedColumns[] = TrackingUserPeer::CA_ACTIVATED;
		}

		return $this;
	} 
	
	public function setCaIdcontacto($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idcontacto !== $v) {
			$this->ca_idcontacto = $v;
			$this->modifiedColumns[] = TrackingUserPeer::CA_IDCONTACTO;
		}

		if ($this->aContacto !== null && $this->aContacto->getCaIdcontacto() !== $v) {
			$this->aContacto = null;
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

			$this->ca_email = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->ca_blocked = ($row[$startcol + 1] !== null) ? (boolean) $row[$startcol + 1] : null;
			$this->ca_activation_code = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_passwd = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_password_expiry = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_activated = ($row[$startcol + 5] !== null) ? (boolean) $row[$startcol + 5] : null;
			$this->ca_idcontacto = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 7; 
		} catch (Exception $e) {
			throw new PropelException("Error populating TrackingUser object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aContacto !== null && $this->ca_idcontacto !== $this->aContacto->getCaIdcontacto()) {
			$this->aContacto = null;
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
			$con = Propel::getConnection(TrackingUserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = TrackingUserPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aContacto = null;
			$this->collTrackingUserLogs = null;
			$this->lastTrackingUserLogCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseTrackingUser:delete:pre') as $callable)
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
			$con = Propel::getConnection(TrackingUserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			TrackingUserPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseTrackingUser:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseTrackingUser:save:pre') as $callable)
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
			$con = Propel::getConnection(TrackingUserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseTrackingUser:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			TrackingUserPeer::addInstanceToPool($this);
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

												
			if ($this->aContacto !== null) {
				if ($this->aContacto->isModified() || $this->aContacto->isNew()) {
					$affectedRows += $this->aContacto->save($con);
				}
				$this->setContacto($this->aContacto);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = TrackingUserPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += TrackingUserPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collTrackingUserLogs !== null) {
				foreach ($this->collTrackingUserLogs as $referrerFK) {
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


												
			if ($this->aContacto !== null) {
				if (!$this->aContacto->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aContacto->getValidationFailures());
				}
			}


			if (($retval = TrackingUserPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collTrackingUserLogs !== null) {
					foreach ($this->collTrackingUserLogs as $referrerFK) {
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
		$pos = TrackingUserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaEmail();
				break;
			case 1:
				return $this->getCaBlocked();
				break;
			case 2:
				return $this->getCaActivationCode();
				break;
			case 3:
				return $this->getCaPasswd();
				break;
			case 4:
				return $this->getCaPasswordExpiry();
				break;
			case 5:
				return $this->getCaActivated();
				break;
			case 6:
				return $this->getCaIdcontacto();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = TrackingUserPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaEmail(),
			$keys[1] => $this->getCaBlocked(),
			$keys[2] => $this->getCaActivationCode(),
			$keys[3] => $this->getCaPasswd(),
			$keys[4] => $this->getCaPasswordExpiry(),
			$keys[5] => $this->getCaActivated(),
			$keys[6] => $this->getCaIdcontacto(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TrackingUserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaEmail($value);
				break;
			case 1:
				$this->setCaBlocked($value);
				break;
			case 2:
				$this->setCaActivationCode($value);
				break;
			case 3:
				$this->setCaPasswd($value);
				break;
			case 4:
				$this->setCaPasswordExpiry($value);
				break;
			case 5:
				$this->setCaActivated($value);
				break;
			case 6:
				$this->setCaIdcontacto($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TrackingUserPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaEmail($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaBlocked($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaActivationCode($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaPasswd($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaPasswordExpiry($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaActivated($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaIdcontacto($arr[$keys[6]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(TrackingUserPeer::DATABASE_NAME);

		if ($this->isColumnModified(TrackingUserPeer::CA_EMAIL)) $criteria->add(TrackingUserPeer::CA_EMAIL, $this->ca_email);
		if ($this->isColumnModified(TrackingUserPeer::CA_BLOCKED)) $criteria->add(TrackingUserPeer::CA_BLOCKED, $this->ca_blocked);
		if ($this->isColumnModified(TrackingUserPeer::CA_ACTIVATION_CODE)) $criteria->add(TrackingUserPeer::CA_ACTIVATION_CODE, $this->ca_activation_code);
		if ($this->isColumnModified(TrackingUserPeer::CA_PASSWD)) $criteria->add(TrackingUserPeer::CA_PASSWD, $this->ca_passwd);
		if ($this->isColumnModified(TrackingUserPeer::CA_PASSWORD_EXPIRY)) $criteria->add(TrackingUserPeer::CA_PASSWORD_EXPIRY, $this->ca_password_expiry);
		if ($this->isColumnModified(TrackingUserPeer::CA_ACTIVATED)) $criteria->add(TrackingUserPeer::CA_ACTIVATED, $this->ca_activated);
		if ($this->isColumnModified(TrackingUserPeer::CA_IDCONTACTO)) $criteria->add(TrackingUserPeer::CA_IDCONTACTO, $this->ca_idcontacto);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(TrackingUserPeer::DATABASE_NAME);

		$criteria->add(TrackingUserPeer::CA_EMAIL, $this->ca_email);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaEmail();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaEmail($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaEmail($this->ca_email);

		$copyObj->setCaBlocked($this->ca_blocked);

		$copyObj->setCaActivationCode($this->ca_activation_code);

		$copyObj->setCaPasswd($this->ca_passwd);

		$copyObj->setCaPasswordExpiry($this->ca_password_expiry);

		$copyObj->setCaActivated($this->ca_activated);

		$copyObj->setCaIdcontacto($this->ca_idcontacto);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getTrackingUserLogs() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addTrackingUserLog($relObj->copy($deepCopy));
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
			self::$peer = new TrackingUserPeer();
		}
		return self::$peer;
	}

	
	public function setContacto(Contacto $v = null)
	{
		if ($v === null) {
			$this->setCaIdcontacto(NULL);
		} else {
			$this->setCaIdcontacto($v->getCaIdcontacto());
		}

		$this->aContacto = $v;

						if ($v !== null) {
			$v->addTrackingUser($this);
		}

		return $this;
	}


	
	public function getContacto(PropelPDO $con = null)
	{
		if ($this->aContacto === null && ($this->ca_idcontacto !== null)) {
			$c = new Criteria(ContactoPeer::DATABASE_NAME);
			$c->add(ContactoPeer::CA_IDCONTACTO, $this->ca_idcontacto);
			$this->aContacto = ContactoPeer::doSelectOne($c, $con);
			
		}
		return $this->aContacto;
	}

	
	public function clearTrackingUserLogs()
	{
		$this->collTrackingUserLogs = null; 	}

	
	public function initTrackingUserLogs()
	{
		$this->collTrackingUserLogs = array();
	}

	
	public function getTrackingUserLogs($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TrackingUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTrackingUserLogs === null) {
			if ($this->isNew()) {
			   $this->collTrackingUserLogs = array();
			} else {

				$criteria->add(TrackingUserLogPeer::CA_EMAIL, $this->ca_email);

				TrackingUserLogPeer::addSelectColumns($criteria);
				$this->collTrackingUserLogs = TrackingUserLogPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(TrackingUserLogPeer::CA_EMAIL, $this->ca_email);

				TrackingUserLogPeer::addSelectColumns($criteria);
				if (!isset($this->lastTrackingUserLogCriteria) || !$this->lastTrackingUserLogCriteria->equals($criteria)) {
					$this->collTrackingUserLogs = TrackingUserLogPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastTrackingUserLogCriteria = $criteria;
		return $this->collTrackingUserLogs;
	}

	
	public function countTrackingUserLogs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TrackingUserPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collTrackingUserLogs === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(TrackingUserLogPeer::CA_EMAIL, $this->ca_email);

				$count = TrackingUserLogPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(TrackingUserLogPeer::CA_EMAIL, $this->ca_email);

				if (!isset($this->lastTrackingUserLogCriteria) || !$this->lastTrackingUserLogCriteria->equals($criteria)) {
					$count = TrackingUserLogPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collTrackingUserLogs);
				}
			} else {
				$count = count($this->collTrackingUserLogs);
			}
		}
		return $count;
	}

	
	public function addTrackingUserLog(TrackingUserLog $l)
	{
		if ($this->collTrackingUserLogs === null) {
			$this->initTrackingUserLogs();
		}
		if (!in_array($l, $this->collTrackingUserLogs, true)) { 			array_push($this->collTrackingUserLogs, $l);
			$l->setTrackingUser($this);
		}
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collTrackingUserLogs) {
				foreach ((array) $this->collTrackingUserLogs as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collTrackingUserLogs = null;
			$this->aContacto = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseTrackingUser:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseTrackingUser::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 