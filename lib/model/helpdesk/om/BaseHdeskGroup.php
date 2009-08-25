<?php


abstract class BaseHdeskGroup extends BaseObject  implements Persistent {


  const PEER = 'HdeskGroupPeer';

	
	protected static $peer;

	
	protected $ca_idgroup;

	
	protected $ca_iddepartament;

	
	protected $ca_name;

	
	protected $ca_maxresponsetime;

	
	protected $aDepartamento;

	
	protected $collHdeskTickets;

	
	private $lastHdeskTicketCriteria = null;

	
	protected $collHdeskProjects;

	
	private $lastHdeskProjectCriteria = null;

	
	protected $collHdeskUserGroups;

	
	private $lastHdeskUserGroupCriteria = null;

	
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

	
	public function getCaIdgroup()
	{
		return $this->ca_idgroup;
	}

	
	public function getCaIddepartament()
	{
		return $this->ca_iddepartament;
	}

	
	public function getCaName()
	{
		return $this->ca_name;
	}

	
	public function getCaMaxresponsetime()
	{
		return $this->ca_maxresponsetime;
	}

	
	public function setCaIdgroup($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idgroup !== $v) {
			$this->ca_idgroup = $v;
			$this->modifiedColumns[] = HdeskGroupPeer::CA_IDGROUP;
		}

