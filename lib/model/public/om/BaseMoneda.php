<?php


abstract class BaseMoneda extends BaseObject  implements Persistent {


  const PEER = 'MonedaPeer';

	
	protected static $peer;

	
	protected $ca_idmoneda;

	
	protected $ca_nombre;

	
	protected $ca_referencia;

	
	protected $collCotSeguros;

	
	private $lastCotSeguroCriteria = null;

	
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

	
	public function getCaIdmoneda()
	{
		return $this->ca_idmoneda;
	}

	
	public function getCaNombre()
	{
		return $this->ca_nombre;
	}

	
	public function getCaReferencia()
	{
		return $this->ca_referencia;
	}

	
	public function setCaIdmoneda($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idmoneda !== $v) {
			$this->ca_idmoneda = $v;
			$this->modifiedColumns[] = MonedaPeer::CA_IDMONEDA;
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
			$this->modifiedColumns[] = MonedaPeer::CA_NOMBRE;
		}

		return $this;
	} 
	
	public function setCaReferencia($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_referencia !== $v) {
			$this->ca_referencia = $v;
			$this->modifiedColumns[] = MonedaPeer::CA_REFERENCIA;
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

			$this->ca_idmoneda = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->ca_nombre = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_referencia = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Moneda object", $e);
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
			$con = Propel::getConnection(MonedaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = MonedaPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->collCotSeguros = null;
			$this->lastCotSeguroCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseMoneda:delete:pre') as $callable)
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
			$con = Propel::getConnection(MonedaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			MonedaPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseMoneda:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseMoneda:save:pre') as $callable)
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
			$con = Propel::getConnection(MonedaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseMoneda:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			MonedaPeer::addInstanceToPool($this);
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
					$pk = MonedaPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += MonedaPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collCotSeguros !== null) {
				foreach ($this->collCotSeguros as $referrerFK) {
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


			if (($retval = MonedaPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collCotSeguros !== null) {
					foreach ($this->collCotSeguros as $referrerFK) {
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
		$pos = MonedaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdmoneda();
				break;
			case 1:
				return $this->getCaNombre();
				break;
			case 2:
				return $this->getCaReferencia();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = MonedaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdmoneda(),
			$keys[1] => $this->getCaNombre(),
			$keys[2] => $this->getCaReferencia(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = MonedaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdmoneda($value);
				break;
			case 1:
				$this->setCaNombre($value);
				break;
			case 2:
				$this->setCaReferencia($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = MonedaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdmoneda($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaNombre($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaReferencia($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(MonedaPeer::DATABASE_NAME);

		if ($this->isColumnModified(MonedaPeer::CA_IDMONEDA)) $criteria->add(MonedaPeer::CA_IDMONEDA, $this->ca_idmoneda);
		if ($this->isColumnModified(MonedaPeer::CA_NOMBRE)) $criteria->add(MonedaPeer::CA_NOMBRE, $this->ca_nombre);
		if ($this->isColumnModified(MonedaPeer::CA_REFERENCIA)) $criteria->add(MonedaPeer::CA_REFERENCIA, $this->ca_referencia);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(MonedaPeer::DATABASE_NAME);

		$criteria->add(MonedaPeer::CA_IDMONEDA, $this->ca_idmoneda);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaIdmoneda();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaIdmoneda($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdmoneda($this->ca_idmoneda);

		$copyObj->setCaNombre($this->ca_nombre);

		$copyObj->setCaReferencia($this->ca_referencia);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getCotSeguros() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addCotSeguro($relObj->copy($deepCopy));
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
			self::$peer = new MonedaPeer();
		}
		return self::$peer;
	}

	
	public function clearCotSeguros()
	{
		$this->collCotSeguros = null; 	}

	
	public function initCotSeguros()
	{
		$this->collCotSeguros = array();
	}

	
	public function getCotSeguros($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(MonedaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotSeguros === null) {
			if ($this->isNew()) {
			   $this->collCotSeguros = array();
			} else {

				$criteria->add(CotSeguroPeer::CA_IDMONEDA, $this->ca_idmoneda);

				CotSeguroPeer::addSelectColumns($criteria);
				$this->collCotSeguros = CotSeguroPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CotSeguroPeer::CA_IDMONEDA, $this->ca_idmoneda);

				CotSeguroPeer::addSelectColumns($criteria);
				if (!isset($this->lastCotSeguroCriteria) || !$this->lastCotSeguroCriteria->equals($criteria)) {
					$this->collCotSeguros = CotSeguroPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCotSeguroCriteria = $criteria;
		return $this->collCotSeguros;
	}

	
	public function countCotSeguros(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(MonedaPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collCotSeguros === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(CotSeguroPeer::CA_IDMONEDA, $this->ca_idmoneda);

				$count = CotSeguroPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CotSeguroPeer::CA_IDMONEDA, $this->ca_idmoneda);

				if (!isset($this->lastCotSeguroCriteria) || !$this->lastCotSeguroCriteria->equals($criteria)) {
					$count = CotSeguroPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collCotSeguros);
				}
			} else {
				$count = count($this->collCotSeguros);
			}
		}
		return $count;
	}

	
	public function addCotSeguro(CotSeguro $l)
	{
		if ($this->collCotSeguros === null) {
			$this->initCotSeguros();
		}
		if (!in_array($l, $this->collCotSeguros, true)) { 			array_push($this->collCotSeguros, $l);
			$l->setMoneda($this);
		}
	}


	
	public function getCotSegurosJoinCotizacion($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(MonedaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotSeguros === null) {
			if ($this->isNew()) {
				$this->collCotSeguros = array();
			} else {

				$criteria->add(CotSeguroPeer::CA_IDMONEDA, $this->ca_idmoneda);

				$this->collCotSeguros = CotSeguroPeer::doSelectJoinCotizacion($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(CotSeguroPeer::CA_IDMONEDA, $this->ca_idmoneda);

			if (!isset($this->lastCotSeguroCriteria) || !$this->lastCotSeguroCriteria->equals($criteria)) {
				$this->collCotSeguros = CotSeguroPeer::doSelectJoinCotizacion($criteria, $con, $join_behavior);
			}
		}
		$this->lastCotSeguroCriteria = $criteria;

		return $this->collCotSeguros;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collCotSeguros) {
				foreach ((array) $this->collCotSeguros as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collCotSeguros = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseMoneda:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseMoneda::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 