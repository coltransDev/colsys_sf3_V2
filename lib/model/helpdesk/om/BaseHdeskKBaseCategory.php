<?php


abstract class BaseHdeskKBaseCategory extends BaseObject  implements Persistent {


  const PEER = 'HdeskKBaseCategoryPeer';

	
	protected static $peer;

	
	protected $ca_idcategory;

	
	protected $ca_parent;

	
	protected $ca_name;

	
	protected $collHdeskKBases;

	
	private $lastHdeskKBaseCriteria = null;

	
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

	
	public function getCaIdcategory()
	{
		return $this->ca_idcategory;
	}

	
	public function getCaParent()
	{
		return $this->ca_parent;
	}

	
	public function getCaName()
	{
		return $this->ca_name;
	}

	
	public function setCaIdcategory($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idcategory !== $v) {
			$this->ca_idcategory = $v;
			$this->modifiedColumns[] = HdeskKBaseCategoryPeer::CA_IDCATEGORY;
		}

		return $this;
	} 
	
	public function setCaParent($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_parent !== $v) {
			$this->ca_parent = $v;
			$this->modifiedColumns[] = HdeskKBaseCategoryPeer::CA_PARENT;
		}

		return $this;
	} 
	
	public function setCaName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_name !== $v) {
			$this->ca_name = $v;
			$this->modifiedColumns[] = HdeskKBaseCategoryPeer::CA_NAME;
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

			$this->ca_idcategory = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_parent = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_name = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating HdeskKBaseCategory object", $e);
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
			$con = Propel::getConnection(HdeskKBaseCategoryPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = HdeskKBaseCategoryPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->collHdeskKBases = null;
			$this->lastHdeskKBaseCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseHdeskKBaseCategory:delete:pre') as $callable)
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
			$con = Propel::getConnection(HdeskKBaseCategoryPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			HdeskKBaseCategoryPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseHdeskKBaseCategory:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseHdeskKBaseCategory:save:pre') as $callable)
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
			$con = Propel::getConnection(HdeskKBaseCategoryPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseHdeskKBaseCategory:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			HdeskKBaseCategoryPeer::addInstanceToPool($this);
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
				$this->modifiedColumns[] = HdeskKBaseCategoryPeer::CA_IDCATEGORY;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = HdeskKBaseCategoryPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setCaIdcategory($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += HdeskKBaseCategoryPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collHdeskKBases !== null) {
				foreach ($this->collHdeskKBases as $referrerFK) {
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


			if (($retval = HdeskKBaseCategoryPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collHdeskKBases !== null) {
					foreach ($this->collHdeskKBases as $referrerFK) {
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
		$pos = HdeskKBaseCategoryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdcategory();
				break;
			case 1:
				return $this->getCaParent();
				break;
			case 2:
				return $this->getCaName();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = HdeskKBaseCategoryPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdcategory(),
			$keys[1] => $this->getCaParent(),
			$keys[2] => $this->getCaName(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = HdeskKBaseCategoryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdcategory($value);
				break;
			case 1:
				$this->setCaParent($value);
				break;
			case 2:
				$this->setCaName($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = HdeskKBaseCategoryPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdcategory($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaParent($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaName($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(HdeskKBaseCategoryPeer::DATABASE_NAME);

		if ($this->isColumnModified(HdeskKBaseCategoryPeer::CA_IDCATEGORY)) $criteria->add(HdeskKBaseCategoryPeer::CA_IDCATEGORY, $this->ca_idcategory);
		if ($this->isColumnModified(HdeskKBaseCategoryPeer::CA_PARENT)) $criteria->add(HdeskKBaseCategoryPeer::CA_PARENT, $this->ca_parent);
		if ($this->isColumnModified(HdeskKBaseCategoryPeer::CA_NAME)) $criteria->add(HdeskKBaseCategoryPeer::CA_NAME, $this->ca_name);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(HdeskKBaseCategoryPeer::DATABASE_NAME);

		$criteria->add(HdeskKBaseCategoryPeer::CA_IDCATEGORY, $this->ca_idcategory);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaIdcategory();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaIdcategory($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaParent($this->ca_parent);

		$copyObj->setCaName($this->ca_name);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getHdeskKBases() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addHdeskKBase($relObj->copy($deepCopy));
				}
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setCaIdcategory(NULL); 
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
			self::$peer = new HdeskKBaseCategoryPeer();
		}
		return self::$peer;
	}

	
	public function clearHdeskKBases()
	{
		$this->collHdeskKBases = null; 	}

	
	public function initHdeskKBases()
	{
		$this->collHdeskKBases = array();
	}

	
	public function getHdeskKBases($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(HdeskKBaseCategoryPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHdeskKBases === null) {
			if ($this->isNew()) {
			   $this->collHdeskKBases = array();
			} else {

				$criteria->add(HdeskKBasePeer::CA_IDCATEGORY, $this->ca_idcategory);

				HdeskKBasePeer::addSelectColumns($criteria);
				$this->collHdeskKBases = HdeskKBasePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(HdeskKBasePeer::CA_IDCATEGORY, $this->ca_idcategory);

				HdeskKBasePeer::addSelectColumns($criteria);
				if (!isset($this->lastHdeskKBaseCriteria) || !$this->lastHdeskKBaseCriteria->equals($criteria)) {
					$this->collHdeskKBases = HdeskKBasePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastHdeskKBaseCriteria = $criteria;
		return $this->collHdeskKBases;
	}

	
	public function countHdeskKBases(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(HdeskKBaseCategoryPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collHdeskKBases === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(HdeskKBasePeer::CA_IDCATEGORY, $this->ca_idcategory);

				$count = HdeskKBasePeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(HdeskKBasePeer::CA_IDCATEGORY, $this->ca_idcategory);

				if (!isset($this->lastHdeskKBaseCriteria) || !$this->lastHdeskKBaseCriteria->equals($criteria)) {
					$count = HdeskKBasePeer::doCount($criteria, $con);
				} else {
					$count = count($this->collHdeskKBases);
				}
			} else {
				$count = count($this->collHdeskKBases);
			}
		}
		return $count;
	}

	
	public function addHdeskKBase(HdeskKBase $l)
	{
		if ($this->collHdeskKBases === null) {
			$this->initHdeskKBases();
		}
		if (!in_array($l, $this->collHdeskKBases, true)) { 			array_push($this->collHdeskKBases, $l);
			$l->setHdeskKBaseCategory($this);
		}
	}


	
	public function getHdeskKBasesJoinUsuario($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(HdeskKBaseCategoryPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHdeskKBases === null) {
			if ($this->isNew()) {
				$this->collHdeskKBases = array();
			} else {

				$criteria->add(HdeskKBasePeer::CA_IDCATEGORY, $this->ca_idcategory);

				$this->collHdeskKBases = HdeskKBasePeer::doSelectJoinUsuario($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(HdeskKBasePeer::CA_IDCATEGORY, $this->ca_idcategory);

			if (!isset($this->lastHdeskKBaseCriteria) || !$this->lastHdeskKBaseCriteria->equals($criteria)) {
				$this->collHdeskKBases = HdeskKBasePeer::doSelectJoinUsuario($criteria, $con, $join_behavior);
			}
		}
		$this->lastHdeskKBaseCriteria = $criteria;

		return $this->collHdeskKBases;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collHdeskKBases) {
				foreach ((array) $this->collHdeskKBases as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collHdeskKBases = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseHdeskKBaseCategory:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseHdeskKBaseCategory::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 