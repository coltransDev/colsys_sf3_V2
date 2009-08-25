<?php


abstract class BaseHdeskProject extends BaseObject  implements Persistent {


  const PEER = 'HdeskProjectPeer';

	
	protected static $peer;

	
	protected $ca_idproject;

	
	protected $ca_idgroup;

	
	protected $ca_name;

	
	protected $ca_description;

	
	protected $ca_active;

	
	protected $aHdeskGroup;

	
	protected $collHdeskTickets;

	
	private $lastHdeskTicketCriteria = null;

	
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

	
	public function getCaIdproject()
	{
		return $this->ca_idproject;
	}

	
	public function getCaIdgroup()
	{
		return $this->ca_idgroup;
	}

	
	public function getCaName()
	{
		return $this->ca_name;
	}

	
	public function getCaDescription()
	{
		return $this->ca_description;
	}

	
	public function getCaActive()
	{
		return $this->ca_active;
	}

	
	public function setCaIdproject($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idproject !== $v) {
			$this->ca_idproject = $v;
			$this->modifiedColumns[] = HdeskProjectPeer::CA_IDPROJECT;
		}

		return $this;
	} 
	
	public function setCaIdgroup($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idgroup !== $v) {
			$this->ca_idgroup = $v;
			$this->modifiedColumns[] = HdeskProjectPeer::CA_IDGROUP;
		}

		if ($this->aHdeskGroup !== null && $this->aHdeskGroup->getCaIdgroup() !== $v) {
			$this->aHdeskGroup = null;
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
			$this->modifiedColumns[] = HdeskProjectPeer::CA_NAME;
		}

		return $this;
	} 
	
	public function setCaDescription($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_description !== $v) {
			$this->ca_description = $v;
			$this->modifiedColumns[] = HdeskProjectPeer::CA_DESCRIPTION;
		}

		return $this;
	} 
	
	public function setCaActive($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_active !== $v) {
			$this->ca_active = $v;
			$this->modifiedColumns[] = HdeskProjectPeer::CA_ACTIVE;
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

			$this->ca_idproject = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_idgroup = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_name = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_description = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_active = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating HdeskProject object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aHdeskGroup !== null && $this->ca_idgroup !== $this->aHdeskGroup->getCaIdgroup()) {
			$this->aHdeskGroup = null;
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
			$con = Propel::getConnection(HdeskProjectPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = HdeskProjectPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aHdeskGroup = null;
			$this->collHdeskTickets = null;
			$this->lastHdeskTicketCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseHdeskProject:delete:pre') as $callable)
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
			$con = Propel::getConnection(HdeskProjectPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			HdeskProjectPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseHdeskProject:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseHdeskProject:save:pre') as $callable)
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
			$con = Propel::getConnection(HdeskProjectPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseHdeskProject:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			HdeskProjectPeer::addInstanceToPool($this);
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

												
			if ($this->aHdeskGroup !== null) {
				if ($this->aHdeskGroup->isModified() || $this->aHdeskGroup->isNew()) {
					$affectedRows += $this->aHdeskGroup->save($con);
				}
				$this->setHdeskGroup($this->aHdeskGroup);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = HdeskProjectPeer::CA_IDPROJECT;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = HdeskProjectPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setCaIdproject($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += HdeskProjectPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collHdeskTickets !== null) {
				foreach ($this->collHdeskTickets as $referrerFK) {
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


												
			if ($this->aHdeskGroup !== null) {
				if (!$this->aHdeskGroup->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aHdeskGroup->getValidationFailures());
				}
			}


			if (($retval = HdeskProjectPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collHdeskTickets !== null) {
					foreach ($this->collHdeskTickets as $referrerFK) {
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
		$pos = HdeskProjectPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdproject();
				break;
			case 1:
				return $this->getCaIdgroup();
				break;
			case 2:
				return $this->getCaName();
				break;
			case 3:
				return $this->getCaDescription();
				break;
			case 4:
				return $this->getCaActive();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = HdeskProjectPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdproject(),
			$keys[1] => $this->getCaIdgroup(),
			$keys[2] => $this->getCaName(),
			$keys[3] => $this->getCaDescription(),
			$keys[4] => $this->getCaActive(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = HdeskProjectPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdproject($value);
				break;
			case 1:
				$this->setCaIdgroup($value);
				break;
			case 2:
				$this->setCaName($value);
				break;
			case 3:
				$this->setCaDescription($value);
				break;
			case 4:
				$this->setCaActive($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = HdeskProjectPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdproject($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdgroup($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaDescription($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaActive($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(HdeskProjectPeer::DATABASE_NAME);

		if ($this->isColumnModified(HdeskProjectPeer::CA_IDPROJECT)) $criteria->add(HdeskProjectPeer::CA_IDPROJECT, $this->ca_idproject);
		if ($this->isColumnModified(HdeskProjectPeer::CA_IDGROUP)) $criteria->add(HdeskProjectPeer::CA_IDGROUP, $this->ca_idgroup);
		if ($this->isColumnModified(HdeskProjectPeer::CA_NAME)) $criteria->add(HdeskProjectPeer::CA_NAME, $this->ca_name);
		if ($this->isColumnModified(HdeskProjectPeer::CA_DESCRIPTION)) $criteria->add(HdeskProjectPeer::CA_DESCRIPTION, $this->ca_description);
		if ($this->isColumnModified(HdeskProjectPeer::CA_ACTIVE)) $criteria->add(HdeskProjectPeer::CA_ACTIVE, $this->ca_active);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(HdeskProjectPeer::DATABASE_NAME);

		$criteria->add(HdeskProjectPeer::CA_IDPROJECT, $this->ca_idproject);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaIdproject();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaIdproject($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdgroup($this->ca_idgroup);

		$copyObj->setCaName($this->ca_name);

		$copyObj->setCaDescription($this->ca_description);

		$copyObj->setCaActive($this->ca_active);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getHdeskTickets() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addHdeskTicket($relObj->copy($deepCopy));
				}
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setCaIdproject(NULL); 
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
			self::$peer = new HdeskProjectPeer();
		}
		return self::$peer;
	}

	
	public function setHdeskGroup(HdeskGroup $v = null)
	{
		if ($v === null) {
			$this->setCaIdgroup(NULL);
		} else {
			$this->setCaIdgroup($v->getCaIdgroup());
		}

		$this->aHdeskGroup = $v;

						if ($v !== null) {
			$v->addHdeskProject($this);
		}

		return $this;
	}


	
	public function getHdeskGroup(PropelPDO $con = null)
	{
		if ($this->aHdeskGroup === null && ($this->ca_idgroup !== null)) {
			$c = new Criteria(HdeskGroupPeer::DATABASE_NAME);
			$c->add(HdeskGroupPeer::CA_IDGROUP, $this->ca_idgroup);
			$this->aHdeskGroup = HdeskGroupPeer::doSelectOne($c, $con);
			
		}
		return $this->aHdeskGroup;
	}

	
	public function clearHdeskTickets()
	{
		$this->collHdeskTickets = null; 	}

	
	public function initHdeskTickets()
	{
		$this->collHdeskTickets = array();
	}

	
	public function getHdeskTickets($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(HdeskProjectPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHdeskTickets === null) {
			if ($this->isNew()) {
			   $this->collHdeskTickets = array();
			} else {

				$criteria->add(HdeskTicketPeer::CA_IDPROJECT, $this->ca_idproject);

				HdeskTicketPeer::addSelectColumns($criteria);
				$this->collHdeskTickets = HdeskTicketPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(HdeskTicketPeer::CA_IDPROJECT, $this->ca_idproject);

				HdeskTicketPeer::addSelectColumns($criteria);
				if (!isset($this->lastHdeskTicketCriteria) || !$this->lastHdeskTicketCriteria->equals($criteria)) {
					$this->collHdeskTickets = HdeskTicketPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastHdeskTicketCriteria = $criteria;
		return $this->collHdeskTickets;
	}

	
	public function countHdeskTickets(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(HdeskProjectPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collHdeskTickets === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(HdeskTicketPeer::CA_IDPROJECT, $this->ca_idproject);

				$count = HdeskTicketPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(HdeskTicketPeer::CA_IDPROJECT, $this->ca_idproject);

				if (!isset($this->lastHdeskTicketCriteria) || !$this->lastHdeskTicketCriteria->equals($criteria)) {
					$count = HdeskTicketPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collHdeskTickets);
				}
			} else {
				$count = count($this->collHdeskTickets);
			}
		}
		return $count;
	}

	
	public function addHdeskTicket(HdeskTicket $l)
	{
		if ($this->collHdeskTickets === null) {
			$this->initHdeskTickets();
		}
		if (!in_array($l, $this->collHdeskTickets, true)) { 			array_push($this->collHdeskTickets, $l);
			$l->setHdeskProject($this);
		}
	}


	
	public function getHdeskTicketsJoinHdeskGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(HdeskProjectPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHdeskTickets === null) {
			if ($this->isNew()) {
				$this->collHdeskTickets = array();
			} else {

				$criteria->add(HdeskTicketPeer::CA_IDPROJECT, $this->ca_idproject);

				$this->collHdeskTickets = HdeskTicketPeer::doSelectJoinHdeskGroup($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(HdeskTicketPeer::CA_IDPROJECT, $this->ca_idproject);

			if (!isset($this->lastHdeskTicketCriteria) || !$this->lastHdeskTicketCriteria->equals($criteria)) {
				$this->collHdeskTickets = HdeskTicketPeer::doSelectJoinHdeskGroup($criteria, $con, $join_behavior);
			}
		}
		$this->lastHdeskTicketCriteria = $criteria;

		return $this->collHdeskTickets;
	}


	
	public function getHdeskTicketsJoinUsuario($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(HdeskProjectPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHdeskTickets === null) {
			if ($this->isNew()) {
				$this->collHdeskTickets = array();
			} else {

				$criteria->add(HdeskTicketPeer::CA_IDPROJECT, $this->ca_idproject);

				$this->collHdeskTickets = HdeskTicketPeer::doSelectJoinUsuario($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(HdeskTicketPeer::CA_IDPROJECT, $this->ca_idproject);

			if (!isset($this->lastHdeskTicketCriteria) || !$this->lastHdeskTicketCriteria->equals($criteria)) {
				$this->collHdeskTickets = HdeskTicketPeer::doSelectJoinUsuario($criteria, $con, $join_behavior);
			}
		}
		$this->lastHdeskTicketCriteria = $criteria;

		return $this->collHdeskTickets;
	}


	
	public function getHdeskTicketsJoinNotTarea($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(HdeskProjectPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHdeskTickets === null) {
			if ($this->isNew()) {
				$this->collHdeskTickets = array();
			} else {

				$criteria->add(HdeskTicketPeer::CA_IDPROJECT, $this->ca_idproject);

				$this->collHdeskTickets = HdeskTicketPeer::doSelectJoinNotTarea($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(HdeskTicketPeer::CA_IDPROJECT, $this->ca_idproject);

			if (!isset($this->lastHdeskTicketCriteria) || !$this->lastHdeskTicketCriteria->equals($criteria)) {
				$this->collHdeskTickets = HdeskTicketPeer::doSelectJoinNotTarea($criteria, $con, $join_behavior);
			}
		}
		$this->lastHdeskTicketCriteria = $criteria;

		return $this->collHdeskTickets;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collHdeskTickets) {
				foreach ((array) $this->collHdeskTickets as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collHdeskTickets = null;
			$this->aHdeskGroup = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseHdeskProject:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseHdeskProject::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 