<?php


abstract class BaseRepStatusRespuesta extends BaseObject  implements Persistent {


  const PEER = 'RepStatusRespuestaPeer';

	
	protected static $peer;

	
	protected $ca_idrepstatusrespuestas;

	
	protected $ca_idstatus;

	
	protected $ca_respuesta;

	
	protected $ca_email;

	
	protected $ca_login;

	
	protected $ca_fchcreado;

	
	protected $aRepStatus;

	
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

	
	public function getCaIdrepstatusrespuestas()
	{
		return $this->ca_idrepstatusrespuestas;
	}

	
	public function getCaIdstatus()
	{
		return $this->ca_idstatus;
	}

	
	public function getCaRespuesta()
	{
		return $this->ca_respuesta;
	}

	
	public function getCaEmail()
	{
		return $this->ca_email;
	}

	
	public function getCaLogin()
	{
		return $this->ca_login;
	}

	
	public function getCaFchcreado($format = 'Y-m-d H:i:s')
	{
		if ($this->ca_fchcreado === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchcreado);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchcreado, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function setCaIdrepstatusrespuestas($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idrepstatusrespuestas !== $v) {
			$this->ca_idrepstatusrespuestas = $v;
			$this->modifiedColumns[] = RepStatusRespuestaPeer::CA_IDREPSTATUSRESPUESTAS;
		}

		return $this;
	} 
	
	public function setCaIdstatus($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idstatus !== $v) {
			$this->ca_idstatus = $v;
			$this->modifiedColumns[] = RepStatusRespuestaPeer::CA_IDSTATUS;
		}

		if ($this->aRepStatus !== null && $this->aRepStatus->getCaIdstatus() !== $v) {
			$this->aRepStatus = null;
		}

