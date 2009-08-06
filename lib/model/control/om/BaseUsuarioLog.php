<?php


abstract class BaseUsuarioLog extends BaseObject  implements Persistent {


  const PEER = 'UsuarioLogPeer';

	
	protected static $peer;

	
	protected $ca_id;

	
	protected $ca_login;

	
	protected $ca_fchevento;

	
	protected $ca_url;

	
	protected $ca_event;

	
	protected $ca_ipaddress;

	
	protected $ca_useragent;

	
	protected $aUsuario;

	
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

	
	public function getCaLogin()
	{
		return $this->ca_login;
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

	
	public function getCaEvent()
	{
		return $this->ca_event;
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
			$this->modifiedColumns[] = UsuarioLogPeer::CA_ID;
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
			$this->modifiedColumns[] = UsuarioLogPeer::CA_LOGIN;
		}

		if ($this->aUsuario !== null && $this->aUsuario->getCaLogin() !== $v) {
			$this->aUsuario = null;
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
				$this->modifiedColumns[] = UsuarioLogPeer::CA_FCHEVENTO;
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
			$this->modifiedColumns[] = UsuarioLogPeer::CA_URL;
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
			$this->modifiedColumns[] = UsuarioLogPeer::CA_EVENT;
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
			$this->modifiedColumns[] = UsuarioLogPeer::CA_IPADDRESS;
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
			$this->modifiedColumns[] = UsuarioLogPeer::CA_USERAGENT;
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
			$this->ca_login = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_fchevento = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_url = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_event = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_ipaddress = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_useragent = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 7; 
		} catch (Exception $e) {
			throw new PropelException("Error populating UsuarioLog object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aUsuario !== null && $this->ca_login !== $this->aUsuario->getCaLogin()) {
			$this->aUsuario = null;
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
			$con = Propel::getConnection(UsuarioLogPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = UsuarioLogPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aUsuario = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseUsuarioLog:delete:pre') as $callable)
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
			$con = Propel::getConnection(UsuarioLogPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			UsuarioLogPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseUsuarioLog:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseUsuarioLog:save:pre') as $callable)
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
			$con = Propel::getConnection(UsuarioLogPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseUsuarioLog:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			UsuarioLogPeer::addInstanceToPool($this);
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

												
			if ($this->aUsuario !== null) {
				if ($this->aUsuario->isModified() || $this->aUsuario->isNew()) {
					$affectedRows += $this->aUsuario->save($con);
				}
				$this->setUsuario($this->aUsuario);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = UsuarioLogPeer::CA_ID;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = UsuarioLogPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setCaId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += UsuarioLogPeer::doUpdate($this, $con);
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


												
			if ($this->aUsuario !== null) {
				if (!$this->aUsuario->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUsuario->getValidationFailures());
				}
			}


			if (($retval = UsuarioLogPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = UsuarioLogPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaLogin();
				break;
			case 2:
				return $this->getCaFchevento();
				break;
			case 3:
				return $this->getCaUrl();
				break;
			case 4:
				return $this->getCaEvent();
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
		$keys = UsuarioLogPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaId(),
			$keys[1] => $this->getCaLogin(),
			$keys[2] => $this->getCaFchevento(),
			$keys[3] => $this->getCaUrl(),
			$keys[4] => $this->getCaEvent(),
			$keys[5] => $this->getCaIpaddress(),
			$keys[6] => $this->getCaUseragent(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = UsuarioLogPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaId($value);
				break;
			case 1:
				$this->setCaLogin($value);
				break;
			case 2:
				$this->setCaFchevento($value);
				break;
			case 3:
				$this->setCaUrl($value);
				break;
			case 4:
				$this->setCaEvent($value);
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
		$keys = UsuarioLogPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaLogin($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaFchevento($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaUrl($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaEvent($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaIpaddress($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaUseragent($arr[$keys[6]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(UsuarioLogPeer::DATABASE_NAME);

		if ($this->isColumnModified(UsuarioLogPeer::CA_ID)) $criteria->add(UsuarioLogPeer::CA_ID, $this->ca_id);
		if ($this->isColumnModified(UsuarioLogPeer::CA_LOGIN)) $criteria->add(UsuarioLogPeer::CA_LOGIN, $this->ca_login);
		if ($this->isColumnModified(UsuarioLogPeer::CA_FCHEVENTO)) $criteria->add(UsuarioLogPeer::CA_FCHEVENTO, $this->ca_fchevento);
		if ($this->isColumnModified(UsuarioLogPeer::CA_URL)) $criteria->add(UsuarioLogPeer::CA_URL, $this->ca_url);
		if ($this->isColumnModified(UsuarioLogPeer::CA_EVENT)) $criteria->add(UsuarioLogPeer::CA_EVENT, $this->ca_event);
		if ($this->isColumnModified(UsuarioLogPeer::CA_IPADDRESS)) $criteria->add(UsuarioLogPeer::CA_IPADDRESS, $this->ca_ipaddress);
		if ($this->isColumnModified(UsuarioLogPeer::CA_USERAGENT)) $criteria->add(UsuarioLogPeer::CA_USERAGENT, $this->ca_useragent);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(UsuarioLogPeer::DATABASE_NAME);

		$criteria->add(UsuarioLogPeer::CA_ID, $this->ca_id);

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

		$copyObj->setCaLogin($this->ca_login);

		$copyObj->setCaFchevento($this->ca_fchevento);

		$copyObj->setCaUrl($this->ca_url);

		$copyObj->setCaEvent($this->ca_event);

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
			self::$peer = new UsuarioLogPeer();
		}
		return self::$peer;
	}

	
	public function setUsuario(Usuario $v = null)
	{
		if ($v === null) {
			$this->setCaLogin(NULL);
		} else {
			$this->setCaLogin($v->getCaLogin());
		}

		$this->aUsuario = $v;

						if ($v !== null) {
			$v->addUsuarioLog($this);
		}

		return $this;
	}


	
	public function getUsuario(PropelPDO $con = null)
	{
		if ($this->aUsuario === null && (($this->ca_login !== "" && $this->ca_login !== null))) {
			$c = new Criteria(UsuarioPeer::DATABASE_NAME);
			$c->add(UsuarioPeer::CA_LOGIN, $this->ca_login);
			$this->aUsuario = UsuarioPeer::doSelectOne($c, $con);
			
		}
		return $this->aUsuario;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
			$this->aUsuario = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseUsuarioLog:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseUsuarioLog::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 