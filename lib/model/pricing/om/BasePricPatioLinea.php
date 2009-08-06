<?php


abstract class BasePricPatioLinea extends BaseObject  implements Persistent {


  const PEER = 'PricPatioLineaPeer';

	
	protected static $peer;

	
	protected $ca_idpatio;

	
	protected $ca_idlinea;

	
	protected $ca_transporte;

	
	protected $ca_modalidad;

	
	protected $ca_impoexpo;

	
	protected $ca_observaciones;

	
	protected $aPricPatio;

	
	protected $aTransportador;

	
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

	
	public function getCaIdpatio()
	{
		return $this->ca_idpatio;
	}

	
	public function getCaIdlinea()
	{
		return $this->ca_idlinea;
	}

	
	public function getCaTransporte()
	{
		return $this->ca_transporte;
	}

	
	public function getCaModalidad()
	{
		return $this->ca_modalidad;
	}

	
	public function getCaImpoexpo()
	{
		return $this->ca_impoexpo;
	}

	
	public function getCaObservaciones()
	{
		return $this->ca_observaciones;
	}

	
	public function setCaIdpatio($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idpatio !== $v) {
			$this->ca_idpatio = $v;
			$this->modifiedColumns[] = PricPatioLineaPeer::CA_IDPATIO;
		}

		if ($this->aPricPatio !== null && $this->aPricPatio->getCaIdpatio() !== $v) {
			$this->aPricPatio = null;
		}