		return $this;
	} 
	
	public function setCaIddepartament($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_iddepartament !== $v) {
			$this->ca_iddepartament = $v;
			$this->modifiedColumns[] = HdeskGroupPeer::CA_IDDEPARTAMENT;
		}

		if ($this->aDepartamento !== null && $this->aDepartamento->getCaIddepartamento() !== $v) {
			$this->aDepartamento = null;
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
			$this->modifiedColumns[] = HdeskGroupPeer::CA_NAME;
		}

		return $this;
	} 
	
	public function setCaMaxresponsetime($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_maxresponsetime !== $v) {
			$this->ca_maxresponsetime = $v;
			$this->modifiedColumns[] = HdeskGroupPeer::CA_MAXRESPONSETIME;
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

			$this->ca_idgroup = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_iddepartament = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_name = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_maxresponsetime = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating HdeskGroup object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aDepartamento !== null && $this->ca_iddepartament !== $this->aDepartamento->getCaIddepartamento()) {
			$this->aDepartamento = null;
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
			$con = Propel::getConnection(HdeskGroupPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = HdeskGroupPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aDepartamento = null;
			$this->collHdeskTickets = null;
			$this->lastHdeskTicketCriteria = null;

			$this->collHdeskProjects = null;
			$this->lastHdeskProjectCriteria = null;

			$this->collHdeskUserGroups = null;
			$this->lastHdeskUserGroupCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseHdeskGroup:delete:pre') as $callable)
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
			$con = Propel::getConnection(HdeskGroupPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			HdeskGroupPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseHdeskGroup:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseHdeskGroup:save:pre') as $callable)
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
			$con = Propel::getConnection(HdeskGroupPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseHdeskGroup:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			HdeskGroupPeer::addInstanceToPool($this);
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

												
			if ($this->aDepartamento !== null) {
				if ($this->aDepartamento->isModified() || $this->aDepartamento->isNew()) {
					$affectedRows += $this->aDepartamento->save($con);
				}
				$this->setDepartamento($this->aDepartamento);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = HdeskGroupPeer::CA_IDGROUP;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = HdeskGroupPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setCaIdgroup($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += HdeskGroupPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collHdeskTickets !== null) {
				foreach ($this->collHdeskTickets as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collHdeskProjects !== null) {
				foreach ($this->collHdeskProjects as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collHdeskUserGroups !== null) {
				foreach ($this->collHdeskUserGroups as $referrerFK) {
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


												
			if ($this->aDepartamento !== null) {
				if (!$this->aDepartamento->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aDepartamento->getValidationFailures());
				}
			}


			if (($retval = HdeskGroupPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collHdeskTickets !== null) {
					foreach ($this->collHdeskTickets as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collHdeskProjects !== null) {
					foreach ($this->collHdeskProjects as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collHdeskUserGroups !== null) {
					foreach ($this->collHdeskUserGroups as $referrerFK) {
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
		$pos = HdeskGroupPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdgroup();
				break;
			case 1:
				return $this->getCaIddepartament();
				break;
			case 2:
				return $this->getCaName();
				break;
			case 3:
				return $this->getCaMaxresponsetime();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = HdeskGroupPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdgroup(),
			$keys[1] => $this->getCaIddepartament(),
			$keys[2] => $this->getCaName(),
			$keys[3] => $this->getCaMaxresponsetime(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = HdeskGroupPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdgroup($value);
				break;
			case 1:
				$this->setCaIddepartament($value);
				break;
			case 2:
				$this->setCaName($value);
				break;
			case 3:
				$this->setCaMaxresponsetime($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = HdeskGroupPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdgroup($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIddepartament($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaMaxresponsetime($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(HdeskGroupPeer::DATABASE_NAME);

		if ($this->isColumnModified(HdeskGroupPeer::CA_IDGROUP)) $criteria->add(HdeskGroupPeer::CA_IDGROUP, $this->ca_idgroup);
		if ($this->isColumnModified(HdeskGroupPeer::CA_IDDEPARTAMENT)) $criteria->add(HdeskGroupPeer::CA_IDDEPARTAMENT, $this->ca_iddepartament);
		if ($this->isColumnModified(HdeskGroupPeer::CA_NAME)) $criteria->add(HdeskGroupPeer::CA_NAME, $this->ca_name);
		if ($this->isColumnModified(HdeskGroupPeer::CA_MAXRESPONSETIME)) $criteria->add(HdeskGroupPeer::CA_MAXRESPONSETIME, $this->ca_maxresponsetime);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(HdeskGroupPeer::DATABASE_NAME);

		$criteria->add(HdeskGroupPeer::CA_IDGROUP, $this->ca_idgroup);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaIdgroup();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaIdgroup($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIddepartament($this->ca_iddepartament);

		$copyObj->setCaName($this->ca_name);

		$copyObj->setCaMaxresponsetime($this->ca_maxresponsetime);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getHdeskTickets() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addHdeskTicket($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getHdeskProjects() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addHdeskProject($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getHdeskUserGroups() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addHdeskUserGroup($relObj->copy($deepCopy));
				}
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setCaIdgroup(NULL); 
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
			self::$peer = new HdeskGroupPeer();
		}
		return self::$peer;
	}

	
	public function setDepartamento(Departamento $v = null)
	{
		if ($v === null) {
			$this->setCaIddepartament(NULL);
		} else {
			$this->setCaIddepartament($v->getCaIddepartamento());
		}

		$this->aDepartamento = $v;

						if ($v !== null) {
			$v->addHdeskGroup($this);
		}

		return $this;
	}


	
	public function getDepartamento(PropelPDO $con = null)
	{
		if ($this->aDepartamento === null && ($this->ca_iddepartament !== null)) {
			$c = new Criteria(DepartamentoPeer::DATABASE_NAME);
			$c->add(DepartamentoPeer::CA_IDDEPARTAMENTO, $this->ca_iddepartament);
			$this->aDepartamento = DepartamentoPeer::doSelectOne($c, $con);
			
		}
		return $this->aDepartamento;
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
			$criteria = new Criteria(HdeskGroupPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHdeskTickets === null) {
			if ($this->isNew()) {
			   $this->collHdeskTickets = array();
			} else {

				$criteria->add(HdeskTicketPeer::CA_IDGROUP, $this->ca_idgroup);

				HdeskTicketPeer::addSelectColumns($criteria);
				$this->collHdeskTickets = HdeskTicketPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(HdeskTicketPeer::CA_IDGROUP, $this->ca_idgroup);

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
			$criteria = new Criteria(HdeskGroupPeer::DATABASE_NAME);
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

				$criteria->add(HdeskTicketPeer::CA_IDGROUP, $this->ca_idgroup);

				$count = HdeskTicketPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(HdeskTicketPeer::CA_IDGROUP, $this->ca_idgroup);

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
			$l->setHdeskGroup($this);
		}
	}


	
	public function getHdeskTicketsJoinUsuario($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(HdeskGroupPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHdeskTickets === null) {
			if ($this->isNew()) {
				$this->collHdeskTickets = array();
			} else {

				$criteria->add(HdeskTicketPeer::CA_IDGROUP, $this->ca_idgroup);

				$this->collHdeskTickets = HdeskTicketPeer::doSelectJoinUsuario($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(HdeskTicketPeer::CA_IDGROUP, $this->ca_idgroup);

			if (!isset($this->lastHdeskTicketCriteria) || !$this->lastHdeskTicketCriteria->equals($criteria)) {
				$this->collHdeskTickets = HdeskTicketPeer::doSelectJoinUsuario($criteria, $con, $join_behavior);
			}
		}
		$this->lastHdeskTicketCriteria = $criteria;

		return $this->collHdeskTickets;
	}


	
	public function getHdeskTicketsJoinHdeskProject($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(HdeskGroupPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHdeskTickets === null) {
			if ($this->isNew()) {
				$this->collHdeskTickets = array();
			} else {

				$criteria->add(HdeskTicketPeer::CA_IDGROUP, $this->ca_idgroup);

				$this->collHdeskTickets = HdeskTicketPeer::doSelectJoinHdeskProject($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(HdeskTicketPeer::CA_IDGROUP, $this->ca_idgroup);

			if (!isset($this->lastHdeskTicketCriteria) || !$this->lastHdeskTicketCriteria->equals($criteria)) {
				$this->collHdeskTickets = HdeskTicketPeer::doSelectJoinHdeskProject($criteria, $con, $join_behavior);
			}
		}
		$this->lastHdeskTicketCriteria = $criteria;

		return $this->collHdeskTickets;
	}


	
	public function getHdeskTicketsJoinNotTarea($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(HdeskGroupPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHdeskTickets === null) {
			if ($this->isNew()) {
				$this->collHdeskTickets = array();
			} else {

				$criteria->add(HdeskTicketPeer::CA_IDGROUP, $this->ca_idgroup);

				$this->collHdeskTickets = HdeskTicketPeer::doSelectJoinNotTarea($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(HdeskTicketPeer::CA_IDGROUP, $this->ca_idgroup);

			if (!isset($this->lastHdeskTicketCriteria) || !$this->lastHdeskTicketCriteria->equals($criteria)) {
				$this->collHdeskTickets = HdeskTicketPeer::doSelectJoinNotTarea($criteria, $con, $join_behavior);
			}
		}
		$this->lastHdeskTicketCriteria = $criteria;

		return $this->collHdeskTickets;
	}

	
	public function clearHdeskProjects()
	{
		$this->collHdeskProjects = null; 	}

	
	public function initHdeskProjects()
	{
		$this->collHdeskProjects = array();
	}

	
	public function getHdeskProjects($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(HdeskGroupPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHdeskProjects === null) {
			if ($this->isNew()) {
			   $this->collHdeskProjects = array();
			} else {

				$criteria->add(HdeskProjectPeer::CA_IDGROUP, $this->ca_idgroup);

				HdeskProjectPeer::addSelectColumns($criteria);
				$this->collHdeskProjects = HdeskProjectPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(HdeskProjectPeer::CA_IDGROUP, $this->ca_idgroup);

				HdeskProjectPeer::addSelectColumns($criteria);
				if (!isset($this->lastHdeskProjectCriteria) || !$this->lastHdeskProjectCriteria->equals($criteria)) {
					$this->collHdeskProjects = HdeskProjectPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastHdeskProjectCriteria = $criteria;
		return $this->collHdeskProjects;
	}

	
	public function countHdeskProjects(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(HdeskGroupPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collHdeskProjects === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(HdeskProjectPeer::CA_IDGROUP, $this->ca_idgroup);

				$count = HdeskProjectPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(HdeskProjectPeer::CA_IDGROUP, $this->ca_idgroup);

				if (!isset($this->lastHdeskProjectCriteria) || !$this->lastHdeskProjectCriteria->equals($criteria)) {
					$count = HdeskProjectPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collHdeskProjects);
				}
			} else {
				$count = count($this->collHdeskProjects);
			}
		}
		return $count;
	}

	
	public function addHdeskProject(HdeskProject $l)
	{
		if ($this->collHdeskProjects === null) {
			$this->initHdeskProjects();
		}
		if (!in_array($l, $this->collHdeskProjects, true)) { 			array_push($this->collHdeskProjects, $l);
			$l->setHdeskGroup($this);
		}
	}

	
	public function clearHdeskUserGroups()
	{
		$this->collHdeskUserGroups = null; 	}

	
	public function initHdeskUserGroups()
	{
		$this->collHdeskUserGroups = array();
	}

	
	public function getHdeskUserGroups($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(HdeskGroupPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHdeskUserGroups === null) {
			if ($this->isNew()) {
			   $this->collHdeskUserGroups = array();
			} else {

				$criteria->add(HdeskUserGroupPeer::CA_IDGROUP, $this->ca_idgroup);

				HdeskUserGroupPeer::addSelectColumns($criteria);
				$this->collHdeskUserGroups = HdeskUserGroupPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(HdeskUserGroupPeer::CA_IDGROUP, $this->ca_idgroup);

				HdeskUserGroupPeer::addSelectColumns($criteria);
				if (!isset($this->lastHdeskUserGroupCriteria) || !$this->lastHdeskUserGroupCriteria->equals($criteria)) {
					$this->collHdeskUserGroups = HdeskUserGroupPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastHdeskUserGroupCriteria = $criteria;
		return $this->collHdeskUserGroups;
	}

	
	public function countHdeskUserGroups(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(HdeskGroupPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collHdeskUserGroups === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(HdeskUserGroupPeer::CA_IDGROUP, $this->ca_idgroup);

				$count = HdeskUserGroupPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(HdeskUserGroupPeer::CA_IDGROUP, $this->ca_idgroup);

				if (!isset($this->lastHdeskUserGroupCriteria) || !$this->lastHdeskUserGroupCriteria->equals($criteria)) {
					$count = HdeskUserGroupPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collHdeskUserGroups);
				}
			} else {
				$count = count($this->collHdeskUserGroups);
			}
		}
		return $count;
	}

	
	public function addHdeskUserGroup(HdeskUserGroup $l)
	{
		if ($this->collHdeskUserGroups === null) {
			$this->initHdeskUserGroups();
		}
		if (!in_array($l, $this->collHdeskUserGroups, true)) { 			array_push($this->collHdeskUserGroups, $l);
			$l->setHdeskGroup($this);
		}
	}


	
	public function getHdeskUserGroupsJoinUsuario($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(HdeskGroupPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHdeskUserGroups === null) {
			if ($this->isNew()) {
				$this->collHdeskUserGroups = array();
			} else {

				$criteria->add(HdeskUserGroupPeer::CA_IDGROUP, $this->ca_idgroup);

				$this->collHdeskUserGroups = HdeskUserGroupPeer::doSelectJoinUsuario($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(HdeskUserGroupPeer::CA_IDGROUP, $this->ca_idgroup);

			if (!isset($this->lastHdeskUserGroupCriteria) || !$this->lastHdeskUserGroupCriteria->equals($criteria)) {
				$this->collHdeskUserGroups = HdeskUserGroupPeer::doSelectJoinUsuario($criteria, $con, $join_behavior);
			}
		}
		$this->lastHdeskUserGroupCriteria = $criteria;

		return $this->collHdeskUserGroups;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collHdeskTickets) {
				foreach ((array) $this->collHdeskTickets as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collHdeskProjects) {
				foreach ((array) $this->collHdeskProjects as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collHdeskUserGroups) {
				foreach ((array) $this->collHdeskUserGroups as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collHdeskTickets = null;
		$this->collHdeskProjects = null;
		$this->collHdeskUserGroups = null;
			$this->aDepartamento = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseHdeskGroup:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseHdeskGroup::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 