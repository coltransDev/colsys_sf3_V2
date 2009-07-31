<?php


abstract class BaseTraficoGrupo extends BaseObject  implements Persistent {


  const PEER = 'TraficoGrupoPeer';

	
	protected static $peer;

	
	protected $ca_idgrupo;

	
	protected $ca_descripcion;

	
	protected $collPricSeguros;

	
	private $lastPricSeguroCriteria = null;

	
	protected $collTraficos;

	
	private $lastTraficoCriteria = null;

	
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

	
	public function getCaIdgrupo()
	{
		return $this->ca_idgrupo;
	}

	
	public function getCaDescripcion()
	{
		return $this->ca_descripcion;
	}

	
	public function setCaIdgrupo($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idgrupo !== $v) {
			$this->ca_idgrupo = $v;
			$this->modifiedColumns[] = TraficoGrupoPeer::CA_IDGRUPO;
		}

		return $this;
	} 
	
	public function setCaDescripcion($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_descripcion !== $v) {
			$this->ca_descripcion = $v;
			$this->modifiedColumns[] = TraficoGrupoPeer::CA_DESCRIPCION;
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

			$this->ca_idgrupo = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_descripcion = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 2; 
		} catch (Exception $e) {
			throw new PropelException("Error populating TraficoGrupo object", $e);
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
			$con = Propel::getConnection(TraficoGrupoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = TraficoGrupoPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->collPricSeguros = null;
			$this->lastPricSeguroCriteria = null;

			$this->collTraficos = null;
			$this->lastTraficoCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseTraficoGrupo:delete:pre') as $callable)
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
			$con = Propel::getConnection(TraficoGrupoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			TraficoGrupoPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseTraficoGrupo:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseTraficoGrupo:save:pre') as $callable)
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
			$con = Propel::getConnection(TraficoGrupoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseTraficoGrupo:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			TraficoGrupoPeer::addInstanceToPool($this);
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

			if ($this->isNew() ) {
				$this->modifiedColumns[] = TraficoGrupoPeer::CA_IDGRUPO;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = TraficoGrupoPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setCaIdgrupo($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += TraficoGrupoPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collPricSeguros !== null) {
				foreach ($this->collPricSeguros as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collTraficos !== null) {
				foreach ($this->collTraficos as $referrerFK) {
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


			if (($retval = TraficoGrupoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collPricSeguros !== null) {
					foreach ($this->collPricSeguros as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collTraficos !== null) {
					foreach ($this->collTraficos as $referrerFK) {
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
		$pos = TraficoGrupoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdgrupo();
				break;
			case 1:
				return $this->getCaDescripcion();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = TraficoGrupoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdgrupo(),
			$keys[1] => $this->getCaDescripcion(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TraficoGrupoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdgrupo($value);
				break;
			case 1:
				$this->setCaDescripcion($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TraficoGrupoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdgrupo($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaDescripcion($arr[$keys[1]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(TraficoGrupoPeer::DATABASE_NAME);

		if ($this->isColumnModified(TraficoGrupoPeer::CA_IDGRUPO)) $criteria->add(TraficoGrupoPeer::CA_IDGRUPO, $this->ca_idgrupo);
		if ($this->isColumnModified(TraficoGrupoPeer::CA_DESCRIPCION)) $criteria->add(TraficoGrupoPeer::CA_DESCRIPCION, $this->ca_descripcion);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(TraficoGrupoPeer::DATABASE_NAME);

		$criteria->add(TraficoGrupoPeer::CA_IDGRUPO, $this->ca_idgrupo);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaIdgrupo();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaIdgrupo($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaDescripcion($this->ca_descripcion);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getPricSeguros() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addPricSeguro($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getTraficos() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addTrafico($relObj->copy($deepCopy));
				}
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setCaIdgrupo(NULL); 
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
			self::$peer = new TraficoGrupoPeer();
		}
		return self::$peer;
	}

	
	public function clearPricSeguros()
	{
		$this->collPricSeguros = null; 	}

	
	public function initPricSeguros()
	{
		$this->collPricSeguros = array();
	}

	
	public function getPricSeguros($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TraficoGrupoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricSeguros === null) {
			if ($this->isNew()) {
			   $this->collPricSeguros = array();
			} else {

				$criteria->add(PricSeguroPeer::CA_IDGRUPO, $this->ca_idgrupo);

				PricSeguroPeer::addSelectColumns($criteria);
				$this->collPricSeguros = PricSeguroPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PricSeguroPeer::CA_IDGRUPO, $this->ca_idgrupo);

				PricSeguroPeer::addSelectColumns($criteria);
				if (!isset($this->lastPricSeguroCriteria) || !$this->lastPricSeguroCriteria->equals($criteria)) {
					$this->collPricSeguros = PricSeguroPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPricSeguroCriteria = $criteria;
		return $this->collPricSeguros;
	}

	
	public function countPricSeguros(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TraficoGrupoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collPricSeguros === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(PricSeguroPeer::CA_IDGRUPO, $this->ca_idgrupo);

				$count = PricSeguroPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PricSeguroPeer::CA_IDGRUPO, $this->ca_idgrupo);

				if (!isset($this->lastPricSeguroCriteria) || !$this->lastPricSeguroCriteria->equals($criteria)) {
					$count = PricSeguroPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collPricSeguros);
				}
			} else {
				$count = count($this->collPricSeguros);
			}
		}
		return $count;
	}

	
	public function addPricSeguro(PricSeguro $l)
	{
		if ($this->collPricSeguros === null) {
			$this->initPricSeguros();
		}
		if (!in_array($l, $this->collPricSeguros, true)) { 			array_push($this->collPricSeguros, $l);
			$l->setTraficoGrupo($this);
		}
	}

	
	public function clearTraficos()
	{
		$this->collTraficos = null; 	}

	
	public function initTraficos()
	{
		$this->collTraficos = array();
	}

	
	public function getTraficos($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TraficoGrupoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTraficos === null) {
			if ($this->isNew()) {
			   $this->collTraficos = array();
			} else {

				$criteria->add(TraficoPeer::CA_IDGRUPO, $this->ca_idgrupo);

				TraficoPeer::addSelectColumns($criteria);
				$this->collTraficos = TraficoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(TraficoPeer::CA_IDGRUPO, $this->ca_idgrupo);

				TraficoPeer::addSelectColumns($criteria);
				if (!isset($this->lastTraficoCriteria) || !$this->lastTraficoCriteria->equals($criteria)) {
					$this->collTraficos = TraficoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastTraficoCriteria = $criteria;
		return $this->collTraficos;
	}

	
	public function countTraficos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TraficoGrupoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collTraficos === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(TraficoPeer::CA_IDGRUPO, $this->ca_idgrupo);

				$count = TraficoPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(TraficoPeer::CA_IDGRUPO, $this->ca_idgrupo);

				if (!isset($this->lastTraficoCriteria) || !$this->lastTraficoCriteria->equals($criteria)) {
					$count = TraficoPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collTraficos);
				}
			} else {
				$count = count($this->collTraficos);
			}
		}
		return $count;
	}

	
	public function addTrafico(Trafico $l)
	{
		if ($this->collTraficos === null) {
			$this->initTraficos();
		}
		if (!in_array($l, $this->collTraficos, true)) { 			array_push($this->collTraficos, $l);
			$l->setTraficoGrupo($this);
		}
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collPricSeguros) {
				foreach ((array) $this->collPricSeguros as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collTraficos) {
				foreach ((array) $this->collTraficos as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collPricSeguros = null;
		$this->collTraficos = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseTraficoGrupo:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseTraficoGrupo::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 