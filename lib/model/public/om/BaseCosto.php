<?php


abstract class BaseCosto extends BaseObject  implements Persistent {


  const PEER = 'CostoPeer';

	
	protected static $peer;

	
	protected $ca_idcosto;

	
	protected $ca_costo;

	
	protected $ca_transporte;

	
	protected $ca_impoexpo;

	
	protected $ca_modalidad;

	
	protected $ca_comisionable;

	
	protected $collRepCostos;

	
	private $lastRepCostoCriteria = null;

	
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

	
	public function getCaIdcosto()
	{
		return $this->ca_idcosto;
	}

	
	public function getCaCosto()
	{
		return $this->ca_costo;
	}

	
	public function getCaTransporte()
	{
		return $this->ca_transporte;
	}

	
	public function getCaImpoexpo()
	{
		return $this->ca_impoexpo;
	}

	
	public function getCaModalidad()
	{
		return $this->ca_modalidad;
	}

	
	public function getCaComisionable()
	{
		return $this->ca_comisionable;
	}

	
	public function setCaIdcosto($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idcosto !== $v) {
			$this->ca_idcosto = $v;
			$this->modifiedColumns[] = CostoPeer::CA_IDCOSTO;
		}

		return $this;
	} 
	
	public function setCaCosto($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_costo !== $v) {
			$this->ca_costo = $v;
			$this->modifiedColumns[] = CostoPeer::CA_COSTO;
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
			$this->modifiedColumns[] = CostoPeer::CA_TRANSPORTE;
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
			$this->modifiedColumns[] = CostoPeer::CA_IMPOEXPO;
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
			$this->modifiedColumns[] = CostoPeer::CA_MODALIDAD;
		}

		return $this;
	} 
	
	public function setCaComisionable($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_comisionable !== $v) {
			$this->ca_comisionable = $v;
			$this->modifiedColumns[] = CostoPeer::CA_COMISIONABLE;
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

			$this->ca_idcosto = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_costo = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_transporte = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_impoexpo = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_modalidad = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_comisionable = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Costo object", $e);
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
			$con = Propel::getConnection(CostoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = CostoPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->collRepCostos = null;
			$this->lastRepCostoCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseCosto:delete:pre') as $callable)
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
			$con = Propel::getConnection(CostoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			CostoPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseCosto:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseCosto:save:pre') as $callable)
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
			$con = Propel::getConnection(CostoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseCosto:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			CostoPeer::addInstanceToPool($this);
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
				$this->modifiedColumns[] = CostoPeer::CA_IDCOSTO;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = CostoPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setCaIdcosto($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += CostoPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collRepCostos !== null) {
				foreach ($this->collRepCostos as $referrerFK) {
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


			if (($retval = CostoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collRepCostos !== null) {
					foreach ($this->collRepCostos as $referrerFK) {
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
		$pos = CostoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdcosto();
				break;
			case 1:
				return $this->getCaCosto();
				break;
			case 2:
				return $this->getCaTransporte();
				break;
			case 3:
				return $this->getCaImpoexpo();
				break;
			case 4:
				return $this->getCaModalidad();
				break;
			case 5:
				return $this->getCaComisionable();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = CostoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdcosto(),
			$keys[1] => $this->getCaCosto(),
			$keys[2] => $this->getCaTransporte(),
			$keys[3] => $this->getCaImpoexpo(),
			$keys[4] => $this->getCaModalidad(),
			$keys[5] => $this->getCaComisionable(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = CostoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdcosto($value);
				break;
			case 1:
				$this->setCaCosto($value);
				break;
			case 2:
				$this->setCaTransporte($value);
				break;
			case 3:
				$this->setCaImpoexpo($value);
				break;
			case 4:
				$this->setCaModalidad($value);
				break;
			case 5:
				$this->setCaComisionable($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = CostoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdcosto($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaCosto($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaTransporte($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaImpoexpo($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaModalidad($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaComisionable($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(CostoPeer::DATABASE_NAME);

		if ($this->isColumnModified(CostoPeer::CA_IDCOSTO)) $criteria->add(CostoPeer::CA_IDCOSTO, $this->ca_idcosto);
		if ($this->isColumnModified(CostoPeer::CA_COSTO)) $criteria->add(CostoPeer::CA_COSTO, $this->ca_costo);
		if ($this->isColumnModified(CostoPeer::CA_TRANSPORTE)) $criteria->add(CostoPeer::CA_TRANSPORTE, $this->ca_transporte);
		if ($this->isColumnModified(CostoPeer::CA_IMPOEXPO)) $criteria->add(CostoPeer::CA_IMPOEXPO, $this->ca_impoexpo);
		if ($this->isColumnModified(CostoPeer::CA_MODALIDAD)) $criteria->add(CostoPeer::CA_MODALIDAD, $this->ca_modalidad);
		if ($this->isColumnModified(CostoPeer::CA_COMISIONABLE)) $criteria->add(CostoPeer::CA_COMISIONABLE, $this->ca_comisionable);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(CostoPeer::DATABASE_NAME);

		$criteria->add(CostoPeer::CA_IDCOSTO, $this->ca_idcosto);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaIdcosto();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaIdcosto($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaCosto($this->ca_costo);

		$copyObj->setCaTransporte($this->ca_transporte);

		$copyObj->setCaImpoexpo($this->ca_impoexpo);

		$copyObj->setCaModalidad($this->ca_modalidad);

		$copyObj->setCaComisionable($this->ca_comisionable);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getRepCostos() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addRepCosto($relObj->copy($deepCopy));
				}
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setCaIdcosto(NULL); 
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
			self::$peer = new CostoPeer();
		}
		return self::$peer;
	}

	
	public function clearRepCostos()
	{
		$this->collRepCostos = null; 	}

	
	public function initRepCostos()
	{
		$this->collRepCostos = array();
	}

	
	public function getRepCostos($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CostoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepCostos === null) {
			if ($this->isNew()) {
			   $this->collRepCostos = array();
			} else {

				$criteria->add(RepCostoPeer::CA_IDCOSTO, $this->ca_idcosto);

				RepCostoPeer::addSelectColumns($criteria);
				$this->collRepCostos = RepCostoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RepCostoPeer::CA_IDCOSTO, $this->ca_idcosto);

				RepCostoPeer::addSelectColumns($criteria);
				if (!isset($this->lastRepCostoCriteria) || !$this->lastRepCostoCriteria->equals($criteria)) {
					$this->collRepCostos = RepCostoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRepCostoCriteria = $criteria;
		return $this->collRepCostos;
	}

	
	public function countRepCostos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CostoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collRepCostos === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(RepCostoPeer::CA_IDCOSTO, $this->ca_idcosto);

				$count = RepCostoPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RepCostoPeer::CA_IDCOSTO, $this->ca_idcosto);

				if (!isset($this->lastRepCostoCriteria) || !$this->lastRepCostoCriteria->equals($criteria)) {
					$count = RepCostoPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collRepCostos);
				}
			} else {
				$count = count($this->collRepCostos);
			}
		}
		return $count;
	}

	
	public function addRepCosto(RepCosto $l)
	{
		if ($this->collRepCostos === null) {
			$this->initRepCostos();
		}
		if (!in_array($l, $this->collRepCostos, true)) { 			array_push($this->collRepCostos, $l);
			$l->setCosto($this);
		}
	}


	
	public function getRepCostosJoinReporte($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CostoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepCostos === null) {
			if ($this->isNew()) {
				$this->collRepCostos = array();
			} else {

				$criteria->add(RepCostoPeer::CA_IDCOSTO, $this->ca_idcosto);

				$this->collRepCostos = RepCostoPeer::doSelectJoinReporte($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(RepCostoPeer::CA_IDCOSTO, $this->ca_idcosto);

			if (!isset($this->lastRepCostoCriteria) || !$this->lastRepCostoCriteria->equals($criteria)) {
				$this->collRepCostos = RepCostoPeer::doSelectJoinReporte($criteria, $con, $join_behavior);
			}
		}
		$this->lastRepCostoCriteria = $criteria;

		return $this->collRepCostos;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collRepCostos) {
				foreach ((array) $this->collRepCostos as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collRepCostos = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseCosto:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseCosto::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 