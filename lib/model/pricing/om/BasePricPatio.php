<?php


abstract class BasePricPatio extends BaseObject  implements Persistent {


  const PEER = 'PricPatioPeer';

	
	protected static $peer;

	
	protected $ca_idpatio;

	
	protected $ca_nombre;

	
	protected $ca_idciudad;

	
	protected $ca_direccion;

	
	protected $aCiudad;

	
	protected $collPricPatioLineas;

	
	private $lastPricPatioLineaCriteria = null;

	
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

	
	public function getCaNombre()
	{
		return $this->ca_nombre;
	}

	
	public function getCaIdciudad()
	{
		return $this->ca_idciudad;
	}

	
	public function getCaDireccion()
	{
		return $this->ca_direccion;
	}

	
	public function setCaIdpatio($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idpatio !== $v) {
			$this->ca_idpatio = $v;
			$this->modifiedColumns[] = PricPatioPeer::CA_IDPATIO;
		}

		return $this;
	} 
	
	public function setCaNombre($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_nombre !== $v) {
			$this->ca_nombre = $v;
			$this->modifiedColumns[] = PricPatioPeer::CA_NOMBRE;
		}

		return $this;
	} 
	
	public function setCaIdciudad($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idciudad !== $v) {
			$this->ca_idciudad = $v;
			$this->modifiedColumns[] = PricPatioPeer::CA_IDCIUDAD;
		}

		if ($this->aCiudad !== null && $this->aCiudad->getCaIdciudad() !== $v) {
			$this->aCiudad = null;
		}

		return $this;
	} 
	
	public function setCaDireccion($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_direccion !== $v) {
			$this->ca_direccion = $v;
			$this->modifiedColumns[] = PricPatioPeer::CA_DIRECCION;
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
			$this->ca_nombre = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_idciudad = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_direccion = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating PricPatio object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aCiudad !== null && $this->ca_idciudad !== $this->aCiudad->getCaIdciudad()) {
			$this->aCiudad = null;
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
			$con = Propel::getConnection(PricPatioPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = PricPatioPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aCiudad = null;
			$this->collPricPatioLineas = null;
			$this->lastPricPatioLineaCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasePricPatio:delete:pre') as $callable)
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
			$con = Propel::getConnection(PricPatioPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			PricPatioPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BasePricPatio:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasePricPatio:save:pre') as $callable)
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
			$con = Propel::getConnection(PricPatioPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BasePricPatio:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			PricPatioPeer::addInstanceToPool($this);
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

												
			if ($this->aCiudad !== null) {
				if ($this->aCiudad->isModified() || $this->aCiudad->isNew()) {
					$affectedRows += $this->aCiudad->save($con);
				}
				$this->setCiudad($this->aCiudad);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = PricPatioPeer::CA_IDPATIO;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = PricPatioPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setCaIdpatio($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += PricPatioPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collPricPatioLineas !== null) {
				foreach ($this->collPricPatioLineas as $referrerFK) {
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


												
			if ($this->aCiudad !== null) {
				if (!$this->aCiudad->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCiudad->getValidationFailures());
				}
			}


			if (($retval = PricPatioPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collPricPatioLineas !== null) {
					foreach ($this->collPricPatioLineas as $referrerFK) {
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
		$pos = PricPatioPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaNombre();
				break;
			case 2:
				return $this->getCaIdciudad();
				break;
			case 3:
				return $this->getCaDireccion();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = PricPatioPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdpatio(),
			$keys[1] => $this->getCaNombre(),
			$keys[2] => $this->getCaIdciudad(),
			$keys[3] => $this->getCaDireccion(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PricPatioPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdpatio($value);
				break;
			case 1:
				$this->setCaNombre($value);
				break;
			case 2:
				$this->setCaIdciudad($value);
				break;
			case 3:
				$this->setCaDireccion($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PricPatioPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdpatio($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaNombre($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaIdciudad($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaDireccion($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(PricPatioPeer::DATABASE_NAME);

		if ($this->isColumnModified(PricPatioPeer::CA_IDPATIO)) $criteria->add(PricPatioPeer::CA_IDPATIO, $this->ca_idpatio);
		if ($this->isColumnModified(PricPatioPeer::CA_NOMBRE)) $criteria->add(PricPatioPeer::CA_NOMBRE, $this->ca_nombre);
		if ($this->isColumnModified(PricPatioPeer::CA_IDCIUDAD)) $criteria->add(PricPatioPeer::CA_IDCIUDAD, $this->ca_idciudad);
		if ($this->isColumnModified(PricPatioPeer::CA_DIRECCION)) $criteria->add(PricPatioPeer::CA_DIRECCION, $this->ca_direccion);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(PricPatioPeer::DATABASE_NAME);

		$criteria->add(PricPatioPeer::CA_IDPATIO, $this->ca_idpatio);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaIdpatio();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaIdpatio($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaNombre($this->ca_nombre);

		$copyObj->setCaIdciudad($this->ca_idciudad);

		$copyObj->setCaDireccion($this->ca_direccion);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getPricPatioLineas() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addPricPatioLinea($relObj->copy($deepCopy));
				}
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setCaIdpatio(NULL); 
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
			self::$peer = new PricPatioPeer();
		}
		return self::$peer;
	}

	
	public function setCiudad(Ciudad $v = null)
	{
		if ($v === null) {
			$this->setCaIdciudad(NULL);
		} else {
			$this->setCaIdciudad($v->getCaIdciudad());
		}

		$this->aCiudad = $v;

						if ($v !== null) {
			$v->addPricPatio($this);
		}

		return $this;
	}


	
	public function getCiudad(PropelPDO $con = null)
	{
		if ($this->aCiudad === null && (($this->ca_idciudad !== "" && $this->ca_idciudad !== null))) {
			$c = new Criteria(CiudadPeer::DATABASE_NAME);
			$c->add(CiudadPeer::CA_IDCIUDAD, $this->ca_idciudad);
			$this->aCiudad = CiudadPeer::doSelectOne($c, $con);
			
		}
		return $this->aCiudad;
	}

	
	public function clearPricPatioLineas()
	{
		$this->collPricPatioLineas = null; 	}

	
	public function initPricPatioLineas()
	{
		$this->collPricPatioLineas = array();
	}

	
	public function getPricPatioLineas($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(PricPatioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricPatioLineas === null) {
			if ($this->isNew()) {
			   $this->collPricPatioLineas = array();
			} else {

				$criteria->add(PricPatioLineaPeer::CA_IDPATIO, $this->ca_idpatio);

				PricPatioLineaPeer::addSelectColumns($criteria);
				$this->collPricPatioLineas = PricPatioLineaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PricPatioLineaPeer::CA_IDPATIO, $this->ca_idpatio);

				PricPatioLineaPeer::addSelectColumns($criteria);
				if (!isset($this->lastPricPatioLineaCriteria) || !$this->lastPricPatioLineaCriteria->equals($criteria)) {
					$this->collPricPatioLineas = PricPatioLineaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPricPatioLineaCriteria = $criteria;
		return $this->collPricPatioLineas;
	}

	
	public function countPricPatioLineas(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(PricPatioPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collPricPatioLineas === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(PricPatioLineaPeer::CA_IDPATIO, $this->ca_idpatio);

				$count = PricPatioLineaPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PricPatioLineaPeer::CA_IDPATIO, $this->ca_idpatio);

				if (!isset($this->lastPricPatioLineaCriteria) || !$this->lastPricPatioLineaCriteria->equals($criteria)) {
					$count = PricPatioLineaPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collPricPatioLineas);
				}
			} else {
				$count = count($this->collPricPatioLineas);
			}
		}
		return $count;
	}

	
	public function addPricPatioLinea(PricPatioLinea $l)
	{
		if ($this->collPricPatioLineas === null) {
			$this->initPricPatioLineas();
		}
		if (!in_array($l, $this->collPricPatioLineas, true)) { 			array_push($this->collPricPatioLineas, $l);
			$l->setPricPatio($this);
		}
	}


	
	public function getPricPatioLineasJoinTransportador($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(PricPatioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricPatioLineas === null) {
			if ($this->isNew()) {
				$this->collPricPatioLineas = array();
			} else {

				$criteria->add(PricPatioLineaPeer::CA_IDPATIO, $this->ca_idpatio);

				$this->collPricPatioLineas = PricPatioLineaPeer::doSelectJoinTransportador($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(PricPatioLineaPeer::CA_IDPATIO, $this->ca_idpatio);

			if (!isset($this->lastPricPatioLineaCriteria) || !$this->lastPricPatioLineaCriteria->equals($criteria)) {
				$this->collPricPatioLineas = PricPatioLineaPeer::doSelectJoinTransportador($criteria, $con, $join_behavior);
			}
		}
		$this->lastPricPatioLineaCriteria = $criteria;

		return $this->collPricPatioLineas;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collPricPatioLineas) {
				foreach ((array) $this->collPricPatioLineas as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collPricPatioLineas = null;
			$this->aCiudad = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BasePricPatio:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BasePricPatio::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 