		return $this;
	} 
	
	public function setCaRespuesta($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_respuesta !== $v) {
			$this->ca_respuesta = $v;
			$this->modifiedColumns[] = RepStatusRespuestaPeer::CA_RESPUESTA;
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
			$this->modifiedColumns[] = RepStatusRespuestaPeer::CA_EMAIL;
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
			$this->modifiedColumns[] = RepStatusRespuestaPeer::CA_LOGIN;
		}

		if ($this->aUsuario !== null && $this->aUsuario->getCaLogin() !== $v) {
			$this->aUsuario = null;
		}

		return $this;
	} 
	
	public function setCaFchcreado($v)
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

		if ( $this->ca_fchcreado !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchcreado !== null && $tmpDt = new DateTime($this->ca_fchcreado)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchcreado = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = RepStatusRespuestaPeer::CA_FCHCREADO;
			}
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

			$this->ca_idrepstatusrespuestas = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_idstatus = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_respuesta = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_email = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_login = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_fchcreado = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating RepStatusRespuesta object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aRepStatus !== null && $this->ca_idstatus !== $this->aRepStatus->getCaIdstatus()) {
			$this->aRepStatus = null;
		}
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
			$con = Propel::getConnection(RepStatusRespuestaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = RepStatusRespuestaPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aRepStatus = null;
			$this->aUsuario = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseRepStatusRespuesta:delete:pre') as $callable)
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
			$con = Propel::getConnection(RepStatusRespuestaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			RepStatusRespuestaPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseRepStatusRespuesta:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseRepStatusRespuesta:save:pre') as $callable)
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
			$con = Propel::getConnection(RepStatusRespuestaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseRepStatusRespuesta:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			RepStatusRespuestaPeer::addInstanceToPool($this);
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

												
			if ($this->aRepStatus !== null) {
				if ($this->aRepStatus->isModified() || $this->aRepStatus->isNew()) {
					$affectedRows += $this->aRepStatus->save($con);
				}
				$this->setRepStatus($this->aRepStatus);
			}

			if ($this->aUsuario !== null) {
				if ($this->aUsuario->isModified() || $this->aUsuario->isNew()) {
					$affectedRows += $this->aUsuario->save($con);
				}
				$this->setUsuario($this->aUsuario);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = RepStatusRespuestaPeer::CA_IDREPSTATUSRESPUESTAS;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = RepStatusRespuestaPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setCaIdrepstatusrespuestas($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += RepStatusRespuestaPeer::doUpdate($this, $con);
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


												
			if ($this->aRepStatus !== null) {
				if (!$this->aRepStatus->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aRepStatus->getValidationFailures());
				}
			}

			if ($this->aUsuario !== null) {
				if (!$this->aUsuario->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUsuario->getValidationFailures());
				}
			}


			if (($retval = RepStatusRespuestaPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RepStatusRespuestaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdrepstatusrespuestas();
				break;
			case 1:
				return $this->getCaIdstatus();
				break;
			case 2:
				return $this->getCaRespuesta();
				break;
			case 3:
				return $this->getCaEmail();
				break;
			case 4:
				return $this->getCaLogin();
				break;
			case 5:
				return $this->getCaFchcreado();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = RepStatusRespuestaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdrepstatusrespuestas(),
			$keys[1] => $this->getCaIdstatus(),
			$keys[2] => $this->getCaRespuesta(),
			$keys[3] => $this->getCaEmail(),
			$keys[4] => $this->getCaLogin(),
			$keys[5] => $this->getCaFchcreado(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RepStatusRespuestaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdrepstatusrespuestas($value);
				break;
			case 1:
				$this->setCaIdstatus($value);
				break;
			case 2:
				$this->setCaRespuesta($value);
				break;
			case 3:
				$this->setCaEmail($value);
				break;
			case 4:
				$this->setCaLogin($value);
				break;
			case 5:
				$this->setCaFchcreado($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = RepStatusRespuestaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdrepstatusrespuestas($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdstatus($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaRespuesta($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaEmail($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaLogin($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaFchcreado($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(RepStatusRespuestaPeer::DATABASE_NAME);

		if ($this->isColumnModified(RepStatusRespuestaPeer::CA_IDREPSTATUSRESPUESTAS)) $criteria->add(RepStatusRespuestaPeer::CA_IDREPSTATUSRESPUESTAS, $this->ca_idrepstatusrespuestas);
		if ($this->isColumnModified(RepStatusRespuestaPeer::CA_IDSTATUS)) $criteria->add(RepStatusRespuestaPeer::CA_IDSTATUS, $this->ca_idstatus);
		if ($this->isColumnModified(RepStatusRespuestaPeer::CA_RESPUESTA)) $criteria->add(RepStatusRespuestaPeer::CA_RESPUESTA, $this->ca_respuesta);
		if ($this->isColumnModified(RepStatusRespuestaPeer::CA_EMAIL)) $criteria->add(RepStatusRespuestaPeer::CA_EMAIL, $this->ca_email);
		if ($this->isColumnModified(RepStatusRespuestaPeer::CA_LOGIN)) $criteria->add(RepStatusRespuestaPeer::CA_LOGIN, $this->ca_login);
		if ($this->isColumnModified(RepStatusRespuestaPeer::CA_FCHCREADO)) $criteria->add(RepStatusRespuestaPeer::CA_FCHCREADO, $this->ca_fchcreado);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(RepStatusRespuestaPeer::DATABASE_NAME);

		$criteria->add(RepStatusRespuestaPeer::CA_IDREPSTATUSRESPUESTAS, $this->ca_idrepstatusrespuestas);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaIdrepstatusrespuestas();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaIdrepstatusrespuestas($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdstatus($this->ca_idstatus);

		$copyObj->setCaRespuesta($this->ca_respuesta);

		$copyObj->setCaEmail($this->ca_email);

		$copyObj->setCaLogin($this->ca_login);

		$copyObj->setCaFchcreado($this->ca_fchcreado);


		$copyObj->setNew(true);

		$copyObj->setCaIdrepstatusrespuestas(NULL); 
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
			self::$peer = new RepStatusRespuestaPeer();
		}
		return self::$peer;
	}

	
	public function setRepStatus(RepStatus $v = null)
	{
		if ($v === null) {
			$this->setCaIdstatus(NULL);
		} else {
			$this->setCaIdstatus($v->getCaIdstatus());
		}

		$this->aRepStatus = $v;

						if ($v !== null) {
			$v->addRepStatusRespuesta($this);
		}

		return $this;
	}


	
	public function getRepStatus(PropelPDO $con = null)
	{
		if ($this->aRepStatus === null && ($this->ca_idstatus !== null)) {
			$c = new Criteria(RepStatusPeer::DATABASE_NAME);
			$c->add(RepStatusPeer::CA_IDSTATUS, $this->ca_idstatus);
			$this->aRepStatus = RepStatusPeer::doSelectOne($c, $con);
			
		}
		return $this->aRepStatus;
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
			$v->addRepStatusRespuesta($this);
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
			$this->aRepStatus = null;
			$this->aUsuario = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseRepStatusRespuesta:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseRepStatusRespuesta::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 