<?php


abstract class BaseDepartamento extends BaseObject  implements Persistent {


  const PEER = 'DepartamentoPeer';

	
	protected static $peer;

	
	protected $ca_iddepartamento;

	
	protected $ca_nombre;

	
	protected $ca_inhelpdesk;

	
	protected $collPerfils;

	
	private $lastPerfilCriteria = null;

	
	protected $collHdeskGroups;

	
	private $lastHdeskGroupCriteria = null;

	
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

	
	public function getCaIddepartamento()
	{
		return $this->ca_iddepartamento;
	}

	
	public function getCaNombre()
	{
		return $this->ca_nombre;
	}

	
	public function getCaInhelpdesk()
	{
		return $this->ca_inhelpdesk;
	}

	
	public function setCaIddepartamento($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_iddepartamento !== $v) {
			$this->ca_iddepartamento = $v;
			$this->modifiedColumns[] = DepartamentoPeer::CA_IDDEPARTAMENTO;
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
			$this->modifiedColumns[] = DepartamentoPeer::CA_NOMBRE;
		}

		return $this;
	} 
	
	public function setCaInhelpdesk($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->ca_inhelpdesk !== $v) {
			$this->ca_inhelpdesk = $v;
			$this->modifiedColumns[] = DepartamentoPeer::CA_INHELPDESK;
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

			$this->ca_iddepartamento = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_nombre = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_inhelpdesk = ($row[$startcol + 2] !== null) ? (boolean) $row[$startcol + 2] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Departamento object", $e);
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
			$con = Propel::getConnection(DepartamentoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = DepartamentoPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->collPerfils = null;
			$this->lastPerfilCriteria = null;

			$this->collHdeskGroups = null;
			$this->lastHdeskGroupCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseDepartamento:delete:pre') as $callable)
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
			$con = Propel::getConnection(DepartamentoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			DepartamentoPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseDepartamento:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseDepartamento:save:pre') as $callable)
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
			$con = Propel::getConnection(DepartamentoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseDepartamento:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			DepartamentoPeer::addInstanceToPool($this);
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
				$this->modifiedColumns[] = DepartamentoPeer::CA_IDDEPARTAMENTO;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = DepartamentoPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setCaIddepartamento($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += DepartamentoPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collPerfils !== null) {
				foreach ($this->collPerfils as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collHdeskGroups !== null) {
				foreach ($this->collHdeskGroups as $referrerFK) {
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


			if (($retval = DepartamentoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collPerfils !== null) {
					foreach ($this->collPerfils as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collHdeskGroups !== null) {
					foreach ($this->collHdeskGroups as $referrerFK) {
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
		$pos = DepartamentoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIddepartamento();
				break;
			case 1:
				return $this->getCaNombre();
				break;
			case 2:
				return $this->getCaInhelpdesk();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = DepartamentoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIddepartamento(),
			$keys[1] => $this->getCaNombre(),
			$keys[2] => $this->getCaInhelpdesk(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = DepartamentoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIddepartamento($value);
				break;
			case 1:
				$this->setCaNombre($value);
				break;
			case 2:
				$this->setCaInhelpdesk($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = DepartamentoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIddepartamento($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaNombre($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaInhelpdesk($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(DepartamentoPeer::DATABASE_NAME);

		if ($this->isColumnModified(DepartamentoPeer::CA_IDDEPARTAMENTO)) $criteria->add(DepartamentoPeer::CA_IDDEPARTAMENTO, $this->ca_iddepartamento);
		if ($this->isColumnModified(DepartamentoPeer::CA_NOMBRE)) $criteria->add(DepartamentoPeer::CA_NOMBRE, $this->ca_nombre);
		if ($this->isColumnModified(DepartamentoPeer::CA_INHELPDESK)) $criteria->add(DepartamentoPeer::CA_INHELPDESK, $this->ca_inhelpdesk);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(DepartamentoPeer::DATABASE_NAME);

		$criteria->add(DepartamentoPeer::CA_IDDEPARTAMENTO, $this->ca_iddepartamento);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaIddepartamento();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaIddepartamento($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaNombre($this->ca_nombre);

		$copyObj->setCaInhelpdesk($this->ca_inhelpdesk);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getPerfils() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addPerfil($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getHdeskGroups() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addHdeskGroup($relObj->copy($deepCopy));
				}
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setCaIddepartamento(NULL); 
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
			self::$peer = new DepartamentoPeer();
		}
		return self::$peer;
	}

	
	public function clearPerfils()
	{
		$this->collPerfils = null; 	}

	
	public function initPerfils()
	{
		$this->collPerfils = array();
	}

	
	public function getPerfils($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(DepartamentoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPerfils === null) {
			if ($this->isNew()) {
			   $this->collPerfils = array();
			} else {

				$criteria->add(PerfilPeer::CA_DEPARTAMENTO, $this->ca_nombre);

				PerfilPeer::addSelectColumns($criteria);
				$this->collPerfils = PerfilPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PerfilPeer::CA_DEPARTAMENTO, $this->ca_nombre);

				PerfilPeer::addSelectColumns($criteria);
				if (!isset($this->lastPerfilCriteria) || !$this->lastPerfilCriteria->equals($criteria)) {
					$this->collPerfils = PerfilPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPerfilCriteria = $criteria;
		return $this->collPerfils;
	}

	
	public function countPerfils(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(DepartamentoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collPerfils === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(PerfilPeer::CA_DEPARTAMENTO, $this->ca_nombre);

				$count = PerfilPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PerfilPeer::CA_DEPARTAMENTO, $this->ca_nombre);

				if (!isset($this->lastPerfilCriteria) || !$this->lastPerfilCriteria->equals($criteria)) {
					$count = PerfilPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collPerfils);
				}
			} else {
				$count = count($this->collPerfils);
			}
		}
		return $count;
	}

	
	public function addPerfil(Perfil $l)
	{
		if ($this->collPerfils === null) {
			$this->initPerfils();
		}
		if (!in_array($l, $this->collPerfils, true)) { 			array_push($this->collPerfils, $l);
			$l->setDepartamento($this);
		}
	}

	
	public function clearHdeskGroups()
	{
		$this->collHdeskGroups = null; 	}

	
	public function initHdeskGroups()
	{
		$this->collHdeskGroups = array();
	}

	
	public function getHdeskGroups($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(DepartamentoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHdeskGroups === null) {
			if ($this->isNew()) {
			   $this->collHdeskGroups = array();
			} else {

				$criteria->add(HdeskGroupPeer::CA_IDDEPARTAMENT, $this->ca_iddepartamento);

				HdeskGroupPeer::addSelectColumns($criteria);
				$this->collHdeskGroups = HdeskGroupPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(HdeskGroupPeer::CA_IDDEPARTAMENT, $this->ca_iddepartamento);

				HdeskGroupPeer::addSelectColumns($criteria);
				if (!isset($this->lastHdeskGroupCriteria) || !$this->lastHdeskGroupCriteria->equals($criteria)) {
					$this->collHdeskGroups = HdeskGroupPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastHdeskGroupCriteria = $criteria;
		return $this->collHdeskGroups;
	}

	
	public function countHdeskGroups(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(DepartamentoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collHdeskGroups === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(HdeskGroupPeer::CA_IDDEPARTAMENT, $this->ca_iddepartamento);

				$count = HdeskGroupPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(HdeskGroupPeer::CA_IDDEPARTAMENT, $this->ca_iddepartamento);

				if (!isset($this->lastHdeskGroupCriteria) || !$this->lastHdeskGroupCriteria->equals($criteria)) {
					$count = HdeskGroupPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collHdeskGroups);
				}
			} else {
				$count = count($this->collHdeskGroups);
			}
		}
		return $count;
	}

	
	public function addHdeskGroup(HdeskGroup $l)
	{
		if ($this->collHdeskGroups === null) {
			$this->initHdeskGroups();
		}
		if (!in_array($l, $this->collHdeskGroups, true)) { 			array_push($this->collHdeskGroups, $l);
			$l->setDepartamento($this);
		}
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collPerfils) {
				foreach ((array) $this->collPerfils as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collHdeskGroups) {
				foreach ((array) $this->collHdeskGroups as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collPerfils = null;
		$this->collHdeskGroups = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseDepartamento:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseDepartamento::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 