		return $this;
	} 
	
	public function setCaIdlinea($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idlinea !== $v) {
			$this->ca_idlinea = $v;
			$this->modifiedColumns[] = PricPatioLineaPeer::CA_IDLINEA;
		}

		if ($this->aTransportador !== null && $this->aTransportador->getCaIdlinea() !== $v) {
			$this->aTransportador = null;
		}

		return $this;
	} 
	
	public function setCaTransporte($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_transporte !== $v) {
			$this->ca_transporte = $v;
			$this->modifiedColumns[] = PricPatioLineaPeer::CA_TRANSPORTE;
		}

		return $this;
	} 
	
	public function setCaModalidad($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_modalidad !== $v) {
			$this->ca_modalidad = $v;
			$this->modifiedColumns[] = PricPatioLineaPeer::CA_MODALIDAD;
		}

		return $this;
	} 
	
	public function setCaImpoexpo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_impoexpo !== $v) {
			$this->ca_impoexpo = $v;
			$this->modifiedColumns[] = PricPatioLineaPeer::CA_IMPOEXPO;
		}

		return $this;
	} 
	
	public function setCaObservaciones($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_observaciones !== $v) {
			$this->ca_observaciones = $v;
			$this->modifiedColumns[] = PricPatioLineaPeer::CA_OBSERVACIONES;
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

			$this->ca_idpatio = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_idlinea = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_transporte = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_modalidad = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_impoexpo = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_observaciones = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating PricPatioLinea object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aPricPatio !== null && $this->ca_idpatio !== $this->aPricPatio->getCaIdpatio()) {
			$this->aPricPatio = null;
		}
		if ($this->aTransportador !== null && $this->ca_idlinea !== $this->aTransportador->getCaIdlinea()) {
			$this->aTransportador = null;
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
			$con = Propel::getConnection(PricPatioLineaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = PricPatioLineaPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aPricPatio = null;
			$this->aTransportador = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasePricPatioLinea:delete:pre') as $callable)
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
			$con = Propel::getConnection(PricPatioLineaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			PricPatioLineaPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BasePricPatioLinea:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasePricPatioLinea:save:pre') as $callable)
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
			$con = Propel::getConnection(PricPatioLineaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BasePricPatioLinea:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			PricPatioLineaPeer::addInstanceToPool($this);
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

												
			if ($this->aPricPatio !== null) {
				if ($this->aPricPatio->isModified() || $this->aPricPatio->isNew()) {
					$affectedRows += $this->aPricPatio->save($con);
				}
				$this->setPricPatio($this->aPricPatio);
			}

			if ($this->aTransportador !== null) {
				if ($this->aTransportador->isModified() || $this->aTransportador->isNew()) {
					$affectedRows += $this->aTransportador->save($con);
				}
				$this->setTransportador($this->aTransportador);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = PricPatioLineaPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += PricPatioLineaPeer::doUpdate($this, $con);
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


												
			if ($this->aPricPatio !== null) {
				if (!$this->aPricPatio->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPricPatio->getValidationFailures());
				}
			}

			if ($this->aTransportador !== null) {
				if (!$this->aTransportador->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTransportador->getValidationFailures());
				}
			}


			if (($retval = PricPatioLineaPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PricPatioLineaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdpatio();
				break;
			case 1:
				return $this->getCaIdlinea();
				break;
			case 2:
				return $this->getCaTransporte();
				break;
			case 3:
				return $this->getCaModalidad();
				break;
			case 4:
				return $this->getCaImpoexpo();
				break;
			case 5:
				return $this->getCaObservaciones();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = PricPatioLineaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdpatio(),
			$keys[1] => $this->getCaIdlinea(),
			$keys[2] => $this->getCaTransporte(),
			$keys[3] => $this->getCaModalidad(),
			$keys[4] => $this->getCaImpoexpo(),
			$keys[5] => $this->getCaObservaciones(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PricPatioLineaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdpatio($value);
				break;
			case 1:
				$this->setCaIdlinea($value);
				break;
			case 2:
				$this->setCaTransporte($value);
				break;
			case 3:
				$this->setCaModalidad($value);
				break;
			case 4:
				$this->setCaImpoexpo($value);
				break;
			case 5:
				$this->setCaObservaciones($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PricPatioLineaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdpatio($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdlinea($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaTransporte($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaModalidad($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaImpoexpo($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaObservaciones($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(PricPatioLineaPeer::DATABASE_NAME);

		if ($this->isColumnModified(PricPatioLineaPeer::CA_IDPATIO)) $criteria->add(PricPatioLineaPeer::CA_IDPATIO, $this->ca_idpatio);
		if ($this->isColumnModified(PricPatioLineaPeer::CA_IDLINEA)) $criteria->add(PricPatioLineaPeer::CA_IDLINEA, $this->ca_idlinea);
		if ($this->isColumnModified(PricPatioLineaPeer::CA_TRANSPORTE)) $criteria->add(PricPatioLineaPeer::CA_TRANSPORTE, $this->ca_transporte);
		if ($this->isColumnModified(PricPatioLineaPeer::CA_MODALIDAD)) $criteria->add(PricPatioLineaPeer::CA_MODALIDAD, $this->ca_modalidad);
		if ($this->isColumnModified(PricPatioLineaPeer::CA_IMPOEXPO)) $criteria->add(PricPatioLineaPeer::CA_IMPOEXPO, $this->ca_impoexpo);
		if ($this->isColumnModified(PricPatioLineaPeer::CA_OBSERVACIONES)) $criteria->add(PricPatioLineaPeer::CA_OBSERVACIONES, $this->ca_observaciones);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(PricPatioLineaPeer::DATABASE_NAME);

		$criteria->add(PricPatioLineaPeer::CA_IDPATIO, $this->ca_idpatio);
		$criteria->add(PricPatioLineaPeer::CA_IDLINEA, $this->ca_idlinea);
		$criteria->add(PricPatioLineaPeer::CA_TRANSPORTE, $this->ca_transporte);
		$criteria->add(PricPatioLineaPeer::CA_MODALIDAD, $this->ca_modalidad);
		$criteria->add(PricPatioLineaPeer::CA_IMPOEXPO, $this->ca_impoexpo);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getCaIdpatio();

		$pks[1] = $this->getCaIdlinea();

		$pks[2] = $this->getCaTransporte();

		$pks[3] = $this->getCaModalidad();

		$pks[4] = $this->getCaImpoexpo();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setCaIdpatio($keys[0]);

		$this->setCaIdlinea($keys[1]);

		$this->setCaTransporte($keys[2]);

		$this->setCaModalidad($keys[3]);

		$this->setCaImpoexpo($keys[4]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdpatio($this->ca_idpatio);

		$copyObj->setCaIdlinea($this->ca_idlinea);

		$copyObj->setCaTransporte($this->ca_transporte);

		$copyObj->setCaModalidad($this->ca_modalidad);

		$copyObj->setCaImpoexpo($this->ca_impoexpo);

		$copyObj->setCaObservaciones($this->ca_observaciones);


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
			self::$peer = new PricPatioLineaPeer();
		}
		return self::$peer;
	}

	
	public function setPricPatio(PricPatio $v = null)
	{
		if ($v === null) {
			$this->setCaIdpatio(NULL);
		} else {
			$this->setCaIdpatio($v->getCaIdpatio());
		}

		$this->aPricPatio = $v;

						if ($v !== null) {
			$v->addPricPatioLinea($this);
		}

		return $this;
	}


	
	public function getPricPatio(PropelPDO $con = null)
	{
		if ($this->aPricPatio === null && ($this->ca_idpatio !== null)) {
			$c = new Criteria(PricPatioPeer::DATABASE_NAME);
			$c->add(PricPatioPeer::CA_IDPATIO, $this->ca_idpatio);
			$this->aPricPatio = PricPatioPeer::doSelectOne($c, $con);
			
		}
		return $this->aPricPatio;
	}

	
	public function setTransportador(Transportador $v = null)
	{
		if ($v === null) {
			$this->setCaIdlinea(NULL);
		} else {
			$this->setCaIdlinea($v->getCaIdlinea());
		}

		$this->aTransportador = $v;

						if ($v !== null) {
			$v->addPricPatioLinea($this);
		}

		return $this;
	}


	
	public function getTransportador(PropelPDO $con = null)
	{
		if ($this->aTransportador === null && (($this->ca_idlinea !== "" && $this->ca_idlinea !== null))) {
			$c = new Criteria(TransportadorPeer::DATABASE_NAME);
			$c->add(TransportadorPeer::CA_IDLINEA, $this->ca_idlinea);
			$this->aTransportador = TransportadorPeer::doSelectOne($c, $con);
			
		}
		return $this->aTransportador;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
			$this->aPricPatio = null;
			$this->aTransportador = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BasePricPatioLinea:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BasePricPatioLinea::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 